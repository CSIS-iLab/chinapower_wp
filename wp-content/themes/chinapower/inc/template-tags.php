<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package chinapower
 */

if ( ! function_exists( 'chinapower_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function chinapower_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'chinapower' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'chinapower' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;


if ( ! function_exists( 'chinapower_post_categories' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function chinapower_post_categories() {
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'chinapower' ) );
	if ( $categories_list && chinapower_categorized_blog() ) {
		/* translators: 1: list of categories. */
		printf( '<span class="cat-links">' . esc_html__( '%1$s', 'chinapower' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'chinapower_post_tags' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function chinapower_post_tags() {
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
	if ( $tags_list ) {
		/* translators: 1: list of tags. */
		printf( '<span class="tags-heading">Keywords</span>' . esc_html__( '%1$s', 'chinapower' ), $tags_list ); // WPCS: XSS OK.
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function chinapower_categorized_blog() {
	$all_the_cool_cats = get_transient( 'chinapower_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'chinapower_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so chinapower_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so chinapower_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in chinapower_categorized_blog.
 */
function chinapower_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'chinapower_categories' );
}
add_action( 'edit_category', 'chinapower_category_transient_flusher' );
add_action( 'save_post',     'chinapower_category_transient_flusher' );

/**
 * Display if post is available in a different language
 * @return String Translated language names in native language
 */
function chinapower_icl_post_languages(){
	if ( function_exists('icl_object_id') ) {
		$languages = icl_get_languages('skip_missing=1');
		if(1 < count($languages)){
			foreach($languages as $l){
				if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['native_name'].'</a>';
			}
			$output = "<li>".join(' / ', $langs)."</li>";
			return $output;
		}
	}
}

/**
 * Displays related content to the current post
 * @param  Array $rel Array of related posts
 * @return String      HTML of related posts
 */
function chinapower_relatedContent($rel){
	// Display the title and excerpt of each related post
    if( is_array( $rel ) && count( $rel ) > 0 ) {
    	global $post;
        foreach( $rel as $post ) : setup_postdata($post);
            if ($post->post_status != 'trash') {
            	echo '<div class="relatedContent-post row">';
            	echo '<div class="relatedContent-img col-xs-4">';
            	the_post_thumbnail('thumbnail');
            	echo '</div><div class="col-xs-8">';
            	chinapower_post_categories();
            	echo '<span class="relatedContent-title"><a href="'.get_permalink().'">';
            	the_title();
            	echo '</a></span>';
                echo '</div></div>';
            }
        endforeach;
        wp_reset_postdata();
    }
}

function chinapower_citation() {
	return '<p class="cite-citation">China Power Team. "'.get_the_title().'" China Power. '.get_the_date().'. Accessed '.current_time('F j, Y').'. '.get_the_permalink().'</p>';
}
