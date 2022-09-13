/*------------------------------*/
/*  NITRO v.0.0.8
/*  Author: BorealisHQ
/*------------------------------*/
(function($) {
'use strict';


jQuery(document).ready(function($){

/*---------------------------------------------------------*/
/*  Scroll to (selected anchor)
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






/*---------------------------------------------------------*/
/*  SCROLL TO TOP
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
/*  OPEN EXTERNAL LINKS IN NEW WINDOW
/*---------------------------------------------------------*/
$('a[href^="http"]').attr('target', '_blank');
$('a[href^="//"]').attr('target', '_blank');
$('a[href^="' + window.location.origin + '"]').attr('target', '_self');






/*---------------------------------------------------------*/
/*  IMG to SVG
/*---------------------------------------------------------*/
if( $('img.svg')[0] ){
	$('img.svg').each(function(){
		var $img = $(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		$.get(imgURL, function(data) {
	    // Get the SVG tag, ignore the rest
	    var $svg = jQuery(data).find('svg');

	    // Add replaced image's ID to the new SVG
	    if(typeof imgID !== 'undefined') {
        $svg = $svg.attr('id', imgID);
	    }
	    // Add replaced image's classes to the new SVG
	    if(typeof imgClass !== 'undefined') {
        $svg = $svg.attr('class', imgClass+' replaced-svg');
	    }

	    // Remove any invalid XML tags as per http://validator.w3.org
	    $svg = $svg.removeAttr('xmlns:a');

	    // Replace image with new SVG
	    $img.replaceWith($svg);
		}, 'xml');
	});
}





/*---------------------------------------------------------*/
/*  SOCIAL SHARE BUTTONS
/*---------------------------------------------------------*/
if( $('[data-share]')[0] ){
	$('[data-share]').each(function(){
		var _social_net = $(this).data('share');
		$(this).socialShare(_social_net);
	});
}





/*---------------------------------------------------------*/
/*  MODALS (Bootstrap modals)
/*---------------------------------------------------------*/
if( $('.modal')[0] ){
	$('.modal').each(function(){
		var _this = $(this);

		_this.on('show.bs.modal',function(e){
			_this.addClass('modal-showing');
		});

		_this.on('shown.bs.modal',function(e){
			_this.removeClass('modal-showing');
		});
	});
}




/*---------------------------------------------------------*/
/*  INITIALIZE TOOLTIPS (Bootstrap tooltips)
/*---------------------------------------------------------*/
if( $('[data-toggle="tooltip"]')[0] ){
	$('[data-toggle="tooltip"]').tooltip();	
}



/*---------------------------------------------------------*/
/*  INITIALIZE POPOVERS (Bootstrap popovers)
/*---------------------------------------------------------*/
if( $('[data-toggle="popover"]')[0] ){
	
	var _popoverLink = $('[data-toggle="popover"]');

	_popoverLink.on('click', function(){
		_popoverLink.popover('destroy').popover({container: 'body'});
		$(this).popover('show');
	});
	
}




/*---------------------------------------------------------*/
/*	MASONRY
/*---------------------------------------------------------*/
if( $('.masonry')[0] ){

	var _masonry = $('.masonry');

	_masonry.masonry({
		itemSelector: '.item', 
		percentPosition: true, 
	});

}


});// DOM ready




})(jQuery);










/*---------------------------------------------------------*/
/*  AJAX SUBMIT
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
/*  OFF CANVAS
/*---------------------------------------------------------*/
(function($){
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





/*---------------------------------------------------------*/
/*  SOCIAL SHARE BUTTONS
/*---------------------------------------------------------*/
(function($){
	$.fn.socialShare = function(type){
		this.each(function(){
			var element = this;
			$(this).click(function(e){
				e.preventDefault();

				var winHeight = 200,
						winWidth = 450,
						winTop = (screen.height / 2) - (winHeight / 2),
						winLeft = (screen.width / 2) - (winWidth / 2),
						url = $(element).attr('href');

				if(type == 'facebook'){
					window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
				}else if(type == 'twitter'){
					window.open('https://twitter.com/share?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
				}else if(type == 'pinterest'){
					window.open('http://www.pinterest.com/pin/create/button/?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
				}else if(type == 'googleplus'){
					window.open('https://plus.google.com/share?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
				}else if(type == 'linkedin'){
					window.open('https://www.linkedin.com/cws/share?url=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
				}
			});
		});
	};
}(jQuery));








/*---------------------------------------------------------*/
/*  GROWL - Alerts plugin
/*  https://github.com/ifightcrime/bootstrap-growl
/*---------------------------------------------------------*/
(function(){
  var $;

  $ = jQuery;

  $.nitroAlert = function(message, options){
    var _alert, css, offsetAmount;
    
    options = $.extend({}, $.nitroAlert.default_options, options);
    
    _alert = $('<div>');
    
    _alert.attr('class', 'nitro-alert alert fade');
    if( options.type ){
      _alert.addClass('alert-' + options.type);
    }

    if( options.allow_dismiss ){
      _alert.addClass('alert-dismissible');
      _alert.append('<button class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>');
    }

    _alert.append(message);
    if( options.top_offset ){
      options.offset = {
        from: 'top',
        amount: options.top_offset
      };
    }

    offsetAmount = options.offset.amount;
    
    $('.nitro-alert').each(function(){
      return offsetAmount = Math.max(offsetAmount, parseInt($(this).css(options.offset.from)) + $(this).outerHeight() + options.stackup_spacing);
    });

    css = {
      'position': (options.container === 'body' ? 'fixed' : 'absolute'),
      'margin': 0,
      'z-index': '9999'
    };

    css[options.offset.from] = offsetAmount + 'px';

    _alert.css(css);
    if( options.width !== 'auto' ){
      _alert.css('width', options.width + 'px');
    }

    $(options.container).append(_alert);
    switch( options.align ){
      case 'center':
        _alert.css({
          'left': '50%',
          'margin-left': '-' + (_alert.outerWidth() / 2) + 'px'
        });
        break;
      case 'left':
        _alert.css('left', '20px');
        break;
      default:
        _alert.css('right', '20px');
    }

    setTimeout(function(){
    	_alert.addClass('in');
    }, 200);

    if( options.delay > 0 ){
    	setTimeout(function(){
    		console.log(options.delay);
    		console.log($(this));
    		console.log(_alert);
        // return $(this).alert('close');
        _alert.alert('close');
      }, options.delay);
    }

    return _alert;
  };

  $.nitroAlert.default_options = {
    container: 'body',
    type: 'info', // info, success, warning, danger
    offset: {
      from: 'top',
      amount: 20
    },
    align: 'right',
    width: 250,
    autoHide: true,
    delay: 5000,
    allow_dismiss: true,
    stackup_spacing: 10
  };

}).call(this);






/*---------------------------------------------------------*/
/*  RESPONSIFY
/*  http://responsifyjs.space/
/*  http://responsifyjs.space/app/ (Allow create areas for images)
/*---------------------------------------------------------*/
!function(t){t.fn.responsify=function(){return this.each(function(){var e,r,a,i,o,h,n,s,f,u,c,d,p=t(this);if(e=p.width(),r=p.height(),a=p.parent().width(),i=p.parent().height(),o=Number(p.attr("data-focus-left")),h=Number(p.attr("data-focus-top")),n=Number(p.attr("data-focus-right")),s=Number(p.attr("data-focus-bottom")),e/r>a/i){var b=(n-o)*e;b/r>a/i?(u=r*a/b,f=e*a/b,d=-o*f,c=(i-u)/2):(u=i,f=i*e/r,d=a/2-(o+n)*f/2,d=d>0?0:d,d=a-d-f>0?a-f:d,c=0)}else{var l=(s-h)*r;l/e>i/a?(f=e*i/l,u=r*i/l,c=-h*u,d=(a-f)/2):(f=a,u=a*r/e,c=i/2-(h+s)*u/2,c=c>0?0:c,c=i-c-u>0?i-u:c,d=0)}p.parent().css({overflow:"hidden"}),p.css({position:"relative",height:u,width:f,left:d,top:c})})}}(jQuery);

/*---------------------------------------------------------*/
/*  ADAPTIVE BACKGROUNDS
/*  https://briangonzalez.github.io/jquery.adaptive-backgrounds.js/
/*  A jQuery plugin for extracting dominant colors from images 
/*  and applying it to its parent.
/*---------------------------------------------------------*/
!function(n){var t="data-ab-color",a="data-ab-parent",e="data-ab-css-background",r="ab-color-found",o={selector:"[data-adaptive-background]",parent:null,exclude:["rgb(0,0,0)","rgb(255,255,255)"],normalizeTextColor:!1,normalizedTextColors:{light:"#fff",dark:"#000"},lumaClasses:{light:"ab-light",dark:"ab-dark"}};!function(n){"use strict";var t=function(){return document.createElement("canvas").getContext("2d")},a=function(n,a){var e=new Image,r=n.src||n;"data:"!==r.substring(0,5)&&(e.crossOrigin="Anonymous"),e.onload=function(){var n=t("2d");n.drawImage(e,0,0);var r=n.getImageData(0,0,e.width,e.height);a&&a(r.data)},e.src=r},e=function(n){return["rgb(",n,")"].join("")},r=function(n){return n.map(function(n){return e(n.name)})},o=5,c=10,u={};u.colors=function(n,t){t=t||{};var u=t.exclude||[],i=t.paletteSize||c;a(n,function(a){for(var c=n.width*n.height||a.length,s={},l="",d=[],m={dominant:{name:"",count:0},palette:Array.apply(null,new Array(i)).map(Boolean).map(function(){return{name:"0,0,0",count:0}})},f=0;c>f;){if(d[0]=a[f],d[1]=a[f+1],d[2]=a[f+2],l=d.join(","),s[l]=l in s?s[l]+1:1,-1===u.indexOf(e(l))){var g=s[l];g>m.dominant.count?(m.dominant.name=l,m.dominant.count=g):m.palette.some(function(n){return g>n.count?(n.name=l,n.count=g,!0):void 0})}f+=4*o}if(t.success){var p=r(m.palette);t.success({dominant:e(m.dominant.name),secondary:p[0],palette:p})}})},n.RGBaster=n.RGBaster||u}(window),n.adaptiveBackground={run:function(c){var u=n.extend({},o,c);n(u.selector).each(function(o,c){var i=n(this),s=function(){var n=l()?d():i[0];RGBaster.colors(n,{paletteSize:20,exclude:u.exclude,success:function(n){i.attr(t,n.dominant),i.trigger(r,{color:n.dominant,palette:n.palette})}})},l=function(){var n=i.attr(e);return"undefined"!=typeof n&&n!==!1},d=function(){var n=i.css("background-image"),t=/\(([^)]+)\)/,a=t.exec(n)[1].replace(/"/g,"");return a};i.on(r,function(n,t){var e;e=u.parent&&i.parents(u.parent).length?i.parents(u.parent):i.attr(a)&&i.parents(i.attr(a)).length?i.parents(i.attr(a)):l()?i:u.parent?i.parents(u.parent):i.parent(),e.css({backgroundColor:t.color});var r=function(n){var a=t.color.match(/\d+/g);return(299*a[0]+587*a[1]+114*a[2])/1e3},o=function(n){return r(n)>=128?u.normalizedTextColors.dark:u.normalizedTextColors.light},c=function(n){return r(n)<=128?u.lumaClasses.dark:u.lumaClasses.light};u.normalizeTextColor&&e.css({color:o(t.color)}),e.addClass(c(t.color)).attr("data-ab-yaq",r(t.color)),u.success&&u.success(i,t)}),s()})}}}(jQuery);


/*---------------------------------------------------------*/
/*  TILT
/*  Inspired on https://github.com/codrops/ImageTiltEffect/
/*---------------------------------------------------------*/
!function(e){e.fn.tilt=function(t){t="object"!=typeof t?{}:t;var a={imageSelector:"img",shadowCount:4,clipShadows:!0,hideOnMouseLeave:!0,hideOriginalImage:!1,maxRotationDegree:10,translateMultiplier:-10,imageScale:1.1,perspective:500,baseZetaIndex:20,transformOrigin:!1},i=e.extend(a,t);if("undefined"==typeof i.shadowOpacity){var o=i.shadowCount+(i.hideOriginalImage?0:1);i.shadowOpacity=Math.round(100/o)/100}return this.each(function(){var t,a=e(this),o=a.children(i.imageSelector).eq(0);if(0===o.length)return this;a.css({position:"relative",overflow:i.clipShadows?"hidden":""}),o.css({transform:"scale("+i.imageScale+")"}).addClass("tilt-img-base"),i.hideOriginalImage&&o.css("opacity",0);for(var s=1;s<=i.shadowCount;s++)t=o.clone(),t.addClass("tilt-shadow").data("layer",s),t.css({opacity:i.shadowOpacity,"z-index":i.baseZetaIndex+s,position:"absolute",top:"0",left:"0",transform:"perspective("+i.perspective+"px) translate3d(0px, 0px, 0px) rotate3d(0, 0, 0, "+i.maxRotationDegree+"deg) scale("+i.imageScale+")",display:i.hideOnMouseLeave?"none":"block"}),t.appendTo(a);a.hover(function(e){i.hideOnMouseLeave&&a.find(".tilt-shadow").show()},function(e){i.hideOnMouseLeave&&a.find(".tilt-shadow").hide()}),a.on("mousemove",function(t){var o,s,n,r,d,l,h,p=e(this).offset().left,c=e(this).offset().top,f=a.width(),g=a.height(),m=t.pageX-p,u=t.pageY-c,v=2*(m/f-.5),x=-2*(u/g-.5),w=Math.sqrt(v*v+x*x),y=v*i.translateMultiplier,O=-x*i.translateMultiplier;a.find(".tilt-shadow").each(function(t){o=t/i.shadowCount,l=x*o,h=v*o,d=Math.round(w*i.maxRotationDegree*o),move_x=y*o,move_y=O*o,i.transformOrigin===!0&&(s=m,n=u,e(this).css("transform-origin",s+"px "+n+"px")),r="perspective("+i.perspective+"px) translate3d("+move_x+"px, "+move_y+"px, "+t+"px) rotate3d("+l+", "+h+", 0, "+d+"deg) scale("+i.imageScale+")",e(this).css("transform",r)})})})}}(jQuery);


/*---------------------------------------------------------*/
/*  HOVER 3D
/*  Inspired on http://ariona.github.io/hover3d
/*---------------------------------------------------------*/
!function(e){e.fn.hover3d=function(s){var t=e.extend({selector:null,perspective:1e3,sensitivity:20,invert:!1,shine:!1,hoverInClass:"hover-in",hoverOutClass:"hover-out",hoverClass:"hover-3d",keepOnLeave:!1},s);return this.each(function(){function s(){o.addClass(t.hoverInClass+" "+t.hoverClass),setTimeout(function(){o.removeClass(t.hoverInClass)},1e3)}function r(e){var s=i.innerWidth(),r=i.innerHeight(),n=t.invert?(s/2-e.offsetX)/t.sensitivity:-(s/2-e.offsetX)/t.sensitivity,v=t.invert?-(r/2-e.offsetY)/t.sensitivity:(r/2-e.offsetY)/t.sensitivity;dy=e.offsetY-r/2,dx=e.offsetX-s/2,theta=Math.atan2(dy,dx),angle=180*theta/Math.PI-90,angle<0&&(angle+=360),o.css({perspective:t.perspective+"px",transformStyle:"preserve-3d",transform:"rotateY("+n+"deg) rotateX("+v+"deg)"}),a.css("background","linear-gradient("+angle+"deg, rgba(255,255,255,"+e.offsetY/r*.5+") 0%,rgba(255,255,255,0) 80%)")}function n(){o.addClass(t.hoverOutClass+" "+t.hoverClass),0==t.keepOnLeave?o.css({perspective:t.perspective+"px",transformStyle:"preserve-3d",transform:"rotateX(0) rotateY(0)"}):o.css({perspective:t.perspective+"px",transformStyle:"preserve-3d"}),setTimeout(function(){o.removeClass(t.hoverOutClass+" "+t.hoverClass)},1e3)}var i=e(this),o=i.find(t.selector);t.shine&&o.append('<div class="shine"></div>');var a=e(this).find(".shine");i.css({perspective:t.perspective+"px",transformStyle:"preserve-3d"}),o.css({perspective:t.perspective+"px",transformStyle:"preserve-3d"}),a.css({position:"absolute",top:0,left:0,bottom:0,right:0,"z-index":9}),i.on("mouseenter",function(){return s()}),i.on("mousemove",function(e){return r(e)}),i.on("mouseleave",function(){return n()})})}}(jQuery);




/*---------------------------------------------------------*/
/*  PARALLAX
/*---------------------------------------------------------*/
;(function( $ ){

	$.fn.parallax = function(userSettings){

		var _window = $(window),
				_windowHeight = _window.height();

		_window.resize(function(){
			_windowHeight = _window.height();
		});

		var options = $.extend({}, $.fn.parallax.defaults, userSettings),

				_this = $(this),
				_parallaxElem;

		if( _this.css('background-image') != 'none' ){
			var _parallaxElem = 'background',
					_bgOrigPos = _this.css( 'background-position' ).split(' '),
					_origx   = _bgOrigPos[ 0 ],
					_origy   = _bgOrigPos[ 1 ];
		}else{
			var _parallaxElem = 'element',
					origX   = _this.offset().left;
		}


		var _firstTop = _this.offset().top,

				getHeight = function(jqo){
					return jqo.outerHeight(true);
				};


		function update(){
			var _pos = _window.scrollTop();				

			// If has background
			if( _parallaxElem === 'background' ){
				_this.each(function(){
					var _this = $(this);
					var _top = _this.offset().top;
					var _height = getHeight(_this);

					// Check if totally above or totally below viewport
					if (_top + _height < _pos || _top > _pos + _windowHeight) {
						return;
					}

					var _bgPos =  Math.round((_top - _pos) * options.speed);

					if( _bgPos >= 0 ){ _bgPos = 0 }

					_this.css({
						backgroundPosition:_origx+' '+_bgPos+'px', 
						backgroundAttachment:'fixed', 
						backgroundSize:'cover'
					});
				});
			}


			// If hasn't background
			if( _parallaxElem === 'element' ){
				_this.each(function(){
					var _this = $(this);
					var _top = _this.offset().top;
					var _height = getHeight(_this);

					// Check if totally above or totally below viewport
					if (_top + _height < _pos || _top > _pos + _windowHeight) {
						return;
					}

					var _yPos =  Math.round((_top - _pos) * options.speed);

					_this.css({transform:'translateY('+_yPos+'px)'});
				});
			}
			
		}


		_window.on('scroll', update).resize(update);
		update();

	};

	$.fn.parallax.defaults = {
		speed: .5, //Parallax offset
	};



	$(document).ready(function(){
		$('[data-parallax]').each(function(){
			var _this = $(this),
					_speed = _this.data('parallax');

			_this.parallax({speed: _speed});
		});
	});

})( jQuery );


