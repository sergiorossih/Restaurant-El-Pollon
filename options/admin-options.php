<?php
/*
 * Netstudio Admin Framework
 */


/*
 * Defining meta boxes
*/
$netstudio_options['general'][] = array(	"name" => "General",
					"id" => "ns_general_settings",
					"context" => "normal",
					"type" => "heading");

$netstudio_options['map'][] = array(	"name" => "Google Maps",
					"id" => "ns_map_settings",
					"context" => "normal",
					"type" => "heading");

					
$netstudio_options['social'][] = array(	"name" => "Social",
					"id" => "ns_accounts_settings",
					"context" => "normal",
					"type" => "heading");


$netstudio_options['specials'][] = array(	"name" => "Specials",
					"id" => "ns_specials_settings",
					"context" => "normal",
					"type" => "heading");

$netstudio_options['facebook'][] = array(	"name" => "Facebook",
					"id" => "ns_facebook_settings",
					"context" => "normal",
					"type" => "heading");

$netstudio_options['newsletter'][] = array(	"name" => "Newsletter",
					"id" => "ns_newsl_settings",
					"context" => "normal",
					"type" => "heading");









$netstudio_options['newsletter'][] = array(	"name" => "Newsletter signup(admin)",
					"desc" => "Message to admin informing them of a new newsletter signup",
					"id" => $shortname."_newnewsletter",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$netstudio_options['newsletter'][] = array(	"name" => "Newsletter signup(admin) subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_newnewsletter",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));



$netstudio_options['newsletter'][] = array(	"name" => "Newsletter signup(customer)",
					"desc" => "Message to customer confirming newsletter signup",
					"id" => $shortname."_newnewsletterc",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$netstudio_options['newsletter'][] = array(	"name" => "Newsletter signup(customer) subjectline",
					"desc" => "Email subject line for above",
					"id" => $shortname."_s_newnewsletterc",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));





/*
 * facebook
 */

$netstudio_options['facebook'][] = array(	"name" => "Preview Mode",
					"desc" => "View the page in preview Mode.",
					"id" => $shortname."_fbpreview",
					"std" => "rust",
					"type" => "select", "options" => array("deactivated", "activated"));
					
					
$netstudio_options['facebook'][] = array(	"name" => "SSL address",
					"desc" => "Add your ssl address",
					"id" => $shortname."_htpps",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));
				

$netstudio_options['facebook'][] = array(	"name" => "Application ID:",
					"desc" => "Add your AppId here",
					"id" => $shortname."_appid",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Secret code:",
					"desc" => "Add your secretcode here",
					"id" => $shortname."_secretcode",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Link name 1:",
					"desc" => "Add your first link label here",
					"id" => $shortname."_flinkl1",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Link address 1:",
					"desc" => "Add your first address label here",
					"id" => $shortname."_flinka1",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Link name 2:",
					"desc" => "Add your second link label here",
					"id" => $shortname."_flinkl2",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Link address 2:",
					"desc" => "Add your second address label here",
					"id" => $shortname."_flinka2",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Link name 3:",
					"desc" => "Add your third link label here",
					"id" => $shortname."_flinkl3",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Link address 3:",
					"desc" => "Add your third address label here",
					"id" => $shortname."_flinka3",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['facebook'][] = array(	"name" => "Facebook Tagline",
					"desc" => "Add your facebook tagline here",
					"id" => $shortname."_ftagline",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	


/*
 * specials
 */

$netstudio_options['specials'][] = array(	"name" => "Specials title:",
					"desc" => "contact form header title",
					"id" => $shortname."_spectitle",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['specials'][] = array(	"name" => "Special 1 Header",
					"desc" => "Special one Header",
					"id" => $shortname."_spec1h",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['specials'][] = array(	"name" => "Special 1",
					"desc" => "Special one description",
					"id" => $shortname."_spec1",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	


$netstudio_options['specials'][] = array(	"name" => "Special 2 header",
					"desc" => "Special two header",
					"id" => $shortname."_spec2h",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['specials'][] = array(	"name" => "Special 2",
					"desc" => "Special two description",
					"id" => $shortname."_spec2",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));


$netstudio_options['specials'][] = array(	"name" => "Special 3 header",
					"desc" => "Special three header",
					"id" => $shortname."_spec3h",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['specials'][] = array(	"name" => "Special 3",
					"desc" => "Special three description",
					"id" => $shortname."_spec3",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	


$netstudio_options['specials'][] = array(	"name" => "Special 4 header",
					"desc" => "Special four header",
					"id" => $shortname."_spec4h",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['specials'][] = array(	"name" => "Special 4",
					"desc" => "Special four description",
					"id" => $shortname."_spec4",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	


$netstudio_options['specials'][] = array(	"name" => "Special 5 header",
					"desc" => "Special five header",
					"id" => $shortname."_spec5h",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['specials'][] = array(	"name" => "Special 5",
					"desc" => "Special five description",
					"id" => $shortname."_spec5",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	



/*
 * General Options
 */
 
$netstudio_options['general'][] = array(	"name" => "Upload Your Logo",
					"desc" => "Upload your logo here",
					"id" => $shortname."_themelogo",
					"std" => "",
					"type" => "uploader");

$netstudio_options['general'][] = array(	"name" => "Color Scheme",
					"desc" => "Theme Color Scheme.",
					"id" => $shortname."_colorscheme",
					"std" => "rust",
					"type" => "select", "options" => array("gold", "red", "orange","green","blue","pink"));

$netstudio_options['general'][] = array(	"name" => "Background color",
					"desc" => "Theme Color Scheme.",
					"id" => $shortname."_bgcolorscheme",
					"std" => "rust",
					"type" => "select", "options" => array("brown", "darkbrown", "white", "black"));


$netstudio_options['general'][] = array(	"name" => "Transition time",
					"desc" => "Time between slideshow photos in seconds.",
					"id" => $shortname."_transtime",
					"std" => "14",
					"type" => "select", "options" => array("5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17"));


$netstudio_options['general'][] = array(	"name" => "Tagline background",
					"desc" => "Background for tagline wording.",
					"id" => $shortname."_taglinebg",
					"std" => "rust",
					"type" => "select", "options" => array("Light", "Dark"));


$netstudio_options['general'][] = array(	"name" => "Fonts",
					"desc" => "Custom Font Selection.",
					"id" => $shortname."_vfont",
					"std" => "Abel",
					"type" => "select", "options" => array('None', 'Abel', 'Cantarell', 'Cardo', 'Carme', 'Crimson Text', 'Droid Sans', 'Droid Sans Mono', 'Droid Serif', 'IM Fell DW Pica', 'Inconsolata', 'Josefin Sans Std Light', 'Josefin Slab', 'Lobster', 'Molengo', 'Maiden Orange', 'Nobile', 'Open Sans Condensed', 'OFL Sorts Mill Goudy TT', 'Old Standard TT', 'Oswald', 'PT Sans Narrow', 'Reenie Beanie', 'Rokkitt', 'Tangerine', 'Vollkorn', 'Yanone Kaffeesatz', 'Cuprum', 'Neucha', 'Neuton', 'PT Sans', 'Philosopher', 'Allerta', 'Allerta Stencil', 'Arimo', 'Arvo', 'Bentham', 'Coda', 'Cousine', 'Covered By Your Grace', 'Geo', 'Just Me Again Down Here', 'Puritan', 'Raleway', 'Tinos', 'UnifrakturCook', 'UnifrakturMaguntia', 'Mountains of Christmas', 'Lato', 'Orbitron', 'Allan', 'Anonymous Pro', 'Copse', 'Kenia', 'Ubuntu', 'Vibur', 'Sniglet', 'Syncopate', 'Cabin', 'Merriweather', 'Just Another Hand', 'Kristi', 'Corben', 'Gruppo', 'Buda', 'Lekton', 'Luckiest Guy', 'Crushed', 'Chewy', 'Coming Soon', 'Crafty Girls', 'Fontdiner Swanky', 'Permanent Marker', 'Rock Salt', 'Sunshiney', 'Unkempt', 'Calligraffitti', 'Cherry Cream Soda', 'Homemade Apple', 'Irish Growler', 'Kranky', 'Schoolbell', 'Slackey', 'Walter Turncoat', 'Radley', 'Meddon', 'Kreon', 'Dancing Script', 'Goudy Bookletter 1911', 'PT Serif Caption', 'PT Serif', 'Astloch', 'Bevan', 'Anton', 'Expletus Sans', 'VT323', 'Pacifico', 'Candal', 'Architects Daughter', 'Indie Flower', 'League Script', 'Cabin Sketch', 'Quattrocento', 'Amaranth', 'Irish Grover'));


$netstudio_options['general'][] = array(	"name" => "Fonts Override",
					"desc" => "Add the google fonts code here to override built in Google Fonts",
					"id" => $shortname."_fontcode",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$netstudio_options['general'][] = array(	"name" => "Font Family override",
					"desc" => "Add the font family here to override fonts",
					"id" => $shortname."_fontfamily",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['general'][] = array(	"name" => "Twitter username:",
					"desc" => "Twitter username if you will use the twitter widget",
					"id" => $shortname."_twitname",
					"std" => "alwynkotze",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['general'][] = array(	"name" => "Show Countdown timer:",
					"desc" => "Activate countdowntimer on slideshow",
					"id" => $shortname."_timershow",
					"std" => "activated",
					"type" => "select", "options" => array('activated', 'de-activated'));

$netstudio_options['general'][] = array(	"name" => "Menu carousel:",
					"desc" => "Show menu carousel on frontpage",
					"id" => $shortname."_carousel",
					"std" => "activated",
					"type" => "select", "options" => array('active', 'disabled'));

$netstudio_options['general'][] = array(	"name" => "Countdown timer delay",
					"desc" => "Delay before latest show is shown to new visitors. (in seconds)",
					"id" => $shortname."_timerdelay",
					"std" => "15",
					"type" => "select", "options" => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15','16','17','18','19','20'));
					

$netstudio_options['general'][] = array(	"name" => "Latest Message:",
					"desc" => "Frontpage message next to get directions",
					"id" => $shortname."_sptlatest",
					"std" => "Open Daily:<span> Mon-Fri: 10am - 10pm / Sat-Sun: 9am - 11pm</span>",
					"type" => "textarea", "options" => array(
"rows" => "2",
"cols" => "64"));	

$netstudio_options['general'][] = array(	"name" => "Tag Line",
					"desc" => "Tagline goes here. Leave it empty if you do not want it",
					"id" => $shortname."_tagline",
					"std" => "<span>this</span> is how you do it.",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	

$netstudio_options['general'][] = array(	"name" => "Tracking code",
					"desc" => "Stats tracking code goes here",
					"id" => $shortname."_tracking",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	



/*
 * Map
 */

$netstudio_options['map'][] = array(	"name" => "Override Directions",
					"desc" => "If you want to use the directions button for something else, type the name here",
					"id" => $shortname."_mapdisable",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Override Link",
					"desc" => "If you want to use the directions button for something else, type the address here",
					"id" => $shortname."_mapnewaddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Measurements",
					"desc" => "Choose between metric and imperial",
					"id" => $shortname."_mapmetric",
					"std" => "metric",
					"type" => "select", "options" => array("metric", "imperial"));

$netstudio_options['map'][] = array(	"name" => "Disable streetview map",
					"desc" => "Choose to only show the streetmap and disable streetview",
					"id" => $shortname."_mapview",
					"std" => "false",
					"type" => "select", "options" => array("true", "false"));


$netstudio_options['map'][] = array(	"name" => "Physical address:",
					"desc" => "Physical address needed for driving directions. add a comma behind each line that you want to seperate.",
					"id" => $shortname."_physaddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Postal address:",
					"desc" => "Postal address needed for contacts map.",
					"id" => $shortname."_postaddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Telephone number:",
					"desc" => "Telephone number.",
					"id" => $shortname."_teladdr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));
$netstudio_options['map'][] = array(	"name" => "Mobile Number:",
					"desc" => "Mobile no.",
					"id" => $shortname."_mobileaddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));
$netstudio_options['map'][] = array(	"name" => "Fax Number:",
					"desc" => "Faxno.",
					"id" => $shortname."_faxaddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Email Address:",
					"desc" => "Emailaddr.",
					"id" => $shortname."_emailaddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['map'][] = array(	"name" => "Get directions page:",
					"desc" => "Add the address of your get directions page here.",
					"id" => $shortname."_addraddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));



$netstudio_options['map'][] = array(	"name" => "Lat/Long:",
					"desc" => "Lattitude and Longitude from the map tool",
					"id" => $shortname."_latlong",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Orientation:",
					"desc" => "Streetview Orientation",
					"id" => $shortname."_orien",
					"std" => "15",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "SV Zoom:",
					"desc" => "Streetview Zoom",
					"id" => $shortname."_strzoom",
					"std" => "1",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Zoom:",
					"desc" => "Map Zoom",
					"id" => $shortname."_mapzoom",
					"std" => "8",
					"type" => "text","options" => array(
"class" => ""));




/*
 * Social Options
 */


 
$netstudio_options['social'][] = array(	"name" => "Facebook:",
					"desc" => "Facebook url",
					"id" => $shortname."_facebook_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_facebook_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_facebook_widgets",
					"std" => "false",
					"type" => "checkbox");	
 
$netstudio_options['social'][] = array(	"name" => "Twitter:",
					"desc" => "Twitter url",
					"id" => $shortname."_twitter_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_twitter_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_twitter_widgets",
					"std" => "false",
					"type" => "checkbox");	

$netstudio_options['social'][] = array(	"name" => "Linkedin:",
					"desc" => "Linkedin url",
					"id" => $shortname."_linkedin_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_linkedin_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_linkedin_widgets",
					"std" => "false",
					"type" => "checkbox");	
 
$netstudio_options['social'][] = array(	"name" => "Stumble:",
					"desc" => "Stumble url",
					"id" => $shortname."_stumble_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_stumble_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_stumble_widgets",
					"std" => "false",
					"type" => "checkbox");
 
$netstudio_options['social'][] = array(	"name" => "RSS:",
					"desc" => "RSS url",
					"id" => $shortname."_rss_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_rss_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_rss_widgets",
					"std" => "false",
					"type" => "checkbox");							
 
$netstudio_options['social'][] = array(	"name" => "Digg:",
					"desc" => "Digg address",
					"id" => $shortname."_digg_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_digg_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_digg_widgets",
					"std" => "false",
					"type" => "checkbox");								
 
$netstudio_options['social'][] = array(	"name" => "Delicious:",
					"desc" => "Delicious address",
					"id" => $shortname."_delicious_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_delicious_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_delicious_widgets",
					"std" => "false",
					"type" => "checkbox");								
 
$netstudio_options['social'][] = array(	"name" => "Yahoo Buzz:",
					"desc" => "Buzz address",
					"id" => $shortname."_buzz_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_buzz_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_buzz_widgets",
					"std" => "false",
					"type" => "checkbox");								
 
$netstudio_options['social'][] = array(	"name" => "Technorati:",
					"desc" => "Technorati address",
					"id" => $shortname."_technorati_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_technorati_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_technorati_widgets",
					"std" => "false",
					"type" => "checkbox");								

?>