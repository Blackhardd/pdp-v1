<?php
$kharkov_salons = get_posts(
	array(
		'post_type'     => 'salon',
		'numberposts'   => -1,
		'tax_query'     => array(
			array(
				'taxonomy'  => 'city',
				'field'     => 'slug',
				'terms'     => 'harkov'
			)
		)
	)
); ?>

<div class="title mb_30px">
	<h3 class="title__heading">Салоны в Харькове <span class="txt_fw-600 txt_color_primary"><?=count( $kharkov_salons ); ?></span></h3>
</div>

<div class="accordion">
	<?php foreach( $kharkov_salons as $key => $salon ){
		$short_title = carbon_get_post_meta( $salon->ID, 'contacts_title' );
		$maps_link = carbon_get_post_meta( $salon->ID, 'google_maps' );
		$email = carbon_get_post_meta( $salon->ID, 'email' );
		$phone = carbon_get_post_meta( $salon->ID, 'phone' ); ?>
		<div class="accordion__item <?php echo 'active'; ?>">
			<div class="accordion__item-header">
				<div class="accordion__icon"><svg width="10" height="10" fill="none"><path d="M5 10V0M0 5h10" stroke="#000" stroke-width="1.1"/></svg></div>
				<div class="accordion__title"><span>PIED-DE-POULE</span> <?=$short_title; ?></div>
			</div>

			<div class="accordion__content">
				<div class="contacts-list">
					<div class="contacts-list__address">
						<div class="contacts-list__icon">
							<svg width="11" height="16" fill="none"><path d="M5.25.5A5.25 5.25 0 000 5.75c0 3.94 5.25 9.75 5.25 9.75s5.25-5.81 5.25-9.75C10.5 2.85 8.15.5 5.25.5zm0 7.13a1.88 1.88 0 110-3.76 1.88 1.88 0 010 3.75z" fill="#392BDF"/></svg>
						</div>
						<a href="<?=$maps_link;?>" target="_blank"><?=$salon->post_title; ?></a>
					</div>
					<div class="contacts-list__email">
						<div class="contacts-list__icon">
							<svg width="14" height="11" fill="none"><path d="M12 0H1.3C.6 0 0 .6 0 1.3v8c0 .8.6 1.4 1.3 1.4H12c.7 0 1.3-.6 1.3-1.4v-8C13.3.6 12.7 0 12 0zm0 2.7L6.7 6 1.3 2.7V1.3l5.4 3.4L12 1.3v1.4z" fill="#392BDF"/></svg>
						</div>
						<a href="mailto:<?=$email; ?>"><?=$email; ?></a>
					</div>
					<div class="contacts-list__phone">
						<div class="contacts-list__icon">
							<svg width="12" height="12" fill="none"><path d="M2.41 5.2a10.1 10.1 0 004.4 4.39l1.46-1.47a.66.66 0 01.68-.16 7.6 7.6 0 002.38.38c.37 0 .67.3.67.67v2.32c0 .37-.3.67-.67.67A11.33 11.33 0 010 .67C0 .3.3 0 .67 0H3c.37 0 .67.3.67.67 0 .83.13 1.63.38 2.38.07.23.02.49-.17.68L2.41 5.19z" fill="#392BDF"/></svg>
						</div>
						<a href="tel:<?=$phone; ?>"><?=$phone; ?></a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
