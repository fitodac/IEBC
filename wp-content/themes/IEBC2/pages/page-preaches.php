<?php
get_header();
// Template Name: Mensajes


// $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$main_query = new WP_Query(
	array(
		'post_type'       => 'preaches',
		'post_status'     => 'publish',
		'posts_per_page'  => 10,
		'paged' 					=> $paged
	)
);

?>


<section 
	id="section-<?= $post->post_name; ?>" 
	class="section">
	<div class="container">


		<div class="fixed-sidebar">
			<div class="container">
				<div class="row">
					<?php get_sidebar('preaches'); ?>
				</div><!-- row end -->
			</div><!-- container end -->
		</div><!-- fixed-sidebar end -->




		<div class="row">

			<div class="col-sm-8 col-sm-push-4">
				<?php if( $main_query->have_posts() ): 
					$count = 0;

					while( $main_query->have_posts() ): 
						$main_query->the_post(); 

						$id = $post->ID;

						$d = get_the_date('d');
						$m = get_the_date('F');
						$y = get_the_date('Y'); 

						$categories = get_the_terms($id, 'mensajes_cat'); 
						?>


						<article
							<?= $count === 0 && $paged === 0 ? ' class="featured-article"' : ''; ?>
							<?php if( $count > 0 ): ?>
								data-bottom-top="opacity: 0; transform:translateY(150px);"
								data-bottom="opacity: 1; transform:translateY(0px);"
							<?php endif; ?>>
							<div class="<?= $count === 0 && $paged === 0 ? 'h2' : 'h3'; ?>">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>

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


							<?php if( $count === 0 && $paged === 0 ): ?>

								<div class="p-b">
									<?php echo wp_trim_words(get_the_content(), 160, '...'); ?>
								</div><!-- p-b end -->

								<div class="text-right">
									<a href="<?php the_permalink(); ?>" class="btn btn-dark btn-outline" rel="nofollow">SEGUIR LEYENDO</a>
								</div><!-- text-right end -->

							<?php else: ?>
								<?php the_excerpt(); ?>
							<?php endif; ?>
						</article>

						<?php 
						$count++;

					endwhile; ?>

					<div class="text-center">
						<?php if( function_exists('smpx_numeric_pagination') ){
							smpx_numeric_pagination($main_query); 
						}?>
					</div>

				<?php else: ?>
      		<p>Todavía no hay mensajes publicados.</p>
    		<?php endif; 

				wp_reset_postdata(); ?>

			</div><!-- col end -->

		</div><!-- row end -->
	</div><!-- container end -->
</section>


<?php
get_template_part( 'templates/section', 'life-focus' );

get_footer();




