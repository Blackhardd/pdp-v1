class Hero extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                carousel: '.pdp-hero__slider .swiper-container'
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
        jQuery(document).ready(this.initCarousel.bind(this));
    }

    initCarousel(){
        if(this.elements.$carousel.length){
            const swiper = new Swiper(this.getDefaultSettings().selectors.carousel, {
                direction: 'horizontal',
                loop: true,
                slidesPerView: 1,
                effect: 'flip',
                autoplay: {
                    delay: 5000
                },
                pagination: {
                    el: '.swiper-pagination',
                }
            });
        }
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Hero, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/pdp_hero.default', addHandler);
});