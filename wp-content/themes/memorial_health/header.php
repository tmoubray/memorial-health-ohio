<?php
/**

 */

 $menu_name = 'top-header-menu'; //menu slug
 $locations = get_nav_menu_locations();
 $menu = wp_get_nav_menu_object($locations[ $menu_name ]);
 $menuitems = wp_get_nav_menu_items($menu->term_id, array( 'order' => 'DESC' ));

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

  <script type="text/javascript">
    
    if (window.document.documentMode) {
       alert('This site does support Internet Explorer.  Please use a different browser for the best experience');
      }
  </script>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://use.typekit.net/qnd2yvm.css">

    <script type="text/javascript">
    var templateUrl = '<?= get_bloginfo("template_url"); ?>';
    </script>


    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/favicons/favicon-196x196.png";?>" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/favicon-128.png";?>" sizes="128x128" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/favicon-96x96.png";?>" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/favicon-32x32.png";?>" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/favicon-16x16.png";?>" sizes="16x16" />

    <meta name="application-name" content="Memorial Health"/>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7b8UmzXyFb4258MYEpjdnfYsNT5zCSfk"></script>


    <script>
    var templateDir = "<?php bloginfo('template_directory') ?>";
    </script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <?php
      $scripts_header_addition = get_field('scripts_header_addition', 'option');
      if(!empty($scripts_header_addition)){
        echo $scripts_header_addition;
      }      
    ?>


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
$scripts_body_addition = get_field('scripts_body_addition', 'option');
if(!empty($scripts_body_addition)){
  echo $scripts_body_addition;
}
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'wp-bootstrap-starter'); ?></a>

	<header id="" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
      <div class="container-fluid full-width-no-pad" id="full-width-no-pad">

        <div class="d-none d-xl-block d-md-none header-emergency-widget-container">
          <?php get_template_part("/template-parts/emergency-widget"); ?>
        </div>
          <?php
          $show_covid_alert = get_field('show_covid_alert', 'option');
          $covid_alert = get_field('covid_header_alert', 'option'); 
          $linkArray = $covid_alert['link'];
          if(!empty($show_covid_alert) &&  $show_covid_alert == 'yes'){
          ?>
           <div class="alert alert-warning alert-dismissible fade show top-phone" id="site-alert-mobile" role="alert">
            <a class="" target="_self" href="tel:18006864677">1 (800) 686-4677</a>
          </div>
          <div class="alert alert-warning alert-dismissible fade show" id="site-alert-mobile" role="alert">
            <?php $covid_alert_mobile = get_field('covid_header_alert', 'option');?>
            <span class="alert-box-mobile">
              <img src="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/caution-triangle.svg";?>" border="0" alt="Share" width="24" height="24">
              <span id="alert-intro"><?php echo (!empty($covid_alert["bold_text"])) ? $covid_alert["bold_text"] : ''; ?></span>
            </span>
        			<span class="alert-box mobile-covid-alert"><?php echo (!empty($covid_alert["bold_text"])) ? '<span class="vertical-bar"></span>' : ''; ?><?php echo $covid_alert["alert"]; ?>      	
        			<a class="primary-link ml-auto mr-3" target="_blank" href="<?php echo (!empty($linkArray['url'])) ? $linkArray['url'] : '#';  ?>"><?php echo (!empty($linkArray['title'])) ? $linkArray['title'] : 'How we\'re keeping you safe'; ?></a>
        			</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
        <?php  } ?>



          <nav class="navbar navbar-expand-xl p-0">
            <ul class="navbar-nav" id="top-header">
              <li class="nav-item" id="high-contrast-label">
                <div>High Contrast</div>
              </li>
              <li class="nav-item w-100" id="high-contrast-switch">
                <div class="can-toggle demo-rebrand-2">
                  <input id="e" name="contrast_check" onclick="mobile_nav_contrast(event,this);" type="checkbox">
                  <label for="e">High Contrast
                    <div class="can-toggle__switch" data-checked="On" data-unchecked="Off"></div>
                    <div class="can-toggle__label-text"></div>
                  </label>
                </div>
              </li>
              <?php foreach ($menuitems as $item) {
                ?>
              <li class="nav-item ml-auto top-nav-option" id="">

                <a class="nav-link <?php echo implode(" ",$item->classes);?>" target="<?php echo (!empty($item->target)) ? $item->target : '_self'; ?>" href="<?php echo $item->url ?>"><?php echo $item->title ?><i class="fas fa-external-link-alt"></i></a>
              </li>
              <?php
              } ?>
              <li class="nav-item" >
                <form action="/" class="form-inline my-2 my-lg-0" id="primary-header-search">
                  <i class="fa fa-search icon"></i>


                  <input type="search" class="search-field form-control" placeholder="Search" value="" name="s" title="Search for:">
                </form>
              </li>
            </ul>
          </nav>


          <nav class="navbar navbar-expand-xl p-0" id="main-nav-container">
              <div class="navbar-brand">

                      <a href="<?php echo esc_url(home_url('/')); ?>">
                          <img src="<?php echo get_bloginfo('template_directory') . "/inc/assets/images/main-logo.svg";?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                      </a>


              </div>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

            <div class="collapse navbar-collapse justify-content-end" id="main-nav">
              <form action="/" class="form-inline my-2 my-lg-0" id="primary-header-search-mobile">
                <i class="fa fa-search icon"></i>

                <input type="search" class="search-field form-control" placeholder="Search" value="" name="s" title="Search for:">
              </form>
              <?php  
           
                 wp_nav_menu(array(
                'theme_location'    => 'primary',
                'container'       => 'div',
                'container_id'    => '',
                'container_class' => '',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker()
                ));
          
                 wp_nav_menu( array( 'theme_location' => 'primary-header' ) );
  
              ?>
            </div>


          </nav>





          <nav id="mobile-main-nav-container">



          <?php  
           
                 wp_nav_menu(array(
                'theme_location'    => 'primary',
                'container'       => 'div',
                'container_id'    => '',
                'container_class' => '',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker()
                ));
          
                 wp_nav_menu( array( 'theme_location' => 'primary-header' ) );
  
              ?>


          </nav>


      </div>


	</header><!-- #masthead -->
