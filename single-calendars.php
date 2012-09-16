<?php
/**
 * The template for displaying single calendar entries
 *
 *
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

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
				<h1 class="vfont entry-title"><?php the_title(); ?></h1>
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
							<div class="entry-content">
								<?php caldescript(get_the_ID())?>
								<?php the_content(); ?>
								<div class="socialcontent">
									<?php netstudio_get_social(); ?>
								</div>
							</div><!-- .entry-content -->
						</div><!-- #post-## -->

						<?php endwhile; ?>

					</div><!-- #content -->
				</div><!-- #container -->
				<?php get_sidebar('calendar'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
