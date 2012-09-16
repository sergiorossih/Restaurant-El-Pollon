<?php
/**
 * The template for displaying all pages.
 *
 *
 *
 Template Name: fullwidth
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
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content meminfo fullwidth"><?php the_content(); ?></div>							
				</div>							
			</div>
		</div>
	</div>
</div>	
<?php endwhile; ?>

<?php get_footer(); ?>