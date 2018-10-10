<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package chinapower
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Page not found!', 'chinapower' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<div class="content-wrapper row">
					<img class="img404" src="/wp-content/themes/chinapower/img/ChinaPower-404-wall.jpg" alt="404 Page Not Found">


						<div class="col-xs-12 col-sm-6">
							<p><?php esc_html_e( 'We were unable to locate the page you requested. The page may have moved or may no longer be available. We apologize for the inconvenience!', 'chinapower' ); ?></p>
							<h4>Go to the <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">HOMEPAGE</a></h4>

							<?php if(get_theme_mod('contact-email')) {
								echo '<h4><a href="mailto:'.get_theme_mod('contact-email').'">EMAIL US</a> about this broken link</h4>';
							} ?>
							<?php get_search_form();?>
						</div>

						<div class="col-xs-12 col-sm-6">
							<h3 class="relatedContent-heading">Recent Posts</h3>

							<div class="relatedContent-container >">

							<?php $the_query = new WP_Query( 'posts_per_page=3' ); ?>

							<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

						<div class="relatedContent-post row">

						    <div class="relatedContent-img col-xs-6">
						    	<?php the_post_thumbnail('thumbnail'); ?>
						    </div>

						    <div class="col-xs-6">
						    	<?php chinapower_post_categories(); ?>
						    	<span class="relatedContent-title">
							    	<a href="'.get_permalink().'">
										<?php the_title(); ?>
									</a>
								</span>
						    </div>
						</div>

						<?php
						endwhile;
						wp_reset_postdata();
						?>

					</div><!-- .content-wrapper -->

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
