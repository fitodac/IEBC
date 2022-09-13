<?php
// PREACHES POST TYPES
add_action( 'init', 'smpx_cpt_preaches' );

function smpx_cpt_preaches(){

  $labels = array(
    'name'                  => 'Mensajes',
    'singular_name'         => 'Mensaje',
    'menu_name'             => 'Mensajes',
    'name_admin_bar'        => 'Mensajes',
    'archives'              => '',
    'parent_item_colon'     => 'Parent Item:',
    'all_items'             => 'Todos los mensajes',
    'add_new_item'          => 'Agregar nuevo',
    'add_new'               => 'Nuevo mensaje',
    'new_item'              => 'Nuevo mensaje',
    'edit_item'             => 'Editar',
    'update_item'           => 'Actualizar',
    'view_item'             => 'Ver',
    'search_items'          => 'Buscar',
    'not_found'             => 'No encontrado',
    'not_found_in_trash'    => 'No encontrado en la papelera',
    'featured_image'        => 'Imagen principal',
    'set_featured_image'    => 'Imagen principal',
    'remove_featured_image' => 'Eliminar imagen principal',
    'use_featured_image'    => 'Usar como imagen principal',
    'insert_into_item'      => 'Agregar al item',
    'uploaded_to_this_item' => 'Subir',
    'items_list'            => 'Lista',
    'items_list_navigation' => 'Lista',
    'filter_items_list'     => 'Filtrar',
  );

  $args = array(
    'label' => 'Mensajes',
    'labels' => $labels,
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_rest' => false,
    'rest_base' => '',
    'has_archive' => false,
    'show_in_menu' => true,
    'exclude_from_search' => false,
    'capability_type' => 'page',
    'map_meta_cap' => true,
    'hierarchical' => true,
    'taxonomies' => array( 
      'mensajes_cat'
    ),
    'rewrite' => array( 
      'slug' => 'reflexiones', 
      'with_front' => true,
      'pages' => true,
      'feeds' => false,
    ),
    'query_var' => true,
    'menu_icon' => 'dashicons-book', 
    'supports' => array('title', 'editor'),
    'can_export' => true,
    'publicly_queryable' => true
  );
  register_post_type( 'preaches', $args );

}






/*----------------------------------------*/
/*  PREACHES CATEGORIES
/*----------------------------------------*/
if( !function_exists('smpx_preaches_category') ){

// Register Custom Taxonomy
function smpx_preaches_category(){

  $labels = array(
    'name'                       => _x( 'Categorías de mensajes', 'Taxonomy General Name', 'smpx' ),
    'singular_name'              => _x( 'Categoría de mensajes', 'Taxonomy Singular Name', 'smpx' ),
    'menu_name'                  => __( 'Categorías de mensajes', 'smpx' ),
    'all_items'                  => __( 'Todas', 'smpx' ),
    'parent_item'                => __( 'Padres', 'smpx' ),
    'parent_item_colon'          => __( 'Padre:', 'smpx' ),
    'new_item_name'              => __( 'Nueva categoría', 'smpx' ),
    'add_new_item'               => __( 'Agregar nueva categoría', 'smpx' ),
    'edit_item'                  => __( 'Editar categoría', 'smpx' ),
    'update_item'                => __( 'Actualizar categoría', 'smpx' ),
    'view_item'                  => __( 'Ver categoría', 'smpx' ),
    'separate_items_with_commas' => __( 'Separar categorías', 'smpx' ),
    'add_or_remove_items'        => __( 'Agregar o eliminar categorías', 'smpx' ),
    'choose_from_most_used'      => __( 'Elegir de las más usadas', 'smpx' ),
    'popular_items'              => __( 'Categorías populares', 'smpx' ),
    'search_items'               => __( 'Buscar categoría', 'smpx' ),
    'not_found'                  => __( 'No encontrada', 'smpx' ),
    'no_terms'                   => __( 'No hay categorías', 'smpx' ),
    'items_list'                 => __( 'Lista de categorías', 'smpx' ),
    'items_list_navigation'      => __( 'Menú de categorías', 'smpx' ),
  );
  $rewrite = array(
    'slug'                       => 'mensajes_cat',
    'with_front'                 => true,
    'hierarchical'               => true,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'mensajes_cat', 'preaches', $args );

}
add_action( 'init', 'smpx_preaches_category', 0 );

}





/*---------------------------------------------------*/
/*  ADD FEATURED IMAGE IN POSTS LIST
/*---------------------------------------------------*/
function smpx_add_thumbnail_in_preaches_columns( $columns ){
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => 'Title',
    'author' => 'Author',
    'date' => 'Date'
  );
  return $columns;
}



if( function_exists( 'add_theme_support' ) ){
  add_filter( 'manage_preaches_posts_columns' , 'smpx_add_thumbnail_in_preaches_columns' );
}




