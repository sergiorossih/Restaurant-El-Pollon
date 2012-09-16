<?php
/**
 * WP-Church custom widgets
 *
 */


/******************************************************************
 * video widget
 ******************************************************************/ 
class netlabs_video_Widget extends WP_Widget {

    function netlabs_video_Widget() {
        parent::WP_Widget(false, $name = 'Video Widget');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$netlabs_youtube  = $instance['netlabs_youtube'];
		$netlabs_vimeo  = $instance['netlabs_vimeo'];
        
		echo $before_widget; ?>
		
		<div class="imlk" >						
			<?php if ($netlabs_youtube != ''){
				$object = '<object type="application/x-shockwave-flash" width="306" height="170" data="http://www.youtube.com/v/'.$netlabs_youtube.'">
							<param name="movie" value="http://www.youtube.com/v/'.$netlabs_youtube.'" />
							<param name="wmode" value="transparent" /><param name="quality" value="high" /></object>';
			} elseif ($netlabs_vimeo != '') {
				$object = '<object type="application/x-shockwave-flash" width="306" height="170" data="http://www.vimeo.com/moogaloop.swf?clip_id='.$netlabs_vimeo.'&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=">
							<param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id='.$netlabs_vimeo.'&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=" />
							<param name="wmode" value="transparent" /><param name="quality" value="high" /></object>';
			}
			echo $object; ?>	

		</div>
						
        <?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['netlabs_youtube'] = strip_tags($new_instance['netlabs_youtube']);
		$instance['netlabs_vimeo'] = strip_tags($new_instance['netlabs_vimeo']);
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);
		$netlabs_youtube = strip_tags($instance['netlabs_youtube']);
		$netlabs_vimeo = strip_tags($instance['netlabs_vimeo']);
        ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('netlabs_youtube'); ?>"><?php _e('Youtube code:', 'feast'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('netlabs_youtube'); ?>" name="<?php echo $this->get_field_name('netlabs_youtube'); ?>" type="text" value="<?php echo esc_attr($netlabs_youtube); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('netlabs_vimeo'); ?>"><?php _e('Vimeo code:', 'feast'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('netlabs_vimeo'); ?>" name="<?php echo $this->get_field_name('netlabs_vimeo'); ?>" type="text" value="<?php echo esc_attr($netlabs_vimeo); ?>" /></p>
 		<?php 
    }
} 

add_action('widgets_init', create_function('', 'return register_widget("netlabs_video_Widget");'));
 
/******************************************************************
 * Countdown timer
 ******************************************************************/
 
class netlabs_calendar_Widget extends WP_Widget {

    function netlabs_calendar_Widget() {
        parent::WP_Widget(false, $name = 'Countdown Timer');	
    }

    function widget($args, $instance) {		
        extract( $args );
        echo $before_widget;               
        echo '<div class="widget-title countdown" style="margin-bottom: 0px;">';
		get_for_timer(''); 
        echo '</div>';				
   	 echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
        return $instance;
    }

    function form($instance) { }

}

add_action('widgets_init', create_function('', 'return register_widget("netlabs_calendar_Widget");'));



/******************************************************************
 * Upcomming events
 ******************************************************************/
 
class netlabs_calendaru_Widget extends WP_Widget {

    function netlabs_calendaru_Widget() {
        parent::WP_Widget(false, $name = 'Upcomming events');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $offset = $instance['offset'];
        echo $before_widget; 
        if ( $title ) echo $before_title . $title . $after_title; 
        if (!$number) { 
        $number = 2;
        }
    	if (!$offset) { 
        	$offset = 0;
        }
        get_for_widget($number, $offset); 			
   	 	echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['offset'] = strip_tags($new_instance['offset']);
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        $offset = esc_attr($instance['offset']);
        ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Offset number:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $offset; ?>" /></label></p>
		<p>The offset is the amount of events to ignore. If used with the count down timer the offset would be 1.</p>
        <?php 
    }
} 

add_action('widgets_init', create_function('', 'return register_widget("netlabs_calendaru_Widget");'));
 


/******************************************************************
 * front page news widget
 ******************************************************************/
 
class netlabs_fpnews_Widget extends WP_Widget {

    function netlabs_fpnews_Widget() {
        parent::WP_Widget(false, $name = 'Latest News');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        
        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>						
		<?php
		global $post;
		
		$args = array( 'numberposts' => $number);
		$myposts = get_posts( $args );
		foreach( $myposts as $post ) :	setup_postdata($post); ?>
		
			<li class="fppostli clear">
			<h4 class="h0"><?php the_title(); ?></h4>
			<?php $theimg = get_the_post_thumbnail($post->ID,'fppost');
			if ($theimg) { ?>
				<div class="thumb imgblock">
					<div class="imlk" style="width: 70px; height: 70px; overflow: hidden;">
					<?php echo $theimg; ?>
						<a href="<?php the_permalink(); ?>" class="imgoverlink imgoverlink2"><span class="imgblockover imgoverlink2"></span></a>
					</div> 
					</div>
				<?php }
				$text = get_the_excerpt();
				if (strlen($text) > 90) {
					$text = substr($text,0,strpos($text,' ',90)); 
				} 
				echo apply_filters('the_excerpt',$text . '...');
				?>
				
				<p><a href="<?php the_permalink(); ?>" class="more-link"><span><?php _e('READ MORE..', 'feast'); ?></span></a></p>
			</li>
						
		<?php endforeach; ?>

		</ul>
						
        <?php echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
        <?php 
    }

}

add_action('widgets_init', create_function('', 'return register_widget("netlabs_fpnews_Widget");'));



/******************************************************************
 * image link widget
 ******************************************************************/
 
class netlabs_imglink_Widget extends WP_Widget {

    function netlabs_imglink_Widget() {
        parent::WP_Widget(false, $name = 'Image Link');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $number = $instance['lnumber'];
        $showtitle = $instance['showtitle'] ? '1' : '0';
        
        echo $before_widget; 
        
		global $post;?>
		<div class="imgblock">
		<div class="imlk">
					
		<?php 
		$linkto = '';
		$isimg = '';
		$linkto = get_post_meta($number, 'netlabs_links_to' , true); 
		$isimg = get_post_meta($number, 'netlabs_ppftdimg' , true); 
					
		echo get_the_post_thumbnail($linkto,'imlink');  ?>
					
			<a href="<?php echo get_permalink($linkto); ?>"><span class="imlkover">&nbsp;</span></a>
				<?php echo get_the_post_thumbnail($number,'imlink'); ?>
						<p class="lightblock1 calpic"><?php echo get_the_title($number); ?></p>

					<a href="<?php echo get_permalink($linkto); ?>" class="imgoverlink imgoverlink1"><span class="imgblockover blockover1"></span></a>
		</div> 
		</div>                  																	
						
        <?php echo $after_widget; 
    }


    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['lnumber'] = $new_instance['lnumber'];
		$instance['showtitle'] = $new_instance['showtitle'] ? 1 : 0;
        return $instance;
    }


    function form($instance) {				
        $number = $instance['lnumber'];
        $showtitle = $instance['showtitle'] ? 'checked="checked"' : '';
        ?>
        <p>
        	<label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Imagelink:', 'wp-church'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            <?php $linkposts = get_posts('numberposts=10000&post_type=utilities');
            	foreach($linkposts as $linkentry) :
				$linkvalue = $linkentry->ID;
				$isimg = get_post_meta($linkvalue, 'netlabs_linktype' , true); 
				if ($isimg == 'image') {
				echo '<option';
				if ($number == $linkvalue){
				echo ' selected="selected"';
				}
				echo ' value="', $linkvalue , '">', $linkentry->post_title , '</option>';	
				}				
				endforeach;	
			?>
			</select> 
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $showtitle; ?> id="<?php echo $this->get_field_id('showtitle'); ?>" name="<?php echo $this->get_field_name('showtitle'); ?>" /> <label for="<?php echo $this->get_field_id('showtitle'); ?>"><?php _e('Show post title'); ?></label>
		</p>
        <?php 
    }
}

add_action('widgets_init', create_function('', 'return register_widget("netlabs_imglink_Widget");'));




/******************************************************************
 * image feedback widget
 ******************************************************************/
 
class netlabs_feedb_Widget extends WP_Widget {

    function netlabs_feedb_Widget() {
        parent::WP_Widget(false, $name = 'Feedback Widget');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $number = $instance['lnumber'];
        
        echo $before_widget; 
        
		global $post;?>
					
		<div class="imlk fbs clear">
			<?php 
			$content_post = get_post($number);
			$content = $content_post->post_content;
			?>
			<p><?php echo $content ?></p>
			<span class="fbm smallfont" style="margin-top: -5px;"><?php echo $content_post->post_title; ?></span>
			<div class="feedbimg"><?php echo get_the_post_thumbnail($number,'full'); ?></div>
		</div>                      																	
						
        <?php echo $after_widget; 
    }


    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['lnumber'] = $new_instance['lnumber'];
        return $instance;
    }

    function form($instance) {				
        $number = $instance['lnumber'];
        ?>
        <p>
        	<label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Feedback post:', 'wp-church'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            	<?php $linkposts = get_posts('numberposts=10000&post_type=utilities');
            	foreach($linkposts as $linkentry) :
					$linkvalue = $linkentry->ID;
					$isimg = get_post_meta($linkvalue, 'netlabs_linktype' , true); 
					if ($isimg == 'feedback') {
					echo '<option';
					if ($number == $linkvalue){
					echo ' selected="selected"';
					}
					echo ' value="', $linkvalue , '">', $linkentry->post_title , '</option>';
					}					
				endforeach;	?>
			</select> 
		</p>
        <?php 
    }
}

add_action('widgets_init', create_function('', 'return register_widget("netlabs_feedb_Widget");'));

 
/******************************************************************
 * custom social widget.
 ******************************************************************/
 

class netstudio_social_widget extends WP_Widget {

    function netstudio_social_widget() {
        parent::WP_Widget(false, $name = 'Netstudio Social');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        
        echo $before_widget; 

        $countr = 1;
		$the_class= '';

		if (get_option('nets_facebook_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank" href="<?php echo get_option('nets_facebook_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/facebook.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if (get_option('nets_twitter_widgets') == 'true') {
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank" href="<?php echo get_option('nets_twitter_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/twitter.png"></a>
			<?php $countr++; $the_class= '';
		}
		
    	if (get_option('nets_linkedin_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_linkedin_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/linkedin.png"></a>
			<?php $countr++; $the_class= ''; 
		}
			
		if (get_option('nets_stumble_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_stumble_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/stumble.png"></a>
			<?php $countr++; $the_class= ''; 
		}
			
		if (get_option('nets_rss_widgets') == 'true') {
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_rss_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/rss.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if (get_option('nets_email_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_email_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/email.png"></a>
			<?php $countr++; $the_class= '';
		} 
		
		if (get_option('nets_blogger_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_blogger_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/blogger.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if (get_option('nets_digg_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_digg_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/digg.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if (get_option('nets_delicious_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_delicious_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/delicious.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if (get_option('nets_technorati_widgets') == 'true') { 
			if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_technorati_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/<?php echo get_option('nets_bgcolorscheme'); ?>/technorati.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		

		
		echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("netstudio_social_widget");'));




/******************************************************************
 *
 * newsletter signup widget
 *
 ******************************************************************/ 
 
 
class netlabs_newsletter_Widget extends WP_Widget {

    function netlabs_newsletter_Widget() {
        parent::WP_Widget(false, $name = 'Newsletter Widget');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$netlabs_newsmess  = $instance['netlabs_newsmess'];
        
		echo $before_widget; 
		if ( $title ) echo $before_title . $title . $after_title;

		if ($netlabs_newsmess != ''){
			echo '<p>' . $netlabs_newsmess . '</p>';
		} 						
		?>
		<div id="valmess"></div>
		<form id="newslettersignup" class="clear" post="" action="">
			<p>
				<label class="netlabs_newsnamel" for="name"><?php _e('Name:', 'feast'); ?></label>
				<input class="netlabs_newsname reset" id="netlabs_newsname" name="netlabs_newsname" type="text" value="" /><br/>
			</p>
			<p>
				<label class="netlabs_newsmaill" for="name"><?php _e('Email:', 'feast'); ?></label>
				<input class="netlabs_newsmail reset" id="netlabs_newsmail" name="netlabs_newsmail" type="text" value="" /><br/>
			</p>
			<label class="netlabs_newslocl" for="name"><?php _e('Location:', 'feast'); ?></label>
			<input class="netlabs_newsloc" id="netlabs_newsloc" name="netlabs_newsloc" type="text" value="" />
			<img class="loadimg" src="<?php echo get_template_directory_uri(); ?>/images/loadimg.gif">
			<input class="newssubmit darkbox" type="submit" value="Submit">
		</form>						

		<?php echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['netlabs_newsmess'] = strip_tags($new_instance['netlabs_newsmess']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$netlabs_newsmess = strip_tags($instance['netlabs_newsmess']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'feast'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('netlabs_newsmess'); ?>"><?php _e('Newsletter message:', 'feast'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('netlabs_newsmess'); ?>" name="<?php echo $this->get_field_name('netlabs_newsmess'); ?>" type="text" value="<?php echo esc_attr($netlabs_newsmess); ?>" /></p>
 	<?php 
    }
} 

add_action('widgets_init', create_function('', 'return register_widget("netlabs_newsletter_Widget");'));





if ( !function_exists('netshttp_build_query') ) :
    function netshttp_build_query( $query_data, $numeric_prefix='', $arg_separator='&' ) {
       $arr = array();
       foreach ( $query_data as $key => $val )
         $arr[] = urlencode($numeric_prefix.$key) . '=' . urlencode($val);
       return implode($arr, $arg_separator);
    }
endif;

if ( !function_exists('nets_time_since') ) :


function nets_time_since( $original, $do_more = 0 ) {

		$yr_singular = __('year', 'feast');
		$yr_plural = __('years', 'feast');
		$mn_singular = __('month', 'feast');
		$mn_plural = __('months', 'feast');
		$wk_singular = __('week', 'feast');
		$wk_plural = __('weeks', 'feast');
		$dy_singular = __('day', 'feast');
		$dy_plural = __('days', 'feast');
		$hr_singular = __('hour', 'feast');
		$hr_plural = __('hours', 'feast');
		$mi_singular = __('minute', 'feast');
		$mi_plural = __('minutes', 'feast');

        $chunks = array(
                array(60 * 60 * 24 * 365 , $yr_singular, $yr_plural),
                array(60 * 60 * 24 * 30 , $yr_singular, $yr_plural),
                array(60 * 60 * 24 * 7, $wk_singular, $wk_plural),
                array(60 * 60 * 24 , $dy_singular, $dy_plural),
                array(60 * 60 , $hr_singular, $hr_plural),
                array(60 , $mi_singular, $mi_plural),
        );

        $today = time();
        $since = $today - $original;

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
                $seconds = $chunks[$i][0];
                $name = $chunks[$i][1];
                $namep = $chunks[$i][2];

                if (($count = floor($since / $seconds)) != 0)
                break;
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$namep}";

        if ($i + 1 < $j) {
                $seconds2 = $chunks[$i + 1][0];
                $name2 = $chunks[$i + 1][1];
                $namep2 = $chunks[$i + 1][2];

                // add second item if it's greater than 0
                if ( (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) && $do_more )
                        $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2p}";
        }
        return $print;
}
endif;


/**
 * ************************************************************
 * single tweet widget
 **************************************************************/



add_action( 'widgets_init', 'singletweet_widgets' );
function singletweet_widgets() {register_widget( 'singletweet_Widget' );}

class singletweet_widget extends WP_Widget {
	
	function singletweet_Widget() {	
		$widget_ops = array( 'classname' => 'singletweet_widget', 'description' => __('Display a single tweet.', 'feast') );
		$this->WP_Widget( 'singletweet_widget', __('Single Tweet Widget', 'feast'), $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$tweets = json_decode( get_option('nets_tweetsave') , true );
		$accountname = get_option('nets_twitname');			
		$tweets_out = 0;

		foreach ( (array) $tweets as $tweet ) {
			if ( $tweets_out >= 1 )
				break;

			$text = make_clickable( esc_html( $tweet['text'] ) );

			$tweet_id = urlencode($tweet['id_str']);
			echo $before_widget;
			echo 	'<div class="imlk fbs clear">
					<p>' . $text . '<br/>
					<a href=" http://twitter.com/' . $accountname . '/statuses/' . $tweet_id . '" target="_blank" class="timesince">' . str_replace(' ', '&nbsp;', nets_time_since(strtotime($tweet['created_at']))) . '&nbsp;' . __('ago', 'feast') . '</a>
					- <a href="http://twitter.com/intent/retweet?tweet_id=' . $tweet_id . '" target="_blank">' . __('retweet', 'feast') . '</a>
					- <a href="http://twitter.com/intent/tweet?in_reply_to=' . $tweet_id .  '" target="_blank">' . __('reply', 'feast') . '</a>
					- <a href="http://twitter.com/intent/favorite?tweet_id=' . $tweet_id .  '" target="_blank">' . __('favorite', 'feast') . '</a></p>
					<span class="fbm" style="margin-top: -10px;"><a href="http://www.twitter.com/' . $accountname  .  '" class="smallfont" target="_blank">' . __('Follow us on Twitter', 'feast') . '</a></span>
					<div class="feedbimg" ><img  src="' . get_template_directory_uri() . '/images/tlogo.png"></div></div>';
			echo $after_widget;
			unset($tweet_id);
			$tweets_out++;
		}
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['accountname'] = $new_instance['accountname'];
		
		wp_cache_delete( 'widget-twitter-' . $this->number , 'widget' );
		wp_cache_delete( 'widget-twitter-response-code-' . $this->number, 'widget' );
		return $instance;
	}
	
	function form( $instance ) {

		$defaults = array(
		'accountname' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
				
	<?php
	}
}

/**
 * ************************************************************
 * multiple tweets widget
 **************************************************************/



add_action( 'widgets_init', 'multipletweet_widgets' );
function multipletweet_widgets() {register_widget( 'multipletweet_Widget' );}

class multipletweet_widget extends WP_Widget {
	
	function multipletweet_Widget() {	
		$widget_ops = array( 'classname' => 'multipletweet_widget', 'description' => __('Display a multiple tweets.', 'feast') );
		$this->WP_Widget( 'multipletweet_widget', __('Multiple Tweet Widget', 'feast'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$show = absint( $instance['show'] );
		$title = apply_filters('widget_title', $instance['title']);
				
		$tweets = json_decode( get_option('nets_tweetsave') , true );
		$accountname = get_option('nets_twitname');			
		$tweets_out = 0;
		
		if (!$show || $show == 0 || $show >= 21) {
			$show = 5;
		}
		
		echo $before_widget;			
		if ( $title )echo $before_title . $title . $after_title; 
			
		echo '<ul>';

		foreach ( (array) $tweets as $tweet ) {
			if ( $tweets_out >= $show )
				break;

			$text = make_clickable( esc_html( $tweet['text'] ) );

			$tweet_id = urlencode($tweet['id_str']);
			echo 	'<li class="clear"><p>' . $text . '<br/>
					<a href=" http://twitter.com/' . $accountname . '/statuses/' . $tweet_id . '" target="_blank" class="timesince">' . str_replace(' ', '&nbsp;', nets_time_since(strtotime($tweet['created_at']))) . '&nbsp;' . __('ago', 'feast') . '</a>
					- <a href="http://twitter.com/intent/retweet?tweet_id=' . $tweet_id . '" target="_blank">' . __('retweet', 'feast') . '</a>
					- <a href="http://twitter.com/intent/tweet?in_reply_to=' . $tweet_id .  '" target="_blank">' . __('reply', 'feast') . '</a>
					- <a href="http://twitter.com/intent/favorite?tweet_id=' . $tweet_id .  '" target="_blank">' . __('favorite', 'feast') . '</a></p></li>';
			unset($tweet_id);
			$tweets_out++;
		}
		echo '<li class="clear"><span class="fbm" style="margin-top: 0px;"><a href="http://www.twitter.com/' . $accountname  .  '" target="_blank">' . __('Follow us on Twitter', 'feast') . '</a></span><div class="feedbimg" style="margin-left: 0px; margin-top: 0px;"><img  src="' . get_template_directory_uri() . '/images/tlogo.png"></div></li></ul>';
		echo $after_widget;
					
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['show'] = $new_instance['show'];
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		
		wp_cache_delete( 'widget-twitter-' . $this->number , 'widget' );
		wp_cache_delete( 'widget-twitter-response-code-' . $this->number, 'widget' );

		return $instance;
	}
	
	function form( $instance ) {

		$defaults = array(
		'title'=> '',
		'show'=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'feast') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php _e('Number of tweets to show:', 'feast') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" />
		</p>
		
	<?php
	}
}


/**
 * ************************************************************
 * galleries widget
 **************************************************************/



add_action( 'widgets_init', 'galleries_widgets' );
function galleries_widgets() {register_widget( 'galleries_Widget' );}

class galleries_widget extends WP_Widget {
	
	function galleries_Widget() {	
		$widget_ops = array( 'classname' => 'galleries_widget', 'description' => __('Display latest Galleries.', 'feast') );
		$this->WP_Widget( 'galleries_widget', __('Galleries Widget', 'feast'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$lnumber = absint( $instance['lnumber'] );
		$title = apply_filters('widget_title', $instance['title']);

		$counter = 1;		
		if (!$imgnum) {
			$imgnum = 3;
		}
		
		echo $before_widget;
				
		echo '<div class="imgblock"><div class="imlk"><div class="gallwidgouter ">';
				
		$output = '';
		$arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $lnumber );
		foreach ( $arrImages as $attachment_id => $attachment ) {
			if ($counter <= $imgnum) {
				$image_attributes = wp_get_attachment_image_src( $attachment_id, 'medium' );			
				$output .= '<div class="gallwidg" >' .  wp_get_attachment_image( $attachment_id, 'medium' ) . '</div>';
				$counter++;
			}
		}
		echo $output;
		echo '</div>';
		if ( $title ){
			echo '<p class="lightblock1 paddingfix">' . $title . '</p>';
		}
		echo '<span class="imgblockover blockover1 galinvoke" rel="' .  $lnumber   .  '"></span></div></div>';
		echo $after_widget;					
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['lnumber'] = $new_instance['lnumber'];
		$instance['imgnum'] = $new_instance['imgnum'];
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}
	
	function form( $instance ) {
	
		$defaults = array(
		'title'=> '',
		'lnumber'=> '',
		'imgnum' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'netstudio') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'imgnum' ); ?>"><?php _e('Images to show:', 'netstudio') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'imgnum' ); ?>" name="<?php echo $this->get_field_name( 'imgnum' ); ?>" value="<?php echo $instance['imgnum']; ?>" />
		</p>
		<p>This widget will only work with 2 images or more. Portrait type photos will be cropped.</p>
		<p>
            <label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Gallery:', 'feast'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            	<?php $linkposts = get_posts('numberposts=10000&post_type=galleries');
            	foreach($linkposts as $linkentry) :
				$linkvalue = $linkentry->ID;
				echo '<option';
				if ($instance['lnumber'] == $linkvalue){
				echo ' selected="selected"';
				}
				echo ' value="', $linkvalue , '">', $linkentry->post_title , '</option>';			
				endforeach;	
				?>
			</select> 
           </p>		
	<?php
	}
}

?>