<?php 
	
	class CurlyVCTextSeparator{
		
		function __construct(){
			
			add_action( 'vc_before_init', array( $this, 'vc_text_separator' ) );
			add_shortcode( 'curly_text_separator', array( $this, 'separator' ) );

		}
		
		
		
		function vc_text_separator(){
			
			
			/** Carousel Item */
			vc_map( array(
			    "name" => __("Text Separator", "CURLYTHEME"),
			    "base" => "curly_text_separator",
			    "content_element" => true,
			    "icon" => "curly_icon", 			    
			    "params" => array(
			        array(
			            "type" => "textfield",
			            "heading" => __("Title", "CURLYTHEME"),
			            "holder" => "div",
			            "value" => "Some title here",
			            "param_name" => "title"
			        )
			    )
			) );
		}
		
		/** Polaroid Shortcode */
		public function separator( $atts, $content = null ) {
			
			$atts = shortcode_atts( array(
				'title'=> null
			), $atts, 'curly_text_separator' );
			
			extract( $atts );
			
			$html = "<span class='ct-vc-text-separator'>$title</span><div class='ct-vc-text-separator__holder'></div>";
			
			return $html;
		}
		
		
	}
	
	new CurlyVCTextSeparator();
	
?>