@extends('layouts.app')

@section('title')
<title>Account Profile</title>
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
                    <li class="active"><a href="#"> Account Profile</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Account Profile</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">    
    
    @include('account.settings.partials.account_navigation')
    
    <div class="col-sm-9 col-12 mb-sm-0">   

    <h6>@lang('menu.profile')</h6>
    <div class="card card-default">
        <div class="card-body">
            <form action="{{ route("account.profile.store") }}" method="post">
               @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('name')</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control form-control-alternative {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('email')</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control form-control-alternative {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', auth()->user()->email) }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-default">
                            @lang('update')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    </div>
</div>    
@endsection
