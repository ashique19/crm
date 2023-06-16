@extends('layouts.app')

@section('title')
<title>Deactivate Account</title>
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
                    <li class="active"><a href="#"> Deactivate Account</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Deactivate Account</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">    
    
    @include('account.settings.partials.account_navigation')
    
    <div class="col-sm-9 col-12 mb-sm-0">   

    <h6>@lang('menu.deactivate_account')</h6>
    <div class="card card-default">
        <div class="card-body">
            <form action="{{ route('account.deactivate.store') }}" method="post">
                @csrf

                @subscriptionnotcancelled
                    <div class="text-center">
                        <strong>@lang('this_will_also_deactivate_your_subscription')</strong>
                        <br />
                        <br />
                    </div>
                @endsubscriptionnotcancelled

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-danger">
                            @lang('deactivate_account')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
</div>    
@endsection
