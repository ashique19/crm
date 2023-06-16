//LOADER
$(window).on("load", function () {
   "use strict";
   $(".loader").fadeOut(800);

   setTimeout(function () {
      $(window).scrollTop(0);
   }, 200);

   $("a.pagescroll").on("click", function (event) {
      event.preventDefault();
      $("html,body").animate({
         scrollTop: $(this.hash).offset().top
      }, 1200);
   });


});

jQuery(function ($) {
   "use strict";
   var windowsize = $(window).width();


   // ************ Back to Top
   var amountScrolled = 700;
   var backBtn = $("a.scrollToTop");
   $(window).on("scroll", function () {
      if ($(window).scrollTop() > amountScrolled) {
         backBtn.fadeIn("slow");
      } else {
         backBtn.fadeOut("slow");
      }
   });
   backBtn.on("click", function () {
      $("html, body").animate({
         scrollTop: 0
      }, 700);
      return false;
   });


   /*---Header Scroll---*/
   $(window).on('scroll', function () {
      if ($(this).scrollTop() > 50) {
         $(".navbar:not(.fixed-bottom)").addClass("fixedmenu");
      } else {
         $(".navbar").removeClass("fixedmenu");
      }
   });

   if ($("nav.navbar").hasClass("fixed-bottom")) {
      var navHeight = $(".fixed-bottom").offset().top;
      $(window).scroll(function () {
         if ($(window).scrollTop() > navHeight) {
            $('.fixed-bottom').addClass('fixedmenu');
         } else {
            $('.fixed-bottom').removeClass('fixedmenu');
         }
      });
   }

   if ($(".just-sidemenu").length) {
      var anchor_point = $(".banner-fullscreen").outerHeight();
      var side_toggle = $(".just-sidemenu #sidemenu_toggle");
      side_toggle.addClass("toggle_white");
      $(window).on("scroll", function () {
         if ($(window).scrollTop() >= anchor_point) {
            side_toggle.removeClass("toggle_white");
         } else {
            side_toggle.addClass("toggle_white");
         }
      });
   }

   if (navigator.userAgent.match(/msie/i) || navigator.userAgent.match(/trident/i)) {
      $(".rev_overlay").addClass("d-none");
      $("#rev_slider_video .rs-fullvideo-cover").css("background", "rgba(0,0,0,0)");
   }
   /*$(document).on('contextmenu', function () {
      return false;
   });*/
   /*document.onkeydown = function (e) {
      if (e.ctrlKey &&
         (e.keyCode === 67 ||
            e.keyCode === 86 ||
            e.keyCode === 85 ||
            e.keyCode === 117)) {
         return false;
      } else {
         return true;
      }};*/


   /*----- Menu On click -----*/
   if ($("#sidemenu_toggle").length) {
      $("body").addClass("pushwrap");
      $("#sidemenu_toggle").on("click", function () {
         $(".pushwrap").toggleClass("active");
         $(".side-menu").addClass("side-menu-active"), $("#close_side_menu").fadeIn(700)
      }), $("#close_side_menu").on("click", function () {
         $(".side-menu").removeClass("side-menu-active"), $(this).fadeOut(200), $(".pushwrap").removeClass("active")
      }), $("#btn_sideNavClose").on("click", function () {
         $(".side-menu").removeClass("side-menu-active"), $("#close_side_menu").fadeOut(200), $(".pushwrap").removeClass("active")
      });
   }

   /* ----- Full Screen ----- */
   function resizebanner() {
      var $fullscreen = $(".full-screen");
      $fullscreen.css("height", $(window).height());
      $fullscreen.css("width", $(window).width());
   }
   resizebanner();
   $(window).resize(function () {
      resizebanner();
   });

   /*----- Accordions -----*/
   $(".items > li:first-child .sub-items").fadeIn();
   $(".items > li:first-child >").addClass("expanded");
   $(".items > li > a").on('click', function (e) {
      e.preventDefault();
      var $this = $(this);
      if ($this.hasClass("expanded")) {
         $this.removeClass("expanded");
      } else {
         $(".items a.expanded").removeClass("expanded");
         $this.addClass("expanded");
         $(".sub-items").filter(":visible").slideUp("normal");
      }
      $this.parent().children("ul").stop(true, true).slideToggle("normal");
   });

   /*----- Tabs init -----*/
   $(function () {
      initTabsToAccordion();
   });

   function initTabsToAccordion() {
      var animSpeed = 500;
      var win = $(window);
      var isAccordionMode = true;
      var tabWrap = $(".tab-to-accordion");
      var tabContainer = tabWrap.find(".tab-container");
      var tabItem = tabContainer.children("div[id]");
      var tabsetList = tabWrap.find(".tabset-list");
      var tabsetLi = tabsetList.find("li");
      var tabsetItem = tabsetList.find("a");
      var activeId = tabsetList
         .find(".active")
         .children()
         .attr("href");
      cloneTabsToAccordion();
      accordionMode();
      tabsToggle();
      hashToggle();
      win.on("resize orientationchange", accordionMode);

      function cloneTabsToAccordion() {
         $(tabsetItem).each(function () {
            var $this = $(this);
            var activeClass = $this.parent().hasClass("active");
            var listItem = $this.attr("href");
            var listTab = $(listItem);
            if (activeClass) {
               var activeClassId = listItem;
               listTab.show();
            }
            var itemContent = $this.clone();
            var itemTab = $this.attr("href");
            if (activeClassId) {
               itemContent
                  .insertBefore(itemTab)
                  .wrap('<div class="accordion-item active"></div>');
            } else {
               itemContent
                  .insertBefore(itemTab)
                  .wrap('<div class="accordion-item"></div>');
            }
         });
      }
      function accordionMode() {
         var liWidth = Math.round(tabsetLi.outerWidth());
         var liCount = tabsetLi.length;
         var allLiWidth = liWidth * liCount;
         var tabsetListWidth = tabsetList.outerWidth();
         if (tabsetListWidth <= allLiWidth) {
            isAccordionMode = true;
            tabWrap.addClass("accordion-mod");
         } else {
            isAccordionMode = false;
            tabWrap.removeClass("accordion-mod");
         }
      }
      function tabsToggle() {
         tabItem.hide();
         $(activeId).show();
         $(tabWrap).on("click", 'a[href^="#tab"]', function (e) {
            e.preventDefault();
            var $this = $(this);
            var activeId = $this.attr("href");
            var activeTabSlide = $(activeId);
            var activeOpener = tabWrap.find('a[href="' + activeId + '"]');
            $('a[href^="#tab"]')
               .parent()
               .removeClass("active");
            activeOpener.parent().addClass("active");
            if (isAccordionMode) {
               tabItem.stop().slideUp(animSpeed);
               activeTabSlide.stop().slideDown(animSpeed);
            } else {
               tabItem.hide();
               activeTabSlide.show();
            }
         });
      }
      function hashToggle() {
         var hash = location.hash;
         var activeId = hash;
         var activeTabSlide = $(activeId);
         var activeOpener = tabWrap.find('a[href="' + activeId + '"]');
         if ($(hash).length > 0) {
            $('a[href^="#tab"]')
               .parent()
               .removeClass("active");
            activeOpener.parent().addClass("active");
            tabItem.hide();
            activeTabSlide.show();
            win
               .scrollTop(activeTabSlide.offset().top)
               .scrollLeft(activeTabSlide.offset().left);
         }
      }
   }

   /*----Equal Heights----*/
   checheight();
   $(window).on("resize", function () {
      checheight();
   });
   function checheight() {
      if ($(".equalheight").length) {
         if (windowsize > 767) {
            $(".equalheight").matchHeight({
               property: "height",
            });
         }
      }
   }

   fiximBlocks();
   $(window).on("resize", function () {
      fiximBlocks();
   });
   function fiximBlocks() {
      if (windowsize < 993) {
         $(".half-section").each(function () {
            $(".img-container", this).insertAfter($(".split-box > .heading-title h2", this));
         });
      }
   }

   //contact form
   $("#btn_submit").on("click", function () {
      //get input field values
      var user_name = $('input[name=name]').val();
      var user_email = $('input[name=email]').val();
      var user_website = $('input[name=website]').val();
      var user_message = $('textarea[name=message]').val();
      var post_data, output;
      //simple validation at client's end
      var proceed = true;
      if (user_name == "") {
         proceed = false;
      }
      if (user_email == "") {
         proceed = false;
      }
      if (user_message == "") {
         proceed = false;
      }

      //everything looks good! proceed...
      if (proceed) {
         //alert(proceed);
         //data to be sent to server
         post_data = {
            'userName': user_name,
            'userEmail': user_email,
            'userWebsite': user_website,
            'userMessage': user_message
         };

         //Ajax post data to server
         $.post('contact_me.php', post_data, function (response) {

            //load json data from server and output message
            if (response.type == 'error') {
               output = '<div class="alert-danger" style="padding:10px; margin-bottom:10px;">' + response.text + '</div>';
            } else {
               output = '<div class="alert-success" style="padding:10px; margin-bottom:10px;">' + response.text + '</div>';

               //reset values in all input fields
               $('.form-inline input').val('');
               $('.form-inline textarea').val('');
               $('#btn_submit').val('Submit');
            }

            $("#result").hide().html(output).slideDown();
         }, 'json');

      }
   });


   //reset previously set border colors and hide all message on .keyup()
   $(".form-inline input, .form-inline textarea").keyup(function () {
      $("#result").slideUp();
   });




   /*----- Parallax Backgrounds -----*/
   if (windowsize > 992) {
      $(".parallaxie").parallaxie({
         speed: 0.4,
         offset: 0,
      });
   }



   /* Initializing Particles */
   if ($("#particles-js").length) {
      window.onload = function () {
         Particles.init({
            selector: '#particles-js',
            color: '#ffffff',
            connectParticles: false,
            sizeVariations: 14,
            maxParticles: 140,
         });
      };
   }


   /*Wow Animations*/
   if ($(".wow").length) {
      var wow = new WOW({
         boxClass: 'wow',
         animateClass: 'animated',
         offset: 0,
         mobile: false,
         live: true
      });
      new WOW().init();
   }




});

//LOADER
jQuery(window).on("load", function () {
   jQuery(".loader").fadeOut(800);

});

function resizebanner() {
   $(".demo-banner").css("height", $(window).height() * 0.75);
   $(".demo-banner2").css("height", $(window).height());
   $(".demo-banner3").css("height", $(window).height() * 0.60);
}
resizebanner();
$(window).resize(resizebanner);


$(".scroll").on('click', function (event) {
   event.preventDefault();
   $('html,body').animate({
      scrollTop: $(this.hash).offset().top
   }, 1000);
});

if ($(window).width() > 768) {
   $(".parallaxie").parallaxie({
      speed: 0.55,
      offset: 0,
   });
}


$(".same_height").matchHeight({
   property: "height",
});


//Wow Initializing
new WOW().init();
