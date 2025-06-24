jQuery(document).ready(function($) {
    $('.project-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        infinite: true,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    // Fancybox init (optional, already correct)
    Fancybox.bind('[data-fancybox="gallery"]', {
        Toolbar: true,
        Thumbs: {
            autoStart: false,
        },
    });
});
