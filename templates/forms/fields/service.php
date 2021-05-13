<div class="select select--service">
	<div class="select__errors"></div>
	<div class="select__wrap">
		<select name="service" class="selectric selectric_pdp">
			<option value=""><?=__( 'Выберите услугу', 'pdp' ); ?></option>
			<?php foreach( pdp_get_service_categories() as $service ) : ?>
				<option value="<?=$service['title']; ?>"><?=( pll_current_language() == 'ru' ) ? $service['title'] : $service['title_ua']; ?></option>
			<?php endforeach; ?>
		</select>
		<svg width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M3 5v2c0 .3-.2.5-.5.5h-2A.6.6 0 010 7V5c0-.3.3-.5.6-.5h1.9c.3 0 .6.2.6.5zm10.4-.5H4.8c-.3 0-.6.2-.6.5v2c0 .3.3.5.6.5H13.4c.3 0 .6-.2.6-.5V5c0-.3-.3-.5-.6-.5zM2.5 0h-2C.4 0 0 .3 0 .7v1.9c0 .3.3.6.6.6h1.9c.3 0 .6-.3.6-.6v-2c0-.3-.3-.5-.6-.5zm11 0H4.7c-.3 0-.6.2-.6.6v1.9c0 .3.3.6.6.6H13.4c.3 0 .6-.3.6-.6v-2c0-.3-.3-.5-.6-.5zm-11 8.7h-2c-.2 0-.5.3-.5.6v2c0 .3.3.5.6.5h1.9c.3 0 .6-.2.6-.6V9.4c0-.3-.3-.6-.6-.6zm11 0H4.7c-.3 0-.6.3-.6.6v2c0 .3.3.5.6.5H13.4c.3 0 .6-.2.6-.6V9.4c0-.3-.3-.6-.6-.6z" /></svg>
	</div>
</div>