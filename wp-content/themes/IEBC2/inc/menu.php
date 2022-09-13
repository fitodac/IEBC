<?php
/*---------------------------------------------------*/
/*  REGISTER MENU
/*---------------------------------------------------*/
register_nav_menus( array(
  'main-menu' => esc_html__( 'Primary Menu', 'smpx' ),
  'secondary-menu' => esc_html__( 'Secondary Menu', 'smpx' ),
  '404-menu' => esc_html__( '404 Usefull links', 'smpx' )
) );



//Give .active to current menu item
function smpx_special_nav_class($classes, $item){
	if( in_array('current-menu-item', $classes) ){
		$classes[] = 'active ';
	}
	return $classes;
}

add_filter('nav_menu_css_class' , 'smpx_special_nav_class' , 10 , 2);






/*
Author: Remi Corson
Author URI: http://remicorson.com
Plugin URL: http://remicorson.com/sweet-custom-menu
*/


// add custom menu fields to menu
// add_filter( 'wp_setup_nav_menu_item', 'smpx_add_custom_nav_fields' );

// save menu custom fields
// add_action( 'wp_update_nav_menu_item', 'smpx_update_custom_nav_fields', 10, 3 );

// edit menu walker
// add_filter( 'wp_edit_nav_menu_walker', 'smpx_edit_walker', 10, 2 );





/**
 * Add custom fields to $item nav object
 * in order to be used in custom Walker
*/
if( !function_exists('smpx_add_custom_nav_fields') ):
function smpx_add_custom_nav_fields( $menu_item ) {

	// GENERAL ITEMS
	$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
	$menu_item->subnav = get_post_meta( $menu_item->ID, '_menu_item_subnav', true );

	// ITEM DROPDOWN
	$menu_item->dropdown_position = get_post_meta( $menu_item->ID, '_menu_item_dropdown_position', true );
	$menu_item->dropdown_width = get_post_meta( $menu_item->ID, '_menu_item_dropdown_width', true );

	// ITEM MEGAMENU
	$menu_item->mm_width = get_post_meta( $menu_item->ID, '_menu_item_mm_width', true );
	$menu_item->mm_cols = get_post_meta( $menu_item->ID, '_menu_item_mm_cols', true );

	// ITEM WIDGET
	$menu_item->widget = get_post_meta( $menu_item->ID, '_menu_item_widget', true );
	return $menu_item;
  
}
endif;




/**
 * Save menu custom fields
*/
if( !function_exists('smpx_update_custom_nav_fields') ):
function smpx_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

  // Check if element is properly sent
  if( is_array( $_REQUEST['menu-item-icon']) ) {
    $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
  }

  if( is_array( $_REQUEST['menu-item-subnav']) ) {
  	$subnav_value = $_REQUEST['menu-item-subnav'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_subnav', $subnav_value );
  }


  // ITEM DROPDOWN
  if( is_array( $_REQUEST['menu-item-dropdown_position']) ) {
    $dropdown_position_value = $_REQUEST['menu-item-dropdown_position'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_dropdown_position', $dropdown_position_value );
  }

  if( is_array( $_REQUEST['menu-item-dropdown_width']) ) {
    $dropdown_width_value = $_REQUEST['menu-item-dropdown_width'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_dropdown_width', $dropdown_width_value );
  }


  // ITEM MEGAMENU
  //if( is_array( $_REQUEST['menu-item-mm_width']) ) {
    $mm_width_value = $_REQUEST['menu-item-mm_width'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_mm_width', $mm_width_value );
  //}

  if( is_array( $_REQUEST['menu-item-mm_cols']) ) {
    $mm_cols_value = $_REQUEST['menu-item-mm_cols'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_mm_cols', $mm_cols_value );
  }


  // ITEM WIDGET
  if( is_array( $_REQUEST['menu-item-widget']) ) {
    $widget_value = $_REQUEST['menu-item-widget'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_widget', $widget_value );
  }
    
}
endif;





/**
 * Define new Walker edit
*/
if( !function_exists('smpx_edit_walker') ):
function smpx_edit_walker( $walker, $menu_id ){
	return 'Walker_Nav_Menu_Edit_Custom';  
}
endif;





// require_once dirname( __FILE__ ).'/menu/smpx-edit-custom-menu.php';
require_once dirname( __FILE__ ).'/menu/smpx-custom-menu.php';






if( !function_exists('smpx_menu_script') ):
function smpx_menu_script(){
	global $pagenow;
		
	if( is_admin() && $pagenow == 'nav-menus.php' ):
		wp_enqueue_script( 'options', __DIR__ .'/menu/smpx-menu.js', false, '1.0.0', true ); // OPTIONS SCRIPTS
		
	endif;
}
endif;
add_action( 'admin_footer', 'smpx_menu_script' );





