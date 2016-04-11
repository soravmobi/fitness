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





