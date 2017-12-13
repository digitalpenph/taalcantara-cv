jQuery('.carousel-area-wrap').slick({
    infinite: true,
    speed: 400,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 10000,
    slidesToShow: 3,
    centerMode: true,
    responsive: [{
            breakpoint: 979,
            settings: {
                slidesToShow: 2,
                centerMode: true,
            }

        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },

    ]

});