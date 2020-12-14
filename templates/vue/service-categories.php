<div class="servicesSlider" id="service-categories">
    <div class="service-categories__salon-switcher">
        <pdp-select
            name="salon"
            placeholder="Выберите салон"
            @changed="setActiveSalon"
            :class="{ warning: isShowingWarning, animate__animated: isShowingWarning, animate__shakeX: isShowingWarning }"
            :options="sharedState.salons"
            :selected="sharedState.cart.salon"
        />
    </div>

    <service-categories
        @set-category="setActiveCategory"
        @force-select-salon="forceSelectSalon"
        :is-loading="sharedState.isPricelistLoading"
        :is-salon-active="sharedState.isSalonActive"
        :categories="sharedState.categories"
        :pricelist="sharedState.pricelist"
    />
</div>