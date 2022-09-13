<?php 
/**
 * numeric pagination for custom queries
 * Much nicer than next and previous links :)
 *
 */
function smpx_numeric_pagination($q = ''){
  if($q == ''){
    $pages = '';
    $range = 4;
  }else{
    $pages = $q->max_num_pages;
    $range = $q->query['posts_per_page'];
  }

  // $showitems = ($range * 2)+1;
  $showitems = $range;

  global $paged;
  
  if( empty($paged) ){
  	$paged = 1;
  }

  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){ $pages = 1; }
  }

  if($pages != 1): ?>
    <ul class="pagination">
      <?php //echo '<span>Page '. $paged .' of '. $pages .'</span>';
      
      if($paged > 2 && $paged >= $range && $showitems < $pages): ?> 
        <li>
          <a href="<?= get_pagenum_link(1); ?>">
            <i class="fa fa-angle-double-left"></i>
          </a>
        </li>
      <?php endif;
      
      if($paged > 1 && $showitems < $pages): ?> 
        <li>
          <a href="<?= get_pagenum_link($paged -1); ?>">
            <i class="fa fa-angle-left"></i>
          </a>
        </li>
      <?php endif;


      // for( $i = 1; $i <= $pages; $i++ ){
      for( $i = 1; $i <= 10; $i++ ){

        if($paged == $i): ?> 
          <li class="active">
            <span><?= $i; ?></span>
          </li>
        <?php elseif( 
          $i >= $paged && $i < ($showitems+$paged) || 
          $i > ($pages-$showitems)+1 
        ): ?>
          <li>
            <a href="<?= get_pagenum_link($i); ?>">
              <?= $i; ?>
            </a>
          </li>
        <?php elseif($i == $showitems+$paged): ?>
          <li><span>...</span></li>
        <?php endif;

      }

      if ($paged < $pages && $showitems < $pages): ?>
        <li>
          <a href="<?= get_pagenum_link($paged + 1); ?>">
            <i class="fa fa-angle-right"></i>
          </a>
        </li>
      <?php endif;

      if( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ): ?>
        <li>
          <a href="<?= get_pagenum_link($pages); ?>">
            <i class="fa fa-angle-double-right"></i>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  <?php endif;
}




