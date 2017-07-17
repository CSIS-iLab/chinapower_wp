/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

( function( $ ) {
	var width = $(window).width();
	console.log("test");

	// Add class to header
	$(window).scroll(function(){
		var currentScroll = $(this).scrollTop();
		console.log("scroll");
		  
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
	});

} )( jQuery );