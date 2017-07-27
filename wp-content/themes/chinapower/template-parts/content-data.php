<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */

?>

<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<td><?php the_title( '<span class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></span>'); ?></td>
	<td><?php chinapower_post_categories(); ?></td>
	<td>Source</td>
	<td>View</td>
</tr><!-- #post-<?php the_ID(); ?> -->
