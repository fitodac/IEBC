<?php
// INI
require_once 'inc/ini.php';




function smpx_scripts() {
	// LOADER
	wp_enqueue_style( 'pace', get_template_directory_uri() . '/assets/plugins/pace/templates/pace-theme.css', array(), '1.0.0' );

	// LOADER
	wp_enqueue_script( 'pace', get_template_directory_uri() . '/assets/plugins/pace/pace.min.js', array('jquery'), '1.0.1', false );



	// Bootstrap
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/bootstrap.min.css', array(), '3.3.6' );

	// FonAwesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/icons/fontawesome/css/font-awesome.min.css', array(), '1.0' );

	// Ionicons
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/icons/ionicons/css/ionicons.min.css', array(), '1.0' );

	// Lightbox
	// wp_enqueue_style( 'simple-lightbox', get_template_directory_uri() . '/assets/plugins/simple-lightbox/simplelightbox.min.css', array(), '1.0' );

	if( is_front_page() ){ 
		// OWL
		wp_enqueue_style( 'owl', get_template_directory_uri() . '/assets/plugins/owl/owl.carousel.min.css', array(), '1.0' );
	}

	// Nitro
	wp_enqueue_style( 'nitro', get_template_directory_uri() . '/assets/css/nitro.min.css', array(), '0.0.8' );


	//*** Project stylesheet
	wp_enqueue_style( 'project-style', get_template_directory_uri() . '/assets/css/iebc.css', array(), '0.5' );
	//***

	// Load the html5 shiv.
	wp_enqueue_script( 'smpx-html5', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', array(), '3.7.3' );

	wp_enqueue_script( 'smpx-html5', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array(), '1.4.2' );

	wp_script_add_data( 'smpx-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/plugins/jquery/jquery.2.1.4.min.js', array(), '2.1.4', true );


	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/plugins/bootstrap/bootstrap.min.js', array('jquery'), '3.3.6', true );
	

	if( is_page(12) || is_page(10) ):
		// gMaps
		// Enable this if need to use google maps
		wp_enqueue_script( 'googlemaps', 'http://maps.google.com/maps/api/js?sensor=false&amp;language=en', array(), '1.0', false );
		wp_enqueue_script( 'gmaps-js', get_template_directory_uri() . '/assets/plugins/gmap3/gmap3.min.js', array('jquery'), '7.0', true );
	endif;


	// SKROLLR
	wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/assets/plugins/skrollr/skrollr.min.js', array('jquery'), '0.6.30', true );


	if( is_front_page() ){ 
		// OWL
		wp_enqueue_script( 'owl', get_template_directory_uri() . '/assets/plugins/owl/owl.carousel.min.js', array('jquery'), '7.0', true );
	}


	// STICKY KIT
	wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/assets/plugins/sticky-kit/jquery.sticky-kit.min.js', array('jquery'), '1.1.2', true );
	
	// NITRO
	wp_enqueue_script( 'nitro', get_template_directory_uri() . '/assets/js/nitro.min.js', array('jquery'), '0.0.5', true );
	

	//*** Project javascript
	wp_enqueue_script( 'smpx-script', get_template_directory_uri() . '/assets/js/application.js', array('jquery'), '0.3', true );
	//***
}

add_action( 'wp_enqueue_scripts', 'smpx_scripts' );






function wpdocs_excerpt_more( $more ) {
	$readmore = '<div class="text-right">'
	.'<a class="btn btn-dark btn-outline" href="'.get_the_permalink().'" rel="nofollow">SEGUIR LEYENDO</a>'
	.'</div>';
	
	return $readmore;
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );










