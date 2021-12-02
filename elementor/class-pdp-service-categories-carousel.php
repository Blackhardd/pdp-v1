<?php

class PDP_Service_Categories_Carousel extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ){
		parent::__construct( $data, $args );

		wp_register_script( 'pdp-service-categories-carousel', get_template_directory_uri() . '/js/elementor/service-categories-carousel.js', [ 'elementor-frontend' ], PDP_THEME_VERSION, true );
	}

	public function get_name(){
		return 'pdp_service_categories_carousel';
	}

	public function get_title(){
		return __( 'Карусель категорий услуг', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	public function get_script_depends(){
		return [ 'pdp-service-categories-carousel' ];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Контент', 'pdp' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' )
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		$salons = pdp_get_salons();
		$categories = carbon_get_theme_option( 'service_categories' );
		$current_lang = pll_current_language();

		echo "
			<div class='service-categories'>
    			<div class='service-categories__salon-switcher'>
        			<select name='services_salon' id='services-salon-select' class='selectric selectric_pdp service-categories__salon-select'>
		";

		$counter = 0;
		foreach( $salons as $salon ) :
			$selected_attr = ( $counter == 0 ) ? 'selected' : '';
			$counter++;
			echo "<option value='{$salon->ID}' {$selected_attr}>{$salon->post_title}</option>";
		endforeach;

		echo "
					</select>
    			</div>
    			<div class='service-categories__slider'>
		";

		foreach( $categories as $category ) :
			$category_key = pdp_service_slug_to_key( $category['slug'] );
			$category_image = wp_get_attachment_image( $category['cover'], 'services-slider-thumb' );
			$category_title = ( $current_lang == 'ru' ) ? $category['title'] : $category['title_ua'];

			echo "
				<div class='service-category'>
					<div class='service-category__inner'>
						<a href='#' data-category='{$category_key}'>
							{$category_image}
							<div class='service-category__title'>
								{$category_title}
								<svg width='25' height='16' fill='none'>
                                	<path d='M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z' fill='#000'/>
                            	</svg>
							</div>
						</a>
					</div>
				</div>
			";
		endforeach;

		echo "
				</div>
			</div>
		";
	}

	protected function _content_template(){

	}
}