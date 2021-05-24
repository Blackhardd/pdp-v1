<?php

class PDP_Text extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_text';
	}

	public function get_title(){
		return __( 'Текст', 'pdp' );
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
				'label'         => __( 'Текст', 'pdp' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content',
			[
				'label'         => __( 'Текст', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' 	=> __( 'Введите текст', 'pdp' )
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
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		echo "
			<div class='text'>
                {$settings['content']}
            </div>
		";
	}

	protected function _content_template(){ ?>
		<div class="text">
			{{{ settings.content }}}
		</div>
		<?php
	}
}