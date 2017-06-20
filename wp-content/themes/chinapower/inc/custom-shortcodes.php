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
 * Shortcode for displaying embedded podcast
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

/**
 * Shortcode for displaying featured statistic from data repo
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Embedded featured statistic
 */
// Add Shortcode
function chinapower_shortcode_data_featured( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '', // ID of Podcast post
		),
		$atts,
		'dataFeatured'
	);

	$post_content = get_post($atts['id']);
	$content = $post_content->post_content;

	return chinapower_data_display_featured($atts['id'], $content);

}
add_shortcode( 'dataFeatured', 'chinapower_shortcode_data_featured' );

/**
 * Shortcode for displaying featured statistic from data repo
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Embedded featured statistic
 */
// Add Shortcode
function chinapower_shortcode_data_featured_number( $atts, $content = null ) {

	return "<div class='data-featuredStatNumber'>".$content."</div>";

}
add_shortcode( 'stat', 'chinapower_shortcode_data_featured_number' );