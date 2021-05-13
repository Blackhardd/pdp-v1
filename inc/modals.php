<?php

/**
 *  Simple Booking Modal
 */
add_action( 'wp_footer', 'pdp_add_appointment_modal' );
function pdp_add_appointment_modal(){ ?>
	<div class="modal" id="modal-appointment" aria-hidden="true">
		<div class="modal__dimmer" data-micromodal-close>
			<div class="modal__inner" role="dialog" aria-modal="true">
				<div class="modal__header">
					<?=__( 'Заполните форму', 'pdp' ); ?>
				</div>

				<button class="modal__close btn-icon" aria-label="Close modal" data-micromodal-close><svg width="14" height="14" fill="none"><path d="M14 1.4L12.6 0 7 5.6 1.4 0 0 1.4 5.6 7 0 12.6 1.4 14 7 8.4l5.6 5.6 1.4-1.4L8.4 7 14 1.4z" fill="#000"/></svg></button>

				<div class="modal__content">
					<?php get_template_part( 'templates/forms/booking/simple' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}


/**
 *  Category Booking Modal
 */
add_action( 'wp_footer', 'pdp_add_service_category_appointment_modal' );
function pdp_add_service_category_appointment_modal(){
	if( is_page_template( 'service-category.php' ) ){ ?>
		<div class="modal" id="modal-service-category-appointment" aria-hidden="true">
			<div class="modal__dimmer" data-micromodal-close>
				<div class="modal__inner" role="dialog" aria-modal="true">
					<div class="modal__header">
						<?=__( 'Записаться', 'pdp' ); ?>
					</div>

					<button class="modal__close btn-icon" aria-label="Close modal" data-micromodal-close><svg width="14" height="14" fill="none"><path d="M14 1.4L12.6 0 7 5.6 1.4 0 0 1.4 5.6 7 0 12.6 1.4 14 7 8.4l5.6 5.6 1.4-1.4L8.4 7 14 1.4z" fill="#000"/></svg></button>

					<div class="modal__content">
						<?php get_template_part( 'templates/forms/booking/category' ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}


/**
 *  Post Share Modal
 */
add_action( 'wp_footer', 'pdp_add_share_post_modal' );
function pdp_add_share_post_modal(){
	if( is_single() ){ ?>
		<div class="modal" id="modal-share-post" aria-hidden="true">
			<div class="modal__dimmer" data-micromodal-close>
				<div class="modal__inner">
					<div class="modal__header"><?=__( 'Поделиться статьей', 'pdp' ); ?></div>
					<div class="modal__content">
						<div class="inputWrap inputWrap_iconed">
							<div class="inputWrap__input">
								<div class="inputWrap__icon">
									<button class="btn-icon btn_copy" data-clipboard-target="#post-link">
										<svg width="22" height="22" fill="none"><path d="M8.3 17.24L5.92 19.6a2.5 2.5 0 11-3.53-3.53l4.71-4.72a2.5 2.5 0 013.54 0 .83.83 0 001.18-1.18 4.17 4.17 0 00-5.9 0L1.22 14.9a4.17 4.17 0 105.9 5.89l2.35-2.36a.83.83 0 00-1.18-1.18z" fill="#392BDF"/><path d="M18.78 3.22a4.17 4.17 0 00-5.9 0l-2.82 2.83a.83.83 0 101.18 1.18l2.83-2.83a2.5 2.5 0 013.53 3.53l-5.18 5.19a2.5 2.5 0 01-3.54 0A.83.83 0 007.7 14.3a4.17 4.17 0 005.9 0l5.18-5.19a4.17 4.17 0 000-5.89z" fill="#392BDF"/></svg>
									</button>
								</div>
								<input type="text" id="post-link" class="input" readonly value="<?=get_permalink( get_the_ID() ); ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}