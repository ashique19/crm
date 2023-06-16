@extends('layouts.app')

@section('title')
<title>Messages</title>
@endsection

@section('styles')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/css/apps/mailing-chat.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
@endsection

@section('breadcrumb')
<div class="page-header">
    <div class="page-title">
        <h3>Messages</h3>
        <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
                <li><a href="{{ route('account.dashboard') }}"><i class="flaticon-home-fill"></i></a></li>
                <li class="active"><a href="#">Messages</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="chat-section layout-spacing">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-xl-4 col-lg-5 col-md-5">
                                            <div class="status-list-section pr-md-4">
                                                <div class="mb-5 pb-4 search-form">
                                                    <form class="form-inline">
                                                        <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search">
                                                    </form>
                                                </div>

                                                <ul class="list-unstyled">
                                                    <li class="media online pb-4 pt-4">
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-1">Kara Young</h5>
                                                            <p class="usr-status">online</p>
                                                        </div>
                                                        <span class="message-badge single-value">6</span>
                                                        <img class="ml-3" src="{{ asset('assets/img/profile-2.jpeg') }}" alt="Generic placeholder image">
                                                    </li>
                                                    <li class="media offline pb-4 pt-4">
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-1">Andy King</h5>
                                                            <p class="usr-status">30 min ago</p>
                                                        </div>
                                                        <span class="message-badge">10</span>
                                                        <img class="ml-3" src="{{ asset('assets/img/profile-3.jpeg') }}" alt="Generic placeholder image">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-xl-8 col-lg-7 col-md-7">
                                            <div class="mail-chat-system">
                                                <div class="chat_window">
                                                    <div class="row top_menu">
                                                        <div class="col-md-12 add-chat">
                                                            <button class="btn btn-gradient-warning btn-rounded"><i class="flaticon-chat-fill-1"></i> New Chat</button>
                                                            <div class="options float-xl-right float-md-left float-sm-right d-block">
                                                                <i class="flaticon-settings-7 mt-xl-0 mt-md-3 mt-sm-0 mt-3"></i>
                                                                <i class="flaticon-email-fill  mt-xl-0 mt-md-3 mt-sm-0 mt-3"></i>
                                                                <i class="flaticon-copy-document  mt-xl-0 mt-md-3 mt-sm-0 mt-3"></i>
                                                                <i class="flaticon-delete-can-fill-2  mt-xl-0 mt-md-3 mt-sm-0 mt-3"></i>
                                                                <i class="flaticon-share-4  mt-xl-0 mt-md-3 mt-sm-0 mt-3"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="chat-messages pl-0"><div class="message left appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">Hello Marry! :)</div>
                                                        </div>
                                                    </div><div class="message right appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">Hi John! How are you?</div>
                                                        </div>
                                                    </div><div class="message left appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">I'm fine and u</div>
                                                        </div>
                                                    </div><div class="message right appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">Me too</div>
                                                        </div>
                                                    </div><div class="message left appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">How is the project coming along?</div>
                                                        </div>
                                                    </div><div class="message right appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">Project has been already finished and I have results to show you.</div>
                                                        </div>
                                                    </div><div class="message left appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">Have you faced any problems at the last phase of the project?</div>
                                                        </div>
                                                    </div><div class="message right appeared">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text">Actually everything was fine. I'm very excited to show this to our team.</div>
                                                        </div>
                                                    </div></ul>
                                                    <div class="chat-bottom-section clearfix">

                                                        <div class="input-group mb-3 message_input_wrapper">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-link-2"></i></span>
                                                                <span class="input-group-text"><i class="flaticon-happy-smiling"></i></span>
                                                            </div>
                                                            <input type="text" class="message_input form-control" placeholder="Type here...">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text br-0"><i class="flaticon-send-fill-1"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message_template d-none">
                                                    <div class="message">
                                                        <div class="avatar"></div>
                                                        <div class="text_wrapper">
                                                            <div class="text"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
