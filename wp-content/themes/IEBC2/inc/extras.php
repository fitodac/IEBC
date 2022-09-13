<?php
/**
 * Add <body> classes
 */
function smpx_body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  return $classes;
}

add_filter('body_class', 'smpx_body_class');




/**
 * Clean up the_excerpt()
 */
function smpx_excerpt_more(){
  $more = ' &hellip;</p>';
  $more .= '<a class="link-rm" href="'. get_permalink() .'">'. __('Read more', 'smpx') .'</a>';
  return $more;
}

add_filter('excerpt_more', 'smpx_excerpt_more');







/*---------------------------------------------------*/
/*  ENTRY META
/*  Display information for posts (author, date, categories, etc)
/*---------------------------------------------------*/
if( !function_exists('smpx_entry_meta') ):

function smpx_entry_meta(
  $author = true, // Show the author name and link to author page
  $published = true, // Show the date of publication
  $updated = true, // Show the date for updated post 
  $postformat = true, // Show post format
  $categories = true, // Show the categories list
  $tags = true, // Show the tags list
  $comments = true // Display a comments counter
){

  // Get author info
  if( $author && 'post' === get_post_type() ):
    $author_avatar_size = apply_filters( 'smpx_author_avatar_size', 30 );

    $author = '<span class="author vcard">';
    $author .= '%1$s';
    $author .= '<span class="sr-only">%2$s </span>';
    $author .= '<span>by </span>';
    $author .= '<a href="%3$s">%4$s</a>';
    $author .= '</span>';

    printf (
      $author,
      get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
      _x( 'Author', 'Used before post author name.', 'smpx' ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      get_the_author()
    );
  endif;



  // Get date info
  if( ($published || $updated) && in_array( get_post_type(), array( 'post', 'attachment' ) ) ){
    smpx_entry_date($published, $updated);
  }


  // Get post formats
  $format = get_post_format();
  if( $postformat && current_theme_supports( 'post-formats', $format ) ){
    echo '<div class="post-format">'
      .'<a href="'.esc_url( get_post_format_link( $format ) ).'">'.get_post_format_string( $format ).'</a>'
    .'</div>';
  }


  // Get categories
  if( $categories && 'post' === get_post_type() ){
    smpx_entry_categories();
  }

  // Get tags
  if( $tags && 'post' === get_post_type() ){
    smpx_entry_tags();
  }



  if( $comments && !is_singular() && !post_password_required() && ( comments_open() || get_comments_number() ) ){
    echo '<div class="comments-link">'
      .'<span class="ion-ios-chatbubble-outline"></span> ';
      comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'smpx' ), get_the_title() ) );
    echo '</div>';
  }
}
endif;






/*---------------------------------------------------*/
/*  ENTRY DATE
/*  Display the post date
/*---------------------------------------------------*/
if( !function_exists( 'smpx_entry_date' ) ):

function smpx_entry_date($published = true, $updated = true){
  
  $date = '<div class="post-date">';
  $date .= '<span class="ion-ios-calendar-outline"></span> ';
  
    if($published){
      $date .= '<time class="posted-on">'
        .__('Posted on','smpx') .' '. get_the_date()
      .'</time>';  
    }

    if($updated && get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ){
      $date .= ' / <time class="updated-on">'
        .__('Updated on','smpx') .' '.get_the_modified_date()
      .'</time>';
    }

  $date .= '</div>';

  printf($date);
}
endif;






/*---------------------------------------------------*/
/*  GET CATEGORIES
/*  Display all categories for the current post
/*---------------------------------------------------*/
if( !function_exists('smpx_entry_categories') ):

function smpx_entry_categories(){

  $categories_list = get_the_category_list(' / ');

  if( $categories_list && smpx_categorized_blog() ){
    echo '<div class="categories">'
      .'<span class="ion-ios-list-outline"></span> '
      .$categories_list
    .'</div>';
  }

}
endif;



function smpx_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'smpx_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'smpx_categories', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so smpx_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so smpx_categorized_blog should return false.
    return false;
  }
}





/*---------------------------------------------------*/
/*  GET TAGS
/*  Display all categories for the current post
/*---------------------------------------------------*/
if( !function_exists('smpx_entry_tags') ):
function smpx_entry_tags(){

  $tags_list = get_the_tag_list('', ', ');

  if( $tags_list ){
    echo '<div class="tags">'
      .'<span class="ion-ios-pricetags-outline"></span> '
      .$tags_list
    .'</div>';
  }

}
endif;







/*---------------------------------------------------*/
/*  POST NAVIGATION
/*  Navigation for post
/*---------------------------------------------------*/
if( !function_exists('smpx_post_navigation') ):
function smpx_post_navigation(){

	$prevPost = get_previous_post(true);
	$nextPost = get_next_post(true); ?>
	<div class="row">

		<?php 
		if($prevPost){
			$args = array(
				'posts_per_page' => 1,
				'include' => $prevPost->ID
			);
			$prevPost = get_posts($args);
			foreach( $prevPost as $post ){
				setup_postdata($post); 
				$id = $post->ID; 
				?>
				<div class="col-sm-6">
					<div class="post-previous">
						<?php if( get_the_post_thumbnail($id) ): ?>
							<a href="<?php the_permalink($id); ?>">
								<?= get_the_post_thumbnail($id, 'thumbnail'); ?>
							</a>
						<?php endif; ?>
						<h4><a href="<?php the_permalink($id); ?>"><?= get_the_title($id); ?></a></h4>
						<?php $content = get_the_content($id); ?>
						<p><?= wp_trim_words( $content , '28' ); ?></p>
					</div><!-- post-previous end -->
				</div><!-- col end -->
				<?php wp_reset_postdata();
			} //end foreach
		} // end if



		if($nextPost){
			$args = array(
				'posts_per_page' => 1,
				'include' => $nextPost->ID
			);
			$nextPost = get_posts($args);
			foreach( $nextPost as $post ){
				setup_postdata($post); 
				$id = $post->ID; ?>
				<div class="col-sm-6">
					<div class="post-next">
						<?php if( get_the_post_thumbnail($id) ): ?>
							<a href="<?php the_permalink($id); ?>">
								<?= get_the_post_thumbnail($id, 'thumbnail'); ?>
							</a>
						<?php endif; ?>
						<h4><a href="<?php the_permalink($id); ?>"><?= get_the_title($id); ?></a></h4>
						<?php $content = get_the_content($id); ?>
						<p><?= wp_trim_words( $content , '28' ); ?></p>
					</div><!-- post-next end -->
				</div><!-- col end -->
				<?php wp_reset_postdata();
			} //end foreach
		} // end if ?>

	</div><!-- row end -->

<?php }
endif;















