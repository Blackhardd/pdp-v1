<?php

class PDP_Heading extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_heading';
	}

	public function get_title(){
		return __( 'Заголовок', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'content_section',
			[
				'label'         => __( 'Контент', 'pdp' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' ),
                'default'       => __( 'Заголовок', 'pdp' )
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'         => __( 'Тэг заголовка', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SELECT,
				'options'       => [
					'h1'            => 'H1',
					'h2'            => 'H2',
					'h3'            => 'H3',
					'h4'            => 'H4',
					'h5'            => 'H5',
					'h6'            => 'H6',
					'div'           => 'DIV',
				],
				'default'       => 'h2'
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'         => __( 'Выравнивание', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::CHOOSE,
				'options'       => [
					'left'          => [
						'title'         => __( 'Слева', 'pdp' ),
						'icon'          => 'fa fa-align-left',
					],
					'center'        => [
						'title'         => __( 'Центр', 'pdp' ),
						'icon'          => 'fa fa-align-center',
					],
					'right'         => [
						'title'         => __( 'Справа', 'pdp' ),
						'icon'          => 'fa fa-align-right',
					],
				],
				'devices'       => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'     => [
					'{{WRAPPER}}'   => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		/**
		 *  Style
		 */

		$this->start_controls_section(
			'style_section',
			[
				'label'     => __( 'Заголовок', 'pdp' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'label'     => __( 'Типографика', 'plugin-domain' ),
				'scheme'    => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .title__heading'
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		echo "
			<div class='title {$settings['alignment']}'>
                <{$settings['heading_tag']} class='title__heading'>{$settings['heading']}</{$settings['heading_tag']}>
            </div>
		";
	}

	protected function _content_template(){ ?>
		<div class="title {{{ settings.alignment }}}">
			<{{{ settings.heading_tag }}} class="title__heading">{{{ settings.heading }}}</{{{ settings.heading_tag }}}>
		</div>
		<?php
	}
}