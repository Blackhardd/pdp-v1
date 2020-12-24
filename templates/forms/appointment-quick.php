<div class="appointment-quick">
	<h3>заполните форму</h3>
	<form id="appointment-quick-form" class="form">
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
						<input type="text" name="name" class="input input_text" placeholder="Как к вам обращаться?" data-parsley-length="[3, 24]" required>
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
						<input type="tel" name="phone" class="input input_tel" placeholder="Номер телефона" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" required>
					</div>
					<div class="inputWrap__errors"></div>
				</div>
			</div>
		</div>

		<div class="form__row">
			<div class="form__col_full">
				<div class="inputWrap">
					<div class="inputWrap__input">
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
					<div class="inputWrap__errors"></div>
				</div>
			</div>
		</div>

		<div class="form__row">
			<div class="form__col_full">
				<div class="inputWrap">
					<div class="inputWrap__input">
						<select name="service" class="selectric selectric_pdp iconed iconed_service">
							<option value="">Выберите услугу</option>
							<?php
							foreach( pdp_get_service_categories() as $service ){ ?>
								<option value="<?=$service['title']; ?>"><?=$service['title']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="inputWrap__errors"></div>
				</div>
			</div>
		</div>

		<div class="form__response"></div>

		<div class="form__submit">
			<input type="submit" class="btn-default" value="записаться">
            <a href="https://t.me/Pied_De_Poule_bot" class="appointment-quick__bot btn-default btn-square"><svg width="18" height="16" fill="none"><path d="M7 10.4l-.2 4.2c.4 0 .6-.2.8-.4l2-2 4.1 3c.8.5 1.3.3 1.5-.6L18 1.9C18.2.7 17.5.3 16.8.6l-16 6c-1 .5-1 1.1-.1 1.4l4 1.3 9.5-6c.5-.3.9-.1.5.2l-7.6 6.9z" fill="#fff"/></svg></a>
            <a href="viber://pa?chatURI=pied-de-poule" class="appointment-quick__bot btn-default btn-square"><svg width="24" height="24" fill="none"><g clip-path="url(#clip0)" fill="#fff"><path d="M23.2 13.9c.7-6-.4-9.8-2.3-11.6-3-2.9-13.5-3.3-17.2.2C2 4.2 1.5 6.7 1.4 9.8c0 3.1-.1 9 5.3 10.6v2.4s0 1 .6 1.2c.7.2 1-.3 3.3-3 3.7.4 6.5-.3 6.9-.5.7-.2 5-.8 5.7-6.6zm-12.3 5.5s-2.3 3-3 3.7c-.3.2-.6.2-.6-.3v-4c-4.6-1.3-4.3-6.3-4.2-9 0-2.5.5-4.6 1.9-6C8.2.6 17.4 1.3 19.7 3.5c2.8 2.5 1.8 9.6 1.8 9.8-.6 5-4 5.2-4.6 5.4-.3.1-2.8.8-6 .6z"/><path d="M12.2 4.3c-.4 0-.4.6 0 .6 3 0 5.5 2.1 5.5 6 0 .3.6.3.6 0 0-4.2-2.7-6.6-6-6.6z"/><path d="M16.2 10.2c0 .4.5.4.5 0a4 4 0 00-4-4.3c-.3 0-.4.5 0 .6 2.3.2 3.5 1.7 3.5 3.7zM15.5 12.8c-.5-.3-1-.1-1.2.1l-.4.6c-.2.3-.7.3-.7.3-3-.8-3.8-4-3.8-4s0-.4.3-.6l.5-.5c.3-.2.5-.7.2-1.2C9.6 6 9 5.7 8.9 5.3c-.3-.3-.7-.4-1.1-.2-.9.5-1.8 1.5-1.5 2.4.5 1 1.5 4.4 4.5 6.8 1.4 1.2 3.7 2.4 4.6 2.7 1 .3 1.9-.7 2.4-1.6.2-.4.1-.8-.2-1l-2-1.6z"/><path d="M13.2 8.1c1 0 1.4.6 1.4 1.6 0 .4.6.4.6 0 0-1.4-.7-2.1-2-2.2-.4 0-.4.6 0 .6z"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h24v24H0z"/></clipPath></defs></svg></a>
		</div>

		<input type="hidden" name="action" value="appointment_quick">
		<?php wp_nonce_field( 'pdp_appointment_quick_nonce', 'pdp_nonce' ); ?>
	</form>
</div>