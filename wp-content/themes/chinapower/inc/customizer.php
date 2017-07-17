<?php
/**
 * chinapower Theme Customizer
 *
 * @package chinapower
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chinapower_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Create Custom Sections
	$wp_customize->add_section( 'chinapower-theme-settings' , array(
	    'title'      => __( 'Theme Settings', 'chinapower' ),
	    'priority'   => 30,
	) );
	$wp_customize->add_section( 'chinapower-hp-features' , array(
	    'title'      => __( 'Home Page: Features', 'chinapower' ),
	    'priority'   => 30,
	) );
	// $wp_customize->add_section( 'chinapower-hp-series' , array(
	//     'title'      => __( 'Home Page: Series', 'chinapower' ),
	//     'priority'   => 30,
	// ) );

	// Footer: Site Description
	$wp_customize->add_setting( 'footer-site' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'footer-site', 
		array(
			'label'    => __( 'Site Description', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'footer-site',
			'type'     => 'textarea'
		)
	);

	// Footer: Newsletter
	$wp_customize->add_setting( 'footer-newsletter' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'footer-newsletter', 
		array(
			'label'    => __( 'Newsletter Description', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'footer-newsletter',
			'type'     => 'textarea'
		)
	);

	// Contact: Newsletter Sign-up
	$wp_customize->add_setting( 'newsletter-signup' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'newsletter-signup', 
		array(
			'label'    => __( 'Newsletter Signup URL', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'newsletter-signup',
			'type'     => 'text'
		)
	);

	// Contact: Address
	$wp_customize->add_setting( 'contact-address' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'contact-address', 
		array(
			'label'    => __( 'Contact: Address', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'contact-address',
			'type'     => 'textarea'
		)
	);

	// Contact: Email
	$wp_customize->add_setting( 'contact-email' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'contact-email', 
		array(
			'label'    => __( 'Contact: Email', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'contact-email',
			'type'     => 'email'
		)
	);

	// Contact: Facebook
	$wp_customize->add_setting( 'contact-facebook' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'contact-facebook', 
		array(
			'label'    => __( 'Contact: Facebook Profile', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'contact-facebook',
			'type'     => 'text'
		)
	);

	// Contact: Twitter
	$wp_customize->add_setting( 'contact-twitter' , array(
	    'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		'contact-twitter', 
		array(
			'label'    => __( 'Contact: Twitter Handle', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'contact-twitter',
			'type'     => 'text'
		)
	);

	/*----------  Home Page: Features  ----------*/
    $featuredPosts_list = array();
	$args = array('post_type' => 'post', 'numberposts' => '-1');
	$featuredPosts = get_posts( $args ); 
	foreach($featuredPosts as $featuredPost) {
	    $featuredPosts_list[$featuredPost->ID] = $featuredPost->post_title;
	}

    // Feature 1
    $wp_customize->add_setting( 'hp_feature_1', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_feature_1', array('label'    => esc_html__( 'Feature #1', 'chinapower' ), 'type'     => 'select', 'section'  => 'chinapower-hp-features', 'priority' => 4, 'choices'  => $featuredPosts_list, ));

    // Feature 2
    $wp_customize->add_setting( 'hp_feature_2', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_feature_2', array('label'    => esc_html__( 'Feature #2', 'chinapower' ), 'type'     => 'select', 'section'  => 'chinapower-hp-features', 'priority' => 4, 'choices'  => $featuredPosts_list, ));

    // Feature 3
    $wp_customize->add_setting( 'hp_feature_3', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_feature_3', array('label'    => esc_html__( 'Feature #3', 'chinapower' ), 'type'     => 'select', 'section'  => 'chinapower-hp-features', 'priority' => 4, 'choices'  => $featuredPosts_list, ));


    /*----------  Home Page: Series  ----------*/
 //    $series_list = array();
 //    $terms = get_terms( array(
	//     'taxonomy' => 'series',
	//     'hide_empty' => true,
	// ) );
	// foreach($terms as $term) {
	// 	$series_list[$term->term_id] = $term->name;
	// }

	// // Featured Series
	// $wp_customize->add_setting( 'hp_series_1', array('transport' => 'postMessage'));
	// $wp_customize->add_control( 'hp_series_1', array('label'    => esc_html__( 'Featured Series', 'chinapower' ), 'type'     => 'select', 'section'  => 'chinapower-hp-series', 'priority' => 4, 'choices'  => $series_list, ));

}
add_action( 'customize_register', 'chinapower_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function chinapower_customize_preview_js() {
	wp_enqueue_script( 'chinapower_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'chinapower_customize_preview_js' );

/**
 * Remove links to unnecessary parts of the theme customizer
 */

function wpse_225164_remove_core_sections( $wp_customize ) {
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'header_image' );
    $wp_customize->remove_section( 'background_image' );
}

add_action( 'customize_register', 'wpse_225164_remove_core_sections' );

/**
 * Add links to customizer sections to appearance menu
 */

add_action( 'admin_menu', 'wpse_custom_submenu_page' );
function wpse_custom_submenu_page() {
	add_submenu_page(
	    'themes.php',
	        __( 'HP: Features', 'chinapower' ),
	        __( 'HP: Features', 'chinapower' ),
	        'manage_options',
	        '/customize.php?autofocus[section]=chinapower-hp-features'
	    );
	// add_submenu_page(
	//     'themes.php',
	//         __( 'HP: Series', 'chinapower' ),
	//         __( 'HP: Series', 'chinapower' ),
	//         'manage_options',
	//         '/customize.php?autofocus[section]=chinapower-hp-series'
	//     );
}

/**
 * Remove unnecessary links to Header & Background in the Appearance Menu
 */
add_action('admin_menu', 'remove_unnecessary_wordpress_menus', 999);

function remove_unnecessary_wordpress_menus(){
    global $submenu;
    foreach($submenu['themes.php'] as $menu_index => $theme_menu){
        if($theme_menu[0] == 'Header' || $theme_menu[0] == 'Background')
        unset($submenu['themes.php'][$menu_index]);
    }
}