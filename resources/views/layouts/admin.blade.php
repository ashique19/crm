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
        <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/css/skins/'.strtolower(Config::get('app.name')).'.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/color.css') }}" rel="stylesheet" type="text/css" />

        @yield('styles')

    </head>
    <body class="fixed-left">
        <!-- Loader -->
        <div id="preloader">
            <div id="status"><div class="spinner"></div></div>
        </div>

        <!-- Begin page -->
                <div id="wrapper">

                    <!-- ========== Left Sidebar Start ========== -->
                    <div class="left side-menu">

                        <!-- LOGO -->
                        <div class="topbar-left">
                            <div class="">
                                <a href="{{ route('admin.dashboard')}}" class="logo"><img src="{{ asset('assets/images/sites/'.strtolower(Config::get('app.name')).'/'.strtolower(Config::get('app.name')).'-white.png') }}" width="180" alt="logo"></a>
                            </div>
                        </div>

                        <div class="sidebar-inner slimscrollleft">
                            <div id="sidebar-menu">
                                <ul>

                                    <li class="menu-title">Main</li>

                                    <li>
                                        <a href="{{ route('admin.dashboard')}}" class="waves-effect"><i class="fa fa-home"></i><span> Dashboard </span></a>
                                    </li>

                                    <li>
                                        <a href="{{ route('admin.blog')}}" class="waves-effect"><i class="fa fa-file-text"></i><span> Blog </span></a>
                                    </li>

                                    <li>
                                        <a href="{{ route('admin.user')}}" class="waves-effect"><i class="fa fa-file-text"></i><span> Users </span></a>
                                    </li>

                                    @if(Auth::user()->id==1)
                                    <li class="has_sub">
                                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i> <span> Settings <span class="pull-right"><i class="fa fa-chevron-right"></i></span> </span> </a>
                                        <ul class="list-unstyled">
                                            <li><a href="{{ route('admin.settings.site')}}">Site Settings</a></li>
                                            <li><a href="{{ route('admin.settings.seo')}}">Seo Settings</a></li>
                                            <li><a href="{{ route('admin.settings.language')}}">Language Settings</a></li>
                                            <li><a href="{{ route('admin.settings.downloads')}}">Downloads</a></li>
                                            <li><a href="{{ route('admin.settings.knowledgebase')}}">KnowledgeBase</a></li>
                                            <li><a href="{{ route('admin.settings.categories')}}">Categories</a></li>
                                            <li><a href="{{ route('admin.settings.themes')}}">Themes</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end sidebarinner -->
                    </div>
                    <!-- Left Sidebar End -->


                    <!-- Start right Content here -->
                    <div class="content-page">
                        <!-- Start content -->
                        <div class="content">

                            <!-- Top Bar Start -->
                            <div class="topbar">

                                <nav class="navbar-custom">
                                    <!-- Search input -->
                                    <div class="search-wrap" id="search-wrap">
                                        <div class="search-bar">
                                            <input class="search-input" type="search" placeholder="Search" />
                                            <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                                                <i class="fa fa-window-close"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <ul class="list-inline float-right mb-0">

                                        <!-- User-->
                                        <li class="list-inline-item dropdown notification-list">
                                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                               aria-haspopup="false" aria-expanded="false">
                                                {{ Auth::user()->name }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                                <a class="dropdown-item" href="#"><i class="fa fa-cog text-muted"></i> Account</a>
                                                <div class="dropdown-divider"></div>
												<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-in text-muted"></i>  Logout</a>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                            </div>
                                        </li>
                                    </ul>

                                    <!-- Page title -->
                                    <ul class="list-inline menu-left mb-0">
                                        <li class="list-inline-item">
                                            <button type="button" class="button-menu-mobile open-left waves-effect">
                                                <i class="ion-navicon"></i>
                                            </button>
                                        </li>
                                        <li class="hide-phone list-inline-item app-search">
                                            <h3 class="page-title"></h3>
                                        </li>
                                    </ul>

                                    <div class="clearfix"></div>
                                </nav>

                            </div>
                            <!-- Top Bar End -->

                            <!-- ==================
                                 PAGE CONTENT START
                                 ================== -->

                            <div class="page-content-wrapper">

                                <div class="container-fluid">
                                  @yield('content')
                                </div>

                            </div> <!-- Page content Wrapper -->

                        </div> <!-- content -->

                        <footer class="footer">
                            © {{ date('Y') }}
                        </footer>

                    </div>
                    <!-- End Right content here -->

                </div>
                <!-- END wrapper -->

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
<script src="{{ asset('assets/js/admin.js') }}"></script>

@yield('scripts')

</body>
</html>
