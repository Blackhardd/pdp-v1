<?php
$salons = get_posts( array(
    'numberposts'   => -1,
    'post_type'     => 'salon',
    'orderby'       => 'date',
    'order'         => 'ASC',
) ); ?>

<div class="salons-slider" data-item-width="282">
    <?php foreach( $salons as $salon ){
        $city_terms = get_the_terms( $salon->ID, 'city' );
        $city = array_pop( $city_terms )->name;
        $tel = carbon_get_post_meta( $salon->ID, 'phone' ); ?>
        <div class="salon-card">
            <div class="salon-card__inner">
                <a href="<?=get_permalink( $salon->ID ); ?>"><?=get_the_post_thumbnail( $salon->ID, 'salons-slider-thumb' ); ?></a>
                <div class="salon-card__info">
                    <div class="salon-card__city"><?=$city; ?></div>
                    <div class="salon-card__address"><?=$salon->post_title; ?></div>
                    <div class="salon-card__footer">
                        <a href="tel:<?=str_replace( array( '(', ')', ' ' ), '', $tel ); ?>" class="salon-card__tel"><?=$tel; ?></a>
                        <a href="<?=get_permalink( $salon->ID ); ?>" class="salon-card__link">
                            <svg width="25" height="16" fill="none">
                                <path d="M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z" fill="#000"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>