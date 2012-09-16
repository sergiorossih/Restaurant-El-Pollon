<?php
/**
 * The template for displaying driving directions
 *
 *
 */

 /**
Template Name: driving directions
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
				<h1 class="vfont entry-title">
					<?php the_title(); ?>	
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


<div class="bodymid">
	<div class="stripetop">
		<div class="stripebot">
			<div class="container">
				<div class="mapdiv"></div>
				<div class="clear"></div>
				<div id="main">
						<div id="content" role="main">
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

					<div class="entry-content">
						<?php the_content(); ?>
						<div id="map-container"></div>
						<div id="side-container">
  							<ul>
  								<li class="dir-label">To:</li>
  								<li><strong><?php echo get_option('nets_physaddr'); ?></strong></li>
    							<li class="dir-label">From:</li>
    							<li><input id="from-input" type=text value=""/></li>
    							<li><input id="to-input" type=hidden value="<?php echo get_option('nets_physaddr'); ?>"/></li>
    							<li><input id="driveclick" class="darkbox" onclick="Demo.getDirections();" type=button value="Go!"/></li>
  							</ul>
  							<p>The driving directions are interactive. Click on any bold text for further explanation of the route.</p>
  							<div id="dir-container"></div>
						</div>
						<div class="clear"></div>
						<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;key=ABQIAAAAOZJQqoDBwAknMtPNKR-dvRSi2OoyjRwg8X5jAJmNj4togrBv2xSClpdvpd4FJNt4C5i-i6aTtWzs-g"></script>
						
						<script type="text/javascript">
						var Demo = {
 						 // HTML Nodes
  						mapContainer: document.getElementById('map-container'),
  						dirContainer: document.getElementById('dir-container'),
  						fromInput: document.getElementById('from-input'),
  						toInput: document.getElementById('to-input'),

  						// API Objects
  						dirService: new google.maps.DirectionsService(),
  						dirRenderer: new google.maps.DirectionsRenderer(),
  						map: null,

  						showDirections: function(dirResult, dirStatus) {
    					if (dirStatus != google.maps.DirectionsStatus.OK) {
      						alert('Directions failed: ' + dirStatus);
      						return;
    					}

   						 // Show directions
    					Demo.dirRenderer.setMap(Demo.map);
    					Demo.dirRenderer.setPanel(Demo.dirContainer);
    					Demo.dirRenderer.setDirections(dirResult);
  						},

  						getDirections: function() {
    						var fromStr = Demo.fromInput.value;
    						var toStr = Demo.toInput.value;
    						var dirRequest = {
      							origin: fromStr,
      							destination: toStr,
      							travelMode: google.maps.DirectionsTravelMode.DRIVING,
      							<?php if (get_option('nets_latlong') == 'metric') {?>
      							unitSystem: google.maps.DirectionsUnitSystem.METRIC,
      							<?php } else { ?>
      							unitSystem: google.maps.DirectionsUnitSystem.IMPERIAL,
      							<?php } ?>
      							provideRouteAlternatives: true
    						};
    						Demo.dirService.route(dirRequest, Demo.showDirections);
  						},

  						init: function() {
    						var latLng = new google.maps.LatLng(<?php echo get_option('nets_latlong'); ?>);
    						Demo.map = new google.maps.Map(Demo.mapContainer, {
      						zoom: 13,
      						center: latLng,
      						mapTypeId: google.maps.MapTypeId.ROADMAP
    					});

  					}
				};


				google.maps.event.addDomListener(window, 'load', Demo.init);
				</script>

					</div><!-- .entry-content -->
				</div><!-- #post-## -->


<?php endwhile; ?>

			</div><!-- #content -->

</div>
</div>
</div>
</div>
</div>

<?php get_footer(); ?>
