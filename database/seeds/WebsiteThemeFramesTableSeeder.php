<?php

use Illuminate\Database\Seeder;

class WebsiteThemeFramesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $count = DB::table('website_theme_frames')->count();        

        if ($count==0) {
            DB::table('website_theme_frames')->insert(
                [
                'website_theme_page_id' =>'1',
                'content'=> '<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">    
    <title>Barber – Entrepreneur Theme</title>
    

    <!-- Bootstrap core CSS -->
    <link href="/elements/bootstrap_barbar/css/bootstrap.min.css" rel="stylesheet">       
    <link href="css/style.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <!-- Linea Icons -->
    <link rel="stylesheet" type="text/css" href="/elements/css_barbar/icon.css">
    <link rel="stylesheet" type="text/css" href="/elements/css_barbar/icon2.css">
    <link rel="stylesheet" type="text/css" href="/elements/css_barbar/icon3.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">        
    <script src="/elements/js_barbar/jquery-1.11.0.min.js"></script>
    <!-- Custom Theme files -->
    <link href="/elements/css_barbar/style.css" rel="stylesheet" type="text/css">

    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="/elements/css_barbar/animate.css">

    <link rel="stylesheet" href="/elements/css_barbar/b-icons.css" type="text/css">
    <link rel="stylesheet" href="/elements/css_barbar/b-icons2.css" type="text/css">    
    <link rel="stylesheet" href="/elements/css_barbar/calender-style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/elements/css_barbar/calender.css">
    <link rel="stylesheet" href="/elements/css_barbar/calender-responsive.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/elements/css_barbar/preloader.css">    
  <style type="text/css"></style>
  <style type="text/css"></style><link rel="stylesheet" href="//cdn.jsdelivr.net/medium-editor/latest/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8" id="mediumCss0"><link rel="stylesheet" href="/plugins/sitebuilder/css/medium-bootstrap.css" type="text/css" media="screen" charset="utf-8" id="mediumCss1"></head><body style="overflow: visible;">

  <!---PRE LOADER-->
  <div id="preloader" style="display: none;">
    <div id="loader"></div>
  </div>
<div id="page" class="page">
           <input type="hidden" name="name" value="header13.html">
           <input type="hidden" name="screenshot" value="header13.png">
           <input type="hidden" name="type" value="barbar">
<!---HEADER--->
  <header class="header sticky">
    <div class="menu">
    <div class="container">
      <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand trans-logo" href="index.html" data-selector="nav a" style="outline: none;"><img src="/elements/images_barbar/logo-white.png" data-selector="img" style="outline: none;"></a>
        <a class="navbar-brand untrans-logo" href="index.html" data-selector="nav a" style="outline: none;"><img src="/elements/images_barbar/logo.png" data-selector="img" style="outline: none;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">About</a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">Styles</a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">Testimonials</a>
            </li>            
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">Pages</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">About Us</a>
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Careers</a>                
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Pricing</a>
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Gallery</a>
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Shop</a>
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Contact</a>                
            </div>
            </li>            
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">Blog</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Blog – Masonry</a>
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Blog – Masonry + Sidebar</a>                
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Blog – Standard</a>
                <a class="dropdown-item" href="#" data-selector="nav a" style="outline: none;">Blog – Standard + Sidebar</a>
            </div>
            </li>            
            <li class="nav-item p-btn">
              <a class="nav-link" href="#" data-selector="nav a" style="outline: none;">Contact</a>
            </li>            
          </ul>
        </div>
      </nav>
    </div>
  </div><!-- //Menu -->
    <div class="banner">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="editContent" data-selector=".editContent" style="outline: none;">The Barber Shop Experience</h1>

            <!-- calender -->            
            <div class="calender">
              <div class="th-book-cal-small th-centered">
                <div class="booked-calendar-shortcode-wrap">
                  <div class="booked-calendar-wrap large" data-default="2019-04-01" style="height: 394px;">
                    <table class="booked-calendar" data-calendar-date="2019-04-01">
                      <thead>
                        <tr>
                          <th colspan="7">
                            <span class="calendarSavingState">
                              <i class="booked-icon booked-icon-spinner-clock booked-icon-spin"></i>
                            </span>
                            <span class="monthName">April 2019</span>
                            <a href="#" data-goto="2019-05-01" class="page-right"><i class="booked-icon booked-icon-arrow-right"></i></a>
                          </th>
                        </tr>
                        <tr class="days">
                          <th>Sun</th>
                          <th>Mon</th>
                          <th>Tue</th>
                          <th>Wed</th>
                          <th>Thu</th>
                          <th>Fri</th>
                          <th>Sat</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="week">
                          <td data-date="2019-03-31" class="prev-month prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">31</span></span>
                          </td>
                          <td data-date="2019-04-1" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">1</span></span>
                          </td>
                          <td data-date="2019-04-2" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">2</span></span>
                          </td>
                          <td data-date="2019-04-3" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">3</span></span>
                          </td>
                          <td data-date="2019-04-4" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">4</span></span>
                          </td>
                          <td data-date="2019-04-5" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">5</span></span>
                          </td>
                          <td data-date="2019-04-6" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">6</span></span>
                          </td>
                        </tr>
                        <tr class="week">
                          <td data-date="2019-04-7" class="today prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">7</span></span>
                          </td>
                          <td data-date="2019-04-8" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">8</span></span>
                          </td>
                          <td data-date="2019-04-9" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">9</span></span>
                          </td>
                          <td data-date="2019-04-10" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">10</span></span>
                          </td>
                          <td data-date="2019-04-11" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">11</span></span>
                          </td>
                          <td data-date="2019-04-12" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">12</span></span>
                          </td>
                          <td data-date="2019-04-13" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">13</span></span>
                          </td>
                        </tr>
                        <tr class="week">
                          <td data-date="2019-04-14" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">14</span></span>
                          </td>
                          <td data-date="2019-04-15" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">15</span></span>
                          </td>
                          <td data-date="2019-04-16" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">16</span></span>
                          </td>
                          <td data-date="2019-04-17" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">17</span></span>
                          </td>
                          <td data-date="2019-04-18" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">18</span></span>
                          </td>
                          <td data-date="2019-04-19" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">19</span></span>
                          </td>
                          <td data-date="2019-04-20" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">20</span></span>
                          </td>
                        </tr>
                        <tr class="week">
                          <td data-date="2019-04-21" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">21</span></span>
                          </td>
                          <td data-date="2019-04-22" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">22</span></span>
                          </td>
                          <td data-date="2019-04-23" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">23</span></span>
                          </td>
                          <td data-date="2019-04-24" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">24</span></span>
                          </td>
                          <td data-date="2019-04-25" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">25</span></span>
                          </td>
                          <td data-date="2019-04-26" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">26</span></span>
                          </td>
                          <td data-date="2019-04-27" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">27</span></span>
                          </td>
                        </tr>
                        <tr class="week">
                          <td data-date="2019-04-28" class="prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">28</span></span>
                          </td>
                          <td data-date="2019-04-29" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">29</span></span>
                          </td>
                          <td data-date="2019-04-30" class="" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">30</span></span>
                          </td>
                          <td data-date="2019-05-1" class="next-month" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">1</span></span>
                          </td>
                          <td data-date="2019-05-2" class="next-month" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">2</span></span>
                          </td>
                          <td data-date="2019-05-3" class="next-month" style="height: 59px;">
                            <span class="date tooltipster tooltipstered" style="line-height: 57px;"><span class="number" style="">3</span></span>
                          </td>
                          <td data-date="2019-05-4" class="next-month prev-date" style="height: 59px;">
                            <span class="date" style="line-height: 57px;"><span class="number" style="">4</span></span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </header>
 
  <!-- //Google Map -->
  </div>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<a id="scroll" href="#" class=""><i class="fas fa-chevron-up"></i></a>

<!-- Sticky Header -->
<script>
$(window).scroll(function(){
  var sticky = $(".sticky"),
      scroll = $(window).scrollTop();

  if (scroll >= 100) sticky.addClass("fixed");
  else sticky.removeClass("fixed");
});
</script>
<script>
$(window).scroll(function(){
  var sticky = $("#scroll"),
      scroll = $(window).scrollTop();
  if (scroll >= 100) sticky.addClass("scrollup");
  else sticky.removeClass("scrollup");
});
</script>
<!-- //Sticky Header -->
<!-- Wow JS -->
<script type="text/javascript" src="/elements/js/build/build.min.js"></script>
<script src="/elements/js_barbar/wow.min.js"></script>
<script>
   new WOW().init();
</script>
<!-- //Wow JS -->
<script type="text/javascript" src="/elements/js_barbar/spin.min.js"></script>
<script type="text/javascript" src="/elements/js_barbar/jquery.spin.js"></script>
<script type="text/javascript" src="/elements/js_barbar/tooltips.min.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
var booked_js_vars = {"ajax_url":"https:\/\/demo.themovation.com\/entrepreneur\/barber\/wp-admin\/admin-ajax.php","profilePage":"https:\/\/demo.themovation.com\/entrepreneur\/barber\/booked-profile\/","publicAppointments":"","i18n_confirm_appt_delete":"Are you sure you want to cancel this appointment?","i18n_please_wait":"Please wait ...","i18n_wrong_username_pass":"Wrong username\/password combination.","i18n_fill_out_required_fields":"Please fill out all required fields.","i18n_guest_appt_required_fields":"Please enter your name to book an appointment.","i18n_appt_required_fields":"Please enter your name, your email address and choose a password to book an appointment.","i18n_appt_required_fields_guest":"Please fill in all \"Information\" fields.","i18n_password_reset":"Please check your email for instructions on resetting your password.","i18n_password_reset_error":"That username or email is not recognized."};
/* ]]> */
</script>
<script type="text/javascript" src="/elements/js_barbar/activity.js"></script>
<script type="text/javascript">
$(function() {
var currentDate = new Date();

$(".week td").each(function() {
    var specifiedDate = $(this).data("date");
    var date = new Date(specifiedDate);

    if(date.setHours(0,0,0,0) == currentDate.setHours(0,0,0,0)){

        $(this).addClass("today");
    }

});
});
</script>
<script type="text/javascript">
      $(window).on("load", function() { // makes sure the whole site is loaded 
      $("#status").fadeOut(); // will first fade out the loading animation 
      $("#preloader").delay("350").fadeOut("slow"); // will fade out the white DIV that covers the website. 
      $("body").delay("350").css({"overflow":"visible"});
    });
</script>
<script class="builder" src="/elements/js/builder_in_block.js"></script></body>',
                'height'=> '791',
                'original_url'=> 'http://'.env('APP_DOMAIN').'/elements/header13.html',
                'loaderfunction'=>null,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s')
                       
                ]
            );
        }        
        

    }
}
