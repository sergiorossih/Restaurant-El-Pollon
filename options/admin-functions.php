<?php
/*
 * Netstudio Admin Framework
 */


function netstudio_theme_options(){
	global $pagehook, $theme_name, $sidehook;

	add_filter('screen_layout_columns', 'on_screen_layout_columns', 10, 2);
	$icon = get_template_directory_uri() .'/images/1616.png';	
	$pagehook =  add_menu_page($theme_name . ' Options', $theme_name, 'manage_options','functions.php', 'netstudio_show_page', $icon, 3);
	add_action('load-'.$pagehook, 'netstudio_load_page');	
}

/*
 * Screen Settings
 */
function on_screen_layout_columns($columns, $screen) {
	global $pagehook, $sidehook;
	if ($screen == $pagehook) {
		$columns[$pagehook] = 2;
	}
	if ($screen == $sidehook) {
		$columns[$sidehook] = 2;
	}
	return $columns;
}


/*
 * Main Options
 */

function netstudio_load_page(){
	global $pagehook, $netstudio_options;

	if(isset($_POST['Submit'])){

		foreach ($netstudio_options as $value) {

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

				}

				elseif($array['type'] == 'radio'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					} else  {
						delete_option( $array['id'] );
					}

				}

				elseif($array['type'] == 'select'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					}
					else {
						delete_option( $array['id']);
					}
				}
				elseif($array['type'] == 'select_page'){

					if(isset( $_REQUEST[ $array['id'] ]))
					{
						update_option( $array['id'], $_REQUEST[ $array['id'] ] );
					}
					else {
						delete_option( $array['id'] );
					}
				}
			}
		}

		header("Location: themes.php?page=functions.php&saved=true");
		die;
	}
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	add_meta_box('save_form_box', 'Save Settings', 'save_form_box', $pagehook, 'side', 'high');

	netstudio_register_metaboxes($netstudio_options);

}


function netstudio_show_page() {
	global $screen_layout_columns, $pagehook, $theme_name, $ns_ver;
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
				<li rel="#ns_general_settings" class="current">General Settings</li>
				<li rel="#ns_accounts_settings">Social Settings</li>
				<li rel="#ns_map_settings">Map & Contacts</li>
				<li rel="#ns_specials_settings">Specials</li>
				<li rel="#ns_facebook_settings">Facebook</li>
				<li rel="#ns_newsl_settings">Newsletter</li>
			</ul>
		</div>
			
		<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?> nets_poststuff">
			<p class="submitter"><input type="submit" value="Save Changes" class="button-primary" name="Submit" /></p>
			<?php do_meta_boxes($pagehook, 'normal', NULL); ?>
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
function netstudio_register_metaboxes($array)
{
	global $pagehook;

	foreach($array as $field){
		add_meta_box($field[0]['id'], $field[0]['name'], $field[0]['id'], $pagehook, $field[0]['context'], 'core');
	}

}


// add something to the admin head
function netstudio_admin_head() {
?>	
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/options/admin-style.css" media="screen" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ajaxupload.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/custom_admin.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				  action: '<?php echo admin_url("admin-ajax.php"); ?>',
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'netstudio_post_action',
						type: 'upload',
						data: clickedID },
				  autoSubmit: true, // Submit file after selection
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension){
						clickedObject.text('Uploading'); // change button text, when user selects file	
						this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
						interval = window.setInterval(function(){
							var text = clickedObject.text();
							if (text.length < 13){	clickedObject.text(text + '.'); }
							else { clickedObject.text('Uploading'); } 
						}, 200);
				  },
				  onComplete: function(file, response) {
				   
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable(); // enable upload button
					
					// If there was an error
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);					
					}
					else{
						var buildReturn = '<div class="clear"></div><img style="padding-top: 10px;" "'+response+'" />';
						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();	
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						var strmess = jQuery('img#image_'+clickedID).attr('src'); 
						clickedObject.next('span').fadeIn();
						clickedObject.closest('td').find('input').val(strmess);
					}
				  }
				});
			
			});
			
			//AJAX Remove (clear option value)
			jQuery('.image_reset_button').click(function(){
			
					var clickedObject = jQuery(this);
					var clickedID = jQuery(this).attr('id');
					var theID = jQuery(this).attr('title');		
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';				
					var data = {
						action: 'netstudio_post_action',
						type: 'image_reset',
						data: theID
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var image_to_remove = jQuery('#image_' + theID);
						var button_to_hide = jQuery('#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						jQuery('input.the_textbox').val('');					
					});
					
					return false; 
					
				});  
		});			
	</script>
<?php
}


add_action('wp_ajax_netstudio_post_action', 'netstudio_ajax_callback');

function netstudio_ajax_callback() {
	global $wpdb; // this is how you get access to the database	
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);		 
		$upload_tracking[] = $clickedID;
		update_option( $clickedID , $uploaded_file['url'] );
		$subber = $uploaded_file['new_file'];
		$subber2 = $uploaded_file['url'];
		$subber2 = str_replace($subber , "" , $subber2);				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; exit; }
		 else { echo 'class="hide woo-option-image" id="image_' . $clickedID .'" src="' . $subber2 . '" alt="'; exit; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
		$id = $_POST['data']; // Acts as the name
		$option_name = 'nets_themelogo' ; 
		$newvalue = '' ;			
		update_option($option_name, $newvalue);
		exit;
	}		
}


function netstudio_generate_fields($arr_data){

	array_shift($arr_data);
	$output .= '<table class="form-table"><tbody>';

	foreach($arr_data as $index=>$field){
		
		switch ( $field['type'] ) {

			case 'text':
				$val = stripslashes($field['std']);
				if ( get_option( $field['id'] ) != "") { $val = get_option($field['id']); }

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
					<td><span class="description">'.$field['desc'].'</span></td></tr>';
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

				$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
					<select name="'. $field['id'] .'" id="'. $field['id'] .'" >
				';

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
				$output .= '</select><br /><span class="description">'.$field['desc'].'</span></td></tr>';
			break;


			case 'select_page':

				$output .= '
					<tr valign="top"><th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>			
					<td>
					<select name="'. $field['id'] .'" id="'. $field['id'] .'">
				';

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
				$output .= '</select><br /><span class="description">'.$field['desc'].'</span></td></tr>';

			break;

			case 'textarea':
				$ta_options = $field['options'];
				$ta_value = $field['std'];
				if( get_option($field['id']) != "") { $ta_value = stripslashes(get_option($field['id'])); }
				$output .= '
					<tr valign="top">
					<td colspan=2>
					<span class="postover">
					<label for="'.$field['id'].'"><span>'.$field['name'].'</span></label>
					<textarea name="'. $field['id'] .'" id="'. $field['id'] .'" cols="'. $ta_options['cols'] .'" rows="'.$ta_options['rows'].'">'.$ta_value.'</textarea>
					<span class="description">'.$field['desc'].'</span>
					</td>
					</tr>
				';

			break;
								
			case "radio":

				$select_value = get_option( $field['id']);
				$output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>			
					<td>
				'; 
				
				foreach ($field['options'] as $key => $option) {
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

				$output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>
					<td>
					<input type="checkbox" class="checkbox" name="'.  $field['id'] .'" id="'. $field['id'] .'" value="true" '. $checked .' /> 
					<span class="description">'.$field['desc'].'</span></td></tr>';

			break;
  
		}
	}

	$output .= '</tbody></table>';
	return $output;
}

?>
