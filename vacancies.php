<?php /* Template Name: Вакансии */

get_header();

$vacancies = get_posts( array(
    'numberposts'   => -1,
    'post_type'     => 'vacancy'
) );

$details_html = ''; ?>

    <main>
        <section id="vacancies-header">
            <div class="container">
                <?php
                if( function_exists('yoast_breadcrumb') ){
                    yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
                } ?>

                <div class="title">
                    <div class="title__subtitle">
                        <?=sprintf( __( 'Свежие вакансии %s', 'pdp' ), 'PIED&#8209;DE&#8209;POULE:' ); ?>
                    </div>
                    <h1 class="title__heading"><?=__( 'Открытые вакансии', 'pdp' ); ?></h1>
                </div>
            </div>
        </section>

        <section id="vacancies">
            <div class="container">
                <div class="vacancies">
                    <div class="vacancies__list">
                        <ul>
                            <?php foreach( $vacancies as $key => $vacancy ){ ?>
                                <li class="vacancies__item <?php echo ( $key == 0 ) ? 'active' : ''; ?>">
                                    <div class="vacancies__item-icon"><svg width="18" height="18" fill="none"><path d="M14.4 3.5V0l-3.6 3.5H7.2L0 10.6h3.6l3.6-3.5v3.5h3.6l-3.6 3.6v3.5l7.2-7V7L18 3.5h-3.6z" fill="none"/></svg></div>
                                    <button class="vacancies__item-btn" data-vacancy="<?=$vacancy->ID; ?>" data-title="<?=$vacancy->post_title; ?>">
                                        <?=$vacancy->post_title; ?>
                                        <?php if( carbon_get_post_meta( $vacancy->ID, 'actual' ) == 'true' ){ ?>
                                            <span class="vacancies__item-badge"><?=__( 'Актуально!', 'pdp' ); ?></span>
                                        <?php } ?>
                                    </button>
                                </li>
                                <?php
                                $active_class = ( $key == 0 ) ? 'active' : '';
                                $details_html .= "
                                    <div class='vacancies__details-block {$active_class}' data-vacancy='{$vacancy->ID}'>
                                        <h2>{$vacancy->post_title}</h2>
                                        <div class='vacancies__content'>{$vacancy->post_content}</div>
                                    </div>
                                ";
                            } ?>
                        </ul>
                    </div>

                    <div class="vacancies__details">
                        <?=$details_html; ?>
                        <div class="vacancies__form">
                            <h3><?=__( 'Оставить заявку', 'pdp' ); ?></h3>
                            <?php get_template_part( 'templates/forms/job-apply' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>
