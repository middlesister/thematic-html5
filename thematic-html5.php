<?php
/**
 * Plugin Name: Thematic HTML5
 * Plugin URI: http://github.com/middlesister/thematic-html5
 * Description: A wordpress plugin to use html5 markup with the thematic theme framework 
 * Version: 0.2
 * Author: Karin Taliga
 * 
 * @package Thematic-HTML5
 */

// include the main plugin class
require( plugin_dir_path( __FILE__ ) . 'class-ivst-thematic-html5.php' );

// launch plugin
new Ivst_Thematic_Html5();

?>