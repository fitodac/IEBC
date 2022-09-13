<?php
class smpx_walker extends Walker_Nav_Menu{
  // Don't start the top level
  // function start_lvl(&$output, $depth=0, $args=array()){
  //   if( 0 == $depth )
  //   return;
  //   parent::end_lvl($output, $depth, $args); 
  // }




  // // Don't end the top level
  // function end_lvl(&$output, $depth=0, $args=array()){
  //   if( 0 == $depth )
  //   return;
  //   parent::end_lvl($output, $depth, $args);
  // }



  // Don't print top-level elements
  // function start_el(&$output, $item, $depth = 0, $args = array()) {
    // global $wp_query;
  //   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';


  //   $custom_classes = ! empty( $item->icon ) ? ' menu-item-icon' : '';
  //   $custom_classes .= ! empty( $item->subnav ) ? ' '. esc_attr($item->subnav) : '';
  //   $custom_classes .= ( ($item->dropdown_position) && ($item->subnav == 'nav-dropdown') ) ? ' '. esc_attr($item->dropdown_position) : '';
  //   $custom_classes .= ! empty( $item->mm_width ) ? ' '. esc_attr($item->mm_width) : '';
  //   $custom_classes .= ( ($item->mm_cols) && ($item->subnav == 'nav-megamenu') ) ? ' '. esc_attr($item->mm_cols) : '';
  //   $custom_classes .= ! empty( $item->dropdown_width ) ? ' '. esc_attr($item->dropdown_width) : '';



  //   $class_names = $value = '';

  //   $classes = empty( $item->classes ) ? array() : (array) $item->classes;

  //   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
  //   $class_names = ' class="'. esc_attr( $class_names ) . $custom_classes .'"';



  //   $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

  //   $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
  //   $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
  //   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
  //   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    

  //   $prepend = '<span>';
  //   $append = '</span>';
  //   $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

  //   if($depth != 0){
  //     $description = $append = $prepend = "";
  //   }

    

  //   $item_output = $args->before;

  //   if( ($item->url == '#') && (!$item->widget) ){
  //     $prepend = '<span class="menu-item-disabled">';
  //     $append = '</span>';

  //     $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
  //     $item_output .= $description.$args->link_after;
  //   }

  //   if( (!$item->widget) && ($item->url != '#') ){ 
  //     $item_output .= '<a'. $attributes .'>';
  //     $item_output .= ! empty( $item->icon ) ? '<span class="'. esc_attr( $item->icon ) .'"></span>' : '';
  //     $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
  //     $item_output .= $description.$args->link_after;
  //     $item_output .= '</a>';
  //   }

  //   if( ($item->url == '#') && ($item->widget) ){
  //     ob_start();
  //     dynamic_sidebar(esc_attr($item->widget));
  //     $item_output .= '<div class="menu-item-widget">';
  //     $item_output .= ob_get_contents();
  //     $item_output .= '</div>';
  //     ob_end_clean();
  //   }

  //   $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            
  // }


  // function start_lvl(&$output, $depth = 1) {
  //   $indent = str_repeat("\t", $depth);
  //   $output .= "\n$indent<ul class=\"nav sub-menu level-".$depth."\">\n";
  // }

}








