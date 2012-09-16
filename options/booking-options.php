<?php
/*
 * Netstudio Admin Framework
 */




/*
 * Defining meta boxes
*/

$bookingman_options['management'][] = array(	"name" => "Bookings management",
					"id" => "bs_management_settings",
					"context" => "normal",
					"type" => "heading");


$bookingman_options['general'][] = array(	"name" => "General",
					"id" => "bs_general_settings",
					"context" => "normal",
					"type" => "heading");

$bookingman_options['messages'][] = array(	"name" => "Booking messages",
					"id" => "bs_message_settings",
					"context" => "normal",
					"type" => "heading");





$bookingman_options['management'][] = array(	"name" => "Check Bookings",
					"desc" => "Click on a date / daterange to see bookings",
					"id" => $shortname."_bookingopens",
					"std" => "10",
					"type" => "bookman", "options" => array());






$bookingman_options['general'][] = array(	"name" => "Bookingopens",
					"desc" => "Time that first booking can be made.(hour)",
					"id" => $shortname."_bookingopens",
					"std" => "10",
					"type" => "select", "options" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17",  "18", "19", "20", "21", "22", "23", "24"));


$bookingman_options['general'][] = array(	"name" => "Bookingcloses",
					"desc" => "Time that last booking can be made.(hour)",
					"id" => $shortname."_bookingcloses",
					"std" => "22",
					"type" => "select", "options" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17",  "18", "19", "20", "21", "22", "23", "24"));

$bookingman_options['general'][] = array(	"name" => "Unavailable weekdays",
					"desc" => "Weekdays not available for bookings",
					"id" => $shortname."_bookingunavail",
					"std" => "",
					"type" => "weekdays", "options" => array(
"class" => ""));

$bookingman_options['general'][] = array(	"name" => "Single unavailable dates",
					"desc" => "List of single dates that your facility might be closed.<br/> Add dates as :\"mm/dd/yyyy;\" <br/>example: 12/05/2011;12/07/2011; etc.<br/> Dates in the past will be deleted automatically.",
					"id" => $shortname."_singleunavail",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['general'][] = array(	"name" => "Success message",
					"desc" => "Success message when form is submitted.",
					"id" => $shortname."_bookingsuccess",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['general'][] = array(	"name" => "newbookingstatus",
					"desc" => "Default status of a new booking.<br/><br/>If <strong>Confirmed</strong> is selected, bookings are seen as already confirmed when they book.<br/>If <strong>Unconfirmed</strong> is selected then bookings need to be confirmed manually before they are being counted as bookings.<br/><br/>Please ensure your custom messages to customers are appropriate for the type of status that you choose.",
					"id" => $shortname."_nbstatus",
					"std" => "22",
					"type" => "select", "options" => array("Confirmed", "Unconfrimed"));

$bookingman_options['general'][] = array(	"name" => "Send reminders",
					"desc" => "Should we send reminders to booked customers?",
					"id" => $shortname."_nbreminder",
					"std" => "22",
					"type" => "select", "options" => array("True", "False"));


$bookingman_options['general'][] = array(	"name" => "Daily maximum bookings",
					"desc" => "Maximum daily bookings allowed.",
					"id" => $shortname."_maxbookings",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$bookingman_options['messages'][] = array(	"name" => "Booking received(admin)",
					"desc" => "Message to admin informing them of a new booking received",
					"id" => $shortname."_newbookingmessa",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['messages'][] = array(	"name" => "Booking received(admin) subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_newbookingmessa",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$bookingman_options['messages'][] = array(	"name" => "Booking received(client)",
					"desc" => "Message to client informing them that you received their booking.",
					"id" => $shortname."_newbookingmessc",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['messages'][] = array(	"name" => "Booking received(client) subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_newbookingmessc",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$bookingman_options['messages'][] = array(	"name" => "Booking reminder",
					"desc" => "Message to client reminding them of the booking",
					"id" => $shortname."_bookingreminder",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['messages'][] = array(	"name" => "Booking reminder(client) subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_bookingreminder",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$bookingman_options['messages'][] = array(	"name" => "Booking declined",
					"desc" => "Message to client telling them that you are unavailable to take their booking.",
					"id" => $shortname."_bookingdeclined",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['messages'][] = array(	"name" => "Booking declined subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_bookingdeclined",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$bookingman_options['messages'][] = array(	"name" => "Booking confirmed",
					"desc" => "Message to client confirming their booking was approved.",
					"id" => $shortname."_bookingconfirmed",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['messages'][] = array(	"name" => "Booking confirmed subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_bookingconfirmed",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$bookingman_options['messages'][] = array(	"name" => "Booking cancelled",
					"desc" => "Message to client confirming their booking had to be cancelled.",
					"id" => $shortname."_bookingcancelled",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$bookingman_options['messages'][] = array(	"name" => "Booking cancelled subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_bookingcancelled",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


?>