<?php
/**
 * The template for displaying group Archive pages.
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
				<h1 class="vfont entry-title"><?php single_cat_title(); ?></h1>
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
				<div class="groupcat grid8 first" style="margin-top: 0px;">							
					<?php $counter = 1; ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php if ($counter % 2 != 0 ) {?>
					<div class="grid4 first">
					<?php } else { ?>
					<div class="grid4">
					<?php } ?>
						<h3 class="h0" style="text-align: center;"><?php the_title(); ?></h3>
						<div class="entry-content gal-content">
							<div class="imgblock">
								<div class="imlk imgoverlink6">
									<?php the_post_thumbnail('imlink'); ?> 
									<span class="imgblockover imgoverlink6 galinvoke" rel="<?php the_ID(); ?>">&nbsp;</span>
								</div>
							</div> 
						</div><!-- .entry-content -->
					</div><!-- #post-## -->	
					<?php $counter++; ?>								
					<?php endwhile; ?>
					<?php adminace_paging(); ?>
				</div>	
				<?php get_sidebar(); ?>							
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
