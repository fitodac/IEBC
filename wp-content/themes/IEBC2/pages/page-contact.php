<?php
get_header();
// Template Name: Contacto

$supertitle = carbon_get_the_post_meta('smpx_supertitle');
$title = carbon_get_the_post_meta('smpx_title');
$subtitle = carbon_get_the_post_meta('smpx_subtitle');
?>


<div>
	<?php get_template_part( 'pages/page', 'directions' ); ?>


	<div class="fixed-sidebar">
		<div class="container">
			<div class="row">
				<?php get_sidebar('preaches'); ?>
			</div><!-- row end -->
		</div><!-- container end -->
	</div><!-- fixed-sidebar end -->



	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>

			<div class="col-sm-8" 
			data-center-top="opacity: 0;" 
			data-center="opacity: 1;">
				<?php the_content(); ?>
				<div class="contact-form">
					<?= do_shortcode('[contact-form-7 id="2032"]'); ?>
				</div><!-- contact-form end -->
			</div><!-- col end -->
		</div><!-- row end -->
	</div><!-- container end -->


	<?php get_template_part( 'pages/page', 'schedules' ); ?>
</div>



<?php 
get_template_part( 'templates/section', 'banners' );
get_template_part( 'templates/section', 'life-focus' );


get_footer();





