<?php
/**
 * Custom Post Types: Podcasts
 *
 * @package chinapower
 */

// Register Custom Post Type
function chinapower_cpt_podcasts() {

	$labels = array(
		'name'                  => _x( 'Podcasts', 'Post Type General Name', 'chinapower' ),
		'singular_name'         => _x( 'Podcast', 'Post Type Singular Name', 'chinapower' ),
		'menu_name'             => __( 'Podcasts', 'chinapower' ),
		'name_admin_bar'        => __( 'Podcasts', 'chinapower' ),
		'archives'              => __( 'Podcast Archives', 'chinapower' ),
		'attributes'            => __( 'Podcast Attributes', 'chinapower' ),
		'parent_item_colon'     => __( 'Parent Podcast:', 'chinapower' ),
		'all_items'             => __( 'All Podcasts', 'chinapower' ),
		'add_new_item'          => __( 'Add New Podcast', 'chinapower' ),
		'add_new'               => __( 'Add Podcast', 'chinapower' ),
		'new_item'              => __( 'New Podcast', 'chinapower' ),
		'edit_item'             => __( 'Edit Podcast', 'chinapower' ),
		'update_item'           => __( 'Update Podcast', 'chinapower' ),
		'view_item'             => __( 'View Podcast', 'chinapower' ),
		'view_items'            => __( 'View Podcasts', 'chinapower' ),
		'search_items'          => __( 'Search Podcast', 'chinapower' ),
		'not_found'             => __( 'Not found', 'chinapower' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'chinapower' ),
		'featured_image'        => __( 'Featured Image', 'chinapower' ),
		'set_featured_image'    => __( 'Set featured image', 'chinapower' ),
		'remove_featured_image' => __( 'Remove featured image', 'chinapower' ),
		'use_featured_image'    => __( 'Use as featured image', 'chinapower' ),
		'insert_into_item'      => __( 'Insert into podcast', 'chinapower' ),
		'uploaded_to_this_item' => __( 'Uploaded to this podcast', 'chinapower' ),
		'items_list'            => __( 'Podcasts list', 'chinapower' ),
		'items_list_navigation' => __( 'Podcasts list navigation', 'chinapower' ),
		'filter_items_list'     => __( 'Filter podcasts list', 'chinapower' ),
	);
	$args = array(
		'label'                 => __( 'Podcast', 'chinapower' ),
		'description'           => __( 'Podcasts', 'chinapower' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'custom-fields', 'page-attributes', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-audio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'podcasts', $args );

}
add_action( 'init', 'chinapower_cpt_podcasts', 0 );