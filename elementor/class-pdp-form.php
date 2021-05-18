<?php

class PDP_Form extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_form';
	}

	public function get_title(){
		return __( 'Форма', 'pdp' );
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
			'title',
			[
				'label'         => __( 'Заголовок формы', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder'   => __( 'Введите заголовок', 'pdp' )
			]
		);

		$this->add_control(
			'form',
			[
				'label'         => __( 'Форма', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SELECT,
				'options'       => [
					'simple'        => __( 'Простая форма записи', 'pdp' ),
					'homepage'      => __( 'Форма записи для главной', 'pdp' ),
				],
				'default'       => 'simple'
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		get_template_part( 'templates/forms/booking/' . $settings['form'] );
	}

	protected function _content_template(){

	}
}