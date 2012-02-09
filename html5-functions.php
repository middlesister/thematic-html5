<?php
/**
 * Html5 functions
 *
 * These are the main plugin functions 
 *
 * @package Thematic-HTML5
 **/


/**
 * Filter the main menu to use the nav element
 *
 * @since 0.1
 **/
function thematic_html5_navmenu_args( $args ) {
	$args['container'] = 'nav'; 
	return $args;
}
add_filter('thematic_nav_menu_args','thematic_html5_navmenu_args');


/**
 * Filter the fallback page menu to use the nav element
 *
 * @since 0.1
 **/
function thematic_html5_pagemenu( $menu ) {
	$menu = str_replace( '<div class="menu">', '<nav class="menu">', $menu);
	$menu = str_replace( '</div>', '</nav>', $menu );
	return $menu;
}
add_filter('wp_page_menu','thematic_html5_pagemenu');


?>