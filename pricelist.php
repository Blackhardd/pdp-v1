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

    <section id="appointment-app">
        <section id="appointment-categories">
            <div class="container">
                <div class="servicesSlider">
                    <div class="service-categories__salon-switcher">
                        <salon-select />
                    </div>

                    <service-categories
                        @show-category="setActiveCategory($event)"
                    />
                </div>
            </div>
        </section>

        <section id="appointment-list">
            <div class="container">
                <div class="pricelist" v-if="activeCategoryServices && pricelist">
                    <div class="pricelist__content">
                        <div class="pricelist__header">
                            <div class="pricelist__filters">
                                <div class="pricelist__hair-filter" :class="{ active: activeCategoryServices.is_hair_services }">
                                    <div class="mb_20px txt_fw-600 txt_fs-24px txt_lh-24px"><?=__( 'Ваша длина волос', 'pdp' ); ?></div>

                                    <hair-length-select />
                                </div>

                                <div class="toggle pricelist__master-filter" :class="{ active: activeCategoryServices.is_master_option }">
                                    <span class="toggle__label"><?=__( 'Мастер', 'pdp' ); ?></span>

                                    <label class="toggle__input-wrap">
                                        <input type="checkbox" name="master" class="toggle__input" value="1" @input="setMasterOption" :checked="masterOption">
                                        <span class="toggle__slider"></span>
                                    </label>

                                    <span class="toggle__label"><?=__( 'Старший мастер', 'pdp' ); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="pricelist__listing">
                            <div class="pricelist-category" v-for="(subcategory, index) in activeCategoryServices.services">
                                <div class="pricelist-category__header">
                                    <div class="pricelist-category__title">{{ subcategory.name[lang] }}</div>

                                    <div class="pricelist-category__info">
                                        <span class="badge pro"></span> <?=__( 'только старший мастер', 'pdp' ); ?>
                                    </div>
                                </div>

                                <div class="pricelist-category__list">
                                    <pricelist-item
                                        v-for="(service, index) in subcategory.services"
                                        :key="index"
                                        :data="service"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pricelist__sidebar">
                        <div class="cart">
                            <cart />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

<?php get_footer(); ?>
