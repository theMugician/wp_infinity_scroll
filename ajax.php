<?php

add_action( 'wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback' );
add_action( 'wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback' );

function load_posts_by_ajax_callback() {
  $paged = $_POST['page'];

  $args = array(
    'post_type'       => 'post',
    'paged'           => $paged,
    'posts_per_page'  => '3'
  );

  $query = new WP_Query( $args );

  // Check that we have query results.
  if ( $query->have_posts() ) {
   
    // Start looping over the query results.
    while ( $query->have_posts() ) {
 
      $query->the_post();

      get_template_part( 'template-parts/post/content', get_post_format() );

    } // end while
  } // end if
  wp_reset_postdata();
  exit();
}
