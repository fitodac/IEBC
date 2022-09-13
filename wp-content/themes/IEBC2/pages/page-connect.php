<?php
// Template Name: Conectarse

$page = get_page_by_path('enfoque/conectarse'); 
$id = $page->ID;

$supertitle = carbon_get_post_meta($id, 'smpx_supertitle');
$title = carbon_get_post_meta($id, 'smpx_title');
$subtitle = carbon_get_post_meta($id, 'smpx_subtitle');


include( locate_template('templates/top-child-pages.php') );

$title = carbon_get_post_meta($id, 'smpx_page_title');

// Prevent direct access and redirect to parent page
if( $post->ID == $page->ID ){ wp_redirect( get_permalink($page->post_parent) ); }
//-------------------------------------------------------------------------------

include( locate_template('templates/content-with-image-background.php') );

