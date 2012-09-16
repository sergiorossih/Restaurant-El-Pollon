<?php
/**
 * The template for displaying the contact page.
 *
 */

 /**
Template Name: bookings
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
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">	
				<div id="content" role="main">
					<form id="nets_bookingform">			
						<div class="grid4 first">
						<?php the_content(); ?>
						</div>
						<div class="grid8">
						<div id="valmess"></div>	
						<div class="bookover clear">
						<div class="gridholder clear">
						<div class="grid4 timerholder" style="width: 291px;">
							<div class="calendarholder">
							<?php echo lets_create_calendar(date('n'),date('Y')); ?>
							</div>
						</div>
						<div class="grid4 secondline" style="width: 291px;">
							<p class="bookingp clear">
								<label><?php _e( 'Name.', 'feast' ); ?></label>
								<input class="nets_bookingformname reset" type="text" id="bookingform-name" name="bookingform-name" />
							</p>
							<p class="bookingp clear">
								<label><?php _e( 'Email.', 'feast' ); ?></label>
								<input class="nets_bookingformmail reset" type="text" id="bookingform-mail" name="bookingform-mail" />
							</p>
							<p class="bookingp clear">
								<label><?php _e( 'Telephone.', 'feast' ); ?></label>
								<input class="nets_bookingtel reset" type="text" id="bookingform-tel" name="bookingform-tel" />
							</p>
							<p class="bookingp" style="width: 39%; float: left;">
								<label><?php _e( 'Guests.', 'feast' ); ?></label>
								<select id="bookingform-num" name="bookingform-num">
									<option><?php _e( 'Select number', 'feast' ); ?></option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
									<option>7</option>
									<option>8</option>
									<option>9</option>
									<option>10</option>
								</select>
							</p>
							<p class="bookingp " style="width: 39%; float: left;">
								<label><?php _e( 'Time.', 'feast' ); ?></label>
								<select id="bookingform-time" name="bookingform-time">
									<?php
									$starthour = get_option('nets_bookingopens');
									$endhour = get_option('nets_bookingcloses');
									$hourcount = 1;
									?>
									<option><?php _e( 'Select time', 'feast' ); ?></option>
									<?php 
									while ($starthour <= $endhour) {
									echo '<option>' . $starthour . ':00</option>';
									$starthour++;
									}									
									?>
								</select>
							</p>
						</div>
						</div>
						<p class="bookingp clear" style="margin-left: 30px; margin-bottom: 30px;">
								<label><?php _e( 'Special Requests', 'feast' ); ?></label>
								<textarea id="bookingform-info" name="bookingform-info"></textarea>
							</p>	
						</div>
						<p class="bookingc clear">
								<label><?php _e( 'Location.', 'feast' ); ?></label>
								<input class="nets_bookingloc reset" type="text" id="bookingform-loc" name="bookingform-loc" />
							</p>
						<p class="bookingsubmit">
								<input type="submit" value="<?php _e( 'Make booking..', 'feast' ); ?>" name="nets_bookingformsub" class="nets_bookingformsub darkbox">
							</p>
						</div>
						</div>															
					</form>		
				</div>
			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>
						
<?php get_footer(); ?>
