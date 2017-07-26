/**
 * Post Navigation
 * Toggles Sections of Post Navigation: Share & Jump To
 */

( function( $ ) {
	if($(".post-nav").length) {
		// Stick Menu on scroll
		var postNavPosType = $(".post-nav").css("position");

		// Only do this on desktop
		if(postNavPosType != "fixed") {
			var postNavPos = $(".post-nav").offset().top;
			var headerHeight = $(".site-header").height() + parseInt($('.site-header').css('top'), 10);
			$(window).scroll(function(){
				var currentScroll = $(this).scrollTop();
				  
				if(currentScroll >= postNavPos - headerHeight){
			    	$(".post-nav").css({"position": "fixed", "top": headerHeight - 50});
				}
				else {
					$(".post-nav").css({"position": "relative", "top": 0});
				}
				
			});
		}

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

			// Add class if viewing jump to
			if(ID == "#jump" && !$(".post-nav-menu").hasClass("alignTop")) {
				$(".post-nav-menu").addClass("alignTop");
			}
			else {
				$(".post-nav-menu").removeClass("alignTop");
			}

			// Display Content on Mobile
			if($(".post-nav-content").hasClass("hidden-xs")) {

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
		  postNavPosType = $(".post-nav").css("position");
		  postNavPos = $(".post-nav").offset().top;
		});
		
	}

} )( jQuery );