jQuery.noConflict()(function($){

	"use strict";

/* ===============================================
   HEADER CART
   ============================================= */
	
	$('#header-wrapper.header-10 .header-cart').hover(
		
		function () {
			$(this).children('a.cart-contents').addClass('active');
		}, 
		function () {
			$(this).children('a.cart-contents').removeClass('active');
		}
			
	);

});          