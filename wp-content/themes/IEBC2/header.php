<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	$logo = carbon_get_theme_option('smpx_logo');
	$logo_alt = carbon_get_theme_option('smpx_logo_alt');
	$use_alt_header = carbon_get_the_post_meta( 'smpx_use_header_alt' );
	?>

	<div 
		class="main-header<?php if( $use_alt_header && !is_front_page() || is_single() || is_404() ){ echo ' alt-header'; } ?>">
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6">
						<?php 
						if( has_nav_menu( 'secondary-menu' ) ) : 
							wp_nav_menu( array(
								'theme_location' => 'secondary-menu',
								'menu_class'     => 'nav navbar-nav',
							) );
						endif; 
						?>
					</div><!-- col end -->
				</div><!-- row end -->
			</div><!-- container end -->
		</div><!-- topbar end -->


		<div class="container">
			<nav class="navbar navbar-default">

				<div class="navbar-header">
					<button 
					type="button" 
					class="navbar-toggle collapsed" 
					data-toggle="collapse" 
					data-target="#site-header-menu">
					<span class="fa fa-bars"></span>
					</button>

					<h1 class="navbar-brand">
						<a href="<?php echo esc_url( home_url('/') ); ?>">

							<?php if( is_front_page() ): ?>
								<span class="logo"><img src="<?= $logo; ?>" alt="logo"></span>
							<?php elseif( is_404() ): ?>
								<span class="logo-alt"><img src="<?= $logo_alt; ?>" alt="logo"></span>
							<?php elseif( $use_alt_header == 1 ): ?>
								<span class="logo-alt"><img src="<?= $logo_alt; ?>" alt="logo"></span>
							<?php elseif( is_single() ): ?>
								<span class="logo-alt"><img src="<?= $logo_alt; ?>" alt="logo"></span>
							<?php else: ?>
								<span class="logo"><img src="<?= $logo; ?>" alt="logo"></span>
							<?php endif; ?>

							<span class="sr-only"><?php bloginfo( 'name' ); ?></span>
						</a>
					</h1>
				</div><!-- navbar-header end -->
				



				<?php if( has_nav_menu( 'main-menu' ) ) : ?>
					<div id="site-header-menu" class="collapse navbar-collapse">
						
						<?php
						wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'menu_class'     => 'nav navbar-nav',
						) );
						?>
					</div><!-- .site-header-menu -->
				<?php endif; ?>

			</nav><!-- navbar end -->
		</div><!-- container end -->
	</div><!-- main-header end -->



