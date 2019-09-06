<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

get_header(); ?>

	<div id="primary" class="content-area content-wrapper">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					if ( is_post_type_archive('podcasts') ) {
						the_archive_top_content();
					} else {
						the_archive_description( '<div class="archive-description">', '</div>' );
					}
				?>
			</header><!-- .page-header -->
			
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				if(get_post_type() == 'podcasts' || is_post_type_archive('podcasts')) {
					get_template_part( 'template-parts/content-podcasts' );
				}
				elseif(get_post_type() == 'data') {
					get_template_part('template-parts/content-data-card');
				}
				else {
					get_template_part( 'template-parts/content', get_post_format() );
				}

			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
