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
?>