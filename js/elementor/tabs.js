class Tabs extends elementorModules.frontend.handlers.Base {
    getDefaultSettings(){
        return {
            selectors: {
                tabs_wrapper: '.tabs',
                tabs_nav_items: '.tabs__nav-item',
                tabs_btns: '.tabs__nav-btn',
                tabs_content: '.tabs__tabs'
            }
        }
    }

    getDefaultElements(){
        const selectors = this.getSettings('selectors');

        return {
            $tabs_wrapper: this.$element.find(selectors.tabs_wrapper),
            $tabs_nav_items: this.$element.find(selectors.tabs_nav_items),
            $tabs_btns: this.$element.find(selectors.tabs_btns),
            $tabs_content: this.$element.find(selectors.tabs_content),
        }
    }

    bindEvents(){
        jQuery(document).ready(this.initTabs.bind(this));
    }

    initTabs(){
        let self = this;
        this.elements.$tabs_btns.on('click', function(){
            self.elements.$tabs_nav_items.removeClass('active');
            self.elements.$tabs_content.find('.tabs__tab').removeClass('active');

            jQuery(this).parent().addClass('active');
            self.elements.$tabs_content.find('[data-tab="' + jQuery(this).data('tab') + '"]').addClass('active');
        });
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Tabs, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/pdp_tabs.default', addHandler);
});