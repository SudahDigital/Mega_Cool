@extends('auth.template-auth')
@section('title') Login @endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center mx-auto" >
            <div class="col-md-2 image-logo-login" style="z-index: 2">
               <img src="{{ asset('assets/image/LOGO MEGACOOLS_DEFAULT.png') }}" class="img-thumbnail" style="background-color:transparent; border:none;" alt="LOGO MEGACOOLS_DEFAULT">  
            </div>
            
        </div>
        <div class="col-md-12 login-label" style="z-index: 2">
            <h1>Masuk</h1>
            <p> Gunakan Akun Anda</p>
        </div>
            
        <div class="row justify-content-center">
            <div class="col-sm-7" style="z-index: 2">
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
