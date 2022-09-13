<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


$prefix = 'smpx_';
$pagePath = 'pages/';

/*---------------------------------------------*/
/*  PAGES
/*---------------------------------------------*/
Container::make('post_meta', 'Page Options')
->show_on_post_type('page')
->add_fields(array(

	/*---------------------------------------------*/
	/*  TITLE & SUBTITLE
	/*---------------------------------------------*/
	Field::make('separator', 'title_page_title', 'Page title')
	,Field::make('text', $prefix.'page_supertitle', 'Page Supertitle')
	->help_text('Small text above the page title.')

	,Field::make('text', $prefix.'page_title', 'Page Title')

	,Field::make('text', $prefix.'page_subtitle', 'Page Subtitle')
	->help_text('Small text below the page title.')

	// ALTERNATIVE HEADER
	,Field::make('checkbox', $prefix.'use_header_alt', 'Use alternative header')
	->set_option_value(1)
	->help_text('Activate to use the alternative header.')
	->set_width(30)

	// ALTERNATIVE LOGO
	// ,Field::make('checkbox', $prefix.'use_logo_alt', 'Use alternative logo')
	// ->set_option_value(1)
	// ->help_text('Activate to use the alternative logo.')
	// ->set_width(30)



	/*---------------------------------------------*/
	/*  SLIDER
	/*---------------------------------------------*/
	,Field::make('separator', 'title_slider', 'Slider')
	->set_width(80)

	,Field::make('checkbox', $prefix.'toggle_slider', 'Switch')
	->set_option_value(1)
	->set_width(20)

	,Field::make('complex', $prefix.'slider')
	->add_fields(array(
		Field::make('image', $prefix.'slider_img')
		
		,Field::make('text', $prefix.'slider_title', 'Title')
		->set_width(50)
		
		,Field::make('text', $prefix.'slider_subtitle', 'Subtitle')
		->set_width(50)
		
		,Field::make('rich_text', $prefix.'slider_caption', 'Caption')
		
		,Field::make('set', $prefix.'button', '')
		->set_options(
			array(
				1 => 'Add button link'
			)
		)
		->set_width(30)

		,Field::make('separator', 'blank_separator', '')
		->set_width(70)

		,Field::make('text', $prefix.'button_text', 'Button text')
		->set_width(50)
		->set_conditional_logic(array(
			array(
				'field' => $prefix.'button',
				'value' => 1,
				'compare' => '='
			)
		))

		,Field::make('text', $prefix.'button_link', 'Button link')
		->set_width(50)
		->set_conditional_logic(array(
			array(
				'field' => $prefix.'button',
				'value' => 1,
				'compare' => '='
			)
		))

	))
	->set_conditional_logic(array(
		array(
			'field' => $prefix.'toggle_slider',
			'value' => 1,
			'compare' => '='
		)
	))

	
));






/*---------------------------------------------*/
/*  SCHEDULES
/*---------------------------------------------*/
Container::make('post_meta', 'Horarios')
->show_on_post_type('page')
->show_on_template($pagePath.'page-schedules.php')
->add_fields(array(
	Field::make('complex', $prefix.'schedules', '')
	->add_fields(array(
		Field::make('text', $prefix.'date', 'Fecha')
		->set_width(50)
		,Field::make('text', $prefix.'hour', 'Horario')
		->set_width(20)
		,Field::make('text', $prefix.'activity', 'Actividad')
		->set_width(30)
	))
));





/*---------------------------------------------*/
/*  WE BELIEVE
/*---------------------------------------------*/
Container::make('post_meta', 'Lo que Creemos')
->show_on_post_type('page')
->show_on_template($pagePath.'page-believe.php')
->add_fields(array(
	Field::make('complex', $prefix.'creed', '')
	->add_fields(array(
		Field::make('text', $prefix.'title', 'Creemos que...')
		,Field::make('rich_text', $prefix.'item', 'Contenido')
		,Field::make('complex', $prefix.'tabs', 'Versículos')
		->add_fields(array(
			Field::make('text', $prefix.'verse', '')
			->set_width(50)
		))
	))
));




/*---------------------------------------------*/
/*  ABOUT
/*---------------------------------------------*/
Container::make('post_meta', 'Misión & Visión')
->show_on_post_type('page')
->show_on_template($pagePath.'page-about.php')
->add_fields(array(
	Field::make('rich_text', $prefix.'mision', 'Misión')
	,Field::make('rich_text', $prefix.'vision', 'Visión')
));






function hide_page_editor(){
	if( isset($_GET['post']) ){
		$id = $_GET['post'];
		$template = get_post_meta($id, '_wp_page_template', true);

		if(
			$template == 'pages/page-schedules.php' || 
			$template == 'pages/page-directions.php' || 
			$template == 'pages/page-believe.php' || 
			$template == 'pages/page-preaches.php'
		){ 
			remove_post_type_support( 'page', 'editor' );
		}
	}
}
add_action( 'admin_init', 'hide_page_editor' );

