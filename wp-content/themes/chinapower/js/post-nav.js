/**
 * Post Navigation
 * Toggles Sections of Post Navigation: Share & Jump To
 */

( function( $ ) {
	if($(".post-nav").length) {

		// Stick Menu on scroll
		var postNavPos = $(".post-nav").offset().top;
		var headerHeight;
		$(window).scroll(function(){
			var currentScroll = $(this).scrollTop();
			if(!headerHeight) {
				console.log("caulcate");
				headerHeight = $(".site-header").height() + parseInt($('.site-header').css('top'), 10);
			}
			  
			if(currentScroll >= postNavPos - headerHeight){
		    	$(".post-nav").css({"position": "fixed", "top": headerHeight});
			}
			else {
				$(".post-nav").css({"position": "relative", "top": 0});
			}
			
		});

		// Switch between panels
		$(".post-nav-menu a").click(function() {
			var ID = "#"+$(this).attr('id');
			var panel = "."+$(this).data('panel');
			
			// Toggle Active Class
			$(".post-nav-menu a").not(ID).removeClass("active");
			$(ID).toggleClass("active");

			// Toggle Active Panel or restore default panel
			$(".post-nav-content div").not(panel).removeClass("active");
			$(panel).toggleClass("active");
			if(!$(".post-nav-menu a.active").length) {
				$(".post-nav-content .js-isDefault").addClass("active");
			}
		});

		// Create Table of Contents
		var counter = 0;
		$(".entry-content h2").each(function() {
			var text = $(this).text();

			// Add ID to element
			$(this).attr('id', counter);

			// Add to Table of Contents
			var listItem = '<li><a href="#'+counter+'">'+text+'</a></li>';
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
		
	}

} )( jQuery );