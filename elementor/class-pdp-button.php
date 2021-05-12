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
		return ['general'];
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
				'label'         => __( 'Заголовок кнопки', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите заголовок кнопки', 'pdp' ),
				'default'       => __( 'Кнопка', 'pdp' )
			]
		);

		$this->add_control(
			'icon_class',
			[
				'label'         => __( 'Класс иконки IcoFont', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите название класса', 'pdp' )
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Ссылка', 'pdp' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку кнопки', 'pdp' ),
				'default'       => '#'
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' 		=> __( 'Выравнивание', 'pdp' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 	    => 'left',
				'options'       => [
					'left'          => __( 'Слева', 'pdp' ),
					'center'        => __( 'Центр', 'pdp' ),
					'right'         => __( 'Справа', 'pdp' )
				]
			]
		);

		$this->add_control(
			'mobile_centering',
			[
				'label'         => __( 'Выровнять на мобилке по центру', 'pdp' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'      => __( 'Да', 'pdp' ),
				'label_off'     => __( 'Нет', 'pdp' ),
				'return_value'  => 'yes',
				'default'       => ''
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		$icon = '';
		$classes = 'button-wrap ';

		if( $settings['mobile_centering'] == 'yes' ){
			$classes .= 'button-wrap--m-center';
		}

		if( $settings['icon_class'] ){
			$icon = "<i class='{$settings['icon_class']}'></i>";
		}

		if( $settings['title'] && $settings['link'] ){
			echo "
                <div class='{$classes}' style='text-align: {$settings['alignment']};'>
                    <a href='{$settings['link']}' class='button'>{$settings['title']}{$icon}</a>
                </div>
            ";
		}
	}

	protected function _content_template(){ ?>
		<div class="button-wrap" style="text-align: {{{ settings.alignment }}};">
			<a href="{{{ settings.link }}}" class="btn-default">{{{ settings.title }}}</a>
		</div>
		<?php
	}
}