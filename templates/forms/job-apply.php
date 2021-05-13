<div class="form-wrap">
	<form class="form" enctype="multipart/form-data">
		<div class="form-row form-row--two">
			<div class="form-col">
				<div class="form-row">
					<div class="form-col">
						<?php pdp_form_field( 'name' ); ?>
					</div>
				</div>

				<div class="form-row">
					<div class="form-col">
						<?php pdp_form_field( 'email' ); ?>
					</div>
				</div>

				<div class="form-row">
					<div class="form-col">
						<?php pdp_form_field( 'phone' ); ?>
					</div>
				</div>
			</div>

			<div class="form-col">
				<div class="form-row">
					<div class="form-col">
						<?php pdp_form_field( 'message' ); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="form__response"></div>

		<div class="form__submit">
			<input type="submit" class="btn-default" value="<?=__( 'Оставить заявку', 'pdp' ); ?>">

			<?php pdp_form_field( 'file-button' ); ?>
		</div>

		<input type="hidden" name="vacancy" value="">
		<input type="hidden" name="action" value="vacancy_application">
		<?php wp_nonce_field( 'pdp_vacancy_application_nonce', 'pdp_nonce' ); ?>
	</form>
</div>