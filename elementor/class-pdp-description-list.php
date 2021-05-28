<?php

class PDP_Description_List extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_list_large';
	}

	public function get_title(){
		return __( 'Список терминов', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-list';
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' )
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'         => __( 'Описание', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' 	=> __( 'Введите описание', 'pdp' )
			]
		);

		$this->add_control(
			'list',
			[
				'label'         => __( 'Термины', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls()
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		echo "
			<dl class='description-list'>
		";

		foreach( $settings['list'] as $item ) :
			echo "
				<div class='description-item'>
					<dt>{$item['title']}</dt>
					<dd>{$item['content']}</dd>
				</div>
			";
		endforeach;

		echo "
			</dl>
		";
	}

	protected function _content_template(){

	}
}