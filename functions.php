<?php
/**
 * Add this to your functions.php file.
 */

/**
 * Enqueue custom demo script.
 */
function infscroll_scripts() {

	global $wp_query;

	wp_register_script( 'infinity-scroll', get_theme_file_uri( '/assets/js/infinity-scroll.js' ), array( 'jquery' ), '1.0', true );

	wp_localize_script( 
		'infinity-scroll', 
		'infinity_scroll_params', 
		array( 
			'max_page' => $wp_query->max_num_pages, 
			'ajax_url' => admin_url( 'admin-ajax.php') 
		)
	);

	wp_enqueue_script( 'infinity-scroll' );
}

add_action( 'wp_enqueue_scripts', 'infscroll_scripts' );


/**
 * AJAX Functions. We will use AJAX to do a WP Query here
 */
require get_parent_theme_file_path( '/ajax.php' );