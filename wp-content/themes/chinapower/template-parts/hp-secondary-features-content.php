<?php
/**
 * Display secondary features on home page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
	<div class="entry-thumbnail col-xs-12 col-md-5">
		<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('medium-large'); ?></a>
	</div>
	<div class="post-info col-xs-12 col-md-7">
		<header class="entry-header">
			<?php
			chinapower_post_categories();
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<p> <?php the_excerpt(); ?> </p>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
