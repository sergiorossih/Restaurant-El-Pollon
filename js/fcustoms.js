jQuery(document).ready(function($) {
	
	$('#slideinner ul').jcarousel({
		wrap: 'last',
		scroll: 1,
		auto: 6
    });
	
	var init = window.setInterval(dogal, 6000);
	
	function dogal() {
		var thisser = $('.gallwidgouter .gallwidg:last');
		var thismove = $('.gallwidgouter .gallwidg:first');
		$(thismove).hide()
		$(thisser).after(thismove);
		$(thismove).fadeIn(2000);
	}
	
	
	
	var sitefirst = $('#outer').attr('rel');
  	var sitesecond = $('#outer').attr('contents');
	
	
	$('a[href^="http://"]')
  		.attr({
   		target: "_blank",
    	title: "Opens in a new window"
  	});
  	
  	$('a[href^="https://"]')
  		.attr({
   		target: "_blank",
    	title: "Opens in a new window"
  	});
  	
  	
  	$('a[href^="https://"]').each(function() {
  		var repval = $(this).attr('href');
  		var repreplace = repval.replace(sitesecond , sitefirst);
  		$(this).attr('href',repreplace);
  		
  	});

	
	var init = setInterval(animation, 100);

	function animation(){		
		var deadline1 = $('.time').attr('rel');
		var deadline2 = $('.time').attr('contents');
		var now = new Date();
		now = Math.floor(now / 1000);
		now = now + Math.floor(deadline2 * 60 * 60);
		var counter1 = deadline1 - now;
		var seconds1=Math.floor(counter1 % 60);
		if (seconds1 < 10 && seconds1 > 0 ){
			seconds1 = '0'+seconds1;
		}
		counter1=counter1/60;
		var minutes1=Math.floor(counter1 % 60);
		if (minutes1 < 10 && minutes1 > 0){
			minutes1 = '0'+minutes1;
		}
		counter1=counter1/60;
		var hours1=Math.floor(counter1 % 24);
		if (hours1 < 10 && hours1 > 0){
			hours1 = '0'+hours1;
		}
		counter1=counter1/24;
		var days1=Math.floor(counter1);
		if (days1 < 10 && days1 > 0){
			days1 = '0'+days1;
		}
		$('.time').html('<span class="counter first">'+days1+'</span><span class="counter second">'+hours1+'</span><span class="counter third">'+minutes1+'</span><span class="counter fourth">'+seconds1+'</span>');	
	}
		
});

