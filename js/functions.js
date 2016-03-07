/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */
 var _width;
( function( $ ) {
	$window        = $( window );
	 _width	=	$window.width();
	$( document ).ready( function() {
		$body	=	$( document.body );
		jQuery(window).scroll(function() {
			if(jQuery(this).scrollTop() > 300)
				jQuery(".scroll-to-top").fadeIn()
			else
				jQuery(".scroll-to-top").fadeOut()
		});
		jQuery(".scroll-to-top").click(function() {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 800);
			return false
		});
	});
	$(window).resize(function() { 
		_width   = $window.width();
	});
	$('.dropdown-toggle').click(function() {
		if(_width >= 768){
			var location = $(this).attr('href');
			window.location.href = location;
			return false;
		}
	});
	// jQuery powered scroll to top
	jQuery(document).ready( function() {		
	});

} )( jQuery );