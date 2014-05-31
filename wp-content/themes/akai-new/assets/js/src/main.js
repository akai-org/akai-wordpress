/**
 * AKAI New
 * http://akai.org.pl
 *
 * Copyright (c) 2014 AKAI
 * Licensed under the GPLv2+ license.
 */
 
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

  $(document).ready(function(){

    $('#newsletter-bar-quit').on('click', function(event) {
        event.preventDefault();
        $('.newsletter-bar').hide();
    });

  });

 } )( this, jQuery );
