<?php
/**
 * Use an output buffer to replace the last strings we cannot get to otherwise
 *
 * @link http://www.dagondesign.com/articles/wordpress-hook-for-entire-page-using-output-buffering/
 *
 * @package Thematic-HTML5
 **/

if( !function_exists( 'wp_get_theme' ) ) {
	add_action('admin_notices', 'thematic_html5_upgrade_notice');	
} else {
	
    $frameworkData = wp_get_theme( 'thematic' );

	if( '1.0.2' >= $frameworkData->Version ) {
		// use output buffering if the filters are not available
		add_action( 'wp_head', 'thematic_html5_buffer_start', -999 );
		add_action( 'wp_footer', 'thematic_html5_buffer_end' );
	} else {
		add_filter( 'thematic_open_header', 'thematic_html5_open_header' );
		add_filter('thematic_close_header', 'thematic_html5_close_header' );
		
		add_filter( 'thematic_open_footer', 'thematic_html5_open_footer' );
		add_filter('thematic_close_footer', 'thematic_html5_close_footer' );
	}
}
	
	
/**
 * Filter the opening tag of #header
 *
 * @since 0.1
 **/
function thematic_html5_open_header( $content ) {
	$content = '<header id="header">';
	return $content;
}

/**
 * Filter the closing tag of #header
 *
 * @since 0.1
 **/
function thematic_html5_close_header( $content ) {
	$content = '</div><!-- #header-->';
	return $content;
}

/**
 * Filter the opening tag of #footer
 *
 * @since 0.1
 **/
function thematic_html5_open_footer( $content ) {
	$content = '<footer id="footer">';
	return $content;
}

/**
 * Filter the closing tag of #footer
 *
 * @since 0.1
 **/
function thematic_html5_close_footer( $content ) {
	$content = '</footer><!-- #footer -->';
	return $content;
}

/**
 * Output error notice if Wordpress version is less than 3.4
 *
 * @since 0.1
 **/
function thematic_html5_upgrade_notice() {
	global $pagenow;
	if ( $pagenow == 'plugins.php' ) {
		echo '<div class="error">
			<p>Thematic html5 requires WordPress 3.4 or higher. Please upgrade your installation.</p>
		</div>';
	}
}


function thematic_html5_buffer_callback( $buffer ) {
	
	// replace the #header div with header element
	$buffer = str_replace( '<div id="header">', '<header id="header">', $buffer);
	$buffer = str_replace( '</div><!-- #header-->', '</header><!-- #header-->', $buffer );
	
	// replace any post div with article element
	$buffer = str_replace( '<div id="post-', '<article id="post-', $buffer);
	$buffer = str_replace( '</div><!-- #post -->', '</article><!-- #post -->', $buffer );

	// replace the #footer div with footer element
	$buffer = str_replace( '<div id="footer">', '<footer id="footer">', $buffer);
	$buffer = str_replace( '</div><!-- #footer -->', '</footer><!-- #footer -->', $buffer );
	
	return $buffer;
}


function thematic_html5_buffer_start() {
	ob_start('thematic_html5_buffer_callback');
}

function thematic_html5_buffer_end() {
	ob_end_flush();
}



?>