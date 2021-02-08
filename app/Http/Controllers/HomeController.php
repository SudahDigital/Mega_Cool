<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if ((auth()->user()->roles == 'SUPERADMIN') || (auth()->user()->roles == 'ADMIN')) {
            return view('home');
        }else if (auth()->user()->roles == 'SALES') {
            return redirect('/sales_home');
        }
        //return view('home');
    }
}
