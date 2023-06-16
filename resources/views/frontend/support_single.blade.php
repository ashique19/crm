@extends('layouts.app')

@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:type" content="website" />
@endsection

@section('splash')
<!--Page Header-->
<section class="pt-5 pb-5 support-header">
    <div class="container-fluid">
        <div class="row">
		    <div class="container">
				<div class="col-md-8 offset-md-2 page-content text-center pt-3">
					<h2>How can we help you today?</h2>
					<div class="finderform">
						<form action="{{ route('knowledge_base_search') }}" method="post" name="knowledge_base_search">
                            {{ csrf_field() }}
                            <div class="cta input-group mb-3 margin-top-30">
                                <input type="hidden" name="knowledgebase" value="knowledgebase">
                                <input type="text" class="form-control" name="term" id="term" placeholder="Search Knowledgebase" value="@if(isset($term)) {{ $term }} @endif">

                                <div class="input-group-append">
                                    <button type="submit" name="action" class="btn-common btn-secondary wow fadeInUp cta_updateBtn animated animated animated" style="visibility: visible;">Search</button>
                                </div>
                            </div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
</section>
@endsection

@section('content')


<section id="blog" class="topics  margin-top-30">
   <h3 class="d-none">hidden</h3>
   <div class="container">
      <div class="row padding-bottom-15">

            <!-- Post Content -->
            <div class="col-lg-9 col-md-9">

                <!-- Blog Post -->
                <div class="topics-wrapper border-style">
                    <h3><a href="#"><span class="fa fa-folder-o text-red"></span> {{ $post->title }}</a></h3>
                    <ul class="topics-list">
                      {!! $post->content !!}</li>


                </div>
                <!-- Blog Post / End -->
                <a href="{{ route('knowledge_base') }}" class="btn btn-secondary btn-md"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Go back to all topics</a>

            </div>
            <div class="col-md-3 page-content text-center contact-page">
                @include('frontend.support_sidebar')
            </div>
            <!-- Content / End -->
        </div>
    </div>
</div>

@endsection
