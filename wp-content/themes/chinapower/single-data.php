<?php
/**
 * Single: Data
 *
 * @package chinapower
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper-narrow" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content-data-card');

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
