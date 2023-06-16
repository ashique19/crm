@extends('layouts.app')

@section('title')
<title>Change Password</title>
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="mr-5"><a href="{{ route('account.overview') }}">Account</a></li>
                    <li class="active"><a href="#"> Change Password</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Change Password</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">    
    
    @include('account.settings.partials.account_navigation')
    
    <div class="col-sm-9 col-12 mb-sm-0">   
    
    <div class="card card-default">
         <div class="card-body">
         
            <h5 class="mb-5 text-center">Change Password</h5>
         
            <form action="{{ route("account.password.store") }}" method="post">
                @csrf

                <div class="form-group row">
                    <label for="password_current" class="col-md-4 col-form-label text-md-right">Current Password</label>

                    <div class="col-md-6">
                        <input id="password_current" type="password" class="form-control form-control-alternative {{ $errors->has('password_current') ? ' is-invalid' : '' }}" name="password_current" required>

                        @if ($errors->has('password_current'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_current') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control form-control-alternative {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control form-control-alternative {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-default">
                            Change Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>    
    
@endsection
