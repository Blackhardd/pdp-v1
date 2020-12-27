<?php
/**
 * Pied-de-Poul functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pied-de-Poul
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.12' );
}

if ( ! function_exists( 'pdp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pdp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pied-de-Poul, use a find and replace
		 * to change 'pdp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pdp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
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

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
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
function pdp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pdp_content_width', 640 );
}
add_action( 'after_setup_theme', 'pdp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pdp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pdp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pdp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pdp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pdp_scripts() {
	wp_enqueue_style( 'pdp-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pdp-style', 'rtl', 'replace' );

	/**
     * Enqueue fonts.
     */
    wp_enqueue_style( 'pdp-fonts', get_template_directory_uri() . '/resources/css/fonts.css', array(), _S_VERSION );

    /**
     * Enqueue theme styles.
     */
    wp_enqueue_style( 'pdp-theme', get_template_directory_uri() . '/resources/css/theme.css', array(), _S_VERSION );

    /**
     * Enqueue theme responsive styles.
     */
    wp_enqueue_style( 'pdp-responsive', get_template_directory_uri() . '/resources/css/responsive.css', array(), _S_VERSION );

    /**
     * Enqueue Animate.css
     */
    wp_enqueue_style( 'animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), _S_VERSION );

    /**
     * Enqueue Imask.js
     */
    wp_enqueue_script( 'imask', '//cdnjs.cloudflare.com/ajax/libs/imask/6.0.5/imask.min.js', array(), _S_VERSION, true );

    /**
     * Enqueue FormValidation.js.
     */
    wp_enqueue_script( 'parsley', '//cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js', array( 'jquery' ), _S_VERSION, true );
    wp_enqueue_script( 'parsley-i18n-ru', get_template_directory_uri() . '/js/i18n/parsley-i18n-ru.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'pdp-forms', get_template_directory_uri() . '/js/forms.js', array(), _S_VERSION, true );

	/**
	 * Enqueue Clipboard.js
	 */
	wp_enqueue_script( 'clipboard', '//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js', array( 'jquery' ), _S_VERSION, true );

    /**
     * Enqueue slick.js.
     */
    wp_enqueue_style( 'slick', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), _S_VERSION );
    wp_enqueue_style( 'slick-theme', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', array(), _S_VERSION );
	wp_enqueue_script( 'slick', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array(), _S_VERSION, true );

	/**
	 *  Enqueue Swiper.js
	 */
	//wp_enqueue_style( 'swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css', array(), _S_VERSION );
	//wp_enqueue_script( 'swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js', array(), _S_VERSION, true );

    /**
     * Enqueue jQuery.svg.
     */
	wp_enqueue_script( 'jquery-svg', '//cdnjs.cloudflare.com/ajax/libs/svg.js/3.0.16/svg.min.js', array(), _S_VERSION, true );

    /**
     * Enqueue micromodal.js
     */
    wp_enqueue_script( 'micromodal', '//cdn.jsdelivr.net/npm/micromodal@0.4.6/dist/micromodal.min.js', array(), _S_VERSION, true );


    if( is_singular( 'salon' ) ){
        /**
         * Enqueue fancybox.js
         */
        wp_enqueue_style( 'fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), _S_VERSION );
        wp_enqueue_script( 'fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array(), _S_VERSION, true );

        wp_enqueue_script( 'pdp-salon', get_template_directory_uri() . '/js/salon.js', array(), _S_VERSION, true );
    }


    /**
     * Enqueue Selectric.js
     */
    wp_enqueue_style( 'selectric', '//cdn.jsdelivr.net/npm/selectric@1.13.0/public/selectric.min.css', array(), _S_VERSION );
    wp_enqueue_script( 'selectric', '//cdn.jsdelivr.net/npm/selectric@1.13.0/public/jquery.selectric.min.js', array(), _S_VERSION, true );

    /**
     * Enqueue Vue.js
     */
    wp_enqueue_script( 'vue', '//cdn.jsdelivr.net/npm/vue', array(), _S_VERSION, true );
    wp_enqueue_script( 'vuex', '//unpkg.com/vuex@3.6.0/dist/vuex.js', array(), _S_VERSION, true );

    /**
     * Enqueue SimpleBar
     */
    wp_enqueue_style( 'simplebar', '//cdn.jsdelivr.net/npm/vue-simplebar@2.3.0/dist/vue-simplebar.min.css', array(), _S_VERSION );
    wp_enqueue_script( 'simplebar', '//cdn.jsdelivr.net/npm/vue-simplebar@2.3.0/dist/vue-simplebar.umd.min.js', array(), _S_VERSION, true );

    if( is_page_template( 'vacancies.php' ) ){
        wp_enqueue_script( 'pdp-vacancies', get_template_directory_uri() . '/js/vacancies.js', array(), _S_VERSION, true );
    }

	if( is_page_template( 'promotions.php' ) ){
		wp_enqueue_script( 'pdp-promotions', get_template_directory_uri() . '/js/promotions.js', array(), _S_VERSION, true );
	}

    if( is_singular( 'post' ) ){
	    wp_enqueue_script( 'pdp-post', get_template_directory_uri() . '/js/post.js', array(), _S_VERSION, true );
    }

    /**
     * Enqueue theme script.
     */
    wp_enqueue_script( 'pdp-front', get_template_directory_uri() . '/js/script.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'pdp-components', get_template_directory_uri() . '/js/components.js', array(), _S_VERSION, true );

    wp_localize_script( 'pdp-components', 'pdpVueData', array(
        'rest_url'          => untrailingslashit( esc_url_raw( rest_url() ) ),
        'ajax_url'          => admin_url( 'admin-ajax.php' ),
	    'gift_cards_url'    => get_permalink( 366 )
    ) );

    wp_localize_script( 'pdp-forms', 'pdpData', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ) );

	wp_localize_script( 'pdp-post', 'pdpData', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pdp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';