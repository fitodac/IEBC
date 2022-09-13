<?php
// Template Name: Servir

$page = get_page_by_path('enfoque/servir');
$id = $page->ID;

$supertitle = carbon_get_post_meta($id, 'smpx_page_supertitle');
$title = carbon_get_post_meta($id, 'smpx_page_title');
$subtitle = carbon_get_post_meta($id, 'smpx_page_subtitle');

include( locate_template('templates/top-child-pages.php') );


// Prevent direct access and redirect to parent page
if( $post->ID == $page->ID ){ wp_redirect( get_permalink($page->post_parent) ); }
//-------------------------------------------------------------------------------

include( locate_template('templates/content-with-image-background.php') );


