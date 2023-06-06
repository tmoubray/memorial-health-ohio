var isMobile = {
  Android: function () {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function () {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function () {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function () {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function () {
    return navigator.userAgent.match(/IEMobile/i);
  },
  any: function () {
    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
  }
};


$('.gallery-slider').slick({

});




$('.alt-class-picker').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
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




$('#mega-menu-primary-header').append('<div class="navbar-collapse justify-content-end collapse show" id="main-nav" style=""><form action="/" class="form-inline my-2 my-lg-0" id="primary-header-search-mobile"><i class="fa fa-search icon"></i><input type="search" class="search-field form-control" placeholder="Search" value="" name="s" title="Search for:"></form></div>');


$(document).ready(function(){
    
   
      var x = window.location.origin + '/wp-content/themes/memorial_health/inc/assets/images/main-logo.svg';

      var m = '<a style="padding-left:10px;" href="/"><img src="'+x+'" alt="Doctors"></a>'

      $('.mega-toggle-blocks-left').html(m);



});


$(document).ready(function(){

      $('#mobile-main-nav-container #mega-menu-primary-header').prepend('<div class="navbar-collapse justify-content-end collapse show" id="main-nav" style=""><ul style="padding:0;"><li class="mega-mh_add_bottom_border mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-has-children mega-menu-megamenu mega-align-bottom-left mega-menu-megamenu mega-menu-item-698 mh_add_bottom_border"><form action="/" class="form-inline my-2 my-lg-0" id="primary-header-search-mobile"><i class="fa fa-search icon"></i><input type="search" class="search-field form-control" placeholder="Search" value="" name="s" title="Search for:"></form></li></ul></div>');
      $('#mobile-main-nav-container #mega-menu-primary-header').append('<hr style="width:95%">');




      $('.top-nav-option').each(function (i, obj) {
        var nav_option = $(obj).text();
        var nav_href = $(obj).find('a').attr('href');
        var nav_target = $(obj).find('a').attr('target');

        var sub_mobile_template = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="mega-mh_add_bottom_border mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-has-children mega-menu-megamenu mega-align-bottom-left mega-menu-megamenu mega-menu-item-698 mh_add_bottom_border" >' +
          '<a style="font-size:20px;color:#4a4a4a;" title="Find a Doctor" target="'+nav_target+'" href="'+nav_href+'" class="nav-link">' + nav_option +
          '<i class="fas fa-external-link-alt" style="float:right;color:#EF7521;"></i></a></li>';
        $("#mobile-main-nav-container #mega-menu-primary-header").append(sub_mobile_template);
      });


      $('#mobile-main-nav-container #mega-menu-primary-header').append('<hr style="width:95%">');
      $('#mobile-main-nav-container #mega-menu-primary-header').append('<li style="display: flex;padding: 2rem;font-size: 20px;" itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="mobile-sub-nav-menu-item">High Contrast <div class="can-toggle demo-rebrand-2"><input id="e" onclick="mobile_nav_contrast(event,this);" type="checkbox"><label for="e"><div class="can-toggle__switch" data-checked="On" data-unchecked="Off"></div><div class="can-toggle__label-text"></div></label></div></li>');
});






$(document.body).on('focus', 'input' ,function(e){
  $('.mega-menu-toggle').addClass('mega-menu-open');
});


$('.single-item').slick({
  dots: true,
  autoplay: true,
  autoplaySpeed: 15000,
  customPaging: function (slider, i) {
    return '<div class="custom-slick-dots" id=' + i + "></div>";
  }
});

$('.single-item').each(function () {
  var $slide = $(this).parent();
  if ($slide.attr('aria-describedby') != undefined) { // ignore extra/cloned slides
    $(this).attr('id', $slide.attr('aria-describedby'));
  }
});

$(document).ajaxStart(function () {
  $(".loader").show();
}).ajaxStop(function () {
  $(".loader").hide();
});

if (isMobile.any()) {
  $(".slider").not('.slick-initialized').slick();
}




/*New js*/
function mobile_nav_contrast(e, el) {
  if (jQuery(el).is(":checked")) {
    jQuery('body').addClass("contrast");
  } else {
    jQuery('body').removeClass("contrast");
  }
}
/*New js*/

/*color switcher  js Starts*/
const toggleSwitch = document.querySelector('.can-toggle input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');

if (currentTheme) {
  document.documentElement.setAttribute('data-theme', currentTheme);
  if (currentTheme === 'dark') {
    toggleSwitch.checked = true;
    mobile_nav_contrast(null, toggleSwitch);
  }
}



$("#primary-service-search").submit(function (e) {
  e.preventDefault();
  var current_criteria_search = $(".service-criteria-search").val();
  var url = '/wp-json/memorial/v2/services/main-search/?term=' + current_criteria_search;
  console.log(url);
  console.log("-----------");

  //console.log("/wp-json/memorial/v2/services/main-search/?term=" + current_criteria_search);
  $.ajax({
    type: "GET",
    url: url,
    error: function (xhr, statusText, error) {
      //alert("Error: " + error);
      //console.log("Error:", error);
    },
    success: function (data) {

      console.log("----->"+data.service);

      if (data.length > 0) {
        $('div.results').html('<span>Found ' + data.length + ' results</span>');
      }
      if (data.length == 0) {
        $('div.results').html('<span>Found 0 results</span>');
      }

      $("#main-search").html('');
      $(data).each(function (i, obj) {
        var terms = [];
        if (obj.taxonomy_terms.length) {
          terms = obj.taxonomy_terms
        }
        var card = `<div class="col-lg-6 col-12">
        <div class="half-width">
          <div class="float-left left">
                <div class="card">
                  <h2><a href="${obj.permalink}">${obj.service}</a></h2>
                  ${terms.map(elmt => `
                    <a href="${obj.permalink}">${elmt.name}</a>
                  `).join('')}</div>
                </div>
              </div>
            </div>
          </div>`;
        $(".pagination-nav-container").html("");
        $("#main-search").append(card);
      })
    }
  });
});





$("#primary-dr-search").submit(function (e) {
  e.preventDefault();
 console.log("here");

  var accepting_new_patients = $("#exampleCheck1").prop('checked');
  var accepting_telehealth = $("#exampleCheck2").prop('checked');
  var is_dual_search = $(".doctor-criteria-search").val() && $(".doctor-location-search").val() ? 1 : 0;
  var current_location = $(".doctor-location-search").val();
  var current_criteria_search = $(".doctor-criteria-search").val();

  var show_accepting_new_patient = $("#exampleCheck1").prop('checked');
  var show_accepting_tele = $("#exampleCheck2").prop('checked');




  // if ((current_location == '') && (current_criteria_search == '')) {
  //   //console.log(current_location, typeof current_location);
  //   //console.log(current_criteria_search, typeof current_criteria_search);
  //   $(".doctor-location-search").css('border-bottom', '#ff0000 1px solid');
  //   $(".doctor-criteria-search").css('border-bottom', '#ff0000 1px solid');
  //   return false;
  // }
  // else {
  //   $(".doctor-location-search").css('border-bottom', '');
  //   $(".doctor-criteria-search").css('border-bottom', '');
  //   $(".lds-spinner").show();
  // }

  var servicebubble = '';
  var postTypeChosen = $("#post_type_chosen_search").val();
  var profile_image = window.location.origin + '/wp-content/themes/memorial_health/inc/assets/images/class-time.svg';
  //console.log(current_location);
  //console.log(current_criteria_search);



  console.log("/wp-json/memorial/v2/doctors/main-search/?show_accepting_new_patient=" + encodeURIComponent(show_accepting_new_patient) + "&type=doctor&show_accepting_tele=" + encodeURIComponent(show_accepting_tele) + "&locationterm=" + encodeURIComponent(current_location) + "&generalterm=" + current_criteria_search);
  $.ajax({
    type: "GET",
    url: "/wp-json/memorial/v2/doctors/main-search/?show_accepting_new_patient=" + encodeURIComponent(show_accepting_new_patient) + "&type=doctor&show_accepting_tele=" + encodeURIComponent(show_accepting_tele) + "&locationterm=" + encodeURIComponent(current_location) + "&generalterm=" + current_criteria_search,
    error: function (xhr, statusText, error) {
      //alert("Error: " + error);
      //console.log("Error:", error);
    },
    success: function (data) {

      console.log(data);
      //console.log(data);
      //console.log(data[0]);
      //console.log(typeof data);
      $(".lds-spinner").hide();
      if (data.length > 0) {
        $('div.results').html('<span>Found ' + data.length + ' results</span>');
      }
      if (data.length == 0) {
        $('div.results').html('<span>Found 0 results</span>');
      }
      $("#main-search").html('');
      //NEW
      $(data).each(function (i, obj) {
        console.log(obj);
        //console.log(templateUrl);
        servicebubble = '';
        if (obj.profile_image != false) {
          var profile_image = obj.profile_image;
          console.log("here1");
        } else {

          var profile_image = window.location.origin + '/wp-content/themes/memorial_health/inc/assets/images/avatar.png';
        }

        if (obj.service) {
          obj.service.forEach(function (entry) {
            //console.log(entry);
            var serviceLink = window.location.origin + '/' + entry.post_type + '/' + entry.post_name;
            //console.log(serviceLink);
            servicebubble += '<a class="service-bubble" href="' + serviceLink + '">' + entry.post_title + '</a>';
          });
        }
        else {
          servicebubble = '';
        }

        if (obj.accepting_new_patients == "yes") {

          accepting_new_patients_flag = '<svg version="1.1" style="position:absolute;bottom:-2px;left:0;width:10rem;height:25px;width:175px;" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 200 25" style="enable-background:new 0 0 200 25;" xml:space="preserve"> <style type="text/css"> .st0{fill:#752F89;} .st1{fill:#FFFFFF;} </style> <rect class="st0" width="200" height="25"/> <g> <path class="st1" d="M5.1,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4H5.1V7.3z M7.2,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M12.1,7.3c0.7-0.1,1.5-0.2,2.3-0.2c1.2,0,2.2,0.2,2.9,0.8c0.7,0.6,0.8,1.3,0.8,2.2c0,1.2-0.6,2.2-1.7,2.7v0 c0.7,0.3,1.1,1,1.3,2.1c0.2,1.2,0.5,2.5,0.7,2.9h-2.2c-0.1-0.3-0.4-1.4-0.5-2.6c-0.2-1.3-0.5-1.7-1.2-1.7h-0.3v4.3h-2.1V7.3z M14.2,12h0.4c0.9,0,1.4-0.7,1.4-1.7c0-0.9-0.4-1.6-1.3-1.6c-0.2,0-0.4,0-0.5,0.1V12z"/> <path class="st1" d="M21.6,15.4l-0.5,2.5h-2l2.3-10.8h2.5L26,17.9h-2l-0.5-2.5H21.6z M23.3,13.8L23,11.5c-0.1-0.7-0.3-1.7-0.4-2.4 h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H23.3z"/> <path class="st1" d="M32,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3c0-4.1,2.3-5.7,4.4-5.7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L32,17.7z"/> <path class="st1" d="M34.6,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M41.6,7.1v10.8h-2.1V7.1H41.6z"/> <path class="st1" d="M48.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C42.8,8.6,45,7,47.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L48.5,17.7z"/> <path class="st1" d="M54,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5H54V13.2z"/> <path class="st1" d="M60,15.4l-0.5,2.5h-2l2.3-10.8h2.5l2.1,10.8h-2L62,15.4H60z M61.8,13.8l-0.4-2.3c-0.1-0.7-0.3-1.7-0.4-2.4h0 c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H61.8z"/> <path class="st1" d="M70.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C64.8,8.6,67,7,69.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L70.5,17.7z"/> <path class="st1" d="M76.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C70.8,8.6,73,7,75.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L76.5,17.7z"/> <path class="st1" d="M82.1,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M83.6,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M85.7,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M92.2,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M99.2,7.1v10.8h-2.1V7.1H99.2z"/> <path class="st1" d="M100.9,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H100.9z"/> <path class="st1" d="M114.9,17.6c-0.5,0.2-1.5,0.4-2.2,0.4c-1.2,0-2.2-0.4-2.9-1.1c-0.9-0.9-1.4-2.5-1.4-4.4c0-3.9,2.3-5.6,4.6-5.6 c0.8,0,1.4,0.2,1.8,0.3l-0.4,1.8c-0.3-0.1-0.7-0.2-1.2-0.2c-1.4,0-2.6,1-2.6,3.8c0,2.6,1,3.5,2,3.5c0.2,0,0.3,0,0.4,0v-2.6h-1v-1.7 h2.9V17.6z"/> <path class="st1" d="M119,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H119z"/> <path class="st1" d="M131.7,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M134.5,17.9l-1.8-10.8h2.2l0.5,4.3c0.1,1.2,0.2,2.5,0.4,3.8h0c0.1-1.3,0.4-2.5,0.6-3.8l0.8-4.3h1.7l0.7,4.3 c0.2,1.2,0.4,2.4,0.5,3.8h0c0.1-1.4,0.3-2.6,0.4-3.8l0.5-4.3h2l-1.9,10.8H139l-0.6-3.5c-0.2-1-0.3-2.2-0.5-3.6h0 c-0.2,1.3-0.4,2.5-0.6,3.6l-0.7,3.5H134.5z"/> <path class="st1" d="M146.7,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M148.8,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M155.2,15.4l-0.5,2.5h-2L155,7.1h2.5l2.1,10.8h-2l-0.5-2.5H155.2z M156.9,13.8l-0.4-2.3 c-0.1-0.7-0.3-1.7-0.4-2.4h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H156.9z"/> <path class="st1" d="M161.3,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M168.3,7.1v10.8h-2.1V7.1H168.3z"/> <path class="st1" d="M174.5,13.2h-2.5v2.9h2.8v1.8H170V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M176.1,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H176.1z"/> <path class="st1" d="M185.4,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M190.2,15.8c0.4,0.2,1.2,0.4,1.8,0.4c1,0,1.5-0.5,1.5-1.2c0-0.8-0.5-1.2-1.4-1.8c-1.5-0.9-2-2-2-3 c0-1.7,1.2-3.2,3.4-3.2c0.7,0,1.4,0.2,1.7,0.4l-0.3,1.8c-0.3-0.2-0.8-0.4-1.4-0.4c-0.9,0-1.3,0.5-1.3,1.1c0,0.6,0.3,1,1.5,1.7 c1.4,0.9,2,2,2,3.1c0,2-1.5,3.3-3.6,3.3c-0.9,0-1.7-0.2-2.1-0.4L190.2,15.8z"/> </g> </svg>';
         }else{
          accepting_new_patients_flag = '';
         }



        var phone_section = !obj.phone_number ? '' : `<span class="phone-number-container"><img alt="cell icon" src="${script_ajax.theme_path}'/inc/assets/images/class-cell-phone.svg'"><span class="call">Call</span><a href="tel:${obj.phone_number}" class="phone-number"> ${obj.phone_number} </a></span>`;

        var card = `<div class="col-3">
          <a href="${obj.profile_link}" class="doctor-card-link" title="View profile">
              </a><div class="card" style="width: 18rem;" id="doctor-card"><a href="${obj.profile_link}" class="doctor-card-link">
                <div style="position:relative;display:inline-block;transition: transform 150ms ease-in-out;">
                <img class="card-img-top" src="${profile_image}" alt="Card image cap" width="286" height="199.5">
                ${accepting_new_patients_flag}
                </div>
                </a><div class="card-body"><a href="${obj.profile_link}" class="doctor-card-link">
                  <h3 class="card-title">${obj.name}</h3>
                  <hr>
                  </a><p class="card-text">${servicebubble}</p>
                  ${phone_section}
                </div>
              </div>
          </div></a>`;

        // var card = `<div class="col-3">
        // <a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link">
        //     </a><div class="card" style="width: 18rem;" id="doctor-card"><a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link">
        //       <img class="card-img-top" src="${profile_image}" alt="Card image cap" width="286" height="199.5">
        //       </a><div class="card-body"><a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link">
        //         <h3 class="card-title">${obj.name}</h3>
        //         <hr>
        //         </a><p class="card-text"><a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link"></a><a class="service-bubble" href="` + window.location.origin + `/services/oncology/">Oncology</a>
        //            <a class="service-bubble" href="`+ window.location.origin + `/services/physical-therapy-sports-medicine/">Physical Therapy &amp; Sports Medicine</a>
        //            <a class="service-bubble" href="`+ window.location.origin + `/doctors/cindy-baker-md/">+ 1</a>
        //         </p>
        //         <span class="phone-number-container"><img src="/inc/assets/images/class-cell-phone.svg"> <span class="call">Call</span> <span class="phone-number">(800) 288 2999</span></span>
        //       </div>
        //     </div>
        // </div></a>`;

        var accepting_new_patients = $("#exampleCheck1").prop('checked');
        var accepting_telehealth = $("#exampleCheck2").prop('checked');

        
    


         console.log("-----np" + accepting_new_patients);
        console.log("-----tel" + accepting_telehealth);


        console.log("-----obj-np" + obj.accepting_new_patients);
        console.log("-----obj-tel" + obj.accepting_telehealth_appointment);

        $(".pagination-nav-container").html("");


        if(accepting_telehealth == true && accepting_new_patients == true) {
          if(obj.accepting_telehealth_appointment == "yes"|| obj.accepting_new_patients == "yes") {
          $("#main-search").append(card);
          }
        }else if(accepting_telehealth == false && accepting_new_patients == true) {
          if(obj.accepting_telehealth_appointment == "no" && obj.accepting_new_patients == "yes") {
          $("#main-search").append(card);
          }
          if(obj.accepting_telehealth_appointment == "yes" && obj.accepting_new_patients == "no") {
          
          }
          if(obj.accepting_telehealth_appointment == "yes" && obj.accepting_new_patients == "yes") {
          $("#main-search").append(card);
          }
        }else if(accepting_telehealth == true && accepting_new_patients == false) {
          if(obj.accepting_telehealth_appointment == "yes" && obj.accepting_new_patients == "no") {
          $("#main-search").append(card);
          }
          if(obj.accepting_telehealth_appointment == "no" && obj.accepting_new_patients == "yes") {
          
          }
          if(obj.accepting_telehealth_appointment == "yes" && obj.accepting_new_patients == "yes") {
          $("#main-search").append(card);
          }
        }else{
          $("#main-search").append(card);
        }


      });
      //OLD
      // $(data).each(function (i, obj) {
      //   //console.log("------" + obj.post_title);
      //   servicebubble = '';
      //   //console.log(obj.profile_image);
      //   //console.log(typeof obj.profile_image);
      //   if (obj.profile_image != null && obj.profile_image) {
      //     profile_image = obj.profile_image;
      //   }
      //   else if (obj.profile_image === false) {
      //     profile_image = templateUrl + "/inc/assets/images/avatar.png";
      //   }
      //   else {
      //     profile_image = templateUrl + "/inc/assets/images/avatar.png";
      //   }

      //   if (obj.service) {
      //     obj.service.forEach(function (entry) {
      //       //console.log(entry);
      //       var serviceLink = window.location.origin + '/' + entry.post_type + '/' + entry.post_name;
      //       //console.log(serviceLink);
      //       servicebubble += '<a class="service-bubble" href="' + serviceLink + '">' + entry.post_title + '</a>';
      //     });
      //   }
      //   else {
      //     servicebubble = '';
      //   }

      //   var card = `<div class="col-3">
      //   <a href="${obj.profile_link}" class="doctor-card-link" title="View profile">
      //       </a><div class="card" style="width: 18rem;" id="doctor-card"><a href="${obj.profile_link}" class="doctor-card-link">
      //         <img class="card-img-top" src="${profile_image}" alt="Card image cap" width="286" height="199.5">
      //         </a><div class="card-body"><a href="${obj.profile_link}" class="doctor-card-link">
      //           <h3 class="card-title">${obj.name}</h3>
      //           <hr>
      //           </a><p class="card-text">${servicebubble}</p>
      //           <span class="phone-number-container"><img alt="phone icon" src="${script_ajax.theme_path}'/inc/assets/images/class-cell-phone.svg'"><span class="call">Call</span><a href="tel:${obj.phone_number}" class="phone-number"> ${obj.phone_number} </a></span>
      //         </div>
      //       </div>
      //   </div></a>`;
      //   $(".pagination-nav-container").html("");
      //   $("#main-search").append(card);
      // })
    }
  });


window.history.replaceState(null, null, "?general_term="+current_criteria_search+"&accepting_new_patients="+accepting_new_patients+"&accepting_telehealth="+accepting_telehealth+"&current_location="+current_location);


});



$('.form-check .form-check-input').on('click',function(){
      $("#doc_loc_search_submit").trigger( "click" );
  });



$("#primary-location-search").submit(function (e) {

  e.preventDefault();

  var current_location = $(".locations-location-search").val();
  var current_criteria_search = $(".location-criteria-search").val();

  if ((current_location == '') && (current_criteria_search == '')) {
    //console.log(current_location, typeof current_location);
    //console.log(current_criteria_search, typeof current_criteria_search);
    $(".locations-location-search").css('border-bottom', '#ff0000 1px solid');
    $(".location-criteria-search").css('border-bottom', '#ff0000 1px solid');
    return false;
  }
  else {
    $(".locations-location-search").css('border-bottom', '');
    $(".location-criteria-search").css('border-bottom', '');
    $(".lds-spinner").show();
  }

  $.ajax({
    type: "GET",
    url: "/wp-json/memorial/v2/locations/main-search/?locationterm=" + encodeURIComponent(current_location) + "&generalterm=" + current_criteria_search,
    error: function (xhr, statusText, error) {
      //console.log("Error:", error);
    },
    success: function (data) {
      $(".lds-spinner").hide();
      if (data.length > 0) {
        $('div.results').html('<span>Found ' + data.length + ' results</span>');
      }
      if (data.length == 0) {
        $('div.results').html('<span>Found 0 results</span>');
      }
      $("#main-search").html('');
      $(data).each(function (i, obj) {

        if (obj.hide_from_locations_and_search == false) {
        //console.log(obj);
        var card = `<div class="col-lg-6 col-sm-12">
            <a class="card-link" href="${obj.url}">
              <div class="card wide-card-container">
                  <div class="card-horizontal">
                      <div class="img-square-wrapper">
                          <img class="location-image" src="${obj.image}" alt="Card image cap">
                      </div>
                      <div class="card-body">
                        <span class="logo-container"><img alt="service logo" class="service-logo" src="${obj.logo}"></span>


                              <p class="card-text location-address">${obj.contact_information.street_address}</p>
                              <span class="location-phone phone-number">${obj.contact_information.phone}

                      </span></div>
                  </div>
              </div>
            </a>
        </div>`;
        $(".pagination-nav-container").html("");
        $("#main-search").append(card);
       }
      })
    }
  });

});




$(document).on("change submit", ".primary-class-event-search-class, .primary-class-event-search-type, #primary-class-event-search", function (e) {
  e.stopImmediatePropagation();
  e.preventDefault();
  var gen_search = $('#classs_general_search').val();
  var class_name = $('.class-name-filter').val();
  var class_type = $('.class-type-filter').val();
  var current_value = $(this).val();
  var open_search = $("#classs_general_search").val();
  var url = '/wp-json/memorial/v2/classes/general/?open_search_term='+encodeURIComponent(gen_search)+'&class_name='+encodeURIComponent(class_name)+'&class_type='+encodeURIComponent(class_type);
  
  
  
  if (current_value != '' || gen_search != '') {

  $.ajax({
    type: "GET",
    url: url,
    error: function (xhr, statusText, error) {
      //alert("Error: " + error);
      //console.log("Error:", error);
    },
    success: function (data) {


      $("#main-search").hide('');
      $("#main-search").html('');
      


      $(".pagination-nav-container").html("");
      var dataCount = data.length;
      var countHtml = 'Showing ' + dataCount + ' of ' + dataCount + ' results';
      $('#ce_search_counts').html(countHtml);

      $(data).each(function (i, obj) {


        console.log(obj);
        var card = `<div class="col-12 col-lg-3 col-md-6">
       <div class="card" style="width: 18rem;" id="class-event-card" onclick="class_events_search_modal(this);" data-event-id="5168"><a href="${obj.permalink}">
          <img class="card-img-top" src="${obj.image}" alt="Card image cap">
          </a><div class="card-body"><a href="${obj.permalink}">
            <h5 class="card-title">${obj.name}</h5>
            <hr>
            <div class="class-date"><img src="/wp-content/themes/memorial_health/inc/assets/images/class-calendar.svg">${obj.date}</div>
            </a><div><a href="${obj.permalink}">
              <img class="class-times" src="/wp-content/themes/memorial_health/inc/assets/images/class-time.svg">
              </a><a href="${obj.permalink}" class="service-bubble">${obj.time}</a>
            </div>
            <div class="class-location">
              <div class="location-icon"><img src="/wp-content/themes/memorial_health/inc/assets/images/pin.svg"></div>
            <div>${obj.contact_information.street_address}</div></div>
            <a href="${obj.permalink}" type="button" class="btn btn-primary btn-lg btn-block">
              FREE
            </a>
          </div>
        </div>
      </div>`



      $("#main-search").append(card);


      });

      window.history.replaceState(null, null, "?open_search_term="+gen_search+"&class_name="+class_name+"&class_type="+class_type);
      $("#main-search").show('');

    }
  });

 }


});





//DOCTOR SEARCHES
////////////////////////////////////////////////////
var critera_type = null;
$(".doctor-criteria-search").focus(function () {
  var servicebubble = '';
  $(".doctor-criteria-search").css('border-bottom', '');
  $.ajax({
    type: "GET",
    url: "/wp-json/memorial/v2/general-search-ahead/",
    success: function (data) {
      var parsed_source = JSON.parse(data);
      $(".doctor-criteria-search").autocomplete({
        source: parsed_source,
        select: function (e, ui) {
          var isdualsearch = $(".doctor-location-search").val() ? 1 : 0;
          var current_location = $(".doctor-location-search").val();
          console.log("/wp-json/memorial/v2/doctors/main-search/?isdualsearch=" + isdualsearch + "&type=" + ui.item.class + "&generalterm=" + encodeURIComponent(ui.item.value) + "&locationterm=" + encodeURIComponent(current_location));

          critera_type = ui.item.class;
          $.ajax({
            type: "GET",
            url: "/wp-json/memorial/v2/doctors/main-search/?isdualsearch=" + isdualsearch + "&type=" + ui.item.class + "&generalterm=" + encodeURIComponent(ui.item.value) + "&locationterm=" + encodeURIComponent(current_location),
            error: function (xhr, statusText, error) {
              //alert("Error: " + error);
              //console.log("Error:", error);
            },
            success: function (data) {
              //console.log(data);
              if (data.length > 0) {
                $('div.results').html('<span>Found ' + data.length + ' results</span>');
              }
              if (data.length == 0) {
                $('div.results').html('<span>Found 0 results</span>');
              }
              $("#main-search").html('');
              $(data).each(function (i, obj) {


                //console.log(templateUrl);
                servicebubble = '';

                console.log(obj.profile_image);
             
                if (obj.profile_image === false) {
                  var profile_image = window.location.origin + '/wp-content/themes/memorial_health/inc/assets/images/avatar.png';
                } else {
                  var profile_image = obj.profile_image;
                }

          

                if (obj.service) {
                  obj.service.forEach(function (entry) {
                    //console.log(entry);
                    var serviceLink = window.location.origin + '/' + entry.post_type + '/' + entry.post_name;
                    //console.log(serviceLink);
                    servicebubble += '<a class="service-bubble" href="' + serviceLink + '">' + entry.post_title + '</a>';
                  });
                }
                else {
                  servicebubble = '';
                }

                if (obj.accepting_new_patients == "yes") {

                  accepting_new_patients_flag = '<svg version="1.1" style="position:absolute;bottom:-2px;left:0;width:10rem;height:25px;width:175px;" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 200 25" style="enable-background:new 0 0 200 25;" xml:space="preserve"> <style type="text/css"> .st0{fill:#752F89;} .st1{fill:#FFFFFF;} </style> <rect class="st0" width="200" height="25"/> <g> <path class="st1" d="M5.1,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4H5.1V7.3z M7.2,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M12.1,7.3c0.7-0.1,1.5-0.2,2.3-0.2c1.2,0,2.2,0.2,2.9,0.8c0.7,0.6,0.8,1.3,0.8,2.2c0,1.2-0.6,2.2-1.7,2.7v0 c0.7,0.3,1.1,1,1.3,2.1c0.2,1.2,0.5,2.5,0.7,2.9h-2.2c-0.1-0.3-0.4-1.4-0.5-2.6c-0.2-1.3-0.5-1.7-1.2-1.7h-0.3v4.3h-2.1V7.3z M14.2,12h0.4c0.9,0,1.4-0.7,1.4-1.7c0-0.9-0.4-1.6-1.3-1.6c-0.2,0-0.4,0-0.5,0.1V12z"/> <path class="st1" d="M21.6,15.4l-0.5,2.5h-2l2.3-10.8h2.5L26,17.9h-2l-0.5-2.5H21.6z M23.3,13.8L23,11.5c-0.1-0.7-0.3-1.7-0.4-2.4 h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H23.3z"/> <path class="st1" d="M32,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3c0-4.1,2.3-5.7,4.4-5.7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L32,17.7z"/> <path class="st1" d="M34.6,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M41.6,7.1v10.8h-2.1V7.1H41.6z"/> <path class="st1" d="M48.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C42.8,8.6,45,7,47.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L48.5,17.7z"/> <path class="st1" d="M54,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5H54V13.2z"/> <path class="st1" d="M60,15.4l-0.5,2.5h-2l2.3-10.8h2.5l2.1,10.8h-2L62,15.4H60z M61.8,13.8l-0.4-2.3c-0.1-0.7-0.3-1.7-0.4-2.4h0 c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H61.8z"/> <path class="st1" d="M70.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C64.8,8.6,67,7,69.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L70.5,17.7z"/> <path class="st1" d="M76.5,17.7c-0.3,0.1-0.9,0.3-1.6,0.3c-2.8,0-4.1-2.3-4.1-5.3C70.8,8.6,73,7,75.1,7c0.7,0,1.2,0.1,1.5,0.3 l-0.4,1.8c-0.2-0.1-0.5-0.2-1-0.2c-1.2,0-2.3,1-2.3,3.7c0,2.6,1,3.6,2.3,3.6c0.4,0,0.8-0.1,1-0.2L76.5,17.7z"/> <path class="st1" d="M82.1,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M83.6,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M85.7,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M92.2,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M99.2,7.1v10.8h-2.1V7.1H99.2z"/> <path class="st1" d="M100.9,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H100.9z"/> <path class="st1" d="M114.9,17.6c-0.5,0.2-1.5,0.4-2.2,0.4c-1.2,0-2.2-0.4-2.9-1.1c-0.9-0.9-1.4-2.5-1.4-4.4c0-3.9,2.3-5.6,4.6-5.6 c0.8,0,1.4,0.2,1.8,0.3l-0.4,1.8c-0.3-0.1-0.7-0.2-1.2-0.2c-1.4,0-2.6,1-2.6,3.8c0,2.6,1,3.5,2,3.5c0.2,0,0.3,0,0.4,0v-2.6h-1v-1.7 h2.9V17.6z"/> <path class="st1" d="M119,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H119z"/> <path class="st1" d="M131.7,13.2h-2.5v2.9h2.8v1.8h-4.9V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M134.5,17.9l-1.8-10.8h2.2l0.5,4.3c0.1,1.2,0.2,2.5,0.4,3.8h0c0.1-1.3,0.4-2.5,0.6-3.8l0.8-4.3h1.7l0.7,4.3 c0.2,1.2,0.4,2.4,0.5,3.8h0c0.1-1.4,0.3-2.6,0.4-3.8l0.5-4.3h2l-1.9,10.8H139l-0.6-3.5c-0.2-1-0.3-2.2-0.5-3.6h0 c-0.2,1.3-0.4,2.5-0.6,3.6l-0.7,3.5H134.5z"/> <path class="st1" d="M146.7,7.3c0.6-0.1,1.4-0.2,2.2-0.2c1.2,0,2.2,0.2,2.9,0.8c0.6,0.6,0.9,1.5,0.9,2.4c0,1.2-0.4,2-0.9,2.6 c-0.7,0.7-1.8,1-2.6,1c-0.1,0-0.3,0-0.4,0v4h-2.1V7.3z M148.8,12.2c0.1,0,0.2,0,0.3,0c1.1,0,1.5-0.8,1.5-1.8c0-0.9-0.4-1.7-1.4-1.7 c-0.2,0-0.4,0-0.5,0.1V12.2z"/> <path class="st1" d="M155.2,15.4l-0.5,2.5h-2L155,7.1h2.5l2.1,10.8h-2l-0.5-2.5H155.2z M156.9,13.8l-0.4-2.3 c-0.1-0.7-0.3-1.7-0.4-2.4h0c-0.1,0.7-0.3,1.8-0.4,2.5l-0.4,2.2H156.9z"/> <path class="st1" d="M161.3,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M168.3,7.1v10.8h-2.1V7.1H168.3z"/> <path class="st1" d="M174.5,13.2h-2.5v2.9h2.8v1.8H170V7.1h4.7v1.8h-2.6v2.5h2.5V13.2z"/> <path class="st1" d="M176.1,17.9V7.1h1.9l1.7,4.2c0.3,0.8,0.8,2.2,1.2,3.2h0c-0.1-1.1-0.2-3-0.2-5V7.1h1.8v10.8h-1.9l-1.6-4.1 c-0.4-0.9-0.8-2.3-1.1-3.2h0c0,1.1,0.1,2.8,0.1,4.9v2.4H176.1z"/> <path class="st1" d="M185.4,9h-1.9V7.1h5.9V9h-1.9v8.9h-2.1V9z"/> <path class="st1" d="M190.2,15.8c0.4,0.2,1.2,0.4,1.8,0.4c1,0,1.5-0.5,1.5-1.2c0-0.8-0.5-1.2-1.4-1.8c-1.5-0.9-2-2-2-3 c0-1.7,1.2-3.2,3.4-3.2c0.7,0,1.4,0.2,1.7,0.4l-0.3,1.8c-0.3-0.2-0.8-0.4-1.4-0.4c-0.9,0-1.3,0.5-1.3,1.1c0,0.6,0.3,1,1.5,1.7 c1.4,0.9,2,2,2,3.1c0,2-1.5,3.3-3.6,3.3c-0.9,0-1.7-0.2-2.1-0.4L190.2,15.8z"/> </g> </svg>';
                 }else{
                  accepting_new_patients_flag = '';
                 }

                var phone_section = !obj.phone_number ? '' : `<span class="phone-number-container"><img alt="cell icon" src="${script_ajax.theme_path}'/inc/assets/images/class-cell-phone.svg'"><span class="call">Call</span><a href="tel:${obj.phone_number}" class="phone-number"> ${obj.phone_number} </a></span>`;


                var card = `<div class="col-3">
                <a href="${obj.profile_link}" class="doctor-card-link" title="View profile">
                    </a><div class="card" style="width: 18rem;" id="doctor-card"><a href="${obj.profile_link}" class="doctor-card-link">
                      <div style="position:relative;display:inline-block;transition: transform 150ms ease-in-out;">
                      <img class="card-img-top" src="${profile_image}" alt="Card image cap" width="286" height="199.5">
                      ${accepting_new_patients_flag}
                      </div>
                      </a><div class="card-body"><a href="${obj.profile_link}" class="doctor-card-link">
                        <h3 class="card-title">${obj.name}</h3>
                        <hr>
                        </a><p class="card-text">${servicebubble}</p>
                        ${phone_section}
                      </div>
                    </div>
                </div></a>`;

                // var card = `<div class="col-3">
                // <a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link">
                //     </a><div class="card" style="width: 18rem;" id="doctor-card"><a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link">
                //       <img class="card-img-top" src="${profile_image}" alt="Card image cap" width="286" height="199.5">
                //       </a><div class="card-body"><a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link">
                //         <h3 class="card-title">${obj.name}</h3>
                //         <hr>
                //         </a><p class="card-text"><a href="`+ window.location.origin + `/doctors/cindy-baker-md/" class="doctor-card-link"></a><a class="service-bubble" href="` + window.location.origin + `/services/oncology/">Oncology</a>
                //            <a class="service-bubble" href="`+ window.location.origin + `/services/physical-therapy-sports-medicine/">Physical Therapy &amp; Sports Medicine</a>
                //            <a class="service-bubble" href="`+ window.location.origin + `/doctors/cindy-baker-md/">+ 1</a>
                //         </p>
                //         <span class="phone-number-container"><img src="/inc/assets/images/class-cell-phone.svg"> <span class="call">Call</span> <span class="phone-number">(800) 288 2999</span></span>
                //       </div>
                //     </div>
                // </div></a>`;
                $(".pagination-nav-container").html("");
                $("#main-search").append(card);
              });
            }
          });
        },
        open: function (e, ui) {
          var acData = $(this).data('ui-autocomplete');
          //console.log(acData);
          acData
            .menu
            .element
            .find('li')
            .each(function () {
              var me = $(this);
              var keywords = acData.term.split(' ').join('|');
              me.html("<span class=\"search-ahead-generic\">" + me.text().replace(new RegExp("(" + keywords + ")", "gi"), "<b>$1</b>") + "</span>");
            });
        }

      }).autocomplete("instance")._renderItem = function (ul, item) {
  console.log(item);
        //console.log(item);
        return $("<li class=" + item.class + ">")
          .append(item.value)
          .appendTo(ul);
      };
    }
  });
});



var doc_loc_search = '';
$(".doctor-location-search").on('keyup', function () {
  //console.log(this.value);
  doc_loc_search = this.value
});




$("#load-more-image").click(function () {
  $('.comment-container.hidden:lt(10)').addClass("visible").removeClass("hidden");
});



//SERVICE SEARCHES
////////////////////////////////////////////////////


$(".service-criteria-search").focus(function () {
  $.ajax({
    type: "GET",
    url: "/wp-json/memorial/v2/services-search-ahead/",
    success: function (data) {
      console.log(data);
      var parsed_source = JSON.parse(data);
      $(".service-criteria-search").autocomplete({
        source: parsed_source,
        select: function (e, ui) {
          var current_location = "";
          //console.log("/wp-json/memorial/v2/services/main-search/?term=" + ui.item.value + "&type=" + ui.item.class);
          $.ajax({
            type: "GET",
            url: "/wp-json/memorial/v2/services/main-search/?term=" + ui.item.value + "&type=" + ui.item.class,
            error: function (xhr, statusText, error) {
              //alert("Error: " + error);
              //console.log("Error:", error);
            },
            success: function (data) {

              //console.log(data);
              if (data.length > 0) {
                $('div.results').html('<span>Found ' + data.length + ' results</span>');
              }
              if (data.length == 0) {
                $('div.results').html('<span>Found 0 results</span>');
              }
              $("#main-search").html('');
              $(data).each(function (i, obj) {
                var terms = [];
                if (obj.taxonomy_terms.length) {
                  terms = obj.taxonomy_terms
                }
                var card = `<div class="col-lg-6 col-12">
                <div class="half-width">
                  <div class="float-left left">
                        <div class="card">
                          <a href="${obj.permalink}"><h2>${obj.service}</h2></a>
                          ${terms.map(elmt => `
                            <a href="${obj.permalink}">${elmt.name}</a>
                          `).join('')}</div>
                        </div>
                      </div>
                    </div>
                  </div>`;
                $(".pagination-nav-container").html("");
                $("#main-search").append(card);
              })
            }
          });
        },
        open: function (e, ui) {
          var acData = $(this).data('ui-autocomplete');
          acData
            .menu
            .element
            .find('li')
            .each(function () {
              var me = $(this);
              var keywords = acData.term.split(' ').join('|');
              me.html("<span class=\"search-ahead-generic\">" + me.text().replace(new RegExp("(" + keywords + ")", "gi"), "<b>$1</b>") + "</span>");
            });
        }

      }).autocomplete("instance")._renderItem = function (ul, item) {
        //console.log(item);
        return $("<li class=" + item.class + ">")
          .append(item.value)
          .appendTo(ul);
      };
    }
  });
});



$(".location-criteria-search").focus(function () {

  $(".location-criteria-search").css('border-bottom', '');
  $.ajax({
    type: "GET",
    url: "/wp-json/memorial/v2/locations-search-ahead/",
    success: function (data) {
      var parsed_source = JSON.parse(data);
      console.log(data);
      $(".location-criteria-search").autocomplete({
        source: parsed_source,
        select: function (e, ui) {
          var isdualsearch = $(".locations-location-search").val() ? 1 : 0;
          var current_location = $(".locations-location-search").val();
          //console.log("/wp-json/memorial/v2/doctors/main-search/?isdualsearch=" + isdualsearch + "&type=" + ui.item.class + "&generalterm=" + encodeURIComponent(ui.item.value) + "&locationterm=" + encodeURIComponent(current_location));

          critera_type = ui.item.class;
          $.ajax({
            type: "GET",
            url: "/wp-json/memorial/v2/locations/main-search/?isdualsearch=" + isdualsearch + "&type=" + ui.item.class + "&generalterm=" + encodeURIComponent(ui.item.value) + "&locationterm=" + encodeURIComponent(current_location) + "&criteriatype=" + encodeURIComponent(critera_type),
            error: function (xhr, statusText, error) {
              //alert("Error: " + error);
              //console.log("Error: ", error);
            },
            success: function (data) {
              //console.log(data);
              if (data.length > 0) {
                $('div.results').html('<span>Found ' + data.length + ' results</span>');
              }
              if (data.length == 0) {
                $('div.results').html('<span>Found 0 results</span>');
              }
              $("#main-search").html('');
              $(data).each(function (i, obj) {
                //console.log(obj);
                var card = `<div class="col-lg-6 col-sm-12">
        						<a class="card-link" href="${obj.url}">
        							<div class="card wide-card-container">
        									<div class="card-horizontal">
        											<div class="img-square-wrapper">
        													<img class="location-image" src="${obj.image}" alt="Card image cap">
        											</div>
        											<div class="card-body">
        												<span class="logo-container"><img alt="logo icon" class="service-logo" src="${obj.logo}"></span>


        															<p class="card-text location-address">${obj.contact_information.street_address}</p>
        															<span class="location-phone phone-number">${obj.contact_information.phone}

        											</span></div>
        									</div>
        							</div>
        						</a>
        				</div>`;
                $(".pagination-nav-container").html("");
                $("#main-search").append(card);
              });
            }
          });
        },
        open: function (e, ui) {
          var acData = $(this).data('ui-autocomplete');
          //console.log(acData);
          acData
            .menu
            .element
            .find('li')
            .each(function () {
              var me = $(this);
              var keywords = acData.term.split(' ').join('|');
              me.html("<span class=\"search-ahead-generic\">" + me.text().replace(new RegExp("(" + keywords + ")", "gi"), "<b>$1</b>") + "</span>");
            });
        }

      }).autocomplete("instance")._renderItem = function (ul, item) {
        //console.log(item);
        return $("<li class=" + item.class + ">")
          .append(item.value)
          .appendTo(ul);
      };
    }
  });
});



$(".locations-location-search").on('keyup', function () {
//console.log(this.value);
});


$(window).on("load resize", function (e) {
  if ($(this).width() < 1200) {

    $('.two-panel-up').show();
    $('.four-panel').hide();

  } else {

    $('.two-panel-up').hide();
    $('.four-panel').show();

  }
});



// $('.four-panel').slick({
//   dots: false,
//   infinite: false,
//   speed: 300,
//   slidesToShow: 4,
//   slidesToScroll: 4
// });


$('.home-full-slider').slick({
  dots: false,
  infinite: true,
  speed: 100,
  autoplay: true,
  autoplaySpeed: 15000,
  focusOnSelect: false,
  pauseOnFocus: false,
  pauseOnDotsHover: false,
  pauseOnHover: false
});





$('.two-panel-up').slick({
  rows: 2,
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 2,
  slidesToScroll: 2
});

$('#single_location_docslider').not('.slick-initialized').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  //slidesToScroll: 4,
  responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 4,
      //slidesToScroll: 2,
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

$('#single_locations_mhslider').not('.slick-initialized').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  //slidesToScroll: 4,
  responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 4,
      //slidesToScroll: 2,
      infinite: false,
      dots: false
    }
  },
  {
    breakpoint: 600,
    settings: {
      slidesToShow: 1,
      //slidesToScroll: 2
    }
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      //slidesToScroll: 2
    }
  }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('#services_single_classes_slider').not('.slick-initialized').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [{
    breakpoint: 1024,
    settings: {
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 2,
      slidesToScroll: 2,
      mobileFirst: true,
      //row:1
    }
  },
  {
    breakpoint: 600,
    settings: {
      //rows:2,
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 480,
    settings: {
      //rows:2,
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});



$('.doctors-slider').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2,
      infinite: false,
      dots: false
    }
  },
  {
    breakpoint: 600,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2
    }
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2
    }
  }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

//$('.locations-slider').not('.slick-initialized').slick({
$('#single_events_locationsslider').not('.slick-initialized').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 2,
  slidesToScroll: 2,
  responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2,
      infinite: false,
      dots: false
    }
  },
  {
    breakpoint: 600,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2
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



$(document).ready(function () {
  $('.home-img-slider').slick({
    autoplay: true,
    speed: 800,
    lazyLoad: 'progressive',
    arrows: true,
    dots: false,
  });

});




$(document).ready(function () {
  $("#primary-class-event-search").submit();
});



$(document).ready(function () {
  $('.phone-number').text(function (i, text) {
    return text.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2 $3');
  });
});


function events_classes_locations(eve, event_id) {
  //console.log(eve, event_id);
}


function initMap($el) {

  // Find marker elements within map.
  var $markers = $el.find('.marker');


  // Create gerenic map.
  var mapArgs = {
    zoom: $el.data('zoom') || 16,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map($el[0], mapArgs);


  // Add markers.
  map.markers = [];
  $markers.each(function () {

    initMarker($(this), map);
  });

  // Center map based on markers.
  centerMap(map);

  // Return map instance.
  return map;
}

/**
  * initMarker
  *
  * Creates a marker for the given jQuery element and map.
  *
  * @date    22/10/19
  * @since   5.8.6
  *
  * @param   jQuery $el The jQuery element.
  * @param   object The map instance.
  * @return  object The marker instance.
  */
function initMarker($marker, map) {

  // Get position from marker.
  var lat = $marker.data('lat');
  var lng = $marker.data('lng');

  var latLng = {
    lat: parseFloat(lat),
    lng: parseFloat(lng)
  };

  // Create marker instance.
  var marker = new google.maps.Marker({
    position: latLng,
    map: map,
    icon: templateDir + '/inc/assets/images/location-icon-orange.png'

  });

  // Append to reference for later use.
  map.markers.push(marker);

  // If marker contains HTML, add it to an infoWindow.
  if ($marker.html()) {

    // Create info window.
    var infowindow = new google.maps.InfoWindow({
      content: $marker.html()
    });

    // Show info window when marker is clicked.
    google.maps.event.addListener(marker, 'click', function () {
      infowindow.open(map, marker);
    });
  }

}

/**
  * centerMap
  *
  * Centers the map showing all markers in view.
  *
  * @date    22/10/19
  * @since   5.8.6
  *
  * @param   object The map instance.
  * @return  void
  */
function centerMap(map) {
  // Create map boundaries from all map markers.
  var bounds = new google.maps.LatLngBounds();
  map.markers.forEach(function (marker) {
    bounds.extend({
      lat: marker.position.lat(),
      lng: marker.position.lng()
    });
  });

  // Case: Single marker.
  if (map.markers.length == 1) {
    map.setCenter(bounds.getCenter());

    // Case: Multiple markers.
  } else {
    map.fitBounds(bounds);
  }
}

// Render maps on page load.
$(document).ready(function () {
  $('.acf-map').each(function () {
    var map = initMap($(this));
  });

});


jQuery('.alert-box-mobile').click(function () {
  jQuery('.mobile-covid-alert').slideToggle('fast').addClass("main");
  return false;
});
