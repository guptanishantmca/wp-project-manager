jQuery(document).ready(function($) {
    $('.project-slider').slick();
});


jQuery(document).ready(function($) {
    // Optional Fancybox init if you want to customize
    Fancybox.bind('[data-fancybox="gallery"]', {
        Toolbar: true,
        Thumbs: {
            autoStart: false,
        },
    });
});
