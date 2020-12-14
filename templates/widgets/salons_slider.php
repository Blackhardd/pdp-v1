<?php
$salons = get_posts( array(
    'numberposts'   => -1,
    'post_type'     => 'salon',
    'orderby'       => 'date',
    'order'         => 'ASC',
) ); ?>

<div class="salons-slider">
    <?php foreach( $salons as $salon ){
        $city_terms = get_the_terms( $salon->ID, 'city' );
        $city = array_pop( $city_terms )->name;
        $tel = carbon_get_post_meta( $salon->ID, 'phone' ); ?>
        <div>
            <div class="salons-slider__item">
                <a href="<?=get_permalink( $salon->ID ); ?>"><?=get_the_post_thumbnail( $salon->ID, 'salons-slider-thumb' ); ?></a>
                <div class="salons-slider__info">
                    <div class="salons-slider__city"><?=$city; ?></div>
                    <div class="salons-slider__address"><?=$salon->post_title; ?></div>
                    <div class="salons-slider__item-footer">
                        <a href="tel:<?=str_replace( array( '(', ')', ' ' ), '', $tel ); ?>" class="salons-slider__tel"><?=$tel; ?></a>
                        <a href="<?=get_permalink( $salon->ID ); ?>" class="salons-slider__link">
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