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

@section('styles')
<link href="{{ URL('assets/plugins/cubeportfolio/cubeportfolio.min.css') }}" rel="stylesheet">
@endsection

@section('splash')
    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.components.gallery')
    @endif
@endsection

@section('content')


            <div id="gallery">

              <div id="projects" class="cbp">

                    @foreach($designs as $design)
                          <div class="cbp-item digital">
                              <img src="{{url($design->main_image)}}" alt="{!! $design->description !!}">
                              <div class="overlay center-block text-center">

                                  <h4>
                                                              <a href="{{ route('plans.index') }}" class="btn btn-md btn-secondary">Get Started</a></h4>
                                                      </div>
                          </div>
                    @endforeach
              </div>

            </div> <!-- row.// -->




@endsection

@section('scripts')
<script src="{{ URL('assets/plugins/cubeportfolio/jquery.cubeportfolio.min.js') }}"></script>
<script>
//Project Filter
$("#projects").cubeportfolio({
   layoutMode: 'grid',
   filters: '#project-filter',
   defaultFilter: '*',
   animationType: "quicksand",
   gapHorizontal: 30,
   gapVertical: 30,
   gridAdjustment: "responsive",
   mediaQueries: [{
      width: 1500,
      cols: 3
       }, {
      width: 1100,
      cols: 3
       }, {
      width: 800,
      cols: 3
       }, {
      width: 480,
      cols: 2
       }, {
      width: 320,
      cols: 1
       }],
});
</script>
@endsection
