<?php 
	
	class CurlyVCServicesCarousel{
		
		function __construct(){
			
			/** Construct Services Carousel */
			add_action( 'vc_before_init', array( $this, 'services_carousel_vc' ) );
			add_shortcode( 'curly_services_carousel', array( $this, 'services_carousel' ) );
			add_shortcode( 'curly_service', array( $this, 'service' ) );
			
			/** Register Assests */
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		}
		
		
		
		/** Assets Hook */
		function register_assets(){
			
		}
		
		
		public function services_carousel( $atts, $content = null ){
			
			if( ! wp_script_is( 'curly-owl-carousel' ) )
				wp_enqueue_script( 'curly-owl-carousel' );
				
			if( ! wp_script_is( 'curly-addons-main' ) )
				wp_enqueue_script( 'curly-addons-main' );	
			
			$atts = shortcode_atts( array(
				'title' => null,
				'subtitle'		=> null,
				'items'	=> 3,
				'items_tablet'	=> 2,
				'items_mobile'	=> 1,
				'dots'	=> null,
				'hover'	=> null,
				'loop'	=> null,
				'next'	=> null,
				'prev'	=> null,
				'css'	=> null,
				'autoplay_speed'	=> 2000
			), $atts, 'curly_services_carousel' );
			
			extract( $atts );
			
			$el_class = $css;
			
			$html = null;
			
			if( ! empty( $title ) ){
				$html .= '<h2 class="text-center">';
				$html .= ! empty( $subtitle ) ? "<small>$subtitle</small>" : '';
				$html .= $title;
				$html .= '</h2>';
			}

			$dots			= filter_var( $atts['dots'], FILTER_VALIDATE_BOOLEAN );
			$dots			= $dots ? 'true' : 'false';
			
			$hover			= filter_var( $atts['hover'], FILTER_VALIDATE_BOOLEAN );
			$hover			= $hover ? 'true' : 'false';
			
			$loop			= filter_var( $atts['loop'], FILTER_VALIDATE_BOOLEAN );
			$loop   		= $loop ? 'true' : 'false';
			
			
			if ( isset( $atts['next'] ) && isset( $atts['prev'] ) ) {
				$nav = 'true';
				$nav_text = array( $atts['prev'], $atts['next'] );
			} else {
				$nav = 'false';
				$nav_text = array();
			}
			
			if ( $atts['autoplay_speed'] ) {
				$autoplay = 'true';
				$autoplay_speed = $atts['autoplay_speed'];
			} else {
				$autoplay = 'false';
				$autoplay_speed = 0;
			}
			
			if ( $nav === 'true' || $dots === 'true' ) {
				$el_class .= ' owl-with-navigation';
			}
			
			$nav_text = wp_json_encode( $nav_text );
			
			$html .= "<div class='ct-vc-services-carousel $el_class' data-owl-items='$items' data-owl-nav='$nav' data-owl-nav-text='$nav_text' data-owl-loop='$loop' data-owl-autoplay='$autoplay' data-owl-speed='$autoplay_speed' data-owl-hover='$hover' data-owl-mobile='$items_mobile' data-owl-tablet='$items_tablet' data-owl-dots='$dots'>".do_shortcode( $content )."</div>";
			
			return $html;
			
		}
		
		/** Service Shortcode */
		public function service( $atts, $content = null ){
		
			$atts = shortcode_atts( array(
				'title' => null,
				'image'	=> null,
				'description'	=> null,
				'link'	=> '#'
			), $atts, 'curly_service' );
			
			extract( $atts );
			
			$link = esc_url_raw( $link );
			$title = esc_attr( $title );
			$description = esc_attr( $description );
			$description  = ! empty( $description ) ? "<p>$description</p>" : '';
			$image = esc_attr( $image );
			$image = wp_get_attachment_image( $image , 'large' );
			$image = $image ? $image : "<img src='" . vc_asset_url( 'vc/no_image.png' ) . " alt='$title'>";
			
			$html  = "<div class='ct-vc-services-carousel__item'>";
			$html .= "<a href='$link' class='ct-vc-services-carousel__item-image' title='$title'>$image</a>";
			
			if ( $title || $description ) {
				$html .= $title ? "<h4 class='ct-vc-services-carousel__item-title'><a href='$link'>$title</a></h4>" : '';
				$html .= $description;
			}
			
			$html .= '</div>';

			return $html;
		}
		
		/** Visual Composer Services Carousel */
		public function services_carousel_vc() {
		
			/** Carousel Container */
			vc_map( array(
			   "name" => __("Services Carousel", "CURLYTHEME"),
			   "base" => "curly_services_carousel",
			   "as_parent" => array('only' => 'curly_service'),
			   'is_container' => true,
			   "show_settings_on_create" => false,
			  // "admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			   "class" => "",
			   "category" => __('Curly Addons', "CURLYTHEME"),
			   "params" => array(
			   	  array(
			   	     "type" => "textfield",
			   	     "heading" => __("Widget Title", "CURLYTHEME"),
			   	     'edit_field_class' => 'vc_col-sm-6',
			   	     "param_name" => "title",
			   	     "value" => null,
			   	     "description" => __("Enter widget title", "CURLYTHEME")
			   	  ),
			   	  array(
			   	     "type" => "textfield",
			   	     "heading" => __("Widget Subtitle", "CURLYTHEME"),
			   	     'edit_field_class' => 'vc_col-sm-6 vc_column',
			   	     "param_name" => "subtitle",
			   	     "value" => null,
			   	     "description" => __("Enter widget subtitle", "CURLYTHEME")
			   	  ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Desktop Services", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4',
			         "param_name" => "items",
			         "value" => 4,
			         "description" => __("Services on a computer", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Tablet Services", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4',
			         "param_name" => "items_tablet",
			         "value" => 2,
			         "description" => __("Services on a tablet", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Mobile Services", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4 vc_column',
			         "param_name" => "items_mobile",
			         "value" => 1,
			         "description" => __("Services on a mobile", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Autoplay Speed", "CURLYTHEME"),
			         "param_name" => "autoplay_speed",
			         "value" => 2000,
			         "description" => __("Choose the carousel autoplay speed in milliseconds. Leave blank to disable the autoplay", "CURLYTHEME")
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Pause on hover", "CURLYTHEME"),
			         "param_name" => "hover",
			         'value' => array( __( 'Yes, pause carousel on hover', 'CURLYTHEME' ) => 'yes' )
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Loop", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "loop",
			         'value' => array( __( 'Yes, play the carousel in a loop', 'CURLYTHEME' ) => 'yes' )
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Navigation", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "dots",
			         'value' => array( __( 'Yes, enable dots navigation', 'CURLYTHEME' ) => 'yes' )
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Next Button Text", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "next",
			         "value" => '',
			         "description" => __("Leave blank to disable links", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Previous Button Text", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "prev",
			         "value" => '',
			         "description" => __("Leave blank to disable links", "CURLYTHEME")
			      ),
				  array(
					 'type' => 'css_editor',
					 'heading' => __( 'Css', 'js_composer' ),
					 'param_name' => 'css'
				  )
			   ),
			   "js_view" => 'VcColumnView'
			) );
			
			/** Carousel Item */
			vc_map( array(
			    "name" => __("Carousel Service", "CURLYTHEME"),
			    "base" => "curly_service",
			    "content_element" => true,
			    "as_child" => array('only' => 'curly_services_carousel'), 			    
			    "params" => array(
			        array(
			            "type" => "textfield",
			            "heading" => __("Title", "CURLYTHEME"),
			            "holder" => "div",
			            "value" => "Some title here",
			            "param_name" => "title"
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Description", "CURLYTHEME"),
			            "value" => '',
			            "param_name" => "description"
			        ),
			        array(
			            "type" => "attach_image",
			            "heading" => __("Image", "CURLYTHEME"),
			            "param_name" => "image"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Link", "CURLYTHEME"),
			            "value" => "#",
			            "param_name" => "link"
			        ),
			        array(
			            "type" => "checkbox",
			            "heading" => __("Open link in new window", "CURLYTHEME"),
			            "param_name" => "new"
			        )
			    )
			) );
		}
		
		
	}
	
	new CurlyVCServicesCarousel();
	
	function curly_addons_services_carousel(){
		
		/** Extend Classes */
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_Curly_Services_Carousel extends WPBakeryShortCodesContainer {}
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
		    class WPBakeryShortCode_Curly_Service extends WPBakeryShortCode {}
		}
		
	}
	
	add_action( 'vc_before_init', 'curly_addons_services_carousel' );
	
	
	
?>