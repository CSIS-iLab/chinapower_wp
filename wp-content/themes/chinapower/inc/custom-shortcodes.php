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
			'sharing' => true // Include share component
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
			'sharing' => true, // Include share component
			'stat' => 1, // # of Featured Stat to Share
		),
		$atts,
		'dataFeatured'
	);

	$content = get_post_meta( $atts['id'], '_data_stat'.$atts['stat'], true);

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

	return "<span class='data-featuredStatNumber'>".$content."</span>";

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
			'height' => '', // Height of Interactive,
			'sharing' => true // Include share component
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
		$externalIcon = '<i class="icon icon-external-link"></i>';
	}

	return '<span class="dataSources-viewLink"><a href="'.$atts['url'].'" '.$linkTarget.'>View'.$externalIcon.'</a></span>';

}
add_shortcode( 'view', 'chinapower_shortcode_view' );

/*----------  Add sharing component to shortcodes  ----------*/
add_filter( 'do_shortcode_tag','chinapower_add_sharing_component',10,3);
function chinapower_add_sharing_component($output, $tag, $attr ){

	// Only Use for Specific Shortcodes
	$acceptedTags = array('interactive', 'podcast', 'dataFeatured');
	if(!in_array($tag, $acceptedTags)){ 
    	return $output;
  	}

  	// Only if sharing attribute is true
	if(isset($attr['sharing']) && $attr['sharing'] != 'true') {
		return $output;
	}

	if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
		$output .= '<div class="sharing-inline">';
		$output .= '<button class="btn btn-gray sharing-openShareBtn">Share <i class="icon icon-share"></i></button>';
		$output .= '<div class="sharing-shareBtns">';
		ob_start();
	    ADDTOANY_SHARE_SAVE_KIT();
	    $output .= ob_get_contents();
	    ob_end_clean();
	    $output .= '</div>';
	    $output .= '</div>';
	    return $output;
	}
}

/**
 * Shortcode to include ChinaPower symbol
 * @return String       Image HTML
 */
function chinapower_shortcode_cpp() {

	return '<img class="img-cpp" src="/wp-content/themes/chinapower/img/china-power-symbol.svg" title="ChinaPower" alt="ChinaPower" />';

}
add_shortcode( 'cpp', 'chinapower_shortcode_cpp' );
