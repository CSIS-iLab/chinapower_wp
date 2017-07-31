<?php
/**
 * Single: Interactive
 *
 * @package chinapower
 */

$ID = get_the_id();

$url = get_post_meta( $ID, '_interactive_url', true );
$width = get_post_meta( $ID, '_interactive_width', true );
$height = get_post_meta( $ID, '_interactive_height', true );
$iframeResizeDisabled = get_post_meta( $ID, '_interactive_iframeResizeDisabled', true );
$fallbackImgDisabled = get_post_meta( $ID, '_interactive_fallbackImgDisabled', true );


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper" role="main">

		<div class="fullWidthFeatureContent">
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo chinapower_interactive_display_iframe($url, $width, $height, $fallbackImg, $iframeResizeDisabled);
		?>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
