<?php
/*Home Channel Guide */
global $region_id;
?>
<?php
$channel_slider = array();
if(in_array(2, $region_id)){
	/*India*/
	$channel_slider_show_hide = cs_get_option('channel_slider_show_hide_in');
	$channel_slider_text = cs_get_option('channel_slider_channel_guide_text_in');
	$channel_slider_image_group = cs_get_option('channel_slider_image_group_in');
	
	if($channel_slider_image_group) {
		foreach ($channel_slider_image_group as $key => $value) {
			$channel_slider[$key]['image_text'] = $value['channel_slider_image_text_in'];
			$channel_slider[$key]['channel_no'] = $value['channel_slider_channel_no_in'];
			$channel_slider[$key]['image_url'] = $value['channel_slider_image_url_in'];
		}
	}
}
elseif(in_array(3,$region_id)){
	/*US*/
	$channel_slider_show_hide = cs_get_option('channel_slider_show_hide_us');
	$channel_slider_text = cs_get_option('channel_slider_channel_guide_text_us');
	$channel_slider_image_group = cs_get_option('channel_slider_image_group_us');
	
	if($channel_slider_image_group) {
		foreach ($channel_slider_image_group as $key => $value) {
			$channel_slider[$key]['image_text'] = $value['channel_slider_image_text_us'];
			$channel_slider[$key]['channel_no'] = $value['channel_slider_channel_no_us'];
			$channel_slider[$key]['image_url'] = $value['channel_slider_image_url_us'];
		}
	}
}
elseif(in_array(4, $region_id)){
	/*UK*/
	$channel_slider_show_hide = cs_get_option('channel_slider_show_hide_uk');
	$channel_slider_text = cs_get_option('channel_slider_channel_guide_text_uk');
	$channel_slider_image_group = cs_get_option('channel_slider_image_group_uk');
	
	if($channel_slider_image_group) {
		foreach ($channel_slider_image_group as $key => $value) {
			$channel_slider[$key]['image_text'] = $value['channel_slider_image_text_uk'];
			$channel_slider[$key]['channel_no'] = $value['channel_slider_channel_no_uk'];
			$channel_slider[$key]['image_url'] = $value['channel_slider_image_url_uk'];
		}
	}
}
elseif(in_array(5, $region_id)){
	/*Mena*/
	$channel_slider_show_hide = cs_get_option('channel_slider_show_hide_mena');
	$channel_slider_text = cs_get_option('channel_slider_channel_guide_text_mena');
	$channel_slider_image_group = cs_get_option('channel_slider_image_group_mena');
	
	if($channel_slider_image_group) {
		foreach ($channel_slider_image_group as $key => $value) {
			$channel_slider[$key]['image_text'] = $value['channel_slider_image_text_mena'];
			$channel_slider[$key]['channel_no'] = $value['channel_slider_channel_no_mena'];
			$channel_slider[$key]['image_url'] = $value['channel_slider_image_url_mena'];
		}
	}
}
elseif(in_array(6, $region_id)){
	/*AP*/
	$channel_slider_show_hide = cs_get_option('channel_slider_show_hide_ap');
	$channel_slider_text = cs_get_option('channel_slider_channel_guide_text_ap');
	$channel_slider_image_group = cs_get_option('channel_slider_image_group_ap');
	
	if($channel_slider_image_group) {
		foreach ($channel_slider_image_group as $key => $value) {
			$channel_slider[$key]['image_text'] = $value['channel_slider_image_text_ap'];
			$channel_slider[$key]['channel_no'] = $value['channel_slider_channel_no_ap'];
			$channel_slider[$key]['image_url'] = $value['channel_slider_image_url_ap'];
		}
	}
}
?>

<?php 
if($channel_slider_show_hide){ 
	if(!empty($channel_slider_image_group)){?>
		<section class="channel-guide-box">
		 	<div class="container">
            	<div class="row">
               		<div class="col-sm-12">
                  		<div class="heading-left text-uppercase">
	                     	<h2>
		                     	<span> 
		                     		<?php 
		                     		if(!empty($channel_slider_text)) {
		                     			echo $channel_slider_text;
		                     		} else {
		                     			echo 'Channel Guide';
		                     		}
		                      		?> 
		                  		</span> 
	                  		</h2>
                   		</div>
                   		<div class="row">
                   			<div class="channel-guide-slider swiper-container">
								<div class="swiper-wrapper">
									<?php 
									foreach ($channel_slider as $key => $val) {
										if(!empty($val['image_url'])) {
										?>
											<div class="swiper-slide">
												<div class="guide-inner-box">
													<img src="<?php echo $val['image_url']; ?>">
													<?php if(!empty($val['image_text'])) { ?>
														<p class="channel-name">
															<?php echo $val['image_text']; ?>
														</p>													
													<?php }?>
													<?php if(!empty($val['channel_no'])) { ?>
														<p class="channel-number">
															<?php echo $val['channel_no']; ?>
														</p>
													<?php }?>
												</div>
											</div>
									<?php } }?>	
								</div>
								<div class="swiper-button-next"></div>
								<div class="swiper-button-prev"></div>
							</div>
                        </div>
                	</div>
            	</div>
        	</div>		
		</section>
<?php } } ?>	