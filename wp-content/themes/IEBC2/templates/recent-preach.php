<section id="recent-preach" class="section">
	<div class="container">
		<?php 
		$main_query = new WP_Query(
			array(
				'post_type'       => 'preaches',
				'post_status'     => 'publish',
				'posts_per_page'  => 1,
			)
		);

		$sidebar_query = new WP_Query(
			array(
				'post_type'       => 'preaches',
				'post_status'     => 'publish',
				'posts_per_page'  => 5,
			)
		);


		// The Loop
		if( $main_query->have_posts() ): ?>
		<div class="row">
			<div class="col-md-8">
				<?php 
				while( $main_query->have_posts() ):
					$main_query->the_post(); 

					$id = $post->ID;
					$categories = get_the_terms($id, 'mensajes_cat'); 

					$d = get_the_date('d');
					$m = get_the_date('F');
					$y = get_the_date('Y');
					?>

					<div class="h3"><?php the_title(); ?></div>

					<div class="post-data">
						<?php if( !empty($categories) ): ?>
							<div class="categories">
								<?php foreach($categories as $cat):
								echo '<span class="cat">'.$cat->name.'</span>'; 
								endforeach; ?>
							</div><!-- categories end -->
						<?php endif; ?>

						<div class="date"><?php echo $d.' de '.$m.' de '.$y; ?></div>
						<div class="comments"><fb:comments-count href="<?php echo get_permalink($post->ID); ?>"></fb:comments-count> comentarios</div>
					</div><!-- post-data end -->

					<?php the_content(); ?>

					<footer>
						<div class="row">
							<div class="col-lg-5 col-sm-6">
								<a href="<?= get_page_link(10); ?>" class="btn btn-dark btn-outline btn-block upper">Me ha ayudado este mensaje</a>
							</div><!-- col end -->

							<div class="col-lg-7 col-sm-6">
								<?php 
								do_action( 'addthis_widget', get_permalink(), get_the_title(), array(
									'type' => 'custom',
									'size' => '32',
									'services' => 'facebook,twitter,google_plus,mail',
									'preferred' => '2', 
									'more' => true, 
									'counter' => 'bubble_style' 
								));
								?>
							</div><!-- col end -->
						</div><!-- row end -->
					</footer>
				<?php endwhile; ?>
			</div><!-- col end -->






			<!-- SIDEBAR -->
			<div class="col-lg-3 col-lg-offset-1 col-md-4">

				<div class="latest-preaches">

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
					endif; ?>
					</div><!-- list-group end -->
				</div><!-- latest-preaches end -->


				<a href="<?= get_page_link(111); ?>" class="btn btn-dark btn-outline btn-block">VER TODOS LOS MENSAJES</a>
			</div><!-- col end -->




		</div><!-- row end -->
		<?php else: ?>
			<p>Todavía no hay mensajes publicados.</p>
		<?php 
		endif;

		wp_reset_postdata();
		?>
		
	</div><!-- container end -->
</section><!-- section end -->


