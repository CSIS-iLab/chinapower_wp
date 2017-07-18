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
				<div class="site-branding col-xs-6 col-md-5">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="/wp-content/themes/chinapower/img/chinapower-logo-main.svg" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="logo-main">
						<img src="/wp-content/themes/chinapower/img/china-power-symbol.svg" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="logo-mobile">
						<span class="site-tagline"><?php bloginfo( 'description' ); ?></span>
					</a>
				</div><!-- .site-branding -->
				<div class="main-navigationContainer col-xs-6 col-md-7">
					<button class="main-navigationControl" type="button" aria-label="Menu" aria-controls="navigation">
						<span></span>
					</button>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'walker'         => new WPSE_78121_Sublevel_Walker
							) );
						?>
						<ul class="nav-socialContainer">
							<?php if(get_theme_mod('contact-facebook')) {
								echo '<li><a href="https://www.facebook.com/'.get_theme_mod('contact-facebook').'" target="_blank"><i class="icon icon-facebook"></i> <span>/'.get_theme_mod('contact-facebook').'</a></li>';
							} ?>
							<?php if(get_theme_mod('contact-twitter')) {
								echo '<li><a href="https://www.twitter.com/'.get_theme_mod('contact-twitter').'" target="_blank"><i class="icon icon-twitter"></i> <span>@'.get_theme_mod('contact-twitter').'</a></li>';
							} ?>
							<?php if(get_theme_mod('contact-email')) {
								echo '<li><a href="mailto:'.get_theme_mod('contact-email').'"><i class="icon icon-email-share"></i> <span>'.get_theme_mod('contact-email').'</a></li>';
							} ?>
						</ul><!-- .nav-socialContainer -->
					</nav><!-- #site-navigation -->
				</div>
			</div><!-- .content-wrapper -->
		</div><!-- .site-header -->
		<div class="header-searchFormContainer">
			<div class="content-wrapper row">
				<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
					<input type="submit" class="search-submit"
				        value="<?php echo esc_attr_x( '&#xe80a;', 'submit button' ) ?>" />
				    <label>
				        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
				        <input type="search" class="search-field"
				            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
				            value="<?php echo get_search_query() ?>" name="s"
				            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
				    </label>
				</form>
			</div>
		</div><!-- .header-searchFormContainer -->
		<div class="header-navOverlay">
			<div class="navOverlay-heading">
				<div class="navOverlay-heading-menu content-wrapper row flex-center__y">
					<div class="col-xs-2"><i class="icon icon-close-x" aria-label="Close" aria-controls="navigation"></i></div>
					<div class="col-xs-8">Menu</div>
					<div class="col-xs-2"><i class="icon icon-search"></i></div>
				</div>
				<div class="navOverlay-heading-search content-wrapper row flex-center__y">
					<div class="search-back col-xs-3"><i class="icon icon-left"></i> Back</div>
					<div class="col-xs-6">Search</div>
					<div class="col-xs-3"><i class="icon icon-close-x" aria-label="Close" aria-controls="navigation"></i></div>
				</div>
			</div>
			<div class="navOverlay-content"></div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
