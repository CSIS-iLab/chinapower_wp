<?php
/**
 * Display latest podcasts on home page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

$permalink = esc_url(get_post_permalink(get_the_ID()));

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h3 class="entry-title"><a href="<?php echo $permalink; ?>" rel="bookmark"><?php the_title().chinapower_subtitle(get_the_ID()); ?></a></h3>
		<?php chinapower_posted_on(); ?>
	</header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
