<?php
/**
 * The Template for displaying all single posts.
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
							<div class="inner">
								<div class="entry-meta">
									<?php feast_posted_on(); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a>
								</div><!-- .entry-meta -->
								<div class="entry-content">						
									<?php the_content(); ?>						
									<div class="socialcontent">
										<?php netstudio_get_social(); ?>
									</div>
								</div><!-- .entry-content -->
							</div>
						</div><!-- #post-## -->
						<?php comments_template( '', true ); ?>
						<?php endwhile; // end of the loop. ?>
					</div><!-- #content -->
				</div><!-- #container -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
