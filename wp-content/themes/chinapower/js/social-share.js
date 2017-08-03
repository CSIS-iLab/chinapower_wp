/**
 * Social Share Component
 * If a component is embedded into a page and has a share functionality, use JS to show the icons on the user's click.
 */

( function( $ ) {
	if($(".sharing-inline").length) {

		var shareTopPos;

		$(".sharing-inline .sharing-openShareBtn, .sharing-inline .icon-close-x").click(function(event) {
			var parent = $(this).parents(".sharing-inline");
			$(parent).find(".sharing-shareBtns").toggleClass("isVisible");
			$(parent).find(".sharing-openShareBtn").toggleClass("isHidden");

			if($(".post-nav-content").css("display") != "flex") {
				// If we're on mobile, store the position of the clicked share button so we can scroll back to it when the user closes the overlay
				if($(this).hasClass('sharing-openShareBtn')) {
					shareTopPos = $(this).offset().top;
				}

				$(".post-nav-content").toggleClass("isVisible");
				$(".post-nav").toggleClass("overlay-isActive");
				$(".post-nav a#share").parent("li").toggleClass("active");
				$(parent).toggleClass("overlay-isActive");
				$("html, body").toggleClass("overlay-isActive");
				$(".site-header").toggleClass("postnav-overlay-isActive");
			}

		});

		// Detect close click
		$(".post-nav-menu .closePanel").click(function() {
			if(shareTopPos) {
				window.scrollTo(0, shareTopPos);
				shareTopPos = '';
			}
		});
	};

} )( jQuery );