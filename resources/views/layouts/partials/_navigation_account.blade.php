            <header id="topnav">
                <div class="topbar-main">

                    <div class="container-fluid">

                        <a href="{{ route('account.dashboard') }}" class="navbar-brand float-left"><img src="{{ asset('assets/images/sites/'.strtolower(Config::get('app.name')).'/'.strtolower(Config::get('app.name')).'-white.png') }}" alt="{{ strtolower(Config::get('app.name')) }}" height="50"></a>

                        <div class="menu-extras topbar-custom">
                            <div id="navigation" class="mx-auto">
                                <!-- Navigation Menu-->
                                <ul class="navigation-menu float-left ml-5 mt-1">
                                    <li class="has-submenu">
                                        <a href="{{ route('account.dashboard') }}"><i class="fa fa-desktop"></i>Dashboard</a>
                                    </li>


                                    @if(isset(Auth::user()->website->id))
                                    <li class="has-submenu">
                                        <a href="#"><i class="fa fa-suitcase"></i>Manage Website <i class="fa fa-chevron-down"></i></a>
                                        <ul class="submenu">

                                                <li><a href="{{ route('account.sitebuilder.site', ['website_id' => Auth::user()->website->id ]) }}">Sitebuilder</a></li>
                                                <li><a href="{{ route('account.website.blog') }}">Manage Blog</a></li>
                                                <li><a href="{{ route('account.website.settings.site') }}">Site Settings</a></li>
                                                <li><a href="{{ route("account.website.leads") }}">Leads</a></li>                                                    

                                        </ul>
                                    </li>
                                    @else
                                        <li class="has-submenu">
                                            <a href="{{ route("account.website.wizard") }}"><i class="fa fa-suitcase"></i>Manage Website</a>
                                        </li>
                                    @endif

                                <li class="has-submenu">
                                    <a href="#"><i class="fa fa-list-alt"></i>Appointments <i class="fa fa-chevron-down"></i></a>
                                    <ul class="submenu megamenu">
                                        <li>
                                        <ul>
                                            <li>
                                                <a href="{{ route("account.appointments.overview") }}">View Appointments</a>
                                            </li>
                                            <li>
                                                <a href="{{ route("account.appointments.calendar") }}">View Calendar</a>
                                            </li>
                                            <li>
                                                <a href="{{ route("account.appointments.scheduler") }}">Scheduler</a>
                                            </li>
                                        </ul>
                                        </li>
                                        <li>
                                        <ul>
                                            <li>
                                                <a href="{{ route("account.appointments.availability") }}">Manage Availability</a>
                                            </li>                                        
                                            <li>
                                                <a href="{{ route("account.appointments.services") }}">Manage Services</a>
                                            </li>
                                            <li>
                                                <a href="{{ route("account.appointments.reviews") }}">Reviews</a>
                                            </li>
                                        </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="{{ route("account.email.index") }}"><i class="fa fa-desktop"></i>Email</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="{{ route("account.download.index") }}"><i class="fa fa-desktop"></i>Downloads</a>
                                </li>

                                </ul>
                            </div>

                            <ul class="list-inline float-right mb-0">

                                <!-- User-->
                                @if(Auth::user())
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user btn btn-secondary" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <span class="ml-1">{{ Auth::user()->name }} <i class="fa fa-chevron-down"></i> </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="{{ route("account.overview") }}"><i class="fa fa-user text-muted"></i> Manage Account</a>
                                        <a class="dropdown-item" href="{{ route('account.support.helpdesk') }}"><i class="fa fa-cog text-muted"></i> Support</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt text-muted"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endif
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
