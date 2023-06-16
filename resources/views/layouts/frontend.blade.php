
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title>Landing Page HTML Template | Equation - Multipurpose Bootstrap Dashboard Template </title>
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
	<link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link href="plugins/sliders/owlCarousel/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sliders/owlCarousel/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="plugins/flaticon/style.css">
	<link rel="stylesheet" type="text/css" href="css/frontend.css">
</head>
<body>
	<div id="navHeadWrapper" class="navHeaderWrapper header-image">
		<!-- NavBar -->
		<!-- Brand -->
		<div class="">
			<nav class="navbar navbar-expand-lg bg-faded header-nav">
				<div class="container">

					<div class="col-xl-4 col-lg-3 col-6 mx-auto ">
						<a class="navbar-brand" href="#"><h4>Landing</h4></a>
					</div>

					<div class="col-6 text-right d-lg-none d-block">
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon flaticon-left-menu"></span>
						</button>
					</div>

					<div class="col-xl-8 col-lg-9">
						<!-- Links -->
						<div class="collapse navbar-collapse justify-content-end" id="nav-content">   
							<ul class="navbar-nav text-center mt-lg-0 mt-5">
								<li class="nav-item active">
						        	<a class="nav-link js-scroll-trigger" href="{{ route('features') }}">Features</a>
						      	</li>
						      	<li class="nav-item">
						        	<a class="nav-link js-scroll-trigger" href="{{ route('plans.index') }}">Pricing</a>
						      	</li>
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                                        Explore
                                    </a>
                                    <div class="dropdown-menu">
                                        <span class="dropdown-item dropdown-item-header">Resources</span>
                                        <a href="{{ route('case_studies') }}" class="dropdown-item">Case Studies</a>
                                        <a href="{{ route('faq') }}" class="dropdown-item">FAQ</a>

                                        <span class="dropdown-item dropdown-item-header">Company</span>
                                        <a href="{{ route('about_us') }}" class="dropdown-item">About Us</a>
                                        <a href="{{ route('testimonials') }}" class="dropdown-item">Testimonials</a>
                                        <a href="{{ route('careers') }}" class="dropdown-item">Careers</a>
                                        <a href="{{ route('contact') }}" class="dropdown-item">Contact</a>
                                    </div>
                                </li>                                
                                
							</ul>
							<form class="form-inline justify-content-lg-start justify-content-center mt-lg-0 mt-5">
						      	<a class="btn btn-primary btn-md ml-xl-4" href="{{ route('login') }}">Login</a>
						    </form>
						</div>
					</div>
				</div>
			</nav>
		</div>
		<!-- /NavBar -->
	</div>

        @yield('content')
	
		<!-- Footer -->
	<div id="footerWrapper" class="">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-7 mx-auto col-lg-12 col-md-12">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 site-content-inner text-md-left text-center copyright">
							<p class="mb-5"><span>Have a project?</span></p>
							<h2 class="">Get in touch <br/> with us</h2>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 site-content-inner text-md-right text-center">
							<form class="mb-4" action="javascript:void(0);">
	                            <div class="row mb-4">
	                                <div class="col-sm-6 col-12 mb-4 mb-sm-0">
	                                    <input type="text" class="form-control mb-4" placeholder="Name*">
	                                </div>
	                                <div class="col-sm-6 col-12">
	                                    <input type="text" class="form-control mb-4" placeholder="Email*">
	                                </div>
	                            </div>

	                            <div class="row mb-4">
	                                <div class="col-sm-12 col-12">
	                                    <input type="text" class="form-control mb-4" placeholder="Subject*">
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div class="col">	                                    
	                                    <div class="form-group">
	                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Message*"></textarea>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div class="col text-sm-left text-center">
	                                    <button class="btn btn-primary mt-4">Send Message</button>
	                                </div>
	                            </div>
	                        </form>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
	<!-- /Footer -->

	<!-- Mini Footer -->
	<div id="miniFooterWrapper" class="">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="position-relative">
						<div class="arrow text-center">
							<img alt="image-icon" src="assets/img/footer-arrow.svg" class="img-fluid">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-left text-center copyright align-self-center">
							<p class="mt-md-0 mt-4 mb-0">© 2019 Landing Page By <a href="index.html">Equation</a>.</p>
						</div>
						<div class="col-xl-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-right text-center align-self-center">
							<p class="mb-0">1355 Market Street, Suit 900 San Francisco, CA 94103</p>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
	<!-- /Mini Footer -->

	<script src="js/app.js"></script>    
</body>
</html>