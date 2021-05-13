<div class="form-wrap">
	<form class="form">
		<div class="form-row form-row--two">
			<div class="form-col">
				<?php pdp_form_field( 'name' ); ?>
			</div>

			<div class="form-col">
				<?php pdp_form_field( 'phone' ); ?>
			</div>
		</div>

		<div class="form-row form-row--two">
			<div class="form-col">
				<?php pdp_form_field( 'email' ); ?>
			</div>

			<div class="form-col">
				<?php pdp_form_field( 'gift-cards' ); ?>
			</div>
		</div>

		<div class="form__response"></div>

		<div class="form__submit">
			<input type="submit" class="btn-default" value="<?=__( 'Заказать', 'pdp' ); ?>">
		</div>

		<input type="hidden" name="action" value="gift_card_order">
		<?php wp_nonce_field( 'pdp_gift_card_order_nonce', 'pdp_nonce' ); ?>
		<?php pdp_utm_fields(); ?>
	</form>
</div>