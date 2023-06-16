@extends('layouts.app')

@section('title')
<title>Two Factor Authentication</title>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/modules/modules-card.css') }}">   
<link href="{{ asset('assets/css/ui-kit/buttons/creative/creative-material.css') }}" rel="stylesheet" type="text/css" />
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
                    <li class="active"><a href="#"> Two Factor Authentication</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Two Factor Authentication</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">    
    
    @include('account.settings.partials.account_navigation')
    
    <div class="col-sm-9 col-12 mb-sm-0">   

            <div class="widget-content-area social-likes text-center p-0 br-4">
            <div class="card dribbble br-4">
                <div class="icon mb-4">
                    <i class="flaticon-lock-5"></i>
                </div>
                <div class="card-content">
                    <h5 class="mb-5">Enable Two Factor Authentication</h5>             

            @if (auth()->user()->twoFactorEnabled())
                <p>Two factor futhentication is enabled</p>

                <form action="{{ route('account.twofactor.destroy') }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="form-group row mb-0">
                        <div class="col-md-6 mx-md-auto">
                            <button type="submit" class="btn-material btn-rounded btn-material-danger  mb-4 mr-3">
                                Disable Authentication
                            </button>
                        </div>
                    </div>
                </form>
            @else
                @if (auth()->user()->twoFactorPendingVerification())
                    <form action="{{ route('account.twofactor.verify') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="token" class="col-md-4 col-form-label text-md-right">Verify Token</label>

                            <div class="col-md-6">
                                <input id="token" type="number" class="form-control form-control-alternative {{ $errors->has('token') ? ' is-invalid' : '' }}" name="token" required>

                                @if ($errors->has('token'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 mx-md-auto">
                                <button type="submit" class="btn-material btn-rounded btn-material-danger  mb-4 mr-3">
                                    Verify Authentication
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <form action="{{ route('account.twofactor.destroy') }}" method="POST">
                        @csrf
                        @method('delete')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 mx-md-auto">
                                <button type="submit" class="btn-material btn-rounded btn-material-danger  mb-4 mr-3">
                                    Cancel Verification
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{ route('account.twofactor.store') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="dial_code" class="col-md-4 col-form-label text-md-right">Dialing Code</label>

                            <div class="col-md-6">
                                <select name="dial_code" id="dial_code" class="form-control{{ $errors->has('dial_code') ? ' is-invalid' : '' }}">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->dial_code }}">{{ $country->name }} (+{{ $country->dial_code }})</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('dial_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dial_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" required>

                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 mx-md-auto">
                                <button type="submit" class="btn-material btn-rounded btn-material-danger  mb-4 mr-3">
                                    Enable Authentication
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            @endif

                   
                </div>
            </div>
        </div>


    
    </div>
</div>    
    
@endsection
