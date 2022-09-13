<?php
// Template Name: Page with image background

include( locate_template('templates/top-child-pages.php') );
$id = $page->ID;

$supertitle = carbon_get_post_meta($id, 'smpx_page_supertitle');
$title = carbon_get_post_meta($id, 'smpx_page_title');
$subtitle = carbon_get_post_meta($id, 'smpx_page_subtitle');


// Prevent direct access and redirect to parent page
if( $post->ID == $page->ID ){ wp_redirect( get_permalink($page->post_parent) ); }
//-------------------------------------------------------------------------------


include( locate_template('templates/content-with-image-background.php') );

