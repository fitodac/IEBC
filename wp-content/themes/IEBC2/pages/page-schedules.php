<?php
// Template Name: Horarios de Reuniones

$page = get_page_by_path('soy-nuevo/horarios-de-reuniones');
$id = $page->ID;

$supertitle = carbon_get_post_meta($id, 'smpx_page_supertitle');
$title = carbon_get_post_meta($id, 'smpx_page_title');
$subtitle = carbon_get_post_meta($id, 'smpx_page_subtitle');
$schedules = carbon_get_post_meta($id, 'smpx_schedules', 'complex'); 


include( locate_template('templates/top-child-pages.php') );

// Prevent direct access and redirect to parent page
if( $post->ID == $page->ID ){ wp_redirect( get_permalink($page->post_parent) ); }
//-------------------------------------------------------------------------------
?>

<section 
	id="section-<?= $page->post_name; ?>" 
	class="section" 
	style="background-image:url('<?php echo $page_thumbnail; ?>');">

	<div class="container">

	<?php if( !is_front_page() ): ?>
	<div class="row">
		<div class="col-sm-8 col-sm-push-4">
	<?php endif; ?>

		<div class="text-center">
			<span class="ion-ios-clock-outline"></span>
			<div class="h4">HORARIO DE REUNIONES</div>
		</div>

		<?php 
		if( !empty( $schedules ) ):
			$count = 1;
			$total = count($schedules);
			?>
			<div class="row">
			<?php 
			foreach($schedules as $schedule): 
				if( $count <= 2 ): ?>

					<div class="col-sm-5<?php echo $count == 2 ? ' col-sm-offset-2' : ''; ?>">
						<div class="schedule-<?= $count; ?>">
							<div class="date"><?= $schedule['smpx_date']; ?></div>
							<div class="hour"><?= $schedule['smpx_hour']; ?><small>hs</small></div>
							<div class="activity"><?= $schedule['smpx_activity']; ?></div>
						</div><!-- schedule-1 end -->
					</div><!-- col end -->
				
				<?php endif;

				if( $count == 3 ){ 
					echo '</div>';
					echo '<div class="h4">ACTIVIDADES</div>';
					echo '<div class="row">';
				}

				if( $count > 2 ): ?>
					<?php 
					if( is_front_page() ): 
						if( $total - 2 === 3 ){ 
							echo '<div class="col-sm-12">'; 
						}else if( $total - 2 === 4 ){ 
							echo '<div class="col-sm-3">'; 
						}else if( $total - 2 === 5 ){ 
							echo '<div class="col-5">'; 
						}else if( $total - 2 >= 6 ){ 
							echo '<div class="col-sm-2">'; 
						} ?>
					<?php else: ?>
						<div class="col-sm-6">
					<?php endif; ?>
						<div class="date"><?= $schedule['smpx_date']; ?></div>
							<div class="hour"><?= $schedule['smpx_hour']; ?><small>hs</small></div>
							<div class="activity"><?= $schedule['smpx_activity']; ?></div>
					</div>
				<?php endif;

				if( $count == count($schedules) ){ echo '</div>'; }

				$count++;
			endforeach;

		endif;

		if( !is_front_page() ): ?>
			</div><!-- col end -->
		</div><!-- row end -->
		<?php endif; ?>
	</div><!-- container end -->
</section>





