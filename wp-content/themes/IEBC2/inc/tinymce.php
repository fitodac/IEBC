<?php
function wpb_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');



/*
* Callback function to filter the MCE settings
*/
function my_mce_before_init_insert_formats( $init_array ){  

  $style_formats = array(  
    array( 
      'title' => 'div',  
      'block' => 'div',  
      'classes' => '',
      'wrapper' => true
    ),
    array( 
      'title' => 'Clearfix', 
      'block' => 'div',  
      'classes' => 'clearfix',
      'wrapper' => true
    ),
    array( 
      'title' => 'Row', 
      'block' => 'div', 
      'classes' => 'row',
      'wrapper' => true
    ),
    array( 
      'title' => 'Btn Primary', 
      'block' => 'a', 
      'classes' => 'btn btn-primary', 
      'wrapper' => false
    ),
    array( 
      'title' => 'List Group',  
      'block' => 'div',
      'classes' => 'list-group',
      'wrapper' => true
    ),
    array( 
      'title' => 'List Group Item', 
      'block' => 'div',  
      'classes' => 'list-group-item',
      'wrapper' => true
    )
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  
  return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 



