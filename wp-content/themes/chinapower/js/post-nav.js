/**
 * Post Navigation
 * Toggles Sections of Post Navigation: Share & Jump To
 */

( function( $ ) {
	if($(".post-nav").length) {

		// Switch between panels
		$(".post-nav-menu a, .closePanel").click(function() {
			var ID = "#"+$(this).attr('id');
			var panel = "."+$(this).data('panel');
			
			// Toggle Active Class
			$(".post-nav-menu a").not(ID).parent().removeClass("active");
			$(ID).parent().toggleClass("active");

			// Toggle Active Panel or restore default panel
			$(".post-nav-content div").not(panel).removeClass("active");
			$(panel).toggleClass("active");
			if(!$(".post-nav-menu li.active").length) {
				$(".post-nav-content .js-isDefault").addClass("active");
			}

			// Add class if viewing jump to
			if(ID == "#jump" && !$(".post-nav-menu").hasClass("alignTop")) {
				$(".post-nav-menu").addClass("alignTop");
			}
			else {
				$(".post-nav-menu").removeClass("alignTop");
			}

			// Display Content on Mobile
			if($(".post-nav-content").css("display") != "flex") {
				$(".post-nav-content").toggleClass("isVisible");
				$("body").toggleClass("overlay-isActive");
				$(".site-header").toggleClass("postnav-overlay-isActive");
				$(".post-nav").toggleClass("overlay-isActive");
			}
		});

		// Close Menu on Back to Top
		$(".post-nav-toTop a").click(function() {
			$(".post-nav-menu li, .post-nav-content .active").removeClass("active");
			$(".post-nav-menu").removeClass("alignTop");
			$(".post-nav-content .js-isDefault").addClass("active");

			if($(".post-nav").hasClass("overlay-isActive")) {
				$(".post-nav-content").toggleClass("isVisible");
				$("body").toggleClass("overlay-isActive");
				$(".site-header").toggleClass("postnav-overlay-isActive");
				$(".post-nav").toggleClass("overlay-isActive");
			}
		});

		// Close Overlay on ToC Link
		$(".post-nav-toc").on("click", "a", function() {
			console.log("test");
			if($(".post-nav").hasClass("overlay-isActive")) {
				$(".post-nav-content").toggleClass("isVisible");
				$("body").toggleClass("overlay-isActive");
				$(".site-header").toggleClass("postnav-overlay-isActive");
				$(".post-nav").toggleClass("overlay-isActive");
				$(".post-nav-menu li").removeClass("active");
				$(".post-nav-menu").removeClass("alignTop");
				$(".post-nav-content div.active").removeClass("active");
			}
		});

		// Create Table of Contents
		var counter = 0;
		$(".entry-content h2").each(function() {
			var text = $(this).text();
			var ID = $(this).attr('id');
			var hash;

			if(ID) {
				hash = ID;
			}
			else {
				hash = "toc-"+counter;
				//Add ID to element
				$(this).attr('id', hash);
			}

			// Add to Table of Contents
			var listItem = '<li><a href="#'+hash+'">'+text+'</a></li>';
			$(".post-nav-toc").append(listItem);

			// Increase Counter
			counter++;
		});

		// Active Table of Contents Link on click
		$(".post-nav-toc").on("click", "li a", function() {
			$(".post-nav-toc a").removeClass("active");
			$(this).addClass("active");
		})

		// Active Table of Contents Link on scroll
		var $sections = $('.entry-content h2');

		$(window).scroll(function(){

			var currentScroll = $(this).scrollTop();
			var currentSection = 0;

			$sections.each(function(){   
				var headingPosition = $(this).offset().top;
			  
				if( headingPosition - 1 < currentScroll ){
			    	currentSection = $(this).attr('id');
				}

				$('.post-nav-toc a').removeClass('active');
				$(".post-nav-toc a[href=#"+currentSection+"]").addClass('active');
			});

		});

		window.addEventListener('resize', function(event){

		});
		
	}

} )( jQuery );