<?php
// General settings

function bs_management_settings()
{
	global $bookingman_options;
	echo bookingman_generate_fields($bookingman_options['management']);

}


function bs_general_settings()
{
	global $bookingman_options;
	echo bookingman_generate_fields($bookingman_options['general']);

}


function bs_message_settings()
{
	global $bookingman_options;
	echo bookingman_generate_fields($bookingman_options['messages']);

}




?>