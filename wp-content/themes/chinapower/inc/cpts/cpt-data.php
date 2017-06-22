<?php
/**
 * Custom Post Types: Data
 *
 * @package chinapower
 */

/*----------  Register Custom Post Type  ----------*/
function chinapower_cpt_data() {

	$labels = array(
		'name'                  => _x( 'Data', 'Post Type General Name', 'chinapower' ),
		'singular_name'         => _x( 'Data', 'Post Type Singular Name', 'chinapower' ),
		'menu_name'             => __( 'Data Repo', 'chinapower' ),
		'name_admin_bar'        => __( 'Data Repo', 'chinapower' ),
		'archives'              => __( 'Data Archives', 'chinapower' ),
		'attributes'            => __( 'Data Attributes', 'chinapower' ),
		'parent_item_colon'     => __( 'Parent Data:', 'chinapower' ),
		'all_items'             => __( 'All Data', 'chinapower' ),
		'add_new_item'          => __( 'Add New Data', 'chinapower' ),
		'add_new'               => __( 'Add Data', 'chinapower' ),
		'new_item'              => __( 'New Data', 'chinapower' ),
		'edit_item'             => __( 'Edit Data', 'chinapower' ),
		'update_item'           => __( 'Update Data', 'chinapower' ),
		'view_item'             => __( 'View Data', 'chinapower' ),
		'view_items'            => __( 'View Data', 'chinapower' ),
		'search_items'          => __( 'Search Data', 'chinapower' ),
		'not_found'             => __( 'Not found', 'chinapower' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'chinapower' ),
		'featured_image'        => __( 'Featured Image', 'chinapower' ),
		'set_featured_image'    => __( 'Set featured image', 'chinapower' ),
		'remove_featured_image' => __( 'Remove featured image', 'chinapower' ),
		'use_featured_image'    => __( 'Use as featured image', 'chinapower' ),
		'insert_into_item'      => __( 'Insert into data', 'chinapower' ),
		'uploaded_to_this_item' => __( 'Uploaded to this data', 'chinapower' ),
		'items_list'            => __( 'Data list', 'chinapower' ),
		'items_list_navigation' => __( 'Data list navigation', 'chinapower' ),
		'filter_items_list'     => __( 'Filter data list', 'chinapower' ),
	);
	$args = array(
		'label'                 => __( 'Data', 'chinapower' ),
		'description'           => __( 'Data', 'chinapower' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', ),
		'taxonomies'            => array( 'category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-chart-area',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'data', $args );

}
add_action( 'init', 'chinapower_cpt_data', 0 );

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function data_add_meta_boxes( $post ){
	add_meta_box( 'data_meta_box', __( 'Data Information', 'chinapower' ), 'data_build_meta_box', 'data', 'normal', 'high' );
}
add_action( 'add_meta_boxes_data', 'data_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function data_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'data_meta_box_nonce' );

	// Retrieve current value of fields
	$current_viewURL = get_post_meta( $post->ID, '_data_viewURL', true );
	$current_downloadURL = get_post_meta( $post->ID, '_data_downloadURL', true );
	$current_viewIsPDF = get_post_meta( $post->ID, '_data_viewIsPDF', true );

	?>
	<div class='inside'>
		<h3><?php _e( 'View URL', 'chinapower' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="viewURL" value="<?php echo $current_viewURL; ?>" /> 
		</p>
		<p>
			<input type="checkbox" name="viewIsPDF" value="1" <?php checked( $current_viewIsPDF, '1' ); ?> /> Link is a PDF?
		</p>

		<h3><?php _e( 'Download URL', 'chinapower' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="downloadURL" value="<?php echo $current_downloadURL; ?>" /> 
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
function data_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['data_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['data_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// View URL
	if ( isset( $_REQUEST['viewURL'] ) ) {
		update_post_meta( $post_id, '_data_viewURL', sanitize_text_field( $_POST['viewURL'] ) );
	}
	// Download URL
	if ( isset( $_REQUEST['downloadURL'] ) ) {
		update_post_meta( $post_id, '_data_downloadURL', sanitize_text_field( $_POST['downloadURL'] ) );
	}
	// View URL is a PDF
	if ( isset( $_REQUEST['viewIsPDF'] ) ) {
		update_post_meta( $post_id, '_data_viewIsPDF', sanitize_text_field( $_POST['viewIsPDF'] ) );
	}
	else {
		update_post_meta( $post_id, '_data_viewIsPDF', '' );
	}
}
add_action( 'save_post_data', 'data_save_meta_box_data' );

/*----------  Custom Taxonomy: datasources  ----------*/
// Register Custom Taxonomy
function chinapower_datasources() {

	$labels = array(
		'name'                       => _x( 'Data Sources', 'Taxonomy General Name', 'chinapower' ),
		'singular_name'              => _x( 'Data Source', 'Taxonomy Singular Name', 'chinapower' ),
		'menu_name'                  => __( 'Sources', 'chinapower' ),
		'all_items'                  => __( 'All Sources', 'chinapower' ),
		'parent_item'                => __( 'Parent Source', 'chinapower' ),
		'parent_item_colon'          => __( 'Parent Source:', 'chinapower' ),
		'new_item_name'              => __( 'New Source Name', 'chinapower' ),
		'add_new_item'               => __( 'Add New Source', 'chinapower' ),
		'edit_item'                  => __( 'Edit Source', 'chinapower' ),
		'update_item'                => __( 'Update Source', 'chinapower' ),
		'view_item'                  => __( 'View Source', 'chinapower' ),
		'separate_items_with_commas' => __( 'Separate sources with commas', 'chinapower' ),
		'add_or_remove_items'        => __( 'Add or remove sources', 'chinapower' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'chinapower' ),
		'popular_items'              => __( 'Popular sources', 'chinapower' ),
		'search_items'               => __( 'Search Sources', 'chinapower' ),
		'not_found'                  => __( 'Not Found', 'chinapower' ),
		'no_terms'                   => __( 'No sources', 'chinapower' ),
		'items_list'                 => __( 'Sources list', 'chinapower' ),
		'items_list_navigation'      => __( 'Sources list navigation', 'chinapower' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'datasources', array( 'data' ), $args );

}
add_action( 'init', 'chinapower_datasources', 0 );

/*----------  Display Featured Statistic  ----------*/
/**
 * Displays featured statistic from data repo
 * @param  Number $ID 			Post ID
 * @param  String $content 		Featured statistic
 * @return String               HTML of featured statistic
 */
function chinapower_data_display_featured($ID, $content) {

	return '<div class="data-featuredStatBlock">'. do_shortcode($content).' Link to: '.$ID.'</div>';
}

/*----------  Display Generate Shortcode Button  ----------*/
// Create Shortcode Column
function chinapower_data_columns( $columns ) {
    $columns["shortcode"] = "Shortcode";
    return $columns;
}
add_filter('manage_edit-data_columns', 'chinapower_data_columns');

// Populate Shortcode column
function chinapower_data_column( $colname, $cptid ) {
	$shortcode_html = "[dataFeatured id=\'".$cptid."\']";

     if ( $colname == 'shortcode')
          echo '<a href="#" class="button button-small" onclick="prompt(\'Shortcode to include featured statistic in posts and pages:\', \''.$shortcode_html.'\'); return false;">Get Embed Code</a>';
}
add_action('manage_data_posts_custom_column', 'chinapower_data_column', 10, 2);
