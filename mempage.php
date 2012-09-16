<?php
/**
 * The template for displaying about page with members
 *
 *
 */

/**
 Template Name: About
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
				<div class="grid6 first">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content meminfo"><?php the_content(); ?></div>							
					</div>							
				</div>						
				<?php endwhile; ?>						
				<div class="grid6 teamabouts">
					<div class="teaminner">
						<h3 class="h0"><?php _e( 'Key team members', 'feast' ); ?></h3>
						<div class="singleholder clear">
							<?php $linkposts = get_posts('numberposts=10000&post_type=members');
							$mcounter = 0;
            				foreach($linkposts as $linkentry) :
							$linkvalue = $linkentry->ID;
							$linkto = get_post_meta($linkvalue, 'netlabs_memtitle' , true);
							if ($mcounter % 3 == 0) {echo '<div class="clear"></div>';} 
							echo '<div class="singleteam">';
							echo '<div class="tthumb">';
							echo get_the_post_thumbnail($linkvalue,'teamthumb');	
							echo '<a href="' . get_permalink($linkvalue) . '" class="imgoverlink imgoverlink4"><span class="imgblockover imgoverlink4"></span></a></div><p class="memtitle"><strong>' . get_the_title($linkvalue) . '</strong></p>';
							echo '<p>' . $linkto . '</p>';
							echo '</div>';
							$mcounter++;	
							endforeach;	
							?>
						</div>						
					</div>				
				</div>				
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>