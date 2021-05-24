<?php

add_action( 'elementor/elements/categories_registered', 'pdp_add_elementor_widget_categories' );
function pdp_add_elementor_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'pdp',
		[
			'title' => __( 'PDP', 'pdp' ),
			'icon' => 'fa fa-plug',
		]
	);
}


add_action( 'init', 'pdp_load_elementor_widgets' );
function pdp_load_elementor_widgets(){
	if( !class_exists( 'PDP_Hero' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-hero.php';
	endif;

	if( !class_exists( 'PDP_Heading' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-heading.php';
	endif;

	if( !class_exists( 'PDP_Text' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-text.php';
	endif;

	if( !class_exists( 'PDP_Button' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-button.php';
	endif;

	if( !class_exists( 'PDP_Description_List' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-description-list.php';
	endif;

	if( !class_exists( 'PDP_Tabs' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-tabs.php';
	endif;

	if( !class_exists( 'PDP_Accordion' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-accordion.php';
	endif;

	if( !class_exists( 'PDP_Socials_List' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-socials-list.php';
	endif;

	if( !class_exists( 'PDP_Messenger_Icons' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-messenger-icons.php';
	endif;

	if( !class_exists( 'PDP_Salons_Carousel' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-salons-carousel.php';
	endif;

	if( !class_exists( 'PDP_Service_Categories_Carousel' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-service-categories-carousel.php';
	endif;

	if( !class_exists( 'PDP_Form' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-form.php';
	endif;

	if( !class_exists( 'PDP_Franchise' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-franchise.php';
	endif;

	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Hero() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Heading() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Text() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Button() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Description_List() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Tabs() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Accordion() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Socials_List() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Messenger_Icons() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Salons_Carousel() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Service_Categories_Carousel() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Form() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Franchise() );
}