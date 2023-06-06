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
 * Template Name: Front Page
 */

get_header(); ?>
<div id="content" class="site-content home-page">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container-fluid">
			<!--Slider Starts-->
			<?php
			$serviceicon =  get_bloginfo( 'template_directory' ) . "/inc/assets/images/stethescope.svg";
	        $locationicon =  get_bloginfo( 'template_directory' ) . "/inc/assets/images/hospital-pin.svg";
	        $doctoricon =  get_bloginfo( 'template_directory' ) . "/inc/assets/images/doctor.svg";

	        $menutemplate = '<div id="help-menu"><span>How Can We Help You?</span><a href="'.site_url().'/services">Services <img src="'.$serviceicon.'" alt="Services"></a><a href="'.site_url().'/find-a-doctor">Doctors <img src="'.$doctoricon.'" alt="Doctors"></a><a href="'.site_url().'/locations">Locations <img src="'.$locationicon.'" alt="Locations"></a></div>';

			?>
			<div class="hero-slider-home-outer">
				<div class="hero-slider-home row home-full-slider">
				<?php if( have_rows('home_slider') ): ?>
				    <?php while( have_rows('home_slider') ): the_row(); 
				        $slider_headline = get_sub_field('slider_headline');
				        $slider_message = get_sub_field('slider_message');
				        $slider_image = get_sub_field('slider_image');
				        $slider_link = get_sub_field('slider_link');
				        ?>				        
					    <div class="slide-sec">
							<div class="slider-overlay-img"></div>
					        <img class="slider-img" src="<?php echo $slider_image; ?>" alt="<?php echo $slider_headline; ?>">
							<div class="slider-content">
								 <div class="slider-content-top">
								    <h1 class="headline"><?php echo $slider_headline; ?></h1>
									<p class="message"><?php echo $slider_message; ?>
									<br>
									<br>
									<?php if($slider_link) {?>
									<a style="" class="primary-link" target="<?php echo $slider_link['target'] ?>" href="<?php echo $slider_link['url'] ?>"><?php echo $slider_link['title'] ?></a>
									<?php } ?>

									</p>

									<p class="mobile-message">
									<?php if($slider_link) {?>
									<a style="" class="primary-link" target="<?php echo $slider_link['target'] ?>" href="<?php echo $slider_link['url'] ?>"><?php echo $slider_link['title'] ?></a>
									<?php } ?>
									</p>
									
								  </div>
							</div>
					    </div>
				    <?php endwhile; ?>
				<?php endif; ?>
				</div>
			 <?php echo $menutemplate; ?>
			</div>

			<!--Slider Ends-->

			<?php get_template_part("/template-parts/shared-elements"); ?>
		</div>


		</main><!-- #main -->
	</section><!-- #primary -->




</div><!-- #content -->
<?php

get_footer();
