tns({
    "container": "#widget-feature-tns",
    "items": 1,
    "swipeAngle": false,
    "speed": 1000,

    navPosition: 'bottom',
    controlsContainer: "#customize-controls",
    mode: 'gallery'
});

/*=== single blog carousel =====*/
tns({
    "container": "#also_like_tns",
    "items": 1,
    responsive: {
        640: {
            edgePadding: 20,
            gutter: 20,
            items: 3
        },
        900: {
            items: 4
        }
    },
    "mouseDrag": true,
    "speed": 400,

    nav: false,
    controls: false,
    "autoplay": true,
    "autoplayHoverPause": true,
    "autoplayTimeout": 4000,
    autoplayButtonOutput: false,
});
