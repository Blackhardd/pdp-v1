<?php

$is_show_dropdown = carbon_get_theme_option( 'header_show_salons_dropdown' );
$main_city = carbon_get_theme_option( 'header_main_city' );
$main_salon_id = carbon_get_theme_option( 'header_main_salon' );

$main_salon_args = array(
	'post_type'         => 'salon',
    'orderby'           => 'rand',
	'posts_per_page'    => 1,
);

if( $main_city ){
    $main_city_id = array_shift( $main_city )['id'];
	$main_salon_args['tax_query'] = array(
		array(
			'taxonomy'  => 'city',
			'field'     => 'id',
			'terms'     => $main_city_id
		)
	);
}

$main_salon = null;

if( $main_salon_id ){
	$main_salon = pll_get_post( $main_salon_id );
}
else{
	$main_salon = get_posts( $main_salon_args );
	$main_salon = array_shift( $main_salon );
}

$main_salon_phone = carbon_get_post_meta( $main_salon->ID, 'phone' );

?>

<div class="phonesList">
    <?php if( $is_show_dropdown ): ?>
        <div class="phonesList__icon">
            <svg width="24" height="24" fill="none">
                <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 12l-4-4h8l-4 4z" fill="#000"/>
            </svg>
        </div>
    <?php endif; ?>

    <div class="phonesList__placeholder">
        <a href="tel:<?=str_replace( array( '(', ')', ' ' ), '', $main_salon_phone ); ?>">
            <div class="phonesList__address"><?=$main_salon->post_title; ?></div>
            <div class="phonesList__phone"><?=$main_salon_phone; ?></div>
        </a>
    </div>

    <?php if( $is_show_dropdown ): ?>
        <div class="phonesList__dropdown">
            <div class="phonesList__dropdownInner">
                <?php
                $terms = get_terms( array(
	                'taxonomy'      => 'city',
	                'child_of'      => 0,
	                'hide_empty'    => 1
                ) );

                foreach( $terms as $term ) :
                    if( carbon_get_term_meta( $term->term_id, 'display_in_header' ) === 'yes' ) : ?>
                        <div class="phonesList__dropdownGroup">
                            <div class="phonesList__dropdownLabel"><?=$term->name; ?></div>
                            <?php
                            $posts_args = array(
                                'post_type'         => 'salon',
                                'post_status'       => 'publish',
                                'posts_per_page'    => -1,
                                'tax_query'         => array(
                                    array(
                                        'taxonomy'  => 'city',
                                        'field'     => 'slug',
                                        'terms'     => $term->slug
                                    )
                                )
                            );

                            foreach( get_posts( $posts_args ) as $salon ) :
                                if( carbon_get_post_meta( $salon->ID, 'display_in_header' ) === 'yes' ) :
                                $salon_phone = carbon_get_post_meta( $salon->ID, 'phone' ); ?>
                                    <div class="phonesList__dropdownItem">
                                        <div class="phonesList__dropdownItemAddress"><?=$salon->post_title; ?></div>
                                        <a href="tel:<?=str_replace( array( '(', ')', ' ' ), '', $salon_phone ); ?>" class="phonesList__dropdownItemPhone"><?=$salon_phone; ?></a>
                                    </div>
                            <?php
                                endif;
                            endforeach; ?>
                        </div>
                <?php
                    endif;
                endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>