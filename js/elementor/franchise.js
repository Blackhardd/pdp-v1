class Franchise extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                badge: ''
            }
        }
    }

    getDefaultElements(){
        const selectors = this.getSettings('selectors');

        return {
            $carousel: this.$element.find(selectors.badge)
        }
    }

    bindEvents(){
        jQuery(document).ready(this.stretchBadge.bind(this));
        jQuery(window).on('resize', this.stretchBadge.bind(this));
    }

    stretchBadge(){

    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Franchise, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/pdp_franchise.default', addHandler);
});