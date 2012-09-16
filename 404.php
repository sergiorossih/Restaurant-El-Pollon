<?php
/**
 * The template for displaying the 404 page
 *
 *
 */

get_header(); ?>

	</div>
	<div id="photostrip" style="display: none;">
		<div id="tsh_container" class="container stripcontainer">
			<div class="slidestrip">
				<div class="slidestripinner">
					<?php get_slideshow(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="entry-holder">
		<div class="entry-skin">
			<div class="skinholder <?php echo get_option('nets_taglinebg'); ?>">
				<h1 class="vfont entry-title"><?php _e( 'Page not found.', 'feast' ); ?></h1>
			</div>
		</div>
	</div>
	<?php if (get_option('nets_timershow') == 'activated') { ?>
	<div class="timeshow">
		<?php get_for_timer(''); ?>
	</div>
	<?php } ?>
</div>

<div class="bodymid">
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
				<div class="grid8 first">
					<div id="content" role="main">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
							<div class="inner">
								<div class="entry-content">						
									<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'feast' ); ?></p>
								</div><!-- .entry-content -->
							</div>
						</div><!-- #post-## -->
					</div><!-- #content -->
				</div><!-- #container -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>