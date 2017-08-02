/**
 * Social Share Component
 * If a component is embedded into a page and has a share functionality, use JS to show the icons on the user's click.
 */

( function( $ ) {
	if($(".sharing-inline").length) {

		$(".sharing-inline .sharing-openShareBtn, .sharing-inline .icon-close-x").click(function() {
			var parent = $(this).parents(".sharing-inline");
			$(parent).find(".sharing-shareBtns").toggleClass("isVisible");
			$(parent).find(".sharing-openShareBtn").toggleClass("isHidden");

			if($(".post-nav-content").css("display") != "flex") {
				$(".post-nav-content").toggleClass("isVisible");
				$(".post-nav").toggleClass("overlay-isActive");
				$(".post-nav a#share").parent("li").toggleClass("active");
				$(parent).toggleClass("overlay-isActive");
				$("html, body").toggleClass("overlay-isActive");
				$(".site-header").toggleClass("postnav-overlay-isActive");
			}

		});
	};

} )( jQuery );