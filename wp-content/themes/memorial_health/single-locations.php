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

get_header(); 
$sharing_disabled = get_post_meta( $post->ID, 'sharing_disabled');
?>
<div id="content" class="site-content">
<?php  custom_breadcrumbs(); ?>

<section id="primary" class="content-area">
<main id="main" class="site-main single-location" role="main">


<div class="container-fluid">


<div class="row title">
<div class="col-9">
<h1 class="list-title"><?php  echo the_title(); ?></h1>
</div>
<div class="col-3">
<?php if (!$sharing_disabled[0]) {?>
<div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button">
	<span class="share-text">Share</span>
	<a class="a2a_dd" href="https://www.addtoany.com/share">
		<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/share.svg";?>" border="0" alt="Share" width="50" height="50">
	 </a>
</div>
<?php } ?>
</div>

<div class="col-12">
<hr>
</div>
</div>


<div class="row contact-information">

<div class="col-lg-6">
<div id="intro">Contact Information</div>
<?php if( have_rows('contact_information') ): ?>
	<?php while( have_rows('contact_information') ): the_row(); ?>
		<div class="information-container">
			<div class="left-sec"><span class="icon-sec"><img class="icon" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/location.svg";?>" border="0" alt="Share" width="29" height="35"></span>
			<span class="type">Address</span>
			</div>
			<div class="right-sec">
			<span class="address"><?php the_sub_field('street_address'); ?></span>
			<a class="primary-link ml-auto mr-3" href="https://www.google.com/maps/search/?api=1&query=<?php echo strip_tags(get_sub_field('street_address')); ?>">Get Directions</a>
			<hr>
			</div>
		</div>

		<?php
			$phone = get_sub_field('phone');
			if(!empty($phone)){
		?>
		<div class="information-container">
			<div class="left-sec"><span class="icon-sec"><img class="icon" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/cell-phone.svg";?>" border="0" alt="Share" width="29" height="35"></span>
			<span class="type">Call</span>
			</div>
			<div class="right-sec">
			<a href="tel:<?php echo the_sub_field('phone'); ?>" class="phone phone-number"><?php the_sub_field('phone'); ?></a>
			</div>
		</div>
		<?php
			}
			$fax = get_sub_field('fax');
			if(!empty($fax)){
		?>

		
		<div class="information-container">
			<div class="left-sec"><span class="icon-sec"><img class="icon" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/building.svg";?>" border="0" alt="Share" width="29" height="35"></span>
			<span class="type">Fax</span>
			</div>
			<div class="right-sec">
			<span class="fax phone-number"><?php the_sub_field('fax'); ?></span>
			 <hr>
			</div>
		</div>
		<?php
			}
		?>


		<?php 
		$related_locations = get_field('related_locations');
		?>

		<?php if ($related_locations) { ?>
		<div class="information-container">
			
			<?php
			

			if( $related_locations ): ?>

			<div class="left-sec">
			<span class="type">Other Locations  </span>
			</div>
			<div class="right-sec">
			
			    <ul class="related_locations">
			    <?php foreach( $related_locations as $location ): 
		

			        $permalink = get_permalink( $location->ID );
					$title = get_the_title( $location->ID );
					$hide_from_locations_and_search = get_field( 'hide_from_locations_and_search', $location->ID );
		
			        ?>
			        <?php if(!$hide_from_locations_and_search ): ?>
			        <li>
			            <a style="font-size:18px;" href="<?php echo ( $permalink ); ?>"><?php echo ( $title ); ?></a>
			        </li>
			        <?php endif; ?>
			    <?php endforeach; ?>
			    </ul>
			    
			 
			
			</div>
			<?php endif; ?>
		</div>
		<?php } ?>
		


		<?php if (get_field("accepting_new_patients") == 'yes') {?>
		<div class="information-container accepting-new-patients">				

			<span class="statuses"><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/check-mark.svg";?>" border="0" alt="Share" width="32" height="32"> Accepting New Patients</span>
				
		</div>
		<?php } ?>
		
		<?php if( get_field('on_my_way') ):									
			$i_am_on_my_way_text = get_field('i_am_on_my_way_text');
			$i_am_on_my_way_link = get_field('i_am_on_my_way_link');
		?>
		
		<a class="service-bubble-alt" target="_blank" href="<?php echo (!empty($i_am_on_my_way_link)) ? $i_am_on_my_way_link : 'https://memorialohio.com/mychart/#'; ?>"><span class="service-bubble-alt-outer">
			<span class="btn-left"><img class="icon" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/plus-circle.svg";?>" border="0" alt="Share" width="29" height="35">
			</span>
		<div class="on-main-message"><span class="on-my-message">I’m on my way</span>
	  <span class="on-way-message"><?php echo (!empty($i_am_on_my_way_text)) ? $i_am_on_my_way_text : 'Let the emergency room know I’m coming.'; ?></span>
	  </div>
	  <span class="on-way-arrow"></span></span>
		</a>
		<?php endif; ?>


	<?php endwhile; ?>
<?php endif; ?>

</div>
<div class="col-lg-6">
	<img id="profile-image" src="<?php echo get_field("image")?>" border="0" alt="Share" width="500" height="500">
</div>


</div>



<div class="row map">


<div class="col-12">
<div class="map-container">
<?php
$location = get_field('mapped_location');

if( $location ): ?>
    <div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<?php endif; ?>

</div>
</div>
</div>

<?php if( have_rows('helpful_resources') ): ?>
<div class="row helpful-resources">


<div class="col-22 intro">
<h2>Helpful Resources</h2>
</div>

<div class="col-111">
<div class="vertical-bar"></div>
</div>

<div class="col-99">

	<?php while( have_rows('helpful_resources') ): the_row(); ?>
		<a  class="resource" target="<?php echo get_sub_field("resource")["target"]?>" href="<?php echo get_sub_field("resource")["url"]?>"><?php if (get_sub_field("is_document")) { ?>

			<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/downloadable.svg";?>" border="0" alt="Share" width="20" height="35">

		<?php }?>
		<?php if (!empty(get_sub_field("resource")["title"])) { ?>
			<?php echo get_sub_field("resource")["title"]?>
		<?php } ?>

		</a>
	<?php endwhile; ?>

</div>
</div>
<?php endif; ?>

<?php if( have_rows('hours') ): 
while( have_rows('hours') ): the_row(); 
if(!empty(get_sub_field('monday_open_time')) || !empty(get_sub_field('tuesday_open_time')) || !empty(get_sub_field('wednesday_open_time'))|| !empty(get_sub_field('thursday_open_time'))|| !empty(get_sub_field('friday_open_time'))|| !empty(get_sub_field('saturday_open_time'))|| !empty(get_sub_field('sunday_open_time'))):
?>
<div class="row hours test">
<div class="col-2">
	<span id="clock"><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/clock.svg";?>" border="0" alt="Share" width="29" height="35">Hours</span>

</div>
<div class="col-3">

<ul id="hours-list">
	
		
			<?php
				if(!empty(get_sub_field("monday_open_time"))){
					?>
					<li><span>Monday:</span><span><?php echo get_sub_field("monday_open_time")?> - <?php echo get_sub_field("monday_close_time")?></span></li>
					<?php
				}
				if(!empty(get_sub_field("tuesday_open_time"))){
					?>
					<li><span>Tuesday:</span><span><?php echo get_sub_field("tuesday_open_time")?> - <?php echo get_sub_field("tuesday_close_time")?></span></li>
					<?php
				}
				if(!empty(get_sub_field("wednesday_open_time"))){
					?>
					<li><span>Wednesday:</span><span><?php echo get_sub_field("wednesday_open_time")?> - <?php echo get_sub_field("wednesday_close_time")?></span></li>
					<?php
				}
				if(!empty(get_sub_field("thursday_open_time"))){
					?>
					<li><span>Thursday:</span><span><?php echo get_sub_field("thursday_open_time")?> - <?php echo get_sub_field("thursday_close_time")?></span></li>
					<?php
				}
				if(!empty(get_sub_field("friday_open_time"))){
					?>
					<li><span>Friday:</span><span><?php echo get_sub_field("friday_open_time")?> - <?php echo get_sub_field("friday_close_time")?></span></li>
					<?php
				}
				if(!empty(get_sub_field("saturday_open_time"))){
					?>
					<li><span>Saturday:</span><span><?php echo get_sub_field("saturday_open_time")?> - <?php echo get_sub_field("saturday_close_time")?></span></li>
					<?php
				}
				if(!empty(get_sub_field("sunday_open_time"))){
					?>
					<li><span>Sunday:</span><span><?php echo get_sub_field("sunday_open_time")?> - <?php echo get_sub_field("sunday_close_time")?></span></li>
					<?php
				}
			?>
		<?php //endwhile; ?>
	
</ul>

</div>
</div>
<?php endif; ?>
<?php endwhile; endif; ?>
<?php if (get_field('related_services')) : ?>
<div class="row service-specialties">

<div class="col-12">
<div id="intro">Service and Specialties:</div>

<?php
$services = get_field('related_services');
$index = 0;
if( $services ): ?>

		<?php foreach( $services as $service ):
				$index = $index + 1;
				$permalink = get_permalink( $service->ID );
				$title = get_the_title( $service->ID );
				$custom_field = get_field( 'field_name', $service->ID );

				?>

				<a  class="service-bubble" href="<?php echo $permalink?>"><?php echo $title ?></a>



		<?php endforeach; ?>

<?php endif; ?>

</div>
</div>
<?php endif; ?>
</div>



<?php if (get_field('doctors_staff')) : ?>
<div class="container-fluid gray-back">

<div class="row doctors-staff">



<div class="col-12">


	<?php if (get_field('doctors_staff')){
		$staff_count = count(get_field('doctors_staff'));
		$find_doc_page = site_url('find-a-doctor');
	}
	?>
	<div id="intro"><span>Doctors & staff</span><a class="primary-link ml-auto mr-3" href="<?php echo $find_doc_page.'?current_location='.get_the_title($postid) . '&general_term=&accepting_new_patients=true&accepting_telehealth=true'; ?>">View all <?php echo $staff_count?></a></div>
		<div id="single_location_docslider" class="slider four-panel">
			<?php
			$staff = get_field('doctors_staff');
			$index = 0;
			if( $staff ): ?>
					<?php foreach( $staff as $doctor ):
							$index = $index + 1;
							$permalink = get_permalink( $doctor->ID );
							$title = get_the_title( $doctor->ID );
							$main_phone_number = get_field( 'main_phone_number', $doctor->ID );
							$profile_image = get_field( 'profile_image', $doctor->ID );
							$accepting_new_patients = get_field('accepting_new_patients', $doctor->ID );
							$related_services = get_field( 'related_services', $doctor->ID );
							if (!$profile_image) {
								if(get_field("sex") != "female") {
									$profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
								}else{
									$profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
								}
							}
							?>




							<div style="padding-left:25px;">
								<a href="<?php the_permalink($doctor->ID);?>" class="doctor-card-link">
										<div class="card" style="width: 18rem;" id="doctor-card">
											<div style="position:relative;display:inline-block;transition: transform 150ms ease-in-out;"> 
											<img class="card-img-top" src="<?php echo $profile_image;?>" alt="Card image cap" width="286" height="199.5">

											<?php if ($accepting_new_patients == 'yes') {?>


	<svg version="1.1" style="position:absolute;bottom:-2px;left:0;width:10rem;height:25px;width:175px;" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 200 25" style="enable-background:new 0 0 200 25;" xml:space="preserve"> <style type="text/css"> .st0{fill:#752F89;} .st1{fill:#FFFFFF;} </style> <rect class="st0" width="200" height="25"/> <g> <path class="st1" d="M5.1,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4H5.1V7.3z M7.2,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M12.1,7.3c0.7-0.1,1.5-0.2,2.3-0.2c1.2,0,2.2,0.2,2.9,0.8c0.7,0.6,0.8,1.3,0.8,2.2c0,1.2-0.6,2.2-1.7,2.7v0 c0.7,0.3,1.1,1,1.3,2.1c0.2,1.2,0.5,2.5,0.7,2.9h-2.2c-0.1-0.3-0.4-1.4-0.5-2.6c-0.2-1.3-0.5-1.7-1.2-1.7h-0.3v4.3h-2.1V7.3z M14.2,12h0.4c0.9,0,1.4-0.7,1.4-1.7c0-0.9-0.4-1.6-1.3-1.6c-0.2,0-0.4,0-0.5,0.1V12z"/> <path class="st1" d="M21.6,15.4l-0.5,2.5h-2l2.3-10.8h2.5L26,17.9h-2l-0.5-2.5H21.6z M23.3,13.8L23,11.5c-0.1-0.7-0.3-1.7-0.4-2.4 h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H23.3z"/> <path class="st1" d="M32,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3c0-4.1,2.3-5.7,4.4-5.7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L32,17.7z"/> <path class="st1" d="M34.6,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M41.6,7.1v10.8h-2.1V7.1H41.6z"/> <path class="st1" d="M48.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C42.8,8.6,45,7,47.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L48.5,17.7z"/> <path class="st1" d="M54,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5H54V13.2z"/> <path class="st1" d="M60,15.4l-0.5,2.5h-2l2.3-10.8h2.5l2.1,10.8h-2L62,15.4H60z M61.8,13.8l-0.4-2.3c-0.1-0.7-0.3-1.7-0.4-2.4h0 c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H61.8z"/> <path class="st1" d="M70.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C64.8,8.6,67,7,69.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L70.5,17.7z"/> <path class="st1" d="M76.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C70.8,8.6,73,7,75.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L76.5,17.7z"/> <path class="st1" d="M82.1,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M83.6,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M85.7,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M92.2,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M99.2,7.1v10.8h-2.1V7.1H99.2z"/> <path class="st1" d="M100.9,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H100.9z"/> <path class="st1" d="M114.9,17.6c-0.5,0.2-1.5,0.4-2.2,0.4c-1.2,0-2.2-0.4-2.9-1.1c-0.9-0.9-1.4-2.5-1.4-4.4c0-3.9,2.3-5.6,4.6-5.6 c0.8,0,1.4,0.2,1.8,0.3l-0.4,1.8c-0.3-0.1-0.7-0.2-1.2-0.2c-1.4,0-2.6,1-2.6,3.8c0,2.6,1,3.5,2,3.5c0.2,0,0.3,0,0.4,0v-2.6h-1v-1.7 h2.9V17.6z"/> <path class="st1" d="M119,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H119z"/> <path class="st1" d="M131.7,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M134.5,17.9l-1.8-10.8h2.2l0.5,4.3c0.1,1.2,0.2,2.5,0.4,3.8h0c0.1-1.3,0.4-2.5,0.6-3.8l0.8-4.3h1.7l0.7,4.3 c0.2,1.2,0.4,2.4,0.5,3.8h0c0.1-1.4,0.3-2.6,0.4-3.8l0.5-4.3h2l-1.9,10.8H139l-0.6-3.5c-0.2-1-0.3-2.2-0.5-3.6h0 c-0.2,1.3-0.4,2.5-0.6,3.6l-0.7,3.5H134.5z"/> <path class="st1" d="M146.7,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M148.8,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M155.2,15.4l-0.5,2.5h-2L155,7.1h2.5l2.1,10.8h-2l-0.5-2.5H155.2z M156.9,13.8l-0.4-2.3 c-0.1-0.7-0.3-1.7-0.4-2.4h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H156.9z"/> <path class="st1" d="M161.3,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M168.3,7.1v10.8h-2.1V7.1H168.3z"/> <path class="st1" d="M174.5,13.2h-2.5v2.9h2.8v1.8H170V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M176.1,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H176.1z"/> <path class="st1" d="M185.4,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M190.2,15.8c0.4,0.2,1.2,0.4,1.8,0.4c1,0,1.5-0.5,1.5-1.2c0-0.8-0.5-1.2-1.4-1.8c-1.5-0.9-2-2-2-3 c0-1.7,1.2-3.2,3.4-3.2c0.7,0,1.4,0.2,1.7,0.4l-0.3,1.8c-0.3-0.2-0.8-0.4-1.4-0.4c-0.9,0-1.3,0.5-1.3,1.1c0,0.6,0.3,1,1.5,1.7 c1.4,0.9,2,2,2,3.1c0,2-1.5,3.3-3.6,3.3c-0.9,0-1.7-0.2-2.1-0.4L190.2,15.8z"/> </g> </svg>

											<?php } ?>

											</div>
											<div class="card-body">
												<h3 class="card-title"><?php echo $title ?></h3>
												<hr>
												<p class="card-text">

													<?php

													$index = 0;
													if( $related_services ): 
														$total_services = count($related_services);

														?>
															<?php foreach( $related_services as $service ):
																	$index = $index + 1;
																	$service_permalink = get_permalink( $service->ID );
																	$title = get_the_title( $service->ID );
																	$custom_field = get_field( 'field_name', $service->ID );
																	?>
																	<?php if ($index <= 2) {?>
																		<a  class="service-bubble" href="<?php echo $service_permalink?>"><?php echo $title ?></a>
																	<?php }?>

															<?php endforeach; ?>
															<?php if ($total_services > 2) { ?>
															<a  class="service-bubble" href="<?php echo $permalink?>">+ <?php echo ($total_services - 2) ?></a>
															<?php } ?>

													<?php endif; ?>

												</p>
												<span class="phone-number-container"><img class="smartphone-icon" src="<?php echo get_bloginfo( 'template_directory' ) . '/inc/assets/images/smartphone.png';?>"> <span class="call">Call</span> <span class="phone-number"><?php echo $main_phone_number?></span></span>
											</div>
										</div>
									</a>
						</div>


					<?php endforeach; ?>

			<?php endif; ?>
		</div>



		<div class="slider two-panel-up">
			<?php
			$staff = get_field('doctors_staff');
			$index = 0;
			if( $staff ): ?>
					<?php foreach( $staff as $doctor ):
							$index = $index + 1;
							$permalink = get_permalink( $doctor->ID );
							$title = get_the_title( $doctor->ID );
							$main_phone_number = get_field( 'main_phone_number', $doctor->ID );
							$profile_image = get_field( 'profile_image', $doctor->ID );
							$related_services = get_field( 'related_services', $doctor->ID );
							$accepting_new_patients = get_field('accepting_new_patients', $doctor->ID );
							if (!$profile_image) {
								if(get_field("sex") != "female") {
									$profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
								}else{
									$profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
								}
							}
							?>


							<div style="padding-left:25px;">
								<a href="<?php the_permalink($doctor->ID);?>" class="doctor-card-link">
										<div class="card" style="width: 18rem;" id="doctor-card">
											<div style="position:relative;display:inline-block;transition: transform 150ms ease-in-out;"> 
											<img class="card-img-top" src="<?php echo $profile_image;?>" alt="Card image cap" width="286" height="199.5">
											<?php if ($accepting_new_patients == 'yes') {?>


<svg version="1.1" style="position:absolute;bottom:-2px;left:0;width:10rem;height:25px;width:175px;" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 200 25" style="enable-background:new 0 0 200 25;" xml:space="preserve"> <style type="text/css"> .st0{fill:#752F89;} .st1{fill:#FFFFFF;} </style> <rect class="st0" width="200" height="25"/> <g> <path class="st1" d="M5.1,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4H5.1V7.3z M7.2,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M12.1,7.3c0.7-0.1,1.5-0.2,2.3-0.2c1.2,0,2.2,0.2,2.9,0.8c0.7,0.6,0.8,1.3,0.8,2.2c0,1.2-0.6,2.2-1.7,2.7v0 c0.7,0.3,1.1,1,1.3,2.1c0.2,1.2,0.5,2.5,0.7,2.9h-2.2c-0.1-0.3-0.4-1.4-0.5-2.6c-0.2-1.3-0.5-1.7-1.2-1.7h-0.3v4.3h-2.1V7.3z M14.2,12h0.4c0.9,0,1.4-0.7,1.4-1.7c0-0.9-0.4-1.6-1.3-1.6c-0.2,0-0.4,0-0.5,0.1V12z"/> <path class="st1" d="M21.6,15.4l-0.5,2.5h-2l2.3-10.8h2.5L26,17.9h-2l-0.5-2.5H21.6z M23.3,13.8L23,11.5c-0.1-0.7-0.3-1.7-0.4-2.4 h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H23.3z"/> <path class="st1" d="M32,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3c0-4.1,2.3-5.7,4.4-5.7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L32,17.7z"/> <path class="st1" d="M34.6,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M41.6,7.1v10.8h-2.1V7.1H41.6z"/> <path class="st1" d="M48.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C42.8,8.6,45,7,47.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L48.5,17.7z"/> <path class="st1" d="M54,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5H54V13.2z"/> <path class="st1" d="M60,15.4l-0.5,2.5h-2l2.3-10.8h2.5l2.1,10.8h-2L62,15.4H60z M61.8,13.8l-0.4-2.3c-0.1-0.7-0.3-1.7-0.4-2.4h0 c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H61.8z"/> <path class="st1" d="M70.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C64.8,8.6,67,7,69.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L70.5,17.7z"/> <path class="st1" d="M76.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C70.8,8.6,73,7,75.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L76.5,17.7z"/> <path class="st1" d="M82.1,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M83.6,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M85.7,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M92.2,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M99.2,7.1v10.8h-2.1V7.1H99.2z"/> <path class="st1" d="M100.9,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H100.9z"/> <path class="st1" d="M114.9,17.6c-0.5,0.2-1.5,0.4-2.2,0.4c-1.2,0-2.2-0.4-2.9-1.1c-0.9-0.9-1.4-2.5-1.4-4.4c0-3.9,2.3-5.6,4.6-5.6 c0.8,0,1.4,0.2,1.8,0.3l-0.4,1.8c-0.3-0.1-0.7-0.2-1.2-0.2c-1.4,0-2.6,1-2.6,3.8c0,2.6,1,3.5,2,3.5c0.2,0,0.3,0,0.4,0v-2.6h-1v-1.7 h2.9V17.6z"/> <path class="st1" d="M119,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H119z"/> <path class="st1" d="M131.7,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M134.5,17.9l-1.8-10.8h2.2l0.5,4.3c0.1,1.2,0.2,2.5,0.4,3.8h0c0.1-1.3,0.4-2.5,0.6-3.8l0.8-4.3h1.7l0.7,4.3 c0.2,1.2,0.4,2.4,0.5,3.8h0c0.1-1.4,0.3-2.6,0.4-3.8l0.5-4.3h2l-1.9,10.8H139l-0.6-3.5c-0.2-1-0.3-2.2-0.5-3.6h0 c-0.2,1.3-0.4,2.5-0.6,3.6l-0.7,3.5H134.5z"/> <path class="st1" d="M146.7,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M148.8,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M155.2,15.4l-0.5,2.5h-2L155,7.1h2.5l2.1,10.8h-2l-0.5-2.5H155.2z M156.9,13.8l-0.4-2.3 c-0.1-0.7-0.3-1.7-0.4-2.4h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H156.9z"/> <path class="st1" d="M161.3,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M168.3,7.1v10.8h-2.1V7.1H168.3z"/> <path class="st1" d="M174.5,13.2h-2.5v2.9h2.8v1.8H170V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M176.1,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H176.1z"/> <path class="st1" d="M185.4,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M190.2,15.8c0.4,0.2,1.2,0.4,1.8,0.4c1,0,1.5-0.5,1.5-1.2c0-0.8-0.5-1.2-1.4-1.8c-1.5-0.9-2-2-2-3 c0-1.7,1.2-3.2,3.4-3.2c0.7,0,1.4,0.2,1.7,0.4l-0.3,1.8c-0.3-0.2-0.8-0.4-1.4-0.4c-0.9,0-1.3,0.5-1.3,1.1c0,0.6,0.3,1,1.5,1.7 c1.4,0.9,2,2,2,3.1c0,2-1.5,3.3-3.6,3.3c-0.9,0-1.7-0.2-2.1-0.4L190.2,15.8z"/> </g> </svg>
												<?php } ?>
											</div>

											
											<div class="card-body">
												<h3 class="card-title"><?php echo $title ?></h3>
												<hr>
												<p class="card-text">

													<?php

													$index = 0;
													if( $related_services ): ?>
															<?php foreach( $related_services as $service ):
																	$index = $index + 1;
																	$permalink = get_permalink( $service->ID );
																	$title = get_the_title( $service->ID );
																	$custom_field = get_field( 'field_name', $service->ID );

																	?>
																	<?php if ($index <= 2) {?>
																			<a  class="service-bubble" href="<?php echo $permalink?>"><?php echo $title ?></a>
																	<?php }?>
																	<?php if ($index == 2) {?>
																		<a  class="service-bubble" href="<?php echo the_permalink()?>">+ <?php echo count($services) - 2 ?></a>
																	<?php }?>




															<?php endforeach; ?>

													<?php endif; ?>

												</p>
												<span class="phone-number-container"><img class="smartphone-icon" src="<?php echo get_bloginfo( 'template_directory' ) . '/inc/assets/images/smartphone.png';?>"> <span class="call">Call</span> <span class="phone-number"><?php echo $main_phone_number?></span></span>
											</div>
										</div>
									</a>
						</div>


					<?php endforeach; ?>

			<?php endif; ?>
		</div>



</div>
</div>
</div>
<?php endif; ?>



<?php if (get_field('about_us')) : ?>
<div class="container-fluid">

<div class="row about-us">

<div class="col-12">

	<div id="intro"><?php echo get_field('about_us_title'); ?></div>

	<?php  echo get_field('about_us');?>

</div>
</div>

</div>
<?php endif; ?>






<?php if (get_field('classes_events')) : ?>
<div class="container-fluid gray-back">

<div class="row classes-events">


<div class="col-12">


	<?php if (get_field('classes_events')){
		$class_count = count(get_field('classes_events'));
	}
	?>
	<div id="intro"><span>Classes & Events</span><a href="<?php echo site_url('/locations/memorial-gables/'); ?>" class="primary-link ml-auto">View All <?php echo $class_count?></a></div>
	<div id="single_locations_mhslider" class="slider classes-slider">
		<?php
		$classes = get_field('classes_events');
		$index = 0;
		if( $classes ): ?>

				<?php foreach( $classes as $class ):
						$index = $index + 1;
						$permalink = get_permalink( $class->ID );
						$title = get_the_title( $class->ID );
						$description = get_field( 'description', $class->ID );
						$image = get_field( 'image', $class->ID );
						$date = get_field( 'date', $class->ID );
						$name = get_field( 'name', $class->ID );
						$class_times = get_field( 'class_times', $class->ID );
						$locations = get_field( 'related_location', $class->ID );

						if (!$image) {
							if(get_field("sex") != "female") {
								$image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
							}else{
								$image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
							}
						}
						?>


						<div style="padding-left:25px;">
								<div class="card" onclick="class_events_search_modal(this);" data-toggle="modal" data-target="#classes-events-modal" style="width: 18rem;" id="class-event-card" data-event-id="<?php echo $class->ID; ?>">
				

									<img class="card-img-top" src="<?php echo $image;?>" alt="Card image cap">
									<div class="card-body">

										<h5 class="card-title" ><?php echo $name?></h5>
										<hr>
										<div class="class-date"><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-calendar.svg"?>"><?php echo $date ?></div>


										<div class="related-services">

											<img class="class-times" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-time.svg"?>">
											<?php
												// Check rows exists.
												if( $class_times):

														// Loop through rows.
														foreach($class_times as $class_time) :


															$start_time = $class_time["start_time"];
															$permalink = get_permalink();

															echo "<a  class='service-bubble' href='$permalink'>$start_time</a>";
																// Do something...

														// End loop.
														endforeach;

												// No value.
												else :
														// Do something...
												endif;
											?>

										</div>

										<div class="class-location">
											<div class="location-icon"><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/pin.svg"?>"></div>

											<?php
											if( $locations ): ?>
														 <?php
															$permalink = get_permalink( $locations->ID );
															$title = get_sub_field( $locations->ID );
															$contact_information = get_field( 'contact_information', $locations->ID );
															?>
														<?php echo "<div>" . $contact_information["street_address"] . "</div>";?>
											<?php endif; ?>
										</div>


										<button type="button" class="btn btn-primary btn-lg btn-block">
											<?php if (get_field("cost"))
											{ echo "$" . get_field("cost");
											}else{
												echo "FREE";}; ?>

										</button>

									</div>
								</div>

					</div>


				<?php endforeach; ?>

		<?php endif; ?>
	</div>



</div>

</div>
</div>
<?php endif; ?>
<?php get_template_part("/template-parts/class-modal"); ?>
</main><!-- #main -->
</section><!-- #primary -->
</div><!-- #content -->
<?php

get_footer();
