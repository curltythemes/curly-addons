(function($) {
  	"use strict";
  	
  	function call_image_field() {
		
		$('.image-upload-button').click(function (e) {
			var el = $(this).parent();
			var button = $(this);
			e.preventDefault();
			var uploader = wp.media({
				title : button.data('upload-title'),
				button : {
					text : button.data('upload-button')
				},
				multiple : false
			})
			.on('select', function () {
				var selection = uploader.state().get('selection');
				var attachment = selection.first().toJSON();
				$('input[type=text]', el).val(attachment.url);
			})
			.open();
		});
	}
  	
  	// Document Ready
  	$(document).ready( function() {
	  	
	  	// Clear Buttons
	  	$('.image-clear-button').click( function (e) {
	  		$(this).siblings('input[type=text]').val(null);
	  		e.preventDefault();
	  	});
	  	
	  	// Clear Buttons
	  	$('.video-clear-button').click( function (e) {
	  		$(this).siblings('input[type=text]').val(null);
	  		e.preventDefault();
	  	});
  		
  		
  		// Image Field
  		call_image_field();
  		
  	});
  	
})(jQuery); 
