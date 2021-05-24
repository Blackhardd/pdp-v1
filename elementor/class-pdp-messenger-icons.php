<?php

class PDP_Messenger_Icons extends \Elementor\Widget_Base {
	public function get_name(){
		return 'pdp_messengers';
	}

	public function get_title(){
		return __( 'Мессенджеры', 'pdp' );
	}

	public function get_icon(){
		return 'fa fa-code';
	}

	public function get_categories(){
		return ['pdp'];
	}

	protected function _register_controls(){
		$this->start_controls_section(
			'telegram_tab',
			[
				'label'         => __( 'Telegram', 'pdp' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'telegram_link',
			[
				'label'         => __( 'Ссылка', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку', 'pdp' )
			]
		);

		$this->add_control(
			'telegram_icon',
			[
				'label'         => __( 'Иконка', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'viber_tab',
			[
				'label'         => __( 'Viber', 'pdp' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'viber_link',
			[
				'label'         => __( 'Ссылка', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Введите ссылку', 'pdp' )
			]
		);

		$this->add_control(
			'viber_icon',
			[
				'label'         => __( 'Иконка', 'pdp' ),
				'label_block'   => true,
				'type'          => \Elementor\Controls_Manager::MEDIA,
				'default'       => [
					'url'           => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_tab',
			[
				'label'         => __( 'Настройки', 'pdp' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
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
						'icon'          => 'fa fa-align-left'
					],
					'center'        => [
						'title'         => __( 'Центр', 'pdp' ),
						'icon'          => 'fa fa-align-center'
					],
					'right'         => [
						'title'         => __( 'Справа', 'pdp' ),
						'icon'          => 'fa fa-align-right'
					]
				],
				'devices'       => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'     => [
					'{{WRAPPER}}'   => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();

		if( ( $settings['telegram_link'] && $settings['telegram_icon'] ) || ( $settings['viber_link'] && $settings['viber_icon'] ) ) :
            echo "
                <div class='messengers'>
                    <ul>
            ";

		    echo ( $settings['telegram_link'] && $settings['telegram_icon'] ) ? "<li><a href='{$settings['telegram_link']}' target='_blank'><img src='{$settings['telegram_icon']['url']}' alt='Telegram'></a></li>" : "";
		    echo ( $settings['viber_link'] && $settings['viber_icon'] ) ? "<li><a href='{$settings['viber_link']}' target='_blank'><img src='{$settings['viber_icon']['url']}' alt='Viber'></a></li>" : "";

		    echo "
		            </ul>
		        </div>
		    ";
		endif;
	}

	protected function _content_template(){ ?>
        <# if( ( settings.telegram_link && settings.telegram_icon ) || ( settings.viber_link && settings.viber_icon ) ){ #>
            <div class='messengers'>
                <ul>
                    <# if( settings.telegram_link && settings.telegram_icon ){ #>
                        <li>
                            <a href="{{{ settings.telegram_link }}}" target="_blank"><img src="{{{ settings.telegram_icon.url }}}" alt="Telegram"></a>
                        </li>
                    <# } #>
                    <# if( settings.viber_link && settings.viber_icon ){ #>
                        <li>
                            <a href="{{{ settings.viber_link }}}" target="_blank"><img src="{{{ settings.viber_icon.url }}}" alt="Viber"></a>
                        </li>
                    <# } #>
                </ul>
            </div>
        <# } #>
		<?php
	}
}