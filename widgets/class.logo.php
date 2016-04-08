<?php

add_action( 'widgets_init', 'curly_addons_logo_widget' );


function curly_addons_logo_widget() {
	register_widget( 'Curly_Addons_Logo_Widget' );
}

class Curly_Addons_Logo_Widget extends WP_Widget {
	
	function __construct() {
		
		$widget_ops = array( 'classname' => 'curly_addons_logo', 'description' => __('A widget that displays a retina logo', 'CURLYTHEME') );
		
		parent::__construct( 'curly_addons_logo_widget', __('Curly Addons: Retina Logo', 'CURLYTHEME'), $widget_ops);
		
		add_action( 'admin_enqueue_scripts', array( $this, 'upload_scripts' ) );
		
	}
	
	public function upload_scripts(){
		
        wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_media();
        wp_enqueue_script( 'curly-addons-widgets-logo', plugin_dir_url(__FILE__) . 'js/logo.js', array('jquery') );
        
        wp_enqueue_style( 'curly-addons-widgets-logo', plugin_dir_url(__FILE__) . 'css/logo.css', false, null, 'all' );

    }
	
	function widget( $args, $instance ) {
		
		extract( $args );

		$title	= apply_filters( 'widget_title', $instance['title'] );
		$logo 	= esc_url_raw( $instance['logo'] );
		$logo_retina = esc_url_raw( $instance['logo_retina'] );
		$link 	= esc_url_raw( $instance['link'] );
		$target = esc_attr( $instance['target'] );
		$target = filter_var( $target, FILTER_VALIDATE_BOOLEAN ) ? ' target="_blank"' : '';
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
			
		$logo_retina	= ! empty( $logo_retina ) ? "srcset='$logo_retina 2x'" : '';

		$output = ! empty( $logo ) ? "<img src='$logo' $logo_retina alt='$title'>" : $title; 
		
		echo "<a href='$link' $target>$output</a>";
		
		echo $after_widget;
	}

	 
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['logo'] = esc_url_raw( $new_instance['logo'] );
		$instance['logo_retina'] = esc_url_raw( $new_instance['logo_retina'] );
		$instance['link'] = esc_url_raw( $new_instance['link'] );
		$instance['target'] = esc_attr( $new_instance['target'] );
	
		return $instance;
	}

	
	function form( $instance ) {
		
		$defaults = array(
			'title' => null,
			'logo' => null,
			'logo_retina' => null,
			'link' => null,
			'target' => null
		);


		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<div class="widget-content ct-addons-logo">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', 'CURLYTHEME'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </p>
			
            
            <p>
                <label for="<?php echo $this->get_field_id( 'logo' ); ?>"><?php _e('Logo:', 'CURLYTHEME'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'logo' ); ?>" name="<?php echo $this->get_field_name( 'logo' ); ?>" value="<?php echo $instance['logo']; ?>" class="widefat" />
              
                <a href="#" class="image-upload-button button button-primary button-large" data-upload-title="<?php _e( 'Upload Image', 'CURLYTHEME'); ?>" data-upload-button="<?php _e( 'Insert Image', 'CURLYTHEME' ) ?>"><?php _e( 'Upload Image', 'CURLYTHEME' ); ?></a>
                <a href="#" class="image-clear-button button button-large"><?php _e( 'Clear Image' , 'CURLYTHEME' ) ?></a>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'logo_retina' ); ?>"><?php _e('Retina Logo:', 'CURLYTHEME'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'logo_retina' ); ?>" name="<?php echo $this->get_field_name( 'logo_retina' ); ?>" value="<?php echo $instance['logo_retina']; ?>" class="widefat" />
                <a href="#" class="image-upload-button button button-primary button-large" data-upload-title="<?php _e( 'Upload Image', 'CURLYTHEME'); ?>" data-upload-button="<?php _e( 'Insert Image', 'CURLYTHEME' ) ?>"><?php _e( 'Upload Image', 'CURLYTHEME' ); ?></a>
                <a href="#" class="image-clear-button button button-large"><?php _e( 'Clear Image' , 'CURLYTHEME' ) ?></a>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'Link' ); ?>"><?php _e('Link:', 'CURLYTHEME'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" class="widefat" />
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'target' ); ?>"><input type="checkbox" id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>" value="1" <?php checked( $instance['target'], 1, true ); ?> ><?php _e('Open link in new window', 'CURLYTHEME'); ?></label>  
            </p>
            
		</div> 

	<?php
	}
}
?>