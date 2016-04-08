<?php

/**	
Plugin Name: Curly Addons
Plugin URI: http://demo.curlythemes.com/verifyr/
Description: This plugins adds more flavour to your Curly Theme.
Version: 1.0
Author: Curly Themes
Author URI: http://demo.curlythemes.com
Text Domain: CurlyAddons
*/

define( 'CURLY_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'CURLY_ADDONS_URL', plugin_dir_url( __FILE__ ) );

/** Shortcodes */
require_once( CURLY_ADDONS_PATH . '/class.shortcodes.php' );

/** Widgets */
require_once( CURLY_ADDONS_PATH . '/widgets/class.logo.php');

/** Visual Composer */
require_once( CURLY_ADDONS_PATH . '/vc/class.text-separator.php');
require_once( CURLY_ADDONS_PATH . '/vc/class.recent-news.php');
require_once( CURLY_ADDONS_PATH . '/vc/class.services-carousel.php');

add_action( 'wp_enqueue_scripts', 'curly_addons_register_assets' );

function curly_addons_register_assets(){
	
	wp_register_script(
		'curly-addons-main', 
		CURLY_ADDONS_URL . '/assets/js/min/main-min.js', 
		array( 'jquery' ), 
		null, 
		true
	);
	
	wp_enqueue_style( 
		'curly-addons', 
		CURLY_ADDONS_URL . '/assets/css/addons.css', 
		null, 
		null, 
		'all'
	);
			
}

?>