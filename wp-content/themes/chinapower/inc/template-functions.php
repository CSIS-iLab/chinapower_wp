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
        $output .= "\n$indent<div class='sub-menu-container'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
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
    if ( is_category() ) {
		$title = single_cat_title('', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
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
 