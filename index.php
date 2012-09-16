<?php
/**
 * The main template file.
 *
 */

get_header(); ?>
	</div>
	<div id="photostrip">
		<div id="tsh_container" class="container stripcontainer">
			<div class="slidestrip">
				<div class="slidestripinner">
					<?php get_slideshow(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if (get_option('nets_timershow') == 'activated') { ?>
	<div class="timeshow">
		<?php get_for_timer(''); ?>
	</div>
	<?php } ?>
</div>

<div class="hfeed container">
	<div id="main">	
		<?php if (get_option('nets_tagline')){ ?>					
			<h2 class="mainwelcome vfont"><?php echo get_option('nets_tagline')?></h2>	
		<?php } ?>			
		<div class="maincontent">
			<div class="maincontentinner clear">	
				<?php if ( is_active_sidebar( 'index-left' ) ) : ?>	
				<div id="primary" class="widget-area grid4 first" role="complementary" >				
					<ul class="xoxo">	
						<?php dynamic_sidebar( 'index-left' ); ?>
					</ul>
				</div>
				<?php endif; ?>
					
				<?php if ( is_active_sidebar( 'index-center' ) ) : ?>	
				<div id="primary" class="widget-area grid4" role="complementary" >					
					<ul class="xoxo">	
						<?php dynamic_sidebar( 'index-center' ); ?>
					</ul>
				</div>
				<?php endif; ?>
					
				<?php if ( is_active_sidebar( 'index-right' ) ) : ?>	
				<div id="primary" class="widget-area grid4" role="complementary" >					
					<ul class="xoxo">	
						<?php dynamic_sidebar( 'index-right' ); ?>
					</ul>
				</div>
				<?php endif; ?>	
			</div>	
		</div>
	</div><!-- #main -->
</div>

<?php 
if (get_option('nets_carousel') == 'active') {
	lets_make_carousel();
}
?>
				
<?php get_footer(); ?>
