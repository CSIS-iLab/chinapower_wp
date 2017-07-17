<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chinapower
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-logoContainer">
			<div class="content-wrapper row">
				<div class="footer-logo col-xs-12 col-md-8">
					<a href="https://www.csis.org" target="_blank"><img src="/wp-content/themes/chinapower/img/csis-cpp-logo-white.svg" title="Center for Strategic & International Studies" alt="Center for Strategic & International Studies" /></a>
				</div>
				<div class="footer-social col-xs-12 col-md-4">
					<?php if(get_theme_mod('contact-facebook')) {
						echo '<a href="https://www.facebook.com/'.get_theme_mod('contact-facebook').'" target="_blank"><i class="icon icon-facebook"></i></a>';
					} ?>
					<?php if(get_theme_mod('contact-twitter')) {
						echo '<a href="https://www.twitter.com/'.get_theme_mod('contact-twitter').'" target="_blank"><i class="icon icon-twitter"></i></a>';
					} ?>
					<?php if(get_theme_mod('contact-email')) {
						echo '<a href="mailto:'.get_theme_mod('contact-email').'"><i class="icon icon-email-contact"></i></a>';
					} ?>
				</div>
			</div>
		</div>
		<div class="footer-infoContainer">
			<div class="content-wrapper row">
				<div class="footer-info col-xs-12 col-md-4">
					<?php if(get_theme_mod('footer-site')) {
						echo '<p>'.get_theme_mod('footer-site').'</p>';
					} ?>
				</div>
				<div class="footer-contact col-xs-12 col-md-4">
					<?php if(get_theme_mod('contact-address')) {
						echo '<h3>China Power Project</h3>';
						echo '<address>'.get_theme_mod('contact-address').'</address>';
					} ?>
					<?php if(get_theme_mod('contact-email')) {
						echo '<a href="mailto:'.get_theme_mod('contact-email').'" class="btn btn-blue">Contact Us <i class="icon icon-arrow-right"></i></a>';
					} ?>
				</div>
				<div class="footer-newsletter col-xs-12 col-md-4">
					<?php if(get_theme_mod('footer-newsletter')) {
						echo '<h3>Newsletter</h3>';
						echo '<p>'.get_theme_mod('footer-newsletter').'</p>';
					} ?>
					<?php if(get_theme_mod('newsletter-signup')) {
						echo '<a href="'.get_theme_mod('newsletter-signup').'" class="btn btn-blue" target="_blank">Sign Up <i class="icon icon-arrow-right"></i></a>';
					} ?>
				</div>
			</div>
			<div class="footer-copyright content-wrapper">
				<p>&copy; <?php echo date('Y'); ?> by the Center for Strategic and International Studies. All rights reserved.</p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
