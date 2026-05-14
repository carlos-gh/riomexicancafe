    (function($) {

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 150) {
                $("header.site-header").addClass("stickyHeader");
            } else {
                $("header.site-header").removeClass("stickyHeader");
            }

        });

        $(document).scroll(function(){
            if($(this).scrollTop() >= $('.home-rows').offset().top - 50) {
                $(".home-booking-form").addClass("stickyform");
            } else {
                $(".home-booking-form").removeClass("stickyform");
            }
        });


        jQuery(document).ready(function( $ ) {


            /**
             * MENU
             */
            $('#toggle-menu').on('click', function(e){
                e.preventDefault()
                $('.mobile-menu').slideToggle();
            });


        });

    })( jQuery );