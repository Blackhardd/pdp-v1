<?php

class PDP_Salons_Carousel extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ){
		parent::__construct( $data, $args );

		wp_register_script( 'pdp-salons-carousel', get_template_directory_uri() . '/js/elementor/salons-carousel.js', [ 'elementor-frontend' ], PDP_THEME_VERSION, true );
	}

	public function get_name(){
		return 'pdp_salons_carousel';
	}

	public function get_title(){
		return __( 'Карусель салонов', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	public function get_script_depends(){
		return [ 'pdp-salons-carousel' ];
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
		$current_lang = pll_current_language();

		echo "
			<div class='salons-slider'>
		";

		foreach( $salons as $salon ) :
			$link = get_permalink( $salon->ID );
			$city_terms = get_the_terms( $salon->ID, 'city' );
			$city = array_pop( $city_terms )->name;
			$tel = carbon_get_post_meta( $salon->ID, 'phone' );
			$clear_tel = str_replace( array( '(', ')', ' ' ), '', $tel );
			$thumbnail = get_the_post_thumbnail( $salon->ID, 'salons-slider-thumb' );

			echo "
				<div>
					<div class='salons-slider__item'>
						<a href='{$link}'>{$thumbnail}</a>
						<div class='salons-slider__info'>
							<div class='salons-slider__city'>{$city}</div>
							<div class='salons-slider__address'>{$salon->post_title}</div>
							<div class='salons-slider__item-footer'>
								<a href='tel:{$clear_tel}' class='salons-slider__tel'>{$tel}</a>
								<a href='{$link}' class='salons-slider__link'>
		                            <svg width='25' height='16' fill='none'>
		                                <path d='M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z' fill='#000'/>
		                            </svg>
		                        </a>
							</div>
						</div>
					</div>
				</div>
			";
		endforeach;

		echo "
			</div>
		";
	}

	protected function _content_template(){

	}
}