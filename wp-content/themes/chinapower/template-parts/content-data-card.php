<?php
/**
 * Content: Data (Card)
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

if ( is_singular() ) :
	the_title( '<h1 class="entry-title">', '</h1>' );
else :
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
endif;
?>
<div class="dataInfo row bottom-md">
	<div class="col-xs-12 col-md-8">
		<strong>Topic:</strong> <?php chinapower_post_categories(); ?><br />
		<strong>Source:</strong> <?php echo $source[0]->name; ?>
	</div>
	<div class="data-links col-xs-12 col-md-4">
		<?php
		if($viewURL) {
			echo '<a href="'.$viewURL.'" class="btn btn-view" target="_blank">'.$viewText.' <i class="icon-external-link"></i></a>';
		}
		if($downloadURL) {
			echo '<a href="'.$downloadURL.'" class="btn btn-view" target="_blank">Download</a>';
		}
		?>
	</div>
</div>
<?php echo do_shortcode($featuredStats); ?>
