<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'pdp_attach_theme_options' );
function pdp_attach_theme_options(){
	$salons = [];

	foreach( pdp_get_salons() as $salon ){
		$salons[$salon->ID] = $salon->post_title;
	}

	Container::make( 'theme_options', __( 'Настройки', 'pdp' ) )
		->set_icon( 'none' )
		->set_page_parent( 'pdp-options' )
		->add_tab( __( 'Общие', 'pdp' ), array(
			Field::make( 'html', 'contacts_heading' )
				 ->set_html( sprintf( '<h2>%s</h2>', __( 'Контакты', 'pdp' ) ) ),
			Field::make( 'text', 'email', 'Email' ),
			Field::make( 'text', 'telegram', 'Telegram' ),
			Field::make( 'text', 'instagram', 'Instagram' ),
			Field::make( 'text', 'facebook', 'Facebook' ),
			Field::make( 'text', 'youtube', 'YouTube' ),
			Field::make( 'text', 'phone_qa', __( 'Номер отдела контроля качества', 'pdp_core' ) )
			     ->set_attribute( 'type', 'tel' ),
			Field::make( 'text', 'phone_marketing', __( 'Номер отдела маркетинга', 'pdp_core' ) )
			     ->set_attribute( 'type', 'tel' ),
			Field::make( 'html', 'google_api_heading' )
			     ->set_html( sprintf( '<h2>%s</h2>', 'Google API' ) ),
			Field::make( 'text', 'google_client_id', __( 'ID клента', 'pdp' ) )
				->set_width( 50 ),
			Field::make( 'text', 'google_secret', __( 'Секретный код клента', 'pdp' ) )
				->set_width( 50 ),
			Field::make( 'html', 'header_heading' )
			     ->set_html( sprintf( '<h2>%s</h2>', 'Шапка сайта' ) ),
			Field::make( 'select', 'header_show_salons_dropdown', __( 'Выпадающий список салонов', 'pdp' ) )
			     ->set_options( array(
				     '0' => __( 'Скрывать', 'pdp' ),
				     '1' => __( 'Показывать', 'pdp' )
			     ) )
				 ->set_width( 50 ),
			Field::make( 'association', 'header_main_city', __( 'Основной город', 'pdp' ) )
				->set_types( array(
					array(
						'type'      => 'term',
						'taxonomy'  => 'city'
					)
				) )
				->set_max( 1 )
				->set_width( 50 ),
			Field::make( 'html', 'forms_heading' )
			     ->set_html( sprintf( '<h2>%s</h2>', 'Формы' ) ),
			Field::make( 'select', 'forms_show_salon_select', __( 'Выбор салона в формах', 'pdp' ) )
			     ->set_options( array(
				     '1' => __( 'Показывать', 'pdp' ),
				     '0' => __( 'Скрывать', 'pdp' )
			     ) )
			     ->set_width( 50 ),
			Field::make( 'select', 'forms_default_salon', __( 'Салон по умолчанию', 'pdp' ) )
			     ->set_options( $salons )
			     ->set_width( 50 )
		) )
		->add_tab( __( 'Аналитика', 'pdp' ), array(
			Field::make( 'textarea', 'analytics_code', __( 'Коды аналитик', 'pdp' ) ),
			Field::make( 'complex', 'gtag_actions', __( 'События аналитики', 'pdp' ) )
				->add_fields( array(
					Field::make( 'text', 'selector', __( 'Селектор', 'pdp' ) )
				        ->set_width( 20 ),
					Field::make( 'text', 'event', __( 'Событие', 'pdp' ) )
				        ->set_width( 20 ),
					Field::make( 'text', 'gtag_event', __( 'gtag событие', 'pdp' ) )
				        ->set_width( 20 ),
					Field::make( 'text', 'gtag_category', __( 'gtag категория', 'pdp' ) )
				        ->set_width( 20 ),
					Field::make( 'text', 'gtag_action', __( 'gtag действие', 'pdp' ) )
				        ->set_width( 20 )
				) )
		) )
		->add_tab( __( 'Категории услуг', 'pdp' ), array(
			Field::make( 'complex', 'service_categories', __( 'Список категорий', 'pdp' ) )
				->set_collapsed( true )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'RU', 'pdp' ) )
						->set_width( 40 ),
					Field::make( 'text', 'title_ua', __( 'UA', 'pdp' ) )
					     ->set_width( 40 ),
					Field::make( 'text', 'slug', __( 'Ярлык', 'pdp' ) )
			            ->set_width( 40 ),
					Field::make( 'image', 'cover', __( 'Обложка', 'pdp' ) )
			            ->set_width( 20 )
				) )
		) );
}