<?php
// General settings
function ns_general_settings()
{
	global $netstudio_options;
	echo netstudio_generate_fields($netstudio_options['general']);

}


function ns_frontpage_settings()
{
	global $netstudio_options;
	echo netstudio_generate_fields($netstudio_options['frontpage']);

}

// Social accounts
function ns_accounts_settings()
{
	global $netstudio_options;
	echo netstudio_generate_fields($netstudio_options['social']);

}

function ns_map_settings()
{
	global $netstudio_options;
	echo netstudio_generate_fields($netstudio_options['map']);

}

function ns_newsl_settings()
{
	global $netstudio_options;
	echo netstudio_generate_fields($netstudio_options['newsletter']);

}

function ns_specials_settings()
{
	global $netstudio_options;
	echo netstudio_generate_fields($netstudio_options['specials']);

}

function ns_facebook_settings()
{
	global $netstudio_options;
	echo netstudio_generate_fields($netstudio_options['facebook']);

}


// Additional Save Button
function save_form_box()
{
?><p>
<input type="submit" value="Save Changes" class="button-primary"
name="Submit" />
</p>
<?php
}
?>