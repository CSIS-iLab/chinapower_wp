<?php
/**
 * Template: Single Posts
 */

get_header();

$postID = get_the_ID();

// Post Thumbnail
if (has_post_thumbnail()) :
	$featured_img_url = get_the_post_thumbnail_url();
endif;

// Data Sources, Further Reading, Related Content
$dataSources = get_post_meta($postID, '_post_dataSources', true);
$furtherReading = get_post_meta($postID, '_post_furtherReading', true);

global $related;
$rel = $related->show( get_the_ID(), true );

// Width of Further Reading & Related Content
if($furtherReading) {
	$relatedContentWidth = "4";
	$furtherReadingHeader = '<h5 class="furtherReading-heading">Further Reading</h5>';
}
else {
	$relatedContentWidth = "12";
}

if(is_array($rel) && count($rel) > 0) {
	$furtherReadingWidth = "8";
	$relatedContentHeader = '<h6 class="relatedContent-heading">Related Content</h6>';
}
else {
	$furtherReadingWidth = "12";
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
					<div class="content-wrapper row">
						<div class="post-nav-content col-xs-12 col-md-8">
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
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'defense360' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'defense360' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<!-- Tags -->
				<div class="post-tags-container"></div>
				<!-- Data Sources & Citation -->
				<div class="post-dataSources-container">
					<div class="content-wrapper row">
						<div class="dataSources-content col-xs-12 col-md-8">
							<h5 class="dataSources-heading">Data Sources</h5>
							<?php echo apply_filters('meta_content', $dataSources); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h6 class="cite-heading">Cite This Page</h6>
							<?php echo chinapower_citation(); ?>
							<button class="btn-copy" data-clipboard-target=".cite-citation">Copy</button>
						</div>
					</div>
				</div>
				<!-- Further Reading & Related Content -->
				<div class="post-furtherReading-container content-wrapper row">
					<div class="furtherReading-container col-xs-12 col-md-<?php echo $furtherReadingWidth; ?>">
						<?php echo $furtherReadingHeader; ?>
						<?php echo apply_filters('meta_content', $furtherReading); ?>
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