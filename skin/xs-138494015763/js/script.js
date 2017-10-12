jQuery(document).ready(function($){
	
	//Dropdown menu
	$('.dropdown-toggle').dropdown();
	
	//Collapse menu
    $('.collapse').collapse({
        toggle: false
    })
	
	// Flexslider
	if($().flexslider) {
		$('.flexslider').flexslider({
			animation: 'slide',
			animationSpeed: Modernizr.touch ? 400 : 1000,
			easing: "swing",
			touch: true,
			controlsContainer: '.flex-container',
			directionNav: true,
			controlNav: false,
			prevText: '<span aria-hidden="true" class="icon-arrow-left-5"></span>',
			nextText: '<span aria-hidden="true" class="icon-arrow-right-5"></span>'
		});
		
		$('#testimonials').flexslider({
			animation: 'slide',
			touch: true,
			directionNav: true,
			controlNav: false,
			smoothHeight: true,
			prevText: '<span aria-hidden="true" class="icon-arrow-left-5"></span>',
			nextText: '<span aria-hidden="true" class="icon-arrow-right-5"></span>'
		});
	}
	
	//Fitvids
	if($().fitVids) {
		$(".unica-video").fitVids();
	}
	
	//Prettyphoto
	if($().prettyPhoto) {
		$("a[data-gal^='prettyPhoto']").prettyPhoto({
			theme: 'pp_default',
			overlay_gallery: false,
			allow_resize: true,
			animation_speed: 'fast',
			social_tools: false
		});
	}
	
	// Validate Form
	if($().validate) {
		$(".contact-form").validate();
	}
	
	//Toggle
	jQuery(".toggle_container").hide();
	jQuery(".toggle").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("slow");
	});
	
	//Tabs
	$(".tab-content").hide(); 
	$(".tabs li:first").addClass("active").show(); 
	$(".tab-content:first").show(); 
	$(".tabs li").click(function() {
		$(".tabs li").removeClass("active");
		$(this).addClass("active"); 
		$(".tab-content").hide(); 
		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn(); 
		return false;
	});
	
	//Scroll to the top
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrolltop').fadeIn();
		} else {
			$('.scrolltop').fadeOut();
		}
	}); 
 
	$('.scrolltop').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});
	

	//magnific gallery
	$('.magnific').each(function() { // the containers for all your galleries should have the class magnific
		$(this).magnificPopup({
			delegate: 'a.gallery', // the container for each your gallery items
			type: 'image',
			gallery:{enabled:true},
			removalDelay: 300,
			mainClass: 'mfp-fade',
			image:  {
				markup: '<div class="mfp-figure">'+
							'<div class="mfp-close"></div>'+
							'<div class="mfp-img"></div>'+
							'<div class="mfp-bottom-bar">'+
							  '<div class="mfp-title"></div>'+
							  '<div class="mfp-counter"></div>'+
							'</div>'+
						  '</div>',			
				titleSrc: 'alt',
			},
			
			callbacks: {
				buildControls: function() {
				// re-appends controls inside the main container
				this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
				}
	
			}

		});
	});	

	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
			|| location.hostname == this.hostname) {

		  var target = $(this.hash);
		  target = target.length ? target : $('[id=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top
			}, 1000);
			return false;
		  }
		}
	  });
});	
});