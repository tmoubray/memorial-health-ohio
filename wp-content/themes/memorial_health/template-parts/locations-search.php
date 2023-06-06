<?php
global $wp_query;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$crnt_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$crnt_page = (get_query_var('page')) ? get_query_var('page') : 1;
$the_query = new WP_Query(array(
                            'posts_per_page'=> 10,
                            'post_type'=>'locations',
                            'post_status' => array('publish'),
                            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                            'orderby' => 'title',
                            'order' =>'ASC',
                            'meta_query'  => array(
                              'relation'    => 'AND',
                              array(
                                'key'     => 'hide_from_locations_and_search',
                                'value'     => '0',
                                'compare'   => '=',
                              ),
                            ),
                            )
                         );


// echo '<pre>';
//   print_r($the_query);
// echo '</pre>';

?>
  <div class="row search-panel">
    <span class="search-form-instruct">I'm looking for</span>

    <form class="form-inline my-2 my-lg-0" id="primary-location-search">
      <i class="fa fa-search icon search-icon"></i>
      <?php 
        if(!empty($_GET['location_search']) && isset($_GET['location_search'])){
          $searchVal = $_GET['location_search'];
          echo '<script>jQuery(document).ready(function(){ jQuery("#location_search_submit").trigger( "click" );});</script>';          
        }
        else{
          $searchVal = '';
        }
      ?>
      <input class="form-control mr-sm-2 location-criteria-search" value="<?php echo $searchVal; ?>" type="search" placeholder="Search name, service, speciality or condition" aria-label="Search">
      <span class="search-form-instruct">near</span>
      <i class="fas fa-map-marker-alt map-icon"></i>
      <input class="form-control mr-sm-2 locations-location-search" id="location_search" type="search" placeholder="Search by location" aria-label="Search">
      <!-- <input type="submit" class="primary-link"></input> -->
      <button type="submit" id="location_search_submit" class="primary-link" >Search</button>
    </form>
  </div>




<div class="row results">
   <?php
    $counts = $the_query->post_count;
    $founds = $the_query->found_posts;
    $maxnums = $the_query->max_num_pages;
    
   ?> 
  <span>Showing <span id="location_search_counts"><?php echo $counts; ?></span> of <?php echo $founds; ?> results</span>
  <hr>
</div>



<div id="search-container">
<div class="row" id="main-search">


<?php while ($the_query->have_posts()) : $the_query->the_post();
  $postId = get_the_ID();
  $imageset = get_field("image",$postId);
  $title = get_the_title( $postId );
  //if(!empty($imageset) && $imageset !== ''){
// KK - UNCOMMENT BELOW
/*
  if (@getimagesize($imageset)) {
      $imagePath = $imageset;
  } else {
      $imagePath = get_template_directory_uri().'/inc/assets/images/MemorialHospital-default.jpg';
  }
*/
// KK - UNCOMMENT ABOVE
// KK - DELETE LINE BELOW
                    $imagePath = $imageset;
// KK - DELETE LINE ABOVE

  ?>
  <div class="col-lg-6 col-sm-12">
      <div class="card wide-card-container">
        <a class="card-link" title="<?php echo $title; ?>"  href="<?php the_permalink();?>" >
          <div class="card-horizontal">
              <div class="img-square-wrapper">
                  <img class="location-image" src="<?php echo $imagePath; ?>" alt="Card image cap">
              </div>
              <div class="card-body">
                <?php if (get_field( 'logo', $postId )) {?>
                <a class="card-link" title="service logo"  href="<?php the_permalink();?>" >
                  <span class="logo-container"><img class="service-logo" alt="service logo" src="<?php echo get_field( 'logo', $postId ); ?>"></span>
                </a>
              <?php }else{ ?>

                <a class="card-link" title="service logo" href="<?php echo get_permalink($postId) ?>" style="font-size:1.2rem;text-transform:uppercase;">
                    <span><?php echo get_field( 'location_name', $postId ); ?></span>
                 </a>
              <?php } ?>


                  <?php if( have_rows('contact_information') ): ?>
                    <?php while( have_rows('contact_information') ): the_row(); ?>

                  <p class="card-text location-address"><?php  the_sub_field('street_address'); ?></p>
                  <?php $phoneNum = get_sub_field( 'phone', $postId ); 
                    if(!empty($phoneNum)){
                      ?>
                      <a href="tel:<?php the_sub_field('phone');?>" class="location-phone phone-number"><?php the_sub_field('phone'); ?></a>
                      <?php
                    }
                  ?>                	

                  <?php endwhile; ?>
                <?php endif; ?>

              </div>
          </div>
        </a>
      </div>
  </div>
  <?php  
  
  //} 
 
 endwhile; ?>
</div>
</div>



<div class="col-12">
<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

<?php if ( have_posts() ) : ?>
<div id="other">
<div class="col-12 pagination-nav-container">

<!-- <nav> -->

<?php 

//memorial_health_cstm_pagination($the_query->max_num_pages);

$big = 999999999; // need an unlikely integer
echo paginate_links( array(
  'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
  'format' => '?paged=%#%',
  'current' => max( 1, get_query_var('paged') ),
  'total' => $the_query->max_num_pages,
  'next_text' => 'Next <i class="fas fa-angle-right"></i> <a class="next page-numbers cstm-last-link" href="'.site_url('locations').'/page/'.$the_query->max_num_pages.'/">Last <i class="fas fa-angle-right"></i></a>'
) );



// $big = 999999999; // need an unlikely integer
// echo paginate_links(
// array(
//   'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
//   'format' => '?page/%#%',
//   'current' => max( 1, get_query_var('paged') ),
//   'total' => $the_query->max_num_pages,
//   //'type' => 'list',
//   //'show_all' => true,
//   'end_size' => 1,
//   'mid_size' => 1,
//   'prev_text' => __('<i class="fas fa-angle-left"></i> Prev'),
//   'next_text' => __('Next <i class="fas fa-angle-right"></i> <a class="next page-numbers cstm-last-link" href="'.site_url('locations').'/page/'.$the_query->max_num_pages.'/">Last <i class="fas fa-angle-right"></i></a>'),
// ));
wp_reset_postdata();?>
<!-- </nav> -->

<?php
// if (function_exists("custom_dsnew_pagination")) {        
//    custom_dsnew_pagination($the_query->max_num_pages);
// }
?>

</div><!-- #content -->
</div>

<?php endif; ?>

<script>
jQuery(function($) {
      $('#content').on('click', '.pagination-nav-container a', function(e){

          e.preventDefault();
          var link = $(this).attr('href');

              $("#search-container").css("visibility", "hidden");

              $("#other").load(link + ' #other', function() {

                  $("#other").fadeIn(500);
              });

              $('#search-container').load(link + ' #search-container', function(response, status, xhr) {
                //var foundIds = $(response).find('#main-search.wide-card-container').length;
                var foundIds = $('#main-search').find('.wide-card-container').length;
                console.log(foundIds , '<----');
                if(foundIds){
                  $('.results').find('#location_search_counts').html(foundIds);
                }

                $("#search-container").css("visibility", "visible");

              });

              if($("#all-locations-header").length){
                $('html, body').animate({
                    scrollTop: $("#all-locations-header").offset().top
                  }, 2000);
              }

      });

      $(document)
        .ajaxStart(function () {
          $(".lds-spinner").show();
        })
        .ajaxStop(function () {
          $(".lds-spinner").hide();
        });
      
      var foundIdstwo = $('#main-search').find('.wide-card-container').length;
      console.log(foundIdstwo , '<----');
      if(foundIdstwo){
        $('.results').find('#location_search_counts').html(foundIdstwo);
      }

  });


</script>
