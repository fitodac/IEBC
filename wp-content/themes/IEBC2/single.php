<?php 
get_header(); 

$sign = carbon_get_theme_option('smpx_preacher_info');
$preacher_tmb = carbon_get_theme_option('smpx_preacher_picture');

$id = $post->ID;

$d = get_the_date('d');
$m = get_the_date('F');
$y = get_the_date('Y'); 

$categories = get_the_terms($id, 'mensajes_cat'); 

get_template_part( 'template-parts/content', 'header' );

get_template_part( 'templates/fb', 'comments-script' );
?>






<div class="container">
	<div class="fixed-sidebar">
		<div class="container">
			<div class="row">
				<?php get_sidebar('preaches'); ?>
			</div><!-- row end -->
		</div><!-- container end -->
	</div><!-- fixed-sidebar end -->


	<div class="row p-b-lg">  
		
		<div class="col-sm-4">
			<?php the_post_thumbnail('full img-responsive'); ?>
		</div><!-- col end -->
			


		<div class="col-sm-8">
			<article>
				<header>
					<div class="h2"><?= the_title(); ?></div>

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
				</header>

				<?php the_content(); ?>

				<footer>
					<div class="row">
						<div class="col-md-6 signature">
							<?php echo wp_get_attachment_image( $preacher_tmb, 'thumbnail', '', array( 'class' => 'img-responsive img-circle pull-left' ) ); ?>
							<?= $sign; ?>
						</div><!-- col end -->


						<div class="col-md-6"></div><!-- col end -->
					</div><!-- row end -->
				</footer>

				<?php wp_reset_query(); ?>

				<div class="share-post clearfix">
					<strong>Te ha ayudado este mensaje? Compártelo:</strong>

					<?php do_action( 'addthis_widget', get_permalink(), get_the_title(), array(
						'type' => 'custom',
						'size' => '32',
						'services' => 'facebook,twitter,google_plus,mail',
						'preferred' => '2', 
						'more' => true, 
						'counter' => 'bubble_style' 
					)); ?>
				</div><!-- share end -->


				<div class="fb-comments" 
				data-href="https://iglesiadecarrasco.com" 
				data-width="100%" 
				data-numposts="10" 
				data-colorscheme="light"></div>
			</article>
		</div><!-- col end -->

	</div><!-- row end -->


	<?php 
	if( $post->post_type == 'ferias_cpt' ):
		get_template_part( 'template-parts/content', 'related_ferias' );
	endif;


	if( comments_open() || get_comments_number() ){
		comments_template();
	}
	?>

</div><!-- container end -->

<?php 
get_template_part( 'templates/section', 'life-focus' );

get_footer();





