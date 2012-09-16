<?php
/**
 * The template for displaying Archive pages.
 *
 */

get_header(); ?>

<?php if ( have_posts() ) the_post();?>

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
				<h1 class="vfont entry-title">
					<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: <span>%s</span>', 'feast' ), get_the_date() ); ?>
					<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: <span>%s</span>', 'feast' ), get_the_date('F Y') ); ?>
					<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: <span>%s</span>', 'feast' ), get_the_date('Y') ); ?>
					<?php else : ?>
					<?php _e( 'Blog Archives', 'feast' ); ?>
					<?php endif; ?>	
				</h1>
			</div>
		</div>
	</div>
	<?php if (get_option('nets_timershow') == 'activated') { ?>
	<div class="timeshow">
		<?php get_for_timer(''); ?>
	</div>
	<?php } ?>
</div>
<?php rewind_posts(); ?>


<div class="bodymid">
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
				<div class="grid8 first">		
					<div id="content" role="main">
						<?php get_template_part( 'loop', 'archive' ); ?>				
						<?php adminace_paging(); ?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
