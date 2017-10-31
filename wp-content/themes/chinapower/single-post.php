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
$data_sources_title = get_post_meta($postID, '_post_data_sources_title', true);
$furtherReading = get_post_meta($postID, '_post_furtherReading', true);

if($data_sources_title) {
	$data_title = $data_sources_title;
}
else {
	$data_title = "Data Sources";
}

if($dataSources) {
	$dataSourcesContentWidth = "col-md-8";
	$dataSourcesHeader = '<h5 class="dataSources-heading">'. $data_title.'</h5>';
	$dataSources = apply_filters('meta_content', $dataSources);
}
else {
	$dataSourcesContentWidth = "hidden-xs";
	$noMargin = "noMargin";
}

global $related;
$rel = $related->show( get_the_ID(), true );

// Width of Further Reading & Related Content
if($furtherReading) {
	$relatedContentWidth = "4";
	$furtherReadingHeader = '<h5 class="furtherReading-heading">Further Reading</h5>';
}
else {
	$relatedContentWidth = "12";
	$noMargin = "noMargin";
}

if(is_array($rel) && count($rel) > 0) {
	$furtherReadingWidth = "8";
	$relatedContentHeader = '<h6 class="relatedContent-heading '.$noMargin.'">Related Content</h6>';
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
			</header><!-- .entry-header -->
			<div class="post-nav">
				<div class="content-wrapper row flex-center__y">
					<div class="post-nav-content col-xs-12 col-md-8">
						<div class="post-nav-title js-isDefault active"><?php the_title(); ?></div>
						<div class="post-share-buttons">
							<div class="post-title"><?php the_title(); ?></div>
							<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
						</div>
						<div class="post-nav-jumpto">
							<?php the_title('<span class="post-title">','</span>'); ?>
							<span class="post-nav-toTop"><a href="#page">Top <i class="icon icon-up"></i></a></span>
							<ul class="post-nav-toc"></ul>
						</div>
						<div class="post-translate"><?php echo chinapower_icl_post_languages(); ?></div>
					</div>
					<div class="post-nav-menu col-xs-12 col-md-4">
						<i class="icon icon-close-x closePanel" aria-label="Close Menu"></i>
						<ul>
							<li><a id="share" data-panel="post-share-buttons">Share</a></li>
							<li><a id="jump" data-panel="post-nav-jumpto">Jump To</a></li>
							<?php echo chinapower_icl_post_languages_menu(); ?>
						</ul>
					</div>
				</div>
			</div>

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
				<div class="post-tags-container content-wrapper">
					<?php chinapower_post_tags(); ?>
				</div>
				<!-- Data Sources & Citation -->
				<div class="post-dataSources-container">
					<div class="content-wrapper row">
						<div class="dataSources-content col-xs-12 <?php echo $dataSourcesContentWidth; ?>">
							<?php echo $dataSourcesHeader.$dataSources; ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h6 class="cite-heading <?php echo $noMargin; ?>">Cite This Page</h6>
							<?php echo chinapower_citation(); ?>
							<button class="btn btn-red tooltipped-n" id="btn-copy" data-clipboard-target=".cite-citation" aria-label="Copied!">Copy<i class="icon icon-copylink-share"></i></button>
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