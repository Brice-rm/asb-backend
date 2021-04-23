(function ($) {
    $('.owl-carousel').owlCarousel({
        items: 4,
        margin: 30,
        autoplay: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 2,
                margin: 30
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
    $('.owl-carousel1').owlCarousel({
        items: 3,
        margin: 30,
        autoplay: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            750: {
                items: 2,
                margin: 30
            },
            992: {
                items: 3
            }
        }
    });

})(jQuery);