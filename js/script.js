jQuery(function($) {
    $(document).ready(function() {
        function pdp_sticky_header(){
            if(window.matchMedia("(max-width: 800px)").matches){
                let prevScroll = window.scrollY || document.scrollTop;
                let curScroll;
                let direction = 0;
                let prevDirection = 0;

                let checkScroll = function() {
                    curScroll = window.scrollY || document.scrollTop;

                    if(curScroll > 105){
                        document.querySelector('.main-header').classList.add('fixed');
                    }
                    else if(curScroll < 105){
                        document.querySelector('.main-header').classList.remove('fixed');
                    }

                    if(curScroll > prevScroll){
                        direction = 2;
                    }
                    else if(curScroll < prevScroll){
                        direction = 1;
                    }

                    if(direction !== prevDirection){
                        toggleHeader(direction, curScroll);
                    }

                    prevScroll = curScroll;
                };

                var toggleHeader = function(direction, curScroll) {
                    if(direction === 2 && curScroll > 105){
                        document.querySelector('.main-header').classList.remove('active');
                        prevDirection = direction;
                    }
                    else if(direction === 1){
                        document.querySelector('.main-header').classList.add('active');
                        prevDirection = direction;
                    }
                };

                window.addEventListener('scroll', checkScroll);
            }
        }

        pdp_sticky_header();

        function pdp_sticky_buttons(){
            if($('.sticky-btns').length){
                $(document).on('scroll', function(){
                    let current_scroll = window.scrollY || document.scrollTop;
                    if(current_scroll > 500){
                        $('.sticky-btns').addClass('active');
                    }
                    else{
                        $('.sticky-btns').removeClass('active');
                    }
                })
            }
        }

        pdp_sticky_buttons();

        function pdp_init_services_slider(){
            if($('body:not(.page-template-pricelist) .service-categories').length){
                let parseURLs = function(salonId){
                    $('.service-category__inner > a').each(function(i){
                        $(this).attr('href', pdp.booking_url + '?salonId=' + salonId + '&cat=' + $(this).data('category') );
                    });
                }

                parseURLs(49);

                if(/android|ip(hone|od|ad)/i.test(navigator.userAgent)){
                    $('.service-categories__salon-switcher select').on('change', function(){
                        parseURLs($(this).val());
                    });
                }
                else{
                    $('.service-categories__salon-switcher select').on('selectric-change', function(event, element, selectric){
                        parseURLs(element.value);
                    });
                }
            }
        }

        pdp_init_services_slider();

        function pdp_init_anchor_smooth_scroll(){
            $(document).on('click', 'a[href^="#"]', function (event) {
                event.preventDefault();

                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top - 100
                }, 500);
            });
        }

        pdp_init_anchor_smooth_scroll();

        function pdp_init_selectric(){
            if($('.selectric').length){
                $('.selectric').selectric();
            }
        }

        pdp_init_selectric();

        function pdp_init_modals(){
            MicroModal.init({
                disableScroll: true,
                awaitOpenAnimation: true,
                awaitCloseAnimation: true
            });
        }

        pdp_init_modals();

        function pdp_init_accordions(){
            if($('.accordion').length){
                $('.accordion__item-header').click(function(){
                    if($(this).parent().hasClass('active')){
                        $(this).parent().removeClass('active');
                    }
                    else{
                        $(this).parent().parent().find('.accordion__item.active').removeClass('active');
                        $(this).parent().addClass('active');
                    }
                });
            }
        }

        pdp_init_accordions();


        function pdp_init_hero_slider(){
            if($('.hero:not(.hero_about-us, .hero_school)').length){
                const swiper = new Swiper('.hero .swiper-container', {
                    direction: 'horizontal',
                    loop: true,
                    centeredSlides: true,
                    effect: 'flip',
                    pagination: {
                        el: '.swiper-pagination',
                    }
                });
            }
        }

        pdp_init_hero_slider();

        function pdp_init_sliders(){
            if(!$('body').hasClass('elementor-page') && $('.service-categories__slider, .salons-slider').length){
                $('.service-categories__slider, .salons-slider').each(function(i){
                    let offset = $(this).offset().left;
                    $(this).width('calc(100vw - ' + offset + 'px)');

                    let item_width = $(this).data('item-width');

                    new Glider($(this)[0], {
                        slidesToShow: 'auto',
                        slidesToScroll: 'auto',
                        itemWidth: item_width,
                        exactWidth: true,
                        draggable: true,
                        dragVelocity: 1
                    });
                });
            }
        }

        pdp_init_sliders();


        function pdp_init_salon_sliders(){
            if(!$('body').hasClass('elementor-page') && $('.testimonials').length){
                let offset = $('.testimonials__slider').offset().left;
                let $pagination = $('.testimonials__dots');
                let $slider = $('.testimonials__slider');

                $slider.width('calc(100vw - ' + offset + 'px)');

                $slider.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
                    if(!slick.$dots){
                        return;
                    }

                    var i = (currentSlide ? currentSlide : 0) + 1;
                    $pagination.text(i);
                });

                $slider.slick({
                    infinite: false,
                    accessibility: false,
                    variableWidth: true,
                    slidesToScroll: 1,
                    swipeToSlide: true,
                    arrows: true,
                    prevArrow: $('.testimonials__prev-btn'),
                    nextArrow: $('.testimonials__next-btn'),
                    dots: true,
                    cssEase: 'ease-out'
                });
            }
        }

        pdp_init_salon_sliders();

        /**
         * Mobile sliders system
         */
        function pdp_init_mobile_sliders(){
            if(window.matchMedia('(max-width: 800px)').matches && $('[data-slider-mobile]').length){
                $sliders = $('[data-slider-mobile]');

                $sliders.slick({
                    infinite: false,
                    accessibility: false,
                    variableWidth: true,
                    swipeToSlide: true,
                    arrows: false,
                    dots: false
                });
            }
        }

        pdp_init_mobile_sliders();


        /**
         *  Tabs Block
         */

        function pdp_init_tabs(){
            if($('.tabs').length){
                $('.tabs__btn').click(function(){
                    $('.tabs__nav-item').removeClass('active');
                    $('.tabs__tab').removeClass('active');

                    $(this).parent().addClass('active');
                    $('.tabs__tab[data-tab="' + $(this).data('tab') + '"]').addClass('active');
                });
            }
        }

        pdp_init_tabs();
    });
});