<?php
 	$ratings = getRatingsByNpi(get_field("npi_code"));
  $overall_rating = $ratings["data"]["entities"][0]["overallRating"]["value"];
  $overall_rating_whole = floor($overall_rating);
  $overall_rating_fraction = $overall_rating - $overall_rating_whole;
  $total_reviews = $ratings['data']['entities']['0']['totalRatingCount'];
  $explanation_rating = $ratings['data']['entities']['0']['overallRating']['questionRatings']['4']['value'];
  $courtesy_rating = $ratings['data']['entities']['0']['overallRating']['questionRatings']['2']['value'];
  $patient_rating = $ratings['data']['entities']['0']['overallRating']['questionRatings']['7']['value'];
  $patient_comments = $ratings['data']['entities']['0']['comments'];
  if ($overall_rating_fraction > 0) {
    $fractional_star_src = "half-star";
  }
 ?>


<div id="overall-doctor-ratings-container">
<div id="overall-rating"><?php 	echo $overall_rating;?></div>
<div id="overall-label">Overall</div>

<div id="overall-star-rating">
<?php
for ($x = 0; $x < $overall_rating_whole; $x++) {
  echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/star.svg" border="0" alt="Share" width="50" height="50">';
}
if ($fractional_star_src) {
  echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/half-star.svg" border="0" alt="Share" width="50" height="50">';
}
?>
</div>

<?php
if ($total_reviews) {
  echo "<div id='total-reviews'>($total_reviews Reviews)</div>";
}
?>

<div id="ratings-table" class="ratings-main">
  
	<div class="row-outer">
      <span>Explains</span>
      <span>
        <?php
        for ($x = 0; $x < $overall_rating_whole; $x++) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/star.svg" border="0" alt="Share" width="50" height="50">';
        }
        if ($fractional_star_src) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/half-star.svg" border="0" alt="Share" width="50" height="50">';
        }
        ?>
      </span>
      <span><?php echo $explanation_rating?></span>
	  </div>
	<div class="row-outer">
      <span>Courtesy, Respect & Concern</span>
      <span>
        <?php
        for ($x = 0; $x < $overall_rating_whole; $x++) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/star.svg" border="0" alt="Share" width="50" height="50">';
        }
        if ($fractional_star_src) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/half-star.svg" border="0" alt="Share" width="50" height="50">';
        }
        ?>
      </span>
      <span><?php echo $courtesy_rating?></span>
	  </div>
	<div class="row-outer">
      <span>Patient Rating of Doctor</span>
      <span>
        <?php
        for ($x = 0; $x < $overall_rating_whole; $x++) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/star.svg" border="0" alt="Share" width="50" height="50">';
        }
        if ($fractional_star_src) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/half-star.svg" border="0" alt="Share" width="50" height="50">';
        }
        ?>
      </span>
      <span><?php echo $patient_rating?></span>
	  </div>
</div>


<div id="comments">
  <?php foreach( $patient_comments as $count=>$patient_comment ) {?>

<?php if ($count < 10) {?>
  <div class="comment-container visible">

    <div class="comment-name-and-rating">

      <div class="comment-name">
        Memorial Health Patient - <?php echo date("F",strtotime($patient_comment['mentionTime'])) . " " . date("Y",strtotime($patient_comment['mentionTime']));?>
      </div>

      <div class="given-rating">
        <?php
        $patient_rating =  $patient_comment['overallRating']['value'];
        $patient_rating_whole = floor($overall_rating);
        $patient_rating_fraction = $patient_rating - $patient_rating_whole;
        if ($patient_rating_fraction > 0) {
          $patient_overall_rating_fraction_src = "half-star";
        }
        for ($x = 0; $x < $overall_rating_whole; $x++) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/star.svg" border="0" alt="Share" width="50" height="50">';
        }
        if ($patient_overall_rating_fraction_src ) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/half-star.svg" border="0" alt="Share" width="50" height="50">';
        }
        ?>
      </div>

    </div>

    <div class="comment">
      <?php echo $patient_comment["comment"]?>
    </div>
  </div>

<?php }else{ ?>
  <div class="comment-container hidden">

    <div class="comment-name-and-rating">

      <div class="comment-name">
        Memorial Health Patient - <?php echo date("F",strtotime($patient_comment['mentionTime'])) . " " . date("Y",strtotime($patient_comment['mentionTime']));?>
      </div>

      <div class="given-rating">
        <?php
        $patient_rating =  $patient_comment['overallRating']['value'];
        $patient_rating_whole = floor($overall_rating);
        $patient_rating_fraction = $patient_rating - $patient_rating_whole;
        if ($patient_rating_fraction > 0) {
          $patient_overall_rating_fraction_src = "half-star";
        }
        for ($x = 0; $x < $overall_rating_whole; $x++) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/star.svg" border="0" alt="Share" width="50" height="50">';
        }
        if ($patient_overall_rating_fraction_src ) {
          echo '<img src="' . get_bloginfo('template_directory' ) . '/inc/assets/images/half-star.svg" border="0" alt="Share" width="50" height="50">';
        }
        ?>
      </div>

    </div>

    <div class="comment">
      <?php echo $patient_comment["comment"]?>
    </div>
  </div>


<?php }?>

  <?php } ?>

  <div id="load-more-container">
  <hr>
  <div id="load-more-header">Load More</div>
  <img id="load-more-image" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/arrow-down-more.svg";?>" border="0" alt="Share" width="32" height="32">

</div>




</div>
