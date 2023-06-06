<div class="modal fade" id="classes-events-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <button type="button" class="close" data-dismiss="modal" id="mobile-close" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-angle-left"></i> Back</span>
        </button>
      </div>
      <div class="modal-body">
        			<div class="container-fluid" id="class-time-select">
        				<div class="row">
        					<div class="col-lg-6">
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style share-button">
                      <span class="share-text">Share</span>
                      <a class="a2a_dd" href="https://www.addtoany.com/share">
                          <img src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/share.svg";?>" border="0" alt="Share" width="50" height="50">
                       </a>
                    </div>
                    <h2 id="modal-class-name"></h2>
                    <p id="modal-class-description"></p>
                    <hr>
                    <ul class="modal-class-details">
                      <li><img class="icon-calendar" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-calendar.svg"?>"><span id="class-date"></span></li>
                      <li class="icon-time-main"><img class="icon-time" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-time.svg"?>"><span id="class-times"></span></li>
                      <li><img class="icon-cost" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-cost.svg"?>"><span id="class-cost"></span></li>
                      <li><img class="icon-location" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-location.svg"?>"><span id="class-location"></span></li>
                      <li id="phone-container"><img class="icon-phone" src="<?php echo get_bloginfo( 'template_directory' ) . "/inc/assets/images/class-cell-phone.svg"?>"><span id="class-phone" class="phone-number"></span></li>
                    </ul>
        					</div>
        					<div class="col-6" id="map-container">
                    <div>
                      <div class="acf-map-modal" data-zoom="16">
                      </div>
                    </div>
                    <a target="_blank" href="'+appointy_url+'" id="directions">Get Directions</a>
        					</div>


                  <div class="col-12">
                    <button id="time-select">Time</button>
                  </div>

        				</div>
        			</div>


              <div class="col-12">
                <!-- <div id="alt-dates-container">Alternative Dates & times <a class="primary-link ml-auto mr-3" href="<?php //echo site_url('health-wellness/classes-events/'); ?>">View all <span id="alternate_dates_counter"><?php //echo $count_posts = wp_count_posts( 'classes_events' )->publish; ?></span></a>
                </div> -->
                
                <div id="alt-dates-container">Alternative Dates & times <a class="primary-link ml-auto mr-3" href="<?php echo site_url('health-wellness/classes-events/'); ?>">View all <span id="alternate_dates_counter"></span></a>
                </div>
            

              </div>
              
              <div class="alt-classes">


              </div>




      </div>

    </div>
  </div>
</div>


<script>
$(document).ready(function() {
    //slick slider patch
    $(".slider").not('.slick-initialized').slick();

    // $(".card").click(function() {

    //   var event_id = $(this).data("event-id");
    //   console.log(event_id ,'<---event_id');
    //   if(event_id){
    //     var ribbon_text = $(this).find("#ribbon").text();
    //     var slide = '';
    //     var data = '';
    //     var locationToSearch = '';
    //     var googleMapLink = '';
    //     $.ajax({
    //         type: "GET",
    //         url: "/wp-json/wp/v2/classes_events/" + event_id,
    //         error: function(xhr, statusText) {
    //             console.log("Error: class_events_click_fetch" + statusText);
    //         },
    //         success: function(data) {
    //             console.log(data);
    //             $("#modal-class-name").text(data.ACF.name);
    //             $("#modal-class-description").text(data.ACF.description);
    //             $(".modal-class-details #class-date").text(data.ACF.date);
    //             $(".modal-class-details #class-cost").text("$" + data.ACF.cost);
    //             $("#classes-events-modal #ribbon").html("<span>" + ribbon_text + "</span>");
    //             var class_times = data.ACF.class_times;
    //             console.log(class_times)
    //             //$(".modal-class-details #class-times").append("<div class='multiple-time'><span class='select-at-time'>Select a time:</span>")
    //             $(".modal-class-details #class-times").html('');
    //             $.each(class_times, function(index, item) {
    //                 $(".modal-class-details #class-times").append('<div class="multiple-time"><span class="select-at-time">Select a time:</span><button data-appointy="' + item.appointy_link + '" class="service-bubble class-time-selector" >'+item.start_time + '</button></div>');
    //             });
    //             console.log(data.ACF.related_location);
    //             if(data.ACF.related_location.ID !== 'undefined'){
    //               locationToSearch = data.ACF.related_location;
    //             }
    //             else{
    //               locationToSearch = event_id;
    //             }

    //             var appointy = data.ACF.appointy_link;
    //             console.log(appointy,'<--appointly_link');
    //             $.ajax({
    //                 type: "GET",
    //                 url: "/wp-json/wp/v2/locations/" + locationToSearch,
    //                 success: function(data) {


    //                     $(".modal-class-details #class-phone").text(data.ACF.contact_information.phone);
    //                     $(".modal-class-details #class-location").text(data.ACF.contact_information.street_address);

                        
    //                     var latlng = new google.maps.LatLng(data.ACF.mapped_location.lat, data.ACF.mapped_location.lng);
    //                     var mapOptions = {
    //                         zoom: 18,
    //                         center: latlng
    //                     };

    //                     var map = new google.maps.Map($('#map-container .acf-map-modal')[0], mapOptions);
    //                     var customMarker = new google.maps.Marker({
    //                         position: latlng,
    //                         map: map,
    //                     });
                        
    //                     var mapAddressgoogle = data.ACF.contact_information.street_address;
    //                     mapAddressgoogle = mapAddressgoogle.replace(/\s+/g,"+");
    //                     console.log(mapAddressgoogle,'<-googlemaplink');
    //                     $('div#map-container a#directions').attr("href", 'https://www.google.com/maps/dir//'+mapAddressgoogle+'');
                        
    //                     $.ajax({
    //                         type: "GET",
    //                         url: "/wp-json/memorial/v2/alternate-classes/?term=Prediabetes Class&id=" + event_id,
    //                         success: function(data) {
    //                             slide = '';
    //                             $(data).each(function(index, item) {
    //                                 console.log(item);
    //                                 var cal_icon = templateDir + '/inc/assets/images/class-calendar.svg';
    //                                 var clock_icon = templateDir + '/inc/assets/images/class-time.svg';

    //                                 slide = `<div class="col-3">
    //                                   <div class="card bg-light mb-3" style="max-width:;">
    //                                     <div class="card-header">${item.class_type}</div>
    //                                     <div class="card-body">
    //                                       <ul class="modal-class-details">
    //                                         <li><img class="icon-calendar" src="${cal_icon}"><span id="class-date">${item.date}</span></li>
    //                                         <li><img class="icon-clock" src="${clock_icon}"><span id="class-time"><button class="service-bubble ">${item.times[0]}</button></span></li>
    //                                       </ul>
    //                                       <a href="${item.permalink}" class="">View Details</a>
    //                                     </div>
    //                                   </div>
    //                                 </div>`;

    //                                 $(".alt-classes").append(slide);

    //                             });

    //                             //console.log(slide);

    //                             $(".slider").not('.slick-initialized').slick();

    //                             $('.alt-classes').not('.slick-initialized').slick({
    //                                 dots: false,
    //                                 infinite: false,
    //                                 speed: 300,
    //                                 slidesToShow: 4,
    //                                 slidesToScroll: 3,
    //                                 responsive: [{
    //                                         breakpoint: 1024,
    //                                         settings: {
    //                                             slidesToShow: 3,
    //                                             slidesToScroll: 3,
    //                                             infinite: true,
    //                                             dots: false
    //                                         }
    //                                     },
    //                                     {
    //                                         breakpoint: 600,
    //                                         settings: {
    //                                             slidesToShow: 1,
    //                                             slidesToScroll: 1
    //                                         }
    //                                     },
    //                                     {
    //                                         breakpoint: 480,
    //                                         settings: {
    //                                             slidesToShow: 1,
    //                                             slidesToScroll: 1
    //                                         }
    //                                     }
                                       
    //                                 ]
    //                             });

    //                             $('.alt-classes').slick('refresh');
    //                         }
    //                     });                        
    //                 }
    //             });    
    //         }
    //     });


    //     $(document).on("click", ".class-time-selector", function(event) {
    //         var appointy_url = $(this).data("appointy");
    //         $("#time-select").replaceWith('<a target="_blank" href="' + googleMapLink + '" id="register">Register Online</a>');
    //         console.log("here");
    //         $(".class-time-selector").removeClass("active");
    //         $(this).addClass("active");
    //     });



    //     $('.phone-number').text(function(i, text) {
    //         return text.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2 $3');
    //     });
    //   }       

    // });
});


function class_events_search_modal(element){
  var event_id = jQuery(element).data("event-id");
  //console.log(element);
  console.log(event_id ,'<---Function event_id');
  if(event_id){
        var slide = '';
        var data = '';
        var locationToSearch = '';
        var googleMapLink = '';
        var relatedLocation = '';
        $.ajax({
            type: "GET",
            url: "/wp-json/wp/v2/classes_events/" + event_id,
            error: function(xhr, statusText) {
                console.log("Error: class_events_click_fetch" + statusText);
            },
            success: function(data) {
                console.log(data);
                relatedLocation = data.ACF.name;
                $("#modal-class-name").text(data.ACF.name);
                $("#modal-class-description").html(data.ACF.description);
                $(".modal-class-details #class-date").text(data.ACF.date);
                
                if(data.ACF.cost && data.ACF.cost !== ''){
                  $(".modal-class-details #class-cost").text("$" + data.ACF.cost);
                }
                else{
                  $(".modal-class-details #class-cost").text("Free");
                }

                if(data.ACF.call_to_schedule == 1) {
                    $("#time-select").remove();
                }
                
                var class_times = data.ACF.class_times;
               
                //$(".modal-class-details #class-times").append("<div class='multiple-time'><span class='select-at-time'>Select a time:</span>")
                $(".modal-class-details #class-times").html('');
                $.each(class_times, function(index, item) {

                     if (item.end_time != '') {
                        var end_time = ' - ' + item.end_time;
                    }else{
                        var end_time = '';
                    }

                    $(".modal-class-details #class-times").append('<div class="multiple-time"><span class="select-at-time">Time:</span><span data-appointy="' + item.appointy_link + '" class="class-time-selector" style="color:#ef7521;cursor:pointer;">'+item.start_time + end_time + '</span></div>');

                    
                });
                console.log(data.ACF.related_location.ID);
                if(data.ACF.related_location.ID && data.ACF.related_location.ID !== 'undefined'){
                  locationToSearch = data.ACF.related_location.ID;
                }
                else{
                  locationToSearch = event_id;
                }

                var appointy = data.ACF.appointy_link;
                console.log(appointy,'<--appointly_link');
                $.ajax({
                    type: "GET",
                    url: "/wp-json/wp/v2/locations/" + locationToSearch,
                    success: function(data) {

                        console.log("phone--->" + data.ACF.contact_information.phone);
                        if(data.ACF.contact_information.phone != "") {

                        $(".modal-class-details #class-phone").text(data.ACF.contact_information.phone);
                        }else{
                        $("#phone-container").remove();
                        }
                       
                        $(".modal-class-details #class-location").html(data.ACF.location_name + '<br>' + data.ACF.contact_information.street_address);
                        
                        var latlng = new google.maps.LatLng(data.ACF.mapped_location.lat, data.ACF.mapped_location.lng);

                        if (latlng != '(NaN, NaN)') {
                            var mapOptions = {
                                zoom: 18,
                                center: latlng
                            };


                            var map = new google.maps.Map($('#map-container .acf-map-modal')[0], mapOptions);
                            var customMarker = new google.maps.Marker({
                                position: latlng,
                                map: map,
                            });
                        }else{

                            var latlng = new google.maps.LatLng('40.23059', '-83.368861');

                            var mapOptions = {
                                zoom: 18,
                                center: latlng
                       
                            };


                            var map = new google.maps.Map($('#map-container .acf-map-modal')[0], mapOptions);
                        }
                        
                        var mapAddressgoogle = data.ACF.contact_information.street_address;

                        mapAddressgoogle = mapAddressgoogle.replace(/\s+/g,"+");
                        mapAddressgoogle = mapAddressgoogle.replace(/\<br\>/g,"");
                        mapAddressgoogle = mapAddressgoogle.replace(/\+{2,}/g,"+");
                        console.log(mapAddressgoogle,'<-googlemaplink');
                        $('div#map-container a#directions').attr("href", 'https://www.google.com/maps/dir//'+mapAddressgoogle+'');
                        
                        $.ajax({
                            type: "GET",
                            //url: "/wp-json/memorial/v2/alternate-classes/?term=Prediabetes Class&id=" + event_id,
                            url: "/wp-json/memorial/v2/alternate-classes/?term="+relatedLocation+"&id=" + event_id,
                            success: function(data) {
                                console.log(relatedLocation , '<-alt terms');
                        
                                if (!$.trim(data) == '' ) {
                                slide = '';
                                $(data).each(function(index, item) {
                                    console.log(item);
                                    var cal_icon = templateDir + '/inc/assets/images/class-calendar.svg';
                                    var clock_icon = templateDir + '/inc/assets/images/class-time.svg';

                                    // slide = `<div class="col-3">
                                    //   <div class="card bg-light mb-3" style="max-width:;">
                                    //     <div class="card-header">${item.class_type}</div>
                                    //     <div class="card-body">
                                    //       <ul class="modal-class-details">
                                    //         <li><img class="icon-calendar" src="${cal_icon}"><span id="class-date">${item.date}</span></li>
                                    //         <li><img class="icon-clock" src="${clock_icon}"><span id="class-time"><button class="service-bubble ">${item.times[0]}</button></span></li>
                                    //       </ul>
                                    //       <a href="${item.permalink}" class="">View Details</a>
                                    //     </div>
                                    //   </div>
                                    // </div>`;

                                    slide = `<div class="col-3">
                                      <a href="${item.permalink}" class="">
                                        <div class="card bg-light mb-3" style="max-width:;">
                                          <div class="card-header">${item.class_type}</div>
                                          <div class="card-body">
                                            <ul class="modal-class-details">
                                              <li><img class="icon-calendar" src="${cal_icon}"><span id="class-date">${item.date}</span></li>
                                              <li><img class="icon-clock" src="${clock_icon}"><span id="class-time"><button class="service-bubble ">${item.times[0]}</button></span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </a>
                                    </div>`;



                                    $(".alt-classes").append(slide);


                                });
                            }else{
                                $("#alt-dates-container").remove();
                                $('.alt-classes').remove();
                            }
                                //console.log(slide);
                                $(".slider").not('.slick-initialized').slick();
                                $('.alt-classes').not('.slick-initialized').slick({
                                    dots: false,
                                    infinite: false,
                                    speed: 300,
                                    slidesToShow: 4,
                                    slidesToScroll: 3,
                                    responsive: [{
                                            breakpoint: 1024,
                                            settings: {
                                                slidesToShow: 3,
                                                slidesToScroll: 3,
                                                infinite: false,
                                                dots: false
                                            }
                                        },
                                        {
                                            breakpoint: 600,
                                            settings: {
                                                slidesToShow: 1,
                                                slidesToScroll: 1
                                            }
                                        },
                                        {
                                            breakpoint: 480,
                                            settings: {
                                                slidesToShow: 1,
                                                slidesToScroll: 1
                                            }
                                        }
                                        // You can unslick at a given breakpoint now by adding:
                                        // settings: "unslick"
                                        // instead of a settings object
                                    ]
                                });
                                $('.alt-classes').slick('refresh');
                            }
                        });                        
                    }
                });             
            }
        });


        $(document).on("click", ".class-time-selector", function(event) {
            ;
            var appointy_url = $(this).data("appointy");
            console.log(appointy_url);
            $("#time-select").replaceWith('<a target="_blank" href="'+appointy_url+'" id="register">Register Online</a>');
            console.log("here");
            $(".class-time-selector").removeClass("active");
            jQuery(element).addClass("active");
        });

        $('.phone-number').text(function(i, text) {
            return text.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2 $3');
        });
    } 
}
</script>
