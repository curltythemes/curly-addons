(function ($) {
    "use strict";
  	
  	$(function() {
	  	
  	   if( $('.ct-vc-services-carousel').length > 0 ){
	  	   
			$('.ct-vc-services-carousel').each(function(){
				
				var container = $(this);
				var nav_text  = container.data('owl-nav-text') ;
					//nav_text  = $.map(nav_text, function(el) { return el; });
				console.log(nav_text);
				imagesLoaded( container, function(){
					container.owlCarousel({
						items				: container.data('owl-items'),
						margin				: 10,
						nav					: container.data('owl-nav'),
						navText				: nav_text,
						loop 				: container.data('owl-loop'),
						autoplay 			: container.data('owl-autoplay'),
						autoplayTimeout		: container.data('owl-speed'),
						autoplayHoverPause	: container.data('owl-hover'),
						responsive			: {
							0 : {
								items 	: container.data('owl-mobile'),
								dots	: container.data('owl-dots'),
								nav		: container.data('owl-nav')
							},
							767 : {
								items 	: container.data('owl-tablet'),
								dots	: container.data('owl-dots')
							},
							992 : {
								items 	: container.data('owl-items'),
								dots	: container.data('owl-dots')
							}
						}
					});
				});
			});
			
	  	}
	  	
	    
  	});
 
})(jQuery);
