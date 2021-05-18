<?php

class PDP_Tabs extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ){
		parent::__construct( $data, $args );

		wp_register_script( 'pdp-tabs', get_template_directory_uri() . '/js/elementor/tabs.js', [ 'elementor-frontend' ], PDP_THEME_VERSION, true );
	}

	public function get_name(){
		return 'pdp_tabs';
	}

	public function get_title(){
		return __( 'Вкладки', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	public function get_script_depends(){
		return [ 'pdp-tabs' ];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'tabs_tab',
			[
				'label' => __( 'Вкладки', 'pdp' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$tabs_menu_repeater = new \Elementor\Repeater();

		$tabs_menu_repeater->add_control(
			'title',
			[
				'label'         => __( 'Заголовок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок', 'pdp' ),
				'label_block'   => true
			]
		);

		$tabs_menu_repeater->add_control(
			'content',
			[
				'label'         => __( 'Контент', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' 	=> __( 'Введите контент', 'pdp' )
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'         => __( 'Список вкладок', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $tabs_menu_repeater->get_controls(),
				'title_field'   => '{{{ title }}}'
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		$nav_html = '';
		$content_html = '';

		echo "
			<div class='tabs'>
		";

		foreach( $settings['tabs'] as $key => $tab ){
			$active_class = ( $key == 0 ) ? 'active' : '';
			$nav_html .= "
				<li class='tabs__nav-item {$active_class}'>
					<button type='button' class='tabs__nav-btn' data-tab='{$tab['title']}'>
						<svg width='20' height='18' fill='none'><path d='M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z' fill='#0E0D0A'></path></svg>
						{$tab['title']}
					</button>
				</li>
			";

			$content_html .= "
				<div class='tabs__tab {$active_class}' data-tab='{$tab['title']}'>
					{$tab['content']}
				</div>
			";
		}

		echo "
				<ul class='tabs__nav'>
					{$nav_html}
				</ul>
				<div class='tabs__tabs'>
					{$content_html}
				</div>
			</div>
		";
	}

	protected function _content_template(){

	}
}