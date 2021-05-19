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
			'content_tab',
			[
				'label' => __( 'Контент', 'pdp' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'         => __( 'Название', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите название', 'pdp' )
			]
		);

		$repeater->add_control(
			'city',
			[
				'label'         => __( 'Город', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите название города', 'pdp' )
			]
		);

		$repeater->add_control(
			'phone',
			[
				'label'         => __( 'Номер телефона', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите номер телефона', 'pdp' )
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Ссылка', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку', 'pdp' )
			]
		);

		$repeater->add_control(
			'open_in_new_tab',
			[
				'label'         => __( 'Открывать в новой вкладке', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'      => __( 'Да', 'pdp' ),
				'label_off'     => __( 'Нет', 'pdp' ),
				'return_value'  => 'yes',
				'default'       => 'yes'
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'         => __( 'Обложка', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src()
				]
			]
		);

		$this->add_control(
			'salons',
			[
				'label'         => __( 'Салоны', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ title }}}'
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		$salons = pdp_get_salons( 'ASC', 'slider' );

		if( $settings['salons'] ){
			foreach( $settings['salons'] as $salon ){
				$cover = wp_get_attachment_image( $salon['image']['id'], 'salons-slider-thumb' );

				$salons[] = array(
					'title'             => $salon['title'],
					'city'              => $salon['city'],
					'phone'             => $salon['phone'],
					'link'              => $salon['link'],
					'open_in_new_tab'   => ( $salon['open_in_new_tab'] == 'yes' ),
					'image'             => $cover
				);
			}
		}

		echo "
			<div class='salons-slider'>
		";

		foreach( $salons as $salon ) :
			$target_attr = '';

			if( isset( $salon['open_in_new_tab'] ) && $salon['open_in_new_tab'] ){
				$target_attr = 'target="_blank"';
			}

			echo "
				<div>
					<div class='salons-slider__item'>
						<a href='{$salon['link']}' {$target_attr}>{$salon['image']}</a>
						<div class='salons-slider__info'>
							<div class='salons-slider__city'>{$salon['city']}</div>
							<div class='salons-slider__address'>{$salon['title']}</div>
							<div class='salons-slider__item-footer'>
								<a href='tel:{$salon['phone']}' class='salons-slider__tel'>{$salon['phone']}</a>
								<a href='{$salon['link']}' {$target_attr} class='salons-slider__link'>
		                            <svg width='25' height='16' fill='none'>
		                                <path d='M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z' />
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