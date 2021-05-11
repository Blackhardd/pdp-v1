class SalonsCarousel extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                carousel: '.salons-slider'
            }
        }
    }

    getDefaultElements(){
        const selectors = this.getSettings('selectors');

        return {
            $carousel: this.$element.find(selectors.carousel)
        }
    }

    bindEvents(){
        jQuery(document).ready(this.stretchCarousel.bind(this));
        jQuery(window).on('resize', this.stretchCarousel.bind(this));
        jQuery(document).ready(this.initCarousel.bind(this));
    }

    stretchCarousel(){
        let carousel_width = jQuery(window).width() - this.elements.$carousel.offset().left - 15;
        this.elements.$carousel.css('width', carousel_width + 'px');
    }

    initCarousel(){
        this.elements.$carousel.slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            variableWidth: true,
            autoplay: false,
            autoplaySpeed: 4000,
            swipeToSlide: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 550,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(SalonsCarousel, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/pdp_salons_carousel.default', addHandler);
});