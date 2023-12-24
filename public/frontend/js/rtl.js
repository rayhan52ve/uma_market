(function($) {

    "use strict";

    var owl_testimonial  = $('.owl-testimonial'),
		team_carousel        = $('.team-carousel'),
		blog_carousel        = $('.blog-carousel'),
		brand_carousel       = $('.brand-carousel');

    	// Testimonial 
	owl_testimonial.owlCarousel({
		rtl:true,
        loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		margin: 30,
		dots: true,
		nav: false,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			460: {
				items: 1
            },
			768: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

    // Team 
	team_carousel.owlCarousel({
        rtl:true,
		loop: false,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1,
				nav: false
			},
			540: {
				items: 2,
				nav: false
			},
			991: {
				items: 3,
                nav: false
			},
			1199: {
				items: 4,
                nav: false
			}
		}
	});
        
    // Blog
	blog_carousel.owlCarousel({
		rtl:true,
        loop: false,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: false,
		dots: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 2
			},
			991: {
				items: 3
			},
			1200: {
				items: 3
			}
		}
	});
	// Brand
	brand_carousel.owlCarousel({
        rtl:true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 2
			},
			750: {
				items: 3
			},
			991: {
				items: 3
			},
			1200: {
				items: 4
			}
		}
	});

})(jQuery);