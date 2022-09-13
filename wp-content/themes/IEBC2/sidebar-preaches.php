<?php 
$id = $post->ID;

$title = carbon_get_post_meta( $id, 'smpx_page_title' ); 
$supertitle = carbon_get_post_meta( $id, 'smpx_page_supertitle' ); 
$subtitle = carbon_get_post_meta( $id, 'smpx_page_subtitle' ); 


$sidebar_query = new WP_Query(
	array(
		'post_type'       => 'preaches',
		'post_status'     => 'publish',
		'posts_per_page'  => 5,
	)
);
?>

<aside class="col-sm-4">
	<div class="sidebar-wrapper">
		<div class="sidebar-content">
			<?php if( is_single() ): ?>
				<header style="background-image:url('<?= get_the_post_thumbnail_url(111, 'large'); ?>');">

					<div class="page-title">
						<?php 
						$cat_title = $post->post_type === 'preaches';
						
						if( $post->post_type === 'preaches' ){
							$obj = get_post_type_object( 'preaches' );
							echo $obj->label;
						}else{
							echo $title ? $title : get_the_title($id);
						} ?>
					</div>
				</header>
			<?php else: ?>
				<header style="background-image:url('<?php the_post_thumbnail_url('large'); ?>');">
					<div class="page-title"><?= $title ? $title : get_the_title($id); ?></div>
				</header>
			<?php endif; ?>
			

			<div class="latest-preaches" 
				data-center-top="opacity: 0;" 
				data-center="opacity: 1;">
				<div class="h4">Mensajes anteriores</div>

				<div class="list-group">
				<?php 
				if( $sidebar_query->have_posts() ): 

					$count = 0;

					while( $sidebar_query->have_posts() ):
						$sidebar_query->the_post(); 

						$id = $post->ID;
						$categories = get_the_terms($id, 'mensajes_cat'); 

						$d = get_the_date('d');
						$m = get_the_date('M');
						$y = get_the_date('Y'); 
						

						if( $count > 0 ): ?>

							<div class="list-group-item">
								<div class="date">
									<span><?= $d; ?></span>
									<small><?= $m; ?></small>
								</div><!-- date end -->


								<div>
									<a href="<?php the_permalink(); ?>" class="preach-title">
										<?php the_title(); ?>
									</a>

									<div class="preach-categories">
										<?php 
										$cat_count = 0;
										foreach($categories as $cat):
											echo '<span>'.$cat->name.'</span>';
											echo $cat_count > 0 ? ', ' : '';
											$cat_count++;
										endforeach; 
										?>
									</div><!-- preach-categories end -->
								</div>
							</div><!-- list-group-item end -->

						<?php 
						endif;

						$count++;

					endwhile;
				endif; 

				wp_reset_postdata();?>
				</div><!-- list-group end -->
			</div><!-- latest-preaches end -->

	  </div><!-- sidebar-content end -->
  </div><!-- sidebar-wrapper end -->
</aside>



