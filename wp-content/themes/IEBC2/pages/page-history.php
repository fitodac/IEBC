<?php
// Template Name: Nuestra Historia

$page = get_page_by_path('soy-nuevo/nuestra-historia');
$id = $page->ID;

$supertitle = carbon_get_post_meta($id, 'smpx_page_supertitle');
$title = carbon_get_post_meta($id, 'smpx_page_title');
$subtitle = carbon_get_post_meta($id, 'smpx_page_subtitle');


include( locate_template('templates/top-child-pages.php') );

// Prevent direct access and redirect to parent page
if( $post->ID == $page->ID ){ wp_redirect( get_permalink($page->post_parent) ); }
//-------------------------------------------------------------------------------
?>


<section 
	id="section-<?= $page->post_name; ?>" 
	class="section">
  <div class="container">
  	<div class="row">
  		<?php if( $pagename === 'soy-nuevo' ): ?>
  			<div class="col-sm-8 col-sm-push-4">
  		<?php endif; ?>
	    <?php if( $pagename === 'nosotros' ): ?>
  			<div class="col-sm-12">
  		<?php endif; ?>


	    <div class="h2 p-b">
	      <?= $title ? $title : get_post_field('post_title', $id); ?>
	    </div>
	    <?php echo apply_filters('the_content', $page->post_content); ?>
			</div><!-- col end -->
    </div><!-- row end -->
  </div><!-- container end -->
</section>


