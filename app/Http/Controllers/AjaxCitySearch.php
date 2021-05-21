<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxCitySearch extends Controller
{
    public function ajax_city(Request $request){
        $keyword = $request->get('q');
        $cities = \App\City::where('type','=','Kota')
                ->where('city_name','LIKE',"%$keyword%")
                ->orderBy('display_order','ASC')
                ->orderBy('postal_code','ASC')
                ->get();
        return $cities;
    }

    public function ajax_store(Request $request){
        $keyword = $request->get('q');
        $store = \App\Customer::where('store_name','LIKE',"%$keyword%")
        ->orWhere('store_code','LIKE',"%$keyword%")->get();
        return $store;
    }
}
