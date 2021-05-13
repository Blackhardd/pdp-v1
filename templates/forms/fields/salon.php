<div class="select select--salon">
	<div class="select__errors"></div>
	<div class="select__wrap">
		<select name="salon" class="selectric selectric_pdp">
			<option value=""><?=__( 'Выберите салон', 'pdp' ); ?></option>
			<?php
			foreach( pdp_get_salons() as $salon ) :
				if( isset( $_GET['salon_pricelist'] ) && $_GET['salon_pricelist'] == $salon->ID ){ ?>
					<option value="<?=$salon->ID; ?>" selected><?=$salon->post_title; ?></option>
				<?php } else { ?>
					<option value="<?=$salon->ID; ?>"><?=$salon->post_title; ?></option>
					<?php
				}
			endforeach;
			?>
		</select>
		<svg width="12" height="14" viewBox="0 0 12 14" fill="none"><path d="M6 0A5.08 5.08 0 00.93 5.07c0 3.47 4.54 8.56 4.73 8.78.18.2.5.2.68 0 .2-.22 4.73-5.31 4.73-8.78C11.07 2.27 8.8 0 6 0zm0 7.62a2.55 2.55 0 110-5.1 2.55 2.55 0 010 5.1z" /></svg>
	</div>
</div>