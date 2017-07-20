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

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<div class="featureImg" style="background-image:url('<?php echo $featured_img_url; ?>');">
					<?php
					// Post Title
					the_title( '<h1 class="entry-title">', '</h1>' );
					?>
				</div>
				<div class="post-nav">
					<div class="content-wrapper row flex-center__y">
						<div class="post-nav-content hidden-xs col-md-8">
							<div class="post-nav-title js-isDefault active"><?php the_title(); ?></div>
							<div class="post-share-buttons">
								<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
							</div>
							<div class="post-nav-jumpto">
								<?php the_title('<span class="post-title">','</span>'); ?>
								<span class="post-nav-toTop"><a href="#page">Top&#8593;</a></span>
								<ul class="post-nav-toc"></ul>
							</div>
						</div>
						<div class="post-nav-menu col-xs-12 col-md-4">
							<ul>
								<li><a id="share" data-panel="post-share-buttons">Share</a></li>
								<li><a id="jump" data-panel="post-nav-jumpto">Jump To</a></li>
								<?php echo chinapower_icl_post_languages(); ?>
							</ul>
						</div>
					</div>
				</div>
			</header><!-- .entry-header -->

			<div class="content-wrapper-narrow entry-content">
				<?php
					echo chinapower_podcast_display_iframe($soundcloudID);
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
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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