<?php
/**
 * Template: Single Podcasts
 */

get_header();

$postID = get_the_ID();

// Post Thumbnail
if (has_post_thumbnail()) :
	$featured_img_url = get_the_post_thumbnail_url();
endif;

// Soundcloud ID
$soundcloudID = get_post_meta($postID, '_podcast_soundcloudID', true);
$megaphoneIFrame = get_post_meta($postID, '_podcast_megaphoneIFrame', true);

// Related Content
global $related;
$rel = $related->show( $postID, true );

// Width of Further Reading & Related Content
if(is_array($rel) && count($rel) > 0) {
	$podcastDescWidth = "8";
	$relatedContentWidth = "4";
	$relatedContentHeader = '<h6 class="relatedContent-heading">Related Content</h6>';
}
else {
	$podcastDescWidth = "12";
}

// Podcast Description
$podcastDesc = get_option("chinapower_podcast_desc_long");
$itunesURL = get_option("chinapower_itunesURL");

// Subtitle
$subtitle = get_post_meta($postID, '_podcast_subtitle', true);
$fullTitle = get_the_title().': '.$subtitle;

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<div class="featureImg" style="background-image:url('<?php echo $featured_img_url; ?>');">
					<h1 class="entry-title"><?php echo $fullTitle; ?></h1>
				</div>
			</header><!-- .entry-header -->
			<div class="post-nav">
				<div class="content-wrapper row flex-center__y">
					<div class="post-nav-content col-xs-12 col-md-8">
						<div class="post-nav-title js-isDefault active"><?php echo $fullTitle; ?></div>
						<div class="post-share-buttons">
							<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT( array(
								'linkname' => $fullTitle
								)); } ?>
						</div>
					</div>
					<div class="post-nav-menu col-xs-12 col-md-4">
						<ul>
							<li><a id="share" data-panel="post-share-buttons">Share</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="content-wrapper-narrow entry-content">
				<?php
				if($soundcloudID) {
					echo chinapower_podcast_display_iframe($soundcloudID);
				} else { ?>
					<iframe frameborder="0" height="200" scrolling="no" src="<?php echo $megaphoneIFrame; ?>" width="100%"></iframe>
				<?php }
					chinapower_posted_on();
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'defense360' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<!-- Tags -->
				<div class="post-tags-container content-wrapper">
					<?php chinapower_post_tags(); ?>
				</div>

				<!-- Podcast Description & Related Content -->
				<div class="post-podcastDesc-container content-wrapper row">
					<div class="podcastDesc-container col-xs-12 col-md-<?php echo $podcastDescWidth; ?>">
						<h5 class="podcastDesc-heading">ChinaPower Podcast</h5>
						<p><?php echo $podcastDesc; ?></p>
						<a href="<?php echo $itunesURL; ?>" target="_blank" rel="noopener" class="podcast-services-badge"><img src="/wp-content/themes/chinapower/img/itunes-badge.svg" alt="ChinaPower Podcast on iTunes" /></a>
						<?php if ( get_option( 'chinapower_google_url' ) ) {
							echo '<a href="' . get_option("chinapower_google_url") . '" target="_blank" rel="noopener" class="podcast-services-badge"><img src="/wp-content/themes/chinapower/img/google-play-badge.png" alt="ChinaPower Podcast on Google Play Music" /></a>';
						} ?>
						<?php if ( get_option( 'chinapower_stitcher_url' ) ) {
						echo '<a href="' . get_option("chinapower_stitcher_url") . '" target="_blank" rel="noopener" class="podcast-services-badge"><img src="/wp-content/themes/chinapower/img/stitcher-badge.svg" alt="ChinaPower Podcast on Stitcher" /></a>';
					} ?>
					</div>
					<div class="relatedContent-container col-xs-12 col-md-<?php echo $relatedContentWidth; ?>">
						<?php echo $relatedContentHeader; ?>
						<?php chinapower_relatedContent($rel); ?>
					</div>
				</div>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); 