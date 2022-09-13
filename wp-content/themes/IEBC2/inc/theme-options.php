<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$prefix = 'smpx_';

// Default options page
Container::make('theme_options', 'Theme Options')
	->set_icon('dashicons-carrot')
	->set_page_parent('themes.php')


	/*---------------------------------------------*/
	/*  GENERAL
	/*---------------------------------------------*/
	->add_fields(array(
		Field::make('separator', 'title_general', 'General')
		// Logo
		,Field::make('file', $prefix.'logo', 'Logo')
		->set_value_type('url')
		->set_default_value(get_template_directory_uri() . '/assets/svg/nitro-brand.svg')
		->help_text('Select an image file for your logo. SVG file prefered')
		->set_width(50)

		// Logo Alt
		,Field::make('file', $prefix.'logo_alt', 'Logo alternative')
		->set_value_type('url')
		->set_default_value(get_template_directory_uri() . '/assets/svg/nitro-brand-alt.svg')
		->help_text('Select an alternative logo, for example, if you need to use a negative version of the logo.')
		->set_width(50)
	))



	/*---------------------------------------------*/
	/*  SOCIAL
	/*---------------------------------------------*/
	->add_tab(__('Social'), array(
		Field::make('separator', 'title_social', 'Social')

		// Twitter
		,Field::make('text', $prefix.'twitter', 'Twitter Profile')
		->set_width(50)
		,Field::make('text', $prefix.'twitter_url', 'Twitter URL')
		->set_width(50)

		// Facebook
		,Field::make('text', $prefix.'facebook', 'Facebook Profile')
		->set_width(50)
		,Field::make('text', $prefix.'facebook_url', 'Facebook URL')
		->set_width(50)

		// Instagram
		,Field::make('text', $prefix.'instagram', 'Instagram User')
		->set_width(50)
		,Field::make('text', $prefix.'instagram_url', 'Instagram URL')
		->set_width(50)

		// Google Plus
		,Field::make('text', $prefix.'googleplus', 'Google Plus Profile')
		->set_width(50)
		,Field::make('text', $prefix.'googleplus_url', 'Google Plus URL')
		->set_width(50)

		// LinkedIn
		,Field::make('text', $prefix.'linkedin', 'Linkedin Profile')
		->set_width(50)
		,Field::make('text', $prefix.'linkedin_url', 'Linkedin URL')
		->set_width(50)
	))



	/*---------------------------------------------*/
	/*  CONTACT INFO
	/*---------------------------------------------*/
	->add_tab(__('Contact'), array(
		Field::make('separator', 'title_contact', 'Contact')

		// Firma del pastor
		,Field::make('file', $prefix.'preacher_picture', 'Firma del Pastor')
		->set_width(50)
		->help_text('Imagen del pastor para firma de mensajes. Preferentemente 260 x 260.')

		,Field::make('textarea', $prefix.'preacher_info', 'Firma del Pastor')
		->set_default_value('Tomas Robertson<br>095 059 069<br>tomas@chasque.com')
		->set_width(50)


		// Address
		,Field::make('text', $prefix.'address', 'Address')
		->set_default_value('2339 Glendale Avenue - Pomona, California')
		
		// Phone
		,Field::make('complex', $prefix.'phone', 'Phone')
		->add_fields(array(
			Field::make('text', $prefix.'phone_item', '')
			->set_default_value('+1(818)657-7861')
		))
		
		// Email
		,Field::make('complex', $prefix.'email', 'Email')
		->add_fields(array(
			Field::make('text', $prefix.'email_item', '')
			->set_default_value('info@smartpixl.com')
		))

		,Field::make('separator', 'title_map', 'Map')
		// Map
		,Field::make('map', $prefix.'map')
		->set_position(37.423156, -122.084917, 14)

		// Map zoom
		,Field::make('text', $prefix.'map_zoom', 'Map zoom')
		->set_default_value(17)
		->set_width(30)

		// Map marker
		,Field::make('file', $prefix.'map_marker', 'Map marker')
		->set_value_type('url')
		->help_text('Select an image for map marker. PNG file prefered.')
		->set_width(70)
	))






	/*---------------------------------------------*/
	/*  FOOTER
	/*---------------------------------------------*/
	->add_tab(__('Footer'), array(
		Field::make('separator', 'title_footer', 'Footer')

		// Footer logo
		,Field::make('file', $prefix.'logo_secondary', 'Secondary logo in footer')
		->set_value_type('url')
		->help_text('Select an image file for your logo. SVG file prefered')
		->set_default_value(get_template_directory_uri() . '/assets/svg/nitro-brand-alt.svg')

		// Address section in footer
		,Field::make('textarea', $prefix.'address_section', 'Address section in Footer')
		->help_text('HTML markup can be used.')
		->set_default_value('2339 Glendale Avenue<br>Pomona, California')

		// Copyright
		,Field::make('text', $prefix.'copy', 'Copyright')
		->help_text('Enter the text that displays in the copyright bar. HTML markup can be used.')
		->set_default_value('&copy; 2016 An Smartpixl Product')
	))






	/*---------------------------------------------*/
	/*  ADMIN
	/*---------------------------------------------*/
	->add_tab(__('Admin'), array(
		Field::make('separator', 'title_admin', 'Admin')
		
		// Admin bar
		,Field::make('checkbox', $prefix.'toggle_adminbar', 'Hide admin bar')
		->set_option_value(1)
		->help_text('Show or hide the admin bar in frontend.')

		// Posts formats
		,Field::make('separator', 'title_post_formats', 'Post Formats')
		->help_text('Toggle posts formats')

		,Field::make('checkbox', $prefix.'pf_aside', 'Aside')
		->set_option_value(1)

		,Field::make('checkbox', $prefix.'pf_gallery', 'Gallery')
		->set_option_value(1)

		,Field::make('checkbox', $prefix.'pf_link', 'Link')
		->set_option_value(1)

		,Field::make('checkbox', $prefix.'pf_image', 'Image')
		->set_option_value(1)

		,Field::make('checkbox', $prefix.'pf_quote', 'Quote')
		->set_option_value(1)

		,Field::make('checkbox', $prefix.'pf_video', 'Video')
		->set_option_value(1)

		,Field::make('checkbox', $prefix.'pf_audio', 'Audio')
		->set_option_value(1)
	));




	/*---------------------------------------------*/
	/*  PLUGINS
	/*---------------------------------------------*/
	// ->add_tab(__('Plugins'), array(
	//   Field::make('separator', 'title_plugins', 'Plugins')
		
	//   // Admin bar
	//   ,Field::make('checkbox', $prefix.'toggle_ninjaforms_metabox', 'Ninja forms')
	//   ->set_option_value(1)
	//   ->help_text('Remove ninja forms metabox')
	// ));




