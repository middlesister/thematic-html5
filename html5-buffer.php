<?php
/**
 * Use an output buffer to replace the last strings we cannot get to otherwise
 *
 * @link http://www.dagondesign.com/articles/wordpress-hook-for-entire-page-using-output-buffering/
 *
 * @package Thematic-HTML5
 **/

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

add_action('wp_head', 'thematic_html5_buffer_start', -999);
add_action('wp_footer', 'thematic_html5_buffer_end');



?>