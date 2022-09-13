<?php 
get_header();

$title = carbon_get_the_post_meta( 'smpx_page_title' ); 
$supertitle = carbon_get_the_post_meta( 'smpx_page_supertitle' ); 
$subtitle = carbon_get_the_post_meta( 'smpx_page_subtitle' ); 

get_template_part( 'templates/content', 'header' ); ?>

<div 
	class="container" 
	<?php if( has_post_thumbnail() ): ?>
	data-start="color: rgba(255,255,255,1);" 
  data-32p-top="color: rgba(68,68,68,1);" <?php endif; ?>>
	<div class="row">
		<div class="col-md-8 col-md-push-4 col-sm-10 col-sm-push-1">
			<h2>
				<?= $supertitle ? '<small>'.$supertitle.'</small>' : ''; ?>
				<span><?= $title ? $title : get_the_title(); ?></span>
				<?= $subtitle ? '<small>'.$subtitle.'</small>' : ''; ?>
			</h2>

			<?php get_template_part( 'templates/content', 'page' ); ?>			
		</div><!-- col end -->

		<aside class="col-sm-4">
			
		</aside>
	</div><!-- row end -->

</div><!-- container end -->

<?php get_footer();