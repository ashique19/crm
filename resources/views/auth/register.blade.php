@extends('layouts.app')

@section('title')
    <title>Register</title>
    <meta name="title" content="Register">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
@endsection

@section('splash')

<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Register</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')



    <form class="form-login" method="POST" action="{{ route('register') }}">
    @csrf
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img alt="logo" src="{{ asset('assets/img/logo-6.png') }}" class="theme-logo">
            </div>
            <div class="col-md-12">

                <div class="social text-center">
                    <h5 class="mb-4">Register with</h5>
                        @if(config('services.github.client_id'))
                            <a href="{{ url('/auth/github') }}" class="btn btn-block btn-md btn-github"><i class="fa fa-github-square"></i> Github</a>
                        @endif
                        @if(config('services.twitter.client_id'))
                            <a href="{{ url('/auth/twitter') }}" class="btn  btn-block btn-md btn-twitter"><i class="fa fa-twitter-square"></i> Twitter</a>
                        @endif
                        @if(config('services.facebook.client_id'))
                            <a href="{{ url('/auth/facebook') }}" class="btn  btn-block btn-md btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                        @endif                  
                </div>

                <div class="division mt-4 mb-5">
                    <div class="line line-left"></div>
                        <span>or</span>
                    <div class="line line-right"></div>
                </div>

                <label for="inputEmail" class="">Name</label>                
                <input type="text" id="name" class="form-control mb-4 {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" value="{{ old('name') }}" required >       
                @if ($errors->has('name'))
                    <span class="invalid-feedback text-center">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif                

                <label for="inputEmail" class="">Email</label>                
                <input type="email" id="inputEmail" class="form-control mb-4 {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Login" name="email" value="{{ old('email') }}" required >     
                
                @if ($errors->has('email'))
                    <span class="invalid-feedback text-center">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
                
                <label for="inputPassword" class="">Password</label>                    
                <input type="password" id="inputPassword" class="form-control mb-5 {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback text-center">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif           

                <label for="inputPasswordConfirmation" class="">Password Confirmation</label>                    
                <input type="password" id="inputPasswordConfirmation" class="form-control mb-5 {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Password Confirmation" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback text-center">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                @endif        
                
                <div class="terms-conditions-chkbox d-flex justify-content-center mb-4">
                    <div class="custom-control custom-checkbox mr-3">
                        <input type="checkbox" class="custom-control-input form-check-input{{ $errors->has('terms') ? ' is-invalid' : '' }}" id="terms" name="terms" value="terms">
                        <label class="custom-control-label" for="terms"><span class="d-block mt-1">I agree to all <a href="{{ route('terms') }}">Terms</a></span></label>
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-dark btn-rounded btn-block">Register</button>              

            </div>

            <div class="col-md-12">
                <div class="login-text text-center">
                    <p class="mt-3 text-black">Already have an account? <a href="{{ route('login') }}" class="">Click here </a> to login!</p>
                </div>
            </div>
        </div>
    </form>






@endsection
