@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/revolution/revolutionslider.css') }}">
@endsection

@section('splash')
    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.components.splash')
    @endif

@endsection

@section('content')

    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.home')
    @endif

@endsection

@section('scripts')

<!--Revolution SLider-->
<script src="{{ URL::asset('assets/plugins/revolution/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/revolution/extensions/revolution.extension.video.min.js') }}"></script>

<script>

   /*animated elements hero banner*/
   $("#rev_single").show().revolution({
      sliderType: "hero",
      jsFileLocation: "js/revolution",
      sliderLayout: "fullscreen",
      scrollbarDrag: "true",
      dottedOverlay: "none",
      delay: 9000,
      navigation: {},
      responsiveLevels: [1240, 1024, 778, 480],
      visibilityLevels: [1240, 1024, 778, 480],
      gridwidth: [1170, 1024, 778, 480],
      gridheight: [868, 768, 960, 720],
      lazyType: "none",
      parallax: {
         type: "scroll",
         origo: "slidercenter",
         speed: 400,
         levels: [10, 15, 20, 25, 30, 35, 40, -10, -15, -20, -25, -30, -35, -40, -45, 55]
      },
      shadow: 0,
      spinner: "off",
      autoHeight: "off",
      fullScreenAutoWidth: "off",
      fullScreenAlignForce: "off",
      fullScreenOffsetContainer: "",
      disableProgressBar: "on",
      hideThumbsOnMobile: "off",
      hideSliderAtLimit: 0,
      hideCaptionAtLimit: 0,
      hideAllCaptionAtLilmit: 0,
      debugMode: false,
      fallbacks: {
         simplifyAll: "off",
         disableFocusListener: false
      }
   });

   </script>


@endsection
