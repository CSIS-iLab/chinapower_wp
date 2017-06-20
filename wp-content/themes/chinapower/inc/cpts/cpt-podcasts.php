<?php
/**
 * Custom Post Types: Podcasts
 *
 * @package chinapower
 */

/*----------  Register Custom Post Type  ----------*/
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
		'supports'              => array( 'title', 'editor', ),
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
		'capability_type'       => 'post',
	);
	register_post_type( 'podcasts', $args );

}
add_action( 'init', 'chinapower_cpt_podcasts', 0 );

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function podcast_add_meta_boxes( $post ){
	add_meta_box( 'podcast_meta_box', __( 'Podcast Information', 'chinapower' ), 'podcast_build_meta_box', 'podcasts', 'normal', 'high' );
}
add_action( 'add_meta_boxes_podcasts', 'podcast_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function podcast_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'podcast_meta_box_nonce' );

	// Retrieve current value of fields
	$current_subtitle = get_post_meta( $post->ID, '_podcast_subtitle', true );
	$current_soundcloud = get_post_meta( $post->ID, '_podcast_soundcloud', true );

	?>
	<div class='inside'>
		<h3><?php _e( 'Subtitle', 'chinapower' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="subtitle" value="<?php echo $current_subtitle; ?>" /> 
		</p>

		<h3><?php _e( 'Soundcloud URL', 'chinapower' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="soundcloud" value="<?php echo $current_soundcloud; ?>" /> 
		</p>
	</div>
	<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function podcast_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['podcast_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['podcast_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
    // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	// Store custom fields values
	// Subtitle
	if ( isset( $_REQUEST['subtitle'] ) ) {
		update_post_meta( $post_id, '_podcast_subtitle', sanitize_text_field( $_POST['subtitle'] ) );
	}
	// Soundcloud
	if ( isset( $_REQUEST['soundcloud'] ) ) {
		update_post_meta( $post_id, '_podcast_soundcloud', sanitize_text_field( $_POST['soundcloud'] ) );
	}
}
add_action( 'save_post_podcasts', 'podcast_save_meta_box_data' );
