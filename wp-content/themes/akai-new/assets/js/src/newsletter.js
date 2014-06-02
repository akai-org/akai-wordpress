/**
 * AKAI New
 * http://akai.org.pl
 *
 * Copyright (c) 2014 AKAI
 * Licensed under the GPLv2+ license.
 */
 
 ( function( window, $, undefined ) {
  'use strict';

  // Newsletter form
  function Newsletter() {
    var self = this;

    this.$wrapper = $('#newsletter-bar');

    if (!this.isDisabled()) {
      this.show();
    }

    this.$wrapper.find('.js-close-button').on('click', function(event) {
      event.preventDefault();
      self.disable();
    });

    this.$wrapper.find('.js-back-button').on('click', function(event) {
      event.preventDefault();
      self.hideMessage();
    });

    this.$wrapper.find('form').on('submit', function(event) {
      event.preventDefault();
      self.submitForm();
    });
  }

  Newsletter.prototype.show = function() {
    $("body").addClass("show-newsletter");
    this.$wrapper.show();
  },

  Newsletter.prototype.hide = function() {
    this.$wrapper.fadeOut(180, function(){
      $("body").removeClass("show-newsletter");
    });
  },

  Newsletter.prototype.disable = function() {
    this._setHidingCookie();
    this.hide();
  },

  Newsletter.prototype.isDisabled = function() {
    return document.cookie.indexOf("newsletter-bar") !== -1;      
  },

  Newsletter.prototype.showMessage = function(message, hideBackButton) {
    this.$wrapper.addClass('has-message');
    this.$wrapper.find('.js-message-content').html(message);

    this.$wrapper.find(".content-message .js-back-button").toggle(!hideBackButton);
  },

  Newsletter.prototype.hideMessage = function() {
    this.$wrapper.removeClass('has-message');
  },

  Newsletter.prototype.submitForm = function() {
    var email = this.$wrapper.find('input[type="email"]').val().trim(),
        self = this;

    this.showMessage("<i class='fa fa-spin fa-spinner'></i>", true);

    $.ajax({
      url: PATH + "wp-content/themes/akai-new/mailchimp.php",
      type: "POST",
      dataType: "json",
      data: {
        email: email
      },
      success: function(response) {
        console.log(response);

        if (response.status != "error") {
          self.showMessage("Na Twój adres e-mail została wysłana prośba o zaakceptowanie newslettera.", true);
          setTimeout(function(){
            self.disable();
          }, 3000);
        } else {
          self.showMessage(response.error);
        }
      },
      error: function(error) {
        console.log(error);

        self.showMessage("Wystąpił błąd łączenia z serwerem.");
      }
    });
  },

  Newsletter.prototype._setHidingCookie = function() {
    var expires = new Date();
    expires.setTime(expires.getTime()+(365*24*60*60*1000));
    document.cookie = 'newsletter-bar=hide; expires=' + expires.toGMTString();
  }

  $(document).ready(function(){
    window.newsletter = new Newsletter();
  });

 } )( this, jQuery );
