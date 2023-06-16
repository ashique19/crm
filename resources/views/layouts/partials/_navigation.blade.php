            <header id="topnav">
                <div class="topbar-main fixed-top">

                    <div class="container-fluid">

                        <a href="{{ route('home') }}" class="navbar-brand float-left mt-2"><img src="{{ asset('assets/images/sites/'.strtolower(Config::get('app.name')).'/'.strtolower(Config::get('app.name')).'-white.png') }}" alt="{{ strtolower(Config::get('app.name')) }}" height="50"></a>

                        <div class="menu-extras topbar-custom">
                            <div id="navigation" class="mx-auto">
                                <!-- Navigation Menu-->
                                <ul class="navigation-menu float-left ml-5 mt-2">
                                    <li class="has-submenu">
                                        <a href="{{ route('features') }}">Features</a>
                                    </li>

                                <li class="has-submenu">
                                    <a href="{{ route('plans.index') }}">Pricing</a>
                                </li>              

                                <li class="has-submenu">
                                    <a href="{{ route('designs') }}">Designs</a>
                                </li>                                       


                                <li class="has-submenu">
                                    <a href="#">Resources <i class="fa fa-chevron-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('about_us') }}" class="dropdown-item">About Us</a></li>    
                                        <li><a href="{{ route('faq') }}" class="dropdown-item">FAQ</a></li>
                                        <li><a href="{{ route('contact') }}" class="dropdown-item">Contact</a></li>
                                    </ul>
                                </li>    

                                <li class="has-submenu">
                                    <a href="{{ route('blog') }}">Blog</a>
                                </li>    
                                <li class="has-submenu">
                                    <a href="{{ route('login') }}">Login</a>
                                </li>                                    

                                <li class="has-submenu d-md-none">
                                    <a href="{{ route('knowledge_base') }}">Support</a>
                                </li>   

                                
                                                       
                                </ul>
                            </div>
                            
                            <ul class="list-inline float-right mb-0 d-none d-xl-block">

                                <!-- notification-->
                                <li class="list-inline-item nav-right-link">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" href="{{ route('knowledge_base') }}" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <i class="fa fa-life-ring" aria-hidden="true"></i> Support
                                    </a>
                                </li>
                                <li class="list-inline-item nav-right-link">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" href="{{ route('plans.index') }}" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        Get Started <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </li>                                
                            </ul>
 
                            <ul class="list-inline float-right mb-0"> 
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>                            
                            </ul>                            
                            
                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->


            </header>
            <!-- End Navigation Bar-->