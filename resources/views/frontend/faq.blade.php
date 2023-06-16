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
        <h1>Frequently Asked Questions</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')


            <div class="row">


<div class="faq_content col-md-12 pt-3 pb-3">
                <h1 class="d-none">Frequently Asked Questions</h1>
               <ul class="items">
                @foreach($faqs as $category => $rows)
                        @foreach($rows as $row)
                  <li class="wow fadeIn" data-wow-delay="400ms"><a href="javascript:void(0)">{{ $row->title  }}</a>
                     <ul class="sub-items">

                        <li>
                           <p> {!!  $row->description !!}</p></li>
                     </ul>
                  </li>
                                          @endforeach
                  @endforeach
               </ul>
            </div>

            </div> <!-- row.// -->




@endsection
