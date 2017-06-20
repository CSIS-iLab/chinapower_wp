<?php
/**
 * Custom shortcodes for the theme
 *
 * @package chinapower
 */

/**
 * Shortcode for displaying enclosed content at the full width of the browser
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function shortcode_fullWidth( $atts , $content = null ) {
	return "<div class='fullWidthFeatureContent'>".$content."</div>";
}
add_shortcode( 'fullWidth', 'shortcode_fullWidth' );

/**
 * Shortcode for displayed embedded podcast
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Embedded podcast
 */
// Add Shortcode
function chinapower_shortcode_podcast( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '', // ID of Podcast post
			'soundcloud' => '', // ID of Soundcloud track
		),
		$atts,
		'podcast'
	);

	if($atts['soundcloud']) {
		return chinapower_podcast_display_iframe($atts['soundcloud']);
	}
	else {
		$soundcloudID = get_post_meta( $atts['id'], '_podcast_soundcloudID', true );

		return chinapower_podcast_display_iframe($soundcloudID);
	}

}
add_shortcode( 'podcast', 'chinapower_shortcode_podcast' );