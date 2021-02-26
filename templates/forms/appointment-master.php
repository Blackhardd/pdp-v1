<div class="appointment-master">
	<h3><?=__( 'Заполните форму', 'pdp' ); ?></h3>
	<form id="appointment-master-form" class="form">
		<div class="backdrop"><div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>

		<div class="form__row">
			<div class="form__col_full">
				<div class="inputWrap inputWrap_iconed">
					<div class="inputWrap__input">
						<div class="inputWrap__icon">
							<svg width="14" height="14" fill="none">
								<path d="M10.8 9.4C9.1 8.7 8.5 9 8.5 7.9v-.2h2.7c.4-.3-1-.8-1-4.5C10.2 1.3 9 0 7.1 0H7h-.1C5 0 3.8 1.3 3.8 3.2c0 3.7-1.4 4.2-1 4.5h2.6v.2c0 1.2-.5.8-2.2 1.5C1.4 10 .9 10.7.9 11V14h12.2v-2.9c0-.4-.5-1-2.3-1.7z" fill="#000"/>
							</svg>
						</div>
						<input type="text" name="name" class="input input_text" placeholder="<?=__( 'Как к вам обращаться?', 'pdp' ); ?>" data-parsley-length="[3, 24]" required>
					</div>
					<div class="inputWrap__errors"></div>
				</div>
			</div>
		</div>

		<div class="form__row">
			<div class="form__col_full">
				<div class="inputWrap inputWrap_iconed">
					<div class="inputWrap__input">
						<div class="inputWrap__icon">
							<svg width="14" height="14" fill="none">
								<path d="M13.7 11L11.5 9c-.4-.4-1.1-.4-1.6 0L9 10l-.3-.1C8 9.5 7 9 6 8 5 7 4.5 6 4.1 5.4L4 5.2l.7-.8.4-.3c.4-.5.4-1.2 0-1.6L3 .3C2.5 0 1.8 0 1.4.3L.8 1A3.5 3.5 0 000 2.8c-.2 2.3.8 4.5 3.8 7.4 4 4 7.3 3.8 7.4 3.8a3.7 3.7 0 001.8-.8l.7-.5c.4-.5.4-1.2 0-1.6z" fill="#000"/>
							</svg>
						</div>
						<input type="tel" name="phone" class="input input_tel" placeholder="<?=__( 'Номер телефона', 'pdp' ); ?>" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" required>
					</div>
					<div class="inputWrap__errors"></div>
				</div>
			</div>
		</div>

		<div class="form__response"></div>

		<div class="form__submit">
			<input type="submit" class="btn-default" value="<?=__( 'Записаться', 'pdp' ); ?>">
		</div>

		<input type="hidden" name="action" value="appointment_master">
		<input type="hidden" name="master" value="<?=$args['master']; ?>">
		<input type="hidden" name="salon" value="<?=get_the_ID(); ?>">
		<?php wp_nonce_field( 'pdp_appointment_master_nonce', 'pdp_nonce' ); ?>
	</form>
</div>