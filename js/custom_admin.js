jQuery(document).ready(function($) {
	
	$('.nets_poststuff .postbox').each(function(){
		$(this).addClass('closed').hide();
		
	})
	
	$('.nets_poststuff .postbox:first').removeClass('closed').show();
	
	$('.tabholder li').click(function() {
		$('.tabholder li.current').removeClass('current');
		$(this).addClass('current');
		var currslide = $(this).attr('rel');
		$('.nets_poststuff .postbox:visible').addClass('closed').hide();
		$(currslide).removeClass('closed').show();
	});

								
});