<?php 
get_header();


get_template_part( 'templates/main', 'slider' );
get_template_part( 'templates/recent', 'preach' );
get_template_part( 'pages/page', 'schedules' );
get_template_part( 'templates/section', 'banners' );
get_template_part( 'templates/section', 'life-focus' );
?>

<div id="pray-request" class="modal fade" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Pedidos de Oración</h4>
			</div><!-- modal-header end -->

			<div class="modal-body">
				<div class="contact-form">
					<?php echo do_shortcode('[contact-form-7 id="2037"]'); ?>
				</div><!-- contact-form end -->
			</div><!-- modal-body end -->
			
		</div><!-- modal-content end -->
	</div><!-- modal-dialog end -->
</div><!-- modal end -->

<?php 
get_footer();



