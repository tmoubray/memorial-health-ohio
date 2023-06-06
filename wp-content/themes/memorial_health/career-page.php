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
 * Template Name: Career Page
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
 							<p class="list-introduction"><?php echo get_field("page_introduction"); ?></p>
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
				<div class="row simple-content-section">
				<div class="col-md-8 career-left">
					<?php
						$content = get_field('intro_description');
						if(!empty($content)){
							echo $content;
						}

						//Accordion
						if( have_rows('carrer_accordion_group') ): ?>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<?php 
							$i = 0;
							while( have_rows('carrer_accordion_group') ): the_row(); 
								$accordion_title = get_sub_field('accordion_title');
								$accordion_description = get_sub_field('accordion_description');
								?>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="heading_<?php echo $i; ?>">
										<h4 class="panel-title">
											<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse_<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i; ?>"><?php echo $accordion_title; ?> <i class="fa fa-angle-up"></i></a>
										</h4>
									</div>
									<div id="collapse_<?php echo $i; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_<?php echo $i; ?>">
										<div class="panel-body">  
											<?php echo $accordion_description; ?>
										</div>
									</div>
								</div>
								<?php 
							$i++;
							endwhile; ?>
						</div>
						<?php endif; ?>
								
 				</div>

				<?php if( have_rows('bagde_images') ): ?>
				<div class="col-md-4 career-right">
				<?php while( have_rows('bagde_images') ): the_row(); 
					$badge_image = get_sub_field('badge_image');
					$image_link = get_sub_field('image_link');
					?>
					<div class="right-side-img">
						<a href="<?php echo (!empty($image_link)) ? $image_link : 'javascript:void(0);';?>" target="<?php echo (!empty($image_link)) ? '_blank' : '_self';?>">
							<img src="<?php echo $badge_image; ?>" alt="Carrer Badge Image">
						</a>
					</div>
				<?php endwhile; ?>
				</div>
				<?php endif; ?>

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
