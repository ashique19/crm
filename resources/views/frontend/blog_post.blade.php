@extends('layouts.app')

@section('title')
    <title>{{ $blog->title }}</title>
    <meta name="title" content="{{ $blog->title }}">
    <meta name="description" content="{{ $blog->meta_description }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ $blog->title }}" />
    <meta property="og:image" content="{{ url('/storage/blog/'.$blog->image) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}">
    <meta property="og:type" content="website" />
@endsection

@section('content')
<div class="row">

            <div class="col-md-9">
                        <div class="row">


                                                    <div class="col-md-12">
                                                        <div class="card mb-4 shadow shadow-lg--hover equalheight">

                                                            <div class="card-body">
                                                                <h4 class="card-title font-light mt-0 mb-0">{!! $blog->title !!}</h4>
                                                                                  <ul class="commment mb-2">
                     <li><a href="#."><i class="fa fa-calendar"></i> {{ date('F d, Y', strtotime($blog->created_at)) }}</a></li>
                  </ul>
                                                                <div class="card-text mb-4">

                                           <a href="{{url('/blog').'/'.$blog->slug}}"><img class="float-left mr-4 mb-3" src="{{ url('/storage/blog/'.$blog->image) }}" alt="{{$blog->title}}" height="200"></a>
  {!! $blog->content  !!}

</div>


                                                            </div>
                                                        </div>
                                                    </div>

                        </div>
              </div>

             <div class="col-md-3">
                @include('frontend.blog_sidebar')
             </div>


            </div> <!-- row.// -->


@endsection
