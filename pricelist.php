<?php /* Template Name: Страница цен */

get_header(); ?>
    <section id="appointment-header">
        <div class="container">
            <?php
            if( function_exists('yoast_breadcrumb') ){
                yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
            } ?>

            <div class="title">
                <h1 class="title__heading txt_lower-case txt_fs-36px_m txt_lh-36px_m"><?php the_title(); ?></h1>
            </div>
        </div>
    </section>

    <section id="appointment-categories">
        <div class="container">
            <?php get_template_part( 'templates/vue/service-categories' ); ?>
        </div>
    </section>

    <section id="appointment-list">
        <div class="container">
            <div class="pricelist" :class="{ active: sharedState.isCategoryActive }">
                <div class="pricelist__content">
                    <div class="pricelist__header">
                        <div class="pricelist__filters" :class="{ active: sharedState.activeCategory.hair_services || sharedState.activeCategory.master_option }">
                            <div class="pricelist__hair-filter" :class="{ active: sharedState.activeCategory.hair_services }">
                                <div class="mb_20px txt_fw-600 txt_fs-24px txt_lh-24px">ваша длина волос</div>

                                <hair-length-select
                                    :value="sharedState.cart.hair_length"
                                />
                            </div>

                            <div class="toggle pricelist__master-filter" :class="{ active: sharedState.activeCategory.master_option }">
                                <span class="toggle__label">Мастер</span>

                                <label class="toggle__input-wrap">
                                    <input type="checkbox" name="master" class="toggle__input" value="1" :checked="sharedState.cart.master_option" @change="changeMasterType">
                                    <span class="toggle__slider"></span>
                                </label>

                                <span class="toggle__label">Старший мастер</span>
                            </div>
                        </div>
                    </div>

                    <div class="pricelist__listing">
                        <div v-if="sharedState.activeCategory && sharedState.activeCategory.services.length">
                            <div class="pricelist-category">
                                <div class="pricelist-category__header">
                                    <div class="pricelist-category__title">{{sharedState.activeCategory.name}}</div>

                                    <div class="pricelist-category__info">
                                        <span class="badge pro"></span> только старший мастер
                                    </div>
                                </div>

                                <div class="pricelist-category__list">
                                    <pricelist-item
                                        v-for="(service, index) in sharedState.activeCategory.services"
                                        @add-to-cart="addToCart"
                                        :key="index"
                                        :data="service"
                                        :hair-length="sharedState.cart.hair_length"
                                        :master-option="sharedState.cart.master_option"
                                        :is-added="isInCart(service)"
                                    />
                                </div>
                            </div>
                        </div>

                        <div v-if="sharedState.activeCategory && sharedState.activeCategory.subcategories.length">
                            <div class="pricelist-category" v-for="(subcategory, index) in sharedState.activeCategory.subcategories" :key="index">
                                <div class="pricelist-category__header">
                                    <div class="pricelist-category__title">{{subcategory.name}}</div>

                                    <div class="pricelist-category__info" v-if="index == 0">
                                        <span class="badge pro"></span> только старший мастер
                                    </div>
                                </div>

                                <div class="pricelist-category__list">
                                    <pricelist-item
                                        v-for="(service, index) in subcategory.services"
                                        @add-to-cart="addToCart"
                                        :key="index"
                                        :data="service"
                                        :hair-length="sharedState.cart.hair_length"
                                        :master-option="sharedState.cart.master_option"
                                        :is-added="isInCart(service)"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pricelist__sidebar">
                    <div class="cart">
                        <cart
                            @add-to-cart="addToCart"
                            @set-hair-length="console.log(value)"
                            @cart-is-loading="setCartState"
                            :cart-data="sharedState.cart"
                            :is-loading="sharedState.isCartLoading"
                        />
                    </div>
                    <?php //get_template_part( 'templates/vue/cart' ); ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
