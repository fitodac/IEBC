<?php
get_header();
// Template Name: Enfoque


get_template_part( 'pages/page', 'jesus' );
?>

<div class="fixed-sidebar">
	<div class="container">
		<div class="row">
			<?php get_sidebar('left'); ?>
		</div><!-- row end -->
	</div><!-- container end -->
</div><!-- fixed-sidebar end -->

<?php 
get_template_part( 'pages/page', 'commit' );
get_template_part( 'pages/page', 'connect' );
get_template_part( 'pages/page', 'grow' );
get_template_part( 'pages/page', 'serve' );
get_template_part( 'pages/page', 'give' );


get_footer();