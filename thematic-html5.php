<?php
/**
 * Plugin Name: Thematic HTML5
 * Plugin URI: http://invistruct.com/wordpress-plugins/thematic-html5/
 * Plugin Author: middlesister
 * Author URI: http://invistruct.com
 * Description: A wordpress plugin to use html5 markup with the thematic theme framework 
 * Version: 0.4.1
 * 
 * @package Thematic-HTML5
 */

// include the main plugin class
require( plugin_dir_path( __FILE__ ) . 'class-ivst-thematic-html5.php' );

// launch plugin
$thematic_html5 = new Ivst_Thematic_Html5();

?>