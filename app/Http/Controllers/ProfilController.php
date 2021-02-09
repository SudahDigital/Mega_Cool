<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index(){
        $user = App\User::with('cities')->where('id',\Auth::user()->id)->first();
        return view('customer.profil',['user'=> $user]);
    }
}
