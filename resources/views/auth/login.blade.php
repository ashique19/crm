@extends('layouts.app')

@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
@endsection

@section('splash')

<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Login</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')

  <div class="row">
      <div class="col-sm-6 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="p-3">
                        <p class="text-muted text-center">Sign in to continue.</p>

                        <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <label for="inputEmail">Username</label>
                                <input type="email" id="inputEmail" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  name="email" value="{{ old('email') }}" placeholder="Enter username" required >
                            </div>

                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" id="inputPassword" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter password" required>
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }} id="customCheckLogin" value="remember-me">
                                        <label class="custom-control-label" for="customCheckLogin">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-lock"></i> Forgot your password?</a>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <a href="{{ route('activation.resend') }}" class="text-muted"><i class="fa fa-lock"></i> Resend Activation</a>
                                </div>
                            </div>

                            @if(config('services.github.client_id'))
                                <a href="{{ url('/auth/github') }}" class="btn btn-outline-primary rounded-circle mb-3 mr-2"><i class="flaticon-github flaticon-circle-p"></i> Github</a>
                            @endif
                            @if(config('services.twitter.client_id'))
                                <a href="{{ url('/auth/twitter') }}" class="btn btn-outline-info rounded-circle mb-3 mr-2"><i class="flaticon-twitter-logo flaticon-circle-p"></i> Twitter</a>
                            @endif
                            @if(config('services.facebook.client_id'))
                                <a href="{{ url('/auth/facebook') }}" class="btn btn-outline-danger rounded-circle mb-3 mr-2"><i class="flaticon-facebook-logo flaticon-circle-p"></i> Facebook</a>
                            @endif
                        </form>
                    </div>

                </div>
            </div>

        </div>
</div>





@endsection
