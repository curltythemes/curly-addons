<?php 
	
	class CurlyVCPolaroids{
		
		function __construct(){
			
			/** Construct Polaroids */
			add_action( 'vc_before_init', array( $this, 'vc_polaroids' ) );
			add_shortcode( 'curly_polaroids', array( $this, 'polaroids' ) );
			add_shortcode( 'curly_polaroid', array( $this, 'polaroid' ) );
			
			/** Register Assests */
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		}
		
		
		
		/** Assets Hook */
		function register_assets(){
			
			
			/** Register Scripts */
			wp_enqueue_script(
				'curly-polaroids-modernizr', 
				CURLY_ADDONS_URL . '/assets/libs/polaroids/js/modernizr.min.js', 
				null, 
				null,
				false
			);
			
			wp_register_script(
				'curly-polaroids-classie', 
				CURLY_ADDONS_URL . '/assets/libs/polaroids/js/classie.js', 
				null, 
				null, 
				true
			);
			
			wp_register_script(
				'curly-polaroids-photostack', 
				CURLY_ADDONS_URL . '/assets/libs/polaroids/js/photostack.js', 
				array( 'curly-polaroids-modernizr', 'curly-polaroids-classie' ), 
				null, 
				true
			);
			
			wp_register_script(
				'curly-polaroids', 
				CURLY_ADDONS_URL . '/assets/libs/polaroids/js/min/polaroids-min.js', 
				array('curly-polaroids-classie', 'curly-polaroids-photostack' ), 
				null, 
				true
			);
			
			
			/** Register Styles */
			wp_register_style( 
				'curly-polaroids', 
				CURLY_ADDONS_URL . '/assets/libs/polaroids/css/component.css', 
				null, 
				false, 
				'all'
			);
			
		}
		
		
		
		function vc_polaroids(){
			
			/** Carousel Container */
			vc_map( array(
			   "name" => __("Polaroids Gallery", "CURLYTHEME"),
			   "base" => "curly_polaroids",
			   "as_parent" => array('only' => 'curly_polaroid'),
			   "content_element" => true,
			   'is_container' => true,
			   "show_settings_on_create" => false,
			   "admin_enqueue_css" => array( CURLY_ADDONS_URL.'/framework/css/vc-icon.css' ),
			   "icon" => "curly_icon",
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
			            "type" => "attach_images",
			            "heading" => __("Background Images", "CURLYTHEME"),
			            "param_name" => "images"
			        ),
			   ),
			   "js_view" => 'VcColumnView'
			) );
			
			/** Carousel Item */
			vc_map( array(
			    "name" => __("Polaroid", "CURLYTHEME"),
			    "base" => "curly_polaroid",
			    "content_element" => true,
			    "icon" => "curly_icon",
			    "as_child" => array('only' => 'curly_polaroids'), 			    
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
			        )
			    )
			) );
		}
		
		/** Polaroids Shortcode */
		public function polaroids( $atts, $content = null ) {
			
			if( ! wp_script_is( 'curly-polaroids', 'enqueued' ) )
				wp_enqueue_script( 'curly-polaroids' );
			
			if( ! wp_style_is( 'curly-polaroids', 'enqueued' ) )
				wp_enqueue_style( 'curly-polaroids' );	
			
			$atts = shortcode_atts( array(
				'title' => null,
				'images'=> null
			), $atts, 'curly_polaroids' );
			
			$html = null;
			
			if( $atts['images'] ){
				$html .= "<section id='photostack-1' class='photostack photostack-perspective photostack-transition'><div>";
				
				$images = explode( ',', $atts['images'] );
				
				foreach( $images as $image ){
					$html .= "<figure data-dummy>";
					$html .= "<a href='#' class='photostack-img'>" . wp_get_attachment_image( $image, 'medium' ) . '</a>';
					$html .= "<figcaption><h2 class='photostack-title'>" . get_the_title( $image ) . "</h2></figcaption>";
					$html .= "</figure>";
				}
				
				$html .= do_shortcode( $content );
				$html .= "</div></section>";	
			}
			
			return $html;
		}
		
		/** Polaroid Shortcode */
		public function polaroid( $atts, $content = null ) {
			
			$atts = shortcode_atts( array(
				'image'=> null,
				'title'=> null
			), $atts, 'curly_polaroid' );
			
			$html  = "<figure>";
			$html .= "<a href='#' class='photostack-img'>" . wp_get_attachment_image( $atts['image'], 'medium' ) . '</a>';
			$html .= "<figcaption><h2 class='photostack-title'>" .  $atts['title'] . "</h2></figcaption>";
			$html .= "</figure>";
			
			return $html;
		}
		
		
	}
	
	new CurlyVCPolaroids();
	
?>