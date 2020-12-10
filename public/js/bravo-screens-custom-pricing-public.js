(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	console.log('changing to list view instead of grid view');
	$('.woocommerce ul.products').removeClass('grid').addClass('list');
	
	$.getScript('https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', function()
	{
		// $('.bs_custom_reviews').slick({
		// 	infinite: true,
		// 	slidesToShow: 3,
		// 	slidesToScroll: 3
		// });
		
		console.log('slick slider loaded');
		
		$('.bs_custom_reviews').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			arrows: true,
			prevArrow: '<button type="button" class="custom-slider-nav custom-slider-prev">&#x8b;</button>',
			nextArrow: '<button type="button" class="custom-slider-nav custom-slider-next">&#x9b;</button>',
			//autoplaySpeed: 5000,
			pauseOnHover: true,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: true
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});
	});

})( jQuery );
