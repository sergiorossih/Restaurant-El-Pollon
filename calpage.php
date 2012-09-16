<?php
/**
 * The template for displaying the calendar page
 *
 */
 
 /**
Template Name: Calendar
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
			<div class="container clear calselect">
				<div id="post-<?php the_ID(); ?>" class="page">				
					<div class="calmonth clear darkbox">
						<h2 class="vfont"><?php echo date_i18n( 'F Y' , time(), false ); ?></h2>
						<div class="monthselect">
							<?php echo prevlink(date('n'),date('Y')); ?>
							<span>|</span> 
							<?php echo nextlink(date('n'),date('Y')); ?>
						</div>										
					</div>						
					<div class="calentries"><?php echo get_the_calendar(date('n'),date('Y')); ?></div>		
				</div><!-- #post-## -->
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
						
<?php get_footer(); ?>
