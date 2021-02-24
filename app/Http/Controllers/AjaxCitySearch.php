<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxCitySearch extends Controller
{
    public function ajax_city(Request $request){
        $keyword = $request->get('q');
        $cities = \App\City::where('city_name','LIKE',"%$keyword%")->get();
        return $cities;
    }

    public function ajax_store(Request $request){
        $keyword = $request->get('q');
        $store = \App\Customer::where('store_name','LIKE',"%$keyword%")
        ->orWhere('store_code','LIKE',"%$keyword%")->get();
        return $store;
    }
}
