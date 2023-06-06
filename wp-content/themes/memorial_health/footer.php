<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */
 $menu_name = 'primary-footer'; //menu slug
 $locations = get_nav_menu_locations();
 $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
 $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

?>

<div class="d-md-block d-lg-none">
<?php get_template_part("/template-parts/emergency-widget"); ?>
</div>

    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="colophon" class="site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
		<nav class="navbar navbar-expand-xl p-0">
		   <ul class="navbar-nav footer-container" id="">
		      <li class="" id="logo">
            <img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/logo-alt.svg";?>" alt="Site Logo Footer">
            			<?php
            			$numberstring = get_field('toll_free_phone_number', 'option');
            			$phoneint = str_replace( array( '\'', '"',',' , ';', '<', '>','(',')','-',' '), '', $numberstring);
            			?>
						<h1 id="toll-free">Toll Free: <a href="tel:<?php echo $phoneint; ?>"> <?php the_field('toll_free_phone_number', 'option'); ?></a></h1>
						<div class="address"><?php the_field('business_address', 'option'); ?></div>

						 <span class="copyright on-web"><?php the_field('copyright', 'option'); ?></span>
		      </li>
					<?php foreach ($menuitems as $item) {?>
					<li class="p-3 on-web" id="">
						<a class="nav-link" href="<?php echo $item->url ?>"><?php echo $item->title ?></a>
					</li>
					<?php } ?>
		    </ul>
			<ul class="navbar-nav footer-container on-mob" id="">
		      	<?php foreach ($menuitems as $item) {?>
					<li class="p-3" id="">
						<a class="nav-link" href="<?php echo $item->url ?>"><?php echo $item->title ?></a>
					</li>
					<?php } ?>
		    </ul>
			<span class="copyright on-mob"><?php the_field('copyright', 'option'); ?></span>
		  </nav>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<script>
function scroll_to_pagetop(eve,element){
	//Locations Page
	if($("#all-locations-header").length){
		$('html, body').animate({
	    	scrollTop: $("#all-locations-header").offset().top
	  	}, 2000);
	}

	//Find a doc page
	if($(".search-panel").length){
		$('html, body').animate({
	    	scrollTop: $(".search-panel").offset().top
	  	}, 2000);
	}

	//news room page
	if($(".page-template-newsroom-page .results").length){
		$('html, body').animate({
	    	scrollTop: $(".page-template-newsroom-page .results").offset().top
	  	}, 2000);
	}
  	
}
</script>

</body>
</html>




<style type="text/css">
.acf-map {
    width: 100%;
    height: 400px;
    border: #ccc solid 1px;
    margin: 20px 0;
}

// Fixes potential theme css conflict.
.acf-map img {
   max-width: inherit !important;
}
</style>
