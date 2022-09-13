<?php 
/*---------------------------------------------*/
/*  Page header
/*---------------------------------------------*/

if( is_page() ): ?>
  <div 
  <?php if( has_post_thumbnail() ): ?>
    class="page-header has-background" 
    style="background-image:url(<?php the_post_thumbnail_url(); ?>);" 
    data-top="opacity: 1; transform: scale(1);" 
    data--35p-top="opacity: 0; transform: scale(1.6);"
  <?php else: ?>
    class="page-header" 
  <?php endif; ?>
  >
  </div><!-- page-header end -->


<?php elseif( is_archive() ): ?>

  <?php 
  // $tax_name = get_queried_object()->name; 
  // $tax_image = get_term_meta( get_queried_object_id(), '_smpx_cat_image', true);

  // $currentTaxonomy = get_query_var('taxonomy');
  ?>

<?php else: ?>
  <?php 
  // $obj = get_post_type_object( $post->post_type ); 
  // $post->post_type != 'post' ? $featured_image = $default_header_image : $featured_image = get_the_post_thumbnail($post->ID)
  ?>

<?php endif; ?>

