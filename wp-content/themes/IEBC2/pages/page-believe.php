<?php
// Template Name: Lo que Creemos

$page = get_page_by_path('soy-nuevo/lo-que-creemos');
$id = $page->ID;

$supertitle = carbon_get_post_meta($id, 'smpx_page_supertitle');
$title = carbon_get_post_meta($id, 'smpx_page_title');
$subtitle = carbon_get_post_meta($id, 'smpx_page_subtitle');
$creeds = carbon_get_post_meta($id, 'smpx_creed', 'complex'); 

$pagename = get_query_var('pagename');

// Prevent direct access and redirect to parent page
if( $post->ID == $page->ID ){ wp_redirect( get_permalink($page->post_parent) ); }
//-------------------------------------------------------------------------------

?>

<section 
	class="section" 
	id="section-<?= $page->post_name; ?>">
  <div class="container">
  	<div class="row">
	    <?php if( $pagename === 'soy-nuevo' ): ?>
  			<div class="col-sm-8 col-sm-push-4">
  		<?php endif; ?>
	    <?php if( $pagename === 'nosotros' ): ?>
  			<div class="col-sm-12">
  		<?php endif; ?>

			<div class="h2 p-b">
	      <?= $title ? $title : get_post_field('post_title', $page->ID); ?>
	    </div>


			<?php if( $pagename === 'nosotros' ): ?><div class="row"><?php endif; ?>

				<?php if( !empty( $creeds ) ): 
					$counter = 1;

					foreach($creeds as $creed): ?>
						<?php if( $pagename === 'nosotros' ): ?>
							<?php if( $counter % 2 == 0 ){ echo '<div class="row">'; } ?>
							<div class="col-sm-6">
						<?php endif; ?>
							<div class="p-b-md">
								<div class="p-b">
									<div class="h4"><?= $creed['smpx_title'] ?></div>
									<div class="creed-content"><?= $creed['smpx_item'] ?></div>
								</div><!-- p end -->

								<?php foreach($creed['smpx_tabs'] as $tab): ?>
									<div class="tab"><?= $tab['smpx_verse']; ?></div>
								<?php endforeach; ?>
							</div><!-- p-b-md end -->
						<?php if( $pagename === 'nosotros' ): ?>
							<?php if( $counter % 2 == 0 ){ echo '</div>'; } ?>
							</div>
						<?php endif; ?>
						<?php $counter++; ?>
					<?php endforeach;
				endif; ?>

			<?php if( $pagename === 'nosotros' ): ?></div><?php endif; ?>

    	</div><!-- col end -->
    </div><!-- row end -->
  </div><!-- container end -->
</section>








