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
        let carousel_width = jQuery(window).width() - this.elements.$carousel.offset().left;
        this.elements.$carousel.css('width', carousel_width + 'px');
    }

    initCarousel(){
        new Glider(this.elements.$carousel[0], {
            slidesToShow: 'auto',
            slidesToScroll: 'auto',
            itemWidth: 282,
            exactWidth: true,
            draggable: true,
            dragVelocity: 1
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