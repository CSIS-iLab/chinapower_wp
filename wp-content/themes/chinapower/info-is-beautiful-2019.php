<?php
/**
 * Template Name: Info is Beautiful 2019 Entry
 * The template for the Information is Beautiful 2019 entry landing page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

get_header(); 

$postID = get_the_ID();

// Post Thumbnail
$featured_img_caption = '';
if ( has_post_thumbnail() ) {
	$featured_img_url = get_the_post_thumbnail_url();
	$featured_img_caption = '<div class="post-featured-caption content-wrapper">' . esc_html_x( 'Photo Credit: ', 'chinapower' ) . get_the_post_thumbnail_caption() . '</div>';
}

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <header class="entry-header">
				<div class="featureImg" style="background-image:url('<?php echo $featured_img_url; ?>');">
					<?php
					// Post Title
					the_title( '<h1 class="entry-title">', '</h1>' );
					?>
				</div>
			</header><!-- .entry-header -->
      <section class="content-wrapper">
			<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'chinapower' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				?>
      </section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
