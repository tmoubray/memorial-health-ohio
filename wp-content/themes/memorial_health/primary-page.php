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
 /**
 * Template Name: Primary Page
 */

get_header(); ?>
<?php  custom_breadcrumbs(); 
$sharing_disabled = get_post_meta( $post->ID, 'sharing_disabled');

?>



<div id="content" class="site-content">


	<section id="primary" class="content-area">

		<main id="main" class="site-main primary-page" role="main">

			<?php if (get_field("add_page_introduction")) {?>

			<?php $branding = get_bloginfo( 'template_directory' ) . "/inc/assets/images/gray-cross-icon.png";?>
			<div class="container-fluid listing-introduction-container">
					<div class="row">
						<div class="col-lg-4 cross-branding-container">
							<img class='cross-branding' alt="Memorial Branding Logo" src='<?php echo $branding?>'>

							<h1 class="list-title"><?php  echo get_field( "page_title" ); ?></h1>
						</div>
						<div class="col-6">
							<p class="list-introduction"><?php  echo get_field( "page_introduction" ); ?></p>
						</div>
						<div class="col-2">
							<?php if (!$sharing_disabled[0]) {?>
								<div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button">
									<span class="share-text">Share</span>
									<a class="a2a_dd" href="https://www.addtoany.com/share">
											<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/share.svg";?>" border="0" alt="Share" width="50" height="50">
									 </a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>

			<?php } ?>

			<div class="container-fluid">

			 <?php get_template_part("/template-parts/shared-elements"); ?>

			</div>



<?php

if( have_rows('shared_elements') ):
    // Loop through rows.
    while ( have_rows('shared_elements') ) : the_row();

		if( get_row_layout() == 'featured_classes_events' ):

			$tx = get_sub_field('classes_and_events');


// $arrays = [];
// for ($i=0; $i< count($tx); $i++)
//     {
//         $count = count($arrays);
//         $arrays[$count] = array(
//         	'relation'		=> 'OR',
//                     'key' => 'genres',
//                     'value' => $tx[$i],
//                     'compare' => 'LIKE'
//                     );
//     }






// $the_query = new WP_Query(array(
// 		'numberposts'	=> -1,
// 		'post_type'		=> 'classes_events',
//         'meta_query' => $arrays
//     ));





// foreach($the_query->posts as $post) {

//     echo get_the_title();

// }


			if( have_rows('classes_and_events') ):?>


			<div class="container-fluid gray-back">

				<div class="row classes-events">

					<div class="col-12">





					<?php while ( have_rows('classes_and_events') ) : the_row();?>



					<div class="slider classes-slider">
						<?php

						$classes = get_field('classes_and_events');
						$index = 0;
						echo $classes;
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
												$image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/female-avatar.jpg";
											}else{
												$image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/male-avatar.jpg";
											}
										}
										?>


										<div style="padding-left:25px;">
											<a href="<?php the_permalink();?>" class="doctor-card-link">
												<div class="card" data-toggle="modal" data-target="#exampleModal" style="width: 18rem;" id="class-event-card">




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
												</a>
									</div>


								<?php endforeach; ?>

						<?php endif; ?>
					</div>

				<?php endwhile;?>

				</div>

				</div>
				</div>
		 <?php // Do something..
	 endif;

	endif;

endwhile;
endif;
		?>







			<?php
			// // Check value exists.
			// if( have_rows('content') ):
			//     // Loop through rows.
			//     while ( have_rows('content') ) : the_row();
			//         // Case: Paragraph layout.
			//         if( get_row_layout() == 'paragraph' ):
			//             $text = get_sub_field('text');
			//             // Do something...
			//
			//         // Case: Download layout.
			//         elseif( get_row_layout() == 'download' ):
			//             $file = get_sub_field('file');
			//             // Do something...
			//         endif;
			//     // End loop.
			//     endwhile;
			// // No value.
			// else :		    // Do something...
			// endif;


			 ?>

		</main><!-- #main -->
	</section><!-- #primary -->



</div><!-- #content -->
<?php

get_footer();
