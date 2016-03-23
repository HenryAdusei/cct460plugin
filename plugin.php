<?php
/* 
* Plugin Name: Authentic Plugin 
* Plugin URI: http://www.phoenix.sheridanc.on.ca/~ccit3395
* Description: Custom Post Type, Widget, and Shortcode
* Author: Henry Adusei, Nabeel Jamal, Nabeel Shaikh
* Author URI: http://www.phoenix.sheridanc.on.ca/~ccit3395
* Version: 1.0 
*/
 
//This code will enqueue the stylesheet.
function enqueue_authentic_stylesheet() {
	wp_register_style( 'stylesheet', plugins_url( 'style.css', __FILE__ ) );
	wp_enqueue_style( 'stylesheet' ); 
}
add_action( 'wp_enqueue_scripts', 'enqueue_authentic_stylesheet' );

/* This code adds a custom post type. It can be referenced from: http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-creation-display-and-meta-boxes--wp-27645
*/
add_action( 'init', 'create_post_type' );

function create_post_type() {
	register_post_type( 'authentic_featured',
		array(
			'labels' => array(
				'name' => 'Featured Bikes',
				'singular_name' => 'Featured Bike', 
				'add_new' => 'Add New', 
				'add_new_item' => 'Add New Featured Bike',
				'edit' => 'Edit',
				'edit_item' => 'Edit Featured Bike',
				'new_item' => 'New Featured Bike',
				'view' => 'View',
				'view_item' => 'View Featured Bike',
				'search_items' => 'Search Featured Bikes',
				'not_found' => 'No Featured Bike found',
				'not_found_in_trash' => 'No Featured Bike found in Trash',
				'parent' => 'Parent Featured Bike'
			),
 
			'public' => true,
			'menu_position' => 15,
			'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
			'taxonomies' => array( '' ),
			'has_archive' => true
		)
	);
}

?>