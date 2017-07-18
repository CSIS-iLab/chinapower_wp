/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

( function( $ ) {
	var width = $(window).width();
	var mobileDisplay = $(".main-navigationControl").css("display");

	// Open Mobile Menu
	$(".main-navigationControl, .navOverlay-heading .icon-close-x").click(function() {
		$("body").toggleClass("menu-mobile-active");
		$(".site-branding").toggle();
		$(".main-navigationControl").toggle();
		$(".header-navOverlay").toggle("fast");
		$(".main-navigation").toggle();
		$(".site-header").toggleClass("overlay-isActive");
	});

	// Disable the dropdown menu on mobile
	if(mobileDisplay != "none") {
		$(".menu-item-has-children > a").click(function(e) {
			e.preventDefault();
			$(this).siblings(".sub-menu-container").toggle();
		});
	}

	// Add class to header on scroll
	$(window).scroll(function(){
		var currentScroll = $(this).scrollTop();
		  
		if(currentScroll > 0){
	    	$(".header-main").addClass("minimal");
		}
		else {
			$(".header-main").removeClass("minimal");
		}
		
	});

	// Toggle Search
	$(".searchIcon").click(function() {
		// Show Search
		$(".header-searchFormContainer").slideToggle("fast");
		$(".header-searchInputContainer .search-field").focus();
	});

	window.addEventListener('resize', function(event){
	  width = $(window).width();
	  mobileDisplay = $(".main-navigationControl").css("display");
	});

} )( jQuery );