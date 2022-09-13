<?php 
// Prevent direct access and redirect to parent page
if( $post->ID == $page->ID ){ wp_redirect( get_permalink($page->post_parent) ); }
//-------------------------------------------------------------------------------

$page_thumbnail = wp_get_attachment_url( get_post_thumbnail_id($page->ID) );