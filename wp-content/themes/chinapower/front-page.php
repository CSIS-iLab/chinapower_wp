<?php
/**
 * Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

get_header(); 

// Featured Item
if(get_theme_mod('hp_feature_1')) {
	$feature1 = get_post(get_theme_mod('hp_feature_1'));

	if (has_post_thumbnail($feature1)) :
		$featured_img_url = get_the_post_thumbnail_url($feature1);
	endif;

	$feature1->excerpt = get_the_excerpt($feature1);
}

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article class="post feature-1">
				<div class="featureImg" style="background-image:url('<?php echo $featured_img_url; ?>');">
					<div class="post-info row">
						<div class="feature-title col-xs-12 col-md-6">
							<h1 class="entry-title"><?php echo $feature1->post_title; ?></h1>
							<?php chinapower_post_categories_home($feature1->ID); ?>
						</div>
						<div class="feature-excerpt col-xs-12 col-md-6">
							<p><?php echo $feature1->excerpt; ?></p>
						</div>
					</div>
				</div>
			</article>
			<section class="section-1 content-wrapper row">
				<section class="secondary-features col-xs-12 col-md-8">
				<?php
					if(get_theme_mod('hp_feature_2') || get_theme_mod('hp_feature_3')) {
						$featuredPostsArgs = array(
							'post__in' => array(
								get_theme_mod('hp_feature_2'),
								get_theme_mod('hp_feature_3')
								),
							'orderby' => 'post__in'
						);
						$featured_posts = get_posts($featuredPostsArgs);
						foreach($featured_posts as $post) : setup_postdata($post);
							get_template_part( 'template-parts/hp-secondary-features-content', get_post_format() );
						endforeach;
						wp_reset_postdata();
					}
				?>
				</section>
				<section class="podcast col-xs-12 col-md-4">
					<h2 class="podcast-heading"><img src="/wp-content/themes/chinapower/img/chinapower-podcast-no-text.jpg" title="Podcast" alt="Podcast" /> Podcast</h2>
					<?php
						$latest_podcasts_args = array(
							'post_status' => 'publish',
							'numberposts' => 4,
							'post_type'   => 'podcasts'
						);
						$latest_podcasts = wp_get_recent_posts($latest_podcasts_args, OBJECT);
						foreach($latest_podcasts as $post) : setup_postdata($post);
							get_template_part( 'template-parts/hp-latest-podcasts', get_post_format() );
						endforeach;
						wp_reset_postdata();
					?>
					<a href="/podcasts" class="btn btn-white">Browse Episodes<i class="icon icon-arrow-right"></i></a>

					<hr />
					<p><?php echo get_option("chinapower_podcast_desc_short"); ?></p>
					<a href="<?php echo get_option("chinapower_itunesURL"); ?>" target="_blank" rel="noopener"><img src="/wp-content/themes/chinapower/img/itunes-badge.svg" alt="ChinaPower Podcast on iTunes" /></a>
				</section>
			</section>
			<section class="section-2 content-wrapper row">
				<div class="featured-stat col-xs-12 col-md-8">
					Featured Stat
				</div>
				<div class="data-repo col-xs-12 col-md-4">
					<a href=""><h4 class="data-repo-title">Data Repository</h4></a>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</p>
					<a href="">Explore our curated library of resources<i class="icon icon-arrow-right"></i></a>
				</div>
			</section>
			<section class="section-3">
				<div class="content-wrapper">
					<?php the_content(); ?>
				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
