<?php
/**
 * The template for displaying about page with members
 *
 *
 */

/**
 Template Name: facebookpage
 */

if (!class_exists('FacebookApiException')) {
	include_once('facebook.php');
}

$aid = get_option('nets_appid');
$asec = get_option('nets_secretcode');

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $aid,
  'secret' => $asec,
  'cookie' => true,
));

?>


<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title><?php wp_title(); ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/fstyle.css?<?php echo time()?>" />
    <link class="schanger" rel="stylesheet" class="changer" href="<?php echo get_template_directory_uri(); ?>/styles/f<?php echo get_option('nets_colorscheme'); ?>.css?<?php echo time()?>" type="text/css" />
    <link class="bchanger" rel="stylesheet" class="changer" href="<?php echo get_template_directory_uri(); ?>/styles/f<?php echo get_option('nets_bgcolorscheme'); ?>.css?<?php echo time()?>" type="text/css" />
    <script src="<?php echo home_url(); ?>/wp-includes/js/jquery/jquery.js?ver=1.4.4" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jcarousel.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/fcustoms.js" type="text/javascript"></script>
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:700&v2' rel='stylesheet' type='text/css'>
	<?php if (get_option('nets_fbpreview') != "activated") { ?>
	<style>
	html {
  	height: 100%;
  	overflow: hidden; /* Hides scrollbar in IE */
	}
	</style>
	<?php } ?>
	<style>
	.smallfont, .fbmenu a, h3.widget-title, .lightblock1, .menu-footer a, .announce, span.counter, .dateslip, a.prevlink, a.nxtlink, a.more-link, .nets_bookingformsub, .singletweet_widget p a, .fppostli h4{font-family: 'Droid Sans', sans-serif; font-weight: bold;}	
	</style>
  </head>
<body>
<div id="outer" rel="<?php echo get_option('siteurl'); ?>" contents="<?php echo get_option('nets_htpps'); ?>">
<div id="menubg" class="clear">
	<a class="logo" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="logoimg" src="<?php echo get_option('nets_themelogo'); ?>"></a>
	<div class="fbmenu">
		<ul class="clear">
			<?php if (get_option('nets_flinkl1') && get_option('nets_flinka1')) { ?>
			<li><a href="<?php echo get_option('nets_flinkla1') ?>" target="_blank"><?php echo get_option('nets_flinkl1') ?></a></li>
			<?php } ?>
			<?php if (get_option('nets_flinkl2') && get_option('nets_flinka2')) { ?>
			<li><a href="<?php echo get_option('nets_flinkla2') ?>" target="_blank"><?php echo get_option('nets_flinkl2') ?></a></li>
			<?php } ?>
			<?php if (get_option('nets_flinkl3') && get_option('nets_flinka3')) { ?>
			<li><a href="<?php echo get_option('nets_flinkla3') ?>" target="_blank"><?php echo get_option('nets_flinkl3') ?></a></li>
			<?php } ?>					
		</ul>
	</div>
</div>

<div id="topholder">
	<div id="slideholder">
		<div id="slideinner">
			<?php get_fslideshow(); ?>
		</div>
	</div>
	<div id="topbg">
		<div id="lastmess">
			<p><?php echo get_option('nets_ftagline'); ?></p>
		</div>
	</div>
</div>
<div class="bodymid clear">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
							

<?php endwhile; ?>
	
<?php if ( is_active_sidebar( 'fbleft' ) ) : ?>	
			<div id="primary" class="fbleft widget-area" role="complementary">					
				<ul class="xoxo">	
					<?php dynamic_sidebar( 'fbleft' ); ?>
				</ul>
			</div>
			<?php endif; ?>
					
			<?php if ( is_active_sidebar( 'fbright' ) ) : ?>	
			<div id="primary" class="fbright widget-area" role="complementary">					
				<ul class="xoxo">	
					<?php dynamic_sidebar( 'fbright' ); ?>
				</ul>
			</div>
			<?php endif; ?>	
			<div class="clear"></div>		
</div>


<div id="fb-root"></div>
</div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
 appId  : '<?php echo $aid; ?>',
 status : true, // check login status
 cookie : true, // enable cookies to allow the server to access the session
 xfbml  : true// parse XFBML
 });

 FB.Canvas.setAutoResize(7);

 </script>


</body>
</html>