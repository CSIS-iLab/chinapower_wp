<?php
/**
 * Custom Post Types: Interactives
 *
 * @package chinapower
 */

/*----------  Register Custom Post Type  ----------*/
function chinapower_cpt_interactives() {

	$labels = array(
		'name'                  => _x( 'Interactives', 'Post Type General Name', 'chinapower' ),
		'singular_name'         => _x( 'Interactive', 'Post Type Singular Name', 'chinapower' ),
		'menu_name'             => __( 'Interactives', 'chinapower' ),
		'name_admin_bar'        => __( 'Interactives', 'chinapower' ),
		'archives'              => __( 'Interactive Archives', 'chinapower' ),
		'attributes'            => __( 'Interactive Attributes', 'chinapower' ),
		'parent_item_colon'     => __( 'Parent Interactive:', 'chinapower' ),
		'all_items'             => __( 'All Interactives', 'chinapower' ),
		'add_new_item'          => __( 'Add New Interactive', 'chinapower' ),
		'add_new'               => __( 'Add Interactive', 'chinapower' ),
		'new_item'              => __( 'New Interactive', 'chinapower' ),
		'edit_item'             => __( 'Edit Interactive', 'chinapower' ),
		'update_item'           => __( 'Update Interactive', 'chinapower' ),
		'view_item'             => __( 'View Interactive', 'chinapower' ),
		'view_items'            => __( 'View Interactives', 'chinapower' ),
		'search_items'          => __( 'Search Interactive', 'chinapower' ),
		'not_found'             => __( 'Not found', 'chinapower' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'chinapower' ),
		'featured_image'        => __( 'Featured Image', 'chinapower' ),
		'set_featured_image'    => __( 'Set featured image', 'chinapower' ),
		'remove_featured_image' => __( 'Remove featured image', 'chinapower' ),
		'use_featured_image'    => __( 'Use as featured image', 'chinapower' ),
		'insert_into_item'      => __( 'Insert into interactive', 'chinapower' ),
		'uploaded_to_this_item' => __( 'Uploaded to this interactive', 'chinapower' ),
		'items_list'            => __( 'Interactives list', 'chinapower' ),
		'items_list_navigation' => __( 'Interactives list navigation', 'chinapower' ),
		'filter_items_list'     => __( 'Filter interactives list', 'chinapower' ),
	);
	$args = array(
		'label'                 => __( 'Interactive', 'chinapower' ),
		'description'           => __( 'Interactives', 'chinapower' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail'),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-analytics',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'interactives', $args );

}
add_action( 'init', 'chinapower_cpt_interactives', 0 );

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function interactive_add_meta_boxes( $post ){
	add_meta_box( 'interactive_meta_box', __( 'Interactive Information', 'chinapower' ), 'interactive_build_meta_box', 'interactives', 'normal', 'high' );
}
add_action( 'add_meta_boxes_interactives', 'interactive_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function interactive_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'interactive_meta_box_nonce' );

	// Retrieve current value of fields
	$current_url = get_post_meta( $post->ID, '_interactive_url', true );
	$current_width = get_post_meta( $post->ID, '_interactive_width', true );
	$current_height = get_post_meta( $post->ID, '_interactive_height', true );

	?>
	<div class='inside'>
		<h3><?php _e( 'URL', 'chinapower' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="url" value="<?php echo $current_url; ?>" /> 
		</p>

		<h3><?php _e( 'iFrame Width', 'chinapower' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="width" value="<?php echo $current_width; ?>" /> 
		</p>

		<h3><?php _e( 'iFrame Height', 'chinapower' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="height" value="<?php echo $current_height; ?>" /> 
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
function interactive_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['interactive_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['interactive_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// URL
	if ( isset( $_REQUEST['url'] ) ) {
		update_post_meta( $post_id, '_interactive_url', sanitize_text_field( $_POST['url'] ) );
	}
	// Width
	if ( isset( $_REQUEST['width'] ) ) {
		update_post_meta( $post_id, '_interactive_width', sanitize_text_field( $_POST['width'] ) );
	}
	// Height
	if ( isset( $_REQUEST['height'] ) ) {
		update_post_meta( $post_id, '_interactive_height', sanitize_text_field( $_POST['height'] ) );
	}

}
add_action( 'save_post_interactives', 'interactive_save_meta_box_data' );

/*----------  Display iFrame  ----------*/
/**
 * Displays the embedded Soundcloud iframe
 * @param  String $soundcloudID Soundcloud ID for the interactive
 * @return String               iFrame code
 */
function chinapower_interactive_display_iframe($interactiveURL, $width, $height) {

	if(empty($width)) {
		$width = "100%";
	}

	if($height) {
		$heightValue = 'height="'.$height.'"';
	}

	return '<iframe width="'.$width.'" '.$heightValue.' scrolling="no" frameborder="no" src="'.$interactiveURL.'"></iframe>';
}

/*----------  Display Generate Shortcode Button  ----------*/
// Create Shortcode Column
function chinapower_interactives_columns( $columns ) {
    $columns["shortcode"] = "Shortcode";
    return $columns;
}
add_filter('manage_edit-interactives_columns', 'chinapower_interactives_columns');

// Populate Shortcode column
function chinapower_interactives_column( $colname, $cptid ) {
	$shortcode_html = "[interactive id=\'".$cptid."\']";

     if ( $colname == 'shortcode')
          echo '<a href="#" class="button button-small" onclick="prompt(\'Shortcode to include featured interactive in posts and pages:\', \''.$shortcode_html.'\'); return false;">Get Embed Code</a>';
}
add_action('manage_interactives_posts_custom_column', 'chinapower_interactives_column', 10, 2);
