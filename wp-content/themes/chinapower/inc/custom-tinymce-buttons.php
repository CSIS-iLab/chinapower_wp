<?php
/**
 * Custom buttons for TinyMCE
 *
 * @package chinapower
 */

add_action( 'after_setup_theme', 'chinapower_theme_setup' );

if ( ! function_exists( 'chinapower_theme_setup' ) ) {
    function chinapower_theme_setup() {

        add_action( 'init', 'chinapower_buttons' );

    }
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'chinapower_buttons' ) ) {
    function chinapower_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }

        add_filter( 'mce_external_plugins', 'chinapower_add_buttons' );
        add_filter( 'mce_buttons_3', 'chinapower_register_buttons' );
    }
}

if ( ! function_exists( 'chinapower_add_buttons' ) ) {
    function chinapower_add_buttons( $plugin_array ) {
        $plugin_array['chinapower'] = get_template_directory_uri().'/js/tinymce.js';
        return $plugin_array;
    }
}

if ( ! function_exists( 'chinapower_register_buttons' ) ) {
    function chinapower_register_buttons( $buttons ) {
        array_push( $buttons, 'podcasts', 'stats', 'view', 'cpp', 'note', 'fullWidth', 'view-post' );
        return $buttons;
    }
}

add_action ( 'after_wp_tiny_mce', 'chinapower_tinymce_extra_vars' );

if ( !function_exists( 'chinapower_tinymce_extra_vars' ) ) {
	function chinapower_tinymce_extra_vars() {

		// Get list of Podcasts
		$args = array(
			'posts_per_page' => -1,
			'post_type' => array('podcasts', 'post'),
			'orderby' => 'title',
			'order' => 'asc'
		);
		$posts = get_posts( $args );
		$podcastList = "";
		$postList = "";
		foreach($posts as $post) {
			$format = "{text: '" .  esc_html($post->post_title) . "', value: '" . $post->ID . "'},";
			if ( $post->post_type == 'podcasts' ) {
				$podcastList .= $format;
			} elseif ( $post->post_type == 'post' ) {
				$postList .= $format;
			}
		}
		$podcastList = "[".$podcastList."]";
		$postList = "[".$postList."]";

		?>
		<style>i.mce-i-icon {
		font: normal 20px/1 'dashicons';
		padding: 0;
		vertical-align: top;
		speak: none;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		margin-left: -2px;
		padding-right: 2px;
		}</style>
		<script type="text/javascript">
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_name' => esc_html__('ToC', 'chinapower'),
					'button_title' => esc_html__('Table of Contents', 'chinapower')
				)
				);
			?>;
			var tinyMCE_podcasts = <?php echo $podcastList; ?>;
			var tinyMCE_posts = <?php echo $postList; ?>;
		</script><?php
	}
}
