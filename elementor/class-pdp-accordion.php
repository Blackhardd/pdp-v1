<?php

class PDP_Accordion extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ){
		parent::__construct( $data, $args );

		wp_register_script( 'pdp-accordion', get_template_directory_uri() . '/js/elementor/accordion.js', [ 'elementor-frontend' ], PDP_THEME_VERSION, true );
	}

	public function get_name(){
		return 'pdp_accordion';
	}

	public function get_title(){
		return __( 'Аккордеон', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	public function get_script_depends(){
		return [ 'pdp-accordion' ];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'accordion_tab',
			[
				'label' => __( 'Аккордеон', 'pdp' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$accordion_repeater = new \Elementor\Repeater();

		$accordion_repeater->add_control(
			'title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' ),
				'label_block'   => true
			]
		);

		$accordion_repeater->add_control(
			'content',
			[
				'label'         => __( 'Контент', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' 	=> __( 'Введите контент', 'pdp' )
			]
		);

		$this->add_control(
			'accordion',
			[
				'label'         => __( 'Элементы аккордеона', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $accordion_repeater->get_controls(),
				'title_field'   => '{{{ title }}}'
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		echo "
			<div class='pdp-accordion'>
		";

		foreach( $settings['accordion'] as $key => $item ) :
			$active_class = ( $key == 0 ) ? 'active' : '';
			echo "
				<div class='pdp-accordion__item'>
					<button type='button' class='pdp-accordion__item-header {$active_class}'>
						<svg width='20' height='18' fill='none'><path d='M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z' fill='#0E0D0A'></path></svg>
						<div class='pdp-accordion__title'>{$item['title']}</div>
					</button>
					<div class='pdp-accordion__content'>
						{$item['content']}
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