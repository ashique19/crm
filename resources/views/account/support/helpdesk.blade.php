@extends('layouts.app')

@section('title')
<title>Support</title>
@endsection

@section('styles')
<style>
    .nav{
        display: inherit;
    }
    .cat_tabs li a.active{
        color: #fff !important;
        background-image: linear-gradient(-20deg, #fc6076 0%, #ff9a44 100%) !important;
        background-color: #ff9a44 !important;
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
                    <li class="active"><a href="#"> Support</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Support</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">
    <div class="col-3 mb-sm-0"> 
        <div class="card">  
            <div class="card-body">
            <!-- Nav tabs -->
                <ul class="list-unstyled nav cat_tabs" role="tablist">
                    @foreach($categories AS $key=>$category)
                        @if($category->knowledge_count)
                        <li class="">
                            <a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ $key==0?'active show':'' }}" data-toggle="tab" href="#{{ Str::slug($category->name,'-') }}{{ $category->id }}" role="tab" aria-selected="false">{{ $category->name }}</a>                    
                        </li>
                        @endif
                    @endforeach     
                        <li class="">
                            <a class="nav-link btn btn-block btn-rounded mb-2 mt-3 btn-gradient-default" data-toggle="tab" href="#contactus" role="tab" aria-selected="false">Contact Us</a>                          
                        </li>        
                </ul>
            </div>
        </div>
    </div>
    <div class="col-9 mb-sm-0"> 
        <div class="card">  
            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($categories AS $key=>$category)
                        <div class="tab-pane p-3 {{ $key==0?'active show':'' }}" id="{{ Str::slug($category->name,'-') }}{{ $category->id }}" role="tabpanel">                    
                            <div class="accordion" id="hd-statistics{{$key}}">
                                @foreach($knowledgebase AS $kb)
                                    @if($kb->category_id == $category->id)
                                    <div class="card">
                                        <div class="card-header" id="hd-statistics-{{$category->id}}">
                                          <div class="mb-0">
                                            <div class="" data-toggle="collapse" data-target="#collapse-hd-statistics-{{$category->id}}" aria-expanded="true" aria-controls="collapse-hd-statistics-1">
                                              {{ $kb->title }}
                                            </div>
                                          </div>
                                        </div>
                                        <div id="collapse-hd-statistics-{{$category->id}}" class="collapse show" aria-labelledby="hd-statistics-{{$category->id}}" data-parent="#hd-statistics{{$key}}">
                                          <div class="card-body">
                                            <p>{{ $kb->content }}</p>
                                          </div>
                                        </div>
                                    </div>                                    
                                    @endif
                                @endforeach
                            </div>      
                        </div>                          
                    @endforeach    
                    <div class="tab-pane p-3" id="contactus" role="tabpanel">            
                        <div class="row">
                            <div class="col-xl-12 text-center mb-4">                       
                                <div class="hd-contact-header my-4">
                                    <h5>Submit Query</h5>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12 mx-auto">                                    
                                <form class="mt-4 mb-4" action="{{ route('account.support.submitquery') }}" method="POST">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                            <input type="text" class="form-control" placeholder="First name" id="first_name" name="first_name" value="{{ $user->first_name }}" required >
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <input type="text" class="form-control" placeholder="Last name" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-12 col-12">
                                            <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">                               
                                            <div class="form-group">
                                                <textarea class="form-control" id="message" rows="8" name="message" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">                                      
                                        <div class="col text-sm-left text-center">
                                            <button type="submit" class="btn btn-primary btn-rounded mt-4">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection