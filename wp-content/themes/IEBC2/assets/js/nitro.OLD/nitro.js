/*------------------------------*/
/*  NITRO v.0.0.5
/*  Author: BorealisHQ
/*------------------------------*/
(function($) {
'use strict';


jQuery(document).ready(function($){

/*---------------------------------------------------------*/
/*  Scroll to (selected anchor)  */
/*---------------------------------------------------------*/
$('.scrollto').on('click', function(e){
	e.preventDefault();
	
	var $target = $(this).data('target');

	if( $(this).data('duration') ){var $duration = $(this).data('duration');}
	else{var $duration = 1000;}

	if( $(this).data('offset') ){var $offset = $(this).data('offset');}
	else{var $offset = 0;}

	if($target.length){
		$('html, body').animate({
			scrollTop: $($target).offset().top + $offset,
			easing: 'easeInOutCubic'
		}, $duration);
	}

});




// FULL HEIGHT
fullHeight();

$(window).resize(
	fullHeight()
);





/*---------------------------------------------------------*/
/*  SCROLL TO TOP  */
/*---------------------------------------------------------*/
$('.scroll-to-top').addClass('opacity-0 invisible');

$(window).scroll(function(){
	var $winHeight = $(window).height();

	if( $(window).scrollTop() >= $winHeight/2 ){
		$('.scroll-to-top').removeClass('opacity-0 invisible');
	}else{
		$('.scroll-to-top').addClass('opacity-0 invisible');
	}
});





/*---------------------------------------------------------*/
/*  OPEN EXTERNAL LINKS IN NEW WINDOW  */
/*---------------------------------------------------------*/
$('a[href^="http"]').attr('target', '_blank');
$('a[href^="//"]').attr('target', '_blank');
$('a[href^="' + window.location.origin + '"]').attr('target', '_self');




});// DOM ready


})(jQuery);






/*---------------------------------------------------------*/
/*  Full height element  */
/*---------------------------------------------------------*/
function fullHeight(){
	// var newHeight = $("html").height() - $("#header").height() - $("#footer").height() + "px";
	var $ = jQuery;
	$('.full-height').css('height', $(window).height());
}





/*---------------------------------------------------------*/
/*  AJAX SUBMIT  */
/*---------------------------------------------------------*/
(function($){
	'use strict';

	$.fn.ajaxForm = function(options){
		return this.each(function(){

			var form = $(this);

  		var settings = $.extend({
      		data 				: '',
      		urlBin 			: location.origin + '/assets/bin/sendmail.php',
      		onSuccess 	: function(){ 
      			alert('Form Submitted!')
      		},
      		type 				: 'POST'
      }, options);


  		$.ajax({
		    type: settings.type,
		    url: settings.urlBin,
		    data: settings.data,
		    success: function(){
		    	settings.onSuccess;
		    }
		  });

		});
	}
}(jQuery));










/*---------------------------------------------------------*/
/*  OFF CANVAS  */
/*---------------------------------------------------------*/
(function($) {
'use strict';

	var $html = $('html'),
			$body = $('body'),
			scrollpos = {x: window.pageXOffset, y: window.pageYOffset},
			arr = ['push', 'reveal'],
			offcanvas = {

				// SHOW
				show: function(element, anim){
					var element = $(element),
							inArr = $.inArray(String(window.offcanvasFx), arr),
							barWidth = element.outerWidth(),
							scrollpos = {x: window.pageXOffset, y: window.pageYOffset};

					window.offcanvasIn = true;
					window.pageYOffset = scrollpos.y;

					console.log(window.offcanvasPosition);
					if( window.offcanvasPosition != '' ){
						barWidth = -barWidth;
					}


					if( inArr > -1 ){
						$body.addClass('offcanvas-page');

						$body.css({
							'margin-left': barWidth,
							'width': window.innerWidth, 
							// 'height': window.innerHeight
						});

						$html.css('margin-top', scrollpos.y * -1);
					}

					element.addClass('in');
					$body.append('<div class="overlay offcanvas-overlay"/>');

					$('.offcanvas-overlay').on('click', function(){
						offcanvas.hide(element);
					});
				},


				// HIDE
				hide: function(element, anim){
					var element = $(element),
							scrollpos = {x: window.pageXOffset, y: window.pageYOffset};

					window.offcanvasIn = false;
					$body.addClass('offcanvas-page-close');
					element.removeClass('in');
					$('.offcanvas-overlay').detach();
					
					setTimeout(function(){
						$body.removeClass('offcanvas-page offcanvas-page-close');

						$body.css({
							'margin': '', 
							'width': '', 
							// 'height': ''
						});
						$html.css('margin-top', 0);	
						window.scrollTo(0, scrollpos.y);
					}, 500);
				},


				// INIT ELEMENT
				initElement: function(element){
					if( window.offcanvasIn == true ){
						offcanvas.hide(element);
					}else{
						offcanvas.show(element);
					}
				}

			};



	$(document).ready(function($){

		$('[data-offcanvas]').on('click', function(e){
			e.preventDefault();

			var el = $(this),
					target = el.data('target'),
					target = $(target),
					anim = el.data('anim'),
					data = el.data();

			if( data.offcanvasRight == '' ){
				window.offcanvasPosition = 'right';
				target.addClass('offcanvas-right');
			}else{
				window.offcanvasPosition = '';
				target.removeClass('offcanvas-right');
			}

			window.offcanvasFx = anim;
			

			setTimeout(offcanvas.initElement(target),300);
		});

	});


})(jQuery);















