/**
 * Social Share Component
 * If a component is embedded into a page and has a share functionality, use JS to show the icons on the user's click.
 */

( function( $ ) {
	if($(".sharing-inline").length) {

		$(".sharing-inline .sharing-openShareBtn, .sharing-inline .icon-close-x").click(function() {
			var parent = $(this).parents(".sharing-inline");
			console.log(parent);
			$(parent).find(".sharing-shareBtns").toggleClass("isVisible");
			$(parent).find(".sharing-openShareBtn").toggleClass("isHidden");
		});
		// $(".sharing-inline .icon-close-x").click(function() {
		// 	$(this).prev().removeClass("isHidden");
		// 	$(this).addClass("isHidden");
		// });
	};

} )( jQuery );