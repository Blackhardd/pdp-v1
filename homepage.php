<?php
/**
 * Template Name: Главная страница
 *
 * @package PDP
 */

get_header(); ?>

    <section id="hero-home">
        <div class="hero">
            <div class="hero__title">
                <div class="hero__subheading">сеть салонов красоты в Киеве</div>
                <h1 class="hero__heading">время почистить пёрышки</h1>
                <button class="hero__btn btn-default" data-micromodal-trigger="modal-appointment">online запись</button>
            </div>

            <?=wp_get_attachment_image( 15, 'full' ); ?>

            <div class="hero__socials">
                <?php get_template_part( 'templates/widgets/socials' ); ?>
            </div>
        </div>
    </section>

    <section id="home-services">
        <div class="container">
            <div class="title mb_20px">
                <h3 class="title__heading txt_fs-18px_m txt_lh-18px_m">
                    услуги и цены<br>
                    <span>в наших салонах красоты</span>
                </h3>
            </div>

            <?php get_template_part( 'templates/widgets/services_slider' ); ?>
        </div>
    </section>

    <section id="home-about">
        <div class="container">
            <div class="title mb_40px">
                <h2 class="title__heading txt_fs-20px_m txt_lh-20px_m">
                    <span>что вы должны знать</span><br>
                    о PIED&#8209;DE&#8209;POULE?
                </h2>
            </div>

            <div class="tabs d_none_m">
                <ul class="tabs__nav">
                    <li class="tabs__nav-item active">
                        <button type="button" class="tabs__btn" data-tab="equipment">
                            <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                            оборудование
                        </button>
                    </li>
                    <li class="tabs__nav-item">
                        <button type="button" class="tabs__btn" data-tab="service">
                            <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                            сервис
                        </button>
                    </li>
                    <li class="tabs__nav-item">
                        <button type="button" class="tabs__btn" data-tab="atmosphere">
                            <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                            атмосфера
                        </button>
                    </li>
                </ul>

                <div class="tabs__tabs">
                    <div class="tabs__tab active" data-tab="equipment">
                        <ol class="ol_style-03 mw_550px">
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Мы используем медицинскую стерилизацию.</div>
                                    Автоклавы <b>IS YESON</b> - это означает что вы можете не переживать за безопасность делая услуги у нас.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Современное оборудование.</div>
                                    Фены <b>Dyson</b> - это означает, что при укладке ваши волосы будут сохранять естественный блеск и не будут повреждаться.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Косметика проверенных брендов.</div>
                                    Мы подобрали средства, которые дают результат. Для нас вопрос качества косметики №1, так как это залог качественных услуг.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Самые новые техники стрижек.</div>
                                    Мы в курсе того, что носят девушки и парни с обложек. Мы им делаем прически.
                                </div>
                            </li>
                        </ol>
                    </div>

                    <div class="tabs__tab" data-tab="service">
                        <ol class="ol_style-03 mw_550px">
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Высококлассный сервис.</div>
                                    который отражается не только во внимании к гостям, но и в конечной пользе для каждого.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">В нашем арсенале более 100 видов услуг.</div>
                                    В нашем арсенале <b>более 100 видов услуг</b> в областях парикмахерского искусства, визажа, ногтевой эстетики и косметологии.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Команда высококвалифицированных мастеров.</div>
                                    Которые любят свое ремесло. Мастера с опытом до 20 лет - и этот опыт в вашем распоряжении.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Исключительное качество услуг по ценам обычных салонов.</div>
                                    Это одна из наших миссий, создать дисбаланс цены и качества.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Детальная диагностика для подбора идеального образа.</div>
                                    Вам не просто сделаю услугу, а подскажут, что будет лучшим вариантом именно для вас, учитывая все индивидуальные особенности и предпочтения в стиле.
                                </div>
                            </li>
                        </ol>
                    </div>

                    <div class="tabs__tab" data-tab="atmosphere">
                        <ol class="ol_style-03 mw_550px">
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Простая, доброжелательная и безоценочная атмосфера.</div>
                                    Для нас лично это очень важный момент. Ведь наша работа это большая часть нашей жизни.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Делаем 2-3 услуги одновременно.</div>
                                    Стараемся максимально экономить ваше время.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Работаем до последнего клиента.</div>
                                    Мы можем открыть весь салон раньше и вызвать нужных мастеров для вас или задержимся на любое время при необходимости, ради вашего безупречного стиля.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="accordion accordion_style-02 d_block_m">
                <div class="accordion__item active">
                    <div class="accordion__item-header">
                        <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                        <div class="accordion__title">оборудование</div>
                    </div>

                    <div class="accordion__content">
                        <ol class="ol_style-03">
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Мы используем медицинскую стерилизацию.</div>
                                    Автоклавы <b>IS YESON</b> - это означает что вы можете не переживать за безопасность делая услуги у нас.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Современное оборудование.</div>
                                    Фены <b>Dyson</b> - это означает, что при укладке ваши волосы будут сохранять естественный блеск и не будут повреждаться.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="txt_bold mb_14px">Косметика проверенных брендов.</div>
                                    Мы подобрали средства, которые дают результат. Для нас вопрос качества косметики №1, так как это залог качественных услуг.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="accordion__item">
                    <div class="accordion__item-header">
                        <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                        <div class="accordion__title">сервис</div>
                    </div>

                    <div class="accordion__content">
                        <ol class="ol_style-03 mw_550px">
                            <li>
                                <div>
                                    <b>Высококлассный сервис</b> - который отражается не только во внимании к гостям, но и в конечной пользе для каждого.
                                </div>
                            </li>
                            <li>
                                <div>
                                    В нашем арсенале <b>более 100 видов услуг</b> в областях парикмахерского искусства, визажа, ногтевой эстетики и косметологии.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b>Команда, высококвалифицированных мастеров</b>, любящих свое ремесло. Мастера с опытом до 20 лет - и этот опыт в вашем распоряжении.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b>Исключительное качество услуг по ценам обычных салонов.</b> Это одна из наших миссий, создать дисбаланс цены и качества.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b>Детальная диагностика для подбора идеального образа.</b> Вам не просто сделаю услугу, а подскажут, что будет лучшим вариантом именно для вас, учитывая все индивидуальные особенности и предпочтения в стиле.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="accordion__item">
                    <div class="accordion__item-header">
                        <svg width="20" height="18" fill="none"><path d="M15.3 3.6V0l-3.8 3.6H7.7L0 10.8h3.8l3.8-3.6v3.6h3.8l-3.8 3.6V18l7.6-7.2V7.2L19 3.6h-3.8z" fill="#0E0D0A"/></svg>
                        <div class="accordion__title">атмосфера</div>
                    </div>

                    <div class="accordion__content">
                        <ol class="ol_style-03 mw_550px">
                            <li>
                                <div>
                                    <b>Простая, доброжелательная и безоценочная атмосфера.</b> Для нас лично это очень важный момент. Ведь наша работа это большая часть нашей жизни.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b>Делаем 2-3 услуги одновременно</b>, стараемся максимально экономить ваше время.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b>Работаем до последнего клиента.</b> Мы можем открыть весь салон раньше и вызвать нужных мастеров для вас или задержимся на любое время при необходимости, ради вашего безупречного стиля.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="home-salons">
        <div class="container">
            <div class="title mb_40px mb_30px_m">
                <h3 class="title__heading txt_fs-18px_m txt_lh-18px_m">
                    <span>у нас уже</span><br>
                    7 салонов
                </h3>
            </div>

            <?php get_template_part( 'templates/widgets/salons_slider' ); ?>
        </div>
    </section>

    <section id="home-socials">
        <div class="container">
            <div class="row row_1-1 gap_col_80px flex_alignCenter">
                <div class="col"></div>

                <div class="col">
                    <div class="title mb_30px">
                        <h3 class="title__heading">
                            <b>У нас есть</b>
                        </h3>
                    </div>

                    <div class="socials_list">
                        <ul>
                            <li>
                                <a href="https://t.me/pieddepoule" target="_blank">
                                    <svg width="18" height="18" fill="none"><g clip-path="url(#clip0)"><path d="M7 11.4l-.2 4.2c.4 0 .6-.2.8-.4l2-2 4.1 3c.8.5 1.3.3 1.5-.6L18 2.9c.3-1.2-.4-1.6-1.1-1.3l-16 6c-1 .5-1 1.1-.1 1.4l4 1.3 9.5-6c.5-.3.9-.1.5.2l-7.6 6.9z" fill="#392BDF"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h18v18H0z"/></clipPath></defs></svg>
                                    Telegram-журнал
                                </a>
                                <span>где вы можете узновать о скидках и акциях</span>
                            </li>
                            <li>
                                <a href="https://t.me/Pied_De_Poule_bot" target="_blank">
                                    <svg width="18" height="18" fill="none"><g clip-path="url(#clip0)"><path d="M7 11.4l-.2 4.2c.4 0 .6-.2.8-.4l2-2 4.1 3c.8.5 1.3.3 1.5-.6L18 2.9c.3-1.2-.4-1.6-1.1-1.3l-16 6c-1 .5-1 1.1-.1 1.4l4 1.3 9.5-6c.5-.3.9-.1.5.2l-7.6 6.9z" fill="#392BDF"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h18v18H0z"/></clipPath></defs></svg>
                                    Telegram-bоt
                                </a>
                                <span>для удобной записи в салоны</span>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/pied.de.poule/?hl=ru" target="_blank">
                                    <svg width="18" height="18" fill="none"><path d="M12.4 0H5.6A5.6 5.6 0 000 5.6v6.8c0 3 2.5 5.6 5.6 5.6h6.8c3 0 5.6-2.5 5.6-5.6V5.6c0-3-2.5-5.6-5.6-5.6zm4 12.4a4 4 0 01-4 4H5.6a4 4 0 01-4-4V5.6a4 4 0 014-4h6.8a4 4 0 014 4v6.8z" fill="#392BDF"/><path d="M9 4.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9zm0 7.3a2.8 2.8 0 110-5.6 2.8 2.8 0 010 5.6zM13.8 4.8a.6.6 0 100-1.2.6.6 0 000 1.2z" fill="#392BDF"/></svg>
                                    Instagram
                                </a>
                                <span>где вы можете посмотреть наши работы</span>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/pied.de.poule.kyiv/" target="_blank">
                                    <svg width="18" height="18" fill="none"><path d="M15.8 0H2.2C1 0 0 1 0 2.3v13.4C0 17 1 18 2.3 18H9v-6.2H6.7V9H9V6.7c0-1.8 1.5-3.3 3.4-3.3h2.2v2.8h-1.1c-.6 0-1.1 0-1.1.5V9h2.8L14 11.8h-1.7V18h3.3c1.3 0 2.3-1 2.3-2.3V2.3C18 1 17 0 15.7 0z" fill="#392BDF"/></svg>
                                    Facebook
                                </a>
                                <span>в котором вы можете следить за основными новостями</span>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCMaDI5gxMWtbNRQXXjvW-LA" target="_blank">
                                    <svg width="18" height="14" fill="none"><path d="M17.2 2c-.5-.9-1-1-2-1A129.6 129.6 0 002.8 1C1.8 1 1.3 1 .8 2S0 4.4 0 7s.3 4.1.8 5c.5.9 1 1 2 1a146.5 146.5 0 0012.3 0c1.1 0 1.6-.1 2.1-1s.8-2.4.8-5-.3-4.1-.8-5zM6.8 10.4V3.6L12.3 7l-5.7 3.4z" fill="#392BDF"/></svg>
                                    Youtube
                                </a>
                                <span>в котором вы можете следить за основными новосями</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="home-form">
        <div class="container">
            <?php get_template_part( 'templates/forms/appointment_home' ); ?>
        </div>
    </section>

    <?php get_template_part( 'templates/sections/franchise' ); ?>

    <section id="network">
        <div class="container">
            <div class="row row_1-1 mb_80px">
                <div class="col">
                    <div class="title mb_20px mb_40px_m">
                        <h2 class="title__heading txt_fs-24px_m txt_lh-24px_m">
                            <span>Сеть салонов красоты</span><br>
                            PIED&#8209;DE&#8209;POULE‎ <span>в Киеве</span>
                        </h2>
                    </div>

                    <div class="textBlock">
                        <p>Добро пожаловать в мир красоты, здоровья и релакса! Люкс-салон PIED&#8209;DE&#8209;POULE обеспечит вам и первое, и второе, и третье.</p>
                        <p>Если вы ищете салон красоты в Киеве с особой атмосферой, высоким уровнем сервиса, брендовыми средствами и профессиональными опытными мастерами, способными удовлетворить самые требовательные запросы, вы попали по нужному адресу.
                            С каждым годом постоянных клиентов у нас становится все больше, и этому есть как минимум пять причин.</p>
                    </div>
                </div>
            </div>

            <div class="row row_1-1-1 gap_col_60px">
                <div class="col">
                    <div class="title mb_18px">
                        <h3 class="title__heading"><strong>Уход в 2/4/6/8 рук</strong></h3>
                    </div>

                    <div class="textBlock">
                        <p>PIED&#8209;DE&#8209;POULE – это всегда индивидуальный подход и виртуозное исполнение всех услуг. Наши клиенты могут выбрать одну процедуру или одновременно привести в порядок свои волосы, ногти, лицо, ресницы, губы. Во втором случае с вами
                            будет работать целая команда профессионалов. Комплексные экспресс-услуги позволят сэкономить самый ценный ресурс – ваше время. Например, всего за один час вы можете получить превосходную укладку, безупречный маникюр и макияж
                            для делового или романтичного образа.</p>
                    </div>

                    <div class="image mt_50px mb_40px_m">
                        <?=wp_get_attachment_image( 407, 'full' ); ?>
                    </div>
                </div>

                <div class="col flex flex_col flex_justifyCenter">
                    <div class="title mb_18px">
                        <h3 class="title__heading"><b>Удобная локация</b></h3>
                    </div>

                    <div class="textBlock mb_40px_m">
                        <p>Мы предоставляем своим клиентам возможность самим выбирать не только удобное время, но и место встречи: вы можете посетить люкс-салон красоты в центре Киева или выбрать другую, ближайшую к вам локацию PIED&#8209;DE&#8209;POULE. Вся сеть салонов
                            красоты (помимо Киева, услуги предоставляются в Харькове) работает по единым регламентам, стандартам качества и сервиса.</p>
                    </div>
                </div>

                <div class="col">
                    <div class="image mb_50px">
                        <?=wp_get_attachment_image( 408, 'full' ); ?>
                    </div>

                    <div class="title mb_18px">
                        <h3 class="title__heading"><b>В ногу со временем</b></h3>
                    </div>

                    <div class="textBlock">
                        <p>Наши парикмахеры, косметологи, стилисты, мастера маникюра, массажисты и дизайнеры имеют соответствующую подготовку и практический опыт. Кроме того, мы регулярно отслеживаем новые beauty-тренды и предложения известных брендов, ежегодно
                            обучаемся новым процедурам, техникам и методикам, в том числе за рубежом. Благодаря этому наши специалисты всегда могут помочь вам создать стильный, уникальный и модный образ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services-extended">
        <div class="container">
            <div class="title mb_60px">
                <h2 class="title__heading txt_fs-24px_m txt_lh-24px_m">
                    Комплексный подход:<br>
                    <span>расширенное меню услуг</span>
                </h2>
            </div>

            <div class="serviceListExt mb_60px">
                <div class="serviceListExt__row">
                    <div class="serviceListExt__title">Парикмахерский<br>люкс-сервис</div>
                    <div class="serviceListExt__content"><strong>Парикмахерский люкс-сервис</strong> – от женских и мужских стрижек и укладок до окрашивания любой сложности, а также лечения волос.</div>
                </div>

                <div class="serviceListExt__row">
                    <div class="serviceListExt__title">Nail-услуги</div>
                    <div class="serviceListExt__content"><strong>Nail-услуги</strong> – маникюр, педикюр, наращивание и дизайн ногтей.</div>
                </div>

                <div class="serviceListExt__row">
                    <div class="serviceListExt__title">Профессиональная<br>косметология</div>
                    <div class="serviceListExt__content"><strong>Профессиональная косметология.</strong> Опытный доктор почистит лицо, поможет омолодить кожу с помощью карбокситерапии, предложит ручной или аппаратный пилинг, при необходимости проведет сеанс мезотерапии и эпиляции. Точечные
                        инъекции в области лица (в том числе вокруг губ) и тела насытят организм полезными веществами: такие уколы улучшают кровообращение, позволяют противостоять появлению морщин, способствуют похудению.</div>
                </div>

                <div class="serviceListExt__row">
                    <div class="serviceListExt__title">Визаж</div>
                    <div class="serviceListExt__content"><strong>Визаж.</strong> Посетив наш VIP-салон красоты, вы можете заказать наращивание ресниц, окрашивание бровей и, конечно, макияж – дневной, вечерний или для особых случаев. Мы позаботимся о красоте и здоровье ваших бровей и ресниц.
                        Тем, кто мечтает о роскошных длинных ресницах, квалифицированные мастера салонов PIED&#8209;DE&#8209;POULE сделают люкс-ламинирование по уникальной и безопасной методике Yami Lashes.</div>
                </div>

                <div class="serviceListExt__row">
                    <div class="serviceListExt__title">SPA-услуги</div>
                    <div class="serviceListExt__content"><strong>SPA-услуги.</strong> Красота – это в первую очередь здоровье. В салоны PIED&#8209;DE&#8209;POULE можно прийти не только за новой прической, косметологическими процедурами, коктейльным или деловым макияжем. У нас работают квалифицированные
                        массажисты, которые знают, как с помощью бережного массажа укрепить здоровье разных органов и систем организма, улучшить обмен веществ, снять усталость и поднять настроение. Специальные методики помогают бороться с целлюлитом и
                        долгие годы сохранять кожу молодой, здоровой и эластичной. Конечно, перед проведением сеанса стоит проконсультироваться со своим доктором и убедиться, что у вас нет противопоказаний.</div>
                </div>
            </div>

            <div class="cta cta_servicesExtended">
                <div class="cta__content">Общее количество предоставляемых бьюти-услуг в сети салонов красоты PIED&#8209;DE&#8209;POULE превышает 70 наименований. Уточнить доступность интересующих процедур в разных салонах можно по телефону или здесь</div>
                <div class="cta__footer">
                    <a href="<?=get_permalink( 66 ); ?>" class="btn-default">цены</a>
                </div>
            </div>
        </div>
    </section>

    <section id="perfection">
        <div class="container">
            <div class="row row_2-1 gap_col_55px mb_100px">
                <div class="col">
                    <div class="title mb_60px mb_40px_m">
                        <h2 class="title__heading txt_fs-24px_m txt_lh-24px_m">
                            Перфекционизм во всем:<br>
                            <span>от интерьера до ножниц</span>
                        </h2>
                    </div>

                    <div class="textBlock">
                        <p>Удобное, красивое, оборудованное помещение, в котором любая процедура – от ухода за волосами и макияжа до массажа – будет проходить в комфортных для клиента условиях. В каждом салоне красоты PIED&#8209;DE&#8209;POULE есть своя изюминка – чтобы
                            убедиться в этом, запишитесь на встречу.</p>

                        <p>Профессиональная команда, каждый член которой досконально знает свое дело – будь то окрашивание волос с голливудским эффектом, мезотерапия с уколами с аминокислотами и коэнзимами или другой косметологический сервис, дизайн ногтей
                            с металлизированным покрытием, вакуумный массаж или нежный лайт-мейкап. К нашим мастерам, каждый из которых имеет соответствующее образование, регулярно обращаются телеведущие, кино- и шоу-звезды. Это лучшее подтверждение квалификации
                            специалистов PIED&#8209;DE&#8209;POULE.</p>

                        <p>Качественные косметологические и косметические средства (для макияжа, ухода за кожей и волосами) от проверенных брендов. В салонах красоты PIED&#8209;DE&#8209;POULE используются косметика и специальные средства от брендов с мировым именем
                            – лидеров своей отрасли. Так, при уходе за лицом, для коррекции морщин и щадящего пилинга косметологами применяется профессиональная косметика Biologique Recherche и Academie. В арсенале наших визажистов – лучшие продукты для
                            глаз и губ от марок MAC, INGLOT и др. Полный перечень используемых средств для макияжа, инъекций, окрашивания, покрытия ногтей и других услуг вы можете уточнить у своего специалиста.</p>

                        <p>Профессиональный современный инструментарий. В наших салонах осуществляются ручные и аппаратные процедуры, для которых используются стерильные инструменты и необходимое оборудование для парикмахерского, косметического, массажного
                            сервиса, а также автоклавы для их обработки.</p>
                    </div>
                </div>

                <div class="col">
                    <div class="image">
                        <?=wp_get_attachment_image( 29, 'full' ); ?>
                    </div>
                </div>
            </div>

            <div class="cta cta_perfection mw_550px">
                <h4 class="cta__title">Салоны красоты PIED&#8209;DE&#8209;POULE ждут вас:</h4>
                <div class="cta__content txt_fs-20px_m txt_lh-20px_m">
                    <p>приходите за «новым» лицом, безукоризненным маникюром и макияжем, эффектной прической, оздоравливающим массажем и хорошим настроением!</p>
                </div>
                <div class="cta__footer">
                    <button class="btn-default" data-micromodal-trigger="modal-appointment">записаться</button>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>