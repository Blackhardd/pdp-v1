<?php

class PDP_Hero extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ){
		parent::__construct( $data, $args );

		wp_register_script( 'pdp-hero', get_template_directory_uri() . '/js/elementor/hero.js', [ 'elementor-frontend', 'swiper' ], PDP_THEME_VERSION, true );
	}

	public function get_name(){
		return 'pdp_hero';
	}

	public function get_title(){
		return __( 'Слайдер', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	public function get_script_depends(){
		return [ 'pdp-hero' ];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'content_tab',
			[
				'label'     => __( 'Контент', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'use_carousel',
			[
				'label'         => __( 'Использовать карусель', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'      => __( 'Да', 'pdp' ),
				'label_off'     => __( 'Нет', 'pdp' ),
				'return_value'  => 'yes',
				'default'       => ''
			]
		);

		$this->add_control(
			'image',
			[
				'label'         => __( 'Изображение', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'use_carousel'  => ''
				]
			]
		);

		$this->add_control(
			'carousel',
			[
				'label'         => __( 'Добавить изображения', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::GALLERY,
				'default'       => [],
				'condition'     => [
					'use_carousel'  => 'yes'
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' )
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' 		=> __( 'Подзаголовок', 'pdp' ),
				'label_block'   => true,
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите подзаголовок', 'pdp' ),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'action_tab',
			[
				'label'     => __( 'Действие', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btn_title',
			[
				'label' 		=> __( 'Текст кнопки', 'pdp' ),
				'label_block'   => true,
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите текст кнопки', 'pdp' ),
			]
		);

		$this->add_control(
			'btn_open_modal',
			[
				'label'         => __( 'Открывать модальное окно', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'      => __( 'Да', 'pdp' ),
				'label_off'     => __( 'Нет', 'pdp' ),
				'return_value'  => 'yes'
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' 		=> __( 'Ссылка', 'pdp' ),
				'label_block'   => true,
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку кнопки', 'pdp' ),
				'condition'     => array(
					'btn_open_modal'    => ''
				)
			]
		);

		$this->add_control(
			'btn_modal',
			[
				'label' 		=> __( 'ID модального окна', 'pdp' ),
				'label_block'   => true,
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ID модального окна', 'pdp' ),
				'condition'     => array(
					'btn_open_modal'    => 'yes'
				)
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'socials_tab',
			[
				'label'     => __( 'Социальные сети', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_socials',
			[
				'label'         => __( 'Показывать социальные сети', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'      => __( 'Показать', 'pdp' ),
				'label_off'     => __( 'Скрыть', 'pdp' ),
				'return_value'  => 'yes',
				'default'       => 'yes'
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		$image = wp_get_attachment_image( $settings['image']['id'], 'full' );

		echo "
			<div class='pdp-hero'>
            	<div class='pdp-hero__title'>
                	<h1 class='pdp-hero__heading'>
                	    <div class='pdp-hero__subheading'>{$settings['subtitle']}</div>
                	    <div>{$settings['title']}</div>
                	</h1>
                        
		";

		if( $settings['btn_open_modal'] && $settings['btn_title'] && $settings['btn_modal'] ){
			echo "<button data-micromodal-trigger='{$settings['btn_modal']}' class='btn-default pdp-hero__btn'>{$settings['btn_title']}</button>";
		}
		else if( $settings['btn_title'] && $settings['btn_link'] ){
			echo "<a href='{$settings['btn_link']}' class='btn-default pdp-hero__btn'>{$settings['btn_title']}</a>";
		}

		echo "
        	</div>
        ";

		if( $settings['use_carousel'] == 'yes' ){ ?>
			<div class="pdp-hero__slider">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php foreach( $settings['carousel'] as $item ) : ?>
							<div class="swiper-slide"><?=wp_get_attachment_image( $item['id'], 'full' ); ?></div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
			<?php
		}
		else{
			echo $image;
		}

		if( $settings['show_socials'] == 'yes' ){
			echo "<div class='pdp-hero__socials'>";
			get_template_part( 'templates/widgets/socials' );
			echo "</div>";
		}

		echo "
			</div>
		";
	}

	protected function _content_template(){

	}
}