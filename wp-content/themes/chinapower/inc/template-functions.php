<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package chinapower
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function chinapower_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'chinapower_body_classes' );

/**
 * Add wrapper around sub-menu items for main navigation
 */
class WPSE_78121_Sublevel_Walker extends Walker_Nav_Menu
{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class='sub-menu-container'>
			<div class='sub-menu-wrapper'>
		<span class='languages-text'>" . esc_html_x( 'Browse translated content:', 'chinapower' ) . "</span><ul class='sub-menu'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div></div>\n";
	}
}

/**
 * Filter the except length to 45 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
	   global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '">...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Change the_archive_title to use custom text before categories, tags, and other taxonomies.
 */
add_filter( 'get_the_archive_title', function ($title) {
	if (is_post_type_archive('guest_author_posts')) {
		$title = 'Analysis';
	} elseif ( is_category() ) {
		$title = single_cat_title('', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( 'Keyword:', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}
	return $title;
});

/**
 * Category Archives: Display sticky posts at the top
 */
add_filter('the_posts', 'bump_sticky_posts_to_top');
function bump_sticky_posts_to_top($posts) {
	if( ! is_admin() && is_category())
	{
		$stickies = array();
		foreach($posts as $i => $post) {
			if(is_sticky($post->ID)) {
				$stickies[] = $post;
				unset($posts[$i]);
			}
		}
		return array_merge($stickies, $posts);
	}
	else {
		return $posts;
	}
}

/**
 * Helper function to render first post differently than other posts
 */
function is_first_post()
{
	static $called = FALSE;

	if ( ! $called )
	{
		$called = TRUE;
		return TRUE;
	}

	return FALSE;
}

/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function chinapower_cpt_search( $query ) {
	if ( $query->is_search ) {
	$query->set( 'post_type', array( 'post', 'podcasts', 'page') );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'chinapower_cpt_search' );

// Adds custom post types to tag archives
function chinapower_cpt_tag_archives( $query ) {
	if ( $query->is_tag() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'podcasts', 'data' ) );
	}
}
add_action( 'pre_get_posts', 'chinapower_cpt_tag_archives' );

/**
 * Make links pushed to Algolia relative.
 *
 * @param array   $shared_attributes Attributes to push.
 * @param WP_Post $post Post object.
 * @return array Updated Attributes array.
 */
function chinapower_algolia_shared_attributes( array $shared_attributes, WP_Post $post ) {
	// Here we make sure we push the post's language data to Algolia.
	$shared_attributes['permalink'] = wp_make_link_relative( get_post_permalink( $post ) );

	if ( has_post_thumbnail( $post ) ) {
		$shared_attributes['images']['thumbnail']['url'] = wp_make_link_relative( get_the_post_thumbnail_url( $post ) );
	}

	return $shared_attributes;
}

add_filter( 'algolia_post_shared_attributes', 'chinapower_algolia_shared_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_shared_attributes', 'chinapower_algolia_shared_attributes', 10, 2 );

/**
 * Disable WPML from redirecting the home URL to the language specific home page.
 */
function chinapower_wpml_home_url( $home_url, $url, $path, $orig_scheme, $blog_id ) {
    return $url;
}
add_filter( 'wpml_get_home_url', 'chinapower_wpml_home_url', 99, 5 );

if ( class_exists( 'easyFootnotes' ) ) {
	/**
	 * Removes the easy footnotes from the content.
	 * @param  string $content The post content.
	 * @return string          The modified post content.
	 */
	function chinapower_remove_easy_footnotes($content) {
			$content = preg_replace('#<ol[^>]*class="easy-footnotes-wrapper"[^>]*>.*?</ol>#is', '', $content);
			return $content;
	}
	add_filter('the_content', 'chinapower_remove_easy_footnotes', 20);
}
