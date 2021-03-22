<?php get_header();

$city = array_pop( get_the_terms( get_the_ID(), 'city' ) )->name;
$tel = carbon_get_post_meta( get_the_ID(), 'phone' );
$advantages = carbon_get_post_meta( get_the_ID(), 'advantages' );
$gallery = carbon_get_post_meta( get_the_ID(), 'gallery' ); ?>
    <section id="salon-header">
        <div class="container">
            <?php
            if( function_exists('yoast_breadcrumb') ){
                yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
            } ?>
        </div>
    </section>

    <section id="salon">
        <div class="container">
            <div class="row row_1-1">
                <div class="col">
                    <div class="salon-carousel">
                        <div class="salon-carousel__slider">
	                        <?php
	                        foreach( $gallery as $item ){
		                        echo '<div class="salon-carousel__item"><a data-fancybox href="' . wp_get_attachment_image_url( $item, 'salon-carousel-large' ) . '">' . wp_get_attachment_image( $item, 'salon-carousel-large' ) . '</a></div>';
	                        } ?>
                        </div>
                    </div>

                    <div class="salon-carousel-nav">
                        <div class="salon-carousel-nav__slider">
	                        <?php
	                        foreach( $gallery as $item ){
		                        echo '<div class="salon-carousel-nav__item-wrap"><div class="salon-carousel-nav__item">' . wp_get_attachment_image( $item, 'salon-carousel-nav' ) . '</div></div>';
	                        } ?>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="salon-info">
                        <h1>
                            <div class="salon-info__city"><?=$city; ?></div>
                            <div class="salon-info__address"><?php the_title(); ?></div>
                        </h1>

                        <div class="salon-info__phone">
                            <svg width="18" height="19" fill="none">
                                <path d="M17 12.9c-1.3 0-2.4-.2-3.6-.6a1 1 0 00-1 .2l-2.2 2.1a14.7 14.7 0 01-6.6-6.3l2.2-2c.3-.3.4-.7.3-1-.4-1.1-.6-2.3-.6-3.5 0-.5-.5-1-1-1H1a1 1 0 00-1 1c0 9 7.6 16.3 17 16.3.6 0 1-.4 1-1v-3.3c0-.5-.4-1-1-1zm-1-3.4h2c0-4.8-4-8.6-9-8.6v1.9c3.9 0 7 3 7 6.7zm-4 0h2c0-2.6-2.2-4.8-5-4.8v2a3 3 0 013 2.8z" fill="#000"/>
                            </svg>
                            <a href="tel:<?=str_replace( array( '(', ')', ' ' ), '', $tel ); ?>" class="salon-info__phone-link"><?=$tel; ?></a>
                        </div>

                        <ul class="salon-info__advantages">
                            <?php foreach( $advantages as $advantage ){ ?>
                                <li><?=$advantage['advantage']; ?></li>
                            <?php } ?>
                        </ul>

                        <a href="<?=get_permalink( 66 ) . '?salonId=' . get_the_ID(); ?>" class="btn-default"><?=__( 'Список услуг', 'pdp' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if( false ){ ?>
        <section id="salon-team">
            <div class="container">
                <?php get_template_part( 'templates/salon/team' ); ?>
            </div>
        </section>
    <?php } ?>

    <section id="salon-other">
        <div class="container">
            <div class="title mt_40px mb_40px">
                <h2 class="title__heading txt_lower-case"><?=__( 'Наши салоны', 'pdp' ); ?></h2>
            </div>

            <div class="title mb_30px">
                <h3 class="title__heading"><span>у нас уже</span> <?=count( pdp_get_salons() ); ?> салонов</h3>
            </div>

	        <?php get_template_part( 'templates/widgets/salons_slider' ); ?>
        </div>
    </section>

<?php get_footer(); ?>
