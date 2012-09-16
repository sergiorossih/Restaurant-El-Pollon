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
			<div class="skinholder">
				<h1 class="vfont entry-title"><?php single_cat_title(); ?></h1>
			</div>
		</div>
	</div>
	<div class="timeshow">
		<?php get_for_timer('hallo'); ?>
	</div>
</div>


<div class="bodymid">
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
					<?php $counter = 1; ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php if ($counter == 1 || $counter == 4 || $counter == 7 || $counter == 10 || $counter == 13 ) {?>
					<div class="grid4 first">
					<?php } else { ?>
					<div class="grid4">
					<?php } ?>
						<h3 class="h0" style="text-align: center;"><?php the_title(); ?></h3>
						<div class="entry-content menu-content">
							<div class="imgblock">
								<div class="imlk imgoverlink7 menimg" >
									<?php the_post_thumbnail('imlink'); ?> 
									<a href="<?php the_permalink(); ?>" class="imgoverlink imgoverlink7 imgdown"><span class="imgblockover imgoverlink7" >&nbsp;</span></a>
								</div> 
							</div>
						</div><!-- .entry-content -->
					</div><!-- #post-## -->	
					<?php if ($counter == 3)  { ?>
						<?php get_specials(); ?>
					<?php } ?>
					<?php $counter++; ?>								
					<?php endwhile; ?>
					<?php if ($counter <= 3)  { ?>
						<?php get_specials(); ?>
					<?php } ?>
					<div class="clear"></div>
					<?php adminace_paging(); ?>

			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
