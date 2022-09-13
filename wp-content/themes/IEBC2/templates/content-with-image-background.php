<section 
	class="section" 
	id="section-<?= $page->post_name; ?>" 
	style="background-image:url(<?php echo $page_thumbnail; ?>);" 
	data-top="background-position: 0px 0px;" 
	data--300-top="background-position: 0px -300px;">
	<div class="container">

		<div class="row">
			<div class="col-sm-8 col-sm-push-4">

				<div class="h2 p-b"><?= $title ? $title : get_post_field('post_title', $id); ?></div>

				<?php echo apply_filters('the_content', $page->post_content); ?>

			</div><!-- col end -->
		</div><!-- row end -->

	</div><!-- container end -->
</section>