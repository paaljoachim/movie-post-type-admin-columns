<?php


/**
 *	Register Movie Type
 *
 *	@author Ren Ventura <EngageWP.com> - with some adjustments by Paal Joachim
 * 	@link http://www.engagewp.com/nested-loops-custom-wordpress-queries
 */

add_action( 'init', 'rv_movie_cpt' );
function rv_movie_cpt() {

	$labels = array(
		'name'               => _x( 'Movie', 'post type general name', 'engwp' ),
		'singular_name'      => _x( 'Movie', 'post type singular name', 'engwp' ),
		'menu_name'          => _x( 'Movies', 'admin menu', 'engwp' ),
		'name_admin_bar'     => _x( 'Movie', 'add new on admin bar', 'engwp' ),
		'add_new'            => _x( 'Add New', 'Movie', 'engwp' ),
		'add_new_item'       => __( 'Add New Movie', 'engwp' ),
		'new_item'           => __( 'New Movie', 'engwp' ),
		'edit_item'          => __( 'Edit Movie', 'engwp' ),
		'view_item'          => __( 'View Movie', 'engwp' ),
		'all_items'          => __( 'All Movies', 'engwp' ),
		'search_items'       => __( 'Search Movies', 'engwp' ),
		'parent_item_colon'  => __( 'Parent Movie:', 'engwp' ),
		'not_found'          => __( 'No Movies found.', 'engwp' ),
		'not_found_in_trash' => __( 'No Movies found in Trash.', 'engwp' )
	);

	$args = array(
		'description'	     => __( 'Movie', 'engwp' ),
		'labels'	      		 => $labels,
		'supports'	     	 => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions' ), // comments was removed to disable comments.
		'hierarchical'	    => false,
		'public'	      		=> true,
		'publicly_queryable'	=> true,
		'query_var'	      	=> true,
		'rewrite'	      	=> array( 'slug' => 'filmer' ), /* changed from movies to filmer */
		'show_ui'	      	=> true,
		'menu_icon'	      	=> 'dashicons-format-video',
		'show_in_menu'	     => true,
		'show_in_nav_menus'	=> true,
		'show_in_admin_bar'	=> true,
		// 'menu_position'	=> 5,
		'can_export'		=> true,
		'has_archive'		=> true,
		'exclude_from_search'	=> false,
		'capability_type'	=> 'post',
	);

	register_post_type( 'movie', $args );

}

add_action( 'init', 'year_movie_taxonomies' );
function year_movie_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'                       => _x( 'Year Screened', 'taxonomy general name' ),
		'singular_name'              => _x( 'Year', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Years' ),
		'all_items'                  => __( 'All Years' ),
		'parent_item'                => __( 'Parent Year' ),
		'parent_item_colon'          => __( 'Parent Year:' ),
		'edit_item'                  => __( 'Edit Year' ),
		'update_item'                => __( 'Update Year' ),
		'add_new_item'               => __( 'Add New Year' ),
		'new_item_name'              => __( 'New Year Name' ),
		'separate_items_with_commas' => __( 'Separate Years with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Years' ),
		'choose_from_most_used'      => __( 'Choose from the most used Years' ),
		'not_found'                  => __( 'No Years found.' ),
		'menu_name'                  => __( 'Year Screened' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		// 'query_var'          => true,
		// 'show_in_nav_menus'	=> false,
		'public'		=> true,
		'publicly_queryable'	=> true,
		'has_archive'		=> true,
	);

	$years = array( 'rewrite' => array( 'slug' => 'movie-year' ) );
	$movie_args = array_merge( $args, $years );
	register_taxonomy( 'movie-years', 'movie', $movie_args );

}


add_action( 'init', 'type_movie_taxonomies' );
function type_movie_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'                       => _x( 'Movie Category', 'taxonomy general name' ),
		'singular_name'              => _x( 'Movie Category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Movie Category' ),
		'all_items'                  => __( 'All Movie Categories' ),
		'parent_item'                => __( 'Parent Category' ),
		'parent_item_colon'          => __( 'Parent Category:' ),
		'edit_item'                  => __( 'Edit Movie Category' ),
		'update_item'                => __( 'Update Movie Category' ),
		'add_new_item'               => __( 'Add Movie Category' ),
		'new_item_name'              => __( 'New Movie Category' ),
		'separate_items_with_commas' => __( 'Separate Movie Categories with commas2' ),
		'add_or_remove_items'        => __( 'Add or remove Movie Categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used Movie Categories' ),
		'not_found'                  => __( 'No Movie Categories found.' ),
		'menu_name'                  => __( 'Movie Category' ),
	);

	$args = array(
		'hierarchical'          => true, // true = cateogry - false = tags
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		// 'query_var'          => true,
		// 'show_in_nav_menus'	=> false,
		'public'		=> true,
		'publicly_queryable'	=> true,
		'has_archive'		=> true,
	);

	$moviecategory = array( 'rewrite' => array( 'slug' => 'movie-type' ) );
	$moviecategory_args = array_merge( $args, $moviecategory );
	register_taxonomy( 'movie-type', 'movie', $moviecategory_args );

}
