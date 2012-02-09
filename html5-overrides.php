<?php
/**
 * Html5 override
 *
 * This file is using thematic's childtheme_override_* functions. 
 *
 * @package Thematic-HTML5
 **/


/**
 * testing
 *
 * @return void
 * @author Karin
 **/
function testfunction() {
	echo 'bacon!';
}
//add_action('thematic_before','testfunction',10);


/**
 * Change the loops.
 * 
 * Change the loops found in content-extensions.php of Thematic. This is basicaly a copy-paste
 * of the loops, wraping the posts in an article element intesad of div.
 *
 * @since 0.1
 **/
function thematic_html5_loopchange() {
	
	if (function_exists('childtheme_override_archive_loop'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_archive_loop() {
			childtheme_override_archive_loop();
		}
	} else {
		/**
		 * The Archive loop
		 * 
		 * Located in archive.php
		 * 
		 * Override: childtheme_override_archive_loop
		 */
		function thematic_html5_archive_loop() {
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
		}
	} // end archive_loop

	// replace the default loop
	remove_action('thematic_archiveloop', 'thematic_archive_loop');
	add_action('thematic_archiveloop','thematic_html5_archive_loop');


	if (function_exists('childtheme_override_author_loop'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_author_loop() {
			childtheme_override_author_loop();
		}
	} else {
		/**
		 * The Author loop
		 * 
		 * Located in author.php
		 * 
		 * Override: childtheme_override_author_loop
		 */
		function thematic_html5_author_loop() {
			rewind_posts();
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
		}
	} // end author_loop

	// replace the author loop
	remove_action('thematic_authorloop', 'thematic_author_loop');
	add_action('thematic_authorloop','thematic_html5_author_loop');


	if (function_exists('childtheme_override_category_loop'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_category_loop() {
			childtheme_override_category_loop();
		}
	} else {
		/**
		 * The Category loop
		 * 
		 * Located in category.php
		 * 
		 * Override: childtheme_override_category_loop
		 */
		function thematic_html5_category_loop() {
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
		}
	} // end category_loop

	// replace the category loop
	remove_action('thematic_categoryloop', 'thematic_category_loop');
	add_action('thematic_categoryloop','thematic_html5_category_loop');


	if (function_exists('childtheme_override_index_loop'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_index_loop() {
			childtheme_override_index_loop();
		}
	} else {
		/**
		 * The Index loop
		 * 
		 * Located in index.php
		 * 
		 * Override: childtheme_override_index_loop
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

	// replace the index loop
	remove_action('thematic_indexloop', 'thematic_index_loop');
	add_action('thematic_indexloop','thematic_html5_index_loop');


	if (function_exists('childtheme_override_single_post'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_single_post() {
			childtheme_override_single_post();
		}
	} else {
		/**
		 * The Single post loop
		 * 
		 * Located in single.php
		 * 
		 * Override: childtheme_override_single_post
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

							<?php wp_link_pages('before=<div class="page-link">' . __('Pages:', 'thematic') . '&after=</div>') ?>

						</div><!-- .entry-content -->

						<?php thematic_postfooter(); ?>

					</article><!-- #post -->
			<?php
				// action hook for insterting content below #post
				thematic_belowpost();
		}
	} // end single_post

	// replace the single post loop
	remove_action('thematic_singlepost', 'thematic_single_post');
	add_action('thematic_singlepost','thematic_html5_single_post');


	if (function_exists('childtheme_override_search_loop'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_search_loop() {
			childtheme_override_search_loop();
		}
	} else {
		/**
		 * The Search loop
		 * 
		 * Located in search.php
		 * 
		 * Override: childtheme_override_search_loop
		 */
		function thematic_html5_search_loop() {
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
		}
	} // end search_loop

	// replace the search loop
	remove_action('thematic_searchloop', 'thematic_search_loop');
	add_action('thematic_searchloop','thematic_html5_search_loop');


	if (function_exists('childtheme_override_tag_loop'))  {
		/**
		 * @ignore
		 */
		function thematic_html5_tag_loop() {
			childtheme_override_tag_loop();
		}
	} else {
		/**
		 * The Tag loop
		 * 
		 * Located in tag.php
		 * 
		 * Override: childtheme_override_tag_loop
		 */
		function thematic_html5_tag_loop() {
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
		}
	} // end tag_loop

	// replace the tag loop
	remove_action('thematic_tagloop', 'thematic_tag_loop');
	add_action('thematic_tagloop','thematic_html5_tag_loop');
}
add_action('after_setup_theme','thematic_html5_loopchange',40);


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
	remove_action('thematic_navigation_above', 'thematic_nav_above', 2);
	add_action('thematic_navigation_abocve','thematic_html5_nav_above');
	
	
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
	remove_action('thematic_navigation_below', 'thematic_nav_below', 2);
	add_action('thematic_navigation_below','thematic_html5_nav_below',10,1);
	
}
add_action('after_setup_theme','thematic_html5_navchange',40);
?>