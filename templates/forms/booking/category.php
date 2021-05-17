<div class="form-wrap">
	<form class="form">
        <div class="form__fields">
            <div class="form-row">
                <div class="form-col">
			        <?php pdp_form_field( 'name', true ); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
			        <?php pdp_form_field( 'phone', true ); ?>
                </div>
            </div>
        </div>

		<div class="form__response"></div>

		<div class="form__submit">
			<input type="submit" class="btn-default" value="<?=__( 'Записаться', 'pdp' ); ?>">
		</div>

		<input type="hidden" name="action" value="category_booking">
		<input type="hidden" name="page_title" value="<?=get_the_title(); ?>">
		<input type="hidden" name="page_url" value="<?=esc_url( get_permalink() ); ?>">
		<?php wp_nonce_field( 'pdp_category_booking_nonce', 'pdp_nonce' ); ?>
		<?php pdp_utm_fields(); ?>
	</form>
</div>