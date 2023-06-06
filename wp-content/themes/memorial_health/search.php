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
global $wp_query;
get_header(); ?>
<div id="content" class="site-content">
	<?php  custom_breadcrumbs(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main single-service" role="main">


			<div class="container-fluid">

				<div class="row title">

					<div id="search-container">

					<div class="col-12">


						<?php
						if ( have_posts() ) : 
							$hidden = 0;
									while ( have_posts() ) : the_post();

										if ( 'locations' == get_post_type( get_the_ID() )) {
											$hide_from_locations_and_search = get_field('hide_from_locations_and_search', get_the_ID());
									
											if ($hide_from_locations_and_search) {
												$hidden++;
											}
										}

									endwhile;
							?>
							<header class="page-header">
								<h1 class="page-title"><?php echo $wp_query->found_posts - $hidden; ?> <?php printf( esc_html__( 'Search Results for: %s', 'wp-bootstrap-starter' ), '<span>"' . get_search_query() . '"</span>' ); ?></h1>
							</header><!-- .page-header -->

							<hr>

							<div class="row results main-search-results">
									<?php
									
								    $counts = $wp_query->post_count - $hidden;
								    $founds = $wp_query->found_posts - $hidden;
								    $maxnums = $wp_query->max_num_pages - $hidden;	
								    	

								    						    
								   	?> 
								  	<span>Showing <?php echo $counts; ?> of <?php echo $founds ?> results</span>
									
									<hr>
							</div>



							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								if ( 'locations' == get_post_type( get_the_ID() )) {

									$hide_from_locations_and_search = get_field('hide_from_locations_and_search', get_the_ID());
						
									if (!$hide_from_locations_and_search) {
										get_template_part( 'template-parts/content', 'search' );
									}

								}else{
									get_template_part( 'template-parts/content', 'search' );
								}

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								

							endwhile;


						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>


						<?php if ( have_posts() ) : ?>
						<div id="everyone">
						<div class="col-12 pagination-nav-container">

						<nav>
						<?php $big = 999999999; // need an unlikely integer
						echo paginate_links( array(
						 'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
						 'format' => '?paged=%#%',
						 'current' => max( 1, get_query_var('paged') ),
						 'total' => $wp_query->max_num_pages,
						  'next_text' => 'Next <i class="fas fa-angle-right"></i>'
						) );

						wp_reset_postdata();?>
						</nav>


						  <?php endif; ?>
						</div><!-- #content -->
						</div>


					</div>

				 </div>

				</div>

			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

</div><!-- #content -->


<?php get_footer();?>


<script>

$('#content').on('click', '.pagination-nav-container a', function(e){

	e.preventDefault();
	var link = $(this).attr('href');
	console.log(link);

			$("#search-container").html('');

			$("#everyone").load(link + ' #everyone', function() {

					$("#everyone").fadeIn(500);
			});

			$('#search-container').load(link + ' #search-container', function() {

					$("#search-container").fadeIn("slow", function(){
						$('.phone-number').text(function(i, text) {
								return text.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2 $3');
						});

					});

			});

});




$(document)
.ajaxStart(function () {
$(".loader").show();
})
.ajaxStop(function () {
$(".loader").hide();
});

</script>
