<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package chinapower
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search: %s', 'chinapower' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				if(get_post_type() == 'podcasts') {
					get_template_part( 'template-parts/content-podcasts' )
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
	</section><!-- #primary -->

<?php
get_footer();
