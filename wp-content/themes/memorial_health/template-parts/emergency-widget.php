<nav class="navbar navbar-expand-xl p-0">
  <ul class="navbar-nav" id="alerts-banner">
    <?php 
    //Covid Alert
    $show_covid_alert = get_field('show_covid_alert', 'option');
    $show_emergency_alert = get_field('show_emergency_alert', 'option');    
    $emergency_alert_link = get_field('emergency_alert_link', 'option');
    $emergency_alert_link = get_field('emergency_alert_link', 'option');

    $red_background_alert_message = get_field('red_background_alert_message', 'option');
    if(!empty($show_emergency_alert) &&  $show_emergency_alert == 'yes') {
      ?>
      <li class="nav-item" id="emergency-widget">
        <a class="nav-link" target="<?php echo (!empty($emergency_alert_link['target'])) ? $emergency_alert_link['target'] : '_self'; ?>" href="<?php echo (!empty($emergency_alert_link['url'])) ? $emergency_alert_link['url'] : '#';  ?>"><?php echo $red_background_alert_message; ?></a>
      </li>
      <?php
    }

    if(!empty($show_covid_alert) &&  $show_covid_alert == 'yes'){ 
    ?>
    
    <li class="nav-item" id="site-alert">
	    <?php 
	      	$covid_alert = get_field('covid_header_alert', 'option'); 
	      	$linkArray = $covid_alert['link'];
	    ?>
      	<span class="alert-box"><img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/caution-triangle.svg";?>" border="0" alt="Share" width="24" height="24"><span id="alert-intro"><?php echo (!empty($covid_alert["bold_text"])) ? $covid_alert["bold_text"] : ''; ?></span><?php echo (!empty($covid_alert["bold_text"])) ? '<span class="vertical-bar"></span>' : ''; ?><?php echo $covid_alert["alert"]; ?>
      	
      	<a class="primary-link ml-auto mr-3" target="<?php echo (!empty($linkArray['target'])) ? $linkArray['target'] : '_self'; ?>" href="<?php echo (!empty($linkArray['url'])) ? $linkArray['url'] : '#';  ?>"><?php echo (!empty($linkArray['title'])) ? $linkArray['title'] : 'How we\'re keeping you safe'; ?></a>
  		</span>
      
    </li>
    <?php
      }
    ?>
    <li class="nav-item" id="top-number"><a class="" target="_self" href="tel:18006864677">1 (800) 686-4677</a></li>
  </ul>
</nav>


