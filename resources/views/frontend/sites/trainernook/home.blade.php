@extends('layouts.app')
@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:image" content="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/box-1.png') }}" />
    <meta property="og:description" content="{{ seo('description') }}">
    <meta property="og:type" content="website" />  
@endsection

@section('content')


<section class="section-bg-image bg-top margin-bottom-30 d-none d-lg-block">
        <div class="container content">
            <div class="row vertical-row">
                <div class="col-md-12 text-center integratations">
                <h1 class="d-none">TrainerNook Personal Trainer Software</h1>
                <span>Integrated with:</span><img src="{{ url('assets/images/logos/stripe.png') }}" alt="stripe"> <img src="{{ url('assets/images/logos/paypal.png') }}" alt="paypal"> <img src="{{ url('assets/images/logos/twitter.png') }}" alt="twitter"> <img src="{{ url('assets/images/logos/facebook.png') }}" alt="facebook"> <img src="{{ url('assets/images/logos/linkedin.png') }}" alt="linkedin">
                </div>
            </div>
             </div>
</section>

 <div class="section-bg-image bg-top pb-4 content-background">
        <div class="container content">
            <div class="row vertical-row pt-5">
                <div class="col-md-7">
                    <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/box-1.png') }}" alt="Integrated Online Booking" data-anima="" data-time="1000" class="fade-left img-fluid">
                </div>
                <div class="col-md-5">
                    <h4 class="mb-2 mt-4 pt-5">Integrated Online Personal Training Booking</h4>
                    <p>
                        Now you can offer the convenience of online booking right from your website. Manage your personal training appointments and even send automated personal training appointment reminders to your clients via email or text to help reduce missed personal training appointments.
                    </p>
                    <a href="{{ route('features') }}" class="btn circle btn-primary effect btn-md">View More Features</a>
                </div>
            </div>
            <div class="row vertical-row pt-5">
                <div class="col-md-6">
                    <h4 class="mb-2 mt-4">Grow Your Personal Training Website</h4>
                    <p>
                        Rank well on Google and other search engines with the built in personal trainer SEO tools and auditing systems designed to help you attract potential personal training clients to your personal trainer business website. In addition to our integrated tools, our support team is made up of SEO experts who specialize in personal training marketing and are always willing to extend you a hand to help you comprehend and enhance your search engine positioning for highly targeted personal training keywords.
                    </p>
                    <a href="{{ route('features') }}" class="btn circle btn-primary effect btn-md">View More Features</a><span class="space"></span>
                </div>
                <div class="col-md-6 order-first order-md-2">
                    <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/box-2.png') }}" alt="Grow Your Practice" data-anima="" data-time="1000" class="fade-right img-fluid">
                </div>
            </div>
        </div>
   <div class="container-fluid pt-5">
      <div class="row">
               <div class="col-md-12 col-sm-12 wow fadeIn text-center">
              <h4 class="heading mb-4">Tips from the TrainerNook Blog <span class="divider-left"></span></h4>
              </div></div>
      <div class="row">



      @if($popularPosts->count())
                @foreach($popularPosts as $post)
         <div class="col-lg-4 col-md-4">
            <div class="card wow fadeInUp equalheight" data-wow-delay="300ms">
                 <a href="{{url('/blog').'/'.$post->slug}}"><img class="card-img-top img-fluid" src="{{ url('/storage/blog/'.$post->image) }}" alt="{{$post->title}}"></a>
               <div class="card-body">
                  <h4><a href="{{url('/blog').'/'.$post->slug}}"> {{$post->title}}</a></h4>
                  <ul class="commment">
                     <li><a href="#."><i class="fa fa-calendar"></i> {{ date('F d, Y', strtotime($post->created_at)) }}</a></li>
                  </ul>
                  <p>{!! str_limit(strip_tags($post->content), 120)  !!}</p>
                  <a href="{{url('/blog').'/'.$post->slug}}" class="readmore btn circle btn-primary effect btn-sm text-white mb-5">Read More</a>
               </div>
            </div>
         </div>
                @endforeach
                @endif



      </div>
   </div>


   <div class="wrapper">
       <div class="container-fluid">

             <div class="row">
               <div class="col-md-12 col-sm-12 text-center">
              <h4 class="heading mb-4">More TrainerNook Features <span class="divider-left"></span></h4>
              </div></div>

           <div class="row">

               <div class="col-md-4 col-lg-4 col-xl-4">

                   <!-- Simple card -->
                   <div class="card m-b-30 text-center equalheight">
                       <i class="fa fa-bar-chart icon-font pt-4"></i>
                       <div class="card-body">
                           <h4 class="card-title font-20 mt-0">All-Inclusive Personal Trainer Software</h4>
                           <p class="card-text">With our personal trainer software you receive a search engine optimized personal trainer website, online appointment management, professional email addresses, contact forms, a robust appointment notification system and even a secure webcam training system built right into your website. </p>
                       </div>
                   </div>

               </div><!-- end col -->

               <div class="col-md-4 col-lg-4 col-xl-4">

                   <!-- Simple card -->
                   <div class="card m-b-30 text-center equalheight">
                       <i class="fa fa-server icon-font pt-4"></i>
                       <div class="card-body">
                           <h4 class="card-title font-20 mt-0">SEO Optimized & Mobile Responsive</h4>
                           <p class="card-text">Our personal trainer websites not only give you a professional look but they are also built with the search engines in mind so you can get the exposure you deserve. Our personal trainer websites also are mobile compatible so your clients are sure to have a great browsing experience whether they are on a desktop, tablet, or mobile device. </p>
                       </div>
                   </div>

               </div><!-- end col -->

               <div class="col-md-4 col-lg-4 col-xl-4">

                   <!-- Simple card -->
                   <div class="card m-b-30 text-center equalheight">
                       <i class="fa fa-user icon-font pt-4"></i>
                       <div class="card-body">
                           <h4 class="card-title font-20 mt-0">Personal Training Client Tracking</h4>
                           <p class="card-text">TrainerNook is designed to help you keep track of your personal training clients by letting you access appointment information and securely keep notes on the client so they are readily available for you at their next personal training  appointment. You can be rest assured you will have the information you need about your clients when you need it. </p>
                       </div>
                   </div>

               </div><!-- end col -->

               <div class="col-md-4 col-lg-4 col-xl-4">

                   <!-- Simple card -->
                   <div class="card m-b-30 text-center equalheight">
                       <i class="fa fa-support icon-font pt-4"></i>
                       <div class="card-body">
                           <h4 class="card-title font-20 mt-0">Webcam Personal Training Consulting</h4>
                           <p class="card-text">Looking for options to be able to have a secure webcam consulting with clients? For a surprisingly modest monthly fee, using TrainerNook, personal training clients can come to your website from their browser and start a secure webcam training session with you. </p>
                       </div>
                   </div>

               </div><!-- end col -->

               <div class="col-md-4 col-lg-4 col-xl-4">

                   <!-- Simple card -->
                   <div class="card m-b-30 text-center equalheight">
                       <i class="fa fa-cubes icon-font pt-4"></i>
                       <div class="card-body">
                           <h4 class="card-title font-20 mt-0">Accept Payments Online</h4>
                           <p class="card-text">Our system is integrated with numerous payment processors such as Stripe® and Paypal®. With our easy to use personal trainer software you can start securely accepting credit card or paypal payments right at the time of the appointment booking. </p>
                       </div>
                   </div>

               </div><!-- end col -->

               <div class="col-md-4 col-lg-4 col-xl-4">

                   <!-- Simple card -->
                   <div class="card m-b-30 text-center equalheight">
                       <i class="fa fa-laptop icon-font pt-4"></i>
                       <div class="card-body">
                           <h4 class="card-title font-20 mt-0">Online Personal Training Booking</h4>
                           <p class="card-text">Give your personal training clients the convenience to schedule their next personal training appointment right from your own website via the built in booking system. With TrainerNook, you can either accept all personal training appointments automatically or simply manage the personal training appointment request manually. </p>
                       </div>
                   </div>

               </div><!-- end col -->

          </div>
      </div>
  </div>
 </div>
  @endsection
