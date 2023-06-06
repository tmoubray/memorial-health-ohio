<?php

$the_query = new WP_Query( array('posts_per_page'=> 12,
                              'post_type'=>'doctors',
                              'order'   => 'ASC',
                              'meta_key'      => 'last_name',
                              'orderby'     => 'meta_value',
                              'paged' => get_query_var('paged') ? get_query_var('paged') : 1)
                         );

?>



  
  <div class="row search-panel">
    <span class="search-form-instruct">I'm looking for</span>

    <form class="form-inline my-2 my-lg-0" id="primary-dr-search">
      <i class="fa fa-search icon search-icon"></i>
      <?php 
        if(!empty($_GET['general_term']) && isset($_GET['general_term'])){
          $searchVal = $_GET['general_term'];

        }
        else{
          $searchVal = '';
        }


       if(!empty($_GET['accepting_new_patients']) && isset($_GET['accepting_new_patients'])){
          if($_GET['accepting_new_patients'] === 'true') {
            $ap = "checked";
           
          }
        }
        else{
          $ap = '';

        }

        if(!empty($_GET['accepting_telehealth']) && isset($_GET['accepting_telehealth'])){
          if($_GET['accepting_telehealth'] === 'true') {
            $at = "checked";
          }
        }
        else{
          $at = '';
        }


        if(!empty($_GET['current_location']) && isset($_GET['current_location'])){
          $current_location = $_GET['current_location'];
        }
        else{
          $current_location = '';
        }

        if((!empty($_GET['general_term']) && isset($_GET['general_term'])) || (!empty($_GET['current_location']) && isset($_GET['current_location']))){
        echo '<script>jQuery(document).ready(function(){ jQuery("#doc_loc_search_submit").trigger( "click" );});</script>';
        }

      ?>

      <input class="form-control mr-sm-2 doctor-criteria-search" value="<?php echo $searchVal; ?>" type="search" placeholder="Search name, service, speciality or condition" aria-label="Search">
      <span class="search-form-instruct">near</span>
      <i class="fas fa-map-marker-alt map-icon"></i>
      <input class="form-control mr-sm-2 doctor-location-search" value="<?php echo $current_location; ?>" type="search" id="doc_loc_search" value="" placeholder="Search by location" aria-label="Search">
      <input type="hidden" name="post_type_chosen_search" id="post_type_chosen_search" value="doctors">
      <button type="submit" form="primary-dr-search" class="primary-link" data-posttype="doctors" id="doc_loc_search_submit" value="Submit">Search</button>
 
      <div class="form-check" >
    <input type="checkbox" class="form-check-input" id="exampleCheck1" <?php echo $ap ?> >
    <label class="form-check-label" style="padding-left:5px" for="exampleCheck1">Accepts New Patients</label>
    <br>
    <input type="checkbox" style="margin-left:1rem;" class="form-check-input" id="exampleCheck2" <?php echo $at ?>>
    <label class="form-check-label" style="padding-left:5px" for="exampleCheck2">Accepts Telehealth</label>
    </div>


    </form>
  </div>




<div class="row results">
  <?php
    $counts = $the_query->post_count;
    $founds = $the_query->found_posts;
    $maxnums = $the_query->max_num_pages;

    
   ?> 
  <span>Showing <span id="current_found_countsdictor"><?php echo $counts; ?></span> of <?php echo $founds; ?> results</span>
  <hr>
</div>


<div class="row">
<?php echo get_template_part('/template-parts/alpha-search');?>
</div>



<div id="search-container" class="find-doctor-main">

<div class="row" id="main-search" style="">

<?php while ($the_query->have_posts()) : $the_query->the_post();




  if (get_field("profile_image")) {
    $profile_image = get_field("profile_image");
  }else{
    if(get_field("sex") == "female") {
      $profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
    }else{
      $profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
    }
  }

?>


  <div class="col-6 col-lg-3 col-sm-6" id="doctor-grid">
    <a href="<?php the_permalink();?>" class="doctor-card-link" title="View profile">
        <div class="card" style="width: 18rem;" id="doctor-card">
          
          <div style="position:relative;display:inline-block;transition: transform 150ms ease-in-out;"> 
            <img class="card-img-top" src="<?php echo $profile_image;?>" alt="<?php  the_title(); ?>" width="286" height="199.5">
          <?php if (get_field("accepting_new_patients") == 'yes') {?>  
         <svg version="1.1" style="position:absolute;bottom:-2px;left:0;width:10rem;height:25px;width:175px;" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 200 25" style="enable-background:new 0 0 200 25;" xml:space="preserve"> <style type="text/css"> .st0{fill:#752F89;} .st1{fill:#FFFFFF;} </style> <rect class="st0" width="200" height="25"/> <g> <path class="st1" d="M5.1,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4H5.1V7.3z M7.2,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M12.1,7.3c0.7-0.1,1.5-0.2,2.3-0.2c1.2,0,2.2,0.2,2.9,0.8c0.7,0.6,0.8,1.3,0.8,2.2c0,1.2-0.6,2.2-1.7,2.7v0 c0.7,0.3,1.1,1,1.3,2.1c0.2,1.2,0.5,2.5,0.7,2.9h-2.2c-0.1-0.3-0.4-1.4-0.5-2.6c-0.2-1.3-0.5-1.7-1.2-1.7h-0.3v4.3h-2.1V7.3z M14.2,12h0.4c0.9,0,1.4-0.7,1.4-1.7c0-0.9-0.4-1.6-1.3-1.6c-0.2,0-0.4,0-0.5,0.1V12z"/> <path class="st1" d="M21.6,15.4l-0.5,2.5h-2l2.3-10.8h2.5L26,17.9h-2l-0.5-2.5H21.6z M23.3,13.8L23,11.5c-0.1-0.7-0.3-1.7-0.4-2.4 h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H23.3z"/> <path class="st1" d="M32,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3c0-4.1,2.3-5.7,4.4-5.7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L32,17.7z"/> <path class="st1" d="M34.6,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M41.6,7.1v10.8h-2.1V7.1H41.6z"/> <path class="st1" d="M48.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C42.8,8.6,45,7,47.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L48.5,17.7z"/> <path class="st1" d="M54,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5H54V13.2z"/> <path class="st1" d="M60,15.4l-0.5,2.5h-2l2.3-10.8h2.5l2.1,10.8h-2L62,15.4H60z M61.8,13.8l-0.4-2.3c-0.1-0.7-0.3-1.7-0.4-2.4h0 c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H61.8z"/> <path class="st1" d="M70.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C64.8,8.6,67,7,69.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L70.5,17.7z"/> <path class="st1" d="M76.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C70.8,8.6,73,7,75.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L76.5,17.7z"/> <path class="st1" d="M82.1,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M83.6,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M85.7,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M92.2,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M99.2,7.1v10.8h-2.1V7.1H99.2z"/> <path class="st1" d="M100.9,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H100.9z"/> <path class="st1" d="M114.9,17.6c-0.5,0.2-1.5,0.4-2.2,0.4c-1.2,0-2.2-0.4-2.9-1.1c-0.9-0.9-1.4-2.5-1.4-4.4c0-3.9,2.3-5.6,4.6-5.6 c0.8,0,1.4,0.2,1.8,0.3l-0.4,1.8c-0.3-0.1-0.7-0.2-1.2-0.2c-1.4,0-2.6,1-2.6,3.8c0,2.6,1,3.5,2,3.5c0.2,0,0.3,0,0.4,0v-2.6h-1v-1.7 h2.9V17.6z"/> <path class="st1" d="M119,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H119z"/> <path class="st1" d="M131.7,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M134.5,17.9l-1.8-10.8h2.2l0.5,4.3c0.1,1.2,0.2,2.5,0.4,3.8h0c0.1-1.3,0.4-2.5,0.6-3.8l0.8-4.3h1.7l0.7,4.3 c0.2,1.2,0.4,2.4,0.5,3.8h0c0.1-1.4,0.3-2.6,0.4-3.8l0.5-4.3h2l-1.9,10.8H139l-0.6-3.5c-0.2-1-0.3-2.2-0.5-3.6h0 c-0.2,1.3-0.4,2.5-0.6,3.6l-0.7,3.5H134.5z"/> <path class="st1" d="M146.7,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M148.8,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M155.2,15.4l-0.5,2.5h-2L155,7.1h2.5l2.1,10.8h-2l-0.5-2.5H155.2z M156.9,13.8l-0.4-2.3 c-0.1-0.7-0.3-1.7-0.4-2.4h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H156.9z"/> <path class="st1" d="M161.3,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M168.3,7.1v10.8h-2.1V7.1H168.3z"/> <path class="st1" d="M174.5,13.2h-2.5v2.9h2.8v1.8H170V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M176.1,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H176.1z"/> <path class="st1" d="M185.4,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M190.2,15.8c0.4,0.2,1.2,0.4,1.8,0.4c1,0,1.5-0.5,1.5-1.2c0-0.8-0.5-1.2-1.4-1.8c-1.5-0.9-2-2-2-3 c0-1.7,1.2-3.2,3.4-3.2c0.7,0,1.4,0.2,1.7,0.4l-0.3,1.8c-0.3-0.2-0.8-0.4-1.4-0.4c-0.9,0-1.3,0.5-1.3,1.1c0,0.6,0.3,1,1.5,1.7 c1.4,0.9,2,2,2,3.1c0,2-1.5,3.3-3.6,3.3c-0.9,0-1.7-0.2-2.1-0.4L190.2,15.8z"/> </g> </svg>
            <?php } ?>
          </div>
          

          <div class="card-body">
            <h3 class="card-title"><?php the_title(); ?></h3>
            <hr>
            <p class="card-text">


              <?php
              $services = get_field('related_services');
              $index = 0;
              if( $services ): ?>

                  <?php foreach( $services as $service ):
                      $index = $index + 1;
                      $permalink = get_permalink( $service->ID );
                      $title = get_the_title( $service->ID );
                      $custom_field = get_field( 'field_name', $service->ID );

                      ?>
                      <?php if ($index <= 2) {?>
                          <a  class="service-bubble" href="<?php echo $permalink?>"><?php echo $title ?></a>
                      <?php }?>
                      <?php if (count($services) > 2 && $index == 3) {?>
                        <a  class="service-bubble" href="<?php echo the_permalink()?>">+ <?php echo count($services) - 2 ?></a>
                      <?php }?>




                  <?php endforeach; ?>

              <?php endif; ?>

            </p>
            <?php
              $main_phone_number = trim(get_field("main_phone_number"));
              if (!empty($main_phone_number)) {
            ?>
            <span class="phone-number-container"><img alt="cell icon" src="<?php echo get_bloginfo( 'template_directory' ) . '/inc/assets/images/class-cell-phone.svg';?>"> <span class="call">Call</span> <a href="tel:<?php echo get_field("main_phone_number")?>" class="phone-number"><?php echo get_field("main_phone_number")?></a></span>
            <?php } ?>
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

<!-- <nav> -->
<?php 
$big = 999999999; // need an unlikely integer
echo paginate_links( array(
 'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
 'format' => '?paged=%#%',
 'current' => max( 1, get_query_var('paged') ),
 'total' => $the_query->max_num_pages,
  'next_text' => 'Next <i class="fas fa-angle-right"></i>'
) );

wp_reset_postdata();?>
<!-- </nav> -->

<?php
// if (function_exists("custom_dsnew_pagination")) {        
//    custom_dsnew_pagination($the_query->max_num_pages);
// }
?>

  <?php endif; ?>
</div><!-- #content -->
</div>

<script>
jQuery(function($) {
    $('#content').on('click', '.pagination-nav-container a', function(e){
        e.preventDefault();
        var link = $(this).attr('href');


            $("#search-container").css("visibility", "hidden");

            $("#everyone").load(link + ' #everyone', function() {

                $("#everyone").fadeIn(500);
            });

            $('#search-container').load(link + ' #search-container', function(response, status, xhr) {
              var foundIds = $(response).find('#doctor-grid').length;
 
              if(foundIds){
                $('#current_found_countsdictor').html(foundIds);
              }
                $("#search-container").css("visibility", "visible");
                  $('.phone-number').text(function(i, text) {
                      return text.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2 $3');
                  });
            });

            if($(".search-panel").length){
                $('html, body').animate({
                    scrollTop: $(".search-panel").offset().top
                  }, 2000);
            }


    });






        $(document).ajaxStart(function () {
          $(".lds-spinner").show();
        }).ajaxStop(function () {
          $(".lds-spinner").hide();
        });





    $(".alpha-filter .filter").click(function() {
      $(".current-filter").removeClass("current-filter");
      $(this).addClass("current-filter");
      var search_range = $(this).attr("data-search-alpha");
      var servocebubble = '';
        $.ajax({
        type: "GET",
        url: "/wp-json/memorial/v2/doctors/alpha/?term=" + search_range + "/",
        error: function(xhr, statusText) { console.log("Fetch Error: "+statusText); },
        success: function(data){
          //Results count
          if (data.length > 0) {
            $('div.results').html('<span>Found ' + data.length + ' results</span>');
          }
          if (data.length == 0) {
            $('div.results').html('<span>Found 0 results</span>');
          }

          $("#main-search").html('');
          $(".lds-spinner").show();

          $(data).each(function(i, obj) {
  
            if(obj.profile_image) {
              var profile = obj.profile_image ;
            }else {
              var profile = '<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";?>';
            }
            var cell_icon = '<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-cell-phone.svg";?>';

            servocebubble = '';
            if(obj.services_data){
     
              $(obj.services_data).each(function(index, serviceobj) {                
                servocebubble += '<a class="service-bubble" id="'+serviceobj.serviceid+'" href="'+serviceobj.serviceLink+'">'+serviceobj.serviceTitle+'</a>';
              });
            }
            else{
              servocebubble = '';
            }

           if (obj.accepting_new_patients == "yes") {

          accepting_new_patients_flag = '<svg version="1.1" style="position:absolute;bottom:-2px;left:0;width:10rem;height:25px;width:175px;" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 200 25" style="enable-background:new 0 0 200 25;" xml:space="preserve"> <style type="text/css"> .st0{fill:#752F89;} .st1{fill:#FFFFFF;} </style> <rect class="st0" width="200" height="25"/> <g> <path class="st1" d="M5.1,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4H5.1V7.3z M7.2,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M12.1,7.3c0.7-0.1,1.5-0.2,2.3-0.2c1.2,0,2.2,0.2,2.9,0.8c0.7,0.6,0.8,1.3,0.8,2.2c0,1.2-0.6,2.2-1.7,2.7v0 c0.7,0.3,1.1,1,1.3,2.1c0.2,1.2,0.5,2.5,0.7,2.9h-2.2c-0.1-0.3-0.4-1.4-0.5-2.6c-0.2-1.3-0.5-1.7-1.2-1.7h-0.3v4.3h-2.1V7.3z M14.2,12h0.4c0.9,0,1.4-0.7,1.4-1.7c0-0.9-0.4-1.6-1.3-1.6c-0.2,0-0.4,0-0.5,0.1V12z"/> <path class="st1" d="M21.6,15.4l-0.5,2.5h-2l2.3-10.8h2.5L26,17.9h-2l-0.5-2.5H21.6z M23.3,13.8L23,11.5c-0.1-0.7-0.3-1.7-0.4-2.4 h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H23.3z"/> <path class="st1" d="M32,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3c0-4.1,2.3-5.7,4.4-5.7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L32,17.7z"/> <path class="st1" d="M34.6,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M41.6,7.1v10.8h-2.1V7.1H41.6z"/> <path class="st1" d="M48.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C42.8,8.6,45,7,47.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L48.5,17.7z"/> <path class="st1" d="M54,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5H54V13.2z"/> <path class="st1" d="M60,15.4l-0.5,2.5h-2l2.3-10.8h2.5l2.1,10.8h-2L62,15.4H60z M61.8,13.8l-0.4-2.3c-0.1-0.7-0.3-1.7-0.4-2.4h0 c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H61.8z"/> <path class="st1" d="M70.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C64.8,8.6,67,7,69.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L70.5,17.7z"/> <path class="st1" d="M76.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C70.8,8.6,73,7,75.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L76.5,17.7z"/> <path class="st1" d="M82.1,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M83.6,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M85.7,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M92.2,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M99.2,7.1v10.8h-2.1V7.1H99.2z"/> <path class="st1" d="M100.9,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H100.9z"/> <path class="st1" d="M114.9,17.6c-0.5,0.2-1.5,0.4-2.2,0.4c-1.2,0-2.2-0.4-2.9-1.1c-0.9-0.9-1.4-2.5-1.4-4.4c0-3.9,2.3-5.6,4.6-5.6 c0.8,0,1.4,0.2,1.8,0.3l-0.4,1.8c-0.3-0.1-0.7-0.2-1.2-0.2c-1.4,0-2.6,1-2.6,3.8c0,2.6,1,3.5,2,3.5c0.2,0,0.3,0,0.4,0v-2.6h-1v-1.7 h2.9V17.6z"/> <path class="st1" d="M119,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H119z"/> <path class="st1" d="M131.7,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M134.5,17.9l-1.8-10.8h2.2l0.5,4.3c0.1,1.2,0.2,2.5,0.4,3.8h0c0.1-1.3,0.4-2.5,0.6-3.8l0.8-4.3h1.7l0.7,4.3 c0.2,1.2,0.4,2.4,0.5,3.8h0c0.1-1.4,0.3-2.6,0.4-3.8l0.5-4.3h2l-1.9,10.8H139l-0.6-3.5c-0.2-1-0.3-2.2-0.5-3.6h0 c-0.2,1.3-0.4,2.5-0.6,3.6l-0.7,3.5H134.5z"/> <path class="st1" d="M146.7,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M148.8,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M155.2,15.4l-0.5,2.5h-2L155,7.1h2.5l2.1,10.8h-2l-0.5-2.5H155.2z M156.9,13.8l-0.4-2.3 c-0.1-0.7-0.3-1.7-0.4-2.4h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H156.9z"/> <path class="st1" d="M161.3,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M168.3,7.1v10.8h-2.1V7.1H168.3z"/> <path class="st1" d="M174.5,13.2h-2.5v2.9h2.8v1.8H170V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M176.1,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H176.1z"/> <path class="st1" d="M185.4,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M190.2,15.8c0.4,0.2,1.2,0.4,1.8,0.4c1,0,1.5-0.5,1.5-1.2c0-0.8-0.5-1.2-1.4-1.8c-1.5-0.9-2-2-2-3 c0-1.7,1.2-3.2,3.4-3.2c0.7,0,1.4,0.2,1.7,0.4l-0.3,1.8c-0.3-0.2-0.8-0.4-1.4-0.4c-0.9,0-1.3,0.5-1.3,1.1c0,0.6,0.3,1,1.5,1.7 c1.4,0.9,2,2,2,3.1c0,2-1.5,3.3-3.6,3.3c-0.9,0-1.7-0.2-2.1-0.4L190.2,15.8z"/> </g> </svg>'; }else{
          accepting_new_patients_flag = '';
         }

            var card = `<div class="col-6 col-lg-3 col-sm-6">
              <a href="${obj.profile_permalink}" class="doctor-card-link" title="View profile">
                  </a><div class="card" style="width: 18rem;" id="doctor-card"><a href="${obj.profile_permalink}" class="doctor-card-link">
                  <div style="position:relative;display:inline-block;transition: transform 150ms ease-in-out;">
                    <img class="card-img-top" src="${profile}" alt="Card image cap" width="286" height="199.5">
                    ${accepting_new_patients_flag}
                    </div>
                    </a><div class="card-body"><a href="${obj.profile_permalink}" class="doctor-card-link">
                      <h3 class="card-title">${obj.name}</h3>
                      <hr>
                      </a>
                      <p class="card-text">${servocebubble}</p>` +
                      (obj.phone_number ? `<span class="phone-number-container"><img alt="cell icon" src="${cell_icon}"> <span class="call">Call</span> <a href="tel:${obj.phone_number}" class="phone-number">${obj.phone_number}</span></span>` : '') + `
                    </div>
                  </div>
              </div></a>`;
              $(".pagination-nav-container").html("");
              $("#main-search").append(card).fadeIn(100000);
          })
         }
       });
    });
});


</script>
