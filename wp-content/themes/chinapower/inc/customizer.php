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

	// Home: Data Repo Description
	$wp_customize->add_setting( 'hp-data' , array(
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(
		'hp-data', 
		array(
			'label'    => __( 'Home: Data Repository Desc', 'chinapower' ),
			'section'  => 'chinapower-theme-settings',
			'settings' => 'hp-data',
			'type'     => 'textarea'
		)
	);

	/*----------  Home Page: Features  ----------*/
	$featuredPosts_list = array();
	$args = array('post_type' => array('post', 'guest_author_posts', 'tracker'), 'numberposts' => '-1', 'suppress_filters' => 0);
	$featuredPosts = get_posts( $args ); 
	foreach($featuredPosts as $featuredPost) {
		$featuredPosts_list[$featuredPost->ID] = $featuredPost->post_title;
	}

	$featuredStats = get_meta_values("'_data_stat1','_data_stat2','_data_stat3'", 'data' );
	$featuredStats_list = array();
	foreach($featuredStats as $featuredStat) {
		if($featuredStat->meta_value) {
			$featuredStats_list[$featuredStat->post_id."-".$featuredStat->meta_key] = $featuredStat->meta_value;
		}
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

	// Featured Statistic
	$wp_customize->add_setting( 'hp_stat', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_stat', array('label'    => esc_html__( 'Featured Stat', 'chinapower' ), 'type'     => 'select', 'section'  => 'chinapower-hp-features', 'priority' => 5, 'choices'  => $featuredStats_list, ));

	// Featured Stat: Icon
	$wp_customize->add_setting( 'hp_stat_icon' , array(
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(
		'hp_stat_icon', 
		array(
			'label'    => __( 'Featured Stat: Icon', 'chinapower' ),
			'section'  => 'chinapower-hp-features',
			'settings' => 'hp_stat_icon',
			'type'     => 'text'
		)
	);

	// Featured Stat: Related Post
	$wp_customize->add_setting( 'hp_stat_post', array('transport' => 'postMessage'));
	$wp_customize->add_control( 'hp_stat_post', array('label'    => esc_html__( 'Featured Stat Related Post', 'chinapower' ), 'type'     => 'select', 'section'  => 'chinapower-hp-features', 'priority' => 6, 'choices'  => $featuredPosts_list, ));

	

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
		'manage_theme_options',
		'/customize.php?autofocus[section]=chinapower-hp-features'
	);
}

/**
 * Displays post meta with specific key for all posts
 * @param  string $key    Post meta key
 * @param  string $type   Post type
 * @param  string $status Publish status
 * @return array          Array of meta values
 */
function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {

	global $wpdb;

	if( empty( $key ) )
		return;

	$r = $wpdb->get_results($wpdb->prepare( "
		SELECT pm.meta_value, pm.post_id, pm.meta_key FROM {$wpdb->postmeta} pm
		LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
		WHERE pm.meta_key IN ({$key}) 
		AND p.post_status = '%s' 
		AND p.post_type = '%s'
	", $status, $type ) );

	return $r;
}