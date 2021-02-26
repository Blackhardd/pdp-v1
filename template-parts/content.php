<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pied-de-Poul
 */
?>

<div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post-sidebar">
            <div class="post-actions">
                <div class="post-actions__likes">
                    <button class="btn-icon" data-post-like="<?=get_the_ID(); ?>">
                        <svg width="22" height="21" fill="none"><path d="M11 4.07l-.73.7.73.76.73-.77-.73-.69zm1.45-1.52l-.73-.7.73.7zM19.53 10l.73.69-.73-.69zM11 19l-.73.69.73.76.73-.76L11 19zm8.53-16.45l.73-.7-.73.7zm-9.98 0l.73-.7-.73.7zM2.47 10l-.73.69.73-.69zm0-7.46l-.73-.7.73.7zm9.26 2.21l1.44-1.53-1.45-1.37-1.45 1.52 1.46 1.38zm7.08 4.56l-8.54 9 1.46 1.37 8.53-9-1.45-1.37zm0-6.09a4.48 4.48 0 010 6.1l1.45 1.37a6.48 6.48 0 000-8.84L18.8 3.23zm-5.64 0a3.83 3.83 0 015.64 0l1.45-1.37a5.83 5.83 0 00-8.54 0l1.45 1.37zm-1.44.15l-1.45-1.52-1.45 1.37 1.44 1.53 1.46-1.38zM1.74 10.7l8.53 8.99 1.46-1.38-8.54-8.99-1.45 1.38zm0-8.84a6.48 6.48 0 000 8.84L3.2 9.32a4.48 4.48 0 010-6.09L1.74 1.86zm8.54 0a5.83 5.83 0 00-8.54 0L3.2 3.23a3.83 3.83 0 015.64 0l1.45-1.37z" fill="#392BDF"/></svg>
                    </button>
                    <span><?=pdp_get_post_likes(); ?></span>
                </div>
                <div class="post-actions__share">
                    <button class="btn-icon" data-micromodal-trigger="modal-share-post">
                        <svg width="22" height="22" fill="none"><path d="M9.12 16.77l-2.6 2.6a2.75 2.75 0 11-3.88-3.9l5.18-5.18a2.75 2.75 0 013.9 0A.92.92 0 1013 8.99a4.58 4.58 0 00-6.48 0l-5.19 5.19a4.58 4.58 0 106.48 6.48l2.6-2.6a.92.92 0 10-1.3-1.3z" fill="#392BDF"/><path d="M20.66 1.34a4.58 4.58 0 00-6.48 0l-3.11 3.11a.92.92 0 101.3 1.3l3.1-3.11a2.75 2.75 0 013.9 3.89l-5.71 5.7a2.75 2.75 0 01-3.9 0 .92.92 0 00-1.29 1.3 4.58 4.58 0 006.48 0l5.7-5.7a4.58 4.58 0 000-6.49z" fill="#392BDF"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="post-content">
            <header class="post-header">
                <div class="post-header__content">
                    <div class="post-header__date"><?php the_date(); ?></div>
                    <h1 class="post-header__title"><?php the_title(); ?></h1>
                    <div class="post-header__excerpt"><?php the_excerpt(); ?></div>

                    <div class="post-header__socials">
	                    <?php get_template_part( 'templates/widgets/socials' ); ?>
                    </div>
                </div>

                <div class="post-header__thumbnail"><?php the_post_thumbnail( 'blog-header' ); ?></div>
            </header>

            <div class="post-body">
		        <?php the_content(); ?>

                <div class="post-relink" style="display: none;">
                    <div class="post-relink__title"><?=__( 'Читайте также:', 'pdp' ); ?></div>
                    <a href="#" class="post-relink__link">10 шагов к превращению нового клиента в фаната вашего салона</a>
                </div>
            </div>

            <footer class="post-footer">
                <?php get_template_part( 'templates/blog/single/related' ); ?>
            </footer>
        </div>
    </article>
</div>

