<?php 

class CurlyShortcodes {
	
	function __construct() {
		
		add_filter('widget_text', 'do_shortcode');
		add_filter('widget_title', 'do_shortcode');
		
		/** Icon Shortcode */
		add_shortcode( 'icon', array( $this, 'icon_shortcode' ) );
		
		/** Dropcap Shortcode */
		add_shortcode( 'dropcap', array( $this, 'dropcap_shortcode' ) );
		
		/** Lead Shortcode */
		add_shortcode( 'lead', array( $this, 'lead_shortcode' ) );
		
		/** MCE Buttons */
		add_filter( 'tiny_mce_before_init', array( $this, 'fb_mce_before_init' ) );
		
		/** MCE Buttons Order */
		add_filter( 'mce_buttons_2', array( $this, 'fb_mce_editor_buttons' ) );
		
	}
	
	/** Lead Shortcode */
	function lead_shortcode( $atts, $content = null ) {
		return '<p class="lead">'.$content.'</p>';
	}
	
	/** Dropcap Shortcode */
	function dropcap_shortcode( $atts, $content = null ) {
		return '<span class="dropcap">'.$content.'</span>';
	}
		
	/** Icon Shortcode */
	function icon_shortcode( $atts, $content = null ) {
		
		$css = $style = array();
		
		/** Check for icon */
		if ( isset( $atts['icon'] ) ) {
			
			/** Set icon */
			if ( strpos( $atts['icon'] ,'fa-') !== false ){
				
				$mode = 0;
				
			} else if ( strpos( $atts['icon'] ,'ti-') !== false ) {
				
				$mode = 1;
				
			} else{
				
				return;
				
			}
			
			$icon = $atts['icon'];
			
			/** Set icon size */
			if ( isset( $atts['size'] ) ) {
				switch ( strtolower( $atts['size'] ) ) {
					case '2x' : $icon .= ' fa-2x'; break;
					case '3x' : $icon .= ' fa-3x'; break;
					case '4x' : $icon .= ' fa-4x'; break;
					case '5x' : $icon .= ' fa-5x'; break;
					case 'lg' : $icon .= ' fa-lg'; break;
				}
			}
			
			/** Display */
			if ( isset( $atts['display'] ) ) {
				switch ( strtolower( $atts['display'] ) ) {
					case 'inline' : $icon .= ' fa-inline'; break;
					case 'block'  : $icon .= ' fa-block'; break;
				}
			}
			
			/** Icon color */
			if ( isset( $atts['color'] ) ) {
				array_push( $style, 'color: '.$atts['color'] );
			}
			
			/** Border */
			if ( isset( $atts['border'] ) ) {
				array_push( $css, 'fa-bordered' );
				array_push( $style, 'border: '.$atts['border'] );
			}
			if ( isset( $atts['border_color'] ) || isset( $atts['border_style'] ) || isset( $atts['border_size'] ) ) {
				array_push( $css, 'fa-bordered' );
				if ( isset( $atts['border_color'] )  ) {
					array_push( $style, 'border-color: '.$atts['border_color'] );
				}
				if ( isset( $atts['border_style'] )  ) {
					array_push( $style, 'border-style: '.$atts['border_style'] );
				}
				if ( isset( $atts['border_size'] )  ) {
					array_push( $style, 'border-width: '.$atts['border_size'] );
				}
			}
			
			/** Style */
			if ( isset( $atts['boxed'] ) && $atts['boxed'] == 'yes' ) {
				array_push( $css, 'fa-boxed' );
			}
			
			/** Background */
			if ( isset( $atts['background'] ) ) {
				array_push( $css, 'fa-boxed' );
				array_push( $style, 'background-color: '.$atts['background'] );
			}
			
			
		}
		
		if( ! is_null( $content ) && ! empty( $content ) ){
			
			$block_size = isset( $atts['size'] ) ? 'icon-bullet--' . strtolower( $atts['size'] ) : '';
			
			return isset( $atts['icon'] ) ? "<div class='icon-bullet $block_size'><i class='fa fa-fw $icon ".implode( ' ', $css )."' style='".implode( '; ', $style )."'></i>" . do_shortcode( $content ) . "</div>" : null;
			
		} else {
			
			return isset( $atts['icon'] ) ? "<i class='fa fa-fw $icon ".implode( ' ', $css )."' style='".implode( '; ', $style )."'></i>" : null;
			
		}
		
	}
	
		/* MCE Buttons 
	================================================= */		
	function fb_mce_before_init( $settings ) {
	
	    $style_formats = array(
	        array(
	            'title' => 'Button - Inline',
	            'selector' => 'a',
	            'classes' => 'btn btn-inline'
	            ),
	        array(
	            'title' => 'Button - Defaut',
	            'selector' => 'a',
	            'classes' => 'btn btn-default'
	            ),
	        array(
	            'title' => 'Button - Link',
	            'selector' => 'a',
	            'classes' => 'btn btn-link'
	            ), 
	        array(
	            'title' => 'Button - Primary',
	            'selector' => 'a',
	            'classes' => 'btn btn-primary'
	            ),            
	        array(
	            'title' => 'Paragraph - Lead',
	            'selector' => 'p',
	            'classes' => 'lead',
	        )
	    );
	
	    $settings['style_formats'] = json_encode( $style_formats );
	
	    return $settings;
	
	}

/*	MCE Buttons Order
	================================================= */	
	function fb_mce_editor_buttons( $buttons ) {
	
	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;
	}
	
	
}

new CurlyShortcodes();
?>