!function($) {
    "use strict";

    var GoogleMap = function() {};


    //creates map with overlay
    GoogleMap.prototype.createWithOverlay = function ($container) {
      var map = new GMaps({
        div: $container,
        lat: 27.773918,
        lng: -82.633613,
                     zoom: 16,
             streetViewControl: false,
             mapTypeControl: false,
             zoomControl: false,
      });
      map.drawOverlay({
        lat: map.getCenter().lat(),
        lng: map.getCenter().lng(),      
        content: '<div class="gmaps-overlay">Our Office!<div class="gmaps-overlay_arrow above"></div></div>',
        verticalAlign: 'top',
        horizontalAlign: 'center'
      });

      return map;
    },
    //Type
    GoogleMap.prototype.createMapByType = function ($container, $lat, $lng) {
      var map = new GMaps({
        div: $container,
        lat: $lat,
        lng: $lng,
      });
      return map;
    },
    //init
    GoogleMap.prototype.init = function() {
      var $this = this;
      $(document).on('ready', function(){

        //overlay
        $this.createWithOverlay('#gmaps-overlay');

        //types
        $this.createMapByType('#gmaps-types', -12.043333, -77.028333);

      });
    },
    //init
    $.GoogleMap = new GoogleMap, $.GoogleMap.Constructor = GoogleMap
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.GoogleMap.init()
}(window.jQuery);