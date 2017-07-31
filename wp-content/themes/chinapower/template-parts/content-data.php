<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chinapower
 */
$ID = get_the_ID();
$source = wp_get_post_terms($ID, 'datasources');

$viewURL = get_post_meta( $ID, '_data_viewURL', true );
$downloadURL = get_post_meta( $ID, '_data_downloadURL', true );
$viewIsPDF = get_post_meta( $ID, '_data_viewIsPDF', true );

if($viewIsPDF) {
	$viewText = "PDF";
}
else {
	$viewText = "Link";
}

$featuredStats = '';
for($i = 1; $i <= 3; $i++) {
	$featuredStats .= '[dataFeatured id="'.$ID.'" stat="'.$i.'"]';
}

?>

<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<td><?php the_title( '<span class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></span>'); ?></td>
	<td><?php chinapower_post_categories(); ?></td>
	<td><?php echo $source[0]->name; ?></td>
	<td>
		<?php
		if($viewURL) {
			echo '<a href="'.$viewURL.'" class="btn btn-view" target="_blank">'.$viewText.' <i class="icon-external-link"></i></a>';
		}
		if($downloadURL) {
			echo '<a href="'.$downloadURL.'" class="btn btn-view" target="_blank">Download</a>';
		}
		?>
	</td>
	<td class="cardCol">
		<?php get_template_part( 'template-parts/content-data-card'); ?>
		<hr />
	</td>
</tr><!-- #post-<?php the_ID(); ?> -->
