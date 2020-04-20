! function($) {
    "use strict";

    var Zeeko = function() {};

    //scroll
    Zeeko.prototype.initSticky = function() {
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();

                if (scroll >= 40) {
                    $(".navbar-sticky").addClass("darkheader");
                } else {
                    $(".navbar-sticky").removeClass("darkheader");
                }
            });
        },

        Zeeko.prototype.initAnimatedScrollMenu = function() {
            $('.navigation-menu a').on('click', function(event) {
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top - 0
                }, 1500, 'easeInOutExpo');
                event.preventDefault();
            });
        },

        Zeeko.prototype.initOwlCarousel = function() {
            $("#owl-demo").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items: 1,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3]
            });
        },

        Zeeko.prototype.initMainMenu = function() {
            var scroll = $(window).scrollTop();

            $('.navbar-toggle').on('click', function(event) {
                $(this).toggleClass('open');
                $('#navigation').slideToggle(400);
            });

            $('.navigation-menu>li').slice(-2).addClass('last-elements');

            $('.menu-arrow,.submenu-arrow').on('click', function(e) {
                if ($(window).width() < 992) {
                    e.preventDefault();
                    $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
                }
            });
        },

        Zeeko.prototype.initScrollspy = function() {
            $("#navigation").scrollspy({
                offset: 50
            });
        },

        Zeeko.prototype.initVideo = function() {
            $('.video-play-icon').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        },

        Zeeko.prototype.initSwiper = function() {
            var swiper = new Swiper('.swiper-container', {
                effect: 'coverflow',
                loop: true,
                centeredSlides: true,
                slidesPerView: 2,
                initialSlide: 3,
                keyboardControl: true,
                mousewheelControl: true,
                lazyLoading: true,
                preventClicks: false,
                preventClicksPropagation: false,
                lazyLoadingInPrevNext: true,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                coverflow: {
                    rotate: 0,
                    depth: 200,
                    modifier: 1,
                    slideShadows: false,
                    slidesPerView: 3,
                }
            });
        },

        Zeeko.prototype.initContact = function() {
            $('#contact-form').submit(function() {
                var action = $(this).attr('action');
                $("#message").slideUp(750, function() {
                    $('#message').hide();

                    $('#submit')
                        .before('')
                        .attr('disabled', 'disabled');

                    $.post(action, {
                            name: $('#name').val(),
                            email: $('#email').val(),
                            comments: $('#comments').val(),
                        },
                        function(data) {
                            document.getElementById('message').innerHTML = data;
                            $('#message').slideDown('slow');
                            $('#cform img.contact-loader').fadeOut('slow', function() {
                                $(this).remove()
                            });
                            $('#submit').removeAttr('disabled');
                            if (data.match('success') != null) $('#cform').slideUp('slow');
                        }
                    );

                });

                return false;

            });
        },

        Zeeko.prototype.init = function() {
            this.initSticky();
            this.initAnimatedScrollMenu();
            this.initOwlCarousel();
            this.initMainMenu();
            this.initScrollspy();
            this.initVideo();
            this.initSwiper();
            this.initContact();

        },
        //init
        $.Zeeko = new Zeeko, $.Zeeko.Constructor = Zeeko
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.Zeeko.init();
}(window.jQuery);