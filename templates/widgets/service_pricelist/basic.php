<?php
$list = $args['pricelist']; ?>

<div class="service-row__pricelist serviceList">
    <div class="serviceList__header">
        <div class="serviceList__category"><?=$list['category']; ?></div>
        <div class="serviceList__desc"><?=__( '*Мастер / Старший мастер', 'pdp' ); ?></div>
    </div>

    <div class="serviceList__services">
        <?php
        foreach( $list['services'] as $service ){ ?>
            <div class="serviceList__service">
                <div class="serviceList__title"><?=$service['name']; ?></div>

                <div class="serviceList__price">
                    <?php if( $service['price_from'] && $service['price_to'] ){
                        echo $service['price_from'] . '₴ / ' . $service['price_to'] . '₴';
                    }
                    else if( $service['price_from'] && !$service['price_to'] ){
                        echo $service['price_from'] . '₴';
                    }
                    else{
                        echo $service['price_to'] . '₴';
                    } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
