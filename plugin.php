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
			'menu_icon' => 'dashicons-star-filled',
			'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
			'taxonomies' => array( '' ),
			'has_archive' => true
		)
	);
}

// This code creates the widget. It can be referenced from https://codex.wordpress.org/Widgets_API
class authentic_widget extends WP_Widget {
	
	// This sets up the Widget's ID, Name, and Description.
		public function __construct() {
			parent::__construct(
			'authentic_widget',
			__('Authentic Widget', 'authentic_widget'),
			array( 'description' => __( 'Display posts from a Custom Post Type', 'authentic_widget' ), )
			);
		}
		
	// This is the front-end display of widget.
		public function widget($args, $instance) {
			extract($args, EXTR_SKIP);
            echo $before_widget;
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            
			if (!empty($title))
			echo $before_title . $title . $after_title;?>
			<ul class="widget_list">
			<!--The Custom Post Type Query is called authentic_featured-->
			<?php
				// This code creates the loop and runs it.
					$custom_bike_posts = new WP_Query();
				//This code defines the query post type which is authentic_featured. 
					$custom_bike_posts->query('post_type=authentic_featured');
				//This code will check to see if the query has posts.
					while ($custom_bike_posts->have_posts()) : $custom_bike_posts->the_post();?>
					<li>
					<!--This shows the title of the post-->
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php 
				//This code will check if there is featured image.
					if ( has_post_thumbnail() ) {the_post_thumbnail();}?>
                    </li>
					<?php endwhile; ?>
				</ul>
				<?php
			echo $after_widget;
		}
			//This is the back-end widget form.
		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
			?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php 
		}
		
	//This code sanitizes widget form values as they are saved.
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
}

/*
This registers the widget.
*/

function register_authentic_widget() {
	register_widget( 'authentic_widget' );
}
add_action( 'widgets_init', 'register_authentic_widget' );