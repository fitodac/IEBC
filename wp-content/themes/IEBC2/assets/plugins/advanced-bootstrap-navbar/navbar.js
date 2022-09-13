/*
* Plugin Name: Advanced Bootstrap Navbar
*
* Author: Fito da Cunha
* Author URI: http://smartpixl.com
* Plugin Source: 
* Version: 0.4;
*
*/


(function($){
  'use strict';

  $.fn.abnNavbar = function(options){

    return this.each(function(){

      var e = $(this);
      var $window = jQuery(window);

      var settings = $.extend({
          altClass: '',
          offsetTop: 100,
          clone: false,

          toggleBtn: true,

          sidebarClass: '', 
          sidebarID: '', 
          sidebarOffsetTop: 0, 
          sidebarWrapClass: 'collapse navbar-toggleable-md col-xl-2 col-lg-3 col-md-5 col-sm-6 col-xs-9', 
          sidebarWrapID: 'sidebar-navbar', 
          sidebarBodyClass: '',
          sidebarHeader: '', 
          sidebarHeaderClass: '', 
          sidebarHeaderClone: true, 
          sidebarFooter: '', 
          sidebarFooterClone: true, 
          sidebarFooterClass: ''
      }, options);

      settings = $.extend(settings, e.data());

      
      /*------------------------------------------*/
      /**  SIDEBAR CLONE  **/
      /*------------------------------------------*/
      if( settings.clone ){
        
        var $clon = e.clone();
        // console.log($clon);

        var $clonNav = $clon.find('ul.navbar-nav');

        $clonNav.removeClass('.navbar-nav');



        // Create the sidebar nav
        var $sidebar = $('<nav>', {
          class: 'abn-sidebar affix ' + settings.sidebarClass,
          id: settings.sidebarID,
          'data-offset-top': settings.sidebarOffsetTop
        }).html('<div class="abn-body"></div>').ready(function(){

          var sbar = $('.abn-sidebar');

          sbar.find('.abn-body').html($clonNav);

          if( !sbar.find('.nav').eq(0).hasClass('nav') ){ sbar.find('.nav').eq(0).addClass('nav') }
          sbar.find('.nav-link .fa').remove();

        });


        var $sidebarWrap = $('<div>', {
          class : 'abn-sidebar-wrapper ' + settings.sidebarWrapClass, 
          id: settings.sidebarWrapID
        }).html($sidebar);

        
        $sidebarWrap.prependTo($('body')).ready(function(){
          sidebarNavbar($('.abn-sidebar'));
        });



        // Create toggle button
        if( settings.toggleBtn ){

          var $togglerSidebar = $('<button>', {
            class: 'navbar-toggler hidden-lg-up affix btn-secondary-outline', 
            type: 'button', 
            'data-toggle': 'collapse', 
            'data-target': '#sidebar-navbar', 
            'data-offset-top': 0
          }).text('&#9776;');

          $togglerSidebar.prependTo($('body'));

        }


        // Create sidebar header
        if( settings.sidebarHeader != '' ){
          var $sidebarHeaderContent = $(settings.sidebarHeader).clone();

          var $sidebarHeader = $('<div>', {
            class: 'abn-header '+settings.sidebarHeaderClass
          }).html($sidebarHeaderContent);

          $('.abn-sidebar').prepend($sidebarHeader);
        }




        // Create sidebar footer
        if( settings.sidebarFooter != '' ){
          var $sidebarFooterContent = $(settings.sidebarFooter).clone();

          var $sidebarFooter = $('<footer>', {
            class: 'abn-footer '+settings.sidebarFooterClass
          }).html($sidebarFooterContent);

          $('.abn-sidebar').append($sidebarFooter);
        }


      }


      /*------------------------------------------*/
      /**  SIDEBAR  **/
      /*------------------------------------------*/
      if( e.hasClass('abn-sidebar') ){
        sidebarNavbar(e);
      }
      // SIDEBAR END

      function sidebarNavbar(e){
        if( e.find('.toggle-subnav').length == 0 ){
          // SUBNAVS
          e.find('.subnav').each(function(){
            // Create arrows and toggle subnavs
            var $link = $(this).parent().find('> .nav-link'),
                $arrow = $('<a>',{
                  href: '#',
                  class: 'toggle-subnav'
                }).html('<span class="fa fa-angle-right"></span>');

            $link.after($arrow);

            $arrow.on('mousedown', function(elem){
              elem.preventDefault();
              $(this).closest('.nav').addClass('prev');
              $(this).parent().addClass('open-subnav');
            });

            // Create the back link
            var $backLink = $('<a>', {
                  href: '#',
                  class: 'nav-link back-subnav'
                }).html('<span class="fa fa-angle-left"></span>');
            
            if( $(this).is('li') ){
              var $liElem = '<li>';
            }else{
              var $liElem = '<div>';
            }

            var $back = $($liElem,{
                  class: 'nav-item'
                }).html($backLink);

            $back.prependTo($(this));

            $backLink.on('mousedown', function(elem){
              elem.preventDefault();
              $(this).closest('.prev').removeClass('prev');
              $(this).closest('.open-subnav').removeClass('open-subnav');
            });
          });
        }
      }




      /*------------------------------------------*/
      /**  ALTERNATIVE CLASS  **/
      /*------------------------------------------*/
      if( settings.offsetTop != null || settings.altClass != null ){
        var $offtop = settings.offsetTop,
            $altclass = settings.altClass;

        $window.scroll(function(){
          if( $(this).scrollTop() > $offtop ){
            e.addClass($altclass);
          }else{
            e.removeClass($altclass);
          }
        });
      }
      // ALTERNATIVE CLASS END


      // console.log( settings );
      
    });
  };



  // BROWSER DETECT
  var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
  var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
  var is_explorer_9 = navigator.userAgent.indexOf('9') > -1;
  var is_explorer_10 = navigator.userAgent.indexOf('10') > -1;
  var is_explorer_11 = navigator.userAgent.indexOf('11') > -1;
  var is_edge = navigator.userAgent.indexOf('Edge') > -1;
  var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
  var is_safari = navigator.userAgent.indexOf("Safari") > -1;
  var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
  
  if((is_chrome)&&(is_safari)){   is_safari = false; }
  if((is_chrome)&&(is_opera)){    is_chrome = false; }

  if((is_chrome)){    $('body').addClass('abn-chrome');   }
  if((is_explorer)){  $('body').addClass('abn-msie');     }
  if((is_edge)){      $('body').addClass('abn-edge');     }
  if((is_firefox)){   $('body').addClass('abn-firefox');  }
  if((is_safari)){    $('body').addClass('abn-safari');   }
  if((is_opera)){     $('body').addClass('abn-opera');    }

  if((is_explorer)&&(is_explorer_9)){  $('body').addClass('abn-msie-9');   }
  if((is_explorer)&&(is_explorer_10)){  $('body').addClass('abn-msie-10');   }
  if((is_explorer)&&(is_explorer_11)){  $('body').addClass('abn-msie-11');   }

}(jQuery));






