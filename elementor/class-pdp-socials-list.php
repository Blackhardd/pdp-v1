<?php

class PDP_Socials_List extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_socials_list';
	}

	public function get_title(){
		return __( 'Список социальных сетей', 'pdp' );
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

		$media_repeater = new \Elementor\Repeater();

		$media_repeater->add_control(
			'icon',
			[
				'label'         => __( 'Выберите картинку', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$media_repeater->add_control(
			'link_title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' ),
				'label_block'   => true
			]
		);

		$media_repeater->add_control(
			'link_url',
			[
				'label'         => __( 'Ссылка', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылка', 'pdp' )
			]
		);

		$media_repeater->add_control(
			'link_desc',
			[
				'label'         => __( 'Описание', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Введите описание', 'pdp' )
			]
		);

		$this->add_control(
			'socials',
			[
				'label'         => __( 'Социальные сети', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $media_repeater->get_controls(),
				'title_field'   => '{{{ link_title }}}'
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		$image = wp_get_attachment_image( $settings['image']['id'], 'full' );

		echo "
			<div class='socials-list'>
				<div class='socials-list__image'>
					{$image}
				</div>
				<div class='socials-list__content'>
					<h3 class='socials-list__title'>
						{$settings['title']}
					</h3>
					<ul>
		";

		foreach( $settings['socials'] as $item ) :
			$social_image = wp_get_attachment_image( $item['icon']['id'] );
			echo "
				<li>
					<a href='{$item['link_url']}' target='_blank'>
						{$social_image}
						{$item['link_title']}
					</a>
					<span>{$item['link_desc']}</span>
				</li>
			";
		endforeach;

		echo "
					</ul>
				</div>
			</div>
		";
	}

	protected function _content_template(){

	}
}