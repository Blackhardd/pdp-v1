<?php

class PDP_Franchise extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_franchise';
	}

	public function get_title(){
		return __( 'Блок франшизы', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'title_tab',
			[
				'label'     => __( 'Заголовок блока', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' )
			]
		);

		$this->add_control(
			'title_description',
			[
				'label'         => __( 'Описание', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Введите описание', 'pdp' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'advantages_tab',
			[
				'label'     => __( 'Преимущества', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$requirements_repeater = new \Elementor\Repeater();

		$requirements_repeater->add_control(
			'title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' ),
				'label_block'   => true
			]
		);

		$requirements_repeater->add_control(
			'subtitle',
			[
				'label'         => __( 'Подзаголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите подзаголовок', 'pdp' )
			]
		);

		$this->add_control(
			'requirements',
			[
				'label'         => __( 'Информация', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $requirements_repeater->get_controls(),
				'title_field'   => '{{{ title }}}'
			]
		);

		$advantages_repeater = new \Elementor\Repeater();

		$advantages_repeater->add_control(
			'title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' ),
				'label_block'   => true
			]
		);

		$advantages_repeater->add_control(
			'image',
			[
				'label'     => __( 'Изображение', 'pdp' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'       => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'advantages',
			[
				'label'         => __( 'Список преимуществ', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $advantages_repeater->get_controls(),
				'title_field'   => '{{{ title }}}'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'action_tab',
			[
				'label'     => __( 'Призыв', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'action_call',
			[
				'label'         => __( 'Текст призыва', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Введите текст', 'pdp' )
			]
		);

		$this->add_control(
			'action_button_title',
			[
				'label'         => __( 'Текст кнопки', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите текст кнопки', 'pdp' )
			]
		);

		$this->add_control(
			'action_button_url',
			[
				'label'         => __( 'Ссылка', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку', 'pdp' )
			]
		);

		$this->add_control(
			'action_phone',
			[
				'label'         => __( 'Номер телефона', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Введите номер', 'pdp' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'founders_tab',
			[
				'label'     => __( 'Основатели', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'founders_title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' )
			]
		);

		$this->add_control(
			'founders_text',
			[
				'label'         => __( 'Текст', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Введите текст', 'pdp' )
			]
		);

		$this->add_control(
			'founders_image',
			[
				'label'         => __( 'Изображение', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		ob_start(); ?>
			<div class="franchise">
				<div class="franchise__title title">
					<h3 class="title__heading"><?=$settings['title_heading']; ?></h3>
					<div class="title__description">
						<?=$settings['title_description']; ?>
					</div>
				</div>

				<div class="franchise__requirements">
					<?php foreach( $settings['requirements'] as $item ) : ?>
						<div class="infoBox">
							<div class="infoBox__title"><?=$item['title']; ?></div>
							<div class="infoBox__subtitle"><?=$item['subtitle']; ?></div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="franchise__founders founders">
					<?=wp_get_attachment_image( $settings['founders_image']['id'], 'full' ); ?>
					<div class="founders__badge">
						<div class="founders__title"><?=$settings['founders_title']; ?></div>
						<div class="founders__desc"><?=$settings['founders_text']; ?></div>
					</div>
				</div>

				<div class="franchise__advantages">
					<?php foreach( $settings['advantages'] as $item ) : ?>
						<div class="iconBox">
							<?=wp_get_attachment_image( $item['image']['id'] ); ?>
							<div class="iconBox__title"><?=$item['title']; ?></div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="franchise__cta cta cta--franchise">
					<div class="cta__content"><?=$settings['action_call']; ?></div>
					<div class="cta__footer">
						<a href="<?=$settings['action_button_url']; ?>" class="cta__btn btn-default" target="_blank"><?=$settings['action_button_title']; ?></a>
						<div class="cta__phone">
							<?=$settings['action_phone']; ?>
						</div>
					</div>
				</div>
			</div>
		<?php
		echo ob_get_clean();
	}

	protected function _content_template(){

	}
}