<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
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
 					 <div class="col-4">
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
			 <div class="row news-article-main">
			 <div class="news-article-top">
				 <div class="col-12 d-flex justify-content-center">
 				 <span id="date-read-time"><?php echo get_the_date(); ?> | <?php echo get_field("read_time");?> Minute Read</span>
				</div>
				<div class="col-12 d-flex justify-content-center">
				<span id="article-title"><?php echo the_title(); ?></span>
			 </div>
			 <div class="col-12">
			 	<?php if (!$sharing_disabled[0]) {?>
				 <div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button" style="margin-top:0px;">
           <span class="article-share">Share</span>
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
	 
		 <div class="news-content-main">
			<div class="news-content-sec">
				<span id="intro"><?php echo get_field("intro"); ?></span>
			</div>
			<div class="news-img-sec">
				<?php if (get_field("hero_image")) {?>
			 <img src="<?php echo get_field("hero_image");?>" border="0" alt="Share" >
			<?php } ?>

			</div>
			<div class="news-content-sec">
			  <?php echo get_field("body"); ?>
			</div>

			<!--Downloadable Resources Only-->
			<!-- <div class="downloadable-n">
				<h2>Downloadable materials</h2>
				<ul>
					<li><a href="#"><span><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/downloadable.svg";?>" alt=""></span> Brochure (PDF)</a></li>
					<li><a href="#"><span><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/downloadable.svg";?>" alt=""></span> Packet (PDF)</a></li>
					<li><a href="#"><span><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/downloadable.svg";?>" alt=""></span> Full Evaluation Results (PDF)</a></li>
				</ul>
			</div>

			<div class="news-content-main">
				<strong>Lorem ipsum dolor sit amet, consectetur.</strong>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sitamet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
				<span class="img-on-content"><img src="" alt=""></span>
				<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sitamet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
				</p>
			</div> -->

			<div class="quote-container-news">
				<?php get_template_part("/template-parts/shared-elements"); ?>
			</div>

			<!-- <div class="news-content-main">
				<strong>Lorem ipsum dolor sit amet, consectetur.</strong>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sitamet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
				<div class="news-video">video</div>
			</div> -->

			<!-- <div class="news-content-main">
				<h2>Lorem ipsum dolor sit amet</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sitamet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
				<div class="row">
				 <div class="col-6">
				 <div class="img-sec-bottom"><img src="http://via.placeholder.com/480x270" alt=""></div>
				 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sitamet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
				 </div>
				 <div class="col-6">
				 <div class="img-sec-bottom"><img src="http://via.placeholder.com/480x270" alt=""></div>
				 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sitamet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
				 </div>
				</div>
			</div>

			<div class="helpful-resources-n">
				<h2>Helpful resources</h2>
				<ul>
					<li><a href="#">Where We Agree</a></li>
					<li><a href="#">Where We Differ</a></li>
					<li><a href="#">Bottom Line</a></li>
				</ul>
			</div> -->
			
			
		 </div>

		  
		</div>

 		 </div>



		

 		 <?php 
 		 $related_articles = get_field('related_articles');
 		 if ($related_articles) {
 		 ?>


		 <div class="container-fluid gray-back newsroom">

				<div class="row might-also-like">


					<div class="col-12">
						<div id="intro">You Might Also Like</div>

            <?php
            
            $index = 0;
            ?>
                <?php foreach( $related_articles as $article ):
                  $title = get_the_title( $article->ID );
                  $intro = get_field('intro', $article->ID );
                  $read_time = get_field('read_time', $article->ID );
                  $hero_image = get_the_post_thumbnail_url($article->ID);
                  $pub_date = get_the_date('',$article->ID);
                  $link = get_the_permalink($article->ID);
                  echo '<div class="row post-teaser also-like-card"><ul class="list-unstyled">
          		          <li class="media">
          		            <div class="media-body">
                            <div  id="date-read-time">'.$pub_date.' | '.$read_time.' Minute Read</div>
          		              <h5 class="post-title" ><a href="'.$link.'">'.$title.'</a></h5><p>'
                             . $intro .
          		            '</p></div>
          		           <img src="'.$hero_image.'">
          		        </ul></div>

                      <div class="row post-teaser d-lg-none also-like-card-mobile"><ul class="list-unstyled">
                        <li class="media">
                          <img src="'.$hero_image.'">
                          <div class="media-body">
                            <div class="post-title"><a href="'.$link.'">$title</a></div>
                            <div  id="date-read-time">$the_date | $read_time Minute Read</div>
                          </div>

                      </ul>
                    </div>


                      ';
                 endforeach;

               ?>

					</div>




				</div>

			</div>

			<?php } ?>






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
