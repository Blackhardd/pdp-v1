<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pied-de-Poul
 */

get_header(); ?>
    <section class="breadcrumbs-wrap">
        <div class="container">
            <?php
            if( function_exists('yoast_breadcrumb') ){
                yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
            } ?>
        </div>
    </section>

    <?php
    while( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', get_post_type() );
    endwhile; ?>
<?php
get_footer();
