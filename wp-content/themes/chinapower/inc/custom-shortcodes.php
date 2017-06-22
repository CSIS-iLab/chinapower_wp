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
	return "<div class='fullWidthFeatureContent'>".do_shortcode($content)."</div>";
}
add_shortcode( 'fullWidth', 'shortcode_fullWidth' );

/**
 * Shortcode for displaying embedded podcast
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Embedded podcast
 */
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
function chinapower_shortcode_data_featured_number( $atts, $content = null ) {

	return "<div class='data-featuredStatNumber'>".$content."</div>";

}
add_shortcode( 'stat', 'chinapower_shortcode_data_featured_number' );

/**
 * Shortcode for displaying embedded interactive
 * @param  array $atts    Modifying arguments
 * @return string          Embedded interactive
 */
function chinapower_shortcode_interactive( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '', // ID of Interactive Post
			'width' => '', // Width of Interactive
			'height' => '', // Height of Interactive
		),
		$atts,
		'interactive'
	);

	$interactiveURL = get_post_meta( $atts['id'], '_interactive_url', true );
	$width = get_post_meta( $atts['id'], '_interactive_width', true );
	$height = get_post_meta( $atts['id'], '_interactive_height', true );
	$iframeResizeDisabled = get_post_meta( $atts['id'], '_interactive_iframeResizeDisabled', true );

	// Fallback Image
	$fallbackImgDisabled = get_post_meta( $atts['id'], '_interactive_fallbackImgDisabled', true );

	if(!$fallbackImgDisabled) {
		$fallbackImg = get_the_post_thumbnail($atts['id'], 'full');
	}

	return chinapower_interactive_display_iframe($interactiveURL, $width, $height, $fallbackImg, $iframeResizeDisabled);

}
add_shortcode( 'interactive', 'chinapower_shortcode_interactive' );


/**
 * Shortcode for displaying the "view" link in the Data Sources section of the post with the option to indicate if it is an external link or not
 * @param  Array $atts url, external
 * @return String       Formatted "View" link
 */
function chinapower_shortcode_view( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'url' => '', // URL of Link
			'external' => '', // Is this an external link
		),
		$atts,
		'view'
	);

	if($atts['external']) {
		$linkTarget = 'target="_blank"';
		$externalIcon = ' <span class="dashicons dashicons-external"></span>';
	}

	return '<span class="dataSources-viewLink"><a href="'.$atts['url'].'" '.$linkTarget.'>View'.$externalIcon.'</a></span>';

}
add_shortcode( 'view', 'chinapower_shortcode_view' );