<?php
/**
 * PIED-DE-POULE functions and definitions
 *
 * @package PIED-DE-POULE
 */

if( !defined( 'PDP_THEME_VERSION' ) ) :
	define( 'PDP_THEME_VERSION', '1.0.31a' );
endif;

if( !defined( 'PDP_THEME_URL' ) ) :
	define( 'PDP_THEME_URL', get_template_directory_uri() );
endif;

if( !defined( 'PDP_THEME_DIR' ) ) :
	define( 'PDP_THEME_DIR', get_template_directory() );
endif;


if( !function_exists( 'pdp_setup' ) ) :
	function pdp_setup(){
		load_theme_textdomain( 'pdp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header-menu'           => esc_html__( 'Главное меню', 'pdp' ),
				'mobile-menu'           => esc_html__( 'Мобильное меню', 'pdp' ),
				'footer-menu-about'     => esc_html__( 'Подвал | Меню о нас', 'pdp' ),
				'footer-menu-info'      => esc_html__( 'Подвал | Меню информационное', 'pdp' ),
				'footer-salons-menu'    => esc_html__( 'Подвал | Меню салонов', 'pdp' )
			)
		);


		add_theme_support(
			'html5',
			array(
				'search-form',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);


		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pdp_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'pdp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pdp_content_width(){
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pdp_content_width', 640 );
}
add_action( 'after_setup_theme', 'pdp_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'pdp_scripts' );
function pdp_scripts(){
	wp_register_style( 'pdp-elementor-widgets', PDP_THEME_URL . '/resources/css/elementor.css', array(), PDP_THEME_VERSION );

	if( is_plugin_active( 'elementor/elementor.php' ) ){
		wp_enqueue_style( 'pdp-elementor-widgets' );
	}

	wp_enqueue_style( 'pdp-style', get_stylesheet_uri(), array(), PDP_THEME_VERSION );


	/**
     * Enqueue fonts.
     */
    wp_enqueue_style( 'pdp-fonts', PDP_THEME_URL . '/resources/css/fonts.css', array(), PDP_THEME_VERSION );


    /**
     * Enqueue theme styles.
     */
    wp_enqueue_style( 'pdp-atomic', PDP_THEME_URL . '/resources/css/atomic.css', array(), PDP_THEME_VERSION );


    /**
     * Enqueue theme responsive styles.
     */
    wp_enqueue_style( 'pdp-responsive', PDP_THEME_URL . '/resources/css/responsive.css', array(), PDP_THEME_VERSION );


    /**
     * Enqueue Animate.css
     */
    wp_enqueue_style( 'animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), PDP_THEME_VERSION );


    /**
     * Enqueue Forms script.
     */
    wp_enqueue_script( 'pdp-forms', PDP_THEME_URL . '/js/forms.js', array( 'jquery' ), PDP_THEME_VERSION, true );


	/**
	 * Enqueue Clipboard.js
	 */
	wp_enqueue_script( 'clipboard', '//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js', array( 'jquery' ), PDP_THEME_VERSION, true );


    /**
     * Enqueue slick.js.
     */
    wp_enqueue_style( 'slick', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), PDP_THEME_VERSION );
    wp_enqueue_style( 'slick-theme', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', array(), PDP_THEME_VERSION );
	wp_enqueue_script( 'slick', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array( 'jquery' ), PDP_THEME_VERSION, true );


	/**
	 * Enqueue Glider.js.
	 */
	wp_enqueue_style( 'glider', '//cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css', array(), PDP_THEME_VERSION );
	wp_enqueue_script( 'glider', '//cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js', array(), PDP_THEME_VERSION, true );


    /**
     * Enqueue jQuery.svg.
     */
	wp_enqueue_script( 'jquery-svg', '//cdnjs.cloudflare.com/ajax/libs/svg.js/3.0.16/svg.min.js', array( 'jquery' ), PDP_THEME_VERSION, true );


    /**
     * Enqueue micromodal.js
     */
    wp_enqueue_script( 'micromodal', '//cdn.jsdelivr.net/npm/micromodal@0.4.6/dist/micromodal.min.js', array(), PDP_THEME_VERSION, true );


    if( is_singular( 'salon' ) ){
        /**
         * Enqueue fancybox.js
         */
        wp_enqueue_style( 'fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), PDP_THEME_VERSION );
        wp_enqueue_script( 'fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array( 'jquery' ), PDP_THEME_VERSION, true );

        wp_enqueue_script( 'pdp-salon', PDP_THEME_URL . '/js/salon.js', array( 'jquery' ), PDP_THEME_VERSION, true );
    }


    /**
     * Enqueue Selectric.js
     */
    wp_enqueue_style( 'selectric', '//cdn.jsdelivr.net/npm/selectric@1.13.0/public/selectric.min.css', array(), PDP_THEME_VERSION );
    wp_enqueue_script( 'selectric', '//cdn.jsdelivr.net/npm/selectric@1.13.0/public/jquery.selectric.min.js', array( 'jquery' ), PDP_THEME_VERSION, true );


    /**
     * Enqueue Vue.js
     */
    wp_enqueue_script( 'vue', PDP_THEME_URL . '/js/vue.min.js', array(), PDP_THEME_VERSION, true );
    wp_enqueue_script( 'vuex', '//unpkg.com/vuex@3.6.0/dist/vuex.js', array(), PDP_THEME_VERSION, true );


    /**
     * Enqueue SimpleBar
     */
    wp_enqueue_style( 'simplebar', '//cdn.jsdelivr.net/npm/vue-simplebar@2.3.0/dist/vue-simplebar.min.css', array(), PDP_THEME_VERSION );
    wp_enqueue_script( 'simplebar', '//cdn.jsdelivr.net/npm/vue-simplebar@2.3.0/dist/vue-simplebar.umd.min.js', array(), PDP_THEME_VERSION, true );

    if( is_page_template( 'vacancies.php' ) ){
        wp_enqueue_script( 'pdp-vacancies', PDP_THEME_URL . '/js/vacancies.js', array( 'jquery' ), PDP_THEME_VERSION, true );
    }

    if( is_singular( 'post' ) ){
	    wp_enqueue_script( 'pdp-post', PDP_THEME_URL . '/js/post.js', array( 'jquery' ), PDP_THEME_VERSION, true );
    }


    /**
     * Enqueue theme script.
     */
    wp_enqueue_script( 'pdp-front', PDP_THEME_URL . '/js/script.js', array( 'jquery' ), PDP_THEME_VERSION, true );
    wp_enqueue_script( 'pdp-components', PDP_THEME_URL . '/js/components.js', array(), PDP_THEME_VERSION, true );

    wp_localize_script( 'pdp-components', 'pdp_components_data', array(
        'rest_url'              => untrailingslashit( esc_url_raw( rest_url() ) ),
        'ajax_url'              => admin_url( 'admin-ajax.php' ),
	    'gift_cards_url'        => get_permalink( 366 ),
	    'lang'                  => pll_current_language( 'slug' )
    ) );

	wp_localize_script( 'pdp-components', 'pdp_components_i18n', array(
		'your_booking'          => __( 'Ваше бронирование', 'pdp' ),
		'select_service'        => __( 'Выберите услуги', 'pdp' ),
		'fill_the_form'         => __( 'Заполните форму', 'pdp' ),
		'how_call_you'          => __( 'Как к вам обращаться?', 'pdp' ),
		'phone_number'          => __( 'Номер телефона', 'pdp' ),
		'email'                 => __( 'Электронная почта', 'pdp' ),
		'book_now'              => __( 'Записаться', 'pdp' ),
		'cost_of_services'      => __( 'Стоимость услуг', 'pdp' ),
		'enter_a_name'          => __( 'Укажите имя', 'pdp' ),
		'enter_a_phone'         => __( 'Укажите номер телефона', 'pdp' ),
		'no_services'           => __( 'Вы не выбрали услуги', 'pdp' ),
		'hair_length_1st'       => __( 'от 5-15 см', 'pdp' ),
		'hair_length_2nd'       => __( 'от 15 - 25 см (выше плеч, каре, боб)', 'pdp' ),
		'hair_length_3rd'       => __( 'от 25 - 40 см (ниже плеч/выше лопаток)', 'pdp' ),
		'hair_length_4th'       => __( 'от 40 - 60 см (ниже лопаток)', 'pdp' ),
		'required_field'        => __( 'Обязательное поле', 'pdp' ),
		'wrong_format'          => __( 'Неверный формат', 'pdp' ),
		'no_selected_option'    => __( 'Вы не выбрали опцию', 'pdp' ),
		'name_shorter'          => __( 'Должно быть больше 3-х символов', 'pdp' ),
		'name_longer'           => __( 'Должно быть меньше 25 символов', 'pdp' ),
	) );

    wp_localize_script( 'pdp-forms', 'pdp_forms_data', array(
        'ajax_url'              => admin_url( 'admin-ajax.php' )
    ) );

	wp_localize_script( 'pdp-forms', 'pdp_forms_i18n', array(
		'required_field'        => __( 'Обязательное поле', 'pdp' ),
		'wrong_format'          => __( 'Неверный формат', 'pdp' ),
		'no_selected_option'    => __( 'Вы не выбрали опцию', 'pdp' ),
		'name_shorter'          => __( 'Должно быть больше 3-х символов', 'pdp' ),
		'name_longer'           => __( 'Должно быть меньше 25 символов', 'pdp' ),
	) );

	wp_localize_script( 'pdp-post', 'pdpData', array(
		'ajaxurl'               => admin_url( 'admin-ajax.php' )
	) );

	wp_localize_script( 'pdp-front', 'pdp', array(
		'booking_url'           => get_permalink( pll_get_post( 66 ) )
	) );
}


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require PDP_THEME_DIR . '/inc/framework.php';


/**
 *  Template Modals
 */
require PDP_THEME_DIR . '/inc/modals.php';


/**
 * Elementor widgets.
 */
if( pdp_is_plugin_active( 'elementor/elementor.php' ) ) :
	require PDP_THEME_DIR . '/inc/elementor.php';
endif;


/**
 * Carbon fields.
 */
add_action( 'carbon_fields_register_fields', function(){
	require PDP_THEME_DIR . '/inc/theme-settings.php';
	require PDP_THEME_DIR . '/inc/carbon-meta-fields.php';
} );