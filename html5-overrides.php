<?php
/**
 * Html5 override
 *
 * This file is using thematic's childtheme_override_* functions. 
 *
 * @package Thematic-HTML5
 **/

/**
 * Replace functions that use childtheme overrides
 * 
 * All filters need to be attached to the after_setup_theme hook in order
 * to let the theme decide whether to use html5 or not. Also, don't replace 
 * any funtions if the child theme is using the childtheme_override_* function
 *
 * @since 0.1
 */
function thematic_html5_replace_functions() {
	
	// replace the archive loop
	if ( !function_exists( 'childtheme_override_archive_loop' ) ) {
		remove_action('thematic_archiveloop', 'thematic_archive_loop');
		add_action('thematic_archiveloop','thematic_html5_default_loop');
	}
	
	// replace the author loop
	if ( !function_exists( 'childtheme_override_author_loop' ) ) {
		remove_action('thematic_authorloop', 'thematic_author_loop');
		add_action('thematic_authorloop','thematic_html5_default_loop');
	}
	
	// replace the category loop
	if ( !function_exists( 'childtheme_override_category_loop' ) ) {
		remove_action('thematic_categoryloop', 'thematic_category_loop');
		add_action('thematic_categoryloop','thematic_html5_default_loop');
	}
	
	// replace the index loop
	if ( !function_exists( 'childtheme_override_index_loop' ) ) {
		remove_action('thematic_indexloop', 'thematic_index_loop');
		add_action('thematic_indexloop','thematic_html5_index_loop');
	}
	
	// replace the single post loop
	if ( !function_exists( 'childtheme_override_single_post' ) ) {
		remove_action('thematic_singlepost', 'thematic_single_post');
		add_action('thematic_singlepost','thematic_html5_single_post');
	}
	
	// replace the search loop
	if ( !function_exists( 'childtheme_override_search_loop' ) ) {
		remove_action('thematic_searchloop', 'thematic_search_loop');
		add_action('thematic_searchloop','thematic_html5_default_loop');
	}
	
	// replace the tag loop
	if ( !function_exists( 'childtheme_override_tag_loop' ) ) {
		remove_action('thematic_tagloop', 'thematic_tag_loop');
		add_action('thematic_tagloop','thematic_html5_default_loop');
	}


	// replace the above navigation
	if ( !function_exists( 'childtheme_override_nav_above' ) ) {
		remove_action('thematic_navigation_above', 'thematic_nav_above', 2);
		add_action('thematic_navigation_above','thematic_html5_nav_above', 2);
	}
	
	// replace the navigation below
	if ( !function_exists( 'childtheme_override_nav_below' ) ) {
		remove_action('thematic_navigation_below', 'thematic_nav_below', 2);
		add_action('thematic_navigation_below','thematic_html5_nav_below', 2);
	}
}
add_action('after_setup_theme','thematic_html5_replace_functions',40);


/**
 * The default loop
 * 
 * If a child theme hasn't used a childtheme_override_*_loop function,
 * this is the loop that will be used throughout
 */
function thematic_html5_default_loop() {
	while ( have_posts() ) : the_post(); 

			// action hook for insterting content above #post
			thematic_abovepost(); 
			?>

			<?php
				echo '<article id="post-' . get_the_ID() . '" ';
				// Checking for defined constant to enable Thematic's post classes
				if ( ! ( THEMATIC_COMPATIBLE_POST_CLASS ) ) {
				    post_class();
				    echo '>';
				} else {
				    echo 'class="';
				    thematic_post_class();
				    echo '">';
				}

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
function thematic_html5_index_loop() {
	
	// Count the number of posts so we can insert a widgetized area
	$count = 1;
	while ( have_posts() ) : the_post();

			// action hook for insterting content above #post
			thematic_abovepost();
			?>

			<?php
				echo '<article id="post-' . get_the_ID() . '" ';
				// Checking for defined constant to enable Thematic's post classes
				if ( ! ( THEMATIC_COMPATIBLE_POST_CLASS ) ) {
				    post_class();
				    echo '>';
				} else {
				    echo 'class="';
				    thematic_post_class();
				    echo '">';
				}

            	// creating the post header
            	thematic_postheader();
            ?>
 				
				<div class="entry-content">
				
					<?php thematic_content(); ?>

					<?php wp_link_pages('before=<nav class="page-link">' . __('Pages:', 'thematic') . '&after=</nav>') ?>
				
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
function thematic_html5_single_post() { 

			// action hook for insterting content above #post
			thematic_abovepost();
			?>
		
			<?php
				echo '<article id="post-' . get_the_ID() . '" ';
				// Checking for defined constant to enable Thematic's post classes
				if ( ! ( THEMATIC_COMPATIBLE_POST_CLASS ) ) {
				    post_class();
				    echo '>';
				} else {
				    echo 'class="';
				    thematic_post_class();
				    echo '">';
				}

            	// creating the post header
            	thematic_postheader();
            ?>
 				
				<div class="entry-content">
				
					<?php thematic_content(); ?>

					<?php wp_link_pages('before=<nav class="page-link">' . __('Pages:', 'thematic') . '&after=</nav>') ?>
					
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
function thematic_html5_nav_above() {
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
function thematic_html5_nav_below() {
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


?>