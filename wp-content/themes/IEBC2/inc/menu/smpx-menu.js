// jQuery(document).ready(function(){

// 	$ = jQuery;


//   custom_fields();
// 	update_menu();

  

// 	$('.submit-add-to-menu').on('click', function(){

// 		var temp = true;

// 		setTimeout(function(){
// 			custom_fields();
// 			update_menu();

// 			if( temp ){
// 				$('.item-edit').on('click', function(){
// 					$active.find('.menu-item-dropdown_position').removeClass('hidden');
// 					$active.find('.menu-item-dropdown_width').removeClass('hidden');

// 					temp = false;
// 				});
// 			}

// 		}, 700);
// 	});
// });	



// var update_menu = function(){

// 	$ = jQuery;

// 	var $dept_arr = [];

//   $('.menu-item-depth-0').each(function(){
//   	$subnav = $(this).find('.menu-item-subnav select').val();
//   	$dept_arr.push($(this).index());
//   });

//   //console.log( $dept_arr );
//   //console.log( $dept_arr.length );
  
//   for(i=0; i < $dept_arr.length; i++){
//   	if( $('.menu-item-depth-0').eq(i).find('.menu-item-subnav select').val() != 'nav-dropdown'  ){

// 	  	var $a = $dept_arr[i];
// 	  			$b = $dept_arr[i+1];

// 	  	//console.log('step: ' + $a);
// 	  	//console.log( $('.menu-item-depth-'+ i +' .menu-item-subnav select').val() );

// 	  	for(ii=$a; ii < $b; ii++){	
// 	  		if(ii+1 != $b){
// 					$('#menu-to-edit li').eq(ii+1).find('.menu-custom-fields input').val('');
// 					$('#menu-to-edit li').eq(ii+1).find('.menu-custom-fields select').val('');
// 					$('#menu-to-edit li').eq(ii+1).find('.menu-custom-fields').hide();
// 	  		}
// 	  	}

//   	}
//   }

// }




// var custom_fields = function(){
// 	$ = jQuery;
	
// 	$('.item-edit').on('click', function(){
// 		var $id = $(this).attr('id'),
// 				$id = $id.split('-')[1];

// 		console.log($id);

// 		$('#menu-item-'+ $id +' .menu-item-subnav select').on('change', function(){
// 			$val = $(this).val();
// 			$active = $(this).closest('.menu-item-edit-active');


// 			if( $val === 'nav-dropdown' ){
// 				$active.find('.menu-item-dropdown_position').removeClass('hidden');
// 				$active.find('.menu-item-dropdown_width').removeClass('hidden');
// 				$active.find('.menu-item-widget').addClass('hidden');
// 			}

// 			if( $val === 'nav-widget' ){
// 				$active.find('.menu-item-mm_width').addClass('hidden');	
// 				$active.find('.menu-item-mm_cols').addClass('hidden');
// 				$active.find('.menu-item-dropdown_position select').val('nav-megamenu-right').closest('.menu-item-dropdown_position').addClass('hidden');
// 				$active.find('.menu-item-dropdown_width').addClass('hidden');
// 				$active.find('.menu-item-widget').removeClass('hidden');
// 			}

// 			if( $val === 'nav-megamenu' ){
// 				$active.find('.menu-item-dropdown_position').addClass('hidden');
// 				$active.find('.menu-item-dropdown_width').addClass('hidden');
// 				$active.find('.menu-item-widget').addClass('hidden');
// 				$active.find('.menu-item-mm_width').removeClass('hidden');	
// 				$active.find('.menu-item-mm_cols').removeClass('hidden');	
// 			}

// 			if( ($val != 'nav-widget') && ($val != 'nav-dropdown') && ($val != 'nav-megamenu') ){
// 				$active.find('.menu-item-dropdown_position').addClass('hidden');
// 				$active.find('.menu-item-dropdown_width').addClass('hidden');
// 				$active.find('.menu-item-widget').addClass('hidden');
// 				$active.find('.menu-item-mm_width').addClass('hidden');	
// 				$active.find('.menu-item-mm_cols').addClass('hidden');
// 			}

// 		});

// 	});
// }







