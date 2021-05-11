<?php

class PDP_Hero extends \Elementor\Widget_Base {
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

	protected function register_controls(){
		$this->start_controls_section(
			'content_tab',
			[
				'label' => __( 'Контент', 'pdp' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'         => __( 'Изображение', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src(),
				]
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

		$this->add_control(
			'subtitle',
			[
				'label' 		=> __( 'Подзаголовок', 'pdp' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите подзаголовок', 'pdp' ),
			]
		);

		$this->add_control(
			'btn_title',
			[
				'label' 		=> __( 'Заголовок кнопки', 'pdp' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок кнопки', 'pdp' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' 		=> __( 'Ссылка кнопки', 'pdp' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку кнопки', 'pdp' ),
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
                	<div class='pdp-hero__subheading'>{$settings['subtitle']}</div>
                	<h1 class='pdp-hero__heading'>{$settings['title']}</h1>
                        
		";

		if( $settings['btn_title'] && $settings['btn_link'] ){
			echo "<a href='{$settings['btn_link']}' class='btn-default pdp-hero__btn'>{$settings['btn_title']}</a>";
		}

		echo "
                </div>
                {$image}
        ";

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