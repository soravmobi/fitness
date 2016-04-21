$(document).ready(function() {
	
$('body').on('keypress','.pop-overbox',function(){
	$(".pop-overbox").popover('destroy');
});

//js for page loading animation start 
$(".animsition").animsition({
	inClass               :   'fade-in',
	outClass              :   'fade-out',
	inDuration            :    1500,
	outDuration           :    800,
	linkElement           :   '.animsition-link',
	loading               :    true,
	loadingParentElement  :   'body', //animsition wrapper element
	loadingClass          :   'animsition-loading',
	unSupportCss          : [ 'animation-duration',
							  '-webkit-animation-duration',
							  '-o-animation-duration'
							],
	overlay               :   false,
	overlayClass          :   'animsition-overlay-slide',
	overlayParentElement  :   'body'
  });
//js for page loading animation end 
  
//js for calling responsive calendar start
$('.responsive-calendar').responsiveCalendar({
  onInit:function(){
	  $(".al_heading h4").text( $(this).data('year'));
	  },
	  allRows:false,
	  startFromSunday:true,
  });
//js for calling responsive calendar end

function setHeight() {
	windowHeight = $(window).innerHeight();
		$('.banner_sec .carousel-caption').css('min-height', windowHeight);
	  };
	  setHeight();
	  $(window).resize(function() {
		setHeight();
	  });
});

(function( $ ) {
	function doAnimations( elems ) {
		var animEndEv = 'webkitAnimationEnd animationend';
		elems.each(function () {
			var $this = $(this),
				$animationType = $this.data('animation');
			$this.addClass($animationType).one(animEndEv, function () {
				$this.removeClass($animationType);
			});
		});
	}
	var $myCarousel = $('#main_carousel'),
	$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
	$myCarousel.carousel();
	doAnimations($firstAnimatingElems);
	$myCarousel.on('slide.bs.carousel', function (e) {
	var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
	doAnimations($animatingElems);
	});  
})(jQuery);

/*js for custom scroll bar*/
 (function($){
        $(window).load(function(){
            $(".panel_block_body, .al_body, .review_body , .scroll_content, .session_content").mCustomScrollbar({
				});
        });
})(jQuery);

/*jquery for social button*/
$(function () {
  var all_classes = "";
  var timer = undefined;
  $.each($('li', '.social-class'), function (index, element) {
    all_classes += " btn-" + $(element).data("code");
  });
  $('li', '.social-class').mouseenter(function () {
    var icon_name = $(this).data("code");
    if ($(this).data("icon")) {
      icon_name = $(this).data("icon");
    }
    var icon = "<i class='fa fa-" + icon_name + "'></i>";
    $('.btn-social', '.social-sizes').html(icon + "Sign in with " + $(this).data("name"));
    $('.btn-social-icon', '.social-sizes').html(icon);
    $('.btn', '.social-sizes').removeClass(all_classes);
    $('.btn', '.social-sizes').addClass("btn-" + $(this).data('code'));
  });
  $($('li', '.social-class')[Math.floor($('li', '.social-class').length * Math.random())]).mouseenter();
});

$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.parents('.panel').find('.panel-footer').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});

function showPopover(position, content) {
    $(".pop-overbox")
        .popover({
            html: true,
            placement: position,
            content: content
        }).popover('show');
}

function hidePopover(){
	$(".pop-overbox").popover('destroy');
}

function showAlert(type,title,message){
	swal(title,message,type);
}

$('.ht_right ul li').hover(function() {
	$(this).children('.dropdown-menu').stop(true, false, true).slideToggle(300);
});

	/*visitor map start*/
	/**
 * This example uses pulsating circles CSS by Kevin Urrutia
 * http://kevinurrutia.tumblr.com/post/16411271583/creating-a-css3-pulsating-circle
 */

$('.datepicker').datepicker({
    autoclose:true,
    format: 'yyyy-mm-dd',
});

window.map = AmCharts.makeChart("chartdiv", {
    type: "map",
    "theme": "none",
    "projection":"miller",
    path: "http://www.amcharts.com/lib/3/",

    imagesSettings: {
        rollOverColor: "#089282",
        rollOverScale: 3,
        selectedScale: 3,
        selectedColor: "#089282",
        color: "#13564e"
    },

    areasSettings: {
        unlistedAreasColor: "#15A892"
    },

    dataProvider: {
        map: "worldLow",
        images: [{
            zoomLevel: 5,
            scale: 0.5,
            title: "Brussels",
            latitude: 50.8371,
            longitude: 4.3676
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Copenhagen",
            latitude: 55.6763,
            longitude: 12.5681
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Paris",
            latitude: 48.8567,
            longitude: 2.3510
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Reykjavik",
            latitude: 64.1353,
            longitude: -21.8952
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Moscow",
            latitude: 55.7558,
            longitude: 37.6176
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Madrid",
            latitude: 40.4167,
            longitude: -3.7033
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "London",
            latitude: 51.5002,
            longitude: -0.1262,
            url:"http://www.google.co.uk"
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Peking",
            latitude: 39.9056,
            longitude: 116.3958
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "New Delhi",
            latitude: 28.6353,
            longitude: 77.2250
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Tokyo",
            latitude: 35.6785,
            longitude: 139.6823,
            url:"http://www.google.co.jp"
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Ankara",
            latitude: 39.9439,
            longitude: 32.8560
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Buenos Aires",
            latitude: -34.6118,
            longitude: -58.4173
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Brasilia",
            latitude: -15.7801,
            longitude: -47.9292
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Ottawa",
            latitude: 45.4235,
            longitude: -75.6979
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Washington",
            latitude: 38.8921,
            longitude: -77.0241
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Kinshasa",
            latitude: -4.3369,
            longitude: 15.3271
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Cairo",
            latitude: 30.0571,
            longitude: 31.2272
        }, {
            zoomLevel: 5,
            scale: 0.5,
            title: "Pretoria",
            latitude: -25.7463,
            longitude: 28.1876
        }]
    }
});

// add events to recalculate map position when the map is moved or zoomed
map.addListener("positionChanged", updateCustomMarkers);

// this function will take current images on the map and create HTML elements for them
function updateCustomMarkers (event) {
    // get map object
    var map = event.chart;
    
    // go through all of the images
    for( var x in map.dataProvider.images) {
        // get MapImage object
        var image = map.dataProvider.images[x];
        
        // check if it has corresponding HTML element
        if ('undefined' == typeof image.externalElement)
            image.externalElement = createCustomMarker(image);

        // reposition the element accoridng to coordinates
        var xy = map.coordinatesToStageXY(image.longitude, image.latitude);
        image.externalElement.style.top = xy.y + 'px';
        image.externalElement.style.left = xy.x + 'px';
    }
}

// this function creates and returns a new marker element
function createCustomMarker(image) {
    // create holder
    var holder = document.createElement('div');
    holder.className = 'map-marker';
    holder.title = image.title;
    holder.style.position = 'absolute';
    
    // maybe add a link to it?
    if (undefined != image.url) {
        holder.onclick = function() {
            window.location.href = image.url;
        };
        holder.className += ' map-clickable';
    }
    
    // create dot
    var dot = document.createElement('div');
    dot.className = 'dot';
    holder.appendChild(dot);
    
    // create pulse
    var pulse = document.createElement('div');
    pulse.className = 'pulse';
    holder.appendChild(pulse);
    
    // append the marker to the map container
    image.chart.chartDiv.appendChild(holder);
    
    return holder;
}

/*visitor map start*/

$(".mobile_search").click(function(){
   $(".mobile_view").fadeToggle(700);
 
});




