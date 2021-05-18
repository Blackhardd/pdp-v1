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
			'content_section',
			[
				'label' => __( 'Контент', 'pdp' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content',
			[
				'label'         => __( 'Контент', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' 	=> __( 'Введите текст', 'pdp' )
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