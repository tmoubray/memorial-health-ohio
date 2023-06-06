<?php
// Check value exists.
if( have_rows('shared_elements') ):
    // Loop through rows.
    while ( have_rows('shared_elements') ) : the_row();
        // Case: Paragraph layout.
        if( get_row_layout() == 'two_panel' ):
          echo "<div class='two-panel row'>";
          if( have_rows('left_panel') ):
              // Loop through rows.
              while ( have_rows('left_panel') ) : the_row();
             

              if(get_sub_field('background_type') === "map") {
                $location = get_sub_field('map');
                $mapmessage = get_sub_field('message');
                $maptitle = get_sub_field('title');
                if (get_sub_field('link')) {
                $maplinktitle = get_sub_field('link')['title'];
                $maplinktarget = get_sub_field('link')['target'];
                $maplinkurl = get_sub_field('link')['url'];
                }

                if($mapmessage && $maptitle) { 
                  $divider = "<hr>";
                }
                if (get_sub_field('link')) {
                  $leftlink = '<a class="primary-link ml-auto mr-3 d2" href="'. $maplinkurl .'" target="'. $maplinktarget .'">'. $maplinktitle .'</a>';
                }
                
                if( $location ) {
                    echo '<div class="map-overlay right-panel col-lg-6 col-12"><div class="map-on-content"><h2>'. get_sub_field('title') .'</h2>'.$divider.'<p> '. get_sub_field('message') . '</p>'.$leftlink.'</div><div class="acf-map" data-zoom="16"><div class="marker" data-lat="'.  esc_attr($location['lat'])  . '" data-lng="' . esc_attr($location['lng']) . '"></div></div></div>';
                }
              }else if (get_sub_field('background_type') === "image") {
                $image = get_sub_field('image');
                $imagetemplate = '<div class="right-panel col-lg-6 col-12" style="background-image:url(\''.$image.'\');height:500px;width:50%;background-size: cover;"></div>';
                echo $imagetemplate;
              }else{
                $leftmessage = get_sub_field('message');
                $lefttitle = get_sub_field('title');
                if($leftmessage && $lefttitle) { 
                  $divider = "<hr>";
                }
                if (get_sub_field('link')) {
                $colorlinktitle = get_sub_field('link')['title'];
                $colorlinktarget = get_sub_field('link')['target'];
                $colorlinkurl = get_sub_field('link')['url'];
                }
                if (get_sub_field('link')) {
                  $colorleftlink = "<a class='primary-link ml-auto mr-3 d2' target='". $colorlinktarget ."' href='". $colorlinkurl ."'>".$colorlinktitle. "</a>";
                }
                echo "<div class='left-panel col-lg-6 col-12 "  . get_sub_field('color')['label']  ."' style='background-color:" . get_sub_field('color')['value'] . ";height:500px;'><div class='panel-container'>" .
                "<h2>" . get_sub_field('title') . "</h2>" . $divider . "<p>" . $leftmessage . "</p>". $colorleftlink . "</div></div>";
              }

               endwhile;
            // Do something..
          endif;


          if( have_rows('right_panel') ):
            // Loop through rows.
            while ( have_rows('right_panel') ) : the_row();
              
              if(get_sub_field('background_type') === "map") {
                $location = get_sub_field('map');
                $maprightmessage = get_sub_field('message');
                $maprighttitle = get_sub_field('title');
                if($maprightmessage && $maprighttitle) { 
                  $divider = "<hr>";
                }
                if (get_sub_field('link')) {
                $maprightlinktitle = get_sub_field('link')['title'];
                $maprightlinktarget = get_sub_field('link')['target'];
                $maprightlinkurl = get_sub_field('link')['url'];
                }
                if (get_sub_field('link')) {
                  $rightlink = '<a class="primary-link ml-auto mr-3 d2" href="'. $maprightlinkurl .'" target="'. $maprightlinktarget .'">'. $maprightlinktitle .'</a>';
                }
                if( $location ) {
                    echo '<div class="map-overlay right-panel col-lg-6 col-12"><div class="map-on-content"><h2>'. get_sub_field('title') .'</h2>'.$divider.'<p> '. get_sub_field('message') . '</p>'.$rightlink.'</div><div class="acf-map" data-zoom="16"><div class="marker" data-lat="'.  esc_attr($location['lat'])  . '" data-lng="' . esc_attr($location['lng']) . '"></div></div></div>';
                }
              }else if (get_sub_field('background_type') === "image") {
                $image = get_sub_field('image');
                $imagetemplate = '<div class="right-panel col-lg-6 col-12" style="background-image:url(\''.$image.'\');height:500px;width:50%;background-size: cover;"></div>';
                echo $imagetemplate;
              }else{
                $rightmessage = get_sub_field('message');
                $righttitle = get_sub_field('title');
                if($rightmessage && $righttitle) { 
                  $divider = "<hr>";
                }
                if (get_sub_field('link')) {
                $rightcolorlinktitle = get_sub_field('link')['title'];
                $rightcolorlinktarget = get_sub_field('link')['target'];
                $rightcolorlinkurl = get_sub_field('link')['url'];
                }
                if (get_sub_field('link')) {
                  $colorrightlink = "<a class='primary-link ml-auto mr-3 d2' target='". $rightcolorlinktarget ."' href='". $rightcolorlinkurl."'>".$rightcolorlinktitle. "</a>";
                }
                echo "<div class='left-panel col-lg-6 col-12 "  . get_sub_field('color')['label']  ."' style='background-color:" . get_sub_field('color')['value'] . ";height:500px;'><div class='panel-container'>" .
                "<h2>" . get_sub_field('title') . "</h2>" . $divider . "<p>" . get_sub_field('message') . "</p>".$colorrightlink."</div></div>";
              }

             endwhile;
          // Do something..
          endif;
          echo "</div>";

        // Case: Download layout.
        elseif( get_row_layout() == 'quote_section' ):
            $quoteicon =  get_bloginfo( 'template_directory' ) . "/inc/assets/images/quote.png";
            echo "<div class='row quote-container'>";
            echo "<div class='col-lg-12 col-sm-12'>";
            echo "<div id='quote-icon'><img src='$quoteicon' alt='Quote Section'></div><br>";
            echo "<div class='quote-section'>". get_sub_field('quoted_text') ."</div><br>";
            echo "<div class='quote-section attribution'>". get_sub_field('attribution') ."</div>";
            echo "</div></div>";


            // Case: Download layout.
        elseif( get_row_layout() == 'single_panel' ):
                  // Loop through rows.

  

          $message = get_sub_field('message');
          $link_text = get_sub_field('link')['title'];
          $link_url = get_sub_field('link')['url'];
          $link_target = get_sub_field('link')['target'];
          $location = get_sub_field('map');

          if (get_sub_field('link')) {
            $link = '<a class="primary-link ml-auto mr-3 d2" href="'. get_sub_field('link')["url"] .'" target="'. get_sub_field('link')["target"] .'">'. get_sub_field('link')["title"] .'</a>';
          }


          if(get_sub_field('background_type') === "map") {
            if( $location ) {
                echo '<div class="row"><div class="map-overlay right-panel col-lg-12 col-12"><div class="map-on-content"><h2>'. get_sub_field('title') .'</h2>'.$divider.'<p> '. get_sub_field('message') . '</p>'.$link.'</div><div class="acf-map" data-zoom="16"><div class="marker" data-lat="'.  esc_attr($location['lat'])  . '" data-lng="' . esc_attr($location['lng']) . '"></div></div></div></div>';
              }
          }

          else if (get_sub_field('background_type') === "image") {
            $image = get_sub_field('image');
            $title = get_sub_field('title');
            $message = get_sub_field('message');
            $imagetemplate = '<div class="row"><div class="single-panel col-12" style="background-image:url(\''.$image.'\');height:500px;"><h2>'.$title.'</h2><hr><p>'.$message.'</p><a href="'.$link_url.'" target="'.$link_target.'" class="primary-link ml-auto mr-3 d3">'.$link_text.'</a></div></div>';
            echo $imagetemplate;
          }
          else{
            echo "<div class='row'><div class='single-panel col-12' style='background-color:" . get_sub_field('color') . "'>" ."<h2>" . get_sub_field('title') . "</h2><hr><p>$message</p><div class='singe-panel-link-container'><a href='".$link_url."' target='".$link_target."' class='primary-link ml-auto mr-3 d4'>".$link_text."</a></div></div></div>";
          }

   


          elseif( get_row_layout() == 'full_width_hero'):

          $image = get_sub_field('image');
          $headline = get_sub_field('headline');
          $message = get_sub_field('message');

          $serviceicon =  get_bloginfo( 'template_directory' ) . "/inc/assets/images/stethescope.svg";
          $locationicon =  get_bloginfo( 'template_directory' ) . "/inc/assets/images/hospital-pin.svg";
          $doctoricon =  get_bloginfo( 'template_directory' ) . "/inc/assets/images/doctor.svg";

          $menutemplate = "";

          if (is_front_page()) {
            $menutemplate = '<div id="help-menu"><span>How Can We Help You?</span><a href="'.site_url().'/services">Services <img src="'.$serviceicon.'" alt="Services"></a><a href="'.site_url().'/find-a-doctor">Doctors <img src="'.$doctoricon.'" alt="Doctors"></a><a href="'.site_url().'/locations">Locations <img src="'.$locationicon.'" alt="Locations"></a></div>';

            if( have_rows('home_slider') ):
                $imagetemplate = '<div class="hero-slider-home">';
                  while( have_rows('home_slider') ): the_row(); 
                    $slider_headline = get_sub_field('slider_headline');
                    $slider_message = get_sub_field('slider_message');
                    $slider_image = get_sub_field('slider_image');

                    $imagetemplate .= '<img src="'.$slider_image.'" alt="'.$slider_headline.'">';
                      $imagetemplate .= '<div class="slider-content">';
                        $imagetemplate .= '<h1 class="headline">'.$slider_headline.'</h1>';
                        $imagetemplate .= '<p class="message">'.$slider_headline.'</p>';
                    $imagetemplate .= '</div>';
                  endwhile;
                  //$imagetemplate .= '</div>';
            endif;          
            //echo $imagetemplate . $menutemplate . "</div>";
          }
          else{
              $imagetemplate = '<div class="row hero-image" style="background-image:url(\''.$image.'\');">
			  <div class="slider-overlay-img-p"></div>
              <div class="col-12 hero-content-container">
              <h1 class="headline">'.$headline.'</h1>
              <p class="message">'.$message.'</p>';
              //echo $imagetemplate . "</div></div>";
          }

          
          $imagetemplate = '<div class="row hero-image" style="background-image:url(\''.$image.'\');">
		  <div class="slider-overlay-img-p"></div>
          <div class="col-12 hero-content-container">
          <h1 class="headline">'.$headline.'</h1>
          <p class="message">'.$message.'</p>';
          echo $imagetemplate . $menutemplate . "</div></div>";


          elseif( get_row_layout() == 'full_width_hero_slider_overlay' ):

          $image = get_sub_field('hero_image');
          $class =  get_sub_field('class');

          //$imagetemplate = '<div class="row hero-image full-width-hero-slider-overlay '. $class .'" style="background-image:url(\''.$image.'\');"><div class="slider single-item">';
          $imagetemplate = '<div class="row hero-image full-width-hero-slider-overlay '. $class .'"><div class="slider single-item">';

          echo $imagetemplate;
          $i = 0;
          if( have_rows('slider') ):

              while( have_rows('slider') ) : the_row();
              $headline = get_sub_field('headline');
              $message = get_sub_field('message');
              $link = '';

              if (get_sub_field('link')) {
                $url = get_sub_field('link')['url'];
                $link_title = get_sub_field('link')['title'];
                $background_hero_img = get_sub_field('hero_image');
                $link = "<a class='slide-link' href='$url'>" . $link_title . "</a>";
              }

              echo "<div class='mh-sub-image'><img src='$background_hero_img' alt='$link_title'/><div class='mh-inslider-container'><h1 class='headline' id='slick-slide-control0".$i."'>$headline</h1><hr><p class='message'>$message</p>$link</div></div>";
              $i++;
              endwhile;
          endif;
          echo "</div></div>";



        elseif( get_row_layout() == 'simple_content_section' ):

        $content = get_sub_field('content');
        $contenttemplate = '<div class="row simple-content-section">'.$content.'</div>';
        echo $contenttemplate;


        elseif( get_row_layout() == 'three_column_informational' ):
        $maintitle = get_sub_field("title");
        $maindescription = get_sub_field("intro");
        if (get_sub_field("link")) {
          $mainlinkurl = get_sub_field("link")["url"];
          $mainlinktitle = get_sub_field("link")["title"];
        }


        echo '<div class="row three_column_informational">';

        if (!empty($maintitle)) {
          echo "<div class='col-12'><h3>$maintitle</h3><hr>";
            if(!empty($maindescription)){
                echo '<p>'.$maindescription.'</p>';
            }
            if(!empty($mainlinkurl)){

              echo "<a class='primary-link ml-auto mr-3 d5' href='$mainlinkurl'>$mainlinktitle</a>";
            }
          echo "</div>";
        }

        if( have_rows('column_one') ):
          while ( have_rows('column_one') ) : the_row();
          $image = get_sub_field('image');
          $title = get_sub_field('title');
          $message = get_sub_field('message');
          $link_url = get_sub_field('link')['url'];
          $link_title = get_sub_field('link')['title'];
          $imagetemplate = '<div class="col-lg-4 col-sm-12"><img src="'.$image.'" alt="'.$title.'"><h3>'.$title.'</h3><p>'.$message.'</p><a class="primary-link ml-auto mr-3 d6" href="'.$link_url.'">'.$link_title.'</a></div>';
          echo $imagetemplate;
          endwhile;
           // Do something..
        endif;


        if( have_rows('column_two') ):
          while ( have_rows('column_two') ) : the_row();
          $image = get_sub_field('image');
          $title = get_sub_field('title');
          $message = get_sub_field('message');
          $link_url = get_sub_field('link')['url'];
          $link_title = get_sub_field('link')['title'];
          $link = get_sub_field('link');
          $imagetemplate = '<div class="col-lg-4 col-sm-12"><img src="'.$image.'" alt="'.$title.'"><h3>'.$title.'</h3><p>'.$message.'</p><a class="primary-link ml-auto mr-3 d7" href="'.$link_url.'">'.$link_title.'</a></div>';
          echo $imagetemplate;
          endwhile;
           // Do something..
        endif;



        if( have_rows('column_three') ):
          while ( have_rows('column_three') ) : the_row();
          $image = get_sub_field('image');
          $title = get_sub_field('title');
          $message = get_sub_field('message');
          $link_url = get_sub_field('link')['url'];
          $link_title = get_sub_field('link')['title'];
          $imagetemplate = '
          <div class="col-lg-4 col-sm-12">
           <img src="'.$image.'" alt="'.$title.'">
           <h3>'.$title.'</h3>
           <p>'.$message.'</p>
           <a class="primary-link ml-auto mr-3 d8" href="'.$link_url.'">'.$link_title.'</a>
          </div>';
          echo $imagetemplate;
          endwhile;
           // Do something..
        endif;

        echo "</div>";

      elseif( get_row_layout() == 'three_column_quick_facts' ):
        $maintitle = get_sub_field("title");
        $maindescription = get_sub_field("intro");


        echo "<div class='row three_column_quick_facts'><div class='col-12'><h3>$maintitle</h3><hr><p>$maindescription</p></div>";
        if( have_rows('column_one') ):
          while ( have_rows('column_one') ) : the_row();
          $image = get_sub_field('image');
          $title = get_sub_field('fact_follow');
          $message = get_sub_field('message');
          $factlead = get_sub_field('fact_lead');
          $imagetemplate = '<div class="col-12 col-lg-4">
           <div class="image-wrap"><img class="rounded-circle fact" src="'.$image.'"><span class="factlead">'.$factlead.'</span></div>
           <h3>'.$title.'</h3>
           <p>'.$message.'</p>
          </div>';
          echo $imagetemplate;
          endwhile;
           // Do something..
        endif;


        if( have_rows('column_two') ):
          while ( have_rows('column_two') ) : the_row();
          $image = get_sub_field('image');
          $title = get_sub_field('fact_follow');
          $message = get_sub_field('message');
          $link = get_sub_field('link');
          $factlead = get_sub_field('fact_lead');
          $imagetemplate = '<div class="col-12 col-lg-4">
           <div class="image-wrap"><img class="rounded-circle fact" src="'.$image.'"><span class="factlead">'.$factlead.'</span></div>
           <h3>'.$title.'</h3>
           <p>'.$message.'</p>
          </div>';
          echo $imagetemplate; 
          endwhile;
           // Do something..
        endif;



        if( have_rows('column_three') ):
          while ( have_rows('column_three') ) : the_row();
          $image = get_sub_field('image');
          $title = get_sub_field('fact_follow');
          $message = get_sub_field('message');
          $factlead = get_sub_field('fact_lead');
          $imagetemplate = '<div class="col-12 col-lg-4">
           <div class="image-wrap"><img class="rounded-circle fact" src="'.$image.'"><span class="factlead">'.$factlead.'</span></div>
           <h3>'.$title.'</h3>
           <p>'.$message.'</p>
          </div>';
          echo $imagetemplate;
          endwhile;
           // Do something..
        endif;
        echo "</div>";

        //Subtitle section
        elseif( get_row_layout() == 'simple_content_sub_heading'):
          $subheadingcontent = get_sub_field('simple_heading_title');
          $subheadtemplate = '<div class="sub-heading"><h2>'.$subheadingcontent.'</h2></div>';
          echo $subheadtemplate;

        elseif( get_row_layout() == 'featured_helpful_resources'):
            $section_title = (get_sub_field('title_for_section')) ? get_sub_field('title_for_section') : 'Downloadable materials';
          if( have_rows('helpful_resources') ):
            
            $downloadabletemplate = '<div class="downloadable-n"><h2>'.$section_title.'</h2><ul>';
            $iconUrl = get_bloginfo('template_directory')."/inc/assets/images/downloadable.svg";
            while ( have_rows('helpful_resources') ) : the_row();
            $is_document = get_sub_field('is_document');			
            $resource = get_sub_field('resource');			
            if(!empty($is_document[0]) && strtolower($is_document[0]) == 'yes'){
              $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
              $res_title = ($resource['title']) ? $resource['title'] : 'Download';
              $res_raget = ($resource['target']) ? $resource['target'] : '_self';
              $downloadabletemplate .= '<li><a href="'.$res_url.'" target="'.$res_raget.'" download><span><img src="'.$iconUrl.'" alt="'.$res_title.'"></span>'.$res_title.'</a></li>';
            }
            else{
              $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
              $res_title = ($resource['title']) ? $resource['title'] : 'Download';
              $res_raget = ($resource['target']) ? $resource['target'] : '_self';
              $downloadabletemplate .= '<li><a href="'.$res_url.'" target="'.$res_raget.'">'.$res_title.'</a></li>';
            }
            endwhile;
            $downloadabletemplate .= '</ul></div>';
            echo $downloadabletemplate;
             // Do something..
          endif;


          elseif( get_row_layout() == 'news_downloadable_resources'):
            $section_title = (get_sub_field('title_for_section')) ? get_sub_field('title_for_section') : 'Downloadable materials';
          if( have_rows('downloadable_news_resources') ):            
            $downloadabletemplate = '<div class="downloadable-n"><h2>'.$section_title.'</h2><ul>';
            $iconUrl = get_bloginfo('template_directory')."/inc/assets/images/downloadable.svg";
            while ( have_rows('downloadable_news_resources') ) : the_row();
            $is_document = get_sub_field('is_document');
            $resource = get_sub_field('resource');
            if(!empty($is_document[0]) && strtolower($is_document[0]) == 'yes'){
              $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
              $res_title = ($resource['title']) ? $resource['title'] : 'Download';
              $res_raget = ($resource['target']) ? $resource['target'] : '_self';
              $downloadabletemplate .= '<li><a href="'.$res_url.'" target="'.$res_raget.'" download><span><img src="'.$iconUrl.'" alt="'.$res_title.'"></span>'.$res_title.'</a></li>';
            }
            else{
              $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
              $res_title = ($resource['title']) ? $resource['title'] : 'Download';
              $res_raget = ($resource['target']) ? $resource['target'] : '_self';
              $downloadabletemplate .= '<li><a href="'.$res_url.'" target="'.$res_raget.'">'.$res_title.'</a></li>';
            }
            endwhile;
            $downloadabletemplate .= '</ul></div>';
            echo $downloadabletemplate;
             // Do something..
          endif;


          elseif( get_row_layout() == 'news_helpful_resources'):
            if( have_rows('helpful_news_resources') ):
              $helpfulnewsresource = '<div class="helpful-resources-n"><h2>Helpful resources</h2><ul>';
              $iconUrl = get_bloginfo('template_directory')."/inc/assets/images/downloadable.svg";
              while ( have_rows('helpful_news_resources') ) : the_row();
              $is_document = get_sub_field('is_document');
              $resource = get_sub_field('resource');
              if(!empty($is_document[0]) && strtolower($is_document[0]) == 'yes'){
                $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
                $res_title = ($resource['title']) ? $resource['title'] : 'Download';
                $res_raget = ($resource['target']) ? $resource['target'] : '_self';
                $helpfulnewsresource .= '<li><a href="'.$res_url.'" target="'.$res_raget.'" download><span><img src="'.$iconUrl.'" alt="'.$res_title.'"></span>'.$res_title.'</a></li>';
              }
              else{
                $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
                $res_title = ($resource['title']) ? $resource['title'] : 'Download';
                $res_raget = ($resource['target']) ? $resource['target'] : '_self';
                $helpfulnewsresource .= '<li><a href="'.$res_url.'" target="'.$res_raget.'">'.$res_title.'</a></li>';
              }
              endwhile;
              $helpfulnewsresource .= '</ul></div>';
              echo $helpfulnewsresource;
               // Do something..
            endif;

            elseif( get_row_layout() == 'downloadable_news_resources'):
              if( have_rows('downloadable_news_resources') ):
                $helpfulnewsresource = '<div class="helpful-resources-n"><h2>Helpful resources</h2><ul>';
                $iconUrl = get_bloginfo('template_directory')."/inc/assets/images/downloadable.svg";
                while ( have_rows('downloadable_news_resources') ) : the_row();
                $is_document = get_sub_field('is_document');
                $resource = get_sub_field('resource');
                if(!empty($is_document[0]) && strtolower($is_document[0]) == 'yes'){
                  $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
                  $res_title = ($resource['title']) ? $resource['title'] : 'Download';
                  $res_raget = ($resource['target']) ? $resource['target'] : '_self';
                  $helpfulnewsresource .= '<li><a href="'.$res_url.'" target="'.$res_raget.'" download><span><img src="'.$iconUrl.'" alt="'.$res_title.'"></span>'.$res_title.'</a></li>';
                }
                else{
                  $res_url = ($resource['url']) ? $resource['url'] : 'javascript:void(0);';
                  $res_title = ($resource['title']) ? $resource['title'] : 'Download';
                  $res_raget = ($resource['target']) ? $resource['target'] : '_self';
                  $helpfulnewsresource .= '<li><a href="'.$res_url.'" target="'.$res_raget.'">'.$res_title.'</a></li>';
                }
                endwhile;
                $helpfulnewsresource .= '</ul></div>';
                echo $helpfulnewsresource;
                 // Do something..
              endif;





            elseif( get_row_layout() == 'accordion'):

              if( have_rows('accordion') ):
                echo '<div class="accordion"><div class="row"><div class="col"><div class="tabs">';
                $i=0;

                while ( have_rows('accordion') ) : the_row();
                  $panel_content = get_sub_field("panel_content");
                  $panel_title = get_sub_field("panel_title");
                  $panel = '
                        <div class="tab">
                          <input type="checkbox" id="chck'.$i.'">
                          <label class="tab-label" for="chck'.$i.'">'. $panel_title .'</label>
                          <div class="tab-content">
                            '. $panel_content .'
                          </div>
                        </div>
                      
                    ';

                  echo $panel;
                  $i++;
                endwhile;
                echo '</div></div></div></div>';
      
              endif;



              elseif( get_row_layout() == 'gallery_slider'):


              if( have_rows('gallery_slider') ):
                echo '<div class="gallery-slider-container"><div class="slider gallery-slider">';
                while ( have_rows('gallery_slider') ) : the_row();
                  $image = get_sub_field("image");
                  $caption = get_sub_field("image_caption");
                  $slide = '
                        <div>
                         <img class="" src="'.$image['url'].'">
                         <div class="caption">'.$caption.'</div>
                        </div>
                    ';

                  echo $slide;
   
                endwhile;
                echo '</div></div>';
      
              endif;




              elseif( get_row_layout() == 'doctors_staff'):
     
              $staff = get_sub_field('related_doctors');
              if ($staff) {
         
              $find_doc_page = site_url('find-a-doctor');
              }

              echo '<div class="single-location"><div class="container-fluid gray-back"><div class="row doctors-staff"><div class="col-12"><div id="intro">Doctors & staff <a style="margin-right:0 !important;" class="primary-link ml-auto mr-3" href="'.$find_doc_page.'">View all</a></div><div id="single_location_docslider" class="single_location slider doctors-slider">';

              foreach( $staff as $doctor ):

                $index = $index + 1;
                $permalink = get_the_permalink( $doctor->ID );
                $doc_title = get_the_title( $doctor->ID );
                $main_phone_number = get_field( 'main_phone_number', $doctor->ID );
                $profile_image = get_field( 'profile_image', $doctor->ID );
                $phone_icon_url = get_bloginfo( 'template_directory' ) . '/inc/assets/images/class-cell-phone.svg';
                $services = get_field( 'related_services', $doctor->ID );
                $service_list = "";

                foreach( $services as $service ):
                  $title = get_the_title( $service->ID );
                  $permalink = get_permalink( $service->ID );
                  $service_list .= '<a  class="service-bubble" href="'.$permalink.'">'.$title.'</a>';
                endforeach;

                if (!$profile_image) {
                  if(get_field("sex") != "female") {
                    $profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
                  }else{
                    $profile_image = get_bloginfo( 'template_directory' ) . "/inc/assets/images/avatar.png";
                  }
                }

                $doc_slider_template = '<div style="padding-left:25px;"><a href="'.$permalink .'" class="doctor-card-link"><div class="card" style="width: 18rem;" id="doctor-card"><img class="card-img-top" src="'.$profile_image.'" alt="Card image cap" width="286" height="199.5"><div class="card-body"><h3 class="card-title">'.$doc_title.'</h3><hr><p class="card-text">'.$service_list.'</p><span class="phone-number-container"><img class="smartphone-icon" src="'.$phone_icon_url.'"><span class="call">Call</span><span class="phone-number"> '.$main_phone_number.'</span></a></span></div></div></a></div>';
                echo $doc_slider_template;

              endforeach;

              echo '</div></div></div></div>';







            //two_panel_news_description
            elseif( get_row_layout() == 'two_panel_news_description'):
              $news_two_column_area_template = '<div class="news-content-main">';
              if(get_row_layout() == 'simple_news_content_section'){
                if( have_rows('simple_news_content_section') ):
                  $titlecontent = get_sub_field('title_two_column_news_section');
                  $content = get_sub_field('content');
                  //$news_two_column_area_template .= (!empty($titlecontent)) ? '<h2>'.$titlecontent.'</h2>': '';
                  $news_two_column_area_template .= '<h2>fdgs dfg sdfg sdfg sdfg sfdg sfd</h2>';
                  //$news_two_column_area_template .= (!empty($content)) ? '<p>'.$content.'</p>': '';
                endif;
              }
              
              $news_two_column_area_template .= '<div class="row">';
              if( have_rows('left_panel') ):
                $news_two_column_area_template .= '<div class="col-6">';
                while ( have_rows('left_panel') ) : the_row();
                  $image = get_sub_field('image');
                  $message = get_sub_field('message');
                  if (!empty($image)) {
                    $news_two_column_area_template .= '<div class="img-sec-bottom"><img src="'.$image.'" alt="News Section Left"></div>';
                  }
                  if(!empty($message)){
                    $news_two_column_area_template .= '<p>'.$message.'</p>';
                  }  
                 endwhile;
                 $news_two_column_area_template .= '</div>';
              endif;  
  
            if( have_rows('right_panel') ):
              $news_two_column_area_template .= '<div class="col-6">';
              while ( have_rows('right_panel') ) : the_row();
              $image = get_sub_field('image');
              $message = get_sub_field('message');
              if (!empty($image)) {
                $news_two_column_area_template .= '<div class="img-sec-bottom"><img src="'.$image.'" alt="News Section Left"></div>';
              }
              if(!empty($message)){
                $news_two_column_area_template .= '<p>'.$message.'</p>';
              }  
              endwhile;
              $news_two_column_area_template .= '</div>';
            endif;
            $news_two_column_area_template .= '</div></div>';

            echo $news_two_column_area_template;
          

      endif;
    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;

?>
