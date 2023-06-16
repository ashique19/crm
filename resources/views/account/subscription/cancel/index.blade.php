@extends('layouts.app')

@section('title')
<title>Cancel Subscription</title>
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
                    <li class="active"><a href="#">Cancel Subscription</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Cancel Subscription</h4>
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
                    <i class="flaticon-circle-cross"></i>
                </div>
                <div class="card-content">
                    <h5>Cancel Account</h5>
                    <form action="{{ route('account.subscription.cancel.store') }}" method="post">
                        @csrf

                        <p>Click below to confirm your subscription cancellation</p>

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn-material btn-rounded btn-material-danger  mb-4 mr-3">
                                    Cancel Subscription
                                </button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>    
 
    </div>
</div>     
@endsection
