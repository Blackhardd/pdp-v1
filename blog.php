<?php /* Template Name: Блог */

get_header(); ?>
    <section id="blog-archive-header">
        <div class="container">
            <div class="row row_1-1 gap_col_110px">
                <div class="col">
                    <?php
                    if( function_exists('yoast_breadcrumb') ){
                        yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                    } ?>

                    <div class="title mb_10px_m">
                        <h1 class="title__heading txt_fs-64px txt_lh-64px txt_fs-36px_m txt_lh-36px_m">наш блог</h1>
                    </div>

                    <div class="textBlock txt_fs-36px txt_lh-36px txt_fs-24px_m txt_lh-24px_m mb_20px mb_30px_m">
                        <p>ценные статьи, уроки, видео</p>
                    </div>

                    <div class="textBlock txt_fs-18px txt_lh-18px">
                        <p>Все, что вы хотели знать о красоте, моде, нашем салоне и работе на себя в сфере красоты.Узнавайте каждый день что-то новое вместе с нашей командой!</p>
                    </div>
                </div>

                <div class="col">
                    <div class="image d_none_m">
                        <?=wp_get_attachment_image( 375, 'full' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog-archive">
        <div class="container">
            <div class="blog-filter">
                <div class="blog-filter__sort">
                    <button class="blog-filter__sort-btn btn-icon"><svg width="18" height="12" fill="none"><path d="M0 12h6v-2H0v2zM0 0v2h18V0H0zm0 7h12V5H0v2z" fill="#000"/></svg></button>
                </div>

                <div class="blog-filter__search">
                    <button class="blog-filter__search-btn btn-icon"><svg width="18" height="18" fill="none"><path d="M12.5 11h-.8l-.3-.3c1-1.1 1.6-2.6 1.6-4.2a6.5 6.5 0 10-2.3 5l.3.2v.8l5 5 1.5-1.5-5-5zm-6 0a4.5 4.5 0 110-9 4.5 4.5 0 010 9z" fill="#000"/></svg></button>
                    <input type="text" name="keywords" class="blog-filter__search-input">
                </div>
            </div>

            <div class="blog-tags">
                <a href="#" class="blog-tags__item active">#бизнес в мире красоты</a>
                <a href="#" class="blog-tags__item">#интервью</a>
                <a href="#" class="blog-tags__item">#советы по уходу</a>
                <a href="#" class="blog-tags__item">#косметика</a>
                <a href="#" class="blog-tags__item">#топ услуги</a>
                <a href="#" class="blog-tags__item">#тренды</a>
                <a href="#" class="blog-tags__item">#новости</a>
            </div>

            <div class="blog-items_grid">
                <article class="blog-item">
                    <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>

                <article class="blog-item">
		            <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>

                <article class="blog-item">
		            <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>

                <article class="blog-item">
		            <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>

                <article class="blog-item">
		            <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>

                <article class="blog-item">
		            <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>

                <article class="blog-item">
		            <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>

                <article class="blog-item">
		            <?=wp_get_attachment_image( 376, 'full' ); ?>
                    <div class="blog-item__info">
                        <div class="blog-item__meta">
                            <div class="blog-item__likes">
                                <svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
                                <span>241</span>
                            </div>
                            <div class="blog-item__meta-separator"></div>
                            <div class="blog-item__date">March 21, 2020</div>
                        </div>
                        <h3 class="blog-item__title"><a href="#">Какой маникюр выбрать летом 2019, чтобы всегда выглядеть роскошно?</a></h3>
                        <a href="#" class="btn-default blog-item__read-more">читать статью</a>
                    </div>
                </article>
            </div>
        </div>
    </section>
<?php
get_footer();
