<?php

class PDP_Promotions extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ){
		parent::__construct( $data, $args );

		wp_register_script( 'pdp-promotions', get_template_directory_uri() . '/js/elementor/promotions.js', [ 'elementor-frontend', 'glider' ], PDP_THEME_VERSION, true );
	}

	public function get_name(){
		return 'pdp_promotions';
	}

	public function get_title(){
		return __( 'Акции', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-bullhorn';
	}

	public function get_categories(){
		return ['pdp'];
	}

	public function get_script_depends(){
		return [ 'pdp-promotions' ];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'content_tab',
			[
				'label'         => __( 'Контент', 'pdp' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'order',
			[
				'label'         => __( 'Сортировка', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::CHOOSE,
				'options'       => [
					'asc'           => [
						'title'         => __( 'По возрастанию', 'pdp' ),
						'icon'          => 'fa fa-sort-amount-down-alt'
					],
					'desc'      => [
						'title'         => __( 'По убыванию', 'pdp' ),
						'icon'          => 'fa fa-sort-amount-up-alt'
					]
				],
				'default'       => 'asc',
				'toggle'        => false
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		echo "
			<div class='promotions'>
		";

		foreach( pdp_get_promotions( $settings['order'] ) as $promotion ) :
			$thumbnail = get_the_post_thumbnail( $promotion->ID, 'full' );
			$type = carbon_get_post_meta( $promotion->ID, 'type' );

			add_action( 'wp_footer', function() use ( $promotion ){
				$content = wpautop( $promotion->post_content );

				echo "
					<div class='modal' id='modal-promotion-{$promotion->ID}' aria-hidden='true'>
						<div class='modal__dimmer' data-micromodal-close>
							<div class='modal__inner' role='dialog' aria-modal='true'>
								<div class='modal__header'>
									{$promotion->post_title}
								</div>
		
								<button class='modal__close btn-icon' aria-label='Close modal' data-micromodal-close><svg width='14' height='14' fill='none'><path d='M14 1.4L12.6 0 7 5.6 1.4 0 0 1.4 5.6 7 0 12.6 1.4 14 7 8.4l5.6 5.6 1.4-1.4L8.4 7 14 1.4z' fill='none'/></svg></button>
								
								<div class='modal__content'>
									{$content}
								</div>
				            </div>
			            </div>
		            </div>
				";
			} );

			echo "
				<div class='promotion' data-micromodal-trigger='modal-promotion-{$promotion->ID}'>
                	<div class='promotion__thumbnail'>
	                	{$thumbnail}
                	</div>
                	<div class='promotion__info'>
                    	<div class='promotion__title'>{$promotion->post_title}</div>
                    	<div class='promotion__footer'>
                        	<div class='promotion__dates'>
            ";

			echo ( $type == 'permanent' ) ? __( 'Постоянная акция', 'pdp' ) : '';

			echo "
            				</div>

                        	<button class='promotion__btn btn-icon'>
                            	<svg width='25' height='16' fill='none'>
                                	<path d='M24.7 8.7c.4-.4.4-1 0-1.4L18.3.9A1 1 0 1017 2.3L22.6 8l-5.7 5.7a1 1 0 001.4 1.4l6.4-6.4zM0 9h24V7H0v2z' fill='none'/>
                            	</svg>
                       		</button>
                    	</div>
            		</div>
            	</div>
			";
		endforeach;

		echo "
			</div>
		";
	}

	protected function _content_template(){ ?>

		<?php
	}
}