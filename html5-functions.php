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


/**
 * Filter the opening tags of the widget areas
 * 
 * Replace the div with aside, remove the wrapping ul
 *
 * @since 0.1
 */
function thematic_html5_before_widget_area($content) {
	$content = str_replace( '<div', '<aside ', $content);
	$content = str_replace( '<ul class="xoxo">', ' ', $content);
	return $content;
}
add_filter('thematic_before_widget_area','thematic_html5_before_widget_area');


/**
 * Filter the closing tags of the widget areas
 * 
 * Remove the wrapping ul, replace the div with aside
 *
 * @since 0.1
 */
function thematic_html5_after_widget_area($content) {
	$content = str_replace( '</ul>', ' ', $content);
	$content = str_replace( '</div>', '</aside>', $content);
	return $content;
}
add_filter('thematic_after_widget_area','thematic_html5_after_widget_area');


/**
 * Filter the opening tag of each widget to use section element
 *
 * @since 0.1
 **/
function thematic_html5_before_widget( $content ) {
	$content = '<section id="%1$s" class="widgetcontainer %2$s">';
	return $content;
}
add_filter('thematic_before_widget','thematic_html5_before_widget');


/**
 * Filter the closing tag of each widget area to use section element
 *
 * @since 0.1
 **/
function thematic_html5_after_widget( $content ) {
	$content = '</section>';
	return $content;
}
add_filter('thematic_after_widget','thematic_html5_after_widget');


/**
 * Filter the title of widget areas
 *
 * @since 0.1
 **/
function thematic_html5_before_widgettitle( $content ) {
	$content = "<h1 class=\"widgettitle\">";
	return $content;
}
add_filter('thematic_before_title','thematic_html5_before_widgettitle');


/**
 * Filter the title of widget area
 *
 * @since 0.1
 **/
function thematic_html5_after_widgettitle( $content ) {
	$content = "</h1>\n";
	return $content;
}
add_filter('thematic_after_title','thematic_html5_after_widgettitle');



?>