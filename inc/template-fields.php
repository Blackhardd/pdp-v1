<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'pdp_add_homepage_fields' );
function pdp_add_homepage_fields(){
	Container::make( 'post_meta', __( 'Настройки шаблона', 'pdp' ) )
		->where( 'post_template', '=', 'homepage.php' )
		->add_tab( __( 'Hero секция', 'pdp' ), array(
			Field::make( 'text', 'hero_title', __( 'Заголовок', 'pdp' ) ),
			Field::make( 'text', 'hero_subtitle', __( 'Подзаголовок', 'pdp' ) ),
			Field::make( 'text', 'hero_btn_text', __( 'Текст кнопки', 'pdp' ) ),
		) )
		->add_tab( __( 'Слайдер услуг', 'pdp' ), array(
			Field::make( 'text', 'service_categories_heading', __( 'Заголовок секции', 'pdp' ) ),
		) )
		->add_tab( __( 'Слайдер салонов', 'pdp' ), array(
			Field::make( 'text', 'salons_heading', __( 'Заголовок секции', 'pdp' ) ),
		) )
		->add_tab( __( 'О PIED-DE-POULE', 'pdp' ), array(
			Field::make( 'text', 'about_heading', __( 'Заголовок секции', 'pdp' ) ),
			Field::make( 'complex', 'about_tabs', __( 'Вкладки', 'pdp' ) )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Имя вкладки', 'pdp' ) ),
					Field::make( 'complex', 'advantages', __( 'Преимущества', 'pdp' ) )
						->add_fields( array(
							Field::make( 'text', 'title', __( 'Заголовок', 'pdp' ) ),
							Field::make( 'textarea', 'content', __( 'Контент', 'pdp' ) )
						) )
				) )
		) )
		->add_tab( __( 'Контакты', 'pdp' ), array(
			Field::make( 'text', 'contacts_heading', __( 'Заголовок секции', 'pdp' ) ),
			Field::make( 'text', 'contacts_tg_title', __( 'Telegram заголовок' ) ),
			Field::make( 'text', 'contacts_tg_bot_title', __( 'Telegram бот заголовок' ) ),
			Field::make( 'text', 'contacts_ig_title', __( 'Instagram заголовок' ) ),
			Field::make( 'text', 'contacts_fb_title', __( 'Facebook заголовок' ) ),
			Field::make( 'text', 'contacts_yt_title', __( 'YouTube заголовок' ) ),
		) )
		->add_tab( __( 'Франшиза', 'pdp' ), array(
			Field::make( 'text', 'franchise_heading', __( 'Заголовок секции', 'pdp' ) ),
			Field::make( 'text', 'franchise_subheading', __( 'Подзаголовок секции', 'pdp' ) ),
			Field::make( 'complex', 'franchise_info', __( 'Инфоблоки', 'pdp' ) )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Заголовок', 'pdp' ) ),
					Field::make( 'text', 'subtitle', __( 'Подзаголовок', 'pdp' ) )
				) ),
			Field::make( 'text', 'franchise_founders_title', __( 'Заголов блока основателей' ) ),
			Field::make( 'text', 'franchise_founders_content', __( 'Текст блока основателей' ) ),
			Field::make( 'complex', 'franchise_services', __( 'Сервисы', 'pdp' ) )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Заголовок', 'pdp' ) ),
					Field::make( 'textarea', 'icon', __( 'SVG', 'pdp' ) )
				) ),
			Field::make( 'textarea', 'franchise_cta_text', __( 'Текст предложения', 'pdp' ) ),
			Field::make( 'text', 'franchise_cta_btn_title', __( 'Надпись на кнопке', 'pdp' ) ),
			Field::make( 'text', 'franchise_cta_btn_link', __( 'Ссылка кнопки', 'pdp' ) ),
			Field::make( 'text', 'franchise_cta_phone', __( 'Номер телефона', 'pdp' ) ),
		) )
		->add_tab( __( 'Сеть салонов', 'pdp' ), array(
			Field::make( 'text', 'network_heading', __( 'Заголовок секции', 'pdp' ) ),
			Field::make( 'rich_text', 'network_first_content', sprintf( __( 'Контент %s', 'pdp' ), '1' ) ),
			Field::make( 'text', 'network_second_title', sprintf( __( 'Заголовок %s', 'pdp' ), '2' ) ),
			Field::make( 'rich_text', 'network_second_content', sprintf( __( 'Контент %s', 'pdp' ), '2' ) ),
			Field::make( 'image', 'network_second_image', sprintf( __( 'Изображение %s', 'pdp' ), '2' ) ),
			Field::make( 'text', 'network_third_title', sprintf( __( 'Заголовок %s', 'pdp' ), '3' ) ),
			Field::make( 'rich_text', 'network_third_content', sprintf( __( 'Контент %s', 'pdp' ), '3' ) ),
			Field::make( 'text', 'network_fourth_title', sprintf( __( 'Заголовок %s', 'pdp' ), '4' ) ),
			Field::make( 'rich_text', 'network_fourth_content', sprintf( __( 'Контент %s', 'pdp' ), '4' ) ),
			Field::make( 'image', 'network_fourth_image', sprintf( __( 'Изображение %s', 'pdp' ), '4' ) )
		) )
		->add_tab( __( 'Меню услуг', 'pdp' ), array(
			Field::make( 'text', 'services_heading', __( 'Заголовок секции', 'pdp' ) ),
			Field::make( 'complex', 'services_categories', __( 'Категории услуг' ) )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Заголовок', 'pdp' ) ),
					Field::make( 'textarea', 'content', __( 'Контент', 'pdp' ) ),
				) ),
			Field::make( 'textarea', 'services_cta_text', __( 'Текст предложения', 'pdp' ) ),
			Field::make( 'text', 'services_cta_btn_title', __( 'Надпись на кнопке', 'pdp' ) )
		) )
		->add_tab( __( 'Перфекционизм', 'pdp' ), array(
			Field::make( 'text', 'perfectionism_heading', __( 'Заголовок секции', 'pdp' ) ),
			Field::make( 'rich_text', 'perfectionism_content', __( 'Контент', 'pdp' ) ),
			Field::make( 'image', 'perfectionism_image', __( 'Изображение', 'pdp' ) ),
			Field::make( 'text', 'perfectionism_cta_title', __( 'Заголовок предложения', 'pdp' ) ),
			Field::make( 'textarea', 'perfectionism_cta_text', __( 'Заголовок предложения', 'pdp' ) ),
			Field::make( 'text', 'perfectionism_cta_btn_title', __( 'Надпись на кнопке', 'pdp' ) ),
		) );
}