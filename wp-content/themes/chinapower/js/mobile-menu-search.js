/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

( function( $ ) {
	var width = $(window).width();
	// Toggle Search
	$(".searchIcon").click(function() {
		// Show Search
		$(".header-searchFormContainer").slideToggle("fast");
		$(".header-searchInputContainer .search-field").focus();
	});

	window.addEventListener('resize', function(event){
	  width = $(window).width();
	});

} )( jQuery );