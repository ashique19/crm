@extends('layouts.app')
@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:image" content="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature1.png') }}" />
    <meta property="og:description" content="{{ seo('description') }}">
    <meta property="og:type" content="website" />
@endsection

@section('splash')
      
<div class="page_header">
<div class="container">
<div class="row">
    <div class="col-xl-4 p0">
         <p class="wow fadeInLeft">Introducing ChiroNook's</p>
         <h1 class="default_section_heading wow fadeInLeft">Newest Features </h1>
         <img src="{{ url('assets/images/arrow-dashed-white.png') }}" class="mt-3 ml-5 mb-5 d-none d-lg-block" alt="newest features">
    </div>
    <div class="col-xl-4 p0 feature-box">
                               <h3>Webcam Sessions</h3>
                           <p>Now you can have a completely secure on-line video chat with your chiropractic client, directly from your website using ChiroNook’s super-easy to use chiropractic software. Your acupucture client can book an appointment online through your website.</p>
                           
    </div>  
    <div class="col-xl-4 p0 feature-box">
                           <h3>Unlimited Pages</h3>
                           <p>Enjoy unlimited pages regardless of plan. We now offer no limitation on the quantity of pages; the search engines love chiropractic content so feel free to create as many informative pages as you would like on your chiropractor site all for the same low monthly price. </p>    
    </div>  
    </div>
</div>    
</div>       
@endsection

@section('content')


<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Chiropractor Site Builder <span class="divider-left"></span></h2>
       <h4>Launch a professional chiropractic site in minutes</h4>
       <p>The included chiropractic site builder is designed with you and your practice in mind. You can easily launch a professional chiropractic website in minutes with no technical training required. Easily edit your chiropractor site, add new content, modify content, adjust colors, upload images, and pick fonts. Everything is done with just a few mouse clicks!</p>
    </div>
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature1.png') }}" width="400" alt="Chiropractor Site Builder" class="img-fluid">
    </div>    
</div> 

<div class="row">
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature2.png') }}" width="400" alt="Online Booking" class="img-fluid">
    </div> 
    <div class="col-xl-8 p0 order-first order-md-2">
       <h2 class="heading font-light mb-1"> Online Appointment Booking <span class="divider-left"></span></h2>
       <h4>Accept chiropractic bookings and payments 24 hours a day.</h4>
       <p>Give your clients the convenience to schedule their next chiropractic appointment right from your own website via the built in booking system. Your client will easily see your availability and book an opening. With ChiroNook, you can either accept all chiropractic appointments automatically or simply manage the appointment request manually depending on your criteria.</p> 
    </div>   
</div> 

<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Appointment Calendar <span class="divider-left"></span></h2>
       <h4>Easily Stay Organized</h4>
       <p>Conveniently manage your availability or other chiropractor availability within the built in booking system. You have full control over your availability in the easy to use chiropractic booking software. You can easily set the advance notice time required for the appointments as well as set a buffer time between chiropractic appointments from 10, 15, 30 minutes etc.</p> 
    </div>
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature3.png') }}" width="400" alt="Appointment Calendar" class="img-fluid">
    </div>    
</div> 

<div class="row">
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature4.png') }}" width="400" alt="Appointment Notifications" class="img-fluid">
    </div>
    <div class="col-xl-8 p0 order-first order-md-2">
       <h2 class="heading font-light mb-1"> Appointment Notifications <span class="divider-left"></span></h2>
        <h4>Reduced Missed Chiropractic Appointments</h4>
       <p>ChiroNook keeps you and your chiropractic clients in the know with worry free chiropractic session reminders via email, text, or push notifications. Help reduce missed chiropractic sessions. Within the chiropractor platform, you can easily set the times you would like for your chiropractic clients to receive a reminder. </p> 
    </div>
</div>  

<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Compatible on All Devices<span class="divider-left"></span></h2>
       <h4>Consistent user experience regardless of device.</h4>
       <p>ChiroNook chiropractic websites ares compatible on computers, tablets, and phones so your clients can stay connected on the go. Our staff continually tests our chiropractic website platform with over 30 different devices to ensure that your chiropractic clients have the best online experience possible while using your chiropractic website.</p>    
    </div>
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature5.png') }}" width="400" alt="All Devices Compatible" class="img-fluid">
    </div>    
</div>

<div class="row">
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature6.png') }}" width="400" alt="Client Tracking" class="img-fluid">
    </div>
    <div class="col-xl-8 p0 order-first order-md-2">
       <h2 class="heading font-light mb-1">Analytics & Client Tracking <span class="divider-left"></span></h2>
       <p>ChiroNook comes out of the box with powerful analytics and is designed to help you keep track of your chiropractic clients. Access previous appointment information and secure client notes. You can even keep notes on the client so they are readily available for you at their next chiropractic appointment. With ChiroNook, you can be rest assured you will have the information you need about your chiropractic clients when you need it.</p>  
    </div>
</div>
      

<div class="row">
 <div class="col-md-12 text-center">
    <h2 class="heading mb-4">More <span>Features</span><span class="divider-center"></span></h2>
 </div>
</div>

<div class="row text-center">
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-envelope icon_circle"></i>
              </div>
              <h3> Integrated Email Service</h3>
              <p>Receive customized email addresses matching your domain name with every ChiroNook plan. Setup new email addresses, manage existing email accounts with the built-in email management system. Use the built-in webmail system or setup your provided email address on your phone or preferred third party program.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-desktop icon_circle"></i>
              </div>
              <h3> Chiropractic Site Builder</h3>
              <p>With ChiroNook you can create a professional responsive chiropractic website for your practice that will be fully integrated with the ChiroNook Platform. Select and customize a design from our platform that fits with your practice or easily create your own with your desired colors, photos, and logo using our chiropractor site builder.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-video-camera icon_circle"></i>
              </div>
              <h3> Webcam Counseling</h3>
              <p>Until now there have been no really good options for on-line face-to-face communications with clients or potential clients. For a surprisingly modest monthly fee, using ChiroNook, chiropractic clients can come to your chiropractor website from their browser and start a secure webcam conversation with you.</p>
          </div>
      </div>
    </div> 
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-credit-card icon_circle"></i>
              </div>
              <h3> Accept Payments</h3>
              <p>Our system is integrated with numerous payment processors such as Stripe® and Paypal®. With our easy to use platform you can start securely accepting credit card or paypal payments right at the time of the chiropractic appointment booking.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-file-audio-o icon_circle"></i>
              </div>
              <h3> Add Video and Audio</h3>
              <p>Recording an introduction video of your chiropractic site to put on your website is a great way to start building rapport with your clients and help make your chiropractic site come alive! Our chiropractic platform allows you to easily integrate audio or video files right into your website.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-shopping-cart icon_circle"></i>
              </div>
              <h3> Shopping Cart</h3>
              <p>Utilize the built in shopping cart system to make extra money selling chiropractic audio books, ebooks, or other products related to your chiropractic practice. Don't have any chiropractic products to sell? Consider using the Amazon affiliate program integration that allows you to advertise third party chiropractic products and earn a commission.</p>
          </div>
      </div>
    </div> 
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-cog icon_circle"></i>
              </div>
              <h3> Built-In SEO Tools</h3>
              <p>Our built-in SEO tools takes the guess work out of making sure your chiropractic website is optimized to search engine standards. Our system takes care of meta data, canonicals, and other technical SEO matters so you can ensure that you are set up to get the exposure on search engines you deserve.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-server icon_circle"></i>
              </div>
              <h3> Website Hosting</h3>
              <p>You'll have peace of mind knowing that your chiropractic site is online and accessible to your clients all day, every day. Your chiropractic website will be loading in no time with our top of the line servers prepped with the latest cutting edge technologies for no additional cost.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-lock icon_circle"></i>
              </div>
              <h3> SSL Secured</h3>
              <p>We take your security as well as your client's security very seriously. Your website and ChiroNook Platform is always encrypted with the latest SSL technologies. All of our systems are both PCI and HIPAA compliant so you can conduct your business worry free.</p>
          </div>
      </div>
    </div> 
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-line-chart icon_circle"></i>
              </div>
              <h3> Analytics Integration</h3>
              <p>Track and see traffic stats from your potential clients! Our system comes out of the box with powerful analytics so you can get a better understanding of your site traffic. You can also easily integrate third party analytics such as Google Analytics right into your site. It's easy as copying and pasting a line of text.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-file-text icon_circle"></i>
              </div>
              <h3> Your Own Blog</h3>
              <p>When it comes to ranking well online and keeping your customers engaged, content is king. Build trust and give the search engines and your clients a reason to keep coming back to your site using the built-in blogging platform. Our Chiropractor Software allows you to easily add blog content right to your website. </p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-cog icon_circle"></i>
              </div>
              <h3> Social Media Integration</h3>
              <p>Use our social media integrations to gain more followers. Our social media integrations allow you to grow your brand and be a go to source for your chiropractic clients for information on trending topics. Use our integrated chiropractic content generator to post fresh content about various chiropractic related topics.</p>
          </div>
      </div>
    </div>    
</div>




@endsection