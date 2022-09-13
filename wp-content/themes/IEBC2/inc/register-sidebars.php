<?php
// Create a function that register sidebars, using [register_sidebar][1], 
// starting from an option:

add_action('widgets_init', 'my_custom_sidebars');

function my_custom_sidebars(){
  $sidebars = get_option('my_theme_sidebars'); // get all the sidebars names
  if( !empty($sidebars) ){
    // add a sidebar for every sidebar name
    foreach ( $sidebars as $sidebar ) {
      if( empty($sidebar) ) continue;
        register_sidebar(array(
          'name' => $sidebar,
          'id' => sanitize_title($sidebar),
          'before_title' => '<div class="title-widget">',
          'after_title' => '</div>',
          'before_widget' => '<div class="widget widget-%1$s %2$s">',
          'after_widget'  => '</div>',
        ));
      }
  }
}






// UPDATED: Now you have to save an option 'my_theme_sidebars' 
// that contain an array of sidebars name. Add unlimited sidebars admin page.

add_action( 'admin_menu', 'my_sidebar_plugin_menu' );

function my_sidebar_plugin_menu(){

  add_theme_page( 'sidebar Plugin Options', 'Add Sidebar', 'manage_options', 'my-sidebar-unique-identifier', 'my_sidebar_plugin_options' );

  $nonce = filter_input(INPUT_POST, 'my_custom_sidebars_nonce', FILTER_SANITIZE_STRING);
  if( ! empty($nonce) && wp_verify_nonce($nonce, 'my_custom_sidebars') ){
    $sidebars =  (array) $_POST['custom_sidebars'];
    update_option('my_theme_sidebars', $sidebars);
    add_action('admin_notices', 'my_custom_sidebars_notice');
  }
}



function my_sidebar_plugin_options(){ ?>

  <div class="sidebars-form">
    <div class="wrap">
      <h2>Add Custom Sidebars</h2>
      
      <form id="sidebars" method="post">
        <?php 
        wp_nonce_field('my_custom_sidebars', 'my_custom_sidebars_nonce');
        $saved = get_option('my_theme_sidebars');
        $xx = get_option('my_theme_sidebars');
        // var_dump($xx);
        // $no = count($xx);
        ?>

        <div id="append">
          <?php 
          if($no > 1):
            for($i = 0; $i < $no; $i++){ ?>     
              <p class="text-box"><label for="box' + n + '">Sidebar <span class="box-number"><?php echo $i+1; ?></span></label> 
                <input type="text" name="custom_sidebars[]" value="<?php echo $xx[$i]; ?>" id="box' + n + '" /> 
                <a href="#" class="remove-box button">Remove</a>
              </p>
            <?php }

          else: ?>
            <p class="text-box">
              <label for="box1">Sidebar <span class="box-number">1</span></label>
              <input type="text" name="custom_sidebars[]" value="<?php echo $xx ? $xx[0] : ''; ?>" id="box1" />
              <a href="#" class="remove-box button">Remove</a>
            </p>
          <?php endif; ?>
        </div>
  
        <!--<a class="add-box" href="#">Add More</a>-->
        <button type="button" class="add-box button">Add New Sidebar</button>
        <!-- </table> -->
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="no_of_sidebar,sidebar_names,boxes" />

        <p class="submit">
          <input type="submit" class="button-primary clsSubmit" value="<?php _e('Save Changes') ?>" />
        </p>

      </form>
    </div>
  </div>
<?php }

function my_custom_sidebars_notice(){
  echo '<div class="updated"><p>Sidebar(s) Updated.</p></div>';
}





// Now, you have you let users select the sidebars for a 
// specific page. You can add a metabox for that. 
// (See [add_meta_box][3] docs).

add_action( 'add_meta_boxes', 'my_custom_sidebar_metabox' ); 

function my_custom_sidebar_metabox(){
  $screens = array( 'post', 'page' ); // add the metabox for pages and post
  foreach( $screens as $screen ){
    add_meta_box('my_custom_sidebar', 'Select a Sidebar','my_custom_sidebar_box', $screen, 'side');
  }
}

function my_custom_sidebar_box( $post ){
  $sidebars = get_option('my_theme_sidebars'); // get all the sidebars names 
  if( empty($sidebars) ){
    echo 'No custom sidebars registered.';
    return;
  }

  wp_nonce_field( 'my_custom_sidebar', 'my_custom_sidebar_box_nonce' );
  $value = get_post_meta( $post->ID, '_custom_sidebar', true ); // actual value
  echo '<label>Select a Sidebar</label> ';
  echo '<select name="custom_sidebar">';
  // default option
  echo '<option value=""' . selected('', $value, false) . '>Default</option>';
  // an option for every sidebar
  foreach ($sidebars as $sidebar){
    if( empty($sidebar) ) continue;
    $v = sanitize_title($sidebar);
    $n = esc_html($sidebar);
    echo '<option value="' . $v . '"' . selected($v, $value) .'>' .$n .'</option>';
  }
  echo '<select>';
}




// Then add the function to save the metabox:

add_action('save_post', 'my_custom_sidebar_metabox_save');

function my_custom_sidebar_metabox_save( $post_id ){
  // If this is an autosave, our form has not been submitted, do nothing.
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  // check nonce
  $nonce = filter_input(INPUT_POST, 'my_custom_sidebar_box_nonce', FILTER_SANITIZE_STRING);
  if( empty($nonce) || ! wp_verify_nonce( $nonce, 'my_custom_sidebar' ) ) return;
  $type = get_post_type($post_id);
  // Check the user's permissions.
  $cap = ( 'page' === $type ) ? 'edit_page' : 'edit_post';
  if( ! current_user_can( $cap, $post_id ) ) return;
  $custom = filter_input(INPUT_POST, 'custom_sidebar', FILTER_SANITIZE_STRING);
  // Update the meta field in the database.
  if( empty($custom) ){
    delete_post_meta( $post_id, '_custom_sidebar');
  }else{
    update_post_meta( $post_id, '_custom_sidebar', $custom );
  }
}












