<?php
/**
 * The template for displaying the footer.
 *
 */
?>


<div id="footer" role="contentinfo">
	<div class="container footwidget clear darkbox">
		<div id="site-info">
			<a href="<?php echo home_url( '/' ) ?>" class="whites" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?> &copy; (<?php echo date('Y'); ?>)
			</a>
		</div><!-- #site-info -->
		<?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'secondary' ) ); ?>
	</div>
</div>

<div id="footerbottom">
	<div class="container clear">	
		<div id="site-generator">
			<a href="<?php echo esc_url( __('http://www.wikmag.com/feast-wordpress-theme.html', 'feast') ); ?>" 
				target="_blank" rel="generator">
			<?php printf( __('Proudly Designed by %s.', 'feast'), 'Netstudio' ); ?>
			</a>
		</div><!-- #site-generator -->
	</div>
</div>	

<div id="modalWindow" class="jqmWindow">
    <button class="jqmClose">X</button>
    <div class="popouter">
    	<div class="mapside">
    		<iframe id="jqmContent" src="" frameborder=0>
    		</iframe>
    	</div>
    	<div class="infoside">
    		<div class="infosideinner">
    			<h3>Contact Details</h3>
				<table>
					<tbody>
						<?php if (get_option('nets_teladdr')) { ?>
						<tr>
							<td><strong><?php _e( 'Telephone', 'feast' ); ?></strong></td>
							<td><?php echo get_option('nets_teladdr'); ?></td>
						</tr>
						<?php } ?>
						<?php if (get_option('nets_faxaddr')) { ?>
						<tr>
							<td><strong><?php _e( 'Fax', 'feast' ); ?></strong></td>
							<td><?php echo get_option('nets_faxaddr'); ?></td>
						</tr>
						<?php } ?>
						<?php if (get_option('nets_mobileaddr')) { ?>
						<tr>
							<td><strong><?php _e( 'Mobile', 'feast' ); ?></strong></td>
							<td><?php echo get_option('nets_mobileaddr'); ?></td>
						</tr>
						<?php } ?>
						<?php if (get_option('nets_emailaddr')) { ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><strong><?php _e( 'Email', 'feast' ); ?></strong></td>
							<td><?php echo get_option('nets_emailaddr'); ?></td>
						</tr>
						<?php } ?>
						<?php if (get_option('nets_physaddr')) { ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><strong><?php _e( 'Address', 'feast' ); ?></strong></td>
							<td><?php echo str_replace(',','<br/>',get_option('nets_physaddr')); ?></td>
						</tr>
						<?php } ?>
						<?php if (get_option('nets_postaddr')) { ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><strong><?php _e( 'Postal Address', 'feast' ); ?></strong></td>
							<td><?php echo str_replace(',','<br/>',get_option('nets_postaddr')); ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (get_option('nets_postaddr')) { ?>
				<a class="ddir darkbox" href="<?php echo get_option('nets_addraddr'); ?>"><?php _e( 'Driving Directions', 'feast' ); ?></a> 
				<?php } ?>
			</div>   		
    	</div>
    </div>
</div>

<div class="galleryover">
	<div class="goverlay">
		<div class="gloading">&nbsp;</div>
	</div>
</div>
<div class="galleryframe">

</div>
<div class="gallerytop">
	<p class="gallerytitle"></p>
	<a href="#" class="galclose">&nbsp;</a>
</div>
		
<script type="text/javascript">
	jQuery(document).ready(function($) {
		ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		base_url = '<?php echo get_template_directory_uri(); ?>';
		cdelay = <?php echo (get_option('nets_timerdelay')*1000); ?>;
		trtime = <?php echo (get_option('nets_transtime')*1000); ?>;
		<?php $mapsaddr = get_template_directory_uri() . '/maptype2.php/?latlong=' . get_option('nets_latlong') . '&mzoom=' . get_option('nets_mapzoom') . '&szoom=' . get_option('nets_strzoom') . '&pan=' . get_option('nets_orien') . '&measure=' . get_option('nets_mapmetric') . '&streetview=' . get_option('nets_mapview'); ?>
		$('#dirrr').jqm({ajax: '<?php echo $mapsaddr; ?>', trigger: 'a.trigger'});		
	});			
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/cookie.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jqModal.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script>


<?php
wp_footer();

echo stripslashes(get_option('nets_tracking')); 
?>

</body>
</html>