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
         <p class="wow fadeInLeft">Introducing Webitix's</p>
         <h1 class="default_section_heading wow fadeInLeft">Newest Features </h1>
         <img src="{{ url('assets/images/arrow-dashed-white.png') }}" class="mt-3 ml-5 mb-5 d-none d-lg-block" alt="newest features">
    </div>
    <div class="col-xl-4 p0 feature-box">
                               <h3>Video Consulting</h3>
                           <p>Webitix is an incredibly powerful tool to meet with your remote clients.
Meet face to face with your remote clients. Our service is completely web based, and integrated into your website. No need to download or install any software.</p>
                     
    </div>  
    <div class="col-xl-4 p0 feature-box">
                           <h3>Unlimited Pages</h3>
                           <p>Enjoy unlimited pages regardless of plan. We now offer no limitation on the quantity of pages; the search engines love business content so feel free to create as many informative pages as you would like on your professional site all for the same low monthly price. </p>    
                      
   </div>  
    </div>
</div>    
</div>       
@endsection

@section('content')


<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Professional Site Builder <span class="divider-left"></span></h2>
       <h4>Launch a professional business site in minutes</h4>
       <p>The included business site builder is designed with you and your business in mind. You can easily launch a professional business website in minutes with no technical training required. Easily edit your professional site, add new content, modify content, adjust colors, upload images, and pick fonts. Everything is done with just a few mouse clicks!</p>
    </div>
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature1.png') }}" width="400" alt="Professional Site Builder" class="img-fluid">
    </div>    
</div> 

<div class="row">
    <div class="col-xl-4 p0">
      <img src="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/feature2.png') }}" width="400" alt="Online Booking" class="img-fluid">
    </div> 
    <div class="col-xl-8 p0 order-first order-md-2">
       <h2 class="heading font-light mb-1"> Online Appointment Booking <span class="divider-left"></span></h2>
       <h4>Accept business bookings and payments 24 hours a day.</h4>
       <p>Give your clients the convenience to schedule their next business appointment right from your own website via the built in booking system. Your client will easily see your availability and book an opening. With Webitix, you can either accept all business appointments automatically or simply manage the appointment request manually depending on your criteria.</p> 
    </div>   
</div> 

<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Appointment Calendar <span class="divider-left"></span></h2>
       <h4>Easily Stay Organized</h4>
       <p>Conveniently manage your availability or other professional availability within the built in booking system. You have full control over your availability in the easy to use business booking software. You can easily set the advance notice time required for the appointments as well as set a buffer time between business appointments from 10, 15, 30 minutes etc.</p> 
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
        <h4>Reduced Missed Business Appointments</h4>
       <p>Webitix keeps you and your business clients in the know with worry free business session reminders via email, text, or push notifications. Help reduce missed business sessions. Within the professional platform, you can easily set the times you would like for your business clients to receive a reminder. </p> 
    </div>
</div>  

<div class="row">
    <div class="col-xl-8 p0">
       <h2 class="heading font-light mb-1"> Compatible on All Devices<span class="divider-left"></span></h2>
       <h4>Consistent user experience regardless of device.</h4>
       <p>Webitix business websites ares compatible on computers, tablets, and phones so your clients can stay connected on the go. Our staff continually tests our business website platform with over 30 different devices to ensure that your business clients have the best online experience possible while using your business website.</p>    
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
       <p>Webitix comes out of the box with powerful analytics and is designed to help you keep track of your business clients. Access previous appointment information and secure client notes. You can even keep notes on the client so they are readily available for you at their next business appointment. With Webitix, you can be rest assured you will have the information you need about your business clients when you need it.</p>  
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
              <p>Receive customized email addresses matching your domain name with every Webitix plan. Setup new email addresses, manage existing email accounts with the built-in email management system. Use the built-in webmail system or setup your provided email address on your phone or preferred third party program.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-desktop icon_circle"></i>
              </div>
              <h3> Business Site Builder</h3>
              <p>With Webitix you can create a professional responsive business website for your business that will be fully integrated with the Webitix Platform. Select and customize a design from our platform that fits with your business or easily create your own with your desired colors, photos, and logo using our professional site builder.</p>
          </div>
      </div>
    </div>
    <div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-video-camera icon_circle"></i>
              </div>
              <h3> Video Consulting</h3>
              <p>Click and go. No annoying software to download.
No complex sign-up process on third party sites for your clients.
Secure end-to-end encryption.
Easy to customize and add to your web site as an embedded application.
Works on Chrome, Firefox and IE.
Now you can schedule, charge for, and conduct all your client meetings on-line, on YOUR site.</p>
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
              <p>Our system is integrated with numerous payment processors such as Stripe® and Paypal®. With our easy to use platform you can start securely accepting credit card or paypal payments right at the time of the business appointment booking.</p>
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
              <p>Recording an introduction video of your business site to put on your website is a great way to start building rapport with your clients and help make your business site come alive! Our business platform allows you to easily integrate audio or video files right into your website.</p>
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
              <p>Utilize the built in shopping cart system to make extra money selling business audio books, ebooks, or other products related to your business. Don't have any business products to sell? Consider using the Amazon affiliate program integration that allows you to advertise third party business products and earn a commission.</p>
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
              <p>Our built-in SEO tools takes the guess work out of making sure your business website is optimized to search engine standards. Our system takes care of meta data, canonicals, and other technical SEO matters so you can ensure that you are set up to get the exposure on search engines you deserve.</p>
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
              <p>You'll have peace of mind knowing that your business site is online and accessible to your clients all day, every day. Your business website will be loading in no time with our top of the line servers prepped with the latest cutting edge technologies for no additional cost.</p>
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
              <p>We take your security as well as your client's security very seriously. Your website and Webitix Platform is always encrypted with the latest SSL technologies. All of our systems are both PCI and secure so you can conduct your business worry free.</p>
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
              <p>When it comes to ranking well online and keeping your customers engaged, content is king. Build trust and give the search engines and your clients a reason to keep coming back to your site using the built-in blogging platform. Our Professional Software allows you to easily add blog content right to your website. </p>
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
              <p>Use our social media integrations to gain more followers. Our social media integrations allow you to grow your brand and be a go to source for your business clients for information on trending topics. Use our integrated business content generator to post fresh content about various business related topics.</p>
          </div>
      </div>
    </div>    
	<div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-cog icon_circle"></i>
              </div>
              <h3> PPC Management</h3>
              <p>Pay Per Click (PPC) Campaign Management allows your site to be advertised on various keywords optimized for your business. Using a bidding mechanism, you purchase the right to have your business listed in a set position for your keywords. This process provides instant gratification as your site can be listed at the top of searches instantly.</p>
          </div>
      </div>
    </div>
	<div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-cog icon_circle"></i>
              </div>
              <h3> Results Based Marketing</h3>
              <p>Whether you need help with an email campaign or a ppc campaign, we are here to help. We provide expansive marketing services and expertise from startups to market repositioning. Don't just settle for just any marketing campaign. Focus on results. We create campaigns that converts sales. You only have a few seconds to make a lasting impression. Make those seconds count.</p>
          </div>
      </div>
    </div>		
	<div class="col-xl-4 p0">
      <div class="card m-b-30 equalheight">
          <div class="card-body">
              <div class="icon_box">
                    <i class="fa fa-cog icon_circle"></i>
              </div>
              <h3> Search Engine Optimization</h3>
              <p>Search Engine Optimization (SEO) is the process of establishing your web site in the top results of the major search engines. Our search engine optimized sites helps you establish the most successful and economical search engine optimization campaign to achieve your long term online marketing goals.</p>
          </div>
      </div>
    </div>	
</div>

<h3> A Focus On High Visibility</h3>
<p>People are shopping on the web because of its convenience, it gives them a window to the world right were they can located and compare products and services from thousands of providers out of the comfort of their home or office. Let us help you get the most out of this visibility.</p>
 
<h3 class="bottom10 font-light2 darkcolor"><a href="javascript:void(0)">We give the best advice for your business</a></h3>
<p class="bottom20">The overall look of your website is what gives your prospects a feel of how your company does business. If you have a homemade website, your prospects get the impression about how you conduct your business and how much time and effort you put forward to details. You need a website to enhance sales of products and services.</p>

<h3 class="bottom10 font-light2 darkcolor"><a href="javascript:void(0)">Websites are a process</a></h3>
<p class="bottom20">Websites are a process, not a product. You should always look for ways to improve your site - a tweak here, an update there. Even if you think the site is working fine, the Web changes so rapidly - in terms of design, technology, bandwidth, audience and many other factors - that you simply can't afford to leave well enough alone.</p>

<h3 class="bottom10 font-light2 darkcolor"><a href="javascript:void(0)">Our design team</a></h3>
<p class="bottom20">Our design team can seamlessly integrate any of our designs into your existing software platform and infrastructure or we can suggest a new platform. Our web site designs are compatible with numerous communications standards and features vast browser compatibility.</p>

<h3 class="bottom10 font-light2 darkcolor"><a href="javascript:void(0)">Service Advantage</a></h3>
<p class="bottom20">More than 75 percent of Internet consumers use search engines and directories to look for products, services and information. Our online marketing specialists provide you with a detailed report, complete with pricing, that suggests a goal oriented course of action using a specific combination of online marketing components.</p>

<h3 class="bottom10 font-light2 darkcolor"><a href="javascript:void(0)">Visualize</a></h3>
<p class="bottom20">The design team of Webitix not only will design a website that looks sharp, they will also ensure the marketability of each website commissioned. Our goal is to make your first interaction with a client be something that you are proud of, and that will keep your customers coming back for more.</p>

<h3 class="bottom10 font-light2 darkcolor"><a href="javascript:void(0)">Analysis of Market</a></h3>
<p class="bottom20">Our website marketing specialists provide you with a detailed report, complete with pricing, that suggests a goal oriented course of action to ensure that your prospects not only see your website but turn into a paying client because of it.</p>

<p>Designed for professionals who typically deliver their services face-to-face, Webitix has developed and hosts the in-Browser tool that gives you: Secure Person-to-Person video, audio or text communications with your clients;</p>


@endsection