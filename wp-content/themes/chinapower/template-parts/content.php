<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

if(is_sticky()) {
	$classes = "sticky row cardLayout";
}
else {
	$classes = "row cardLayout";
}

remove_filter( 'the_excerpt', 'wpautop' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<div class="entry-thumbnail col-xs-12 col-md-4">
		<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('medium-large'); ?></a>
	</div>
	<?php
		if(is_sticky()) {
	?>
		<div class="sticky-container col-xs-12 col-md-8">
			<header class="entry-header">
				<span class="isFeatured">Featured</span>
				<?php
				chinapower_post_categories();
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
			</header><!-- .entry-header -->
			<div class="entry-content"><p><?php the_excerpt(); ?></p></div><!-- .entry-content -->
		</div>
		<?php } else { ?>
		<header class="entry-header col-xs-12 col-md-3">
			<?php
			chinapower_post_categories();
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
		</header><!-- .entry-header -->
		<div class="entry-content col-xs-12 col-md-5">
			<p><?php the_excerpt(); ?></p>
		</div><!-- .entry-content -->
	<?php } ?>
	<footer class="entry-footer learnMore">
		<p><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">Learn More <i class="icon"></i></a></p>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
