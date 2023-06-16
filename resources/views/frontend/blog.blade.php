@extends('layouts.app')
@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:description" content="{{ seo('description') }}">
    <meta property="og:type" content="website" />
@endsection

@section('splash')

<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>The {{ lang('client_type_name') }} Marketing Blog</h1>
      </div>
    </div>
  </div>
</div>

@endsection


@section('content')
<div class="row">

            <div class="col-md-9">
              <div class="row">
            @if(count($blogs) > 0)
                @foreach($blogs as $blog)
              <div class="col-md-6">
                <div class="card mb-4 shadow shadow-lg--hover equalheight">
                 <a href="{{url('/blog').'/'.$blog->slug}}"><img class="card-img-top img-fluid" src="{{ url('/storage/blog/'.$blog->image) }}" alt="{{$blog->title}}"></a>

                    <div class="card-body">
                        <a href="{{url('/blog').'/'.$blog->slug}}"><h4 class="card-title font-light mt-0">{!! $blog->title !!}</h4></a>
                      <ul class="commment">
                        <li><a href="#."><i class="fa fa-calendar"></i> {{ date('F d, Y', strtotime($blog->created_at)) }}</a></li>
                      </ul>
                      <div class="card-text mb-4">
                          {!! str_limit(strip_tags($blog->content), 300)  !!}

                      </div>

                          <a href="{{url('/blog').'/'.$blog->slug}}" class="readmore btn circle btn-primary effect btn-sm text-white mb-5">Read More</a>

                      </div>
                  </div>
              </div>

              @endforeach
            @else
            <h2>Search Results</h2>
            <div class="alert alert-danger col-12" role="alert">
                No Results Found.
            </div>
            @endif
              </div>
              @php
                $links = $blogs->links();
                $patterns = array();
                $patterns[] = '/'.$page.'\?page=/';
                $replacements = array();
                $replacements[] = '';
                echo preg_replace($patterns, $replacements, $links);
              @endphp
          </div>
         <div class="col-md-3">
            @include('frontend.blog_sidebar')
         </div>
    </div> <!-- row.// -->
@endsection