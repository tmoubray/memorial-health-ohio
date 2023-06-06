
<?php

$the_query = new WP_Query( array('posts_per_page'=> 99999,
                              'post_type'=> ['services','page'],
                              'orderby' => 'title',
                              'order'   => 'ASC',
                              'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                              'meta_query' => array(
                                array( 
                                  'key'   => 'name',
                              

                                  'compare' => 'EXISTS'
                                ),
                                array(
                                  'key'      => 'list_as_a_service',
                                  'value' => true,
                                  'compare' => '='
                                ),
                                'relation' => 'OR',
                            )

                         ));



?>





  <div class="row search-panel">
    <span class="search-form-instruct">I'm looking for</span>

    <form class="form-inline my-2 my-lg-0" id="primary-service-search">
      <i class="fa fa-search icon search-icon"></i>
      <input class="form-control mr-sm-2 service-criteria-search" id="general-search" type="search" placeholder="Search name, service, speciality or condition" aria-label="Search">
      <!-- <input type="submit" class="primary-link"></input> -->
      <button type="submit" class="primary-link" >Search</button>
    </form>
  </div>





<div class="row">
<?php echo get_template_part('/template-parts/alpha-search');?>
</div>



<div class="row results">
  <?php
  $counts = $the_query->post_count;
  $founds = $the_query->found_posts;
  $maxnums = $the_query->max_num_pages;                    
  ?> 
  <span>Showing <?php echo $counts; ?> of <?php echo $founds; ?> results</span>
  <hr>
</div>



<div id="search-container">
<div class="row services-search" id="main-search">


<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

<div class="col-lg-6 col-12">
<div class="half-width">
  <div class="float-left left">

        <div class="card" >
        <a href="<?php the_permalink(); ?>" class="service-permalink">
          <h2><?php the_title();?></h2>
        </a>

          <?php
            $terms = get_field('search_term');

            if( $terms ): ?>

                <?php foreach( $terms as $term ): ?>

                  <a href="<?php the_permalink()?>"><?php echo $term->name;?></a>

                <?php endforeach; ?>

            <?php endif; ?>
        </div>
  </div>
</div>
</div>

<?php endwhile; ?>


</div>
</div>

<div class="col-12">
  <div class="loader"></div>
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
 'total' => $the_query->max_num_pages,
  'next_text' => 'Next <i class="fas fa-angle-right"></i>'
) );

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



            $('#search-container').load(link + ' #search-container', function() {

                $("#search-container").fadeIn("slow", function(){

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


                                $(".alpha-filter .filter").click(function() {
                                  $(".current-filter").removeClass("current-filter");
                                  $(this).addClass("current-filter");
                                  var search_range = $(this).attr("data-search-alpha");
                                    $.ajax({
                                    type: "GET",
                                    url: "/wp-json/memorial/v2/services/alpha/?term=" + search_range + "/",
                                    error: function(xhr, statusText, error) { alert("Error: "+error); },
                                    success: function(data){
                                      $(".loader").show();
                                     $("#main-search").html('');
                                     if (data.length > 0) {
                                      $('div.results').html('<span>Found ' + data.length + ' results</span>');
                                      }
                                      if (data.length == 0) {
                                        $('div.results').html('<span>Found 0 results</span>');
                                      }
                                      $(data).each(function(i, obj) {
                                        console.log(obj);

                                        var terms = [];
                                        if (obj.taxonomy_terms.length) {
                                            terms = obj.taxonomy_terms
                                        }
                                        var card = `<div class="col-lg-6 col-12">
                                          <div class="half-width">
                                            <div class="float-left left">
                                                  <a href="${obj.permalink}">
                                                  <div class="card">
                                                    <h2>${obj.service}</h2>
                                                    ${terms.map(elmt =>`
                                                      <a href="${obj.permalink}">${elmt.name}</a>
                                                    `).join('')}</div>
                                                  </div>
                                                  </a>
                                                </div>
                                              </div>
                                            </div>`;

                                          $("#main-search").append(card);
                                      })
                                     }
                                   });
                                });




  });
</script>
