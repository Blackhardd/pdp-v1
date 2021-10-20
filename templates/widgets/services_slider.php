<?php
$categories = carbon_get_theme_option( 'service_categories' );
$salons = pdp_get_salons( 'ASC', false, pll_current_language() );
?>

<div class="service-categories">
    <div class="service-categories__salon-switcher">
        <select name="services_salon" id="services-salon-select" class="selectric selectric_pdp service-categories__salon-select">
            <?php
            foreach( $salons as $salon ){
                if( carbon_get_post_meta( $salon->ID, 'display_in_booking' ) === 'yes' ) :
                    if( $salon->ID == pll_get_post( carbon_get_theme_option( 'header_main_salon' ) ) ){ ?>
                        <option value="<?=$salon->ID; ?>" selected><?=$salon->post_title; ?></option>
                    <?php } else { ?>
                        <option value="<?=$salon->ID; ?>"><?=$salon->post_title; ?></option>
                    <?php
                    }
                endif;
            } ?>
        </select>
    </div>

    <div class="service-categories__slider" data-item-width="316">
        <?php foreach( $categories as $category ){ ?>
            <div class="service-category">
                <div class="service-category__inner">
                    <a href="#" data-category="<?=pdp_service_slug_to_key( $category['slug'] ); ?>">
                        <?=wp_get_attachment_image( $category['cover'], 'services-slider-thumb' ); ?>
                        <div class="service-category__title">
                            <?=( pll_current_language() == 'ru' ) ? $category['title'] : $category['title_ua']; ?>
                            <svg width="25" height="16" fill="none">
                                <path d="M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z" fill="#000"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>