<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;

class SessionStore extends Controller
{
    public function index(Request $request){
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        //$url = 'http://maps.google.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false';
        //$geocode = @file_get_contents($url);
        //$json = json_decode($geocode);
        //$address = $json->results[0]->formatted_address;
        //echo $address;
        //echo $lat,$lng;
        $ses_order = new Order;
        //$ses_order->user_id = $request->get('user_id');
        $ses_order->user_loc =$lat.','.$lng;
        $ses_order->customer_id = $request->get('customer_id');
        $request->session()->put('ses_order', $ses_order);
        return redirect('/sales_home');
    }

    public function clear(Request $request){
        
        $request->session()->forget('ses_order');
        return redirect('/sales_home');
    }
}
