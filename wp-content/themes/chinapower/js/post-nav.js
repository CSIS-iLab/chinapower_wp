/**
 * Post Navigation
 * Toggles Sections of Post Navigation: Share & Jump To
 */

( function( $ ) {
	if($(".post-nav").length) {

		var shareTopPos;

		// Switch between panels
		$(".post-nav-menu a, .closePanel").click(function() {
			var ID = "#"+$(this).attr('id');
			var panel = "."+$(this).data('panel');
			
			// Toggle Active Class
			$(".post-nav-menu a").not(ID).parent("li").removeClass("active");
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

				// Set shareTopPos so we scroll back to where we were on mobile
				if($(this).attr('id')) {
					shareTopPos = $(this).offset().top;
				}

				$(".post-nav-content").toggleClass("isVisible");
				$("body, html").toggleClass("overlay-isActive");
				$(".site-header").toggleClass("postnav-overlay-isActive");
				$(".post-nav").toggleClass("overlay-isActive");
				$(".sharing-inline").removeClass("overlay-isActive");
				$(".sharing-shareBtns").removeClass("isVisible");
				$(".sharing-openShareBtn").removeClass("isHidden");
			}
		});

		// Detect close click & scroll back to position on mobile
		$(".post-nav-menu .closePanel").click(function() {
			if(shareTopPos) {
				window.scrollTo(0, shareTopPos);
				shareTopPos = '';
			}
		});

		// Close Menu on Back to Top
		$(".post-nav-toTop a").click(function() {
			$(".post-nav-menu li, .post-nav-content .active").removeClass("active");
			$(".post-nav-menu").removeClass("alignTop");
			$(".post-nav-content .js-isDefault").addClass("active");

			if($(".post-nav").hasClass("overlay-isActive")) {
				$(".post-nav-content").toggleClass("isVisible");
				$("body, html").toggleClass("overlay-isActive");
				$(".site-header").toggleClass("postnav-overlay-isActive");
				$(".post-nav").toggleClass("overlay-isActive");
			}
		});

		// Close Overlay on ToC Link
		$(".post-nav-toc").on("click", "a", function() {
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

			var linkClass = '';
			if(counter == 0) {
				linkClass = ' class="active"';
			}

			// Add to Table of Contents
			var listItem = '<li><a href="#'+hash+'" id="link-'+hash+'"'+linkClass+'>'+text+'</a></li>';
			$(".post-nav-toc").append(listItem);

			// Increase Counter
			counter++;
		});

		// Active Table of Contents Link on click
		$(".post-nav-toc").on("click", "li a", function() {
			$(".post-nav-toc a.active").removeClass("active");
			$(this).addClass("active currentScroll");
		})

		// Active Table of Contents Link on scroll
		var $sections = $('.entry-content h2');

		$(window).scroll(function(){

			var currentScroll = $(this).scrollTop();
			var currentSection = 'toc-0';

			$sections.each(function(){   
				var headingPosition = $(this).offset().top;
				var headerHeight = parseInt($(".site-header").css("top")) + 75;
	      		var postNav = $(".post-nav").height();
	      		var sectionHeading = headingPosition - headerHeight - postNav;
			  
			  	// Switch active table of content link based on which section the user is in. However, don't run this if the user clicked on a link to prevent the scroll classes from overriding the clicked classes
				if( sectionHeading - 1 < currentScroll && !$(".post-nav-toc a").hasClass('currentScroll') ){
			    	currentSection = $(this).attr('id');

					$('.post-nav-toc a').not('#link-'+currentSection).removeClass('active');
					$("#link-"+currentSection).addClass('active');
				}

			});

		});

		// Close menu if user clicks outside of the menu container element and the menu is open
		$(document).click(function(event) { 
		  if(!$(event.target).closest('.post-nav').length) {
		      if($('.post-nav-jumpto').hasClass('active')) {
		        // Close Jump to Menu
				$(".post-nav-menu li, .post-nav-content .active").removeClass("active");
				$(".post-nav-menu").removeClass("alignTop");
				$(".post-nav-content .js-isDefault").addClass("active");
		      }
		  }        
		});
		
	}

} )( jQuery );