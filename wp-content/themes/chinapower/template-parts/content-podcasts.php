<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

if ( is_first_post() ) {
	$sticky = true;
	$classes = "sticky row cardLayout";
}
else {
	$classes = "row cardLayout";
}

$soundcloudID = get_post_meta(get_the_ID(), '_podcast_soundcloudID', true);
$megaphoneEmbedURL = get_post_meta(get_the_ID(), '_podcast_megaphoneEmbedURL', true);

// Subtitle
$subtitle = get_post_meta(get_the_ID(), '_podcast_subtitle', true);
$fullTitle = get_the_title().': '.$subtitle;

remove_filter( 'the_excerpt', 'wpautop' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php if ( $sticky && ($soundcloudID || $megaphoneEmbedURL )) { ?>
	<div class="sticky-container">
		<header class="entry-header">
			<span class="isFeatured">Featured</span>
				<?php
				echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.$fullTitle.'</a></h2>';
				chinapower_posted_on();
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php if ($soundcloudID) {?>
				<iframe width="100%" height="175" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo $soundcloudID; ?>&amp;color=ff5500&amp;inverse=false&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
			<?php } elseif ($megaphoneEmbedURL) {?>
			<iframe frameborder="no" height="200" scrolling="no" src="<?php echo $megaphoneEmbedURL; ?>&light=true" width="100%"></iframe>
			<?php } ?>
			<p><?php the_excerpt(); ?></p>
		</div><!-- .entry-content -->
	</div>
	<?php } else { ?>
		<header class="entry-header">
		<?php
		echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.$fullTitle.'</a></h2>';
		chinapower_posted_on();
		?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php if ($soundcloudID) { ?>
		<div class="soundcloud-mini-container">
			<iframe width="100%" height="20" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo $soundcloudID; ?>&amp;color=ff5500&amp;inverse=false&amp;auto_play=false&amp;show_user=true""></iframe>
		</div>
			<?php } elseif ($megaphoneEmbedURL) {?>
				<div class="megaphone-mini-container">
			<iframe frameborder="no" height="200" scrolling="no" src="<?php echo $megaphoneEmbedURL; ?>&light=true" width="620"></iframe>
		</div>
			<?php } ?>
		<p><?php the_excerpt(); ?></p>
	</div><!-- .entry-content -->
			<?php } ?>
	<footer class="entry-footer learnMore">
		<p><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">Learn More <i class="icon-arrow-long"></i></a></p>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
