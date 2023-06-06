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
 * Template Name: Service Page
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
					<img class='cross-branding' alt="Memorial Branding Logo Desktop" src='<?php echo $branding?>'>

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
			<div class="row intro-mobile">
				<div class="col-lg-4 col-10" id="intro-title">
					<img class='cross-branding' alt="Memorial Branding Logo Mobile" src='<?php echo $branding?>'>
					<h1 class="list-title"><?php  echo get_field( "page_title" ); ?></h1>
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
				<div class="col-12">
					<p class="list-introduction"><?php  echo get_field( "page_introduction" ); ?></p>
				</div>
			</div>
		</div>




		<div class="container-fluid featured-post short service-sec">
			<h3>Frequently Searched Services</h3>

			<div class="row">

				<?php $featured_posts = get_field( "frequently_searched_services" ); ?>

				<?php foreach( $featured_posts as $featured_post ):
				 $permalink = get_permalink( $featured_post->ID );
				 $title = get_the_title( $featured_post->ID );
				 $short_description = get_field("short_description", $featured_post->ID);
				 ?>

					<div class="col-lg-4 col-sm-12">
						<div class="card">
								<div class="frequent-service-card">
									<a href="<?php echo $permalink ?>">
										<div class="service-name"><?php echo $title?></div>
										<p><?php echo $short_description?></p>
										<a href="<?php echo $permalink ?>" class="primary-link">View Details</a>
									</a>
								</div>
						</div>

					</div>

						 		<?php endforeach; ?>
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
