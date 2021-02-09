@extends('customer.layouts.template-nocart')
@section('title') Profil @endsection
@section('content')
    <div class="container">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-5">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-profil-item active mt-1" aria-current="page">Profil</li>&nbsp;
                        <li class="breadcrumb-profil-item" style="color: #000!important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 login-label">
            <h1>Masuk</h1>
            <p> Gunakan Akun Anda</p>
        </div>
            
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card mx-auto contact_card" 
                        style=" border-top-left-radius:25px;
                                border-top-right-radius:25px;
                                border-bottom-right-radius:0;
                                border-bottom-left-radius:0;">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control contact_input @error('email') is-invalid @enderror" placeholder="Email" id="email" required autocomplete="off" autofocus value="{{ old('email') }}">
                                <!--<label for="email" class="contact_label">{{ __('Email') }}</label>-->
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback text-center" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr style="border:1px solid rgba(116, 116, 116, 0.507);">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control contact_input @error('password') is-invalid @enderror" placeholder="Kata Sandi" id="password" required autocomplete="off" value="{{ old('password') }}">
                                <!--<label for="password" class="contact_label_pass">{{ __('Kata Sandi') }}</label>-->
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback mx-auto" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-12 login-label" style="margin-top:20px;">
                        @if (Route::has('password.request'))
                            <a  href="{{ route('password.request') }}">
                              <p>{{ __('Lupa Password?') }}</p>
                            </a>
                        @endif
                    </div>
                    <!--
                    <div class="col-md-12 login-label text-center" style="margin-top:20px;">
                         <p>Don't have an account..? <a style="color:#6a3137; font-size:20px; font-weight:900;" href="{{ route('register') }}">Sign Up</a></p>
                    </div>
                    -->
                    <div class="col-md-12 mx-auto text-center">
                        <button type="submit" class="btn btn_login_form" >{{ __('Masuk') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
