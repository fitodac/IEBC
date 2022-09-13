<?php 
$page = get_page_by_path('soy-nuevo/horarios-de-reuniones');

$schedules = carbon_get_post_meta($page->ID, 'smpx_schedules', 'complex'); 

$page_thumbnail = wp_get_attachment_url( get_post_thumbnail_id($page->ID) );
?>

<section 
id="section-schedules" 
class="section" 
style="background-image:url(<?php echo $page_thumbnail; ?>);">
  <div class="container">

    <div class="text-center">
      <span class="ion-ios-clock-outline"></span>
      <div class="h4">HORARIO DE REUNIONES</div>
    </div>

    <?php if( !empty( $schedules ) ):
      $count = 1;
      ?>
      <div class="row">
        <?php foreach($schedules as $schedule): 
          if( $count <= 2 ): ?>

            <div class="col-md-5<?php echo $count == 2 ? ' col-md-offset-2' : ''; ?>">
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
            <div class="col-md-2">
              <div class="date"><?= $schedule['smpx_date']; ?></div>
                <div class="hour"><?= $schedule['smpx_hour']; ?><small>hs</small></div>
                <div class="activity"><?= $schedule['smpx_activity']; ?></div>
            </div>
          <?php endif;

          if( $count == count($schedules) ){ echo '</div>'; }

          $count++;
        endforeach; ?>
    <?php 
    endif; ?>

  </div><!-- container end -->
</section><!-- section end -->


