<?php
$list = $args['pricelist']; ?>

<div class="service-row__pricelist services-pricelist services-pricelist_complex">
	<div class="services-pricelist__header">
		<div class="services-pricelist__category"><?=$list['category']; ?></div>
		<div class="services-pricelist__length-label"><b>1</b> <?=__( 'длина', 'pdp_core' ); ?></div>
		<div class="services-pricelist__length-label"><b>2</b> <?=__( 'длина', 'pdp_core' ); ?></div>
		<div class="services-pricelist__length-label"><b>3</b> <?=__( 'длина', 'pdp_core' ); ?></div>
		<div class="services-pricelist__length-label"><b>4</b> <?=__( 'длина', 'pdp_core' ); ?></div>
	</div>

	<div class="services-pricelist__items-wrap">
		<?php
		foreach( $list['services'] as $service ){ ?>
			<div class="services-pricelist__item">
				<div class="services-pricelist__title"><?=$service['name']; ?></div>

				<div class="services-pricelist__price-col">
					<div class="services-pricelist__price">
						<?php if( $service['price_first_from'] && $service['price_first_to'] ){
							echo '<div>' . $service['price_first_from'] . '<span class="uah"></span></div><div>' . $service['price_first_to'] . '<span class="uah"></span></div>';
						}
						else if( $service['price_first_from'] && !$service['price_first_to'] ){
							echo $service['price_first_from'] . '<span class="uah"></span>';
						}
						else{
							echo $service['price_first_to'] . '<span class="uah"></span>';
						} ?>
					</div>
				</div>

				<div class="services-pricelist__price-col">
					<div class="services-pricelist__price">
						<?php if( $service['price_second_from'] && $service['price_second_to'] ){
							echo '<div>' . $service['price_second_from'] . '<span class="uah"></span></div><div>' . $service['price_second_to'] . '<span class="uah"></span></div>';
						}
						else if( $service['price_second_from'] && !$service['price_second_to'] ){
							echo $service['price_second_from'] . '<span class="uah"></span>';
						}
						else if( !$service['price_second_from'] && $service['price_second_to'] ){
							echo $service['price_second_to'] . '<span class="uah"></span>';
						} ?>
					</div>
				</div>

				<div class="services-pricelist__price-col">
					<div class="services-pricelist__price">
						<?php if( $service['price_third_from'] && $service['price_third_to'] ){
							echo '<div>' . $service['price_third_from'] . '<span class="uah"></span></div><div>' . $service['price_third_to'] . '<span class="uah"></span></div>';
						}
						else if( $service['price_third_from'] && !$service['price_third_to'] ){
							echo $service['price_third_from'] . '<span class="uah"></span>';
						}
						else if( !$service['price_third_from'] && $service['price_third_to'] ){
							echo $service['price_third_to'] . '<span class="uah"></span>';
						} ?>
					</div>
				</div>

				<div class="services-pricelist__price-col">
					<div class="services-pricelist__price">
						<?php if( $service['price_fourth_from'] && $service['price_fourth_to'] ){
							echo '<div>' . $service['price_fourth_from'] . '<span class="uah"></span></div><div>' . $service['price_fourth_to'] . '<span class="uah"></span></div>';
						}
						else if( $service['price_fourth_from'] && !$service['price_fourth_to'] ){
							echo $service['price_fourth_from'] . '<span class="uah"></span>';
						}
						else if( !$service['price_fourth_from'] && $service['price_fourth_to'] ){
							echo $service['price_fourth_to'] . '<span class="uah"></span>';
						} ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
