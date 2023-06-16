@extends('layouts.app')

@section('title')
<title>SEO Tools</title>
@endsection

@section('styles')
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
                    <li class="active"><a href="#">SEO Tools</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Page Authority Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Domain Authority Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Keywords Suggestion Tool</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div> 
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Broken Links Finder</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>   
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Google Cache Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>     
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Code to Text Ratio Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>   
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Mozrank Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Keyword Density Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Alexa Rank Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Backlink Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>   
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Keyword Position Checker</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>  
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Meta Tags Analyzer</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
            </div>
            <img class="img-fluid" src="http://placeimg.com/640/360/any" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>     
</div>

@endsection

@section('scripts')
@endsection