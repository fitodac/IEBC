<?php
// Template Name: Pastor

$page = get_page_by_path('soy-nuevo/pr-thomas-robertson');
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
	class="section" 
	id="section-<?= $page->post_name; ?>" 
	style="background-image:url(<?php echo $page_thumbnail; ?>);">
  
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-lg-push-4 col-md-6 col-md-push-4">
				<div class="card">
					<div class="card-block">
						<div class="h3">
							<?= $title ? $title : get_post_field('post_title', $id); ?>
						</div>
						<?php echo apply_filters('the_content', $page->post_content); ?>
					</div><!-- card-block end -->
				</div><!-- card end -->
			</div><!-- col end -->
		</div><!-- row end -->
	</div><!-- container end -->

</section>



