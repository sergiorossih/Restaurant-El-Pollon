<?php
/**
 * The Header for our theme.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> 
<link class="schanger" rel="stylesheet" class="changer" href="<?php echo get_template_directory_uri(); ?>/styles/<?php echo get_option('nets_colorscheme'); ?>.css" type="text/css" />
<link class="bchanger" rel="stylesheet" class="changer" href="<?php echo get_template_directory_uri(); ?>/styles/<?php echo get_option('nets_bgcolorscheme'); ?>.css" type="text/css" />
<link rel="stylesheet" class="changer" href="<?php echo get_template_directory_uri(); ?>/js/jqModal.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:700&v2' rel='stylesheet' type='text/css'>
<!-- #font setup -->
<?php 
$thevfont = str_replace(' ','+', get_option('nets_vfont'));
?>
<?php if (!get_option('nets_fontcode')) { ?>
<link href="http://fonts.googleapis.com/css?family=<?php echo $thevfont; ?>&v2" rel="stylesheet" type="text/css">
<?php } else { echo stripslashes(get_option('nets_fontcode')); } 
if (!get_option('nets_fontcode')) {
$familycode = get_option('nets_vfont');
} else { $familycode = get_option('nets_fontfamily'); }
?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- #enqueue javascript & head -->
<?php
if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
wp_enqueue_script( 'jquery' );
wp_head();
?>

<!-- #setup styling not possible in the css files. -->
<style>
.vfont, .lasthead, blockquote, #reply-title, #comments-title,
li.dir-label 
{ font-family: '<?php echo $familycode; ?>', arial, serif; font-weight: bold; }
 .widget_netlabs_fpnews_widget h4, .smallfont, #access a, .lightblock1, .menu-footer a, .announce, span.counter, .dateslip, a.prevlink, a.nxtlink, a.more-link, .nets_bookingformsub{font-family: 'Droid Sans', sans-serif;font-weight: bold;}
<?php if (!is_home()) { ?>
#topbg{height: 240px; overflow: hidden;}
<?php } ?>

</style>

<!--[if IE 7.0]>
<style>
form#searchform input[type="text"] {width: 60%; }
form#searchform input[type="submit"]{padding: 10px 11px 11px 10px;}
.timeshow .time {margin-top: 5px;}
.timeshow .announce {top: 12px;}
.jcarousel-clip-horizontal .lightblock1{bottom: 3px;}
</style>
 <![endif]-->
</head>


<body <?php body_class(); ?> >
<!-- #logo & menu. 1st tagline & directions -->
<div class="preloader">
	<img src="<?php echo get_template_directory_uri(); ?>/">
	<img src="<?php echo get_template_directory_uri(); ?>/styles/<?php echo get_option('nets_bgcolorscheme'); ?>/bigdoth.png">
	<img src="<?php echo get_template_directory_uri(); ?>/styles/<?php echo get_option('nets_colorscheme'); ?>/nextdot.png">
	<img src="<?php echo get_template_directory_uri(); ?>/styles/<?php echo get_option('nets_colorscheme'); ?>/prevdot.png">
</div>
<div class="container clear menu-header">
	<div class="menuholder">	
		<div id="access" role="navigation">
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
		</div><!-- #access -->
		<div class="lastmess">
			<div class="grid7 first" style="width: 507px">
				<div class="lasthead"><?php echo get_option('nets_sptlatest')?></div>
			</div><!-- #lastmess -->
			<?php if (get_option('nets_mapdisable')) { ?>
			<div class="grid2 dirr lightblock1" style="margin-left: 30px;">
				<a href="<?php echo (get_option('nets_mapnewaddr'));  ?>"><span><?php echo (get_option('nets_mapdisable'));  ?></span></a>
			</div><!-- #dirr - directions button -->
			<?php } else { ?>
			<div class="grid2 dirr lightblock1" style="margin-left: 30px;">
				<?php $mapsaddr = get_template_directory_uri() . '/maptype2.php/?latlong=' . get_option('nets_latlong') . '&mzoom=' . get_option('nets_mapzoom') . '&szoom=' . get_option('nets_strzoom') . '&pan=' . get_option('nets_orien') . '&measure=' . get_option('nets_mapmetric') . '&streetview=' . get_option('nets_mapview'); ?>
				<a class="trigger" href="<?php echo $mapsaddr; ?>"><span><?php _e( 'Get directions', 'feast' ); ?></span></a>
			</div><!-- #dirr - directions button -->
			<?php } ?>
		</div>
	</div>
	<a class="logo" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="logoimg" src="<?php echo get_option('nets_themelogo'); ?>"></a>
</div>

<!-- slideshow setup -->
<div id="topbg">
	<div class="topbgholder">
		<div id="topbgbehind"></div><div id="topholder"></div>
	</div>
	<div id="topbginfront">
		<?php get_tagstrips(); ?>