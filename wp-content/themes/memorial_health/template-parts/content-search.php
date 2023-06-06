<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */
$post_thumb = '';

?>


<?php $post_type = get_post_type();
	$postid = get_the_ID();
?>

<div class="site-main search-results" role="main">
	<div class="row post-teaser d-none d-lg-block">
		<ul class="list-unstyled">
		<li class="media">
		 <div class="media-body">
		  <span class="post-type"><?php echo $post_type?></span>
			<div class="post-title"><a href="<?php echo get_the_permalink($postid);?>" title="<?php echo get_the_title($postid);?>"><?php echo get_the_title($postid);?></a> </div>
			  <?php
						
				if($post_type == "doctors"){
				  if (have_rows('biography')):
					while (have_rows('biography')): the_row();
						$shortdesc = get_sub_field('text');
						if (!empty($shortdesc)) {
							?>
							<a href="<?php echo get_the_permalink($postid);?>" title="<?php echo get_the_title($postid);?>">
							<?php
								echo (!empty($shortdesc)) ? wp_trim_words( $shortdesc, 50, '...' ) : '';
							?>
							</a>
							<?php	
						}									
						endwhile;
					endif;
				}
				elseif($post_type == "services"){
							$shortdesc = get_field('service_description',$postid);
							?>
							<a href="<?php echo get_the_permalink($postid);?>">
							<?php
								echo (!empty($shortdesc)) ? wp_trim_words( $shortdesc, 50, '...' ) : '';
							?>
							</a>
							<?php
				}
				elseif($post_type == "locations"){

				
				}
				elseif($post_type == "page"){
					$shortdesc = get_field('page_introduction',$postid);
					?>
					<a href="<?php echo get_the_permalink($postid);?>">
					<?php
						echo (!empty($shortdesc)) ? wp_trim_words( $shortdesc, 50, '...' ) : '';
					?>
					</a>
					<?php
				}
				else{

				}
			?>
		</div>
				

		<?php if($post_type == "doctors") {
		  $profile_image = get_field("profile_image", get_the_ID());
		?>

		<?php if($profile_image) {?>
		<a href="<?php echo get_the_permalink($postid);?>" title="Doctor">
				<img src="<?php echo $profile_image?>" alt="Doctor">
		</a>
		<?php }else{  ?>

		<?php $gender = get_field("sex", get_the_ID())?>
		  <?php if($gender == "female") {
				?>	
				<a href="<?php echo get_the_permalink($postid);?>" title="Doctor">
					<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png"?>" alt="Doctor">
		  		</a>
			<?php }else{?>
				<a href="<?php echo get_the_permalink($postid);?>" title="Doctor">
					<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png"?>" alt="Doctor">
				</a>
			<?php } ?>
		<?php } ?>
		<?php } else if($post_type == "classes_events") {
		   if (get_field("image")) {
		      $post_thumb = get_field("image");
		   } else {
		      $post_thumb = get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-default.png";
		   }
		?>
		<?php } else if($post_type == "services") {?>
		<!-- <img src="<?php //echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/no-post-image.svg"?>"> -->
		<!-- <img src="<?php //echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/main-logo.svg"?>"> -->
		<?php } else if($post_type == "locations") { 
			$profile_image = get_field("image", get_the_ID())
		?>					
		<?php if($profile_image) {?>
			<a href="<?php echo get_the_permalink($postid);?>">
					<img src="<?php echo $profile_image?>">
			</a>
		<?php }else{  ?>
			<a href="<?php echo get_the_permalink($postid);?>">
				<img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/no-post-image.svg"?>">
			</a>
		<?php } ?>

		<?php } 
		elseif($post_type == "page"){
		?>

		<?php
		}
		else {
			$post_thumb = get_the_post_thumbnail_url();
		?>
		<?php } ?>
		<?php if($post_thumb) {?>
		  <a href="<?php echo get_the_permalink($postid);?>">
		    <img src="<?php echo $post_thumb; ?>">
		  </a>
		<?php }else{?>
		  
		<?php } ?>
		</ul>
	</div>
</div>
