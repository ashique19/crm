<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        @yield('title')
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="ajax_url" content="{{ url('/') }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <link rel="canonical" href="{{ url()->current() }}" />
        <!-- App css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        @if(!Request::is('account/*'))
        <link href="{{ asset('assets/css/frontend.css') }}" rel="stylesheet" type="text/css" />
        @endif

        <link href="{{ asset('assets/css/skins/'.strtolower(Config::get('app.name')).'.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/color.css') }}" rel="stylesheet" type="text/css" />


        @if(Auth::user())
            <style>
                #topnav .topbar-main {
                    background: none;
                }
                #topnav .has-submenu.active > a, #topnav .submenu .active .active > a, #topnav .navigation-menu > li > a:active, #topnav .navigation-menu > li > a:hover {
                    color: var(--white-color) !important;
                }
#topnav .navigation-menu > li > a {
    color: var(--white-color);
}
.topbar-custom .nav-link {
    color: var(--white-color);
}
.topbar-custom .nav-link {
    line-height: 40px;
    margin-top: 15px;
}

.footer {
    background: var(--grey-color) !important;
    color: var(--dark-color) !important;
}

.footer a {
    color: var(--dark-color) !important;
}
            </style>
        @endif

        @yield('styles')

        @if(setting('site.google_analytics_tracking_id'))
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
            ga('create', '{{ setting('site.google_analytics_tracking_id') }}', 'auto');
            ga('send', 'pageview');
        </script>
        @endif

    </head>
    <body>
        <!-- Loader -->
        <div id="preloader">
            <div id="status"><div class="spinner"></div></div>
        </div>

        <div class="header-bg">
            <!-- Navigation Bar-->
            @guest
                @include('layouts.partials._navigation')
            @else
                @include('layouts.partials._navigation_account')
            @endguest
            <!-- End Navigation Bar-->

            <div class="container-fluid">
                @yield('breadcrumb')
                @yield('topcontent')
            </div>
        </div>

        @yield('splash')

        @yield('map')


        <div class="wrapper">
            <div class="container-fluid">

            @include('flash::message')
            @yield('content')
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        @yield('cta')

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="logo mb-3">
                            <a href="/" class="logo"><img src="@if(!Auth::user()){{ asset('assets/images/sites/'.strtolower(Config::get('app.name')).'/'.strtolower(Config::get('app.name')).'.png') }}
        @else{{ asset('assets/images/sites/'.strtolower(Config::get('app.name')).'/'.strtolower(Config::get('app.name')).'.png') }}
        @endif" alt="{{ strtolower(Config::get('app.name')) }}" height="50"></a>
                        </div>
                        <p> {{ setting('site.footer.description') }}
                        </p>

                    </div>

                    <div class="col-md-5">
                        <h4 class="m-t-0 header-title">For {{ lang('client_type_name') }}</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="list-unstyled col-md-12 col-xs-12">
                                    <li><a href="{{ route('features') }}">Features</a></li>
                                    <li><a href="{{ route('plans.index') }}">Pricing</a></li>
                                    <li><a href="{{ route('designs') }}">Designs</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="list-unstyled col-md-12 col-xs-12">
                                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                                    <li><a href="{{ route('about_us') }}">About Us</a></li>
                                    <li><a href="{{ route('blog') }}">Blog</a></li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul class="list-unstyled col-md-12 col-xs-12">
                                    <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                                    <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('acceptable_use_policy') }}">Acceptable Use</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <h4 class="m-t-0 header-title">Contact Us</h4>
                        <hr>
                        <ul class="list-unstyled col-md-12 col-xs-12">
                						{{--<li>2nd Ave Ne <br>
                						St. Petersburg, Florida 33701</li>--}}
                            <li><a href="{{ route('contact') }}">Send Message</a></li>
                        </ul>
                         <div class="icon-demo-content">
                            <ul class="nav justify-content-center">
                                @if(setting('site.social.facebook'))
                                    <li class="m-1"><a href="https://facebook.com/{{ setting('site.social.facebook') }}" class="text-primary"><i class="fa fa-facebook-square"></i></a></li>
                                @endif
                                @if(setting('site.social.twitter'))
                                    <li class="m-1"><a href="https://twitter.com/{{ setting('site.social.twitter') }}" class="text-primary"><i class="fa fa-twitter-square"></i></a></li>
                                @endif
                                @if(setting('site.social.linkedin'))
                                    <li class="m-1"><a href="https://linkedin.com/company/{{ setting('site.social.linkedin') }}" class="text-primary"><i class="fa fa-linkedin"></i></a></li>
                                @endif
                            </ul>
                            {{--<ul class="nav justify-content-center">
                                @if(setting('site.social.vimeo'))
                                    <li class="m-1"><a href="https://vimeo.com/{{ setting('site.social.vimeo') }}" class="text-primary"><i class="fa fa-vimeo-square"></i></a></li>
                                @endif
                                @if(setting('site.social.youtube'))
                                    <li class="m-1"><a href="https://youtube.com/channel/{{ setting('site.social.youtube') }}" class="text-primary"><i class="fa fa-youtube-square"></i></a></li>
                                @endif
                            </ul>--}}
                        </div>
                    </div>
                </div>
            </div>
        </footer>

<!-- End Footer -->


<!-- Footer -->
<footer class="footer-secondary">
    © Copyright 2013- {{ date('Y') }}. All Rights Reserved.
</footer>

<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
<!--Equal-Heights-->
<script src="{{ URL::asset('assets/js/jquery.matchHeight-min.js') }}"></script>

<!--Parallax Background-->
<script src="{{ URL::asset('assets/js/parallaxie.js') }}"></script>

<!--WOw animations-->
<script src="{{ URL::asset('assets/js/wow.min.js') }}"></script>


<!-- Below scripts have bug code -->
<script src="{{ URL::asset('assets/js/functions.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="https://chat.macrocreative.com/chat_widget.js?color={{ setting('site.color.primary') }}"></script>
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c6f372e53c93ca3"></script>

@yield('scripts')

</body>
</html>
