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
	 
	/*var offset = 300,
	offset_opacity = 1200,
	scroll_top_duration = 700,
	$back_to_top = $('.gotop');
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('esc-is-visible') : $back_to_top.removeClass('esc-is-visible esc-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('esc-fade-out');
		}
	});
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
			}, scroll_top_duration
		);
	});*/
	$( document ).ready( function() {
		$body          = $( document.body );		
	});
	$(window).resize(function() { 
		_width   = $window.width();
	});
/*
	 $(".dropdown").hover(
		function() {
			if(_width>767){
				$('.dropdown-menu:first', this).stop( true, true ).slideDown(250,function(){
					$(this).removeAttr('style');
				});
				$(this).toggleClass('open');
				$('span.arrow', this).toggleClass("caret caret-up");
			}
		},
		function() {
			if(_width>767){
				$('.dropdown-menu:first', this).stop( true, true ).slideUp(150,function(){
					$(this).removeAttr('style');
				});
				$(this).toggleClass('open');
				$('span.arrow', this).toggleClass("caret caret-up");
			}
		}
	);
*/
/*		jQuery(window).resize(function(){
			_width	=	$(this).width();
		});	
		$('.navbar .dropdown').hover(function() {
			if(_width >= 768){
				$(this).find('.dropdown-menu').first().stop(true, true).delay(150).slideDown({
					complete: function () {						
						$('span.arrow', this).toggleClass("caret caret-up");
						//$(this).parent().addClass('open');
						$(this).parent().toggleClass('open');
						$(this).removeAttr('style');
					}
				});
			}
		}, function() {
			if(_width >= 768){
				$(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp({
					complete: function () {
						$('span.arrow', this).toggleClass("caret caret-up");
						//$(this).parent().removeClass('open');						
						$(this).parent().toggleClass('open');
						$(this).removeAttr('style');
					}
				});
			}
		});*/
/*
		$('.navbar .dropdown > a').click(function(){
			if(_width >= 768)
				location.href = this.href;
		});
*/
	$('.dropdown-toggle').click(function() {
		if(_width >= 768){
			var location = $(this).attr('href');
			window.location.href = location;
			return false;
		}
	});
	// jQuery powered scroll to top
jQuery(document).ready( function() {
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() > 300) {
			jQuery(".scroll-to-top").fadeIn()
		}
		else {
			jQuery(".scroll-to-top").fadeOut()
		}
	});

	jQuery(".scroll-to-top").click(function() {
		jQuery("html, body").animate({
			scrollTop: 0
		}, 800);
		return false
	});
});

} )( jQuery );