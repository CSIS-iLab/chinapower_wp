<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper" role="main">

		<?php
		if ( have_posts() ) :
		?>
			<header class="page-header">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
				<?php
					if ( function_exists('icl_object_id') && null !== ICL_LANGUAGE_CODE && ICL_LANGUAGE_CODE !== 'en' ) {
						echo '<div class="archive-description">' . _ex( 'Page description for translated all topics pages.', 'Page description for translated all topics pages.', 'chinapower') . '</div>';
					}
				?>
			</header>

			<?php

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
