/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

( function( $ ) {
	var width = $(window).width();
	var mobileDisplay = $(".main-navigationControl").css("display");
	var headerHeightInitial = $(".site-header").height() + parseInt($(".site-header").css("top"), 10);

	// Open Mobile Menu
	$(".main-navigationControl").click(function(event) {
		$("html, body, .site-header").addClass("overlay-isActive");
		$(".site-branding, .main-navigationControl").addClass("isHidden");
		$(".header-navOverlay, .main-navigation").addClass("isVisible");
	});

	// Close Mobile Menu
	$(".navOverlay-heading .icon-close-x").click(function(event) {
		$("html, body, .site-header").removeClass("overlay-isActive");
		$(".site-branding, .main-navigationControl, .navOverlay-heading-menu").removeClass("isHidden");
		$(".header-navOverlay, .main-navigation, .header-searchFormContainer, .navOverlay-heading-search").removeClass("isVisible");
	});

	// Desktop: Search
	$(".site-header .searchIcon, .site-header .search-close .icon").click(function(event) {
		$(".header-searchFormContainer").toggleClass("isVisible");
		$(".search-field").focus();
	});

	// Mobile: Open Search
	$(".header-navOverlay .icon-search").click(function(event) {
		$(".navOverlay-heading-menu").addClass("isHidden");
		$(".navOverlay-heading-search, .header-searchFormContainer").addClass("isVisible");
		$(".main-navigation").removeClass("isVisible");
		$(".search-field").focus();
	});

	// Mobile: Back from Search
	$(".header-navOverlay .search-back").click(function(event) {
		$(".navOverlay-heading-menu").removeClass("isHidden");
		$(".navOverlay-heading-search, .header-searchFormContainer").removeClass("isVisible");
		$(".main-navigation").addClass("isVisible");
	});

	// Disable the dropdown menu on mobile
	if(mobileDisplay != "none") {
		$(".menu-item-has-children > a").click(function(e) {
			$(this).siblings(".sub-menu-container").toggleClass("isVisible");
			e.preventDefault();
		});
	}

	// If we're on a post page, add a class to the post nav
	if($(".post-nav").length) {
		var postNavTopPos = parseInt($(".post-nav").css("top"));
		var postNavOffset = $(".post-nav").offset().top;
		var postNavTriggerPoint = postNavOffset - postNavTopPos - 50;
	}

	// Add Class to Prev Sibling on hover
	$( "#primary-menu li.menu-item-has-children" ).hover(
	  function() {
	  	$(this).addClass("active");
	    $(this).prev().addClass("sibHover");
	  }, function() {
	  	$(this).removeClass("active");
	    $(this).prev().removeClass("sibHover");
	  }
	);

	// Add class to header on scroll
	$(window).scroll(function(){
		var currentScroll = $(this).scrollTop();
		var headerHeight = $(".site-header").height() + parseInt($(".site-header").css("top"), 10);


		if(currentScroll > 0){
	    	$(".site-header").addClass("minimal");
	    	$(".header-main .sub-menu-container").css("top",headerHeight);

	    	// If we're on a post page, add a class to the post nav
			if($(".post-nav").length) {
				if(currentScroll >= postNavTriggerPoint) {
					$(".post-nav").addClass("shadow");
				}
				else {
					$(".post-nav").removeClass("shadow");
				}
			}
		}
		else {
			$(".site-header").removeClass("minimal");
			$(".header-main .sub-menu-container").css("top",headerHeightInitial);
		}

	});


	window.addEventListener('resize', function(event){
	  width = $(window).width();
	  mobileDisplay = $(".main-navigationControl").css("display");
	});

} )( jQuery );
