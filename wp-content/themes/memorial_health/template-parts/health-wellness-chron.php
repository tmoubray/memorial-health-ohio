<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
               'post_type' => 'health_wellness',
               'posts_per_page' => 4,
               'paged' => $paged
            );
$my_query = new WP_Query($args);


//Counts
$counts = $my_query->post_count;
$founds = $my_query->found_posts;
$maxnums = $my_query->max_num_pages;
?>
<div id="search-container" style="min-height:1000px;"><div class="row results">
  <span>Showing <span id="current_found_countsnewsroom"><?php echo $counts; ?></span> of <?php echo $founds; ?> results</span>
  <hr>
</div>
<?php
// echo '<div id="search-container"><div class="row results">
//   <span>Showing 12 of 35 results</span>
//   <hr>
// </div>
// ';
if($my_query->have_posts()):
    while($my_query->have_posts()):$my_query->the_post();

if (get_the_post_thumbnail_url(get_the_ID())) {
    $image = get_the_post_thumbnail_url(get_the_ID());
  }else{
    $image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/no-post-image.svg";
  }

  $permalink = get_the_permalink();
  $the_date = get_the_date();
  $read_time = get_field('read_time');
  $title = get_the_title();
  $intro = get_field('intro');

        // $posttempalte = <<<"EOT"

        // <div class="row post-teaser d-none d-lg-block"><ul class="list-unstyled">
        //   <li class="media">
        //     <div class="media-body">
        //       <span id="date-read-time">$the_date | $read_time Minute Read</span>
        //       <div class="post-title"><a href="$permalink">$title</a></div>
        //       <p>$intro <a id="read-more" href="$permalink">Read More</a></p>
        //     </div>
        //     <img src="$image">
        // </ul></div>

        // <div class="row post-teaser d-lg-none"><ul class="list-unstyled">
        //   <li class="media">
        //     <img src="$image">
        //     <div class="media-body">
        //       <div class="post-title"><a href="$permalink">$title</a></div>
        //       <span id="date-read-time">$the_date | $read_time Minute Read</span>
        //     </div>

        // </ul></div>

        // EOT;

        // echo $posttempalte;

        ?>
        <div class="row post-teaser d-none d-lg-block">
          <ul class="list-unstyled">
            <li class="media">
              <div class="media-body">
                <div id="date-read-time"><?php echo $the_date .' | '. $read_time; ?> Minute Read</div>
                <div class="post-title">
                  <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>
                  <p><?php echo $intro; ?> <a id="read-more" href="<?php echo $permalink; ?>">Read More</a></p>
              </div>
              <img src="<?php echo $image; ?>" alt="post teaser">
          </ul>
        </div>

        <div class="row post-teaser d-lg-none">
          <ul class="list-unstyled">
            <li class="media">
              <img src="<?php echo $image; ?>" alt="post teaser">
              <div class="media-body">
                <div class="post-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>
                <div id="date-read-time"><?php echo $the_date .' | '. $read_time; ?> Minute Read</div>
              </div>
          </ul>
        </div>
        <?php
        
        //Loop goes here...
    endwhile;


wp_reset_postdata();

endif;


?>

</div>

<div class="col-12">
  <div class="loader"></div>
</div>


<?php if ( have_posts() ) : ?>
<div id="everyone">
<div class="col-12 pagination-nav-container">

<nav>
<?php 
// $big = 999999999; // need an unlikely integer
// echo paginate_links( array(
//  'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
//  'format' => '?paged=%#%',
//  'current' => max( 1, get_query_var('paged') ),
//  'total' => $my_query->max_num_pages,
//   'next_text' => 'Next <i class="fas fa-angle-right"></i>'
// ) );

wp_reset_postdata();?>
</nav>


  <?php endif; ?>

  <?php
  /*Custom Pagination*/
$big = 999999999; // need an unlikely integer
echo paginate_links( array(
  'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
  'format' => '?paged=%#%',
  'current' => max( 1, get_query_var('paged') ),
  'total' => $my_query->max_num_pages,
  'next_text' => 'Next <i class="fas fa-angle-right"></i> <a class="next page-numbers cstm-last-link" href="'.site_url('locations').'/page/'.$my_query->max_num_pages.'/">Last <i class="fas fa-angle-right"></i></a>'
) );
  ?>

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
                var foundIds = $(response).find('.d-lg-block').length;
                console.log(foundIds , '<----');
                if(foundIds){
                  $('#current_found_countsdictor').html(foundIds);
                }
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



});


</script>
