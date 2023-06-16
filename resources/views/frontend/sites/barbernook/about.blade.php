@extends('layouts.app')
@section('title')
    <title>About Us | BarberNook</title>
    <meta name="title" content="About BarberNook">
    <meta name="description" content="BarberNook is a barber website and client management barber software. Check out a free demo of BarberNook Today to learn how to grow your barber client list!">
    <meta name="author" content="{{ env('APP_DOMAIN') }} ">
    <meta property="og:title" content="About BarberNook" />
    <meta property="og:image" content="{{ url('assets/images/features-1-1.jpg') }}" />
    <meta property="og:description" content="BarberNook is a barber website and client management barber software. Check out a free demo of BarberNook Today to learn how to grow your barber client list!">
    <meta property="og:type" content="website" />    
@endsection

@section('splash')
<section class="feature-style-two sec-pad pb-5 pt-5 content-background standard-cta">
    <div class="container">

    
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 text-center-md">
                <div class="about-box gradient-one">
                    <div class="inner">
                        <img src="{{ url('assets/images/features-1-1.jpg') }}" alt="BarberNook" class="img-fluid">
                    </div><!-- /.inner -->
                </div><!-- /.about-box -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="feature-content">
                    <h1 class="mb-1 font-light2">About BarberNook</h1>
                    <p>BarberNook is working with large barber institutions down to single barber providers to give them the ability to help their clients on-line, affordably and securely. Our extensive experience in this area, combined with our unique barber based technology and very affordable pricing makes us a natural choice to take your barber shop to the next level.</p>
                    <div class="text-center shadow1 pt-3 pb-3"><a href="{{ route('plans.index') }}" class="btn circle btn-primary effect mr-3 btn-md">Get Started</a><a href="{{ route('designs') }}" class="btn circle btn-secondary  effect btn-md">View Portfolio</a></div>
                </div><!-- /.feature-content -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->         
        
      
        
        
    </div><!-- /.container -->
</section> 
@endsection

@section('content')

      
 <section class="pt-5 pb-3 about-area bg-gray default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 default info">
                    <h2 class="mb-1 font-light2">The Software Platform<br>Designed for Barbers</h2>
                    <p>
                        You may have a specialty or strength that could help people all over the planet. But in order to help them, you need a few things. They need to be able to find you, interact with you, schedule with you and pay you. That requires a significant technology investment and the use of technology that isn’t widely available; until now.
                    </p>
                    <a href="{{ route('plans.index') }}" class="btn circle btn-primary effect btn-md">Click Here To Get Started</a>
                    <div class="bottom-info">
                        <h3 class="mb-1">Why Choose Us</h3>
                        <ul>
                            <li>
                                <i class="fa fa-check"></i> <span>Powerful Tools for One Low Monthly Fee</span>
                            </li>
                            <li>
                                <i class="fa fa-check"></i> <span>Risk Free - Money-Back Guarantee</span>
                            </li>
                            <li>
                                <i class="fa fa-check"></i> <span>Friendly 24/7 Client Support</span>
                            </li>
                            <li>
                                <i class="fa fa-check"></i> <span>No Contracts, Cancel Anytime</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 services-info">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 equal-height">
                            <div class="item">
                                <i class="fa fa-video-camera icon-font"></i>
                                <h4 class="mb-2">Web-Cam Consulting</h4>
                                <p>
                                    Meet with your barber clients face-to-face using our built-in secure web-cam system 
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 equal-height">
                            <div class="item">
                                <i class="fa fa-wechat icon-font"></i>
                                <h4 class="mb-2">Instant messaging</h4>
                                <p>
                                    Message your barber clients by using the integrated secure messaging system.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 equal-height ">
                            <div class="item">
                                <i class="fa fa-smile-o icon-font"></i>
                                <h4 class="mb-2">Enjoy the Convenience</h4>
                                <p>
                                    All tools are designed with you in mind, are easy to use and require no prior technical knowledge. 
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 equal-height ">
                            <div class="item">
                                <i class="fa fa-expand icon-font"></i>
                                <h4 class="mb-2">Expand Your Footprint</h4>
                                <p>
                                    Leverage technology to expand your barber shop outside of your local market. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>      
    
    
<section class="feature-style-two sec-pad pb0 pt-5 pb-5">
    <div class="container">         
        
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 pull-right text-right">
                <div class="about-box gradient-two">
                    <div class="inner">
                        <img src="{{ url('assets/images/features-1-2.jpg') }}" alt="BarberNook" class="img-fluid">
                    </div><!-- /.inner -->
                </div><!-- /.about-box -->
            </div><!-- /.col-md-6 -->           
            <div class="col-md-6 col-sm-12 col-xs-12 pull-right">
                <div class="feature-content">
                    <h3 class="font-light2 mb-2">Our Mission</h3>
                    <p>BarberNook's mission is to give you the tools you need to succeed. Designed to work with individuals and larger shops seeking to expand their services on-line, the system gives you everything you need; seamless integration with your web site, on-line scheduling, triage functionality for new barber clients, provider selection, different on-line payment options; a whole suite of systems such as synchronous and asynchronous chat that can help you take your shop to the next level.</p>
                    <a href="{{ route('features') }}" class="btn circle btn-primary effect btn-md">See All Features</a>
                </div><!-- /.feature-content -->
            </div><!-- /.col-md-6 -->         
        </div><!-- /.row -->      
        
        
    </div><!-- /.container -->
</section>    


<section class="pb-5">
   <div class="container">
   

      <div class="icon_wraper row">
         <div class="col-md-6 col-sm-6 wow fadeIn">
           <div class="text-center mt-5">
              <i class="fa fa-keyboard-o icon-font"></i>
            <h4 class="text-capitalize darkcolor pb-2 m-1">Leverage Technology</h4>
            <p class="no_bottom">Over the next few years the way barber communicate with their clients and potential clients will change dramatically. This will have profound implications for the future of your business. Organizations that take advantage of the new paradigm will thrive and those that don’t will wither.</p>
           </div>
         </div>
         <div class="col-md-6 col-sm-6 wow fadeIn">
           <div class="text-center mt-5">
              <i class="fa fa-video-camera icon-font"></i>
            <h4 class="text-capitalize darkcolor pb-2 m-1">Offer Online Counseling</h4>
            <p class="no_bottom">Our barber website's video conferencing tool allows you to play to your strengths; building close, personal relationships with your barber clients without spending half the day stuck in traffic. Our platform has made it easier than ever to meet with your barber clients face-to-face. We integrated the ability right into your barber website.</p>
           </div>
         </div>
         <div class="col-md-6 col-sm-6 wow fadeIn">
           <div class="text-center mt-5">
              <i class="fa fa-users icon-font"></i>
            <h4 class="text-capitalize darkcolor pb-2 m-1">Clients <strong>LOVE</strong> the convenience</h4>
            <p class="no_bottom">Nothing beats an in-person meeting with your client to solidify and build the relationship, but either you or the  barberclient has to invest significant time and hassle to make it happen. Now with BarberNook consutling tool, it is easy.</p>
           </div>
         </div>
         <div class="col-md-6 col-sm-6 wow fadeIn">
           <div class="text-center mt-5">
              <i class="fa fa-expand icon-font"></i>
            <h4 class="text-capitalize darkcolor pb-2 m-1"><strong>Expand</strong> your footprint</h4>
            <p class="no_bottom">Expand your barber shop's footprint. By introducing online webcam consulting as an option to your barber shop, you can grow your barber client base exponentially. Even far-flung barber clients can have the same close, personal relationship as your local clients.</p>
           </div>
         </div>        
      </div>
   </div>
</section> 



@endsection