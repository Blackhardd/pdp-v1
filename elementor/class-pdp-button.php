<?php

class PDP_Button extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_button';
	}

	public function get_title(){
		return __( 'Кнопка', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	protected function _register_controls(){
		$this->start_controls_section(
			'settings_tab',
			[
				'label' => __( 'Настройки', 'pdp' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Текст', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите текст', 'pdp' ),
				'default'       => __( 'Кнопка', 'pdp' )
			]
		);

		$this->add_control(
			'icon_class',
			[
				'label'         => __( 'Класс иконки IcoFont', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите название класса', 'pdp' )
			]
		);

		$this->add_control(
			'open_modal',
			[
				'label'         => __( 'Открывать модальное окно', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'      => __( 'Да', 'pdp' ),
				'label_off'     => __( 'Нет', 'pdp' ),
				'return_value'  => 'yes'
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Ссылка', 'pdp' ),
				'label_block'   => true,
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку', 'pdp' ),
				'default'       => '#',
                'condition'     => array(
                    'open_modal'    => ''
                )
			]
		);

		$this->add_control(
			'modal',
			[
				'label' 		=> __( 'ID модального окна', 'pdp' ),
				'label_block'   => true,
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ID модального окна', 'pdp' ),
				'default'       => 'modal-appointment',
				'condition'     => array(
					'open_modal'    => 'yes'
				)
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

		$icon = '';

		if( $settings['icon_class'] ){
			$icon = "<i class='{$settings['icon_class']}'></i>";
		}

		if( $settings['title'] && ( $settings['title'] || $settings['modal'] ) ){
			echo "
                <div class='button-wrap'>
            ";

			if( $settings['open_modal'] == 'yes' ){
				echo "<button class='btn-default' data-micromodal-trigger='{$settings['modal']}'>{$settings['title']}{$icon}</button>";
            }
			else{
				echo "<a href='{$settings['link']}' class='btn-default'>{$settings['title']}{$icon}</a>";
            }

			echo "
			    </div>
			";
		}
	}

	protected function _content_template(){ ?>
		<div class="button-wrap">
			<a href="{{{ settings.link }}}" class="btn-default">{{{ settings.title }}}</a>
		</div>
		<?php
	}
}