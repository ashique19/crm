@extends('layouts.app')
@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="keywords" content="{{ seo('keywords') }}">
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
         <p class="wow fadeInLeft">Introducing Psychnook's</p>
         <h1 class="default_section_heading wow fadeInLeft">Newest Features </h1>
         <img src="{{ url('assets/images/arrow-dashed-white.png') }}" class="mt-3 ml-5 mb-5 d-none d-lg-block" alt="newest features">
    </div>
    <div class="col-xl-4 p0 feature-box">
                               <h3>Webcam Sessions</h3>
                           <p>Now you can have a completely secure on-line video chat with your client, directly from your website using PsychNook’s super-easy to use software. The client can book an appointment online through your website, or you can invite them.</p>
                           
    </div>  
    <div class="col-xl-4 p0 feature-box">
                           <h3>Unlimited Pages</h3>
                           <p>Enjoy unlimited pages regardless of plan. We now offer no limitation on the quantity of pages; the search engines love content so feel free to create as many informative pages as you would like on your therapy site all for the same low monthly price. </p>    
    </div>  
    </div>
</div>    
</div>       
@endsection

@section('content')


<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Therapist Site Builder <span class="divider-left"></span></h2>
       <h4>Launch a professional site in minutes</h4>
       <p>The included therapy site builder is designed with you and your practice in mind. You can easily launch a professional site in minutes with no technical training required. Easily edit your site, add new content, modify content, adjust colors, upload images, and pick fonts. Everything is done with just a few mouse clicks!</p>
    </div>
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature1.png') }}" width="400" alt="Therapist Site Builder" class="img-fluid">
    </div>    
</div> 

<div class="row">
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature2.png') }}" width="400" alt="Online Booking" class="img-fluid">
    </div> 
    <div class="col-xl-8 p0 order-first order-md-2">
       <h2 class="heading font-light mb-1"> Online Booking <span class="divider-left"></span></h2>
       <h4>Accept bookings and payments 24 hours a day.</h4>
       <p>Give your clients the convenience to schedule their next appointment right from your own website via the built in booking system. Your client will easily see your availability and book an opening. With PsychNook, you can either accept all appointments automatically or simply manage the appointment request manually depending on your criteria.</p> 
    </div>   
</div> 

<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Appointment Calendar <span class="divider-left"></span></h2>
       <h4>Easily Stay Organized</h4>
       <p>Conveniently manage your availability or other counselor availability within the built in booking system. You have full control over your availability in the easy to use therapist software. You can easily set the advance notice time required for the appointments as well as set a buffer time between appointments from 10, 15, 30 minutes etc.</p> 
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
        <h4>Reduced Missed Appointments</h4>
       <p>PsychNook keeps you and your therapy clients in the know with worry free counseling session reminders via email, text, or push notifications. Help reduce missed counseling sessions. Within the therapist platform, you can easily set the times you would like for your therapy clients to receive a reminder. </p> 
    </div>
</div>  

<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Compatible on All Devices<span class="divider-left"></span></h2>
       <h4>Consistent user experience regardless of device.</h4>
       <p>PsychNook Therapy Software is compatible on computers, tablets, and phones so your clients can stay connected on the go. Our staff continually tests our platform with over 30 different devices to ensure that your therapy clients have the best online experience possible while using your therapy website.</p>    
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
       <p>PsychNook comes out of the box with powerful analytics and is designed to help you keep track of your therapy clients. Access previous appointment information and secure client notes. You can even keep notes on the client so they are readily available for you at their next appointment. With PsychNook, you can be rest assured you will have the information you need about your clients when you need it.</p>  
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
              <p>Receive customized email addresses matching your domain name with every PsychNook plan. Setup new email addresses, manage existing email accounts with the built-in email management system. Use the built-in webmail system or setup your provided email address on your phone or preferred third party program.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-desktop icon_circle"></i>
              </div>
              <h3> Therapy Site Builder</h3>
              <p>With PsychNook you can create a professional responsive therapy website for your practice that will be fully integrated with the PsychNook Platform. Select and customize a design from our platform that fits with your practice or easily create your own with your desired colors, photos, and logo using our therapist site builder.</p>
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
              <p>Until now there have been no really good options for on-line face-to-face communications with clients or potential clients. For a surprisingly modest monthly fee, using PsychNook, clients can come to your website from their browser and start a secure webcam conversation with you.</p>
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
              <p>Our system is integrated with numerous payment processors such as Stripe® and Paypal®. With our easy to use platform you can start securely accepting credit card or paypal payments right at the time of the appointment booking.</p>
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
              <p>Recording an introduction video of your site to put on your website is a great way to start building rapport with your clients and help make your therapy site come alive! Our therapist platform allows you to easily integrate audio or video files right into your website.</p>
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
              <p>Utilize the built in shopping cart system to make extra money selling audio books, ebooks, or other products related to your therapy practice. Don't have any products to sell? Consider using the Amazon affiliate program integration that allows you to advertise third party products and earn a commission.</p>
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
              <p>Our built-in SEO tools takes the guess work out of making sure your website is optimized to search engine standards. Our system takes care of meta data, canonicals, and other technical SEO matters so you can ensure that you are set up to get the exposure on search engines you deserve.</p>
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
              <p>You'll have peace of mind knowing that your site is online and accessible to your clients all day, every day. Your therapy website will be loading in no time with our top of the line servers prepped with the latest cutting edge technologies for no additional cost.</p>
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
              <p>We take your security as well as your client's security very seriously. Your website and PsychNook Platform is always encrypted with the latest SSL technologies. All of our systems are both PCI and HIPAA compliant so you can conduct your business worry free.</p>
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
              <p>When it comes to ranking well online and keeping your customers engaged, content is king. Build trust and give the search engines and your clients a reason to keep coming back to your site using the built-in blogging platform. Our Therapist Software allows you to easily add blog content right to your website. </p>
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
              <p>Use our social media integrations to gain more followers. Our social media integrations allow you to grow your brand and be a go to source for your clients for information on trending topics. Use our integrated content generator to post fresh content about various therapy related topics such as anxiety and depression.</p>
          </div>
      </div>
    </div>    
</div>




@endsection