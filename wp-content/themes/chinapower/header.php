<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chinapower
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'chinapower' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">
			<div class="content-wrapper row">
				<div class="site-branding col-xs-12 col-md-4">
					<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
					?>
				</div><!-- .site-branding -->
				<div class="main-navigationContainer col-xs-12 col-md-8">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
						?>
					</nav><!-- #site-navigation -->
				</div>
			</div><!-- .content-wrapper -->
		</div><!-- .site-header -->
		<div class="header-searchFormContainer">
			<div class="content-wrapper row">
				<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				    <label>
				        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
				        <input type="search" class="search-field"
				            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
				            value="<?php echo get_search_query() ?>" name="s"
				            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
				    </label>
				    <input type="submit" class="search-submit"
				        value="<?php echo esc_attr_x( '&#xe804;', 'submit button' ) ?>" />
				</form>
			</div>
		</div><!-- .header-searchFormContainer -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
