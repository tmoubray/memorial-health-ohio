<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */


$related_location = get_field('related_location');
if ($related_location) : 
$class_location = get_field('mapped_location', $related_location->ID, false);
$contact_information = get_field('contact_information', $related_location->ID, true);
$ci = str_replace("Entrance","",$contact_information['street_address']);
$ci = str_replace("<br>","",$ci);

endif;
$class_name = get_field('name');
$description = get_field('description');
$date = get_field('date');
$cost = get_field('cost');
$class_times = get_field('class_times');
$today = date('Ymd');

$call_to_schedule = get_field('call_to_schedule');

$args = array(
	'post_type' => 'classes_events',
	'post_status' => 'publish',
	'orderby' => 'title',
	'order' => 'ASC',
	'post__not_in' => array(
		get_the_id()
	),
	'posts_per_page' => -1,
	'meta_query' => array(
		array(
			'key' => 'name',
			'value' => $class_name,
			'compare' => '=',
			'order' => 'ASC'
		) ,
		array(
            'key' => 'date',
            'value' => $today,
            'compare' => '>',
        )
	) ,
);
$alts = new WP_Query($args);

$alt_classes = $alts->posts;



get_header();


?>
<div id="content" class="site-content">
	<?php  custom_breadcrumbs(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="classes-events-modal">
				<div class="container-fluid class-container" id="class-time-select">
					<div class="row class-row">
						<div class="col-lg-6">
							<div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button" style="line-height: 32px;">
								<span class="share-text">Share</span>
								<a class="a2a_dd" href="https://www.addtoany.com/share#url=https%3A%2F%2Fmemorialohio.com%2Fclasses-events%2F&amp;title=Classes%20%26%20Events%20-%20Memorial%20Health">
									<img src="https://memorialohio.com/wp-content/themes/memorial_health/inc/assets/images/share.svg" border="0" alt="Share" width="50" height="50">
								</a>
								<div style="clear: both;"></div></div>
								<h2 id="modal-class-name"><?php the_title() ?></h2>
								<div style="font-size:18px;"><?php echo $description ?></div>
								<hr>
								<ul class="modal-class-details">
									<li><img class="icon-calendar" src="https://memorialohio.com/wp-content/themes/memorial_health/inc/assets/images/class-calendar.svg"><span id="class-date"><?php echo $date ?></span></li>

									<li><img class="icon-cost" src="https://memorialohio.com/wp-content/themes/memorial_health/inc/assets/images/class-cost.svg"><span id="class-cost"><?php echo ($cost == '0') ? 'FREE' : $cost; ?></span></li>
									

									<?php if ($related_location) :?>
									<li><img class="icon-location" src="https://memorialohio.com/wp-content/themes/memorial_health/inc/assets/images/class-location.svg"><span id="class-location"><?php echo $related_location->location_name . ' ' . $contact_information['street_address'];?></span></li>
									<?php endif?>

									<li class="icon-time-main"><img class="icon-time" src="https://memorialohio.com/wp-content/themes/memorial_health/inc/assets/images/class-time.svg"><span id="class-times"><span class="select-at-time">Time(s):

									


									</span>

									<div style="color:#ef7521;display:flex;padding:0 10px;flex: 1;flex-direction: column;align-items:left;">
									<?php 
									if( have_rows('class_times') ):
									    while( have_rows('class_times') ) : the_row();
									    	$start_time = get_sub_field('start_time');
									        $end_time = get_sub_field('end_time');
									        $schedule_url = get_sub_field('appointy_link');
									        
									     ?>
									     <div style="cursor:pointer;" alt="schedule" class="class-time-selector" data-schedule="<?php echo $schedule_url ?>"><?php echo $start_time . ' - ' . $end_time; ?>
									     </div>
									 <?php
									    endwhile;
									endif;
									?>
									
									</div>



								
									</span></li>
									

								</ul>
							</div>

							<?php if ($related_location) : ?>
							<div class="col-6" id="map-container">
								<div>
									<div class="acf-map-modal" data-zoom="16">

										<iframe
										width="450"
										height="250"
										frameborder="0" style="border:0"
										referrerpolicy="no-referrer-when-downgrade"
										src="<?php echo 'https://maps.google.com/maps?q=' . $ci .  '&z=17&output=embed'?>"
										allowfullscreen>
									</iframe>




								</div>
							</div>
							<a target="_blank" href="https://www.google.com/maps/dir//<?php echo $ci;  ?>" id="directions">Get Directions</a>
						</div>
						<?php endif;?>


						<?php if ($call_to_schedule):?>

							<div class="col-12">
								<i>Call to Schedule.</i>
							</div>

						<?php else:?>


							<?php if ($schedule_url) : ?>
							<div class="col-12">
								<a href="<?php echo $schedule_url ?>" target="_blank" class="t-selector" id="time-select" >Click here to register</a>
							</div>
							<?php else: ?>
							<div class="col-12">
								<i>No registration link yet.</i>
							</div>
							<?php  endif; ?>

						<?php  endif; ?>

						<?php if($alt_classes): ?>

						<div class="col-12">
                
		                <div id="alt-dates-container">Alternative Dates &amp; times <a class="primary-link ml-auto mr-3" href="/health-wellness/classes-events/?open_search_term=<?php echo $class_name;  ?>">View all <span id="alternate_dates_counter"></span></a>
		                </div>
						</div>


					


						
						<div class="col-12 slider alt-class-picker">
						
						<?php
						foreach($alt_classes as $class) {
							$class_date = get_field('date', $class->ID, true);
							$class_times = get_field('class_times', $class->ID, true);
							$permalink = get_the_permalink($class->ID);
							?>
						    
						    
							<div class="alt-classes">
	                          <a href="<?php echo $permalink ?>" class="">
	                            <div class="card bg-light mb-3">
	                              <!-- <div class="card-header">Morning Class</div> -->
	                              <div class="card-body">
	                                <ul class="modal-class-details">
	                                  <li><img class="icon-calendar" src="https://memorialohio.com/wp-content/themes/memorial_health/inc/assets/images/class-calendar.svg"><span id="class-date"></span><?php echo $class_date; ?></li>
	                                  <li><img class="icon-clock" src="https://memorialohio.com/wp-content/themes/memorial_health/inc/assets/images/class-time.svg">

									     <span id="class-time"><button class="service-bubble "><?php echo $class_times[0]['start_time']; ?></button></span>
										
	                                  </li>
	                                </ul>
	                              </div>
	                            </div>
	                          </a>
	                        </div>


                    	


						<?php } ?>
						</div>
						<?php endif; ?>

					





					</div>
				</div>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->


</div><!-- #content -->


<?php

get_footer();




