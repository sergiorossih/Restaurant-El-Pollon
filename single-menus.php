<?php
/**
 * The template for displaying single menu entries
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
	<div id="main" style="margin-bottom: 0px;">
		<div id="content" role="main">
			<div class="container clear">
				<div class="grid8 first">	
					<div id="content" role="main">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->
						</div><!-- #post-## -->
					</div><!-- #content -->
				</div><!-- #container -->
				<div class="grid4">
					<?php 
					$output = '';
					$arrImages =& get_children('post_type=attachment&post_mime_type=application/pdf&post_parent=' . get_the_ID() );
					if ($arrImages){
						foreach ( $arrImages as $attachment_id => $attachment ) {
							$image_attributes = wp_get_attachment_url( $attachment_id );
							$output .= '<p class="menu-download darkbox"><a target="_blank" href="' . $image_attributes . '">' . __( 'Download our menu', 'feast' ) . '</a></p>';
						}
					}
					echo $output;
					?>
					<div class="menu-content">
						<div class="mencontent">
							<div class="imgblock">
								<div class="imlk imgoverlink7 menimg" >
									<?php the_post_thumbnail('imlink'); ?> 
									<span class="imgblockover imgoverlink7" >&nbsp;</span>
								</div> 
							</div>							
						</div>
					</div> 
					<?php $isimg = get_post_meta(get_the_ID(), 'netlabs_link_to' , true); 
						if ($isimg != 'nothing') {
							echo '<div class="menuintro"><div class="imlk fbs clear">';
							$content_post = get_post($isimg);
							$content = $content_post->post_content;
							echo '<p>' . $content . '</p>';
							echo '<span class="fbm" style="margin-top: -5px;">' . $content_post->post_title . '</span>';
							echo '<div class="feedbimg">' . get_the_post_thumbnail($isimg,'full') . '</div>';
							echo '<div class="imlkbot">&nbsp;</div></div></div>';   
						}
					?>
					<?php $isimg = get_post_meta(get_the_ID(), 'netlabs_menushowgal' , true); 
					$title = get_post_meta(get_the_ID(), 'netlabs_mengaltitle' , true);
						if ($isimg != 'nothing') {
							echo '<div class="imgblock" style="margin-bottom: 30px;"><div class="imlk"><div class="gallwidgouter">';
							$arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $isimg );
							$counter = 1;
							$imgnum = 4;							
							foreach ( $arrImages as $attachment_id => $attachment ) {
								if ($counter <= $imgnum) {
									$image_attributes = wp_get_attachment_image_src( $attachment_id, 'medium' );			
									echo '<div class="gallwidg" >' .  wp_get_attachment_image( $attachment_id, 'medium' ) . '</div>';
									$counter++;
								}
							}
  							echo '</div>';
							if ( $title ){
								echo '<p class="lightblock1 calpic calpic2">' . $title . '</p>';
							}
							echo '<span class="imgblockover blockover1 galinvoke" rel="' .  $isimg   .  '"></span></div></div>';
						}
					?>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>

<?php $newmeta = get_post_meta(get_the_ID(), 'netlabs_showcarousel' , true); 

if ($newmeta == 'Yes') {
	lets_make_carousel();
}
endwhile; 
?>



								
<?php get_footer(); ?>
