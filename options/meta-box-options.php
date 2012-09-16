<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend RW_Meta_Box class
 * Add field type: 'taxonomy'
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = 'netlabs_';

$meta_boxes = array();

// first meta box
$meta_boxes[] = array(
	'id' => 'calinfo',							// meta box id, unique per meta box
	'title' => 'Calendar Configuration',			// meta box title
	'pages' => array('calendars'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'Event Start',				
			'desc' => 'Date that the event will start.',	
			'id' => $prefix . 'datestartentry',									
			'type' => 'date',						
			'format' => 'd/mm/yy',
		),
		array(
			'name' => 'Event end',				
			'desc' => 'Date that the event will end. (leave open if it is a single function or do not have an end)',	
			'id' => $prefix . 'dateendentry',									
			'type' => 'date',						
			'format' => 'd/mm/yy',
		),
		array(
			'name' => 'Starting Time',
			'desc' => 'Starting time of event.',
			'id' => $prefix . 'timestartentry',
			'type' => 'time',						
			'format' => 'hh:mmtt',
			'amp' => 'true'
		),
		array(
			'name' => 'Recurring event',
			'id' => $prefix . 'recurring',
			'type' => 'select',						
			'options' => array(						
				'Never' => 'Never',
				'Every week same day' => 'Every week same day',
				'Every month same date' => 'Every month same date'
			),
			'multiple' => false,						
			'std' => array('Never'),
			'desc' => 'Select here if it is a simple recurring event.'
		),
		array(
			'name' => 'Advanced reccuring interval',
			'id' => $prefix . 'recint',
			'type' => 'select',						
			'options' => array(						
				'select interval' => 'select interval',
				'First' => 'First',
				'Second' => 'Second',
				'Third' => 'Third',
				'Fourth' => 'Fourth',
				'Last' => 'Last'
			),
			'multiple' => false,						
			'std' => array('select interval'),
			'desc' => 'Additional advanced recurring events. Remember to set the simple recurring intervals to never when using this one.'
		),
		array(
			'name' => 'Advanced reccuring weekday',
			'id' => $prefix . 'recday',
			'type' => 'select',						
			'options' => array(						
				'select day' => 'select day',
				'Sunday' => 'Sunday',
				'Monday' => 'Monday',
				'Tuesday' => 'Tuesday',
				'Wednesday' => 'Wednesday',
				'Thursday' => 'Thursday',
				'Friday' => 'Friday'
			),
			'multiple' => false,						
			'std' => array('select day'),
			'desc' => 'Weekday to set with the above intervals.'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'utliltyinfo',							// meta box id, unique per meta box
	'title' => 'Utility Configuration',			// meta box title
	'pages' => array('utilities'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'Utility Type',
			'id' => $prefix . 'linktype',
			'type' => 'select',						
			'options' => array(						
				'feedback' => 'feedback',
				'image' => 'image'
			),
			'multiple' => false,						
			'std' => array('Never'),
			'desc' => 'Select here if it is a simple recurring event.'
		),
		array(
			'name' => 'Link to',
			'id' => $prefix . 'link_to',
			'type' => 'picklist',						
			'options' => array(
				'galleries' => 'galleries',
				'members' => 'members',
				'menus' => 'menus',
				'calendars' => 'calendars',								
				'page' => 'page',
				'post' => 'post'
			),
			'multiple' => false,						
			'std' => '',
			'desc' => 'Select what to link to if using an image link.'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'menuinfo',							// meta box id, unique per meta box
	'title' => 'Menu Configuration',			// meta box title
	'pages' => array('menus'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'Show Carousel',
			'id' => $prefix . 'showcarousel',
			'type' => 'select',						
			'options' => array(						
				'No' => 'No',
				'Yes' => 'Yes'
			),
			'multiple' => false,						
			'std' => '',
			'desc' => 'Select to show the menu carousel on the page'
		),
		array(
			'name' => 'Show feedback',
			'id' => $prefix . 'link_to',
			'type' => 'picklist',						
			'options' => array(
				'utilities' => 'feedback'
			),
			'multiple' => false,						
			'std' => '',
			'desc' => 'Select customer feedback to show with menus feedback on the menu page.'
		),
		array(
			'name' => 'Show gallery',
			'id' => $prefix . 'menushowgal',
			'type' => 'picklist',						
			'options' => array(
				'galleries' => 'galleries'
			),
			'multiple' => false,						
			'std' => '',
			'desc' => 'Select a gallery to display with menu item.'
		),
		array(
			'name' => 'Gallery heading',
			'id' => $prefix . 'mengaltitle',
			'type' => 'text',												
			'std' => '',
			'desc' => 'Title of the gallery above.'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'memberinfo',							// meta box id, unique per meta box
	'title' => 'Member Configuration',			// meta box title
	'pages' => array('members'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'Designation',
			'id' => $prefix . 'memtitle',
			'type' => 'text',												
			'std' => '',
			'desc' => 'Member designation.'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'slideshowinfo',							// meta box id, unique per meta box
	'title' => 'Slideshow Configuration',			// meta box title
	'pages' => array('slideshows'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'Activate ?',		
			'id' => $prefix . 'activate',
			'type' => 'checkbox',
			'desc' => 'Select here to activate this slideshow'
		),
		array(
			'name' => 'Link to',
			'id' => $prefix . 'linkpost',
			'type' => 'picklist',						
			'options' => array(
				'galleries' => 'galleries',
				'members' => 'members',
				'menus' => 'menus',
				'calendars' => 'calendars',								
				'page' => 'page',
				'post' => 'post'
			),
			'multiple' => false,						
			'std' => '',
			'desc' => 'Select what to link to.'
		),
		array(
			'name' => 'Title',
			'id' => $prefix . 'slidetitle',
			'type' => 'text',												
			'std' => '',
			'desc' => 'Title of slideshow.'
		),
		array(
			'name' => 'Description',
			'id' => $prefix . 'slidedesc',
			'type' => 'textarea',												
			'std' => '',
			'desc' => 'Description for slideshow.'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'bookinginfo',							// meta box id, unique per meta box
	'title' => 'Bookings Configuration',			// meta box title
	'pages' => array('bookings'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'Booking date',				
			'desc' => 'Date that is booked for.',	
			'id' => $prefix . 'bookingdate',									
			'type' => 'date',						
			'format' => 'd M yy'
		),
		array(
			'name' => 'Booking time',
			'desc' => 'Time that is booked for.',
			'id' => $prefix . 'bookinghour',
			'type' => 'time',						
			'format' => 'hh:mm',
			'amp' => false
		),
		array(
			'name' => 'Booking status',
			'id' => $prefix . 'bookingstatus',
			'type' => 'text',												
			'std' => '',
			'desc' => 'Status of booking.'
		),
		array(
			'name' => 'Number of guests',
			'id' => $prefix . 'bookingnumber',
			'type' => 'text',												
			'std' => '',
			'desc' => 'Number of guests.'
		),
		array(
			'name' => 'Telephone number',
			'id' => $prefix . 'bookingtel',
			'type' => 'text',												
			'std' => '',
			'desc' => 'Telephone number of guest that booked.'
		),
		array(
			'name' => 'Bookings email',
			'id' => $prefix . 'bookingemail',
			'type' => 'text',												
			'std' => '',
			'desc' => 'Email of guest that booked.'
		),
		array(
			'name' => 'Booking info',
			'id' => $prefix . 'bookinginfo',
			'type' => 'textarea',												
			'std' => '',
			'desc' => 'Additional booking instructions from customer.'
		)
	)
);

foreach ($meta_boxes as $meta_box) {
	new RW_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/

/********************* BEGIN VALIDATION ***********************/

/**
 * Validation class
 * Define ALL validation methods inside this class
 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class RW_Meta_Box_Validate {
	function check_name($text) {
		if ($text == 'Anh Tran') {
			return 'He is Rilwis';
		}
		return $text;
	}
}

/********************* END VALIDATION ***********************/
?>
