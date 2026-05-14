
/* Add class Inview*/

function homepageAnimation() {


    if (jQuery('.site-header').length) {
        jQuery('.site-header').addClass("inView");
    }

    if (jQuery('.welcome-row').length) {
        var fp1content = jQuery('.welcome-row').offset().top - jQuery(window).scrollTop();
        if (fp1content <= jQuery(window).height() - jQuery('.welcome-row').height() * 0.4) {
            jQuery('.welcome-row').addClass("inView");
        }
    }

    if (jQuery('.location-row').length) {
        var fp1content = jQuery('.location-row').offset().top - jQuery(window).scrollTop();
        if (fp1content <= jQuery(window).height() - jQuery('.location-row').height() * 0.4) {
            jQuery('.location-row').addClass("inView");
        }
    }

    if (jQuery('.about-island').length) {
        var fp1content = jQuery('.about-island').offset().top - jQuery(window).scrollTop();
        if (fp1content <= jQuery(window).height() - jQuery('.about-island').height() * 0.4) {
            jQuery('.about-island').addClass("inView");
        }
    }

    if (jQuery('.stay-loop').length) {
        var fp1content = jQuery('.stay-loop').offset().top - jQuery(window).scrollTop();
        if (fp1content <= jQuery(window).height() - jQuery('.stay-loop ').height() * 0.4) {
            jQuery('.stay-loop').addClass("inView");
        }
    }

    if (jQuery('.contact-home').length) {
        var fp1content = jQuery('.contact-home').offset().top - jQuery(window).scrollTop();
        if (fp1content <= jQuery(window).height() - jQuery('.contact-home').height() * 0.4) {
            jQuery('.contact-home').addClass("inView");
        }
    }

    if (jQuery('.home-reviews').length) {
        var fp1content = jQuery('.home-reviews').offset().top - jQuery(window).scrollTop();
        if (fp1content <= jQuery(window).height() - jQuery('.home-reviews').height() * 0.4) {
            jQuery('.review-list').addClass("inView");
        }
    }



}


/*Add transition delay to elements*/

function homepageAnimationOnload() {

    if (jQuery('.site-header .nav-primary ul > li').length) {
        var counter = 0;
        jQuery(".site-header .nav-primary ul > li").each(function() {
            jQuery(this).css("transition-delay", 0.1 * counter + 's');
            counter++;
        });
    }

    if (jQuery('.review-list li').length) {
        var counter = 0;
        jQuery(".review-list li").each(function() {
            jQuery(this).css("transition-delay", 0.1 * counter + 's');
            counter++;
        });
    }

    if (jQuery('.our-services .services-list li').length) {
        var counter = 0;
        jQuery(".our-services .services-list li").each(function() {
            jQuery(this).css("transition-delay", 0.2 * counter + 's');
            counter++;
        });
    }

    if (jQuery('.design-build-process .steps .step').length) {
        var counter = 0;
        jQuery(".design-build-process .steps .step").each(function() {
            jQuery(this).css("transition-delay", 0.4 * counter + 's');
            counter++;
        });
    }

    if (jQuery('.site-footer #contact-us ul li').length) {
        var counter = 0;
        jQuery(".site-footer .contact-us ul li").each(function() {
            jQuery(this).css("transition-delay", 0.3 * counter + 's');
            counter++;
        });
    }


}

/* Run on scroll*/
jQuery(window).scroll(function() {
    homepageAnimation();
});

(function(document, $, undefined) {
    'use strict';
    homepageAnimationOnload();

    homepageAnimation();

})(document, jQuery);