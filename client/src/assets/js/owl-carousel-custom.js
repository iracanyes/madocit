jQuery(document).ready(function($) {

    /* Carousel with rows */
    var owlHome1 = $('div.owl-rows');
    owlHome1.owlCarousel({
        loop:true,
        nav:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            960:{
                items:1
            },
            1200:{
                items:1
            }
        }
    });
    /* Mouse wheel */
    owlHome1.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });

    /* Carousel Home 2: Recent Posts */
    var owlHome2 = $('#owl-home-2');
    owlHome2.owlCarousel({
        loop:true,
        nav:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            960:{
                items:3
            },
            1200:{
                items:3
            }
        }
    });
    /* Mouse wheel */
    owlHome2.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });

    /* Carousel Home 3: Recent Posts */
    var owlHome1 = $('#owl-home-3');
    owlHome1.owlCarousel({
        loop:true,
        nav:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            960:{
                items:3
            },
            1200:{
                items:3
            }
        }
    });
    /* Mouse wheel */
    owlHome1.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });
    /* Deuxième écriture
    var owl1 = $("#owl-carousel-1");
    owl1.owlCarousel({
        items : 3,
        itemsDesktop : [992,3],
        itemsDesktopSmall : [768,2],
        itemsTablet: [480,2],
        itemsMobile : [320,1],
    });
    */


    // les 2 lignes sont inutiles
    //$(".owl-carousel-1 +.customNavigation > .next").click(function(){ owl2.trigger('owl.next'); });
    //$(".owl-carousel-1 +.customNavigation > .prev").click(function(){ owl2.trigger('owl.prev'); });

    $('.latest-blog-posts .thumbnail.item').matchHeight();



});