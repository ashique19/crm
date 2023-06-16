@extends('layouts.app')

@section('title')
<title>Website Settings</title>
@endsection

@section('styles')
<link href="{{ asset('assets/css/ui-kit/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/modules/modules-card.css') }}">
<style type="text/css">
    
    .window{
        margin-bottom: 20px;
    }

    .elements .window{
        margin-bottom: 10px;
    }

    .window .top{
        height: 34px;
        background: #E1E0E0;
    }

    .window .top .buttons{
        float: left;
        height: 13px;
        margin-top: 12px;
        margin-left: 10px;
    }

    .window .top .buttons > *{
        border-radius: 10px;
        display: block;
        float: left;
        height: 10px;   
        margin-right: 6px;
        width: 10px;
    }

    .window .top .buttons .red{
        background: #e74c3c;
    }

    .window .top .buttons .yellow{
        background: #f4a62a;
    }

    .window .top .buttons .green{
        background: #16a085;
    }

    .window .top b{
        float: right;
        margin-right: 14px;
        line-height: 34px;
        height: 34px;
        text-overflow: ellipsis;
        max-width: 70%;
        overflow: hidden;
        white-space: nowrap;
    }

    .window .viewport{
        height: auto;
        width: 100%;
    }

    .window .viewport > img{
        width: 100%;
    }

    .window .viewport iframe{
        width: 100%;
        border: 0px;
    }

    .window .viewport .placeHolder{
        height: auto;
        text-align: center;
        padding: 70px 0px;
        display: block;
        color: #34495e;
        font-weight: 200;
    }

    .window .viewport .placeHolder:hover{
        color: #1ABC9C;
        font-weight: 400;
    }

    .window .viewport .placeHolder span{
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 15px;
    }

    .window .bottom{
        height: 16px;
        background: #E1E0E0;
    }
    .sites .site .siteLink{
        height: 27px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
</style>
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="#">Website Settings</a> </li>
                </ul>
            </div>
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Website Settings</h4>
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
             <form class="" action="{{ route('account.website.sitesetting.store') }}" method="post" novalidate="" enctype="multipart/form-data">
                <div id="user-profile-card-3" class="card br-4">
                    @csrf()
                    <input type="hidden" name="site_id" value="{{ $site[0]['siteData']['id'] }}">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="mt-2">Website Settings</h6>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subdomain</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="subdomain" name="subdomain" id="datepicker-multiple-date" value="{{ $site[0]['siteData']['subdomain'] }}" disabled>
                                            <div class="input-group-append">
                                               <span class="input-group-text">.psychnook.com</span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="choose_logo">Site Logo</label>
                                    <input type="file" name="logo" class="filestyle" data-buttonname="btn-secondary" id="choose_logo">
                                    @if($site[0]['siteData']['logo'])
                                        <img src="{{ url('storage/site/logo/'.$site[0]['siteData']['logo']) }}" id="choose_logo_preview" width="100px">
                                    @else
                                        <img src="" id="choose_logo_preview" width="100px">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="choose_favicon">Upload your Site favicon</label>
                                    <input type="file" name="favicon" class="filestyle" id="choose_favicon" data-input="false" data-buttonname="btn-secondary">
                                    @if($site[0]['siteData']['favicon'])
                                        <img src="{{ url('storage/site/favicon/'.$site[0]['siteData']['favicon']) }}" width="100px" id="choose_favicon_preview">
                                    @else
                                        <img src="" id="choose_favicon_preview" width="100px">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Current Theme</label>
                                    <select class="form-control" name="theme_id">
                                        <option>Select</option>
                                        @if($site[0]['themes'])
                                            @foreach($site[0]['themes'] as $theme)
                                            <option value="{{ $theme->id }}" {{ $site[0]['siteData']['theme_id']==$theme->id?'selected':'' }}>{{ $theme->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Site Title</label>
                                    <input type="text" name="website_name" class="form-control" required="" placeholder="Type something" value="{{ $site[0]['siteData']['website_name'] }}">
                                </div>
                            </div>
                            <div class="col-md-6">                      
                                <div class="site" data-name="{{ $site[0]['siteData']['user']['name'] }}" data-pages="{{ $site[0]['nrOfPages'] }}" data-created="{{ date('Y-m-d', strtotime($site[0]['siteData']['created_at'])) }}" data-update="{{ date('Y-m-d', strtotime($site[0]['siteData']['updated_at'])) }}" id="site_{{ $site[0]['siteData']['id'] }}">
                                    <div class="window">
                                        <div class="top">
                                            <div class="buttons clearfix">
                                                <span class="left red"></span>
                                                <span class="left yellow"></span>
                                                <span class="left green"></span>
                                            </div>
                                            <b>{{ $site[0]['siteData']['website_name'] }}</b>
                                        </div><!-- /.top -->

                                        <div class="viewport">
                                            @if( $site[0]['lastFrame'] != '' )
                                            <div class="embed-responsive embed-responsive-16by9">
                                              <iframe class="embed-responsive-item" src="{{ route('account.sitebuilder.getframe', ['frame_id' => $site[0]['lastFrame']['id']]) }}" data-height="500" data-siteid="{{ $site[0]['siteData']['id'] }}"></iframe>
                                            </div>
                                            @else
                                            <a href="{{ route('account.sitebuilder.site', ['site_id' => $site[0]['siteData']['id']]) }}" class="placeHolder">
                                                <span>This site is empty</span>
                                            </a>
                                            @endif
                                        </div><!-- /.viewport -->

                                        <div class="bottom"></div><!-- /.bottom -->
                                    </div><!-- /.window -->

                                    <div class="siteDetails">
                                        <p>
                                            Owner: <b>{{ $site[0]['siteData']->user->name }}</b>, {{ $site[0]['nrOfPages'] }} Page(s)<br>
                                            Created on: <b>{{ date('Y-m-d', strtotime($site[0]['siteData']['created_at'])) }}</b><br>
                                            Last edited on: <b>{{ date('Y-m-d', strtotime($site[0]['siteData']['updated_at'])) }}</b>
                                        </p>

                                        <p class="siteLink">
                                            @if( $site[0]['siteData']['ftp_published'] == 1 )
                                            @if( $site[0]['siteData']['remote_url'] != '' )
                                            <span class="fui-link"></span> <a href="{{ $site[0]['siteData']['remote_url'] }}" target="_blank">{{ $site['siteData']['remote_url'] }}</a>
                                            @else
                                            Site was published on {{ date('Y-m-d', strtotime($site[0]['siteData']['publish_date'])) }}
                                            @endif
                                            @else
                                            <span class="pull-left text-danger">
                                                <b>Site has not been published</b>
                                            </span> &nbsp;&nbsp;
                                            @if( $site[0]['siteData']['ftp_ok'] == 1 )
                                            <a class="btn btn-inverse btn-xs" href="{{ route('account.sitebuilder.site', ['site_id' => $site['siteData']['id']]) }}#publish">
                                                <span class="fui-export"></span> Publish Now
                                            </a>
                                            @endif
                                            @endif
                                        </p>

                                        <hr class="dashed light">

                                        <div class="clearfix">
                                            <a href="{{ route('account.sitebuilder.site', ['website_id' => $site[0]['siteData']['id']]) }}" class="btn btn-primary btn-embossed btn-block"><span class="fui-new"></span> Edit This Site</a>
                                        </div>
                                    </div><!-- /.siteDetails -->
                                </div><!-- /.site -->
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="widget-content widget-content-area h-100 br-4 p-0">
                    <div id="user-profile-card-3" class="card br-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6 class="mt-2">SEO Settings</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                           
                            <div class="form-group">
                                <label>Description Search Engines Should Use</label>
                                <div>
                                    <textarea required="" name="description" class="form-control" rows="5">{{ $site[0]['siteData']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keyword Phrases Search Engines Should Use (comma Separated)</label>
                                <div>
                                    <textarea required="" name="keywords" class="form-control" rows="5">{{ $site[0]['siteData']['keywords'] }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="choose_seo_image">Seo Image</label>
                                <input type="file" name="seo_image" id="choose_seo_image" class="filestyle" data-input="false" data-buttonname="btn-secondary">
                                @if($site[0]['siteData']['seo_image'])
                                    <img src="{{ url('storage/site/seo/'.$site[0]['siteData']['seo_image']) }}" width="100px" id="choose_seo_image_preview">
                                @else
                                    <img src="" id="choose_seo_image_preview" width="100px">
                                @endif
                            </div>
                            <div class="form-group float-right">
                                <div>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>									
                                </div>
                            </div>
                   
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#choose_favicon").change(function() {
          readURL(this,'choose_favicon_preview');
        });
        $("#choose_logo").change(function() {
          readURL(this,'choose_logo_preview');
        });
        $("#choose_seo_image").change(function() {
          readURL(this,'choose_seo_image_preview');
        });
    });
    function readURL(input,target_id) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#'+target_id).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
@endsection