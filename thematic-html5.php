<?php
/**
 * Plugin Name: Thematic HTML5
 * Plugin URI: http://github.com/middlesister/thematic-html5
 * Description: A wordpress plugin to use html5 markup with the thematic theme framework 
 * Version: 0.1
 * Author: Karin Taliga a.k.a Middlesister
 * 
 * @package Thematic-HTML5
 */

/* Launch the plugin. */
add_action( 'plugins_loaded', 'thematic_html5_init' );

/**
 * Initialize the plugin
 *
 * @since 0.1
 **/
function thematic_html5_init() {
	/* Load the translation of the plugin. */
	load_plugin_textdomain( 'thm_html5', false, '/languages' );
	
	/* Load plugin functions */
	require_once( plugin_dir_path( __FILE__ ) . '/html5-functions.php' );
	
	/* Load override functions */
	require_once( plugin_dir_path( __FILE__ ) . '/html5-overrides.php' );
	
}



?>