<?php
/**
 * Template: Single Posts
 */

get_header();

if (has_post_thumbnail()) :
	$featured_img_url = get_the_post_thumbnail_url();
endif;

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
								<span class="post-nav-toTop">Top&#8593;</span>
								<ul class="post-nav-toc">
									<li><a href="#introduction">Introduction</a></li>
									<li><a href="#test" class="active">Test</a></li>
									<li><a href="#foobar">Foobar</a></li>
								</ul>
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
				<?php
					echo "<div class='post-relatedPostsContainer content-wrapper-narrow'>";
					echo '<h3 class="relatedPosts-title"><span>Related</span></h3>';
					echo do_shortcode( '[jprel]' );
					echo "</div>";
				?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); 