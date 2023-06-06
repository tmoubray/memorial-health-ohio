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

 $ratings = getRatingsByNpi(get_field("npi_code"));
 $overall_rating = $ratings["data"]["entities"][0]["overallRating"]["value"];
 $overall_rating_whole = floor($overall_rating);
 $overall_rating_fraction = $overall_rating - $overall_rating_whole;
 $total_reviews = $ratings['data']['entities']['0']['totalRatingCount'];
 $explanation_rating = $ratings['data']['entities']['0']['overallRating']['questionRatings']['4']['value'];
 $courtesy_rating = $ratings['data']['entities']['0']['overallRating']['questionRatings']['2']['value'];
 $patient_rating = $ratings['data']['entities']['0']['overallRating']['questionRatings']['7']['value'];
 $patient_comments = $ratings['data']['entities']['0']['comments'];
 if ($overall_rating_fraction > 0) {
     $fractional_star_src = "half-star";
 }
 if (get_field("profile_image")) {
     $profile_image = get_field("profile_image");
 } else {
     $profile_image = get_bloginfo('template_directory') . "/inc/assets/images/avatar.png";
 }

get_header();
$sharing_disabled = get_post_meta( $post->ID, 'sharing_disabled');
$postID = get_the_ID();
?>
<div id="content" class="site-content">
	<?php  custom_breadcrumbs(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main single-doctor" role="main">

			<div class="container-fluid">


				<div class="row title">
					<div class="col-lg-12 col-sm-12">
						<h1 class="list-title"><?php  echo the_title(); ?></h1>
					</div>
				</div>





				<div class="row ratings">
					<div class="col-9">
						<div id="overall-star-rating">
						<?php
                        for ($x = 0; $x < $overall_rating_whole; $x++) {
                            echo '<img src="' . get_bloginfo('template_directory') . '/inc/assets/images/star.svg" border="0" alt="Share" width="50" height="50">';
                        }
                        if ($fractional_star_src) {
                            echo '<img src="' . get_bloginfo('template_directory') . '/inc/assets/images/half-star.svg" border="0" alt="Share" width="50" height="50">';
                        }
                        ?>

						<?php
                        if ($overall_rating) {
                            echo "<div id='out-of-five'>$overall_rating out of 5</div>";
                        }
                        ?>

						<?php
                        if ($total_reviews) {
                            echo "<a href='#ratings' id='total-reviews'>($total_reviews Reviews)</a>";
                        }
                        ?>

						</div>

					</div>
					<div class="col-3">
						<?php if (!$sharing_disabled[0]) {?>
						<div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button">
							<span class="share-text">Share</span>
							<a class="a2a_dd" href="https://www.addtoany.com/share">
									<img src="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/share.svg";?>" border="0" alt="Share" width="50" height="50">
							 </a>
						</div>
						<?php } ?>
					</div>
					<div class="col-12">
						<hr>
					</div>
				</div>


				<div class="row services">
     
					<div class="col-lg-6 col-12">
						<?php if (get_field("accepting_new_patients") == 'yes') {
                            ?>
						<span class="statuses"><img src="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/check-mark.svg"; ?>" border="0" alt="Share" width="32" height="32"> Accepting New Patients</span>
						<?php
                        } ?>
						<br>
						<?php if (get_field("accepting_telehealth_appointment") == 'yes') {
                            ?>
						<span class="statuses"><img src="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/check-mark.svg"; ?>" border="0" alt="Share" width="32" height="32"> Accepting Telehealth Appointments</span>
						<?php
                        } ?>

					

						<?php
                        $services = get_field('related_services');
                      
                        $index = 0;
                        if ($services): ?>
                       <p class="services-specialties">Services:</p>
						<div class="services-bubbles">

								<?php foreach ($services as $service):

                                        $permalink = get_the_permalink($service->ID);
                                 

                                        ?>
										<!-- <?php 
										if ($index <= 2) {
                                            ?>
												<a  class="service-bubble" href="<?php echo $permalink?>"><?php echo $title ?></a> 
										<?php
                                        }
                                        ?>
										<?php 
										if ($index == 2) {
                                            ?>
											 <a  class="service-bubble" href="<?php echo the_permalink()?>">+ <?php echo count($services) - 2 ?></a> 
										<?php
                                        }
                                        ?> -->
										<a  href="<?php echo $permalink?>" class="service-bubble"><?php echo $service->name; ?></a>									

								<?php endforeach; ?>
							 </div>

						<?php endif; ?>

           		
            <br>


						
						<?php
						/* if(get_field("years_of_experience")){
							?>
							<p class="years-experience">Experience:</p>
							<p class="experience"><?php echo get_field("years_of_experience")?> Years</p>
							<?php
						} */
						
						$started_practice = get_field('started_practice');
						if (!empty($started_practice)) {
							$current_date = date_create(date_i18n('Y-m-d'));
							$started_practice = date_create($started_practice);	
							$diff = date_diff($started_practice, $current_date);

							if ($diff->y >= 5) {
								?>
								<p class="years-experience">Experience:</p>
								<p class="experience">
									<?php 
										if ($diff->y <= 25) {
											echo $diff->y . ' Years';
										}
										
										if ($diff->y > 25) {
											echo '25+ Years';
										}
									?>
								</p>
								<?php
							}														
						}
						

						$main_phone_number = get_field("main_phone_number");
						if(!empty($main_phone_number)){
							$phoneint = str_replace( array( '\'', '"',',' , ';', '<', '>','(',')','-',' '), '', $main_phone_number);
							?>
							<a class="service-bubble-alt" href="tel:<?php echo $phoneint; ?>">Call for appointment <span class="phone-number"><?php echo get_field("main_phone_number")?></span></a>
							<?php
						}
						?>
						
						<br>

						<?php 
						$appointmentLink = get_field("appointment_link");
						if(!empty($appointmentLink)){
							?>
							<a class="service-bubble-alt" target="_blank" href="<?php echo $appointmentLink; ?>">Schedule MyChart Appointment</span></a>
							<?php
						}
						?>


						<?php 
						$name_of_practice = get_field("name_of_practice");
						?>
						<br>
				
						<?php if ($name_of_practice): ?>
							<span class="statuses"><b>Practice Name:</b> <?php echo $name_of_practice; ?></span>
						<?php endif; ?>
						<br>
						
 

					</div>
					<div class="col-lg-6 col-12">
						<div class="outer-img-sec">
								<img id="profile-image" src="<?php echo $profile_image;?>" border="0" alt="Share" width="520" height="520">
						</div>
					</div>
				</div>


			</div>




			<div class="container-fluid gray-back">


			<div class="row locations">
			<div class="col-12">

			<h3 id="services-specialties-intro">Locations & Contact Information</h3>

			</div>


			<?php $featured_posts = get_field("related_locations",$postID); ?>

		<?php foreach ($featured_posts as $featured_post):
            $permalink = get_permalink($featured_post->ID);
            $title = get_the_title($featured_post->ID);
            $location_name = get_field('location_name', $featured_post->ID);
            $image = get_field('image', $featured_post->ID);
            $contact_information = get_field('contact_information', $featured_post->ID);
            $locationLogo = get_field('logo', $featured_post->ID);

			$locationLogoSrc = (!empty($locationLogo)) ? $locationLogo : $title;
             ?>

				<div class="col-12 col-lg-6">
					<a class="card-link" href="<?php echo $permalink?>" >
						<div class="card wide-card-container">
								<div class="card-horizontal">
										<div class="img-square-wrapper">
												<img class="location-image" src="<?php echo $image ?>" alt="Card image cap">
										</div>
										<div class="card-body">
													<?php if ($locationLogo) {?>
										                <a class="card-link" title="service logo"  href="<?php the_permalink();?>" >
										                  <span class="logo-container"><img class="service-logo" alt="service logo" src="<?php echo $locationLogoSrc; ?>"></span>
										                </a>
										              <?php }else{ ?>

										                <a class="card-link" title="service logo" href="<?php echo get_permalink($postId) ?>" style="font-size:1.2rem;text-transform:uppercase;">
										                    <span><?php echo $title; ?></span>
										                 </a>
										              <?php } ?>



														<p class="card-text location-address"><?php echo $contact_information['street_address']; ?></p>
														<span class="location-phone"><?php echo $contact_information['phone'];  ?></p>

										</div>
								</div>

						</div>
					</a>
				</div>
					 		<?php endforeach; ?>
				</div>



				<?php if (have_rows('degrees_certifications_and_training')):?>

				<div class="row certifications">

					<div class="col-12">
					<h3 id="about-intro">About</h3>
					<table class="table" id="about-table">
					  <tbody>


									    <?php while (have_rows('degrees_certifications_and_training')) : the_row();

                                            // Load sub field value.
                                            $title = get_sub_field('title');
                                                    $description = get_sub_field('description');

                                                    echo "<tr>
															<td class='cert-title'>$title</td>
														    <td class='description'>
															<div class='cert-title-mob'>$title</div>
															<div class='description-mob'>$description</div>
															</td>
														  </tr>
														 	";
                                            // Do something...

                                        // End loop.
                                        endwhile;?>



					  </tbody>
					</table>
				 </div>

				</div>
			<?php	endif;?>

			</div>


			<div class="container-fluid">
				<div class="row biography">

					<div class="col-12">
						<?php if (have_rows('biography')): ?>
						    <?php while (have_rows('biography')): the_row();

                                // Get sub field values.
                                $image = get_sub_field('image');
                                $text = get_sub_field('text');

                                ?>
										<div class="text-center">
											<?php if ($image) {
                                    ?>
									<div class="biography-image">
										<img id="biography-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['url']); ?>" />
									</div>
											<?php
                                } ?>

						            <div class="content">
						                <?php echo $text?>
						            </div>

										</div>


						    <?php endwhile; ?>
						<?php endif; ?>

					</div>
					<div class="col-12">
						<hr>
					</div>



				</div>

			</div>




			<div class="container-fluid">
				<div class="row ratings-container" id="ratings">

					<div class="content">
						<div class="col-12">
							<?php echo get_field("ratings_intro")?>
						</div>


						<div class="col-12">
							<?php echo get_field("ratings")?>
						</div>
				</div>

				</div>

			</div>

		</main><!-- #main -->
	</section><!-- #primary -->


</div><!-- #content -->
<?php

get_footer();
