/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

( function( $ ) {
	var width = $(window).width();
	var mobileDisplay = $(".main-navigationControl").css("display");
	var headerHeightInitial = $(".site-header").height() + parseInt($(".site-header").css("top"), 10);

	// Open Mobile Menu
	$(".main-navigationControl").click(function() {
		$("body").addClass("menu-mobile-active");
		$(".site-branding").hide();
		$(".main-navigationControl").hide();
		$(".header-navOverlay").show("fast");
		$(".navOverlay-heading-menu").show();
		$(".main-navigation").show();
		$(".site-header").addClass("overlay-isActive");
	});

	// Close Mobile Menu
	$(".navOverlay-heading .icon-close-x").click(function() {
		$("body").removeClass("menu-mobile-active");
		$(".site-branding").show();
		$(".main-navigationControl").show();
		$(".header-navOverlay").hide("fast");
		$(".main-navigation").hide();
		$(".site-header").removeClass("overlay-isActive");
		$(".header-searchFormContainer").hide();
		$(".navOverlay-heading-search").hide();
	});

	// Open Search
	$(".header-navOverlay .icon-search").click(function() {
		$(".navOverlay-heading-menu").hide();
		$(".navOverlay-heading-search").css("display","flex");
		$(".header-searchFormContainer").show();
		$(".main-navigation").hide();
	});

	// Back from Search
	$(".header-navOverlay .search-back").click(function() {
		$(".navOverlay-heading-menu").show();
		$(".navOverlay-heading-search").hide();
		$(".header-searchFormContainer").hide();
		$(".main-navigation").show();
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
		var headerHeight = $(".site-header").height() + parseInt($(".site-header").css("top"), 10);
		  
		if(currentScroll > 0){
	    	$(".header-main").addClass("minimal");
	    	$(".header-main .sub-menu-container").css("top",headerHeight);
		}
		else {
			$(".header-main").removeClass("minimal");
			$(".header-main .sub-menu-container").css("top",headerHeightInitial);
		}
		
	});


	window.addEventListener('resize', function(event){
	  width = $(window).width();
	  mobileDisplay = $(".main-navigationControl").css("display");
	});

} )( jQuery );