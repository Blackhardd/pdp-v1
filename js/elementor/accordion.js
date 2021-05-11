class Accordion extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                items: '.pdp-accordion__item-header'
            }
        }
    }

    getDefaultElements(){
        const selectors = this.getSettings('selectors');

        return {
            $items: this.$element.find(selectors.items)
        }
    }

    bindEvents(){
        jQuery(document).ready(this.initAccordion.bind(this));
    }

    initAccordion(){
        let self = this;
        this.elements.$items.on('click', function(){
            if(jQuery(this).hasClass('active')){
                jQuery(this).removeClass('active');
            }
            else{
                self.elements.$items.removeClass('active');
                jQuery(this).addClass('active');
            }
        });
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Accordion, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/pdp_accordion.default', addHandler);
});