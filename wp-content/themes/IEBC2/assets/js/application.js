(function($) {
'use strict';

jQuery(document).ready(function($){


// Add a navbar toggle button
$('#site-header-menu').prepend('<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-header-menu">'
	+'<span class="ion-ios-close-outline"></span>'
	+'</button>');



/*----------------------------------------*/
/*  OWL
/*----------------------------------------*/
if( $('#main-slider')[0] ){
	$('#main-slider').owlCarousel({
		items:              1,
		loop:               true,
		smartSpeed:         1200,
		nav:                true,
		dots:           		false,
		autoplay:           true,
		// autoplay:           false,
		autoplayTimeout:    6000,
		autoplayHoverPause: true
	});
}




/*----------------------------------------*/
/*  SIDEBAR
/*----------------------------------------*/
if( $('.fixed-sidebar')[0] ){

	function stickySidebar(){
		var _winWidth = $(window).width();

		if( _winWidth <= 767 ){	
			$('.fixed-sidebar').trigger('sticky_kit:detach');
		}

		if( _winWidth > 767 ){
			$('.fixed-sidebar').stick_in_parent({ 
				offset_top: 20
			});
		}
	}

	stickySidebar();

	$(window).resize( stickySidebar() );

}




/*----------------------------------------*/
/*  SCROLLSPY
/*----------------------------------------*/
if( $('body.page-template-page-new-here')[0] || $('body.page-template-page-pathway')[0] ){
	$('body').scrollspy({ 
		target: 'aside',
		offset: 120 
	});
}





/*----------------------------------------*/
/*  ANCHOR
/*----------------------------------------*/
$('.sidebar-wrapper .menu-item a').each(function(){

	var _link = $(this),
			_href = _link.attr('href');

	if( _href.indexOf('#') === 0 ){
		_link.on('click', function(e){

			e.preventDefault();

			var _padding = parseInt( $(_link[0].hash).css('padding-top') ),
					_top = $(_link[0].hash).offset().top;

			$('html, body').stop().animate({
				scrollTop: _top + (_padding/2) - 50
			}, 300);
			
		});
	}

});






/*----------------------------------------*/
/*  PRAY REQUEST MODAL
/*----------------------------------------*/
if( $('[href="#pray-request"]')[0] ){
	
	$('[href="#pray-request"]').on('click', function(e){
		e.preventDefault();
		$('#pray-request').modal();
	});


	// $('#pray-request').on('hidden.bs.modal', function(){
	// 	var _url = window.location.href;

	// 	if( _url.indexOf('#wpcf7') > -1 ){
	// 		window.location.href = _url.split('#')[0];
	// 	}
	// });
}


if( $('body').hasClass('home') ){
	var _url = window.location.href;

	if( _url.indexOf('#wpcf7') > -1 ){
		$('#pray-request').modal();	
	}
}






/*----------------------------------------*/
/*  IMG to SVG
/*----------------------------------------*/
// jQuery('img.svg').each(function(){
// 	var $img = jQuery(this);
// 	var imgID = $img.attr('id');
// 	var imgClass = $img.attr('class');
// 	var imgURL = $img.attr('src');

// 	jQuery.get(imgURL, function(data) {
// 	    // Get the SVG tag, ignore the rest
// 	    var $svg = jQuery(data).find('svg');

// 	    // Add replaced image's ID to the new SVG
// 	    if(typeof imgID !== 'undefined') {
// 	        $svg = $svg.attr('id', imgID);
// 	    }
// 	    // Add replaced image's classes to the new SVG
// 	    if(typeof imgClass !== 'undefined') {
// 	        $svg = $svg.attr('class', imgClass+' replaced-svg');
// 	    }

// 	    // Remove any invalid XML tags as per http://validator.w3.org
// 	    $svg = $svg.removeAttr('xmlns:a');

// 	    // Replace image with new SVG
// 	    $img.replaceWith($svg);

// 	}, 'xml');
// });






/*-------------------------------------------------*/
/* MAP
/*-------------------------------------------------*/
if( $('.gmap')[0] ){

	var $map = $('.gmap'),
			$address = $map.data('address'),
			$lat = $address.split(',')[0],
			$lan = $address.split(',')[1],
			$zoom = $map.data('zoom'),
			$marker = $map.data('marker');


	var grayStyles = [{
		featureType: "all",
		stylers: [
			{ saturation: -90 },
			{ lightness: 50 }
		]
	}];

	$('.gmap')
	.gmap3({
		center:[$lat,$lan],
		zoom: $zoom,
		scrollwheel: false,
		// styles: grayStyles
	})
	.marker({
		position:[$lat,$lan],
		// icon: window.location.origin+'/assets/images/_nitro/marker.png'
		icon: $marker
	});
}



});

}(jQuery));


var s = skrollr.init();
if( s.isMobile() ){ s.destroy(); }



