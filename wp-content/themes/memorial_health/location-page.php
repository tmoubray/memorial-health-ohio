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
 * Template Name: Location Page
 */

get_header(); ?>
<?php  custom_breadcrumbs(); 
$sharing_disabled = get_post_meta( $post->ID, 'sharing_disabled');
?>



<div id="content" class="site-content">


	<section id="primary" class="content-area">

		<main id="main" class="site-main location-page" role="main">

	<?php $branding = get_bloginfo( 'template_directory' ) . "/inc/assets/images/gray-cross-icon.png";?>

	<div class="container-fluid listing-introduction-container">
			<div class="row intro-full">
				<div class="col-4 cross-branding-container">
					<img class='cross-branding' alt="Memorial Branding Logo desk" src='<?php echo $branding?>'>
					<h1 class="list-title"><?php  echo get_field( "page_title" ); ?></h1>
				</div>
				<div class="col-6">
					<p class="list-introduction"><?php  echo get_field( "page_introduction" ); ?></p>
				</div>
				<div class="col-2">
					<?php if (!$sharing_disabled[0]) {?>
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button">
						<span class="share-text">Share</span>
						<a class="a2a_dd" title="Share" href="https://www.addtoany.com/share">
								<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/share.svg";?>" border="0" alt="Share" width="50" height="50">
						 </a>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="row intro-mobile">
				<div class="col-lg-4 col-10" id="intro-title">
					<img class='cross-branding' alt="Memorial Branding Logo mob" src='<?php echo $branding?>'>
					<h1 class="list-title"><?php  echo get_field( "page_title" ); ?></h1>
				</div>
				<div class="col-2">
					<?php if (!$sharing_disabled[0]) {?>
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button">
						<span class="share-text">Share</span>
						<a class="a2a_dd" title="Share" href="https://www.addtoany.com/share">
								<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/share.svg";?>" border="0" alt="Share" width="50" height="50">
						 </a>
					</div>
					<?php } ?>
				</div>
				<div class="col-12">
					<p class="list-introduction"><?php  echo get_field( "page_introduction" ); ?></p>
				</div>
			</div>
		</div>




		<div class="container-fluid featured-post hospital-urgent-care">
			<h3>Hospital & Urgent Care</h3>

			<div class="row">

		<?php $featured_posts = get_field( "hospital_and_urgent_care" ); ?>

		<?php foreach( $featured_posts as $featured_post ):
		 $permalink = get_permalink( $featured_post->ID );
		 $title = get_the_title( $featured_post->ID );
		 $location_name = get_field( 'location_name', $featured_post->ID );
		 $image = get_field( 'image', $featured_post->ID );
		 $logo = get_field( 'logo', $featured_post->ID );
		 $contact_information = get_field( 'contact_information', $featured_post->ID );

		 ?>
				<div class="col-lg-6 col-sm-12">
							<div class="card wide-card-container">
								<a class="card-link" title="<?php echo $title; ?>" href="<?php echo $permalink?>" >
									<div class="card-horizontal">
											<div class="img-square-wrapper">
													<img class="location-image" src="<?php echo $image ?>" alt="Card image cap">
											</div>
											<div class="card-body">
												
												<?php if ($logo) { ?>
												<a class="card-link" title="service logo" href="<?php echo $permalink?>" >	
												<span class="logo-container"><img class="service-logo" alt="service logo" src="<?php echo $logo?>"></span>
												</a>
												<?php }else{ ?>
												<a class="card-link" title="service logo" href="<?php echo $permalink?>" style="font-size:1.2rem;text-transform:uppercase;">
												<span><?php echo $location_name ?></span>
												</a>
												<?php } ?>
											
												<p class="card-text location-address"><?php echo $contact_information['street_address']; ?></p>
												<?php 
												if(!empty($contact_information['street_address'])){
													?>
													<a href="tel:<?php echo $contact_information['phone']; ?>" class="location-phone phone-number"><?php echo $contact_information['phone'];?></a>
													<?php
												}
												?>
												
											</div>
									</div>
								</a>
							</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>



		<div class="container-fluid">
			<div class="row">
				<div class="col-12 d-flex justify-content-center">
				<span id="all-locations-header">All Locations</span>
			</div>
			</div>
		</div>


			<div class="container-fluid">

			 <?php get_template_part("/template-parts/shared-elements"); ?>

			</div>





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
