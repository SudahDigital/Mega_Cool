<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        if($status){
        $groups = \App\Group::with('item_active')
        ->where('group_name','LIKE',"%$keyword%")
        ->where('status',strtoupper($status))->get();//->paginate(10);
        $products_list = \App\product::with('groups')
                ->doesntHave('groups')->get();    
        }
        else
            {
            $groups = \App\Group::with('item_active')
            ->where('group_name','LIKE',"%$keyword%")->get();//->paginate(10);
            $products_list = \App\product::with('groups')
                ->doesntHave('groups')->get();
            }
        return view('grouppaket.index', ['groups'=> $groups,'products_list'=>$products_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $products = \App\product::with('groups')
                ->doesntHave('groups')->get();
       //$products=\App\product::all();
        return view('grouppaket.create', ['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = \App\Group::create($request->all());

        $products = $request->input('product_id', []);
        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $group->products()->attach($products[$product]);
            }
        }
        
        if($request->get('save_action') == 'SAVE'){
          return redirect()
                ->route('groups.create')
                ->with('status', 'Group paket successfully saved');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = \App\Order::findOrFail($id);
        $products = \App\product::get();
        return view('orders.edit_order', ['order' => $order],['products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_item(Request $request)
    {
        //$group = \App\Group::create($request->all());
        $group= $request->input('group_id');
        $products = $request->input('product_id', []);
        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cek_exist = \App\group_product::where('product_id',$products[$product])
                            ->where('group_id',$group)->first();
                //$count =  $cek_exist->count();            
                    if($cek_exist){
                        $new_group_product = \App\group_product::findOrFail($cek_exist->id);
                        $new_group_product->status ='ACTIVE';
                        $new_group_product->save();
                    }
                    else{
                        $new_group_product = new \App\group_product;
                        $new_group_product->group_id =  $group;
                        $new_group_product->product_id = $products[$product];
                        $new_group_product->save();
                    }
            }
        }
        return redirect()
            ->route('groups.index')
            ->with('status', 'Item group successfully add');
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $groups = \App\Group::where('name','LIKE',"%$keyword%")->get();
        return $groups;
    }

    public function GroupNameSearch(Request $request){
        $keyword = $request->get('code');
        $groups = \App\Group::where('group_name','=',"$keyword")->count();
        if ($groups > 0) {
            echo "taken";	
          }else{
            echo 'not_taken';
          }
    }
}
