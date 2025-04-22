<?php
/**
 * chinapower functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chinapower
 */

if ( ! function_exists( 'chinapower_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function chinapower_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on chinapower, use a find and replace
	 * to change 'chinapower' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'chinapower', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'medium-square', 350, 350, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'chinapower' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'chinapower_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'chinapower_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chinapower_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'chinapower_content_width', 700 );
}
add_action( 'after_setup_theme', 'chinapower_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function chinapower_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'chinapower' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'chinapower' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'chinapower_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function chinapower_scripts() {
	wp_enqueue_style( 'chinapower-style', get_stylesheet_uri() );

	wp_enqueue_style( 'chinapower-print-style', get_template_directory_uri() . '/print.css', array(), '20200317', 'print' );

	wp_enqueue_script ('font-awesome', 'https://kit.fontawesome.com/c7e48d45aa.js', array(), '20190604', true);

	wp_enqueue_script( 'chinapower-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'chinapower-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'chinapower-header-menu', get_template_directory_uri() . '/js/header-menu.js', array(), '20170630', true );

	wp_enqueue_script( 'chinapower-post-nav', get_template_directory_uri() . '/js/post-nav.js', array(), '20170630', true );

  wp_enqueue_script( 'chinapower-iframe-resize', 'https://cdn.jsdelivr.net/npm/@iframe-resizer/parent@5.4.5', array(), '5.4.5', true );

	wp_add_inline_script( 'chinapower-iframe-resize', 'iframeResize({ direction: "vertical", license: "GPLv3" }, "iframe.js-iframeResizeEnabled");' );

	wp_enqueue_script('chinapower-clipboard', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js', array(), '20170713', true );

	wp_add_inline_script('chinapower-clipboard', "var clipboard = new Clipboard('#btn-copy');

		clipboard.on('success', function(e) {
		    var d = document.getElementById('btn-copy');
			d.className += ' tooltipped';
		});
	");

	wp_enqueue_script( 'chinapower-social-share', get_template_directory_uri() . '/js/social-share.js', array(), '20170726', true );
	
	if (is_page_template('info-is-beautiful-2019.php')) {
		wp_enqueue_script( 'chinapower-video-on-hover', get_template_directory_uri() . '/js/video-on-hover.js', array(), '20190904', true );
	}
}
add_action( 'wp_enqueue_scripts', 'chinapower_scripts' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function chinapower_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'chinapower_pingback_header' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Register Custom Post Meta Boxes for posts
 */
require get_template_directory() . '/inc/custom-post-meta.php';

/**
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Register Custom Shortcodes
 */
require get_template_directory() . '/inc/custom-shortcodes.php';

/**
 * Register Custom TinyMCE Buttons
 */
require get_template_directory() . '/inc/custom-tinymce-buttons.php';

/**
 * Register Custom General Settings
 */
require get_template_directory() . '/inc/custom-settings.php';

/**
 * Set media library to insert relative paths by default
 */
function switch_to_relative_url($html, $id, $caption, $title, $align, $url, $size, $alt)
{
	$imageurl = wp_get_attachment_image_src($id, $size);
	$relativeurl = wp_make_link_relative($imageurl[0]);
	$html = str_replace($imageurl[0],$relativeurl,$html);

	return $html;
}
add_filter('image_send_to_editor','switch_to_relative_url',10,8);

/**
 * Do not load WPML CSS
 */
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
