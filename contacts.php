<?php
/**
 * Template Name: Контакты
 *
 * @package PDP
 */

get_header();

$phone_qa = carbon_get_theme_option( 'phone_qa' );
$phone_marketing = carbon_get_theme_option( 'phone_marketing' ); ?>
	<section id="contacts-hero">
		<div class="container">
			<?php
			if( function_exists( 'yoast_breadcrumb' ) ){
				yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">', '</div>' );
			} ?>

            <div class="title title_contacts">
                <h1 class="title__heading">контакты</h1>
                <?php get_template_part( 'templates/widgets/socials/socials-big' ); ?>
            </div>
		</div>
	</section>

	<section id="contacts">
		<div class="container">
			<div class="row row_1-1-1 mb_60px mb_50px_m">
				<div class="col">
					<?php get_template_part( 'templates/contacts/kiev' ); ?>
				</div>

				<div class="col">
                    <?php get_template_part( 'templates/contacts/kharkov' ); ?>
				</div>
			</div>

            <div class="row row_2-1 mb_60px mb_50px_m">
                <div class="col">
	                <?php get_template_part( 'templates/contacts/vladimir-volynskiy' ); ?>
                </div>
            </div>

            <div class="row row_1-1-1">
                <div class="col">
                    <div class="phone-box mb_20px_m">
                        <div class="phone-box__title">Отдел контроля качества</div>
                        <a href="tel:<?=$phone_qa; ?>" class="phone-box__link"><?=$phone_qa; ?></a>
                    </div>
                </div>

                <div class="col">
                    <a href="https://t.me/egorkolchenko" target="_blank" class="btn-default">маркетинговый отдел<svg width="18" height="16" fill="none"><path d="M7 10.4l-.2 4.2c.4 0 .6-.2.8-.4l2-2 4.1 3c.8.5 1.3.3 1.5-.6L18 1.9C18.2.7 17.5.3 16.8.6l-16 6c-1 .5-1 1.1-.1 1.4l4 1.3 9.5-6c.5-.3.9-.1.5.2l-7.6 6.9z" fill="#fff"/></svg></a>
                </div>
            </div>
		</div>
	</section>
<?php
get_footer();