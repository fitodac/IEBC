<?php
// CARBON FIELDS
if( !function_exists('carbon_get_post_meta') ){
  require_once __DIR__ . '/libs/carbon-fields/carbon-fields-plugin.php';
}

if( !function_exists('smpx_carbon_fields')){ 
  function smpx_carbon_fields(){
    // CUSTOM FIELDS
    include_once __DIR__ . '/metaboxes.php';

    // THEME OPTIONS
    require_once __DIR__ . '/theme-options.php';
  }
  add_action('carbon_register_fields', 'smpx_carbon_fields');
}


// THEME SETUP
require_once __DIR__ . '/setup.php';

// EXTRAS
require_once __DIR__ . '/extras.php';

// MENU
require(__DIR__ . '/menu.php');

// CUSTOM POST TYPES
require_once __DIR__ . '/post-types.php';

// PAGINATION
require(__DIR__ . '/pagination.php');

// REGISTER SIDEBARS
require(__DIR__ . '/register-sidebars.php');

// WIDGETS
require(__DIR__ . '/widgets.php');

// TINYMCE
require(__DIR__ . '/tinymce.php');













