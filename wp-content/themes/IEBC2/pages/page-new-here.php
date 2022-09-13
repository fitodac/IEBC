<?php
get_header();
// Template Name: Nuevo Aqui

get_template_part( 'pages/page', 'directions' ); ?>


<div class="fixed-sidebar">
	<div class="container">
		<div class="row">
			<?php get_sidebar('left'); ?>
		</div><!-- row end -->
	</div><!-- container end -->
</div><!-- fixed-sidebar end -->


<section id="section-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-push-4">
				<div class="card">
					<div class="card-block">
						<?php the_content(); ?>
					</div><!-- card-block end -->
				</div><!-- card end -->
			</div><!-- col end -->
		</div><!-- row end -->
	</div><!-- container end -->
</section><!-- container end -->

<?php 
get_template_part( 'pages/page', 'schedules' );
get_template_part( 'pages/page', 'believe' );
get_template_part( 'pages/page', 'history' );
get_template_part( 'pages/page', 'pr' );


get_footer();



