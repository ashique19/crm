@extends('layouts.app')

@section('title')
<title>FAQ</title>
@endsection

@section('styles')
<link href="{{ asset('assets/css/pages/faq/faq.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="#"> FAQ</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> FAQ</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div id="list-item-1" class="card faq-section mb-5">                                       
                                    <div id="faq-section-1" class="faq-container">

                                        <div class="card">
                                            <div class="card-header" id="faq-section-one-ques-2">
                                                <div class="mb-0 mt-0">
                                                    <div role="button" class="collapsed" data-toggle="collapse" data-target="#faq-section-one-ans-2" aria-expanded="false" aria-controls="faq-section-one-ans-2">
                                                        FAQ #2
                                                        <i class="flaticon-down-arrow float-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="faq-section-one-ans-2" class="collapse" aria-labelledby="faq-section-one-ques-2" data-parent="#faq-section-1">
                                                <div class="card-body">
                                                    <p class="mb-4">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>
                                                    <p class="mb-4">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>  
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

@endsection

@section('scripts')
@endsection