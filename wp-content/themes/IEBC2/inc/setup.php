<?php

if ( ! function_exists( 'smpx_setup' ) ) :
  function smpx_setup() {

    // Make theme available for translation
    load_theme_textdomain('smpx', get_template_directory() . '/lang');

    // Title tag
    add_theme_support('title-tag');
    

    // Enable post formats
    $postformats = [];
    if( carbon_get_theme_option('smpx_pf_aside') ){ $postformats[] = 'aside'; }
    if( carbon_get_theme_option('smpx_pf_link') ){ $postformats[] = 'link'; }
    if( carbon_get_theme_option('smpx_pf_image') ){ $postformats[] = 'image'; }
    if( carbon_get_theme_option('smpx_pf_quote') ){ $postformats[] = 'quote'; }
    if( carbon_get_theme_option('smpx_pf_video') ){ $postformats[] = 'video'; }
    if( carbon_get_theme_option('smpx_pf_audio') ){ $postformats[] = 'audio'; }

    add_theme_support('post-formats', $postformats);



    // Enable HTML5 markup support
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 9999 );

    // Use main stylesheet for visual editor
    add_editor_style(get_template_directory_uri() . '/inc/admin/assets/css/editor-style.css?v=2');

    // Use main stylesheet for metaboxes
    function theme_options_styles(){
      wp_enqueue_style('theme-options-styles', get_template_directory_uri() . '/inc/admin/assets/css/metaboxes.css', array(), '1.0');
      wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/inc/admin/assets/js/admin.js', array(), '1.0');
    }
    add_action('admin_enqueue_scripts', 'theme_options_styles');



    // Allow SVG Upload
    add_filter('upload_mimes', 'custom_upload_mimes');

    function custom_upload_mimes( $existing_mimes = array() ){
      $existing_mimes['svg'] = 'mime/type';
      return $existing_mimes;
    }

    add_filter('mime_types', 'themeprefix_add_svg_images');

    function themeprefix_add_svg_images($mimetypes) { 
      $mimetypes['svg'] = 'image/svg+xml'; 
      return $mimetypes; 
    }

    
    // Remove ninja forms metabox
    $nf_metabox = carbon_get_theme_option('smpx_toggle_ninjaforms_metabox');
    if( $nf_metabox ){
      remove_action('add_meta_boxes','ninja_forms_add_custom_box' );
    }




    /*---------------------------------------------------*/
    /*  ADD FEATURED IMAGE IN POSTS LIST
    /*---------------------------------------------------*/
		add_image_size( 'admin-list-thumb', 70, 70, false );

		function smpx_add_thumbnail_in_posts_columns( $columns ){
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => 'Title',
				'author' => 'Author',
				'categories' => 'Categories',
				'tags' => 'Tags',
				'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
				'date' => 'Date',
				'featured_thumb' => 'Thumbnail'
			);
			return $columns;
		}


		function smpx_add_thumbnail_in_posts_columns_data( $column, $post_id ){
			switch ( $column ) {
				case 'featured_thumb':
				echo '<a href="' . get_edit_post_link() . '">'
					.the_post_thumbnail( 'admin-list-thumb' )
				.'</a>';
				break;
			}
		}


		/*---------------------------------------------------*/
    /*  ADD FEATURED IMAGE IN PAGES LIST
    /*---------------------------------------------------*/
		function smpx_add_thumbnail_in_page_columns( $columns ){
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => 'Title',
				'author' => 'Author',
				// 'categories' => 'Categories',
				// 'tags' => 'Tags',
				'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
				'date' => 'Date',
				'featured_thumb' => 'Thumbnail'
			);
			return $columns;
		}


		function smpx_add_thumbnail_in_page_columns_data( $column, $post_id ){
			switch ( $column ) {
				case 'featured_thumb':
				echo '<a href="' . get_edit_post_link() . '">'
					.the_post_thumbnail( 'admin-list-thumb' )
				.'</a>';
				break;
			}
		}



		if( function_exists( 'add_theme_support' ) ){
			add_filter( 'manage_posts_columns' , 'smpx_add_thumbnail_in_posts_columns' );
			add_action( 'manage_posts_custom_column' , 'smpx_add_thumbnail_in_posts_columns_data', 10, 2 );
			add_filter( 'manage_pages_columns' , 'smpx_add_thumbnail_in_page_columns' );
			add_action( 'manage_pages_custom_column' , 'smpx_add_thumbnail_in_page_columns_data', 10, 2 );
		}



  }// smpx_setup()
endif;

add_action( 'after_setup_theme', 'smpx_setup' );





/*---------------------------------------------*/
/*  Hide admin bar
/*---------------------------------------------*/
if( carbon_get_theme_option( 'smpx_toggle_adminbar' ) ){
  add_filter('show_admin_bar', '__return_false');
}




