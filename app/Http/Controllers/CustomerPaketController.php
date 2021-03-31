<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerPaketController extends Controller
{
    public function index($id)
    {   
        $id_user = \Auth::user()->id;
        $banner_active = \App\Banner::orderBy('position', 'ASC')->first();
        $banner = \App\Banner::orderBy('position', 'ASC')->limit(5)->get();
        $categories = \App\Category::all();//paginate(10);
        $paket = \App\Paket::all();//paginate(10);
        $paket_id = \App\Paket::findOrfail($id);//paginate(10);
        $cat_count = $categories->count();
        $product = \App\Group::with('item_active')
            ->get();//->paginate(10);
        $count_data = $product->count();
        $keranjang = DB::select("SELECT orders.user_id, orders.status,orders.customer_id, 
                    products.Product_name, products.image, products.price, products.discount,
                    products.price_promo, order_product.id, order_product.order_id,
                    order_product.product_id,order_product.quantity
                    FROM order_product, products, orders WHERE 
                    orders.id = order_product.order_id AND 
                    order_product.product_id = products.id AND orders.status = 'SUBMIT' 
                    AND orders.user_id = '$id_user' AND orders.customer_id IS NULL ");
        $item = DB::table('orders')
                    ->where('user_id','=',"$id_user")
                    ->where('orders.status','=','SUBMIT')
                    ->whereNull('orders.customer_id')
                    ->first();
        $item_name = DB::table('orders')
                    ->join('order_product','order_product.order_id','=','orders.id')
                    ->where('user_id','=',"$id_user")
                    ->whereNotNull('orders.customer_id')
                    ->first();
        
        $total_item = DB::table('orders')
                    ->join('order_product','order_product.order_id','=','orders.id')
                    ->where('user_id','=',"$id_user")
                    ->whereNull('orders.customer_id')
                    ->count();
        $data=['total_item'=> $total_item, 
                'keranjang'=>$keranjang,
                'product'=>$product,
                'item'=>$item,
                'item_name'=>$item_name,
                'count_data'=>$count_data,
                'paket'=>$paket,
                'categories'=>$categories,
                'cat_count'=>$cat_count,
                'banner'=>$banner,
                'banner_active'=>$banner_active,
                'paket_id'=>$paket_id,
            ];
       
        return view('customer.paket',$data);
             
    }

    public function simpan(Request $request){ 
        /*$ses_id = $request->header('User-Agent');
        $clientIP = \Request::getClientIp(true);
        $id = $ses_id.$clientIP;*/
        $id_user = \Auth::user()->id; 
        //$id = $request->header('User-Agent'); 
        $id_product = $request->get('Product_id');
        $quantity=$request->get('quantity');
        $price=$request->get('price');
        $group_id=$request->get('group_id');
        $paket_id=$request->get('paket_id');
        $cek_promo = \App\product::findOrFail($id_product);
        $cek_order = \App\Order::where('user_id','=',"$id_user")
        ->where('status','=','SUBMIT')->whereNull('customer_id')->first();
        if($cek_order !== null){
            $order_product = \App\Order_paket_temp::where('order_id','=',$cek_order->id)
            ->where('product_id','=',$id_product)->first();
            if($order_product!== null){
                $order_product->price_item = $cek_promo->price;
                $order_product->price_item_promo = $cek_promo->price_promo;
                $order_product->discount_item = $cek_promo->discount;
                $order_product->quantity = $quantity;
                $order_product->group_id = $group_id;
                $order_product->paket_id = $paket_id;
                $order_product->save();
                //$cek_order->total_price += $price * $quantity;
                //$cek_order->save();
                }else{
                        $new_order_product = new \App\Order_paket_temp;
                        $new_order_product->order_id =  $cek_order->id;
                        $new_order_product->product_id = $id_product;
                        $new_order_product->price_item = $cek_promo->price;
                        $new_order_product->price_item_promo = $cek_promo->price_promo;
                        $new_order_product->discount_item = $cek_promo->discount;
                        $new_order_product->quantity = $quantity;
                        $new_order_product->group_id = $group_id;
                        $new_order_product->paket_id = $paket_id;
                        $new_order_product->save();
                        //$cek_order->total_price += $price * $quantity;
                        //$cek_order->save();
                }
        }
        else{

            $order = new \App\Order;
            $order->user_id = $id_user;
            //$order->quantity = $quantity;
            $order->invoice_number = date('YmdHis');
            //$order->total_price = $price * $quantity;
            $order->status = 'SUBMIT';
            $order->save();
            if($order->save()){
                $order_product = new \App\order_product;
                $order_product->order_id = $order->id;
                $order_product->product_id = $request->get('Product_id');
                $order_product->price_item = $cek_promo->price;
                $order_product->price_item_promo = $cek_promo->price_promo;
                $order_product->discount_item = $cek_promo->discount;
                $order_product->quantity = $request->get('quantity');
                $order_product->group_id = $group_id;
                $order_product->paket_id = $paket_id;
                $order_product->save();
            }

        }
        //return response()->json(['return' => 'some data']);    
        //$order->products()->attach($request->get('Product_id'));
        
        return redirect()->back()->with('status','Product berhasil dimasukan kekeranjang');
    }
}

