<?php
/**
 * Template Name: Главная страница
 *
 * @package PDP
 */

get_header(); ?>

    <section id="hero-home">
        <div class="hero">
            <div class="hero__title">
                <div class="hero__subheading"><?=carbon_get_post_meta( get_the_ID(), 'hero_subtitle' ); ?></div>
                <h1 class="hero__heading"><?=carbon_get_post_meta( get_the_ID(), 'hero_title' ); ?></h1>
                <button class="hero__btn btn-default" data-micromodal-trigger="modal-appointment"><?=carbon_get_post_meta( get_the_ID(), 'hero_btn_text' ); ?></button>
            </div>

            <?=wp_get_attachment_image( 15, 'full' ); ?>

            <div class="hero__socials">
                <?php get_template_part( 'templates/widgets/socials' ); ?>
            </div>
        </div>
    </section>

    <section id="home-services">
        <div class="container">
            <div class="title mb_20px">
                <h3 class="title__heading txt_fs-18px_m txt_lh-18px_m"><?=carbon_get_post_meta( get_the_ID(), 'service_categories_heading' ); ?></h3>
            </div>

            <?php get_template_part( 'templates/widgets/services_slider' ); ?>
        </div>
    </section>

    <section id="home-about">
        <div class="container">
            <div class="title mb_40px">
                <h2 class="title__heading txt_fs-20px_m txt_lh-20px_m"><?=carbon_get_post_meta( get_the_ID(), 'about_heading' ); ?></h2>
            </div>

            <?php $tabs = carbon_get_post_meta( get_the_ID(), 'about_tabs' ); ?>

            <div class="tabs d_none_m">
                <ul class="tabs__nav">
                    <?php foreach( $tabs as $key => $tab ) : ?>
                        <li class="tabs__nav-item <?=( $key == 0 ) ? 'active' : '' ; ?>">
                            <button type="button" class="tabs__btn" data-tab="<?=pdp_cyr_to_lat( $tab['title'] ); ?>">
                                <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                                <?=$tab['title']; ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tabs__tabs">
                    <?php foreach( $tabs as $key => $tab ) : ?>
                        <div class="tabs__tab <?=( $key == 0 ) ? 'active' : '' ; ?>" data-tab="<?=pdp_cyr_to_lat( $tab['title'] ); ?>">
                            <ol class="ol_style-03 mw_550px">
                                <?php foreach( $tab['advantages'] as $item ) : ?>
                                    <li>
                                        <div>
                                            <div class="txt_bold mb_14px"><?=$item['title']; ?></div>
                                            <?=$item['content']; ?>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="accordion accordion_style-02 d_block_m">
                <?php foreach( $tabs as $key => $tab ) : ?>
                    <div class="accordion__item <?=( $key == 0 ) ? 'active' : ''; ?>">
                        <div class="accordion__item-header">
                            <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                            <div class="accordion__title"><?=$tab['title']; ?></div>
                        </div>

                        <div class="accordion__content">
                            <ol class="ol_style-03">
                                <?php foreach( $tab['advantages'] as $item ) : ?>
                                    <li>
                                        <div>
                                            <div class="txt_bold mb_14px"><?=$item['title']; ?></div>
	                                        <?=$item['content']; ?>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="home-salons">
        <div class="container">
            <div class="title mb_40px mb_30px_m">
                <h3 class="title__heading txt_fs-18px_m txt_lh-18px_m"><?=carbon_get_post_meta( get_the_ID(), 'salons_heading' ); ?></h3>
            </div>

            <?php get_template_part( 'templates/widgets/salons_slider' ); ?>
        </div>
    </section>

    <section id="home-socials">
        <div class="container">
            <div class="row row_1-1 gap_col_80px flex_alignCenter">
                <div class="col"></div>

                <div class="col">
                    <div class="title mb_30px">
                        <h3 class="title__heading"><?=carbon_get_post_meta( get_the_ID(), 'contacts_heading' ); ?></h3>
                    </div>

                    <div class="socials_list">
                        <ul>
                            <li>
                                <a href="https://t.me/pieddepoule" target="_blank">
                                    <svg width="18" height="18" fill="none"><g clip-path="url(#clip0)"><path d="M7 11.4l-.2 4.2c.4 0 .6-.2.8-.4l2-2 4.1 3c.8.5 1.3.3 1.5-.6L18 2.9c.3-1.2-.4-1.6-1.1-1.3l-16 6c-1 .5-1 1.1-.1 1.4l4 1.3 9.5-6c.5-.3.9-.1.5.2l-7.6 6.9z" fill="#392BDF"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h18v18H0z"/></clipPath></defs></svg>
                                    Telegram-журнал
                                </a>
                                <span><?=carbon_get_post_meta( get_the_ID(), 'contacts_tg_title' ); ?></span>
                            </li>
                            <li>
                                <a href="https://t.me/Pied_De_Poule_bot" target="_blank">
                                    <svg width="18" height="18" fill="none"><g clip-path="url(#clip0)"><path d="M7 11.4l-.2 4.2c.4 0 .6-.2.8-.4l2-2 4.1 3c.8.5 1.3.3 1.5-.6L18 2.9c.3-1.2-.4-1.6-1.1-1.3l-16 6c-1 .5-1 1.1-.1 1.4l4 1.3 9.5-6c.5-.3.9-.1.5.2l-7.6 6.9z" fill="#392BDF"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h18v18H0z"/></clipPath></defs></svg>
                                    Telegram-bоt
                                </a>
                                <span><?=carbon_get_post_meta( get_the_ID(), 'contacts_tg_bot_title' ); ?></span>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/pied.de.poule/?hl=ru" target="_blank">
                                    <svg width="18" height="18" fill="none"><path d="M12.4 0H5.6A5.6 5.6 0 000 5.6v6.8c0 3 2.5 5.6 5.6 5.6h6.8c3 0 5.6-2.5 5.6-5.6V5.6c0-3-2.5-5.6-5.6-5.6zm4 12.4a4 4 0 01-4 4H5.6a4 4 0 01-4-4V5.6a4 4 0 014-4h6.8a4 4 0 014 4v6.8z" fill="#392BDF"/><path d="M9 4.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9zm0 7.3a2.8 2.8 0 110-5.6 2.8 2.8 0 010 5.6zM13.8 4.8a.6.6 0 100-1.2.6.6 0 000 1.2z" fill="#392BDF"/></svg>
                                    Instagram
                                </a>
                                <span><?=carbon_get_post_meta( get_the_ID(), 'contacts_ig_title' ); ?></span>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/pied.de.poule.kyiv/" target="_blank">
                                    <svg width="18" height="18" fill="none"><path d="M15.8 0H2.2C1 0 0 1 0 2.3v13.4C0 17 1 18 2.3 18H9v-6.2H6.7V9H9V6.7c0-1.8 1.5-3.3 3.4-3.3h2.2v2.8h-1.1c-.6 0-1.1 0-1.1.5V9h2.8L14 11.8h-1.7V18h3.3c1.3 0 2.3-1 2.3-2.3V2.3C18 1 17 0 15.7 0z" fill="#392BDF"/></svg>
                                    Facebook
                                </a>
                                <span><?=carbon_get_post_meta( get_the_ID(), 'contacts_fb_title' ); ?></span>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCMaDI5gxMWtbNRQXXjvW-LA" target="_blank">
                                    <svg width="18" height="14" fill="none"><path d="M17.2 2c-.5-.9-1-1-2-1A129.6 129.6 0 002.8 1C1.8 1 1.3 1 .8 2S0 4.4 0 7s.3 4.1.8 5c.5.9 1 1 2 1a146.5 146.5 0 0012.3 0c1.1 0 1.6-.1 2.1-1s.8-2.4.8-5-.3-4.1-.8-5zM6.8 10.4V3.6L12.3 7l-5.7 3.4z" fill="#392BDF"/></svg>
                                    YouTube
                                </a>
                                <span><?=carbon_get_post_meta( get_the_ID(), 'contacts_yt_title' ); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="home-form">
        <div class="container">
            <?php get_template_part( 'templates/forms/home-booking' ); ?>
        </div>
    </section>

    <?php get_template_part( 'templates/sections/franchise' ); ?>

    <section id="network">
        <div class="container">
            <div class="row row_1-1 mb_80px">
                <div class="col">
                    <div class="title mb_20px mb_40px_m">
                        <h2 class="title__heading txt_fs-24px_m txt_lh-24px_m">
	                        <?=carbon_get_post_meta( get_the_ID(), 'network_heading' ); ?>
                        </h2>
                    </div>

                    <div class="textBlock">
	                    <?=carbon_get_post_meta( get_the_ID(), 'network_first_content' ); ?>
                    </div>
                </div>
            </div>

            <div class="row row_1-1-1 gap_col_60px">
                <div class="col">
                    <div class="title mb_18px">
                        <h3 class="title__heading"><?=carbon_get_post_meta( get_the_ID(), 'network_second_title' ); ?></h3>
                    </div>

                    <div class="textBlock">
	                    <?=carbon_get_post_meta( get_the_ID(), 'network_second_content' ); ?>
                    </div>

                    <div class="image mt_50px mb_40px_m">
                        <?=wp_get_attachment_image( carbon_get_post_meta( get_the_ID(), 'network_second_image' ), 'full' ); ?>
                    </div>
                </div>

                <div class="col flex flex_col flex_justifyCenter">
                    <div class="title mb_18px">
                        <h3 class="title__heading"><?=carbon_get_post_meta( get_the_ID(), 'network_third_title' ); ?></h3>
                    </div>

                    <div class="textBlock mb_40px_m">
	                    <?=carbon_get_post_meta( get_the_ID(), 'network_third_content' ); ?>
                    </div>
                </div>

                <div class="col">
                    <div class="image mb_50px">
                        <?=wp_get_attachment_image( carbon_get_post_meta( get_the_ID(), 'network_fourth_image' ), 'full' ); ?>
                    </div>

                    <div class="title mb_18px">
                        <h3 class="title__heading"><?=carbon_get_post_meta( get_the_ID(), 'network_fourth_title' ); ?></h3>
                    </div>

                    <div class="textBlock">
	                    <?=carbon_get_post_meta( get_the_ID(), 'network_fourth_content' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services-extended">
        <div class="container">
            <div class="title mb_60px">
                <h2 class="title__heading txt_fs-24px_m txt_lh-24px_m">
                    <?=carbon_get_post_meta( get_the_ID(), 'services_heading' ); ?>
                </h2>
            </div>

            <div class="serviceListExt mb_60px">
                <?php foreach( carbon_get_post_meta( get_the_ID(), 'services_categories' ) as $item ) : ?>
                    <div class="serviceListExt__row">
                        <div class="serviceListExt__title"><?=$item['title']; ?></div>
                        <div class="serviceListExt__content"><?=$item['content']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cta cta_servicesExtended">
                <div class="cta__content"><?=carbon_get_post_meta( get_the_ID(), 'services_cta_text' ); ?></div>
                <div class="cta__footer">
                    <a href="<?=get_permalink( pll_get_post( 66 ) ); ?>" class="btn-default"><?=carbon_get_post_meta( get_the_ID(), 'services_cta_btn_title' ); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section id="perfection">
        <div class="container">
            <div class="row row_2-1 gap_col_55px mb_100px">
                <div class="col">
                    <div class="title mb_60px mb_40px_m">
                        <h2 class="title__heading txt_fs-24px_m txt_lh-24px_m"><?=carbon_get_post_meta( get_the_ID(), 'perfectionism_heading' ); ?></h2>
                    </div>

                    <div class="textBlock">
                        <?=carbon_get_post_meta( get_the_ID(), 'perfectionism_content' ); ?>
                    </div>
                </div>

                <div class="col">
                    <div class="image">
                        <?=wp_get_attachment_image( carbon_get_post_meta( get_the_ID(), 'perfectionism_image' ), 'full' ); ?>
                    </div>
                </div>
            </div>

            <div class="cta cta_perfection mw_550px">
                <h4 class="cta__title"><?=carbon_get_post_meta( get_the_ID(), 'perfectionism_cta_title' ); ?></h4>
                <div class="cta__content txt_fs-20px_m txt_lh-20px_m">
	                <?=carbon_get_post_meta( get_the_ID(), 'perfectionism_cta_text' ); ?>
                </div>
                <div class="cta__footer">
                    <button class="btn-default" data-micromodal-trigger="modal-appointment"><?=carbon_get_post_meta( get_the_ID(), 'perfectionism_cta_btn_title' ); ?></button>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>