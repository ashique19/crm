@extends('layouts.app')

@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="{{ seo('description') }}">
    <meta property="og:type" content="website" /> 
@endsection

@section('content')

<div class="card">
    <div class="card-body">
            <div class="row">
                @foreach($jobs as $job)
                    <aside class="col-sm-12">

                        <div class="list-group filter-wrap mb-lg-4">

                            <article class="list-group-item">
                                <header class="filter-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_{{$loop->index}}" aria-expanded="true"
                                       class="">

                                        <h6 class="title"><i class="icon-action fa fa-chevron-down"></i> {{ $job->title }} </h6>
                                    </a>
                                </header>
                                <div class="filter-content collapse" id="collapse_{{$loop->index}}" style="">
                                    {!! $job->description !!}

                                    @if($job->goto)
                                        
                                            <a style="margin-top: 20px; margin-bottom: 20px;" target="_blank" href="{{ $job->goto }}" class="btn btn-success">@lang('saas.open_job')</a>
                                    @endif


                                </div> <!-- collapse -filter-content  .// -->
                            </article>

                        </div> <!-- card.// -->


                    </aside> <!-- col.// -->

                @endforeach
            </div> <!-- row.// -->
    </div>
</div>



@endsection
