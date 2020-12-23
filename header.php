<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pied-de-Poul
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if( is_home() && isset($_GET['orderby']) ){
        echo '<meta name="robots" content="noindex, nofollow">';
    }
    ?>

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php rel_canonical(); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main>
	<header id="header-app" class="main-header">
        <div class="header">
            <div class="container">
                <?php get_template_part( 'templates/header/site-logo' ); ?>

                <nav class="main-navigation">
                    <?php
                    wp_nav_menu( array(
                            'theme_location'    => 'header-menu',
                            'menu_id'           => 'primary-menu',
                            'walker'            => new PDP_Core_Walker_Nav_Menu()
                        )
                    ); ?>
                </nav>

                <?php get_template_part( 'templates/header/phones-list' ); ?>
            </div>
        </div>

        <div class="header_mobile">
            <div class="container">
                <button class="btn-icon" @click="togglePhonesList">
                    <svg width="28" height="28" fill="none">
                        <path d="M6 12.2c2 4.2 5.6 7.7 9.8 9.9l3.3-3.3c.4-.4 1-.6 1.5-.4 1.7.6 3.5.9 5.4.9.8 0 1.5.6 1.5 1.5V26c0 .8-.7 1.5-1.5 1.5C12 27.5.5 16.1.5 2 .5 1.2 1.2.5 2 .5h5.3c.8 0 1.5.7 1.5 1.5 0 1.9.3 3.7.8 5.4.2.5 0 1-.4 1.5L6 12.2z" fill="#0E0D0A"/>
                    </svg>
                </button>

                <?php get_template_part( 'templates/header/site-logo', NULL, array( 'classes' => 'site-logo_mobile' ) ); ?>

                <button class="btn-icon mobile-navigation-toggle" @click="toggleMenu">
                    <div class="cart-counter">{{ cartItems }}</div>
                    <svg width="28" height="18" fill="none">
                        <path d="M.5 18h27v-3H.5v3zm0-7.5h27v-3H.5v3zM.5 0v3h27V0H.5z" fill="#0E0D0A"/>
                    </svg>
                </button>
            </div>
        </div>

        <?php get_template_part( 'templates/header/phones-list-mobile' ); ?>

        <nav class="mobile-navigation" :class="{ active: isMobileMenuActive }">
            <div class="mobile-navigation__close" @click="closeMenus">
                <button class="btn-icon" style="transform: rotate(180deg)">
                    <svg width="20" height="20" fill="none"><path d="M20 10a10 10 0 10-20 0 10 10 0 0020 0zM8 10l4-4v8l-4-4z" fill="#392BDF"/></svg>
                </button>
            </div>

            <div class="mobile-navigation__inner">
                <div class="appointment-mobile">
                    <button class="appointment-mobile__btn" @click="toggleMobileCart">
                        <div class="appointment-mobile__counter">{{ cartItems }}</div>
                        <svg width="22" height="28" fill="none"><path d="M18.5.5h-15a3 3 0 00-3 3v24L11 23l10.5 4.5v-24a3 3 0 00-3-3zm0 22.5L11 19.7 3.5 23V3.5h15V23z" fill="#000"/></svg> Запись
                    </button>
                </div>

	            <?php
	            wp_nav_menu( array(
			            'theme_location'    => 'mobile-menu',
			            'menu_id'           => 'primary-menu-mobile',
			            'walker'            => new PDP_Core_Walker_Nav_Menu()
		            )
	            ); ?>

	            <?php get_template_part( 'templates/widgets/socials' ); ?>
            </div>
        </nav>

        <div class="cart-wrapper" :class="{ active: isCartActive }">
            <div class="cart cart_header" ref="cart">
                <cart />
            </div>
        </div>

        <div class="dimmer darkening" @click="closeMenus"></div>
	</header>

    <article class="main-article">
