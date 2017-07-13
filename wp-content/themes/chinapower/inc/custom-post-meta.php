<?php
/**
 * Custom Post Meta Boxes
 *
 * Add custom meta boxes to the post screen. Meta boxes are for data sources, further reading, and related content.
 *
 * @package chinapower
 */

/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function post_add_meta_boxes( $post ){
	add_meta_box( 'post_meta_box', __( 'Additional Post Information', 'chinapower' ), 'post_build_meta_box', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'post_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function post_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'post_meta_box_nonce' );

	// Retrieve current value of fields
	$current_dataSources = get_post_meta( $post->ID, '_post_dataSources', true );
	$current_furtherReading = get_post_meta( $post->ID, '_post_furtherReading', true );

	?>
	<div class='inside'>
		<h3><?php _e( 'Data Sources', 'chinapower' ); ?></h3>
		<p>
			<?php wp_editor( 
				$current_dataSources, 
				"post_dataSources", 
				array( 
					'media_buttons' => false, 
					'textarea_name' => 'dataSources', 
					'teeny' => false, 
					'tinymce' => array(
						'menubar' => false,
						'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,alignleft,aligncenter,alignright,undo,redo,link,unlink,view',
						'toolbar2' => false
					) 
				) 
			); ?>
		</p>
		<br />
		<h3><?php _e( 'Further Reading', 'chinapower' ); ?></h3>
		<p>
			<?php wp_editor( 
				$current_furtherReading, 
				"post_furtherReading", 
				array( 
					'media_buttons' => false, 
					'textarea_name' => 'furtherReading', 
					'teeny' => false, 
					'tinymce' => array(
						'menubar' => false,
						'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,alignleft,aligncenter,alignright,undo,redo,link,unlink',
						'toolbar2' => false
					) 
				) 
			); ?>
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
function post_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['post_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['post_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// Data Sources
	if ( isset( $_REQUEST['dataSources'] ) ) {
		update_post_meta( $post_id, '_post_dataSources', wp_kses_post( $_POST['dataSources'] ) );
	}
	// Further Reading
	if ( isset( $_REQUEST['furtherReading'] ) ) {
		update_post_meta( $post_id, '_post_furtherReading', wp_kses_post( $_POST['furtherReading'] ) );
	}
}
add_action( 'save_post', 'post_save_meta_box_data' );

/* @Recreate the default filters on the_content so we can pull formated content with get_post_meta
    -------------------------------------------------------------- */
add_filter( 'meta_content', 'wptexturize'        );
add_filter( 'meta_content', 'convert_smilies'    );
add_filter( 'meta_content', 'convert_chars'      );
add_filter( 'meta_content', 'wpautop'            );
add_filter( 'meta_content', 'shortcode_unautop'  );
add_filter( 'meta_content', 'prepend_attachment' );
add_filter( 'meta_content', 'do_shortcode'       );
