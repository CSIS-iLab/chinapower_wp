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
$megaphoneIFrame = get_post_meta(get_the_ID(), '_podcast_megaphoneIFrame', true);
$megaphoneURL = get_post_meta(get_the_ID(), '_podcast_megaphoneURL', true);

// Subtitle
$subtitle = get_post_meta(get_the_ID(), '_podcast_subtitle', true);
$fullTitle = get_the_title().': '.$subtitle;

remove_filter( 'the_excerpt', 'wpautop' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php if ( $sticky and $soundcloudID ) { ?>
	<div class="entry-thumbnail col-xs-12 col-md-4">
		<iframe width="246" height="245" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo $soundcloudID; ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
	</div>
	<div class="sticky-container col-xs-12 col-md-8">
		<header class="entry-header">
			<span class="isFeatured">Featured</span>
			<?php
			echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.$fullTitle.'</a></h2>';
			chinapower_posted_on();
			?>
		</header><!-- .entry-header -->
		<div class="entry-content"><p><?php the_excerpt(); ?></p></div><!-- .entry-content -->
	</div>
	<?php } elseif ($sticky and $megaphoneIFrame) { ?>
		<div class="entry-thumbnail col-xs-12 col-md-4">
			<iframe frameborder="no" height="245" scrolling="no" src="<?php echo $megaphoneIFrame; ?>&tile=true&light=true" width="246"></iframe>
		</div>
	<div class="sticky-container col-xs-12 col-md-8">
		<header class="entry-header">
			<span class="isFeatured">Featured</span>
			<?php
			echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.$fullTitle.'</a></h2>';
			chinapower_posted_on();
			?>
		</header><!-- .entry-header -->
		<div class="entry-content"><p><?php the_excerpt(); ?></p></div><!-- .entry-content -->
	</div>
	<?php } elseif ($soundcloudID) { ?>
		<header class="entry-header col-xs-12 col-md-4">
		<?php
		echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.$fullTitle.'</a></h2>';
		chinapower_posted_on();
		?>
	</header><!-- .entry-header -->
	<div class="entry-content col-xs-12 col-md-8">
		<div class="soundcloud-mini-container">
			<iframe width="100%" height="20" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo $soundcloudID; ?>&amp;color=ff5500&amp;inverse=false&amp;auto_play=false&amp;show_user=true""></iframe>
		</div>
		<p><?php the_excerpt(); ?></p>
	</div><!-- .entry-content -->
			<?php } elseif ($megaphoneURL) { ?>
		<header class="entry-header col-xs-12 col-md-4">
		<?php
		echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.$fullTitle.'</a></h2>';
		chinapower_posted_on();
		?>
	</header><!-- .entry-header -->
	<div class="entry-content col-xs-12 col-md-8">
		<div class="soundcloud-mini-container">
		<audio controls controlsList="nodownload" src="<?php echo $megaphoneURL ?>">
		Your browser does not support the
		<code>audio</code> element.
	</audio>		</div>
		<p><?php the_excerpt(); ?></p>
	</div><!-- .entry-content -->
			<?php } ?>
	<footer class="entry-footer learnMore">
		<p><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">Learn More <i class="icon-arrow-long"></i></a></p>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
