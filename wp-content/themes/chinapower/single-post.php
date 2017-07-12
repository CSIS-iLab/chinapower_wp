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
							<div class="post-nav-title"><?php the_title(); ?></div>
						</div>
						<div class="post-nav-menu col-xs-12 col-md-4">
							<ul>
								<li><a href="#share">Share</a></li>
								<li><a href="#jumpTo">Jump To</a></li>
								<li><a href="#translations">Translations</a></li>
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