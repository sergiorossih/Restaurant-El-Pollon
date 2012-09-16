<?php 

function prevlink($month,$year) {
	if ($month) {
		$month = $month - 1; 
	} else {
		$month = date('n')-1;
		$year = date('Y');
	}
	if ($month <= 0) { $month = 12; $year = $year - 1; }
	return '<a href="#" rel="' . $month . '/' . $year . '" class="prevlink">' .  __('PREV', 'feast') . '</a>';
}

function nextlink($month,$year) {
	if ($month) {
		$month = $month + 1;
	} else {
		$month = date('n')+1;
		$year = date('Y');
	}
	if ($month >= 13) {$month = 1;$year = $year + 1;}
	return '<a href="#" rel="' . $month . '/' . $year . '" class="nxtlink">' .  __('NEXT', 'feast') . '</a>';
}

function monthname($month,$year) {
	global $post, $wp_locale;
	if ($month) {
		$output = date_i18n( 'F Y' , mktime(0, 0, 0, $month, 1, $year), false );
	} else {
		$output = date_i18n( 'F Y' , time(), false );
	}
	return $output;
}


function dateDff($start, $end) {
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $end_ts - $start_ts;
	return round($diff / 86400);
}


function get_first_day($day_number, $month=false, $year=false)
  {
    $month  = ($month === false) ? strftime("%m"): $month;
    $year   = ($year === false) ? strftime("%Y"): $year;
	if ($day_number == 'Sunday') {$day_number = 0; 
  	} elseif($day_number == 'Monday') {$day_number = 1;
  	} elseif($day_number == 'Tuesday') {$day_number = 2;
  	} elseif ($day_number == 'Wednesday') {$day_number = 3;
  	} elseif ($day_number == 'Thursday') {$day_number = 4;
	} elseif ($day_number == 'Friday') {$day_number = 5;
	} elseif ($day_number == 'Saturday') {$day_number = 6; } 
    $first_day = 1 + ((7+$day_number - strftime("%w", mktime(0,0,0,$month, 1, $year)))%7);
    return mktime(0,0,0,$month, $first_day, $year);
}


function calendar_add($cstrdate,$cctitle,$cclink,$cccontent,$cclocation,$ccids) {
	global $calentries;
	$calentries[] = array (					
		'strdate' => $cstrdate,
		'ctitle' => $cctitle,
		'clink' => $cclink,
		'ccontent' => $cccontent,
		'clocation' => $cclocation,
		'cids' => $ccids,
	);	
}

function monthconvert($monthname) {
	$monthnames = '';
	if ($monthname == '1') {$monthnames = 'Jan';}
	if ($monthname == '2') {$monthnames = 'Feb';}
	if ($monthname == '3') {$monthnames = 'Mar';}
	if ($monthname == '4') {$monthnames = 'Apr';}
	if ($monthname == '5') {$monthnames = 'May';}
	if ($monthname == '6') {$monthnames = 'Jun';}
	if ($monthname == '7') {$monthnames = 'Jul';}
	if ($monthname == '8') {$monthnames = 'Aug';}
	if ($monthname == '9') {$monthnames = 'Sept';} 
	if ($monthname == '01') {$monthnames = 'Jan';}
	if ($monthname == '02') {$monthnames = 'Feb';}
	if ($monthname == '03') {$monthnames = 'Mar';}
	if ($monthname == '04') {$monthnames = 'Apr';}
	if ($monthname == '05') {$monthnames = 'May';}
	if ($monthname == '06') {$monthnames = 'Jun';}
	if ($monthname == '07') {$monthnames = 'Jul';}
	if ($monthname == '08') {$monthnames = 'Aug';}
	if ($monthname == '09') {$monthnames = 'Sept';} 
	if ($monthname == '10') {$monthnames = 'Oct';} 
	if ($monthname == '11') {$monthnames = 'Nov';} 
	if ($monthname == '12') {$monthnames = 'Dec';}
	if ($monthname == 1) {$monthnames = 'Jan';}
	if ($monthname == 2) {$monthnames = 'Feb';}
	if ($monthname == 3) {$monthnames = 'Mar';}
	if ($monthname == 4) {$monthnames = 'Apr';}
	if ($monthname == 5) {$monthnames = 'May';}
	if ($monthname == 6) {$monthnames = 'Jun';}
	if ($monthname == 7) {$monthnames = 'Jul';}
	if ($monthname == 8) {$monthnames = 'Aug';}
	if ($monthname == 9) {$monthnames = 'Sept';} 
	if ($monthname == 01) {$monthnames = 'Jan';}
	if ($monthname == 02) {$monthnames = 'Feb';}
	if ($monthname == 03) {$monthnames = 'Mar';}
	if ($monthname == 04) {$monthnames = 'Apr';}
	if ($monthname == 05) {$monthnames = 'May';}
	if ($monthname == 06) {$monthnames = 'Jun';}
	if ($monthname == 07) {$monthnames = 'Jul';}
	if ($monthname == 08) {$monthnames = 'Aug';}
	if ($monthname == 09) {$monthnames = 'Sept';} 
	if ($monthname == 10) {$monthnames = 'Oct';} 
	if ($monthname == 11) {$monthnames = 'Nov';} 
	if ($monthname == 12) {$monthnames = 'Dec';}
	return $monthnames;   
}

function make_epoch($day, $month , $year , $time , $gmt) {
	$thismonth = monthconvert($month);	
	$thisconvert = $day . ' ' . $thismonth . ' ' . $year . ' ' . $time . ' ' . $gmt;
	$thisdatereturn = strtotime($thisconvert);
	return $thisdatereturn;	
}


function recinthappening ($intervalvalue, $dayvalue, $month, $year, $time, $daysinmonth){
	
	if (!$time){$time = '23:59:59';}	
	$first_day_tocalculate = get_first_day($dayvalue, $month, $year);
		
	$specrec = make_epoch(date('j', $first_day_tocalculate), date('m', $first_day_tocalculate), date('Y', $first_day_tocalculate), $time,'GMT');
		
	if ($intervalvalue == 'Second') {$specrec = $specrec + 604800;}
	if ($intervalvalue == 'Third') {$specrec = $specrec + 1209600;}		
	if ($intervalvalue == 'Fourth') {$specrec = $specrec + 1814400;}	
	if ($intervalvalue == 'Last') {	
		$lastmonthday = make_epoch($daysinmonth, $month,  $year, '23:59:59' ,'GMT');
	
		if ($specrec + 2419200 <= $lastmonthday) {
			$specrec = $specrec + 2419200;
		} else {
			$specrec = $specrec + 1814400;
		}	
	}
	return $specrec;	
}



function get_the_events($month,$year) {
	global $calentries;
	$output = '';
	unset($calentries);
	$datediff = 0;
	$calentries = array();
	$args=array(
		'post_type'=>'calendars',
		'showposts'=> 10000,
	);
	
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	$postid = get_the_ID();
	$key_date_value = '';
	$key_end_value = '';
	$key_time_value = ' ';
	$key_place_value = ' ';
	$key_recurring_value = '';
	$key_recint_value = '';
	$key_recday_value = '';
	$occurance = '';
	$key_recint_value = get_post_meta($postid, 'netlabs_recint', true);
	$key_recday_value = get_post_meta($postid, 'netlabs_recday', true);
	$key_date_value = get_post_meta($postid, 'netlabs_datestartentry', true);
	$key_recurring_value = get_post_meta($postid, 'netlabs_recurring', true);
	$key_end_value = get_post_meta($postid, 'netlabs_dateendentry', true);
	$key_time_value = get_post_meta($postid, 'netlabs_timestartentry', true);
	$key_place_value = get_post_meta($postid, 'netlabs_thelocation', true);
	
	// create a valid date from data
	$dateholder = explode('/',$key_date_value);
	$endholder =  explode('/',$key_end_value);	
	
	$startepoch = '';
	// get epoch for start date	
	if ($key_time_value) {
		$startepoch = strtotime($dateholder[0] .  ' ' .  monthconvert($dateholder[1]) . ' ' .  $dateholder[2] .  ' ' . $key_time_value . ' GMT');
		}  else {
		$startepoch = strtotime($dateholder[0] .  ' ' .  monthconvert($dateholder[1]) . ' ' .  $dateholder[2] .  ' 00:00:01 GMT');
	}
		
	$endepoch = '';	
	if ($key_end_value && $key_time_value ) {
		$endepoch = strtotime($endholder[0] .  ' ' .  monthconvert($endholder[1]) . ' ' .  $endholder[2] .  ' ' . $key_time_value . ' GMT');
	} elseif ($key_end_value && !$key_time_value ) {	
		$endepoch = strtotime($endholder[0] .  ' ' .  monthconvert($endholder[1]) . ' ' .  $endholder[2] .  ' 00:00:01 GMT');
	}
	
	// get epoch for first day in month
	if ($key_time_value ) {
	$beginningepoch = make_epoch('1', $month, $year, $key_time_value ,'GMT');
	} else {
	$beginningepoch = make_epoch('1', $month, $year, '00:00:01','GMT');
	}
	
	
	$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
	// get epoch for last day in month
	$closingepoch = make_epoch($daysinmonth, $month, $year, '23:59:59','GMT');
	
	
	// special reccuring
	if ($key_recint_value != 'select interval' && $key_recday_value != 'select day') {	
		$firstone = recinthappening($key_recint_value, $key_recday_value, $month, $year, $key_time_value, $daysinmonth);
		$occurance = 1;
	
		if ($startepoch > $firstone ) {
			$occurance = 0;			
		} else {		
			if ($endepoch && ($endepoch < $firstone)) {
				$occurance = 0;
			}		
		} 

	// basic reccuring
	} elseif ($key_recurring_value != 'Never') {
	
		if ($key_recurring_value == 'Every month same date') {
			$occurance = 1;
			if ($key_time_value) {
				$firstone = make_epoch(date('j', $startepoch), $month, $year, $key_time_value,'GMT');
			} else {
				$firstone = make_epoch(date('j', $startepoch), $month, $year, '11.59 pm','GMT');
			}
			
			if ($startepoch > $firstone) {
				$occurance = 0;			
			} else {		
				if ($endepoch && ($endepoch < $firstone)) {
					$occurance = 0;
				}		
			} 
		}
		
		if ($key_recurring_value == 'Every week same day') {
			$occurance = 2;
			$interval = 604800;
			unset($datelist);
			$datelist = array();
			$the_dayname = date('l', $startepoch);
			// epoch for first occurence in month
			$first_occurence_in_month = get_first_day($the_dayname, $month, $year);
			
			if ($key_time_value) {
				$firstone = make_epoch(date('j', $first_occurence_in_month), date('m', $first_occurence_in_month), date('Y', $first_occurence_in_month), $key_time_value,' GMT');
			} else {
				$firstone = make_epoch(date('j', $first_occurence_in_month), date('m', $first_occurence_in_month), date('Y', $first_occurence_in_month), '11.59 pm',' GMT');
			}
			
			for($i = $firstone; $i < $closingepoch; $i = $i + $interval) {	
				if ($startepoch > $i ) {
					//do nothing
				} else {
					if (!$endepoch) {
						$datelist[] = $i;
					} else {
						if ($endepoch < $i) {
							$datelist[] = $i;
						}
					}
				}
			}		
		}

	// single or multiday
	} else {
		
		if (!$endepoch) {
			if ($startepoch > $beginningepoch && $startepoch < $closingepoch) {
				$occurance = 1;
				$firstone = $startepoch;
			}
		} else {
			$occurance = 2;
			unset($datelist);
			$datelist = array();
			for($i = ($beginningepoch); $i < $closingepoch; $i = $i + 86400) {
				if ($i >= $startepoch && $i <= $endepoch) {
					$datelist[] = $i;
				}
			}
		}
	} 
	
	if ($occurance == 1) {
		calendar_add($firstone,get_the_title(),get_permalink(),get_the_excerpt(),$key_place_value, $postid );
	}
	
	if ($occurance == 2) {
		foreach ($datelist as $dateentry) {
			calendar_add($dateentry,get_the_title(),get_permalink(),get_the_excerpt(),$key_place_value, $postid );
		}
	}
	
	endwhile;
	else : endif;
	wp_reset_query();	
}

function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {$b[$k] = strtolower($v[$subkey]);}
	asort($b);
	foreach($b as $key=>$val) {$c[] = $a[$key];}
	return $c;
}


function get_the_calendar($cmonth,$cyear) {
	global $calentries, $wp_locale;
	$calentries = array();
	$output = '';
	get_the_events($cmonth,$cyear);
	$countr = 1;
	if($calentries) {		
		$calentries = subval_sort($calentries,'strdate'); 
		foreach ($calentries as $cal_the_entry) {	
			$caltime = get_post_meta($cal_the_entry['cids'], 'netlabs_timestartentry', true);
			if (($countr - 1) %3 == 0 || $countr == 1) {
				$output .= '<span class="clear"></span><div class="grid4 first"><div class="calsingleentry mainbg clear"><div class="calsingleinner">';
			} else {
				$output .= '<div class="grid4"><div class="calsingleentry mainbg"><div class="calsingleinner">';
			}
			$theimg = get_the_post_thumbnail($cal_the_entry['cids'],'imlink');
			if ($theimg) {
			$output .= '<div class="imgblock"> <div class="imlk">' . $theimg . '<a href="' . $cal_the_entry['clink'] . '" class="imgoverlink imgoverlink1"><span class="imgblockover blockover1"></span></a>';
			} else {
			$output .= '<div class="imgblock"> <div class="imlk"><img src="' .get_template_directory_uri() . '/images/commingsoon.jpg"><a href="' . $cal_the_entry['clink'] . '" class="imgoverlink imgoverlink1"><span class="imgblockover blockover1"></span></a>';
			}
			$output .= '<div class="calbg"><span class="daynumber">'. date('d', $cal_the_entry['strdate']) . '</span><span class="day">' . date_i18n( 'D' , $cal_the_entry['strdate'] , false ) . '</span></div></div>';
			$output .= '<p class="lightblock1 blockpic calpic">' . $cal_the_entry['ctitle'] .  '</p></div>';
			if ($caltime){ 
				$output .= '<p class="intdesc"><strong>' .  __('Time: ', 'feast') . '</strong>' . $caltime . '&nbsp;&nbsp;&nbsp;</p>';
			}
			$text = $cal_the_entry['ccontent'];
			if (strlen($text) > 140) {
				$text = substr($text,0,strpos($text,' ',170)); 
			} 
			$output .= '<span class="thedesc">' . apply_filters('the_excerpt',$text . '...') . '</span><p class="more-class"><a href="' . $cal_the_entry['clink'] . '" class="more-link darkbox"><span>' .  __('More info', 'feast') . '</span></a></p>';
			$output .= '</div></div></div>';
		$countr++;
		if ($countr == 4){$countr ==1;}
		}	
		return $output;
	} else {
		$output = '<p>' .  __('No entries found ', 'feast') . '</p>';
		return $output;
	}
}


function get_for_timer($title){
	global $calentries;
	$calentries = array();
	$output = '';
	$tmonth = date("n");
	$tyear = date("Y");
	$emptycounter = 0;
	$ccounter = '';
	$currententry = date('U');
	$offset = get_option('gmt_offset');
	$offset2 = $offset * 60 * 60;
	$currententry = $currententry + $offset2;
	
	while ($emptycounter <= 5 && !$ccounter) { 	
		get_the_events($tmonth,$tyear);		
		if($calentries) {	
			$calentries = subval_sort($calentries,'strdate'); 
			foreach ($calentries as $cal_the_entry) {			
				if ($cal_the_entry['strdate'] >= $currententry && !$ccounter) {	
					$theimg = get_the_post_thumbnail($cal_the_entry['cids'], 'imlink');				
					$output .= '<div class="timermover"><div class="timerimg">';
					if ($theimg) {
					$output .= $theimg;
					} else {
					$output .= '<img src="' .get_template_directory_uri() . '/images/commingsoon.jpg">';
					}
					$output .= '</div>';
					$output .= '<div class="timerdesc lightblock1">' . $cal_the_entry['ctitle'] .  '</div>';
					$output .= '<div class="timerclose">close</div>';
					$output .= '<a class="timermore" href="' . get_permalink($cal_the_entry['cids'] ) . '">' .  __('more info', 'feast') . '</a>';
					$output .= '</div>';
					$output .= '<div class="timemachine">';
							$output .= '<div class="announce"><span>' .  __('Next show in', 'feast') . '</span></div><div class="arrow-left"></div><div class="time" contents="' . $offset  .'" rel="' . $cal_the_entry['strdate'] . '"></div>';
							$output .= '<div class="timernames">';
								$output .= '<span class="daynames first">' .  __('DAYS', 'feast') . '</span><span class="daynames second">' .  __('HOURS', 'feast') . '</span><span class="daynames third">' .  __('MINS', 'feast') . '</span><span class="daynames fourth">' .  __('SECS', 'feast') . '</span><div class="clear"></div>';
							$output .= '</div>';
						$output .= '</div>';	
					$ccounter = 1;			
				}		
			}	
		}		
		$tmonth = $tmonth + 1;
		if ($tmonth == 13) {
			$tmonth = 1;
			$tyear = $tyear + 1;
		}
		$emptycounter++;
	}
	
	if ($output)  {
		echo $output;
	} else{
		echo __('no entries found', 'feast');
	}
}

function get_for_widget($num, $offset){
	global $calentries, $wp_locale;
	unset($calwidget);
	$calwidget = array();
	$woutput = '';
	$monthset = '';
	$wmonth = date("n");
	$wyear = date("Y");
	$emptycounter = 0;
	$wcounter = 0;
	$currententry = date('U');
	$continue = 0;
	$wnum = $offset + $num - 1;
	$calcounter = 0;
	
	while ($continue != 1) { 
		$calentries = array();
		get_the_events($wmonth,$wyear);	
		if($calentries) {
			$calentries = subval_sort($calentries,'strdate'); 
			foreach ($calentries as $cal_the_entry) {
				if ($cal_the_entry['strdate'] >= $currententry && $wcounter <= $wnum) {
					$calwidget[] = array
						(					
						'wstrdate' => $cal_the_entry['strdate'],
						'wtitle' => $cal_the_entry['ctitle'],
						'wids' => $cal_the_entry['cids'],
					);				
					$wcounter = $wcounter + 1;	
				}	
			}	
		}
				
		$wmonth = $wmonth + 1;
		if ($wmonth == 13) {
			$wmonth = 1;
			$wyear = $wyear + 1;
		}
		$emptycounter++;
		$monthset = '';
		if ($wcounter >= ($num + $offset) || $emptycounter >= 5) {
			$continue = 1;
		}
	}
	
	
	$calwidget = subval_sort($calwidget,'wstrdate'); 
	foreach ($calwidget as $calwidg) {
		if ($calcounter >= $offset) {
		$caltime = get_post_meta($calwidg['wids'], 'netlabs_timestartentry', true);
		$woutput .= '<div class="imgblock"><div class="imlk">';
		$theimg = get_the_post_thumbnail($calwidg['wids'], 'imlink');				
		if ($theimg) {
		$woutput .= $theimg;
		} else {
		$woutput .= '<img src="' .get_template_directory_uri() . '/images/commingsoon.jpg">';
		} 	
		$woutput .= '<p class="lightblock1 blockpic"><a href="' . get_permalink($calwidg['wids'] ) . '">' . $calwidg['wtitle'] .  '</a></p>
				<a href="' . get_permalink($calwidg['wids'] ) . '" class="imgoverlink imgoverlink1"><span class="imgblockover blockover1"></span></a>
				<a href="' . get_permalink($calwidg['wids'] ) . '"><span class="dateslip">'. date('d', $calwidg['wstrdate']) . ' ' . date_i18n( 'M' , $calwidg['wstrdate'] , false ) . '</span></a>
				</div></div>';
		}
		$calcounter++;
	}
	
	

	if ($woutput) {
	echo $woutput;
	} else {
	echo 'no-entries found';
	}

}


function caldescript($post_ID) {

	global $wp_locale;

	$key_date_value = '';
	$key_end_value = '';
	$key_time_value = '';
	$key_place_value = '';
	$key_recurring_value = '';
	$key_recint_value = '';
	$key_recday_value = '';
	$key_recint_value = get_post_meta($post_ID, 'netlabs_recint', true);
	$key_recday_value = get_post_meta($post_ID, 'netlabs_recday', true);
	$key_date_value = get_post_meta($post_ID, 'netlabs_datestartentry', true);
	$key_recurring_value = get_post_meta($post_ID, 'netlabs_recurring', true);
	$key_end_value = get_post_meta($post_ID, 'netlabs_dateendentry', true);
	$key_time_value = get_post_meta($post_ID, 'netlabs_timestartentry', true);
	$key_place_value = get_post_meta($post_ID, 'netlabs_thelocation', true);
	
	
	$dateholder = explode('/',$key_date_value);	
	
	$datestring = make_epoch($dateholder[0], $dateholder[1] , $dateholder[2] , $key_time_value , 'GMT');
	if ($key_end_value) {
		$endholder =  explode('/',$key_end_value);
		$endstring = make_epoch($endholder[0], $endholder[1] , $endholder[2] , $key_time_value , 'GMT');
	} else {
		$endstring = '';
	}
	
	$output = '<div class="calexplain lightblock1"><div class="calexplaininner clear">';
	if ($key_recurring_value == 'Never' && $key_recint_value == 'select interval' && $key_recday_value == 'select day'){
		if ($endstring) {		
			$output .= '<p class="calsingle"><strong>' .  __('Start Date: ', 'feast') . '</strong><span>' . date_i18n( 'd F Y' , $datestring , false ) . '</span></p>';
			$output .= '<p class="calsingle"><strong>' .  __('End Date: ', 'feast') . '</strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span></p>';			
		} else {		
			$output .=  '<p class="calsingle"><strong>' .  __('Date: ', 'feast') . '</strong><span>' . date_i18n('l d F Y', $datestring , false ) . '</span></p>';
		}	
	}
	
	if ($key_recurring_value == 'Every week same day' && $key_recint_value == 'select interval' && $key_recday_value == 'select day'){	
		if ($endstring) {
			$output .= '<p class="calsingle"><strong>' .  __('Every', 'feast') . ' ' . date_i18n('l', $datestring , false ) . '</strong></p>';
			$output .= '<p class="calsingle"><strong>' .  __('until', 'feast') . ' </strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span></p>';			
		} else {		
		$output .= '<p class="calsingle"><strong>' .  __('Every', 'feast') . ' ' . date_i18n('l', $datestring , false ) . '</strong></p>';				
		}	
	}
	
	if ($key_recurring_value == 'Every month same date' && $key_recint_value == 'select interval' && $key_recday_value == 'select day'){	
		if ($endstring) {
			$output .= '<p class="calsingle"><strong>' .  __('Every', 'feast') . ' ' . date_i18n('jS', $datestring , false ) . ' ' .  __('of the month', 'feast') . '</strong></p>';
			$output .= '<p class="calsingle"><strong>' .  __('until', 'feast') . ' </strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span></p>';
		} else {		
			$output .= '<p class="calsingle"><strong>' .  __('Every', 'feast') . ' ' . date_i18n('jS', $datestring , false ) . ' ' .  __('of the month', 'feast') . ' </strong></p>';				
		}	
	}
	
	if ($key_recurring_value == 'Never' && $key_recint_value != 'select interval' && $key_recday_value != 'select day'){	
		if ($endstring) {
			$output .= '<p class="calsingle"><strong>' .  __('Every', 'feast') . ' ' . $key_recint_value . ' ' . $key_recday_value . ' ' .  __('of the month', 'feast') . ' </strong></p>';
			$output .= '<p class="calsingle"><strong>' .  __('until', 'feast') . ' </strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span></p>';			
		} else {		
			$output .= '<p class="calsingle"><strong>' .  __('Every', 'feast') . ' ' . $key_recint_value . ' ' . $key_recday_value . ' ' .  __('of the month', 'feast') . '</strong></p>';				
		}	
	}
	
	if ($key_time_value) {	
		$output .= '<p class="calsingle"><strong>' .  __('Time: ', 'feast') . '</strong><span>'. $key_time_value .'</span></p>';
	}
	
	$output .= '</div></div>';
	echo $output;

}



/******************************************************************
 * compose emailtemplate
 ******************************************************************/

function lets_make_newstemplate($messagetype, $bookingmail, $bookingtel, $bookinginfo, $bookingnumber, $bookingdate, $bookingname, $showdirections){

	global $wp_locale;

	$messbody = get_option('nets_' . $messagetype);
	
	$messheader = get_option('nets_s_' . $messagetype);
	
	if (get_option('nets_physaddr')) {
		$streetaddr = '<div class="street-address"><span>';
		$streetaddr .= str_replace(',' , '<br/>', get_option('nets_physaddr'));
		$streetaddr .= '</span></div>';
	}
	
	$messtime = date_i18n( 'l d F Y g:i a' , $bookingdate , false );
	
	
	if ($showdirections == 'show'){
	
		$showdir =	'<td valign="top" id="appointment" style="color: #666;font-size: 18px;font-weight: normal;font-family: Georgia;text-align: center;padding: 0px 0px 40px 0px;">
              		<h2 class="secondary-heading" style="color: #000;font-size: 24px;font-weight: normal;font-style: normal;font-family: Georgia;margin: 30px 0 10px 0;">' .  __('Need directions?', 'feast') . '</h2>
              		<p><a href="' . get_option('nets_themelogo')  . '" style="color: #fff; background: #9B4804; padding: 5px 10px; text-decoration: none;">' .  __('Click here', 'feast') . '</a></p>
					</td>';
	} else {
		$showdir = '';
	}
	
	if ($bookingname || $messtime || $bookingnumber || $bookingmail || $bookingtel || $bookinginfo) {
	
		$messdetails = '';
	
		if ($bookingname) {	
			$messdetails .= '<tr><td id="lead_content" colspan="1">';
			if ($messagetype == 'newnewsletterc' || $messagetype == 'newnewsletter') {
				 $messdetails .= '<p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Name:', 'feast') . '</strong> </p></td><td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookingname  . '</p>';
			} else {
				$messdetails .= '<p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Table reserved for:', 'feast') . '</strong> </p></td><td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookingname  . '</p>';
			}
			$messdetails .= '</td></tr>';	
		}
		if ($messtime) {
			$messdetails .= '<tr><td id="lead_content" colspan="1">
				 <p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Date of booking:', 'feast') . '</strong> </p></td><td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $messtime  . '</p>
			</td></tr>';		
		}
		if ($bookingnumber) {
			$messdetails .= '<tr><td id="lead_content" colspan="1">
				 <p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Number of guests:', 'feast') . '</strong> </p></td><td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookingnumber  . '</p>
			</td></tr>';	
		}
		if ($bookingmail) {
			$messdetails .= '<tr><td id="lead_content" colspan="1">
				 <p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Contact email:', 'feast') . '</strong> </p></td><td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookingmail  . '</p>
			</td></tr>';		
		}
		if ($bookingtel) {
			$messdetails .= '<tr><td id="lead_content" colspan="1">
				 <p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Contact telephone number', 'feast') . '</strong> </p></td><td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookingtel  . '</p>
			</td></tr>';		
		}
		if ($bookinginfo) {	
			$messdetails .= '<tr><td id="lead_content" colspan="1">
				 <p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Special Instructions', 'feast') . '</strong> </p></td><td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookinginfo  . '</p>
			</td></tr>';	
		}
	
	}

	$output = '
	<html>
	<head>
		<title>' . get_bloginfo('name') . '</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		
	<style type="text/css">
		body,#wrap{
			text-align:center;
			margin:0px;
			background-color:#F5F4EB;
		}
		#header{
			background-color:#F5F4EB;
			margin:0px;
			padding:10px;
			color:#666;
			font-size:11px;
			font-family:Arial;
			font-weight:normal;
			text-align:center;
			text-transform:lowercase;
			border:none 0px #FFF;
		}
		#header a,#header a:link,#header a:visited{
			color:#666;
			text-decoration:underline;
			font-weight:normal;
		}
		#layout{
			margin:0px auto;
			text-align:center;
			font-family:Georgia;
			color:#404040;
			line-height:160%;
			font-size:16px;
		}
		#appointment{
			color:#666;
			font-size:18px;
			font-weight:normal;
			font-family:Georgia;
			text-align:center;
			padding:0px 0px 40px 0px;
		}
		.primary-heading{
			font-size:54px;
			color:#000;
			font-weight:normal;
			font-family:Georgia;
			line-height:120%;
			margin:10px 0;
		}
		.secondary-heading{
			color:#000;
			font-size:24px;
			font-weight:normal;
			font-style:normal;
			font-family:Georgia;
			margin:30px 0 10px 0;
		}
		#footer{
			background-color:#FFFFFF;
			border-top:1px solid #CCC;
			padding:20px;
			font-size:10px;
			color:#666;
			line-height:100%;
			font-family:Arial;
			text-align:center;
		}
		#footer a{
			color:#666;
			text-decoration:underline;
			font-weight:normal;
		}
		a,a:link,a:visited{
			color:#666;
			text-decoration:underline;
			font-weight:normal;
		}
</style></head>
<body class="background" style="text-align: center;margin: 0px;background-color: #F5F4EB;">
		<div id="wrap" class="background" style="text-align: center;margin: 0px;background-color: #F5F4EB;">
			<table id="layout" border="0" cellspacing="0" cellpadding="0" width="600" class="layout_background" style="margin: 0px auto;text-align: center;font-family: Georgia;color: #404040;line-height: 160%;font-size: 16px;border-top: 40px solid #F5F4EB;">
				<tr>
					<td id="lead_image" colspan="3">
						<img src="' . get_option('nets_themelogo')  . '">
					</td>
				</tr>
				<tr>
				  <td id="lead_content" colspan="3">
				    <h1 class="primary-heading" style="font-size: 44px;color: #000;font-weight: normal;font-family: Georgia;line-height: 120%;margin: 10px 0;">' . $messheader  . '</h1>
				    <p>' .  $messbody  . '</p>
				  </td>
				</tr>
			<table id="layout" border="0" cellspacing="0" cellpadding="0" width="600" class="layout_background" style="margin: 0px auto;text-align: center;font-family: Georgia;color: #404040;line-height: 160%;font-size: 16px;border-top: 40px solid #F5F4EB;">
				' . $messdetails . '
			</table>
			<table id="layout" border="0" cellspacing="0" cellpadding="0" width="600" class="layout_background" style="margin: 0px auto;text-align: center;font-family: Georgia;color: #404040;line-height: 160%;font-size: 16px;border-top: 40px solid #F5F4EB;">
				<tr>
				
				' .  $showdir . '
			  <tr>
					<td id="footer" colspan="3" class="background" style="background-color: #F5F4EB;border-top: 1px solid #8F8C7D;padding: 20px;font-size: 10px;color: #666;line-height: 100%;font-family: Arial;text-align: center;">
					    <p><div class="vcard">
					    <span class="org fn">' . get_bloginfo('name') . '</span>
					    ' . $streetaddr . '
					    </div></p>						
					    <p>' .  __('Copyright (C) 2011', 'feast') . ' ' . get_bloginfo('name') . ' ' .  __('All rights reserved', 'feast') . '</p>						
					</td>
				</tr>
			</table>
		</div>
		<span style="padding: 0px;"></span>
	</body>
</html>	
	';

	return $output;
}

function lets_make_bookingemail($bookingmail, $bookingtel, $bookinginfo, $bookingnumber, $bookingdate, $bookingname, $mailtype ){

	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	
	 $headers = 'From: '. get_option('blogname') .' <' . get_option('admin_email') . '>';
	
	if ($mailtype == 'bookingcancelled_customer') {
	
		$subject = get_option('nets_s_bookingcancelled');			
		$body = lets_make_newstemplate('bookingcancelled', $bookingmail, $bookingtel, $bookinginfo, $bookingnumber, $bookingdate, $bookingname, 'show');		
	}
	
	if ($mailtype == 'bookingdeclined_customer') {
		$subject = get_option('nets_s_bookingdeclined');			
		$body = lets_make_newstemplate('bookingdeclined', $bookingmail, '', '', '', $bookingdate, $bookingname, 'hide');			
	}
	
	
	if ($mailtype == 'bookingconfirmed_customer') {
	
		$subject = get_option('nets_s_bookingconfirmed');		
		$body = lets_make_newstemplate('bookingconfirmed', $bookingmail, $bookingtel, $bookinginfo, $bookingnumber, $bookingdate, $bookingname, 'show');		
	}
	
	
	if ($mailtype == 'justbooked_customer') {
	
		$subject = get_option('nets_s_newbookingmessc');	
		$body = lets_make_newstemplate('newbookingmessc', $bookingmail, $bookingtel, $bookinginfo, $bookingnumber, $bookingdate, $bookingname, 'show');		
	}
	
	if ($mailtype == 'justbooked_admin') {
	
		$subject = get_option('nets_s_newbookingmessa');
		
		$body = lets_make_newstemplate('newbookingmessa', $bookingmail, $bookingtel, $bookinginfo, $bookingnumber, $bookingdate, $bookingname, 'hide');		
	}
	
	if ($mailtype == 'reminder_customer') {
	
		$subject = get_option('nets_s_bookingreminder');
		
		$body = lets_make_newstemplate('bookingreminder', $bookingmail, '', '', $bookingnumber, $bookingdate, $bookingname, 'show');		
	}
	
	if ($mailtype == 'newssignup') {
	
		$subject = get_option('nets_s_newnewsletter');
		
		$body = lets_make_newstemplate('newnewsletter', $bookingmail, '' , '' , '' , '' , $bookingname, 'hide');

		$bookingmail = get_option('admin_email');
		
	}
	
	if ($mailtype == 'newssignupc') {
	
		$subject = get_option('nets_s_newnewsletterc');
		
		$body = lets_make_newstemplate('newnewsletterc', $bookingmail, '' , '' , '' , '' , $bookingname, 'hide');
	
	}
	
	if ($bookingmail == 'admin') {
	
		$bookingmail = get_option('admin_email');	
	}
	
	
	wp_mail($bookingmail, $subject, $body , $headers);

}


function lets_create_epoch($date,$hour){
	$bookmakedate = $date . ' ' . $hour . ':00 GMT';
	$timdate = strtotime($bookmakedate);
	return $timdate;
}

function lets_make_booking($bookingdate, $bookinghour, $bookingnumber, $bookingname, $bookingtel, $bookingmail, $bookinginfo) {

	$post_id = wp_insert_post( array(
		'post_type' => 'bookings',
		'post_status' => 'publish',
		'comment_status' => 'closed',
		'post_content' => '',
		'post_title' => $bookingname,
		'post_author' => '1'
	) );
	
	
	if (get_option('nets_nbstatus') == 'Confirmed') {
		$bstatus = 'confirmed';
	} elseif (get_option('nets_nbstatus') == 'Unconfirmed') {
		$bstatus = 'unconfirmed';
	} else {
		$bstatus = 'unconfirmed';
	}
	
	$tdate = lets_create_epoch($bookingdate,$bookinghour);
	
	add_post_meta($post_id, 'netlabs_bookingtel', $bookingtel, true);
	add_post_meta($post_id, 'netlabs_bookingemail', $bookingmail, true);
	add_post_meta($post_id, 'netlabs_bookinginfo', $bookinginfo, true); 
	add_post_meta($post_id, 'netlabs_bookingnumber', $bookingnumber, true); 
	add_post_meta($post_id, 'netlabs_bookingdate', $bookingdate, true);
	add_post_meta($post_id, 'netlabs_bookinghour', $bookinghour, true);
	add_post_meta($post_id, 'netlabs_bookingstatus', $bstatus, true);
	
	lets_make_bookingemail($bookingmail, $bookingtel, $bookinginfo, $bookingnumber, $tdate, $bookingname, 'justbooked_customer' );
	lets_make_bookingemail('admin', $bookingtel, $bookinginfo, $bookingnumber, $tdate, $bookingname, 'justbooked_admin' );
}

/******************************************************************
 * check for a valid date
 ******************************************************************/

function nets_is_date( $str )
{
  $stamp = strtotime( $str );
 
  if (!is_numeric($stamp))
  {
     return FALSE;
  }
  $month = date( 'm', $stamp );
  $day   = date( 'd', $stamp );
  $year  = date( 'Y', $stamp );
 
  if (checkdate($month, $day, $year))
  {
     return TRUE;
  }
 
  return FALSE;
} 


/******************************************************************
 * create a calendar for booking form.
 ******************************************************************/

function lets_create_calendar($month,$year) {

	global $wp_locale;

	$today = time();
	$thisday = date('d', $today);
	$thismonth = date('n', $today);
	$thisyear = date('Y', $today);
	$days_in_month = cal_days_in_month(0, $month, $year) ; 

	$first_day = mktime(0,0,0,$month, 1, $year) ;
	
	//compose previous string
	
	$previousstringm = $month - 1;
	$previousstringy = $year;
	
	if ($previousstringm == 0) {
		$previousstringm = 12;
		$previousstringy = $previousstringy - 1;
	}
	
	//compose next string
	
	$nextstringm = $month + 1;
	$nextstringy = $year;
	
	if ($nextstringm == 13) {
		$nextstringm = 1;
		$nextstringy = $nextstringy + 1;
	}
	
	//convert days to numbers

	$title = date_i18n( 'F' , $first_day , false );

	$day_of_week = date('D', $first_day) ;

	switch($day_of_week){ 
 		case "Sun": $blank = 0; break; 
 		case "Mon": $blank = 1; break; 
 		case "Tue": $blank = 2; break; 
 		case "Wed": $blank = 3; break; 
 		case "Thu": $blank = 4; break; 
 		case "Fri": $blank = 5; break; 
 		case "Sat": $blank = 6; break; 
 	}
 	
 	
 	// omit weekdays that cannot be booked
 	
 	$bookingunavail =   array(
                		array('monday' , 2),
                		array('tuesday' , 3),
                		array('wednesday', 4),
                		array('thursday' , 5),
                		array('friday' , 6),
                		array('saturday' , 7),
                		array('sunday' , 1),
    );
 	
 	unset($inavail);
 	$inavail = array();
 	
	for ($i = 0, $j = count($bookingunavail); $i < $j; $i++) {
		$unavailstring = 'nets_bookingunavail' . $bookingunavail[$i][0];
		if (get_option($unavailstring) == 'true') {
			$inavail[] = $bookingunavail[$i][1];
		}
	}
	
	// omit single days that cannot be booked
	
	unset($sunavail);
 	$sunavail = array();
	
	if (get_option('nets_singleunavail')) {
		$bookingslist = explode(';',get_option('nets_singleunavail'));
		foreach ($bookingslist as $bookingsdate){
			$bdates = explode('/' , $bookingsdate);
			if ($bdates[2] == $year && $bdates[0] == $month) {
				$sunavail[] =  $bdates[1];
			}			
		}
	}
	
	
	// clear previous days and bad dates from data
	
	$bookmaxcount = get_option('nets_maxbookings');
	
	if (!$bookmaxcount) { $bookmaxcount = 10000; }
	
		unset($crlist);
 		$crlist = array();
	
		if (get_option('nets_singleunavail')) {
			$listofdates = explode(';',get_option('nets_singleunavail'));
			foreach ($listofdates as $listcleaner){
				if ( nets_is_date($listcleaner) == true) {
					$ldates = explode('/' , $listcleaner);
					$testdate = make_epoch($ldates[1], $ldates[0], $ldates[2], '00:00:01 ' , 'GMT');
					$todays = make_epoch($thisday, $thismonth, $thisyear, '00:00:01 ' , 'GMT');
					if ($testdate >= $todays )	{
						$crlist[] = $ldates[0] . '/' . $ldates[1] . '/' . $ldates[2];
					}	
				}	
			}		
			$listtoupdate = implode(';', $crlist);		
			update_option( 'nets_singleunavail', $listtoupdate );		
		}
	
		// check bookinglimits
	
		unset($bookingscounter);
 		$bookingscounter = array();
 		unset($bookingsfull);
 		$bookingsfull = array();
		for ($i = 1; $i <= ($days_in_month + 1); $i++) {
			$bookingscounter[$i] = 0;
		}
	
		$linkposts = get_posts('numberposts=10000&post_type=bookings');
		foreach($linkposts as $linkentry) :
		$explodmeta = get_post_meta($linkentry->ID, 'netlabs_bookingdate', true);
		$explodcount = get_post_meta($linkentry->ID, 'netlabs_bookingcount', true);
		$datexplod = explode(' ',$explodmeta);
		if ($datexplod[1] == $thismonth && $datexplod[2] == $thisyear) {
			$bookingscounter[$datexplod[0]] = $bookingscounter[$datexplod[0]] + $explodcount;
		}
		endforeach;	
	
		foreach ($bookingscounter as $k => $v) {
			if ($v >= $bookmaxcount) {
				$bookingsfull[] = $k;
			}
		}	
 	
 	$day_count = 1;
 	 	
 	$output =  '<table border=1 width=306><tr>';
 	if ($month == $thismonth && $year == $thisyear) {
 	$output .= '<th class="bheader"></th>';
 	} else {
 	$output .= '<th class="bheader"><span class="prevmonth" rel="' . $previousstringm  .  '/' . $previousstringy . '">&laquo;</span></th>';
 	}
 	$output .= '<th colspan=5 class="bheader">
 				<input type="hidden" name="bookingform-year" class="bookingform-year" value="' . $year . '">
 				<input type="hidden" name="bookingform-month" class="bookingform-month" value="' . $month . '">
 				<input type="hidden" name="bookingform-day" class="bookingform-day" value="">
 				<input type="text" disabled="disabled"  class="bookingform-date" name="bookingform-date" id="bookingform-date" value="' .  $title . ' ' . $year . '" rel="' .  $title . ' ' . $year . '"></th><th class="bheader"><span class="nextmonth" rel="' . $nextstringm  .  '/' . $nextstringy . '">&raquo;</span></tr>
				<tr><td width=43 class="bdayname lightblock1">' .  __('S', 'feast') . '</td><td width=43 class="bdayname lightblock1">' .  __('M', 'feast') . '</td><td 
				width=43 class="bdayname lightblock1">' .  __('T', 'feast') . '</td><td width=43 class="bdayname lightblock1">' .  __('W', 'feast') . '</td><td width=43 class="bdayname lightblock1">' .  __('T', 'feast') . '</td><td 
				width=43 class="bdayname lightblock1">' .  __('F', 'feast') . '</td><td width=43 class="bdayname lightblock1">' .  __('S', 'feast') . '</td></tr><tr>';

 	while ( $blank > 0 ) { 
 		$output .= '<td class="bempty"></td>'; 
 		$blank = $blank-1; 
 		$day_count++;
 	}

 	$day_num = 1;

 	while ( $day_num <= $days_in_month ) { 

 		if ($day_num == $thisday && $month == $thismonth && $year == $thisyear) {
 		$today = 'today';
 		} else {
 		$today = '';
 		}
 		if ($day_num < $thisday && $month == $thismonth && $year == $thisyear || in_array($day_count, $inavail) || in_array($day_num, $sunavail) || in_array($day_num, $bookingsfull)) {
 			$output .= '<td class="bdaychooser"><span class="bundavailable ">' . $day_num . '</span></td>'; 
 		} else {
 			$output .=  '<td class="bdaychooser"><span class="bdavailable ' . $today . '">' . $day_num . '</span></td>'; 
 		}
 		$day_num++; 
 		$day_count++;
 		if ($day_count > 7) {
			$output .= '</tr><tr>';
			$day_count = 1;
 		}
 	} 
 	
 	while ( $day_count >1 && $day_count <=7 ) { 
 		$output .=  '<td class="bempty"> </td>'; 
 		$day_count++; 
	} 

 	$output .=  '</tr></table>'; 
 	
 	return $output;
}

/******************************************************************
 * create a timepicker for booking form.
 ******************************************************************/

function lets_create_timepicker() {

	$starthour = get_option('nets_bookingopens');
	$endhour = get_option('nets_bookingcloses');
	$hourcount = 1;
 	 	
 	$output = '<table border=1 width=306>';
 	$output .=' <tr><td width=43 colspan=7 class="bdayname"><input type="text" disabled="disabled"  class="bookingform-time" name="bookingform-time" id="bookingform-time" value="' .  __('SELECT A TIME', 'feast') . '" rel="SELECT A TIME"></td></tr>';
 	$output .= '<tr><td class="bempty hourholder" colspan=7>' .  __('Hours', 'feast') . '</td></tr>';
 	$output .= '<tr>';
 	while ($starthour <= $endhour) {
 	
 		$output .= '<td class="btimechooser"><span class="btavailable">' . $starthour . '</span></td>';
 		$starthour++;
 		$hourcount++;
 		if ($hourcount > 7) {
			$output .= '</tr><tr>';
			$hourcount = 1;
 		}
 	
 	}
 	$output .=  '</tr></table>'; 
 	
 	echo $output;
}



/******************************************************************
 * bookings management screen
 ******************************************************************/

function lets_make_bookingsman(){

	$output = '';
	unset($bookinglist);
	$bookinglist = array();
	$args=array(
		'post_type'=>'bookings',
		'showposts'=> 10000,
	);
	
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	
	$postid = get_the_ID();
	$pdated = get_post_meta($postid, 'netlabs_bookingdate', true);
	$pdateh = get_post_meta($postid, 'netlabs_bookinghour', true);
	
	
	$pdate = lets_create_epoch($pdated,$pdateh);
	
	
	$bookinglist[] = $pdate;
	
	endwhile;
	else : endif;
	wp_reset_query();
	
	$result = array_unique($bookinglist);	
	sort($result);
	$now = time();
	$tday = date('j F Y', $now);
	$thisday = lets_create_epoch($tday, '00:01');
	$poutout = '';
	$uoutput = '';
	foreach ($result as $datelink) {
	
		if ($datelink >= $thisday) {
			$datel = date_i18n( 'd F Y' , $datelink, true);
			$poutput .= '<a href="#" class="datebutton" rel="' . $datel . '">' . $datel . '</a>';
		} 
	
	}
	
	$output .= '<p class="bookingmanheader">' .  __('Upcomming Bookings', 'feast') . '</p>';
	
	if ($poutput){
		$output .= $poutput;
	} else {
		$output .= '<p>' .  __('No upcomming Bookings', 'feast') . '</p>';
	}
	
	$output .='<div class="clear"></div>';
	
	$output .= '<p class="bookingmanheader">' .  __('Quick links', 'feast') . '</p>';
	
	$output .= '<a href="#" class="datebutton" rel="Yesterday">' .  __('Yesterday', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="Today">' .  __('Today', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="Tommorrow">' .  __('Tommorrow', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="Last Week">' .  __('Last Week', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="This Week">' .  __('This Week', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="Next Week">' .  __('Next Week', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="Last Month">' .  __('Last Month', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="This Month">' .  __('This Month', 'feast') . '</a>';
	$output .= '<a href="#" class="datebutton" rel="Next Month">' .  __('Next Month', 'feast') . '</a>';
	$output .='<div class="clear"></div>';
	
	$output .='<div class="clear"></div>';

	return $output;
	
}


function lets_make_bookingbox($apostid) {

	global $wp_locale;	

	$apdated = get_post_meta($apostid, 'netlabs_bookingdate', true);
	$apdateh = get_post_meta($apostid, 'netlabs_bookinghour', true);
	$apdate = lets_create_epoch($apdated,$apdateh);
	$apstatus = get_post_meta($apostid, 'netlabs_bookingstatus', true);
	$aptel = get_post_meta($apostid, 'netlabs_bookingtel', true);
	$apmail = get_post_meta($apostid, 'netlabs_bookingemail', true);
	$apinfo = get_post_meta($apostid, 'netlabs_bookinginfo', true);
	$apgno = get_post_meta($apostid, 'netlabs_bookingnumber', true);
	$aoutput = '';
		
	if ($apstatus == 'unconfirmed') {
		$aoutput .=  '<span class="bookstatus orange">' . $apstatus . '</span><span class="loader">&nbsp;</span>';
	} elseif ($apstatus == 'confirmed') {
		$aoutput .=  '<span class="bookstatus green">' . $apstatus . '</span><span class="loader">&nbsp;</span>';
	} elseif ($apstatus == 'cancelled') {
		$aoutput .=  '<span class="bookstatus red">' . $apstatus . '</span><span class="loader">&nbsp;</span>';
	}
	$aoutput .= 	'<span class="bookdatebox"><span class="daybox">'  . date_i18n( 'd ' , $apdate, true) .  '</span><span class="monthbox">'  . date_i18n( 'M' , $apdate, true) .  ' <span class="yearbox">'  . date_i18n( 'Y' , $apdate, true) .  '</span></span><span class="guestno">' . $apgno . '</span></span><span class="bookinghour">'  . date_i18n( 'G:i' , $apdate, true) .  '</span><br class="clear"></p>
				<p class="bookinfoline"><span class="infoline1">' . get_the_title($apostid) . '</span><span class="infoline1 infolinemid">' . $aptel . '</span><span class="infoline1 infolinelast">' . $apmail . '</span><br class="clear" /><span class="infoline1 infolinedesc">' . $apinfo . '</span></p>';

	if ($apstatus =='unconfirmed') {
		$aoutput .=  '<p class="bookingconfirmation"><a href="'.get_edit_post_link( $apostid ) .'" class="bookaction bleft bedit" rel="' .  $apostid  . '">Edit Booking</a><span class="bookaction bdelete bleft" rel="' .  $apostid  . '">delete Booking</span><span class="bookaction spacer bcancel" rel="' .  $apostid  . '">Decline Booking</span><span class="bookaction spacer bconfirm" rel="' .  $apostid  . '">Confirm Booking</span><div class="clear"></div></p>';
	} elseif ($apstatus =='confirmed') {
		$aoutput .=  '<p class="bookingconfirmation"><a href="'.get_edit_post_link( $apostid ) .'" class="bookaction bleft bedit" rel="' .  $apostid  . '">Edit Booking</a><span class="bookaction bdelete bleft" rel="' .  $apostid  . '">delete Booking</span><span class="bookaction spacer bcancel" rel="' .  $apostid  . '">Cancel Booking</span><div class="clear"></div></p>';
	} elseif ($apstatus =='cancelled') {
		$aoutput .=  '<p class="bookingconfirmation"><a href="'.get_edit_post_link( $apostid ) .'" class="bookaction bleft bedit" rel="' .  $apostid  . '">Edit Booking</a><span class="bookaction bdelete bleft" rel="' .  $apostid  . '">delete Booking</span><span class="bookaction spacer breinst" rel="' .  $apostid  . '">Reinstate Booking</span><div class="clear"></div></p>';
	}
	
	return $aoutput;
	
}



function lets_list_bookings($timespace){

	$now = time();
	$oneday = 86400;
	$oneweek = $oneday * 7;
	$givenday = date('w', $now);
	$multiplier = $givenday * $oneday;
	$todayepoch = date('j F Y', $now);
	$thisdayepoch = lets_create_epoch($todayepoch, '00:01');

	if ($timespace == 'Yesterday') {
		$startdate = $thisdayepoch - $oneday;
		$enddate = $thisdayepoch;
	
	} elseif ($timespace == 'Today') {
		$startdate = $thisdayepoch;
		$enddate = $thisdayepoch + $oneday;	
	} elseif ($timespace == 'Tommorrow') {
		$startdate = $thisdayepoch + $oneday;
		$enddate = $thisdayepoch + ($oneday * 2);	
	} elseif ($timespace == 'Last Week') {
		$startdate = $thisdayepoch - $multiplier - $oneweek;
		$enddate = $startdate + $oneweek;	
	} elseif ($timespace == 'This Week') {
		$startdate = $thisdayepoch - $multiplier;
		$enddate = $startdate + $oneweek;	
	} elseif ($timespace == 'Next Week') {
		$startdate = $thisdayepoch - $multiplier + $oneweek;
		$enddate = $startdate + $oneweek;	
	} elseif ($timespace == 'Last Month') {
		$prvmonth = date('m', $now) - 1;
		$pyear = date('Y', $now);
		if ($prvmonth == 0) {
			$prvmonth = 12;
			$pyear = $pyear - 1;
		}
		$ptry = '1 ' . monthconvert($prvmonth) . ' ' . $pyear;
		$startdate = lets_create_epoch($ptry, '00:01');	
		$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $prvmonth, $pyear);	
		$ptry = $daysinmonth . ' ' . monthconvert($prvmonth) . ' ' . $pyear;
		$enddate = lets_create_epoch($ptry, '23:59');
	} elseif ($timespace == 'Next Month') {
		$nxtmonth = date('n', $now) + 1;
		$nyear = date('Y', $now);
		if ($nxtmonth == 13) {
			$nxtmonth = 1;
			$nyear = $nyear + 1;
		}
		$ptry = '1 ' . monthconvert($nxtmonth) . ' ' . $nyear;
		$startdate = lets_create_epoch($ptry, '00:01');	
		$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $nxtmonth, $nyear);
		$ptry = $daysinmonth . ' ' . monthconvert($nxtmonth) . ' ' . $nyear;	
		$enddate = lets_create_epoch($ptry, '23:59');
	} elseif ($timespace == 'This Month') {
		$mtry = date('n', $now);
		$prty = '1 ' . monthconvert($mtry) . ' ' . date('Y', $now);
		$startdate = lets_create_epoch($prty, '00:01');	
		$daysinmonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
		$ptry = $daysinmonth . ' '	. monthconvert($mtry) . ' ' . date('Y', $now);
		$enddate = lets_create_epoch($ptry, '23:59');
	} 
	
	$output = '';
	unset($bookinglists);
	$bookinglists = array();
	$args=array(
		'post_type'=>'bookings',
		'showposts'=> 10000,
		'meta_key' => 'netlabs_bookingdate',
		'orderby' => 'meta_value',
		'order' => 'ASC'
	);
	echo '<p class="flright"><a href="#" class="goback">' .  __('Back', 'feast') . '</a></p><div class="clear"></div>';
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	
	$postid = get_the_ID();
	$pdated = get_post_meta($postid, 'netlabs_bookingdate', true);
	$pdateh = get_post_meta($postid, 'netlabs_bookinghour', true);
	
	$pdate = lets_create_epoch($pdated,$pdateh);
	
	
	if ($pdate >= $startdate && $pdate <= $enddate) {
		$bookingslists[] = array('date' =>$pdate, 'id' => $postid);		
	}
	
	
	endwhile;
	else : endif;
	wp_reset_query();
	
	if ($bookingslists) {
		
	$bookingslists = subval_sort($bookingslists,'date'); 
	
	foreach ($bookingslists as $bbslist) {
	
	$output .=  '<div class="bookingmanbox"><p>';
	$output .= lets_make_bookingbox($bbslist[id]);
	$output .=  '</div>';
	
	}
	}
	
	
	if ($output) {
		echo $output;
	} else {
		echo '<p>' .  __('No entries', 'feast') . '</p>';
	}	
}

function lets_update_booking($mpostid, $action, $sendamail) {

	if ($action == 'confirm' || $action == 'reinstate') {
		update_post_meta($mpostid, 'netlabs_bookingstatus', 'confirmed');
		$oput = lets_make_bookingbox($mpostid);
		$maildated = get_post_meta($mpostid, 'netlabs_bookingdate', true);
		$maildateh = get_post_meta($mpostid, 'netlabs_bookinghour', true);
		$maildate = lets_create_epoch($maildated,$maildateh);
		$mailtel = get_post_meta($mpostid, 'netlabs_bookingtel', true);
		$mailmail = get_post_meta($mpostid, 'netlabs_bookingemail', true);
		$mailinfo = get_post_meta($mpostid, 'netlabs_bookinginfo', true);
		$mailno = get_post_meta($pomstid, 'netlabs_bookingnumber', true);
		$mailname = get_the_title($mpostid);
		if ($sendamail == 'yes'){
			lets_make_bookingemail($mailmail, $mailtel, $mailinfo, $mailno, $maildate, $mailname, 'bookingconfirmed_customer' );
		}
	} elseif ($action == 'cancel') {
		update_post_meta($mpostid, 'netlabs_bookingstatus', 'cancelled');
		$oput = lets_make_bookingbox($mpostid);
		$maildated = get_post_meta($mpostid, 'netlabs_bookingdate', true);
		$maildateh = get_post_meta($mpostid, 'netlabs_bookinghour', true);
		$maildate = lets_create_epoch($maildated,$maildateh);
		$mailtel = get_post_meta($mpostid, 'netlabs_bookingtel', true);
		$mailmail = get_post_meta($mpostid, 'netlabs_bookingemail', true);
		$mailinfo = get_post_meta($mpostid, 'netlabs_bookinginfo', true);
		$mailno = get_post_meta($pomstid, 'netlabs_bookingnumber', true);
		$mailname = get_the_title($mpostid);
		if ($sendamail == 'yes'){
			lets_make_bookingemail($mailmail, $mailtel, $mailinfo, $mailno, $maildate, $mailname, 'bookingcancelled_customer' );
		}
	} elseif ($action == 'decline') {
		update_post_meta($mpostid, 'netlabs_bookingstatus', 'declined');
		$oput = lets_make_bookingbox($mpostid);
		$maildated = get_post_meta($mpostid, 'netlabs_bookingdate', true);
		$maildateh = get_post_meta($mpostid, 'netlabs_bookinghour', true);
		$maildate = lets_create_epoch($maildated,$maildateh);
		$mailtel = get_post_meta($mpostid, 'netlabs_bookingtel', true);
		$mailmail = get_post_meta($mpostid, 'netlabs_bookingemail', true);
		$mailinfo = get_post_meta($mpostid, 'netlabs_bookinginfo', true);
		$mailno = get_post_meta($pomstid, 'netlabs_bookingnumber', true);
		$mailname = get_the_title($mpostid);
		if ($sendamail == 'yes'){
			lets_make_bookingemail($mailmail, $mailtel, $mailinfo, $mailno, $maildate, $mailname, 'bookingdeclined_customer' );
		}
	} 	
	echo $oput;	
}

function lets_delete_booking($tobedeleted) {
		wp_delete_post($tobedeleted);
}

function lets_create_reminders() {
	if (get_option('nets_nbreminder') == 'True') {
		$today  = time();
		$singleday = 86400;
		$target = $today - ($singleday * 2);
	
		$args=array(
			'post_type'=>'bookings',
			'showposts'=> 10000
		);
		$my_query = new WP_Query($args);
		if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	
			$remid = get_the_ID();
			$remdated = get_post_meta($remid, 'netlabs_bookingdate', true);
			$remdateh = get_post_meta($remid, 'netlabs_bookinghour', true);
			$remdate = lets_create_epoch($remdated,$remdateh);
			if ($remdate >= $target && $remdate <= $today) {
				$remsend = get_post_meta($remid, 'netlabs_remid', true);
				if (!$remsend) {
					update_post_meta($remid, 'netlabs_remid', 'sent');
					$remmail = get_post_meta($remid, 'netlabs_bookingemail', true);
					$remno = get_post_meta($remid, 'netlabs_bookingnumber', true);
					$remname = get_the_title();
					lets_make_bookingemail($remmail, '', '', $remno, $remdate, $remname, 'reminder_customer' );
				}
			}
	
		endwhile;
		else : endif;
		wp_reset_query();	
	}	
}


add_action('60min_reminder_check', 'lets_create_reminders');

function lets_do_check() {
	if ( !wp_next_scheduled( '60min_reminder_check' ) ) {
		wp_schedule_event(time(), 'hourly', '60min_reminder_check');
	}
}
add_action('wp', 'lets_do_check');


function get_slideshow() {
?>
	
	<?php query_posts( array( 'post_type' => 'slideshows', 'showposts' => -1, ) );
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$active = '';
	$numbers = get_the_ID();
	$active = get_post_meta($numbers, 'netlabs_activate', true);
	$linkto = '';
	$slidedesc = get_post_meta($numbers, 'netlabs_slidedesc', true);
	$thispost = '';
	$thispost = get_post_meta($numbers, 'netlabs_linkpost', true);
	$mine = get_the_post_thumbnail($numbers, 'slider');
	preg_match_all('/<img [^>]*src=["|\']([^"|\']+)/i', $mine, $matches);
	foreach ($matches[1] as $key=>$value) {$src =  $value;}
	if ($thispost != 'nothing'){
	$thislink = get_permalink($thispost);
	} else {
	$thislink = "#";
	}
	if ($active) {
	?>	
			<div class="stripcontent" rel="<?php echo $src; ?>" alt="#l<?php echo $numbers; ?>">
			<?php echo get_the_post_thumbnail($numbers, 'thumbnail') ?>
			</div>			
						
	<?php 
	}
	endwhile;
	else :
	endif;
	wp_reset_query();?>
		
<?php 


}

function get_fslideshow() {

	$tagbg = '';
	$tagbg = get_option('nets_taglinebg');
	
	query_posts( array( 'post_type' => 'slideshows', 'showposts' => -1, ) );
	echo '<ul>';
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	$numbers = get_the_ID(); 
	$slidetitle = get_post_meta($numbers, 'netlabs_slidetitle', true);
	$slidedesc = get_post_meta($numbers, 'netlabs_slidedesc', true);
	$thispost = get_post_meta($numbers, 'netlabs_linkpost', true);
	echo '<li>';
	echo get_the_post_thumbnail($post->ID, 'fslide');
	echo '<div class="tagline ' .  $tagbg  . '">';
	if ($slidetitle) {
		echo '<h3>' . $slidetitle . '</h3><div class="clear"></div>';
	 }
	if ($slidedesc) {
		echo '<p>' . html_entity_decode($slidedesc) . '</p>';
	}
	if ($thispost) {
	?>
		<p class="thislink" ><a href="<?php echo get_permalink($thispost); ?>" class="smallfont"><?php _e( 'More', 'feast' ); ?><br/><?php _e( 'Info', 'feast' ); ?></a></p>
	<?php 
	}
	echo '</div></li>';
	endwhile;
	else :
	endif;
	echo '</ul>';
	wp_reset_query();?>
		
<?php 


}

function get_tagstrips() {
?>
	<?php query_posts( array( 'post_type' => 'slideshows', 'showposts' => -1, ) );
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	
	
	$active = '';
	$numbers = get_the_ID();
	$active = get_post_meta($numbers, 'netlabs_activate', true);
	$linkto = '';
	$slidetitle = get_post_meta($numbers, 'netlabs_slidetitle', true);
	$slidedesc = get_post_meta($numbers, 'netlabs_slidedesc', true);
	$thispost = '';
	$thispost = get_post_meta($numbers, 'netlabs_linkpost', true);
	$thisdesc = '';
	$thisdesc = get_post_meta($numbers, 'netlabs_slinktag', true);
	$tagbg = '';
	$tagbg = get_option('nets_taglinebg');
	?>
	
	
	<?php if ($active){ ?>
		<?php if ($slidetitle || $slidedesc || $thispost) {?>
	<div id="l<?php echo $numbers; ?>" class="tagcontent <?php echo $tagbg; ?>">
		<?php if ($slidetitle) {?>
		<h2 class="vfont"><?php echo $slidetitle; ?></h2>
		<div class="clear"></div>
		<?php } ?>
		<?php if ($slidedesc) {?>
		<p><?php echo html_entity_decode($slidedesc); ?></p>
		<?php } ?>
		<?php if ($thispost && $thispost != 'nothing') {?>
		<p class="thislink" ><a href="<?php echo get_permalink($thispost); ?>" class="smallfont"><?php _e( 'More', 'feast' ); ?><br/><?php _e( 'Info', 'feast' ); ?></a></p>
		<?php } ?>
	</div>
	<?php } } ?>
	
	<?php endwhile;
	else :
	endif;
	wp_reset_query();?>


<?php 
}

?>