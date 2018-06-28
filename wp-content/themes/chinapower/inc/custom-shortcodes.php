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
	// Attributes
	$atts = shortcode_atts(
		array(
			'width' => '' // Max Width of the container
		),
		$atts,
		'fullWidth'
	);

	if($atts['width']) {
		$mod_content = '<div class="fullWidthInner" style="max-width:'.$atts['width'].';">'.do_shortcode($content).'</div>';
	}
	else {
		$mod_content = do_shortcode($content);
	}

	return "<div class='fullWidthFeatureContent'>".$mod_content."</div>";
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
			'sharing' => true, // Include share component
			'title' => false, // Show title on mobile
		),
		$atts,
		'podcast'
	);

	if($atts['sharing'] === true || $atts['sharing'] == 'true') {
		$title = get_the_title($atts['id']).": ".get_post_meta($atts['id'], "_podcast_subtitle", true);
		$URL = get_the_permalink($atts['id']);
		$sharing = chinapower_social_share($title, $URL);
	}

	$titleText = null;
	if($atts['title'] === true || $atts['title'] == 'true') {
		echo 'true';
		$titleText = get_the_title($atts['id']).": ".get_post_meta($atts['id'], "_podcast_subtitle", true);
	}

	print_r($atts);

	if($atts['soundcloud']) {
		return chinapower_podcast_display_iframe($atts['soundcloud'], $titleText).$sharing;
	}
	else {
		$soundcloudID = get_post_meta( $atts['id'], '_podcast_soundcloudID', true );

		return chinapower_podcast_display_iframe($soundcloudID, $titleText).$sharing;
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

	if(!$content) {
		return false;
	}

	if($atts['sharing'] === true || $atts['sharing'] == 'true') {
		$title = str_replace(array("[stat]","[/stat]"), "", $content);
		$sharing = chinapower_social_share($title, $URL);
	}

	return chinapower_data_display_featured($atts['id'], $content, $sharing);

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
			'sharing' => true, // Include share component
			'toc' => true // Include in Table of Contents
		),
		$atts,
		'interactive'
	);

	$interactiveURL = get_post_meta( $atts['id'], '_interactive_url', true );
	$width = get_post_meta( $atts['id'], '_interactive_width', true );
	$height = get_post_meta( $atts['id'], '_interactive_height', true );
	$iframeResizeDisabled = get_post_meta( $atts['id'], '_interactive_iframeResizeDisabled', true );
	$iframe_twitter_pic_url = get_post_meta( $atts['id'], '_data_twitter_pic_url', true );

	// Fallback Image
	$fallbackImgDisabled = get_post_meta( $atts['id'], '_interactive_fallbackImgDisabled', true );

	if(!$fallbackImgDisabled) {
		$fallbackImg = get_the_post_thumbnail($atts['id'], 'full');
	}

	$title = get_the_title($atts['id']);
	$sanitizedTitle = sanitize_title($title);
	$URL = get_permalink()."#".$sanitizedTitle;

	if($atts['toc'] === true || $atts['toc'] == 'true') {
		$heading = '<h2 class="interactive-heading" id="'.$sanitizedTitle.'">'.$title.'</h2>';
	}

	if($atts['sharing'] === true || $atts['sharing'] == 'true') {
		$sharing = chinapower_social_share($title, $URL, $iframe_twitter_pic_url);
	}

	return $heading.chinapower_interactive_display_iframe($interactiveURL, $width, $height, $fallbackImg, $iframeResizeDisabled).$sharing;

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
			'external' => false, // Is this an external link
		),
		$atts,
		'view'
	);

	if($atts['external']) {
		$linkTarget = 'target="_blank" rel="nofollow"';
		$externalIcon = '<i class="icon icon-external-link"></i>';
	}

	return '<span class="dataSources-viewLink"><a href="'.$atts['url'].'" '.$linkTarget.'>View'.$externalIcon.'</a></span>';

}
add_shortcode( 'view', 'chinapower_shortcode_view' );

/**
 * Adds inline social sharing component to podcasts, stats, and interactives embedded in posts via shortcode
 * @param  string $title Title to be used by social media
 * @param  string $URL   URL to be used by social media
 * @param  string $twitter_pic_url Picture to be shared on Twitter.
 * @return string        HTML of share button
 */
function chinapower_social_share($title = "", $URL = "", $twitter_pic_url = null) {
	$shareArgs = array(
		'linkname' => $title . ' ' . $twitter_pic_url,
		'linkurl' => $URL
	);

	$output = '<div class="sharing-inline">';
	$output .= '<button class="btn btn-gray sharing-openShareBtn">Share <i class="icon icon-share"></i></button>';
	$output .= '<div class="sharing-shareBtns">';
	$output .= '<div class="post-title">'.$title.'</div>';
	ob_start();
    ADDTOANY_SHARE_SAVE_KIT($shareArgs);
    $output .= ob_get_contents();
    ob_end_clean();
    $output .= '<i class="icon icon-close-x"></i>';
    $output .= '</div>';
    $output .= '</div>';
    return $output;
}

/**
 * Shortcode to include ChinaPower symbol
 * @return String       Image HTML
 */
function chinapower_shortcode_cpp() {

	return '<img class="img-cpp" src="/wp-content/themes/chinapower/img/china-power-symbol.svg" title="ChinaPower" alt="ChinaPower" />';

}
add_shortcode( 'cpp', 'chinapower_shortcode_cpp' );

/**
 * Shortcode for displaying the "watch" link in posts
 * @param  Array $atts 	url
 * @return String       Formatted "Watch" link
 */
function chinapower_shortcode_watch( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'url' => '', // URL of Link
			'text' => 'Watch' // Text to display
		),
		$atts,
		'watch'
	);

	return '<span class="watch-interview"><a href="'.$atts['url'].'" target="_blank">'.$atts['text'].' <i class="icon icon-play"></i></a></span>';

}
add_shortcode( 'watch', 'chinapower_shortcode_watch' );

/**
 * Shortcode for displaying the "watch" link in posts
 * @param  Array $atts 	url
 * @return String       Formatted "Watch" link
 */
function chinapower_shortcode_info( $atts, $content = null ) {

	return '<div class="info-container"><i class="icon-info icon-info-circled"></i> '.do_shortcode($content).'</div>';

}
add_shortcode( 'info', 'chinapower_shortcode_info' );

/**
 * Adds styled link to specific post
 * @param  array $atts
 * @param  string $content Embedded content
 * @return string          Styled Link
 */
function chinapower_shortcode_viewpost( $atts ) {

	// Attributes
	$atts = shortcode_atts(
			array(
				'id' => null,
				'title' => 'Learn More'
			),
			$atts,
			'view-post'
		);
		$title = $atts['title'];
		$post_url = get_the_permalink($atts['id']);
		$post_title = get_the_title($atts['id']);


		return "<aside class='view-post'><a href='" . esc_url( $post_url ) . "'><span class='view-post-verb'>" . esc_attr__( $title, 'chinapower' ) . '</span><span class="view-post-title">"' . esc_attr__( $post_title, 'chinapower' ) . '"</span></a></aside>';

}
add_shortcode( 'view-post', 'chinapower_shortcode_viewpost' );
