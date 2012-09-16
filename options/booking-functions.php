<?php
/*
 * Netstudio Booking Framework
 */


function bookingman_theme_options(){
	global $bpagehook, $btheme_name, $bsidehook;

	add_filter('screen_layout_columns', 'on_screen_layouts', 10, 2);
	$icon = get_template_directory_uri() .'/images/bookman.png';
	
	$bpagehook =  add_menu_page($btheme_name . ' Booking manager', $btheme_name, 'manage_options','bfunctions.php', 'bookingman_show_page', $icon, 4);
	add_action('load-'.$bpagehook, 'bookingman_load_page');	
}

/*
 * Screen Settings
 */
function on_screen_layouts($columns, $screen) {
	global $bpagehook, $bsidehook;
	if ($screen == $bpagehook) {
		$columns[$bpagehook] = 2;
	}
		if ($screen == $bsidehook) {
		$columns[$bsidehook] = 2;
	}
	return $columns;
}


/*
 * Main Options
 */

function bookingman_load_page(){
	global $bpagehook, $bookingman_options;

	if(isset($_POST['Submit'])){


		foreach ($bookingman_options as $value) {

			foreach( $value as $array)
			{

				if($array['type'] == 'text')
				{
					$id = $array['id'];
					update_option( $id, $_REQUEST[ $id ]);
				}// end text if

				elseif($array['type'] == 'textarea')
				{
					$id = $array['id'];
					update_option( $id, $_REQUEST[ $id ]);
				}//

				elseif($array['type'] == 'checkbox'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else

					{
						update_option( $array['id'] , 'false' );
					}

				}// end checkbox



				elseif($array['type'] == 'radio'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else  {
						delete_option( htmlentities($array['id'] ));
					}

				}// end checkbox

				elseif($array['type'] == 'select'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], htmlentities($_REQUEST[ $array['id'] ] ));
					}
					else {
						delete_option( htmlentities($array['id'] ));
					}
				}
				
				elseif($array['type'] == 'weekdays'){
				
					$weekid = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
				
					foreach ($weekid as $weekoperatr) {
					
						$savevalue = $array['id'] . $weekoperatr;

						if(isset( $_REQUEST[ $savevalue ])){
						
							update_option( $savevalue, $_REQUEST[ $savevalue ] );
					
						} else {
						
							update_option($savevalue , 'false' );
					
						}
					}
				}
				
				elseif($array['type'] == 'select_page'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], htmlentities($_REQUEST[ $array['id'] ] ));
					}
					else {
						delete_option( htmlentities($array['id'] ));
					}
				}
			}
		}

		header("Location: themes.php?page=bfunctions.php&saved=true");
		die;
	}
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	add_meta_box('save_form_box', 'Save Settings', 'save_form_box', $pagehook, 'side', 'high');

	//now let's register our meta boxes
	bookingman_register_metaboxes($bookingman_options);

}


function bookingman_show_page() {
	global $screen_layout_columns, $bpagehook, $btheme_name, $bns_ver;
?>
<div class="wrap nets_wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2>Settings </h2>
	<?php if(isset($_REQUEST['saved']) && $_REQUEST['saved']=='true'){ ?>
		<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);">
			<p><strong>Settings saved.</strong></p>
		</div>
	<?php }?>
	<div class="formouter">
	<div class="formtop"></div>
	<form method="post" action="" class="netsform">
		<input type="hidden" name="action" value="ns_save_options" />
		<div class="fadetop">
		<div class="fadebottom">
		<div class="tabholder">
			<ul>
				<li rel="#bs_management_settings" class="current">Bookings management</li>
				<li rel="#bs_general_settings" >General Settings</li>
				<li rel="#bs_message_settings">Message Settings</li>
			</ul>
		</div>
			
		<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?> nets_poststuff">
			<p class="submitter"><input type="submit" value="Save Changes" class="button-primary" name="Submit" /></p>
			<?php do_meta_boxes($bpagehook, 'normal', NULL); ?>
		</div>
		<br class="clear" />
		</div></div>
	</form>
	<div class="formbot"></div>
	</div>
</div>

<?php
}

// registering metaboxes to admin page
function bookingman_register_metaboxes($array)
{
	global $bpagehook;

	foreach($array as $field){

		add_meta_box($field[0]['id'], $field[0]['name'], $field[0]['id'], $bpagehook, $field[0]['context'], 'core');
		//print_r($field) . "<br>";

	}

}




// add something to the admin head
function bookingman_admin_head() {
?>	

	<script type="text/javascript">
		jQuery(document).ready(function(){

			jQuery('a.datebutton').click(function(){
				var clickedID = jQuery(this).attr('rel');			
				goforward(clickedID);				
			});

			function clickforward() {
				var clickedID = jQuery(this).attr('rel');			
				goforward(clickedID);	
			}

			function goforward(tdata) {
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';				
				var data = { 
					action: 'bookingman_post_action',
					type: 'bookbut',
					data: tdata
				};			
				jQuery.post(ajax_url, data, function(response) {				   
					jQuery('.bookingouter').html(response);	
					jQuery('a.goback').unbind('click').bind('click',goback);
					bindall();	
				});
				return false;				
			}

			function goback(clickedID) {
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';				
				var data = { 
					action: 'bookingman_post_action',
					type: 'bookback'
				};			
				jQuery.post(ajax_url, data, function(response) {				   
					jQuery('.bookingouter').html(response);	
					jQuery('a.datebutton').unbind('click').bind('click',clickforward);				
				});
				return false;	
				
			}

			function confirmbooking(){
				var clickedID = jQuery(this).attr('rel');
				var inserter = 	jQuery(this).closest('.bookingmanbox');
				jQuery(inserter).find('.loader').show();
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				var answer = confirm('Should we send a email to your customer');
				if (answer) {
					var tconf = 'yes';
				} else {
					var tconf = 'no';
				}				
				var data = { 
					action: 'bookingman_post_action',
					type: 'bookconfirm',
					data: clickedID,
					conf: tconf
				};			
				jQuery.post(ajax_url, data, function(response) {				   
					jQuery(inserter).html(response);
					bindall();					
				});
				return false;	
			}

			function cancelbooking(){
				var clickedID = jQuery(this).attr('rel');
				var inserter = 	jQuery(this).closest('.bookingmanbox');
				jQuery(inserter).find('.loader').show();
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				var answer = confirm('Should we send a email to your customer');
				if (answer) {
					var tconf = 'yes';
				} else {
					var tconf = 'no';
				}					
				var data = { 
					action: 'bookingman_post_action',
					type: 'bookcancel',
					data: clickedID,
					conf: tconf
				};			
				jQuery.post(ajax_url, data, function(response) {				   
					jQuery(inserter).html(response);
					bindall();					
				});
				return false;	
			}

			function declinebooking(){
				var clickedID = jQuery(this).attr('rel');
				var inserter = 	jQuery(this).closest('.bookingmanbox');
				jQuery(inserter).find('.loader').show();
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				var answer = confirm('Should we send a email to your customer');
				if (answer) {
					var tconf = 'yes';
				} else {
					var tconf = 'no';
				}					
				var data = { 
					action: 'bookingman_post_action',
					type: 'bookdecline',
					data: clickedID,
					conf: tconf
				};			
				jQuery.post(ajax_url, data, function(response) {				   
					jQuery(inserter).html(response);
					bindall();					
				});
				return false;	
			}

			function reinstatebooking(){
				var clickedID = jQuery(this).attr('rel');
				var inserter = 	jQuery(this).closest('.bookingmanbox');
				jQuery(inserter).find('.loader').show();
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				var answer = confirm('Should we send a email to your customer');
				if (answer) {
					var tconf = 'yes';
				} else {
					var tconf = 'no';
				}				
				var data = { 
					action: 'bookingman_post_action',
					type: 'bookreinstate',
					data: clickedID,
					conf: tconf
				};			
				jQuery.post(ajax_url, data, function(response) {				   
					jQuery(inserter).html(response);
					bindall();					
				});
				return false;	
			}

			function deletebooking(){
				var clickedID = jQuery(this).attr('rel');
				var inserter = 	jQuery(this).closest('.bookingmanbox');
				jQuery(inserter).find('.loader').show();
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';				
				var data = { 
					action: 'bookingman_post_action',
					type: 'bookdelete',
					data: clickedID
				};	
				var answer = confirm('Do you really want to delete this booking');
				if (answer) {		
				jQuery.post(ajax_url, data, function(response) {				   
					jQuery(inserter).remove();					
				});
				return false;
				}	
			}

			function bindall() {
				jQuery('.bconfirm').each(function() {
					jQuery(this).unbind('click').bind('click',confirmbooking);
				});	
				jQuery('.bcancel').each(function() {
					jQuery(this).unbind('click').bind('click',cancelbooking);
				});	
				jQuery('.breinst').each(function() {
					jQuery(this).unbind('click').bind('click',reinstatebooking);
				});	
				jQuery('.bdelete').each(function() {
					jQuery(this).unbind('click').bind('click',deletebooking);
				});
				jQuery('.bdecline').each(function() {
					jQuery(this).unbind('click').bind('click',declinebooking);
				});				

			}
						
		});				
	</script>
<?php
}


add_action('wp_ajax_bookingman_post_action', 'bookingman_ajax_callback');

function bookingman_ajax_callback() {
	global $wpdb; // this is how you get access to the database	
	$save_type = $_POST['type'];
	$conftype = $_POST['conf'];
	//Uploads
	if($save_type == 'bookbut'){		
		$clickedID = $_POST['data']; // Acts as the name		
		lets_list_bookings($clickedID); 
		exit; 
	}

	if($save_type == 'bookback'){				
		echo lets_make_bookingsman(); 
		exit; 
	}

	if($save_type == 'bookconfirm'){
		$data = $_POST['data'];				
		echo lets_update_booking($data,'confirm',$conftype); 
		exit; 
	}

	if($save_type == 'bookcancel'){
		$data = $_POST['data'];				
		echo lets_update_booking($data,'cancel', $conftype); 
		exit; 
	}
	
	if($save_type == 'bookcancel'){
		$data = $_POST['data'];				
		echo lets_decline_booking($data,'decline', $conftype); 
		exit; 
	}
	
	if($save_type == 'bookdelete'){
		$data = $_POST['data'];				
		echo lets_delete_booking($data); 
		exit; 
	}

	if($save_type == 'bookreinstate'){
		$data = $_POST['data'];				
		echo lets_update_booking($data,'reinstate', $conftype); 
		exit; 
	}	
}



function bookingman_generate_fields($arr_data){

	array_shift($arr_data);
	$output .= '<table class="form-table">
<tbody>';

	foreach($arr_data as $index=>$field)
	{

		switch ( $field['type'] ) {

			case 'text':

				$val = stripslashes($field['std']);
				if ( get_option( $field['id'] ) != "") { $val = stripslashes(get_option($field['id'])); }

					$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
					<input  name="'. $field['id'] .'" id="'. $field['id'] .
					'" type="'. $field['type'] .'" value="'. $val .'" style="width: 70%;" /><br/>
			
					<span class="description">'.$field['desc'].'</span>
					</span>
					</td>
					</tr>
							';
				break;
				
			case 'bookman':

				$val = stripslashes($field['std']);
				if ( get_option( $field['id'] ) != "") { $val = stripslashes(get_option($field['id'])); }

					$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
					<div class="bookingouter">
					' . lets_make_bookingsman() . '
					</div>
					</span>
					</td>
					</tr>
							';
				break;
				
				
			case 'uploader':

				$val = stripslashes($field['std']);
				if ( get_option( $field['id'] ) != "") { $val = get_option($field['id']); } else { $val = 'no image uploaded';}
				if ( get_option( $field['id'] ) != "") { $imgval = '<img style="padding-top: 10px;" id="image_'.$field['id'].'" title="'.$field['id'].'" src="' . get_option($field['id']) . '">'; }
				if ( get_option( $field['id'] ) != "") { $imgdisplay = ""; } else { $imgdisplay = 'style="display: none"'; }
				
				$output .= '
				
				<tr valign="top">
					<td colspan=2>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>

					<div class="upload_button_div" style="margin-top: 20px"><span id="'. $field['id'] .'" class="button image_upload_button">Upload Image</span><span title="'. $field['id'] .'" id="'. $field['id'] .'" class="button image_reset_button hide" ' . $imgdisplay . '>Remove</span></div><div class="clear"></div>' . $imgval . '<br/><br/>
					
					<input class="regular-text the_textbox" name="'. $field['id'] .'" id="this_'. $field['id'] .
					'" type="text" value="' . $val .'" />
					
					</span>
					</td>
					</tr>
				
				
				';

				break;


			case 'sub_heading':
				$val = stripslashes($field['std']);
				$output .= '
				<tr valign="top" style="background:#eee;border-bottom:1px solid #999">
					<th scope="row"><strong>
			'.$field['name'].'</strong></th>
			
			<td>
			<span class="description">'.$field['desc'].'</span>
			</td>
			</tr>
			';
				break;


			case 'delimiter':
				$val = stripslashes($field['std']);
				$output .= '
				<tr valign="top" style="">
					<th scope="row">
			&nbsp;</th>
			
			<td>
			<span >&nbsp;</span>
			</td>
			</tr>
			';
				break;


			case 'select':

				$output .= '<tr valign="top">
					<td colspan=2>
					<span class="postover">
			<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
			

			<select name="'. $field['id'] .'" id="'. $field['id'] .'" >';

				$select_value = get_option( $field['id']);

				foreach ($field['options'] as $option) {

					$selected = '';

					if($select_value != '') {
						if ( $select_value == $option) { $selected = ' selected="selected"';}
					} else {
						if ($field['std'] == $option) { $selected = ' selected="selected"'; }
					}

					$output .= '<option'. $selected .'>';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select><br /><span class="description">'.$field['desc'].'</span>
			</td>
			</tr>';


				break;


			case 'select_page':

				$output .= '<tr valign="top">
					<th scope="row">
			<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			
			<td>
			<select name="'. $field['id'] .'" id="'. $field['id'] .'">';

				$select_value = get_option( $field['id']);

				foreach ($field['options'] as $value=>$option) {

					$selected = '';

					if($select_value != '') {
						if ( $select_value == $value) { $selected = ' selected="selected"';}
					} else {
						if ($field['std'] == $option) { $selected = ' selected="selected"'; }
					}

					$output .= '<option'. $selected .' value="'.$value.'">';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select><br /><span class="description">'.$field['desc'].'</span>
			</td>
			</tr>';


				break;


			case 'textarea':
				$ta_options = $field['options'];
				$ta_value = $field['std'];
				if( get_option($field['id']) != "") { $ta_value = stripslashes(get_option($field['id'])); }
				$output .= '<tr valign="top">
					<td colspan=2>
					<span class="postover">
			<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
			

			<textarea name="'. $field['id'] .'" id="'. $field['id'] .'" cols="'. $ta_options['cols'] .'" rows="'.$ta_options['rows'].'">'.$ta_value.'</textarea>
			<span class="description">'.$field['desc'].'</span>
			</td>
			</tr>';

				break;
				
				
				
			case "radio":

				$select_value = get_option( $field['id']);


				$output .= '<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			
					<td>'; 
				foreach ($field['options'] as $key => $option)
				{

					$checked = '';
					if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked="checked"'; }
					} else {
						if ($field['std'] == $key) { $checked = ' checked="checked"'; }
					}
					$output .= '<input type="radio" name="'. $field['id'] .'"  value="'. $key .'" '. $checked .' />' . $option .'<br />';

				}

				$output .= '<br /><span class="description">'.$field['desc'].'</span></td></tr>'; 
				break;

			case "checkbox":

				$std = $field['std'];

				$saved_std = get_option($field['id']);

				$checked = '';

				if(!empty($saved_std)) {
					if($saved_std == 'true') {
						$checked = 'checked="checked"';
					}
					else{
						$checked = '';
					}
				}
				elseif( $std == 'true') {
					$checked = 'checked="checked"';
				}
				else {
					$checked = '';
				}

				$output .= '<tr valign="top">
					<th scope="row">
			<label for="'.$field['id'].'">'.$field['name'].'</label></th>
			<td>
			<input type="checkbox" class="checkbox" name="'.  $field['id'] .'" id="'. $field['id'] .'" value="true" '. $checked .' /> 
			<span class="description">'.$field['desc'].'</span></td></tr>';

			break;
			
			case "weekdays":
			
				$weekid = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
				
				
				
				$output .= '<tr valign="top">
					<td colspan=2>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>';
				 
				
				foreach ($weekid as $weekoperatr) {
				
					$saverstring = $field['id'] . $weekoperatr;
					$savervalue = get_option($saverstring);
					$checked = '';
					
					if(!empty($savervalue)) {
						if($savervalue == 'true') {
							$checked = 'checked="checked"';
						} else{
							$checked = '';
						}
					}
					
					$output .= '<input type="checkbox" class="checkbox" name="'.  $saverstring . '" id="'. $saverstring .'" value="true" '. $checked .' />&nbsp;&nbsp;&nbsp;&nbsp;' . $weekoperatr . '<br/>';
				
					
				}

				$output .= '<span class="description">'.$field['desc'].'</span></td></tr>
						</td>
						</tr>';
				break;
 
				}
}

$output .= '</tbody></table>';
return $output;
}

?>
