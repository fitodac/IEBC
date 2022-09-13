
jQuery(document).ready(function($){

// });


// REGISTER SIDEBARS
// (function($){

	if( $('.sidebars-form')[0] ){
		$('.sidebars-form .add-box').click(function(){
			var n = $('.text-box').length + 1;
			var box_html = $('<p class="text-box"><label for="box' + n + '">Sidebar-<span class="box-number">' + n + '</span></label> <input type="text" name="custom_sidebars[]" value="" id="box' + n + '" /> <a href="#" class="remove-box">Remove</a></p>');
			    box_html.hide();
			    $('#append').append(box_html);
			    box_html.fadeIn('slow');

			return false;
		}); 


		$('.sidebars-form').on('click', '.remove-box', function(){
			$(this).parent().css( 'background-color', '#FF6C6C' );
			$(this).parent().fadeOut("slow", function(){
		    $(this).remove();
		    $('.box-number').each(function(index){
		      $(this).text( index + 1 );
		    });
			});
			return false;
		});



		$('.clsSubmit').click(function(){
			var m = $('.text-box').length;
			if(m==0){ alert("press OK to Reset"); }
		});
	}
});



