class Promotions extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                carousel: '.promotions'
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
        if(window.matchMedia('(max-width: 767px)').matches){
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
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Promotions, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/pdp_promotions.default', addHandler);
});