/**
 * .js dla calego frontendu
 * 
 * (c) akai.org.pl
 */

////var ajaxLoad = {};
//(function($){
//	
//	/** klasa od dynamicznego ladowania eventow **/
//	ajaxLoad = function($container){
//		this.$container = $container;
//		this.page = parseInt($container.data('page')) || 1;
//		this.lastpage = false; // czy natrafilismy na koniec elementow?
//		
//		$container.find(".ajaxload-button").click(function(e){
//			this.query();
//			e.preventDefault();
//		});
//	};
//
//	/** ladowanie kolejnych wynikow **/
//	ajaxLoad.prototype.load = function() {
//		
//	};
//
//})(jQuery);

jQuery( document ).ready( function( $ ) {
	
	/** geolocation plugin **/
	var $map = $("#map");
	if ($map.length) {
		var center = new google.maps.LatLng($map.data('latitude'), $map.data('longitude'));
		var map = new google.maps.Map($map[0], {
			zoom: 16,
			center: center,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		var marker = new google.maps.Marker({
			position: center,
			map: map
//			title: $map.data('title') ? $map.data('title') : "Miejsce wydarzenia"
		});
	}
	
} );
