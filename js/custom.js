jQuery(document).ready(function($) {
	
	  	  
	// *************************** timer *********************************
	
	var init = setInterval(animation, 100);

	function animation(){	
		$('.time').each(function() {				
			var deadline1 = $(this).attr('rel');
			var deadline2 = $(this).attr('contents');
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
			$(this).html('<span class="counter first">'+days1+'</span><span class="counter second">'+hours1+'</span><span class="counter third">'+minutes1+'</span><span class="counter fourth">'+seconds1+'</span>');	
		});
	}
	
	// *************************** Carousel *********************************
	
	$('#carousel').jcarousel({
    	wrap: 'circular'
    });
		
	// *************************** Modal *********************************
	
	var openModal = function()
    {
       var myUrl = $('a.trigger').attr('href'); 
	   
	   $('#jqmContent').html('').attr('src', myUrl).css('width','600px').css('height','405px').css('overflow','hidden');  
	   
	   $('#modalWindow').show();

    };
	
	$('#modalWindow').jqm({
        modal: true,
        trigger: 'a.trigger',
        target: '#jqmContent',
        onShow: openModal
    });
	
	// *************************** tabs *********************************
	
	$('.tab_wrap ul li:first').addClass('current');
	
	$('.tcontentkeeper .tab:first').show();
	
	$('.tab_wrap ul li').click(function() {
		$('.tab_wrap ul li.current').removeClass('current');
		$(this).addClass('current');
		var slectr = $(this).children('a').attr('href');
		$('.tab:visible').hide();
		$(slectr).css('display','block');
		return false;		
	})
	
	$('.padder p:empty').css('display','none');
		
		
	// *************************** gallery widget *********************************
	
	var init = window.setInterval(dogal, 6000);
	
	function dogal() {
		$('.gallwidgouter').each(function() {
			var thisser = $(this).find('.gallwidg:last');
			var thismove = $(this).find('.gallwidg:first');
			$(thismove).hide()
			$(thisser).after(thismove);
			$(thismove).fadeIn(2000);			
		});
	}
		
	// *************************** slideshow *********************************
	
	var thew = theWindowWidth();
	var tagright = (thew/2)-500;
	
	$('.stripcontent:first').addClass('currentslide').find('img').css('opacity', '1');
	
	var data1 = $('.currentslide').attr('rel');
	var img = new Image();
	$(img).load(function () {				
		$('#topbgbehind').prepend(this);
	}).attr('src', data1);	
	
	var content1 = $('.currentslide').attr('alt');
	if ($('body.home').length) {
			$(content1).show();
	}
		
	var init = window.setInterval(doslide, trtime);
	
	$('p.thislink').mouseleave(function() {
  		init = window.setInterval(doslide, trtime);
	});
	
	$('p.thislink').mouseenter(function() {
  		window.clearInterval(init);
	});
		
	function doslide() {
		window.clearInterval(init);
		var active = $('.currentslide');
		var accontent = $(active).attr('alt');
		var next = $('currentslide').next('.stripcontent');
		var next = active.next('.stripcontent').length ? active.next('.stripcontent'): $('.stripcontent:first');
		var nxtcontent = $(next).attr('alt');
		var data1 = $(next).attr('rel');
		$('#topbgbehind img').clone().appendTo('#topholder');
		$('#topbgbehind').html('');
		var img = new Image();
		$(img).load(function () {				
			$('#topbgbehind').prepend(this);
			$('#topholder img').stop().animate({
						opacity: 0
					}, 1500, function(){
						$('#topholder img').remove();
					});
		}).attr('src', data1);
		$(next).addClass('currentslide');
		$(active).removeClass('currentslide');
		if ($('body.home').length) {
			$(accontent).hide();
			$(nxtcontent).show();
		}
		init = window.setInterval(doslide, trtime);
	}
	
	$('.stripcontent:not(currentslide)').click(function() {
		var active = $('.currentslide');
		var next = $(this);
		window.clearInterval(init);
		var accontent = $(active).attr('alt');
		var nxtcontent = $(next).attr('alt');
		var data1 = $(next).attr('rel');
		$('#topbgbehind img').clone().appendTo('#topholder');
		$('#topbgbehind').html('');
		var img = new Image();
		$(img).load(function () {				
			$('#topbgbehind').prepend(this);
			$('#topholder img').stop().animate({
						opacity: 0
					}, 1500, function(){
						$('#topholder img').remove();
					});
		}).attr('src', data1);
		$(next).addClass('currentslide');
		$(active).removeClass('currentslide');
		$(accontent).hide();
		$(nxtcontent).show();
		init = window.setInterval(doslide, trtime);
	});	
	
	function theWindowWidth() {
        var wWidth = 0;
        if (typeof(window.innerWidth) == 'number') {
            wWidth = window.innerWidth;
        }
        else {
            if (document.documentElement && document.documentElement.clientWidth) {
                wWidth = document.documentElement.clientWidth;
            }
            else {
                if (document.body && document.body.clientWidth) {
                    wWidth = document.body.clientWidth;
                }
            }
        }
        return wWidth;
    };
		
	$('a.close').click(function() {
		$('.active').fadeOut('slow').removeClass('active');
		return false;
	});
	
	// *************************** calendar *********************************
  
  	$('a.nxtlink').click(function(){
  		nxtsol();
		return false;
  	});
   
  	$('a.prevlink').click(function(){
  		prvsol();
		return false;
  	});
  
  	function nxtsol(){
  		var sender = $('a.nxtlink').attr('rel');
  		var data = { action: 'netlabs_get_ajaxdata', type: 'get_cal', senddata: sender};
		$.post(ajax_url, data, function(response) {	
			$('.calselect').html(response);
			$('a.nxtlink').unbind('click').bind('click', nxtsol);
			$('a.prevlink').unbind('click').bind('click', prvsol);
		});
		return false;
	}
  
	function prvsol(){
  		var sender = $('.prevlink').attr('rel');
  		var data = { action: 'netlabs_get_ajaxdata', type: 'get_cal', senddata: sender};
		$.post(ajax_url, data, function(response) {	
			$('.calselect').html(response);
			$('a.prevlink').unbind('click').bind('click', prvsol);
			$('a.nxtlink').unbind('click').bind('click', nxtsol);
		});
		return false;
  	} 
  

	// *************************** countdowntimer animations *********************************
	
	$('.timerclose').click(function() {
		$('.timermover').animate({
    		top: '-=425'
  			}, 1000
		);
		var cookieval = $('.time').attr('rel');
		$.cookie('netsgrowler', cookieval, { expires: 365, path: '/' });
		$('.arrow-left').css('visibility','visible');
	});
	
	var cookieread = $('.time').attr('rel');
	var cookieset = $.cookie('netsgrowler');
	
	if (cookieread != cookieset){
		$('.timermover').delay(cdelay).animate({
    		'top': '+=425'
  			}, 1000
		);
		$('.arrow-left').css('visibility','hidden');
	}
	
	$('.arrow-left').click(function() {
		$('.timermover').animate({
    		'top': '+=425'
  			}, 1000
		);
		$(this).css('visibility','hidden');
	});
	
	
	// *************************** bookingcalendar functions *********************************
	
	$('.nextmonth').click(function() {
		mycalgetnxt();
	});
		
	$('.prevmonth').click(function() {
		mycalgetprv();
	});

	function mycalgetnxt() {
		$('.calheader').addClass('loadcal');
		var nextdata = $('.nextmonth').attr('rel');
		var data = { action: 'netlabs_get_ajaxdata', type: 'get_bookingcal', datedata:nextdata};
		$.post(ajax_url, data, function(response) {	
			$('.calendarholder').html(response);
			$('.prevmonth').unbind('click').bind('click',mycalgetprv);
			$('.nextmonth').unbind('click').bind('click',mycalgetnxt);
			dayclick();
		});
		$('.calheader').removeClass('loadcal');
	}

	function mycalgetprv() {
		$('.calheader').addClass('loadcal');
		var nextdata = $('.prevmonth').attr('rel');
		var data = { action: 'netlabs_get_ajaxdata', type: 'get_bookingcal', datedata:nextdata};
		$.post(ajax_url, data, function(response) {	
			$('.calendarholder').html(response);
			$('.prevmonth').unbind('click').bind('click',mycalgetprv);
			$('.nextmonth').unbind('click').bind('click',mycalgetnxt);
			dayclick();
		});
		$('.calheader').removeClass('loadcal');
	}
	
	dayclick();
	
	
	function dayclick() {
		$('.bdavailable').click(function() {
			$('.dcurrent').removeClass('dcurrent');
			$(this).addClass('dcurrent');
			var daymonth = $('#bookingform-date').attr('rel');
			var daydetails = $(this).html();
			$('.bookingform-day').val(daydetails);
			var daystring = daydetails + ' ' + daymonth;
			$('#bookingform-date').val(daystring);
		});	
	}
	
	var timereset = $('#bookingform-time').attr('rel');
	$('#bookingform-time').val(timereset);
	
	var datereset = $('#bookingform-date').attr('rel');
	$('#bookingform-date').val(datereset);
	
	$('.btavailable').click(function() {
		$('.tcurrent').removeClass('tcurrent');
		$(this).addClass('tcurrent');
		var minvalue = $('.minholder').attr('rel');
		var hourdetails = $(this).html();
		if (!minvalue) {
			var hourstring = hourdetails + ' H 00';
			$('.minholder').attr('rel', '00');
		} else {
			var hourstring = hourdetails + ' H ' + minvalue;
		}
		$('.hourholder').attr('rel', hourdetails);
		$('#bookingform-time').val(hourstring);
	});
	
	$('.bmavailable').click(function() {
		$('.mcurrent').removeClass('mcurrent');
		$(this).addClass('mcurrent');
		var hourvalue = $('.hourholder').attr('rel');
		var mindetails = $(this).html();
		if (hourvalue){
			var hourstring = hourvalue + ' H ' + mindetails;
			$('#bookingform-time').val(hourstring);
			$('.minholder').attr('rel', mindetails);
		} else {
			$('.minholder').attr('rel', mindetails);
		}		
	});
								
});