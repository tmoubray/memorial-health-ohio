
<?php
/*Home Schedule band */
global $region_id;
?>

<?php 
////India starts
if (in_array(2,$region_id)) {
	/* Current time */
	//date_default_timezone_set('Asia/Kolkata');
	$date_time = new DateTime('now', new DateTimeZone('UTC'));
    $date_time->setTimezone(new DateTimeZone('Asia/Kolkata'));
    $cur_time = $date_time->format('h:i a');
    
	/*Current week*/
	$d = strtotime("today");
	$start_week = strtotime("last sunday midnight",$d);
	$end_week = strtotime("next monday midnight",$d);
	$start_current = date("j F Y",$start_week); 
	$end_current = date("j F Y",$end_week);
	$date_from = strtotime($start_current);
	$date_to = strtotime($end_current);
	$week_dates = list_days($date_from,$date_to);

	//$cur_time = current_time('H:i:s');
	//$cur_time = date("h:i:s a");
	//$cur_time = strtotime($cur_time);
	$today = date('D');
	$today = strtolower($today);
	/* Current time */
	
	if( have_rows('schedule_india', 'option') ):
		$showidarray = array();
	    $nextshowarray = array();
	    $currentdayshow_array = array();
	    $i = 0;
        while ( have_rows('schedule_india','option') ) : the_row();

	        // display a sub field value
	        $show_id = get_sub_field('show_name');
	        $start_time = strtotime(get_sub_field('start_time'));
	        $end_time = strtotime(get_sub_field('end_time'));
	        $show_status = get_sub_field('show_status');					      
	        $day = get_sub_field('show_day');
	        $show_date = get_sub_field('show_date');
	        
	        if($date_time->format('d/m/Y') == $show_date) {
	           $currentdayshow_array[$day][$start_time]['show_id'] = $show_id;
	           $currentdayshow_array[$day][$start_time]['start_time'] =  $start_time;
	           $currentdayshow_array[$day][$start_time]['end_time'] =  $end_time;	
	           $currentdayshow_array[$day][$start_time]['show_status'] =  $show_status;
	           $currentdayshow_array[$day][$start_time]['show_day'] =  $day;
	           $currentdayshow_array[$day][$start_time]['show_date'] =  $show_date;
	        }
	         
        endwhile;
	endif;					

} //India end US starts
else if(in_array(3,$region_id)) {	
	/* Current time */
	//date_default_timezone_set('America/New_York');
	$date_time = new DateTime('now', new DateTimeZone('UTC'));
    $date_time->setTimezone(new DateTimeZone('America/New_York'));
    $cur_time = $date_time->format('h:i a');

	/*Current week*/
	$d = strtotime("today");
	$start_week = strtotime("last sunday midnight",$d);
	$end_week = strtotime("next monday midnight",$d);
	$start_current = date("j F Y",$start_week); 
	$end_current = date("j F Y",$end_week);
	$date_from = strtotime($start_current);
	$date_to = strtotime($end_current);
	$week_dates = list_days($date_from,$date_to);


	//$cur_time = current_time('H:i:s');
	//$cur_time = date("h:i:s a");
	//$cur_time = strtotime($cur_time);
	$today = date('D');
	$today = strtolower($today);
	/* Current time */
	
	if( have_rows('shedule_usa', 'option') ):
		$showidarray = array();
	    $nextshowarray = array();
	    $currentdayshow_array = array();
	    $i = 0;
        while ( have_rows('shedule_usa','option') ) : the_row();

	        // display a sub field value
	        $show_id = get_sub_field('show_name_usa');
	        $start_time = strtotime(get_sub_field('start_time_usa'));
	        $end_time = strtotime(get_sub_field('end_time_usa'));
	        $show_status = get_sub_field('show_status_usa');					      
	        $day = get_sub_field('show_day_usa');
	        $show_date = get_sub_field('show_date_usa');	

	       	if($date_time->format('d/m/Y') == $show_date) { 
	           $currentdayshow_array[$day][$start_time]['show_id'] = $show_id;
	           $currentdayshow_array[$day][$start_time]['start_time'] =  $start_time;
	           $currentdayshow_array[$day][$start_time]['end_time'] =  $end_time;	
	           $currentdayshow_array[$day][$start_time]['show_status'] =  $show_status;
	           $currentdayshow_array[$day][$start_time]['show_day'] =  $day;
	           $currentdayshow_array[$day][$start_time]['show_date'] =  $show_date;
	       }
	       
	    endwhile;
	endif;										

} //USA ends UK starts
else if(in_array(4,$region_id)) {

	/* Current time */
	//date_default_timezone_set('Europe/London');
	$date_time = new DateTime('now', new DateTimeZone('UTC'));
    $date_time->setTimezone(new DateTimeZone('Europe/London'));
    $cur_time = $date_time->format('h:i a');

	/*Current week*/
	$d = strtotime("today");
	$start_week = strtotime("last sunday midnight",$d);
	$end_week = strtotime("next monday midnight",$d);
	$start_current = date("j F Y",$start_week); 
	$end_current = date("j F Y",$end_week);
	$date_from = strtotime($start_current);
	$date_to = strtotime($end_current);
	$week_dates = list_days($date_from,$date_to);

	//$cur_time = current_time('H:i:s');
	//$cur_time = date("h:i:s a");
	//$cur_time = strtotime($cur_time);
	$today = date('D');
	$today = strtolower($today);
	/* Current time */
	
	if( have_rows('schedule_uk', 'option') ):
		$showidarray = array();
	    $nextshowarray = array();
	    $currentdayshow_array = array();
	    $i = 0;
        while ( have_rows('schedule_uk','option') ) : the_row();

	        // display a sub field value
	        $show_id = get_sub_field('show_name_uk');
	        $start_time = strtotime(get_sub_field('start_time_uk'));
	        $end_time = strtotime(get_sub_field('end_time_uk'));
	        $show_status = get_sub_field('show_status_uk');					      
	        $day = get_sub_field('show_day_uk');
	        $show_date = get_sub_field('show_date_uk');				        
	        
	        if($date_time->format('d/m/Y') == $show_date) {
	           $currentdayshow_array[$day][$start_time]['show_id'] = $show_id;
	           $currentdayshow_array[$day][$start_time]['start_time'] =  $start_time;
	           $currentdayshow_array[$day][$start_time]['end_time'] =  $end_time;	
	           $currentdayshow_array[$day][$start_time]['show_status'] =  $show_status;
	           $currentdayshow_array[$day][$start_time]['show_day'] =  $day;
	           $currentdayshow_array[$day][$start_time]['show_date'] =  $show_date;
	       }
	       
	    endwhile;
	endif;
	
} //UK end MENA starts
elseif(in_array(5,$region_id)){
	/* Current time */
	//date_default_timezone_set('Asia/Riyadh');
	$date_time = new DateTime('now', new DateTimeZone('UTC'));
    $date_time->setTimezone(new DateTimeZone('Asia/Riyadh'));
    $cur_time = $date_time->format('h:i a');

	/*Current week*/
	$d = strtotime("today");
	$start_week = strtotime("last sunday midnight",$d);
	$end_week = strtotime("next monday midnight",$d);
	$start_current = date("j F Y",$start_week); 
	$end_current = date("j F Y",$end_week);
	$date_from = strtotime($start_current);
	$date_to = strtotime($end_current);
	$week_dates = list_days($date_from,$date_to);

	//$cur_time = current_time('H:i:s');
	//$cur_time = date("h:i:s a");
	//$cur_time = strtotime($cur_time);
	$today = date('D');
	$today = strtolower($today);
	/* Current time */
	
	if( have_rows('schedule_mena', 'option') ):
		$showidarray = array();
	    $nextshowarray = array();
	    $currentdayshow_array = array();
	    $i = 0;
        while ( have_rows('schedule_mena','option') ) : the_row();

	        // display a sub field value
	        $show_id = get_sub_field('show_name_mena');
	        $start_time = strtotime(get_sub_field('start_time_mena'));
	        $end_time = strtotime(get_sub_field('end_time_mena'));
	        $show_status = get_sub_field('show_status_mena');					      
	        $day = get_sub_field('show_day_mena');
	        $show_date = get_sub_field('show_date_mena');				        
	        
	        if($date_time->format('d/m/Y') == $show_date) {
	           $currentdayshow_array[$day][$start_time]['show_id'] = $show_id;
	           $currentdayshow_array[$day][$start_time]['start_time'] =  $start_time;
	           $currentdayshow_array[$day][$start_time]['end_time'] =  $end_time;	
	           $currentdayshow_array[$day][$start_time]['show_status'] =  $show_status;
	           $currentdayshow_array[$day][$start_time]['show_day'] =  $day;
	           $currentdayshow_array[$day][$start_time]['show_date'] =  $show_date;
	       }
	       
	    endwhile;
	endif;

} //MENA End
elseif(in_array(6, $region_id)){
	/* Current time */
	//date_default_timezone_set('Pacific/Auckland');
	$date_time = new DateTime('now', new DateTimeZone('UTC'));
    $date_time->setTimezone(new DateTimeZone('Pacific/Auckland'));
    $cur_time = $date_time->format('h:i a');

	/*Current week*/
	$d = strtotime("today");
	$start_week = strtotime("last sunday midnight",$d);
	$end_week = strtotime("next monday midnight",$d);
	$start_current = date("j F Y",$start_week); 
	$end_current = date("j F Y",$end_week);
	$date_from = strtotime($start_current);
	$date_to = strtotime($end_current);
	$week_dates = list_days($date_from,$date_to);

	//$cur_time = current_time('H:i:s');
	//$cur_time = date("h:i:s a");
	//$cur_time = strtotime($cur_time);
	$today = date('D');
	$today = strtolower($today);
	/* Current time */
	
	if( have_rows('schedule_ap', 'option') ):
		$showidarray = array();
	    $nextshowarray = array();
	    $currentdayshow_array = array();
	    $i = 0;
        while ( have_rows('schedule_ap','option') ) : the_row();

	        // display a sub field value
	        $show_id = get_sub_field('show_name_ap');
	        $start_time = strtotime(get_sub_field('start_time_ap'));
	        $end_time = strtotime(get_sub_field('end_time_ap'));
	        $show_status = get_sub_field('show_status_ap');					      
	        $day = get_sub_field('show_day_ap');
	        $show_date = get_sub_field('show_date_ap');				        
	        
	        if($date_time->format('d/m/Y') == $show_date) {
	           $currentdayshow_array[$day][$start_time]['show_id'] = $show_id;
	           $currentdayshow_array[$day][$start_time]['start_time'] =  $start_time;
	           $currentdayshow_array[$day][$start_time]['end_time'] =  $end_time;	
	           $currentdayshow_array[$day][$start_time]['show_status'] =  $show_status;
	           $currentdayshow_array[$day][$start_time]['show_day'] =  $day;
	           $currentdayshow_array[$day][$start_time]['show_date'] =  $show_date;
	       }
	       
	    endwhile;
	endif;
}//AP
else{

}

// sort current show array
$final_array = array();                    
foreach($currentdayshow_array as $day_key =>$day_data){                
	$sort_array = array();
	foreach($day_data as $key => $value){
		$sort_array[] = $key;
	}
	sort($sort_array);	
	foreach ($sort_array as $fkey => $fvalue) {
		$final_array[$day_key][] = $day_data[$fvalue];							
	}						
} 
?>
<?php if(!empty($currentdayshow_array)) {?>
<section class="home-schedule-section">
		<div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading-left text-uppercase">
                     	<h2><span> Schedule </span> </h2>
                    </div>

                   	<div class="schedule-home-slider swiper-container">
						<div class="swiper-wrapper">	
						<?php 
						if(!empty($currentdayshow_array)){
					        foreach ($final_array as $keys => $currentdayshow_array) {			    	
					        	foreach($currentdayshow_array as $currentday_postid => $currentday_time) {
							        $show_id = $currentday_time['show_id'];
							        $current_show_date = $currentday_time['show_date'];
							        $current_date = date('d/m/Y');
									$stime = date('h:i a',$currentday_time['start_time']);
									$etime = date('h:i a',$currentday_time['end_time']);
									$currday_show_status = $currentday_time['show_status'];
									$show_day = $currentday_time['show_day'];
/*
									if(has_post_thumbnail($show_id)){
										$imagearr = wp_get_attachment_image_src( get_post_thumbnail_id( $show_id ), array(162,108) );
									}
									if(isset($imagearr)){
										$imageurl  = $imagearr[0];
									}
									else{
										$imageurl  = get_template_directory_uri().'/images/single-post-placeholder.jpg';
									}*/

									if(has_post_thumbnail($show_id)){
										$attachment_src = wp_get_attachment_image_src( get_post_thumbnail_id( $show_id ), 'small-box');
										if(isset($attachment_src)){
											$imageurl  = $attachment_src[0];
										}else{
											$imageurl  = 'https://via.placeholder.com/367x207?text='.get_the_title($show_id).'';
										}
									}
									else{
										$imageurl = 'https://via.placeholder.com/367x207?text='.get_the_title($show_id).'';
									}


								    if($currday_show_status == "regular" && $current_date == $current_show_date) {									    
										if( isset( $stime ) && isset( $etime ) ){
											$time = $stime.' - '.$etime;
										}
										
										$cur_time_date1 = DateTime::createFromFormat('H:i a', $cur_time);
										$stime_date2 = DateTime::createFromFormat('H:i a', $stime);
										$etime_date3 = DateTime::createFromFormat('H:i a', $etime);

										$offset = 19800;
                                        $ustime = date('h:i a', strtotime($stime) - $offset);
                                        $uetime = date('h:i a', strtotime($etime) - $offset);

                                        $modifydate = str_replace('/', '-', $current_date);
                                        $cdate = date('Y-m-d',strtotime($modifydate));

										$gcstart = date("Ymd\\THi00\\Z", strtotime($cdate.' '.$ustime));
                                    	$gcend   = date("Ymd\\THi00\\Z", strtotime($cdate.' '.$uetime));
										$url = "https://www.google.com/calendar/event?action=TEMPLATE&text=".get_the_title($show_id)."&dates=$gcstart/$gcend&details=".get_the_title($show_id)."&location=''&trp=false&sprop=&sprop=name:";

										?>						
							<div class="swiper-slide">
								<div class="schedule-home">
								   	<div class="thumbpic"> 
								   		<a href="<?php echo $url;?>" target="_blank"><img src="<?php echo $imageurl; ?>" alt="<?php echo get_the_title($show_id);?>"></a>
								   	</div>
								   	<div class="sbox">
								   		<div class="sbox-inner">
								   			<span class="title">
								   				<a href="<?php echo $url;?>" target="_blank">  <?php echo get_the_title($show_id);?>  </a>
								   			</span>
								   			<span class="schedule-date"> <a href="<?php echo $url?>" target="_blank"> <?php echo $time;?> </a> </span>
								   		</div>
								   	</div>
								</div>
							</div>
							<?php
									      	}
								     	}	
				                    }   
									
								}
							?>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
							</div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
						</div>

                </div>
            </div>
        </div>
	</section>
<?php } ?>
	