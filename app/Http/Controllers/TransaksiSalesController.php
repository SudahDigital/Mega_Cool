<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\product;


class TransaksiSalesController extends Controller
{   
    public function index(Request $request){
        $user_id = \Auth::user()->id;
        //$categories = \App\Category::all();//paginate(10);
        $paket = \App\Paket::all()->first();//paginate(10);
        $orders = \App\Order::with('products')->whereNotNull('customer_id')->where('user_id','=',"$user_id")->paginate(5);
        $order_count = $orders->count();
        
        $data=['order_count'=>$order_count, 'orders'=>$orders,'paket'=>$paket];//'categories'=>$categories,];
       
        return view('customer.pesanan',$data);

    }
        
}
