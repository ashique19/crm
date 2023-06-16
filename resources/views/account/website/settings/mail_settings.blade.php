@extends('layouts.app')

@section('title')
<title>Website Mail Settings</title>
@endsection

@section('styles')
<link href="{{ asset('assets/css/ui-kit/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/modules/modules-card.css') }}">  
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="#">Notification Mail Settings</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i>Notification Mail Settings</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">    
    @include('account.website.settings.partials.setting_navigation')
    <div class="col-sm-9 col-12 mb-sm-0">  
        <div class="widget-content widget-content-area h-100 br-4 p-0">
            <div id="user-profile-card-3" class="card br-4">                                
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="mt-2">Notification Mail Settings</h6>
                        </div>
                        <div class="col-sm-12">
                           @if (\Session::has('success'))
                               <div class="alert alert-success">
                                   <ul class="nav">
                                       <li>{!! \Session::get('success') !!}</li>
                                   </ul>
                               </div>
                           @endif
                       </div>
                    </div>
                </div>
                <div class="card-body">
					<div class="alert alert-info">Please configure the email address you wish to use to send email notifications to your clients below.</div>
                    <form class="" action="{{ route('account.website.mailsetting.store') }}" novalidate="" method="post">
                        @csrf()
                        <input type="hidden" name="site_id" value="{{ $site->id }}">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" required="" value="{{ $site->notification_email_address }}" name="notification_email_address" placeholder="{{ 'notifications@'.$site->primary_domain }}" data-parsley-id="9">
                        </div>
                        <div class="form-group">
                            <label>Email Password</label>
                            <input type="text" class="form-control" required="" value="{{ $site->notification_email_password }}" name="notification_email_password" placeholder="xxxxxxx" data-parsley-id="9">
                        </div>
                        <div class="form-group">
                            <label>Outgoing Mail Server</label>
                            <input type="text" class="form-control" required="" value="{{ $site->notification_email_server }}" name="notification_email_server" placeholder="mail.{{ $site->primary_domain }}" data-parsley-id="9">
                        </div>
                        <div class="form-group">
                            <label>Outgoing Mail Port</label>
                            <input type="text" class="form-control" required="" value="{{ $site->notification_email_port }}" name="notification_email_port" placeholder="465" data-parsley-id="9">
                        </div>						
                        <div class="form-group float-right">
                            <div>						
                                <button type="submit" class="btn btn-default waves-effect waves-light">
                                    Test Connection
                                </button>								
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
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

@section('scripts')
@endsection