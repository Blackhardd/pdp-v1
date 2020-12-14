<?php
$list = $args['pricelist']; ?>

<div class="service-row__pricelist services-pricelist">
	<div class="services-pricelist__header">
		<div class="services-pricelist__category"><?=$list['category']; ?></div>
		<div class="services-pricelist__master-label"><?=__( 'мастер/старший мастер', 'pdp_core' ); ?></div>
	</div>

	<div class="services-pricelist__items-wrap">
		<?php
		foreach( $list['services'] as $service ){ ?>
			<div class="services-pricelist__item">
				<div class="services-pricelist__title"><?=$service['name']; ?></div>

				<div class="services-pricelist__price">
					<?php if( $service['price_from'] && $service['price_to'] ){
						echo $service['price_from'] . '<span class="uah"></span> / ' . $service['price_to'] . '<span class="uah"></span>';
					}
					else if( $service['price_from'] && !$service['price_to'] ){
						echo $service['price_from'] . '<span class="uah"></span>';
					}
					else{
						echo $service['price_to'] . '<span class="uah"></span>';
					} ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
