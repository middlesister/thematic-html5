<?php
/**
 * Html5 override
 *
 * This file is using thematic's childtheme_override_* functions. 
 *
 * @package Thematic-HTML5
 **/


/**
 * Change the loops.
 * 
 * Change the loops found in content-extensions.php of Thematic. This is basicaly a copy-paste
 * of the loops, wraping the posts in an article element instead of div.
 *
 * @since 0.1
 **/


/**
  * The Index loop
  * 
  * Located in index.php
  * 
  * Override: childtheme_override_index_loop
  */

if(!function_exists('childtheme_override_index_loop')) {

	function childtheme_override_index_loop() {

		// Count the number of posts so we can insert a widgetized area
		$count = 1;
		while ( have_posts() ) : the_post();

			// action hook for insterting content above #post
			thematic_abovepost();
			?>

			<?php
			echo '<article id="post-' . get_the_ID() . '" ';
				    post_class();
				    echo '>';
			
			// creating the post header
		    thematic_postheader(); ?>

				<div class="entry-content">

					<?php thematic_content(); ?>

					<?php wp_link_pages('before=<div class="page-link">' . __('Pages:', 'thematic') . '&after=</div>') ?>

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

} // end index_loop

/**
  * The Single post loop
  * 
  * Located in single.php
  * 
  * Override: childtheme_override_single_post
  */
if(!function_exists('childtheme_override_index_loop')) {

	function childtheme_override_index_loop() {

		// action hook for insterting content above #post
		thematic_abovepost();
		
		echo '<article id="post-' . get_the_ID() . '" ';
				post_class();
				echo '>';
						
			// creating the post header
			thematic_postheader(); ?>

			<div class="entry-content">

				<?php thematic_content(); ?>

				<?php wp_link_pages('before=<div class="page-link">' . __('Pages:', 'thematic') . '&after=</div>') ?>

			</div><!-- .entry-content -->

			<?php thematic_postfooter(); ?>

		</article><!-- #post -->
			
		<?php
		// action hook for insterting content below #post
		thematic_belowpost();

	}

} 		

	
/**
  * The Archive loop
  * 
  * Located in archive.php
  * 
  * Override: childtheme_override_archive_loop
  */
  
if(!function_exists('childtheme_override_archive_loop')) {

	function childtheme_override_archive_loop() {

		thematic_html5_default_loop();
		
	}

} // end archive_loop

/**
  * The Author loop
  * 
  * Located in author.php
  * 
  * Override: childtheme_override_author_loop
  */
  
if(!function_exists('childtheme_override_author_loop')) {

	function childtheme_override_author_loop() {

		thematic_html5_default_loop();
		
	}

} // end author_loop


/**
  * The Category loop
  * 
  * Located in category.php
  * 
  * Override: childtheme_override_category_loop
  */
  
if(!function_exists('childtheme_override_category_loop')) {

	function childtheme_override_category_loop() {

		thematic_html5_default_loop();
		
	}

} // end category_loop

/**
  * The Search loop
  * 
  * Located in search.php
  * 
  * Override: childtheme_override_search_loop
  */

if(!function_exists('childtheme_override_search_loop')) {

	function childtheme_override_search_loop() {

		thematic_html5_default_loop();
		
	}

} // end search_loop

/**
  * The Tag loop
  * 
  * Located in trag.php
  * 
  * Override: childtheme_override_tag_loop
  */
  
if(!function_exists('childtheme_override_tag_loop')) {

	function childtheme_override_tag_loop() {

		thematic_html5_default_loop();
		
	}

} // end tag_loop

/**
  * The Archive loop
  * 
  * Located in archive.php
  * 
  * Override: childtheme_override_archive_loop
  */
  
if(!function_exists('childtheme_override_archive_loop')) {

	function childtheme_override_archive_loop() {

		thematic_html5_default_loop();
		
	}

} // end category_loop

/**
  * The Default loop
  * 
  * Called by childtheme_override_category_loop, childtheme_override_archive_loop,
  * chidltheme_override_tag_loop, childtheme_override_search_loop, childtheme_override_author_loop
  * 
  * Override: childtheme_override_category_loop
  */
 
 
if (function_exists('childtheme_override_html5_default_loop'))  {
	/**
	 * @ignore
	 */
	function thematic_html5_default_loop() {
		childtheme_override_html5_default_loop();
	}
} else {
	/**
		 * The Default loop
		 * 
		 * Located in archive.php, tag.php, category.php, etc
		 * 
		 * Override: childtheme_override_html5_default_loop
		 */
		function thematic_html5_default_loop() {
			while ( have_posts() ) : the_post(); 

					// action hook for insterting content above #post
					thematic_abovepost(); 
					?>

					<?php
						echo '<article id="post-' . get_the_ID() . '" ';
						    post_class();
						    echo '>';

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
		}

} // end default_loop

/**
 * Change navigation
 *
 * @since 0.1
 **/
function thematic_html5_navchange() {
	
	if (function_exists('childtheme_override_nav_above'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_nav_above() {
			childtheme_override_nav_above();
		}
	} else {
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
	} // end nav_above
	
	// replace the above navigation
	if ( current_theme_supports( 'thematic-html5' ) ) {
		remove_action('thematic_navigation_above', 'thematic_nav_above', 2);
		add_action('thematic_navigation_abocve','thematic_html5_nav_above');
	}
	
	if (function_exists('childtheme_override_nav_below'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_nav_below() {
			childtheme_override_nav_below();
		}
	} else {
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
	} // end nav_below

	// replace the navigation below
	if ( current_theme_supports( 'thematic-html5' ) ) {
		remove_action('thematic_navigation_below', 'thematic_nav_below', 2);
		add_action('thematic_navigation_below','thematic_html5_nav_below',10,1);
	}
	
} // end thematic_html5_navchange

add_action('after_setup_theme','thematic_html5_navchange',40);
?>