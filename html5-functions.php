<?php
/**
 * Html5 functions
 *
 * These are the main plugin functions 
 *
 * @package Thematic-HTML5
 **/

/**
 * Add the filters to thematic if theme supports it
 * 
 * All filters need to be attached to the after_setup_theme hook in order
 * to let the theme decide whether to use html5 or not. If you want to switch 
 * to html5, simply add <code>add_theme_support('thematic-html5');</code>
 * to your child theme's functions.php file.
 *
 * @since 0.1
 */
function thematic_html5_add_filters() {

	if ( current_theme_supports( 'thematic-html5' ) ) {

		// create the html5 doctype
		add_filter('thematic_create_doctype', 'thematic_html5_create_doctype');
		
		// remove the profile attribute from the head tag and add the meta tag charset
		add_filter('thematic_head_profile', 'thematic_html5_head');
		
		// remove meta tag contenttype
		add_filter('thematic_create_contenttype', 'thematic_html5_remove_charset');
		
		// filter the main menu to use the nav element
		add_filter('thematic_nav_menu_args','thematic_html5_navmenu_args');
		
		// filter the fallback page menu to also use the nav element
		add_filter('wp_page_menu','thematic_html5_pagemenu');
		
		// filter the fallback page menu to also use the nav element
		add_filter('wp_link_pages_args','thematic_html5_pagelinks');
		
		
		// add the post header filter if a child theme is not overriding it already
		if ( !function_exists( 'childtheme_override_postheader' ) )
			add_filter('thematic_postheader','thematic_html5_postheader');

		// add the post header posttitle filter if a child theme is not overriding it already
		if ( !function_exists( 'childtheme_override_postheader_posttitle' ) )
			add_filter('thematic_postheader_posttitle','thematic_html5_postheader_posttitle');

		// add the post footer filter if a child theme is not overriding it already
		if ( !function_exists( 'childtheme_override_postfooter' ) )
			add_filter('thematic_postfooter','thematic_html5_postfooter');
		
		
		// filter the widget areas to use aside element
		add_filter('thematic_before_widget_area','thematic_html5_before_widget_area');
		add_filter('thematic_after_widget_area','thematic_html5_after_widget_area');
		
		// filter the widgets to use the section element
		add_filter('thematic_before_widget','thematic_html5_before_widget');
		add_filter('thematic_after_widget','thematic_html5_after_widget');
		
		// filter widget titles to us h1 headings
		add_filter('thematic_before_title','thematic_html5_before_widgettitle');
		add_filter('thematic_after_title','thematic_html5_after_widgettitle');
		
		
	}
	
}
add_action('after_setup_theme','thematic_html5_add_filters', '40');


/**
 * Create the html5 doctype instead of xhtml1.
 * 
 * @since 0.1 
 */
function thematic_html5_create_doctype( $content ) {
	$content = '<!DOCTYPE html>';
	$content .= "\n";
	$content .= '<html';
	return $content;
}


/**
 * Remove the profile attribute from the head tag and add the meta tag charset
 *
 * @since 0.1 
 */
function thematic_html5_head( $content ) {
	$content = '<head>';
	$content .= "\n";
	$content .= '<meta charset="' . get_bloginfo( 'charset' ) . '">';
	$content .= "\n";
	return $content;
}

 
/**
 * Remove the now defunct meta tag <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 *
 * @since 0.1
 */
function thematic_html5_remove_charset( $content ) {
	$content = '';
	return $content;
}


/**
 * Filter the main menu to use the nav element
 *
 * @since 0.1
 **/
function thematic_html5_navmenu_args( $args ) {
	$args['container'] = 'nav'; 
	return $args;
}


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


/**
 * Filter the post pagination to use the nav element
 *
 * @since 0.1
 **/
function thematic_html5_pagelinks( $args ) {
	$args['before'] = "\t\t\t\t\t<nav class='page-link'>" . __( 'Pages: ', 'thematic' ); 
	$args['after'] = "</nav>\n";
	return $args;
}


/**
 * Filter the post header, wrapping title and post meta in header tags
 *
 * @since 0.1
 **/
function thematic_html5_postheader( $content ) {
	$content = '<header class="entry-header">' . $content;
	$content .= '</header>';
	return $content;
}


/**
 * Filter the post header's post title
 *
 * @since 0.1
 **/
function thematic_html5_postheader_posttitle( $content ) {
	$content = str_replace( 'h2', 'h1', $content);
	return $content;
}


/**
 * Filter the post footer
 *
 * @since 0.1
 **/
function thematic_html5_postfooter( $content ) {
	$content = str_replace( '<div class="entry-utility">', '<footer class="entry-utility">', $content);
	$content = str_replace( '</div><!-- .entry-utility -->', '</footer><!-- .entry-utility -->', $content );
	return $content;
}


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


/**
 * Filter the opening tag of each widget to use section element
 *
 * @since 0.1
 **/
function thematic_html5_before_widget( $content ) {
	$content = '<section id="%1$s" class="widgetcontainer %2$s">';
	return $content;
}


/**
 * Filter the closing tag of each widget area to use section element
 *
 * @since 0.1
 **/
function thematic_html5_after_widget( $content ) {
	$content = '</section>';
	return $content;
}


/**
 * Filter the title of widget areas
 *
 * @since 0.1
 **/
function thematic_html5_before_widgettitle( $content ) {
	$content = "<h1 class=\"widgettitle\">";
	return $content;
}


/**
 * Filter the title of widget area
 *
 * @since 0.1
 **/
function thematic_html5_after_widgettitle( $content ) {
	$content = "</h1>\n";
	return $content;
}



?>