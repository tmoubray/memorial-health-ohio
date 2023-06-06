<?php
global $wp_query;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$crnt_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$crnt_page = (get_query_var('page')) ? get_query_var('page') : 1;

$cur_page = max( 1, $paged );
$per_page = 12;


$currentdate = new DateTime();
$crntYear = $currentdate->format("Y");
$crntMonth = $currentdate->format("m");
$crntDay = $currentdate->format("d");
$today = $currentdate->format("F jS, Y");
$today = getdate();
// $the_query = new WP_Query(array(
//   'posts_per_page'=> $per_page,
//   'post_status' => 'publish',
//   'post_type'=>'classes_events',
//   'paged' => $paged,
//   'order'				=> 'desc',
//   'orderby'			=> 'date',
//   'date_query' => array(
//     array(
//       'year'  => $today['year'],
//       'month' => $today['mon'],
//       'day'   => $today['mday'],
//     ),
//   ),
// ));

$the_query = new WP_Query(array(
  'posts_per_page'=> $per_page,
  'post_status' => 'publish',
  'post_type'=>'classes_events',
  'paged' => $paged,
  'meta_key' => 'date',
  'meta_value'   => date( "Ymd" ),
  'meta_compare' => '>=',
));

$sorted_results = array();
$class_types = get_terms( array( 'post_types' => 'classes_events', 'taxonomy' => 'Genres', 'hide_empty' => false) );
$class_names = array();

while ($the_query->have_posts()):
  $the_query->the_post();
  $id = get_the_ID();
  $meta = get_post_meta($id);
  $class_name = get_field("name", $id);
 
  $class_names[get_the_id()] = $class_name;

  if ($meta) {
    $key = strtolower("{$meta["date"][0]} {$meta["name"][0]}");
    if ($key) {
      $sorted_results[$key] = $id;
    }
  }
endwhile;

$class_names = array_unique($class_names,SORT_REGULAR);




ksort($sorted_results);

$ids = array();

foreach ($sorted_results as $id) {
  $ids[] = $id;
}

$the_other_query = new WP_Query(array(
  'posts_per_page'=> 12,
  'post_status' => 'publish',
  'post_type'=>'classes_events',
  'paged' => $paged,
  'meta_key'      => 'date',
  'meta_value'   => date( "Ymd" ),
  'meta_compare' => '>=',
  'orderby'     => 'meta_value',
  'order'       => 'ASC',
  'paged' => $paged
));




if(!empty($_GET['open_search_term']) && isset($_GET['open_search_term'])){
  $searchVal = $_GET['open_search_term'];
}else{
  $searchVal = '';
}

if(!empty($_GET['class_name']) && isset($_GET['class_name'])){
  $class_name_select = $_GET['class_name'];
}else{
  $class_name_select = '';
}



if(!empty($_GET['class_type']) && isset($_GET['class_type'])){
  $class_type_select = $_GET['class_type'];
}else{
  $class_type_select = '';
}


// echo '<pre>';
//   print_r($the_query->request);
// echo '</pre>';
?>

  <div class="row search-panel">
    <span class="search-form-instruct">Filter results</span>

    <form class="form-inline my-2 my-lg-0" id="primary-class-event-search">
      <div class="dropdown class-search">
      
        <select class="form-select primary-class-event-search-class class-name-filter" id="general-search"  aria-label="Default select example">
          <option value="" selected>Filter by Class Name</option>
          <?php foreach($class_names as $p => $w): ?>
            <option class="" value="<?php echo $w ?>" <?php  echo ($w == $class_name_select) ? 'selected' : ''; ?>><?php echo $w ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="dropdown class-search">
      

        <select class="form-select primary-class-event-search-type class-type-filter" id="general-search"  aria-label="Default select example">
          <option value="" selected>Filter by Class Type</option>
          <?php foreach( $class_types as $category ): 
            ?>
          <option class="" value="<?php echo $category->term_id; ?>" <?php  echo ($category == $class_type_select) ? 'selected' : ''; ?>><?php echo $category->name; ?></option>
          <?php endforeach; ?>
        </select>


      </div>

    
      <div class="dropdown" id="class_eve_search_dropdown">
        <!-- <button class="btn btn-secondary dropdown-toggle" id="locations-search" type="button" id="dropdownMenuButtonTypeSortLocation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span id="locations-class-search-button">All Locations</span>
        </button> -->
        <!-- <input type="text" placeholder="All Locations" name="locations-search-ce" data-filter-type="locations" id="locations_searchce" list="dropdownMenuButtonTypeSortLocation"> -->

        <input class="form-control mr-sm-2 classevent-location-search" data-filter-type="locations" type="search" id="classs_general_search" value="<?php echo $searchVal; ?>" placeholder="Search Classes & Events" aria-label="Search" autofocus>
        <!-- <input type="text" placeholder="All Locations" name="locations-search-ce" data-filter-type="locations" id="locations_searchce"> -->
          <?php
            $locationArgs = array(
              'post_type' 		     => 'locations',
              'post_status' 		     => 'publish',
              'posts_per_page' 	     => -1,
              'ignore_sticky_posts'    => true,              
              'cache_results'          => false,
              'no_found_rows' 		 => false,
              'update_post_meta_cache' => false,
              'update_post_term_cache' => false,
              'orderby'	=> 'date',
              'order'  => 'DESC'
            );
            $location_query = new WP_Query($locationArgs);
            if ( $location_query->have_posts() ) {
          ?>
          <datalist id="dropdownMenuButtonTypeSortLocation" aria-labelledby="dropdownMenuButtonTypeSortLocation">
            <?php
              $locationArr = array();
              while ( $location_query->have_posts() ){
                $location_query->the_post();
                $locationId = get_the_ID();
                $locationTitle = get_the_title($locationId);
                $locationAddress = get_the_title($locationId);

                if( have_rows('contact_information',$locationId) ):
                  while( have_rows('contact_information',$locationId) ): the_row();
                    $locationArr[] = get_sub_field('street_address');
                  endwhile;
                endif;
              }

              if(!empty($locationArr)){
                foreach($locationArr as $locationData){
                  ?>
                  <option><?php echo $locationData; ?></option>
                  <?php
                }
              }              

            ?>            
          </datalist>
          <?php }
          ?>
      </div>

      <a class="primary-link ml-auto mr-3 primary-class-event-search">Search</a>
    </form>
  </div>


<div class="row results">
  <?php
  // echo "<pre>";
  //     print_r($_REQUEST);
  // echo "</pre>";
  $counts = $the_other_query->post_count;
  $founds = $the_other_query->found_posts;
  $maxnums = $the_other_query->max_num_pages;
  $num_pages = ceil( $maxnums / $per_page );
  if($paged > 1){
    $counts = $founds - $counts;
  }
  ?> 
  <span id="ce_search_counts">Showing <span id="current_found_counts"><?php echo $counts; ?></span> of <?php echo $founds; ?> results</span>
  <hr>

</div>

<div id="search-container" class="class-event-main">
<div class="row" id="main-search">
<?php while ($the_other_query->have_posts()) : $the_other_query->the_post();
if (get_field("image")) {
  $image = get_field("image");
}else{
  $image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-default.png";
}
?>
  <div class="col-12 col-lg-3 col-md-6">


        <a href="<?php the_permalink(); ?>">
        <div class="card" style="width: 18rem;" id="class-event-card" onclick="class_events_search_modal(this);" data-event-id="<?php echo get_the_id(); ?>">

          <img class="card-img-top" src="<?php echo $image;?>" alt="Card image cap">
          <div class="card-body">


            <h5 class="card-title" ><?php echo get_field("name");?></h5>
            <hr>
            <div class="class-date"><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-calendar.svg"?>"><?php echo get_field("date");?></div>
            <div>
              <img class="class-times" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-time.svg"?>">

              <?php
                // Check rows exists.
                if( have_rows('class_times') ):
                    // Loop through rows.
                    while( have_rows('class_times') ) : the_row();

                      $start_time = get_sub_field('start_time');
                      $class_permalink = get_permalink();

                      //echo "<a  class='service-bubble' href='$permalink'>$start_time</a>";
                      echo "<a href='$class_permalink' class='service-bubble' href='javascript:void(0);'>$start_time</a>";
                        // Do something...

                    // End loop.
                    endwhile;

                // No value.
                else :
                    // Do something...
                endif;
              ?>

            </div>



            <div class="class-location">
              <div class="location-icon"><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/pin.svg"?>"></div>




              <?php

  						$locations = get_field('related_location');
  						if( $locations ): ?>
  					         <?php
  										$permalink = get_permalink( $locations );
  										$title = get_sub_field( $locations );
  										$contact_information = get_field( 'contact_information', $locations);
  										?>
  									<?php echo "<div>" . $contact_information["street_address"] . "</div>";?>
  						<?php endif; ?>
            </div>



            <a href="<?php echo $class_permalink ?>" type="button" class="btn btn-primary btn-lg btn-block">
              <?php if (get_field("cost"))
              { echo "$" . get_field("cost");
              }else{
                echo "FREE";}; ?>

            </a>



          </div>
        </div>
      </a>


</div>

<?php endwhile; ?>

</div>
</div>

<div class="col-12">
<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>



<?php if ( have_posts() ) : ?>
<div id="everyone">
<div class="col-12 pagination-nav-container">

<nav>
<?php $big = 999999999; // need an unlikely integer
echo paginate_links( array(
  'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
  'format' => '?paged=%#%',
  'current' => max( 1, get_query_var('paged') ),
  'total' => $the_other_query->max_num_pages,
  'prev_text' => '<i class="fas fa-angle-left"></i> Prev',
  'next_text' => 'Next <i class="fas fa-angle-right"></i>'
));

wp_reset_postdata();?>
</nav>


  <?php endif; ?>
</div><!-- #content -->
</div>



<script>
jQuery(function($) {

    $('#content').on('click', '.pagination-nav-container a', function(e){

      e.preventDefault();
      var link = $(this).attr('href');
      console.log(link);

          $("#search-container").html('');

          $("#everyone").load(link + ' #everyone', function() {
              $("#everyone").fadeIn(500);
          });

          $('#search-container').load(link + ' #search-container', function(response, status, xhr) {              
              var foundIds = $(response).find('#class-event-card').length;
              console.log(foundIds , '<----');
              if(foundIds){
                $('#current_found_counts').html(foundIds);
              }
              $("#search-container").fadeIn("slow", function(){
                $('.phone-number').text(function(i, text) {
                    console.log(text,'<--ds');
                    return text.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2 $3');
                });

              });

          });

    });


});

</script>
