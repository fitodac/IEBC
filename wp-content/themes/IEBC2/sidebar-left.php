<?php 
$id = $post->ID;

$title = carbon_get_post_meta( $id, 'smpx_page_title' ); 
$supertitle = carbon_get_post_meta( $id, 'smpx_page_supertitle' ); 
$subtitle = carbon_get_post_meta( $id, 'smpx_page_subtitle' ); 
?>

<aside class="col-sm-4">
	<div class="sidebar-wrapper">
		<div class="sidebar-content">
			<header style="background-image:url('<?php the_post_thumbnail_url('large'); ?>');">
				<div class="page-title"><?= $title ? $title : get_the_title($id); ?></div>
			</header>

			<div class="nav">
				<?php 
				$pagename = get_query_var('pagename');

				if( $pagename === 'soy-nuevo' && is_active_sidebar('sidebar-new-people') ) : 
					dynamic_sidebar('sidebar-new-people');
				
				elseif( $pagename === 'enfoque' && is_active_sidebar('sidebar-focus') ) : 
					dynamic_sidebar('sidebar-focus');
				
				elseif( is_active_sidebar('sidebar-contact') ) : 
					dynamic_sidebar('sidebar-contact');
				
				elseif( is_active_sidebar('common-pages') ) : 
					dynamic_sidebar('common-pages');
				endif; ?>
			</div><!-- nav end -->

	  </div><!-- sidebar-content end -->
  </div><!-- sidebar-wrapper end -->
</aside>



