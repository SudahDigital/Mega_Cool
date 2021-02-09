@extends('customer.layouts.template-nocart')
@section('title') Profil @endsection
@section('content')
    <div class="container">
        
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-0">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-profil-item active mt-1" aria-current="page">Profil</li>&nbsp;
                        <li class="breadcrumb-profil-item" style="color: #000!important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                    </ol>
                </nav>
            </div>
        </div>
        
            
        <div class="row justify-content-end mt-5">
            <div class="col-sm-7">
                <p class="heading-profil">Hello!</p>
                <p class="name-profil">{{Auth::user()->name}}</p>
                <p class="area-profil font-italic">{{$user->city_name}}  |  Megacools</p>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
