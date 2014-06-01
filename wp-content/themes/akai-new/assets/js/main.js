/*! AKAI New - v0.1.0 - 2014-06-01
 * http://akai.org.pl
 * Copyright (c) 2014; * Licensed GPLv2+ */
// See http://www.advancedcustomfields.com/resources/field-types/google-map/ for more info.

/*
*  render_map
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param element DOMelement
*  @return  n/a
*/
 
function render_map( element ) {
 
  // var
  var markerElements = element.querySelectorAll('.marker');
 
  // vars
  var args = {
    zoom    : 16,
    center    : new google.maps.LatLng(0, 0),
    mapTypeId : google.maps.MapTypeId.ROADMAP
  };
 
  // create map           
  var map = new google.maps.Map( element, args);
 
  // add a markers reference
  map.markers = [];
 
  // add markers
  [].forEach.call(markerElements, function(marker) {
      add_marker(marker, map);
  });
 
  // center map
  center_map( map );
 
}
 
/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param marker DOMelement
*  @param map (Google Map object)
*  @return  n/a
*/
 
function add_marker( marker, map ) {
 
  var latlng = new google.maps.LatLng( marker.dataset.lat, marker.dataset.lng );
 
  // create marker
  var marker = new google.maps.Marker({
    position  : latlng,
    map     : map
  });
 
  // add to array
  map.markers.push( marker );
 
  // if marker contains HTML, add it to an infoWindow
  if( marker.innerHTML )
  {
    // create info window
    var infowindow = new google.maps.InfoWindow({
      content   : marker.innerHTML
    });
 
    // show info window when marker is clicked
    google.maps.event.addListener(marker, 'click', function() {
 
      infowindow.open( map, marker );
 
    });
  }
 
}
 
/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param map (Google Map object)
*  @return  n/a
*/
 
function center_map( map ) {
  var bounds = new google.maps.LatLngBounds();
 
  // loop through all markers and create bounds
  map.markers.forEach(function(marker){
    var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
    bounds.extend( latlng );
  });
 
  // only 1 marker?
  if( map.markers.length == 1 ) {
    // set center of map
    map.setCenter( bounds.getCenter() );
    map.setZoom( 16 );
  } else {
    // fit to bounds
    map.fitBounds( bounds );
  }
 
}
 
/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type  function
*  @date  8/11/2013
*  @since 5.0.0
*
*  @param n/a
*  @return  n/a
*/
 
document.addEventListener('DOMContentLoaded', function(){
  [].forEach.call(document.querySelectorAll('.acf-map'), function(elem) {
    render_map(elem);
  });
});

( function( window, $, undefined ) {
	'use strict';

  // install skrollr
  var deviceWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
  if (deviceWidth >= 960) {
    document.write('<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/skrollr/0.6.22/skrollr.js"></script>');
    document.write('<script type="text/javascript" src="//cdn.jsdelivr.net/skrollr.stylesheets/0.0.4/skrollr.stylesheets.min.js"></script>');
    document.addEventListener('DOMContentLoaded', function(){
      var s = skrollr.init({
        constants: {
          smallheaderthird: 140 / 3,
          smallheaderhalf: 140 / 2,
          smallheader: 140
        },
        forceHeight: false
      });
    });
  }

  // responsive menu btn
  var menu = document.querySelector('.navigation-bar');
  var menuToggleButton = document.querySelector('.navigation-bar .js-expand');

  var toggleMenu = function(e) {
    e.preventDefault();
    menu.classList.toggle('expanded');
  };

  menuToggleButton.addEventListener('click', toggleMenu);
  menuToggleButton.addEventListener('touchend', toggleMenu);

  // Newsletter form
  $(document).ready(function(){
    var $newsletterBar = $('#newsletter-bar');

    if(document.cookie.indexOf("newsletter-bar") === -1) {
      $newsletterBar.show();

      // Move a little bit to top if admin bar is shown on bottom
      if ($("#wpadminbar").length > 0) {
        $newsletterBar.css('bottom', '30px');
      }
    }

    function setNewsletterCookie() {
      var expires = new Date();
      expires.setTime(expires.getTime()+(365*24*60*60*1000));
      document.cookie = 'newsletter-bar=hide; expires=' + expires.toGMTString();
    };

    function hideNewsletterBar() {
      setNewsletterCookie();
      $newsletterBar.fadeOut(180);
    }

    $('.js-newsletter-quit-button').on('click', function(event) {
        event.preventDefault();

        hideNewsletterBar();
    });

    $('#js-newsletter-form').on('submit', function(event) {
      event.preventDefault();

      var email = $(this).find('input[type="email"]').val().trim();
        
      $.ajax({
        url: "/wp-content/themes/akai-new/mailchimp.php",
        type: "POST",
        dataType: "json",
        data: "email=" + email,
        success: function(msg) {
          alert("Zapisano do newslettera.");
        },
        error: function(err) {
          alert("Wystąpił błąd.");
        }
      });
      
      hideNewsletterBar();
    });

  });

 } )( this, jQuery );
