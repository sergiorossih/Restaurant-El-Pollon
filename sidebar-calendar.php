<?php
/**
 * The Sidebar containing the primary widget area.
 *

 */
?>

<div id="primary" class="widget-area grid4 sider" role="complementary" >
				
	<ul class="xoxo">
		<?php if ( is_active_sidebar( 'cal-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'cal-sidebar' ); ?>
		<?php endif; ?>
	</ul>

</div><!-- #primary .widget-area -->

