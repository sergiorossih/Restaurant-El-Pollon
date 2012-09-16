<?php
/**
 * The template for displaying Category Archive pages.
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
				<h1 class="entry-title vfont"><?php printf( __( 'Search Results for:', 'feast' ), '<p>' . get_search_query() . '</>' ); ?></h1>
				<p class="topcontent centertop"><?php printf( __( '%s', 'feast' ), get_search_query() ); ?> </p>
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
						<?php get_template_part( 'loop', 'category' ); ?>				
						<?php adminace_paging(); ?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
