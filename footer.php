<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pied-de-Poul
 */ ?>

    </article>

    <footer class="main-footer">
        <div class="container">
            <div class="footer">
                <div class="row row_1-1">
                    <div class="col">
                        <?php get_template_part( 'templates/header/site-logo' ); ?>

                        <div class="footer__socials">
                            <?php get_template_part( 'templates/widgets/socials' ); ?>
                        </div>
                    </div>

                    <div class="col">
                        <div class="row row_1-1">
                            <div class="col">
                                <nav class="footer-menu">
                                    <div class="footer-menu__title">О салоне</div>
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-menu-about',
                                            'menu_id'        => 'footer-menu-about',
                                        )
                                    ); ?>
                                </nav>

                                <nav class="footer-menu">
                                    <div class="footer-menu__title">Информация</div>
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-menu-info',
                                            'menu_id'        => 'footer-menu-info',
                                        )
                                    ); ?>
                                </nav>
                            </div>

                            <div class="col">
                                <nav class="footer-menu footer-menu_salons">
                                    <div class="footer-menu__title">Салоны</div>
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-salons-menu',
                                            'menu_id'        => 'footer-salons-menu',
                                        )
                                    ); ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</main>
<?php wp_footer(); ?>
</body>
</html>
