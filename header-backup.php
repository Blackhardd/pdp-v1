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

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main>
	<header class="main-header">
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

				<?php //get_template_part( 'templates/header/lang-switcher' ); ?>
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
					<div class="cart-counter" v-if="sharedState.cart.items.length">{{sharedState.cart.items.length}}</div>
					<svg width="28" height="18" fill="none">
						<path d="M.5 18h27v-3H.5v3zm0-7.5h27v-3H.5v3zM.5 0v3h27V0H.5z" fill="#0E0D0A"/>
					</svg>
				</button>
			</div>
		</div>

		<?php get_template_part( 'templates/header/phones-list-mobile' ); ?>

		<nav class="mobile-navigation" :class="{ active: isMobileMenuActive }">
			<div class="mobile-navigation__close">
				<button class="btn-icon" style="transform: rotate(180deg)" @click="toggleMenu">
					<svg width="20" height="20" fill="none"><path d="M20 10a10 10 0 10-20 0 10 10 0 0020 0zM8 10l4-4v8l-4-4z" fill="#392BDF"/></svg>
				</button>
			</div>

			<div class="mobile-navigation__inner">
				<div class="appointment-mobile">
					<button class="appointment-mobile__btn" @click="isMobileMenuActive = false; isCartActive = true">
						<div class="appointment-mobile__counter">{{sharedState.cart.items.length}}</div>
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
			<div class="cart cart_header" v-click-outside="{ exclude: ['oce-cart'], handler: clickOutside }" ref="cart">
				<form class="form cart-form cart__form" @submit.prevent="submitForm">
					<div class="cart-form__header">
						ваше бронирование
						<button type="button" class="cart-form__close-btn btn-icon" @click="toggleMenu">
							<svg width="14" height="14" fill="none"><path d="M14 1.4L12.6 0 7 5.6 1.4 0 0 1.4 5.6 7 0 12.6 1.4 14 7 8.4l5.6 5.6 1.4-1.4L8.4 7 14 1.4z" fill="#000"/></svg>
						</button>
					</div>

					<div v-if="sharedState.cart.items.length">
						<div class="cart-form__list" ref="cart_list">
							<div v-for="(service, index) in sharedState.cart.items" :key="index">
								<button type="button" class="pricelist-item__add-btn btn-icon" :data-id="service.id" @click="addToCart(service)" data-added>
									<span class="pricelist-item__icon"></span>
								</button>
								{{service.name}}
							</div>
						</div>

						<div class="cart-form__hair-length">
							<div class="inputWrap">
								<pdp-select
									@changed="changeHairLength"
									name="hair_length"
									placeholder="Выберите длинну волос"
									:options="sharedState.hairLengths"
									:selected="sharedState.cart.hair_length"
								/>
							</div>
						</div>
					</div>
					<div v-else>
						<div class="alert mb_60px mt_50px">
							<div class="alert__icon">!</div>
							<div class="alert__content">Вы можете добавить услуги на странице <a href="<?=get_permalink( 66 ); ?>" class="btn-link">Цены</a></div>
						</div>
					</div>

					<div class="cartForm__title">заполните форму</div>

					<div class="form__row">
						<div class="form__col_full">
							<div class="inputWrap inputWrap_iconed">
								<div class="inputWrap__icon">
									<svg width="14" height="14" fill="none">
										<path d="M10.8 9.4C9.1 8.7 8.5 9 8.5 7.9v-.2h2.7c.4-.3-1-.8-1-4.5C10.2 1.3 9 0 7.1 0H7h-.1C5 0 3.8 1.3 3.8 3.2c0 3.7-1.4 4.2-1 4.5h2.6v.2c0 1.2-.5.8-2.2 1.5C1.4 10 .9 10.7.9 11V14h12.2v-2.9c0-.4-.5-1-2.3-1.7z" fill="#000"/>
									</svg>
								</div>
								<input type="text" name="name" class="input input_text" placeholder="Как к вам обращаться?" v-model="name">
							</div>
						</div>
					</div>

					<div class="form__row">
						<div class="form__col_full">
							<div class="inputWrap inputWrap_iconed">
								<div class="inputWrap__icon">
									<svg width="14" height="14" fill="none">
										<path d="M13.7 11L11.5 9c-.4-.4-1.1-.4-1.6 0L9 10l-.3-.1C8 9.5 7 9 6 8 5 7 4.5 6 4.1 5.4L4 5.2l.7-.8.4-.3c.4-.5.4-1.2 0-1.6L3 .3C2.5 0 1.8 0 1.4.3L.8 1A3.5 3.5 0 000 2.8c-.2 2.3.8 4.5 3.8 7.4 4 4 7.3 3.8 7.4 3.8a3.7 3.7 0 001.8-.8l.7-.5c.4-.5.4-1.2 0-1.6z" fill="#000"/>
									</svg>
								</div>
								<input type="tel" name="phone" class="input input_tel" placeholder="Номер телефона" v-model="phone">
							</div>
						</div>
					</div>

					<div class="form__row">
						<div class="form__col_full">
							<div class="inputWrap inputWrap_iconed">
								<div class="inputWrap__icon">
									<svg width="14" height="12" fill="none">
										<path d="M1.34 3.9A361.82 361.82 0 005 6.42a36.7 36.7 0 01.76.53c.1.08.24.17.4.26.16.1.31.16.45.21.14.05.27.07.4.07s.26-.02.4-.07.29-.12.45-.21A8.25 8.25 0 009 6.43l3.65-2.54c.38-.26.7-.59.96-.96.25-.38.38-.77.38-1.18 0-.34-.12-.64-.37-.88a1.2 1.2 0 00-.88-.37H1.25C.85.5.54.64.32.9.11 1.19 0 1.53 0 1.93c0 .33.14.69.43 1.07.29.38.6.68.91.9z" fill="#000"/>
										<path d="M13.22 4.73a162.38 162.38 0 00-4.61 3.2c-.19.13-.44.25-.74.38-.31.13-.6.19-.86.19H7c-.27 0-.56-.06-.87-.2-.3-.12-.55-.24-.74-.37l-.72-.5c-.7-.52-2-1.42-3.88-2.7-.3-.2-.56-.43-.79-.68v6.2c0 .34.12.64.37.88.24.25.54.37.88.37h11.5c.34 0 .64-.12.88-.37.25-.24.37-.54.37-.88v-6.2a4.3 4.3 0 01-.78.68z" fill="#000"/>
									</svg>
								</div>
								<input type="email" name="email" class="input input_email" placeholder="Электронная почта" v-model="email">
							</div>
						</div>
					</div>

					<div class="form__row">
						<div class="form__col_full">
							<div class="inputWrap">
								<select name="salon" class="selectric selectric_pdp iconed iconed_salon">
									<option value="">Выберите салон</option>
									<?php
									foreach( pdp_get_salons() as $salon ){
										if( isset( $_GET['salon_pricelist'] ) && $_GET['salon_pricelist'] == $salon->ID ){ ?>
											<option value="<?=$salon->ID; ?>" selected><?=$salon->post_title; ?></option>
										<?php } else { ?>
											<option value="<?=$salon->ID; ?>"><?=$salon->post_title; ?></option>
											<?php
										}
									} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="form__response active error" v-if="formErrors.length">
						<ul>
							<li v-for="(error, index) in formErrors" :key="index">{{ error }}</li>
						</ul>
					</div>

					<div class="cart-form__footer">
						<input type="submit" value="записаться" class="btn-default">

						<div class="cart-form__total">
							стоимость услуг
							<div class="cart-form__total-price">
								<div class="cart-form__price">{{sharedState.cart.total}}</div>
								<div class="cart-form__currency"><span class="uah"></span></div>
							</div>
						</div>
					</div>

					<input type="hidden" name="action" value="appointment">
					<input type="hidden" name="cart" :value="JSON.stringify(sharedState.cart)">
				</form>
			</div>
		</div>

		<div class="dimmer blurred" @click="closeMenus"></div>
	</header>

	<article class="main-article">
