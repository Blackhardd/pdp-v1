<?php /* Template Name: Страница категории услуг */ ?>

<?php get_header(); ?>

    <section id="service-header">
        <div class="container">
            <div class="service-header">
                <div class="service-header__content">
                    <?php
                    if( function_exists('yoast_breadcrumb') ){
                        yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                    } ?>

                    <h1 class="service-header__heading"><?php the_title(); ?></h1>

                    <?=wp_get_attachment_image( carbon_get_the_post_meta( 'hero_img' ), 'full', false,  array( 'class' => 'service-header__img-mobile' ) ); ?>

                    <div class="service-header__description">
                        <?=carbon_get_the_post_meta( 'hero_content' ); ?>
                        <button class="btn-default" data-micromodal-trigger="modal-service-category-appointment">записаться</button>
                    </div>
                </div>

                <?=wp_get_attachment_image( carbon_get_the_post_meta( 'hero_img' ), 'full', false,  array( 'class' => 'service-header__img-desktop' ) ); ?>
            </div>
        </div>
    </section>

    <section id="service-content">
        <div class="container">
            <?php
            $sections = carbon_get_the_post_meta( 'sections' );
            $sections_counter = 1;

            foreach( $sections as $section ){ ?>
                <div class="service-row">
                    <?php if( ( $sections_counter % 2 ) != 0 ){ ?>
                        <div class="service-row__image"><?=wp_get_attachment_image( $section['image'], 'full' ); ?></div>
                    <?php } ?>

                    <div class="service-row__content">
                        <?php if( $section['title'] ){ ?>
                            <h2 class="service-row__title"><?=$section['title']; ?></h2>
                        <?php } ?>

                        <div class="service-row__desc"><?=do_shortcode( $section['content'] ); ?></div>

                        <?php if( $section['details'] ){ ?>
                            <a href="<?=get_permalink( $section['details']['id'] ); ?>" class="service-row__read-more btn-default">подробнее</a>
                        <?php } ?>

                        <?php
                        if( $section['pricelist'] ){
                            foreach( $section['pricelist'] as $pricelist ){
                                get_template_part( 'templates/services/pricelist-' . $pricelist['_type'], null, ['pricelist' => $pricelist] );
                            }
                        }

                        if( $section['form_title'] && $section['form_service'] ){
                            get_template_part( 'templates/forms/appointment_service', null, ['title' => $section['form_title'], 'service' => $section['form_service']] );
                        } ?>
                    </div>

                    <?php if( ( $sections_counter % 2 ) == 0 ){ ?>
                        <div class="service-row__image"><?=wp_get_attachment_image( $section['image'], 'full' ); ?></div>
                    <?php } ?>
                </div>

                <?php if( $section['after_content'] ){ ?>
                    <div class="service-row-after"><?=do_shortcode( $section['after_content'] ); ?></div>
	            <?php } ?>
            <?php
                $sections_counter++;
            } ?>
        </div>
    </section>

    <?php if( pdp_get_related_pages( $post ) ){ ?>
        <section id="service-related">
            <div class="container">
                <div class="title mb_40px">
                    <h2 class="title__heading txt_fs-24px_m">обратите внимание на другие услуги</h2>
                </div>

                <div class="related-pages">
	                <?php foreach( pdp_get_related_pages( $post ) as $page ){ ?>
                        <div class="related-pages__item">
                            <a href="<?=get_permalink( $page->ID ); ?>">
                                <?=wp_get_attachment_image( carbon_get_post_meta( $page->ID, 'hero_img' ), [284, 284] ); ?>
                                <div class="related-pages__title"><?=$page->post_title; ?></div>
                            </a>
                        </div>
	                <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>

<?php get_footer(); ?>
