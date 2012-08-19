<?php
/**
 * The main plugin class for Thematic-html5
 *
 * Adds appropriate filters for making Thematic theme 
 * use html5 elements
 * 
 * @author Karin Taliga <invistruct@gmail.com>
 * @version 0.3
 * @package Thematic-HTML5
 */

/*  Copyright 2012  Karin Taliga  (email : invistruct@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Ivst_Thematic_Html5 {

	/**
	 * Set up the plugin
	 */
	function __construct() {
		add_action('after_setup_theme', array( &$this, 'add_filters' ), '40');
	}
	
	/**
	 * Add content filters to thematic
	 * 
	 * All filters need to be attached to the after_setup_theme hook in order
	 * to check if childtheme_overrides have been defined already
	 *
	 * @since 0.1
	 */
	function add_filters() {

		// create the html5 doctype
		add_filter( 'thematic_create_doctype', array( &$this, 'create_doctype' ) );

		// remove the profile attribute from the head tag and add the meta tag charset
		add_filter( 'thematic_head_profile', array( &$this, 'head_profile' ) );

		// remove meta tag contenttype
		add_filter( 'thematic_create_contenttype', array( &$this, 'remove_charset' ) );

		// filter the main menu to use the nav element
		add_filter( 'thematic_nav_menu_args', array( &$this, 'navmenu_args' ) );

		// filter the fallback page menu to also use the nav element
		add_filter( 'wp_page_menu', array( &$this, 'pagemenu' ) );

		// filter the fallback page menu to also use the nav element
		add_filter( 'wp_link_pages_args', array( &$this, 'pagelinks' ) );


		// add the post header filter if a child theme is not overriding it already
		if ( !function_exists( 'childtheme_override_postheader' ) )
			add_filter( 'thematic_postheader', array( &$this, 'postheader' ) );

		// add the post header posttitle filter if a child theme is not overriding it already
		if ( !function_exists( 'childtheme_override_postheader_posttitle' ) )
			add_filter( 'thematic_postheader_posttitle', array( &$this, 'postheader_posttitle' ) );

		// add the post footer filter if a child theme is not overriding it already
		if ( !function_exists( 'childtheme_override_postfooter' ) )
			add_filter( 'thematic_postfooter', array( &$this, 'postfooter' ) );


		// filter the widget areas to use aside element
		add_filter( 'thematic_before_widget_area', array( &$this, 'before_widget_area' ) );
		add_filter( 'thematic_after_widget_area', array( &$this, 'after_widget_area' ) );

		// filter the widgets to use the section element
		add_filter( 'thematic_before_widget', array( &$this, 'before_widget' ) );
		add_filter( 'thematic_after_widget', array( &$this, 'after_widget' ) );

		// filter widget titles to us h1 headings
		add_filter( 'thematic_before_title', array( &$this, 'before_widgettitle' ) );
		add_filter( 'thematic_after_title', array( &$this, 'after_widgettitle' ) );


		// replace the archive loop
		if ( !function_exists( 'childtheme_override_archive_loop' ) ) {
			remove_action( 'thematic_archiveloop', 'thematic_archive_loop');
			add_action( 'thematic_archiveloop', array( &$this, 'default_loop' ) );
		}

		// replace the author loop
		if ( !function_exists( 'childtheme_override_author_loop' ) ) {
			remove_action( 'thematic_authorloop', 'thematic_author_loop');
			add_action( 'thematic_authorloop', array( &$this, 'default_loop' ) );
		}

		// replace the category loop
		if ( !function_exists( 'childtheme_override_category_loop' ) ) {
			remove_action( 'thematic_categoryloop', 'thematic_category_loop');
			add_action( 'thematic_categoryloop', array( &$this, 'default_loop' ) );
		}

		// replace the index loop
		if ( !function_exists( 'childtheme_override_index_loop' ) ) {
			remove_action( 'thematic_indexloop', 'thematic_index_loop');
			add_action( 'thematic_indexloop', array( &$this, 'index_loop' ) );
		}

		// replace the single post loop
		if ( !function_exists( 'childtheme_override_single_post' ) ) {
			remove_action( 'thematic_singlepost', 'thematic_single_post');
			add_action( 'thematic_singlepost', array( &$this, 'single_post' ) );
		}

		// replace the search loop
		if ( !function_exists( 'childtheme_override_search_loop' ) ) {
			remove_action( 'thematic_searchloop', 'thematic_search_loop' );
			add_action( 'thematic_searchloop', array( &$this, 'default_loop' ) );
		}

		// replace the tag loop
		if ( !function_exists( 'childtheme_override_tag_loop' ) ) {
			remove_action( 'thematic_tagloop', 'thematic_tag_loop');
			add_action( 'thematic_tagloop', array( &$this, 'default_loop' ) );
		}

		// replace the above navigation
		if ( !function_exists( 'childtheme_override_nav_above' ) ) {
			remove_action( 'thematic_navigation_above', 'thematic_nav_above', 2);
			add_action( 'thematic_navigation_above', array( &$this, 'nav_above' ), 2);
		}

		// replace the navigation below
		if ( !function_exists( 'childtheme_override_nav_below' ) ) {
			remove_action( 'thematic_navigation_below', 'thematic_nav_below', 2);
			add_action( 'thematic_navigation_below', array( &$this, 'nav_below' ), 2);
		}
		
		// check wp-version
		if( !function_exists( 'wp_get_theme' ) ) {
			add_action( 'admin_notices',  array( &$this, 'upgrade_notice' ) );	
		} else {

		    $frameworkData = wp_get_theme( 'thematic' );

			// check Thematic version
			if( '1.0.2' >= $frameworkData->Version ) {
				// use output buffering if the filters are not available
				add_action( 'wp_head', array( &$this, 'buffer_start' ), -999 );
				add_action( 'wp_footer', array( &$this, 'buffer_end' ) );
			} else {
				// use the new filters in 1.0.2
				add_filter( 'thematic_open_header',  array( &$this, 'open_header' ) );
				add_filter( 'thematic_close_header',  array( &$this, 'close_header' ) );

				add_filter( 'thematic_open_footer',  array( &$this, 'open_footer' ) );
				add_filter('thematic_close_footer',  array( &$this, 'close_footer' ) );
			}
		}
		
	}

	/**
	 * Output error notice if Wordpress version is less than 3.4
	 *
	 * @since 0.1
	 **/
	function upgrade_notice() {
		global $pagenow;
		if ( $pagenow == 'plugins.php' ) {
			echo '<div class="error">
				<p>Thematic html5 requires WordPress 3.4 or higher. Please upgrade your installation.</p>
			</div>';
		}
	}
	

	/**
	 * Create the html5 doctype instead of xhtml1.
	 * 
	 * @since 0.1 
	 */
	function create_doctype( $content ) {
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
	function head_profile( $content ) {
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
	function remove_charset( $content ) {
		$content = '';
		return $content;
	}
	
	/**
	 * Filter the opening tag of #header
	 *
	 * @since 0.1
	 **/
	function open_header( $content ) {
		$content = '<header id="header">';
		return $content;
	}

	/**
	 * Filter the closing tag of #header
	 *
	 * @since 0.1
	 **/
	function close_header( $content ) {
		$content = '</header><!-- #header-->';
		return $content;
	}	


	/**
	 * Filter the main menu to use the nav element
	 *
	 * @since 0.1
	 **/
	function navmenu_args( $args ) {
		$args['container'] = 'nav'; 
		return $args;
	}


	/**
	 * Filter the fallback page menu to use the nav element
	 *
	 * @since 0.1
	 **/
	function pagemenu( $menu ) {
		$menu = str_replace( '<div class="menu">', '<nav class="menu">', $menu);
		$menu = str_replace( '</div>', '</nav>', $menu );
		return $menu;
	}


	/**
	 * Filter the post pagination to use the nav element
	 *
	 * @since 0.1
	 **/
	function pagelinks( $args ) {
		$args['before'] = "\t\t\t\t\t<nav class='page-link'>" . __( 'Pages: ', 'thematic' ); 
		$args['after'] = "</nav>\n";
		return $args;
	}


	/**
	 * Filter the post header, wrapping title and post meta in header tags
	 *
	 * @since 0.1
	 **/
	function postheader( $content ) {
		$content = '<header class="entry-header">' . $content;
		$content .= '</header>';
		return $content;
	}


	/**
	 * Filter the post header's post title
	 *
	 * @since 0.1
	 **/
	function postheader_posttitle( $content ) {
		$content = str_replace( 'h2', 'h1', $content);
		return $content;
	}


	/**
	 * Filter the post footer
	 *
	 * @since 0.1
	 **/
	function postfooter( $content ) {
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
	function before_widget_area($content) {
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
	function after_widget_area($content) {
		$content = str_replace( '</ul>', ' ', $content);
		$content = str_replace( '</div>', '</aside>', $content);
		return $content;
	}


	/**
	 * Filter the opening tag of each widget to use section element
	 *
	 * @since 0.1
	 **/
	function before_widget( $content ) {
		$content = '<section id="%1$s" class="widgetcontainer %2$s">';
		return $content;
	}


	/**
	 * Filter the closing tag of each widget area to use section element
	 *
	 * @since 0.1
	 **/
	function after_widget( $content ) {
		$content = '</section>';
		return $content;
	}


	/**
	 * Filter the title of widget areas
	 *
	 * @since 0.1
	 **/
	function before_widgettitle( $content ) {
		$content = "<h1 class=\"widgettitle\">";
		return $content;
	}


	/**
	 * Filter the title of widget area
	 *
	 * @since 0.1
	 **/
	function after_widgettitle( $content ) {
		$content = "</h1>\n";
		return $content;
	}
	
	/**
	 * The default loop
	 * 
	 * If a child theme hasn't used a childtheme_override_*_loop function,
	 * this is the loop that will be used throughout
	 */
	function default_loop() {
		if ( is_author() ) 
			rewind_posts();

		while ( have_posts() ) : the_post(); 

				// action hook for insterting content above #post
				thematic_abovepost(); 
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

				<?php
	            	// creating the post header
	            	thematic_postheader();
	            ?>

					<div class="entry-content">

						<?php thematic_content(); ?>

					</div><!-- .entry-content -->

					<?php thematic_postfooter(); ?>

				</article><!-- #post -->

			<?php 
				// action hook for insterting content below #post
				thematic_belowpost();

		endwhile;
	} // end default_loop


	/**
	 * The index loop
	 * 
	 * @since 0.1
	 */
	function index_loop() {

		// Count the number of posts so we can insert a widgetized area
		$count = 1;
		while ( have_posts() ) : the_post();

				// action hook for insterting content above #post
				thematic_abovepost();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

				<?php
	            	// creating the post header
	            	thematic_postheader();
	            ?>

					<div class="entry-content">

						<?php thematic_content(); ?>

						<?php wp_link_pages(array('before' => sprintf('<nav class="page-link">%s', __('Pages:', 'thematic')),
													'after' => '</nav>')); ?>

					</div><!-- .entry-content -->

					<?php thematic_postfooter(); ?>

				</article><!-- #post -->

			<?php 
				// action hook for insterting content below #post
				thematic_belowpost();

				comments_template();

				if ( $count == thematic_get_theme_opt( 'index_insert' ) ) {
					get_sidebar('index-insert');
				}
				$count = $count + 1;
		endwhile;
	}


	/**
	 * The single post loop
	 *
	 * @since 0.1
	 */
	function single_post() { 

				// action hook for insterting content above #post
				thematic_abovepost();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

				<?php
	            	// creating the post header
	            	thematic_postheader();
	            ?>

					<div class="entry-content">

						<?php thematic_content(); ?>

						<?php wp_link_pages(array('before' => sprintf('<nav class="page-link">%s', __('Pages:', 'thematic')),
													'after' => '</nav>')); ?>

					</div><!-- .entry-content -->

					<?php thematic_postfooter(); ?>

				</article><!-- #post -->
		<?php
			// action hook for insterting content below #post
			thematic_belowpost();
	}


	/**
	 * Create the above navigation
	 * 
	 * Includes compatibility with WP-PageNavi plugin
	 * 
	 * Override: childtheme_override_nav_above <br>
	 * 
	 * @link http://wordpress.org/extend/plugins/wp-pagenavi/ WP-PageNavi Plugin Page
	 */
	function nav_above() {
		if (is_single()) { 
		?>
				<nav id="nav-above" class="navigation">

					<div class="nav-previous"><?php thematic_previous_post_link() ?></div>

					<div class="nav-next"><?php thematic_next_post_link() ?></div>

				</nav>
		<?php } else { ?>
				<nav id="nav-above" class="navigation">
	           		<?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
	            	<?php wp_pagenavi(); ?>
					<?php } else { ?>

					<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'thematic') ) ?></div>

					<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'thematic') ) ?></div>
					<?php } ?>

				</nav>	
		<?php
		}
	}


	/**
	 * Create the below navigation
	 * 
	 * Provides compatibility with WP-PageNavi plugin
	 * 
	 * Override: childtheme_override_nav_below
	 * 
	 * @link http://wordpress.org/extend/plugins/wp-pagenavi/ WP-PageNavi Plugin Page
	 */
	function nav_below() {
		if (is_single()) { ?>

			<nav id="nav-below" class="navigation">
				<div class="nav-previous"><?php thematic_previous_post_link() ?></div>
				<div class="nav-next"><?php thematic_next_post_link() ?></div>
			</nav>

	<?php
		} else { ?>

			<nav id="nav-below" class="navigation">
	               <?php if(function_exists('wp_pagenavi')) { ?>
	               <?php wp_pagenavi(); ?>
	               <?php } else { ?>  
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'thematic')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'thematic')) ?></div>
				<?php } ?>
			</nav>	

	<?php
		}
	}
	
	/**
	 * Filter the opening tag of #footer
	 *
	 * @since 0.1
	 **/
	function open_footer( $content ) {
		$content = '<footer id="footer">';
		return $content;
	}

	/**
	 * Filter the closing tag of #footer
	 *
	 * @since 0.1
	 **/
	function close_footer( $content ) {
		$content = '</footer><!-- #footer -->';
		return $content;
	}
	
	/**
	 * The callback for the output buffer string replacement
	 * 
	 * @since 0.1
	 */
	function buffer_callback( $buffer ) {

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

	/**
	 * Start the output buffer, with a callback function
	 * 
	 * @since 0.1
	 */
	function buffer_start() {
		ob_start('buffer_callback');
	}

	/**
	 * Flush the output buffer
	 * 
	 * @since 0.1
	 */
	function buffer_end() {
		ob_end_flush();
	}
}

?>