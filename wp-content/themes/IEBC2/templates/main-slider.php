<?php
$has_slider = carbon_get_the_post_meta('smpx_toggle_slider');

if($has_slider):
	$slider = carbon_get_the_post_meta('smpx_slider', 'complex');
	?>

	<div 
		id="main-slider" 
		class="owl-carousel owl-theme" 
		data-top="opacity: 1; transform: translateY(0vh) scale(1); z-index: 30;" 
		data--20p-top="opacity: 0; transform: translateY(-60vh) scale(2); z-index: 1;">
	<?php 
	if( !empty( $slider ) ):
		foreach($slider as $item): ?>
		<div 
		class="item" 
		style="background-image:url(<?= wp_get_attachment_image_src($item['smpx_slider_img'], 'full')[0]; ?>);">
			<div class="container-fluid">
				<div class="row">

					<div class="slider-description">
						<div class="h2">
							<?php 
							echo $item['smpx_slider_title'] ? '<span>'.$item['smpx_slider_title'].'</span>' : ''; 
							echo $item['smpx_slider_subtitle'] ? '<small>'.$item['smpx_slider_subtitle'].'</small>' : ''; 
							echo $item['smpx_slider_caption'] ? '<div class="lead">'.$item['smpx_slider_caption'].'</div>' : ''; 
							?>
						</div><!-- h2 end -->

						<?php if( $item['smpx_button'] ): ?>
						<div class="p-t">
							<a href="<?php echo $item['smpx_button_link'] ? $item['smpx_button_link'] : '#'; ?>" class="btn btn-default btn-outline">
								<?php echo $item['smpx_button_text'] ? $item['smpx_button_text'] : ''; ?>
							</a>
						</div>
						<?php endif; ?>
					</div><!-- slider-description end -->

				</div><!-- row end -->
			</div><!-- container-fluid end -->
		</div><!-- item end -->
		<?php endforeach;
	endif; ?>
	</div><!-- main-slider end -->

<?php endif; ?>


