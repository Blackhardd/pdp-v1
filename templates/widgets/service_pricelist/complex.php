<?php
$list = $args['pricelist']; ?>

<div class="service-row__pricelist serviceList serviceList_complex">
    <div class="serviceList__header">
        <div class="serviceList__category"><?=$list['category']; ?></div>
        <div class="serviceList__headerCol"><b>1</b> <?=__( 'длина', 'pdp_core' ); ?></div>
        <div class="serviceList__headerCol"><b>2</b> <?=__( 'длина', 'pdp_core' ); ?></div>
        <div class="serviceList__headerCol"><b>3</b> <?=__( 'длина', 'pdp_core' ); ?></div>
        <div class="serviceList__headerCol"><b>4</b> <?=__( 'длина', 'pdp_core' ); ?></div>
    </div>

    <div class="serviceList__services">
        <?php
        foreach( $list['services'] as $service ){ ?>
            <div class="serviceList__service">
                <div class="serviceList__title"><?=$service['name']; ?></div>

                <div class="serviceList__priceCol">
                    <div class="serviceList__price">
                        <?php if( $service['price_first_from'] && $service['price_first_to'] ){
                            echo '<div>' . $service['price_first_from'] . '₴</div><div>' . $service['price_first_to'] . '₴</div>';
                        }
                        else if( $service['price_first_from'] && !$service['price_first_to'] ){
                            echo $service['price_first_from'] . '₴';
                        }
                        else{
                            echo $service['price_first_to'] . '₴';
                        } ?>
                    </div>
                </div>

                <div class="serviceList__priceCol">
                    <div class="serviceList__price">
                        <?php if( $service['price_second_from'] && $service['price_second_to'] ){
                            echo '<div>' . $service['price_second_from'] . '₴</div><div>' . $service['price_second_to'] . '₴</div>';
                        }
                        else if( $service['price_second_from'] && !$service['price_second_to'] ){
                            echo $service['price_second_from'] . '₴';
                        }
                        else{
                            echo $service['price_second_to'] . '₴';
                        } ?>
                    </div>
                </div>

                <div class="serviceList__priceCol">
                    <div class="serviceList__price">
                        <?php if( $service['price_third_from'] && $service['price_third_to'] ){
                            echo '<div>' . $service['price_third_from'] . '₴</div><div>' . $service['price_third_to'] . '₴</div>';
                        }
                        else if( $service['price_third_from'] && !$service['price_third_to'] ){
                            echo $service['price_third_from'] . '₴';
                        }
                        else{
                            echo $service['price_third_to'] . '₴';
                        } ?>
                    </div>
                </div>

                <div class="serviceList__priceCol">
                    <div class="serviceList__price">
                        <?php if( $service['price_fourth_from'] && $service['price_fourth_to'] ){
                            echo '<div>' . $service['price_fourth_from'] . '₴</div><div>' . $service['price_fourth_to'] . '₴</div>';
                        }
                        else if( $service['price_fourth_from'] && !$service['price_fourth_to'] ){
                            echo $service['price_fourth_from'] . '₴';
                        }
                        else{
                            echo $service['price_fourth_to'] . '₴';
                        } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
