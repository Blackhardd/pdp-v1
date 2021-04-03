<div class="phones-list phones-list_mobile" :class="{ active: isMobileSalonsListActive }">
    <div class="phones-list__close">
        <button class="btn-icon" @click="closeMenus">
            <svg width="20" height="20" fill="none"><path d="M20 10a10 10 0 10-20 0 10 10 0 0020 0zM8 10l4-4v8l-4-4z" fill="#392BDF"/></svg>
        </button>
    </div>

    <div class="phones-list__inner">
	    <?php
	    $cat_args = array(
		    'taxonomy'      => 'city',
		    'child_of'      => 0,
		    'hide_empty'    => 1
	    );

	    foreach( get_categories( $cat_args ) as $tax ){ ?>
            <div class="phones-list__group">
                <div class="phones-list__label"><?=$tax->name; ?></div>
			    <?php
			    $posts_args = array(
				    'post_type'         => 'salon',
				    'post_status'       => 'publish',
				    'posts_per_page'    => -1,
				    'tax_query'         => array(
					    array(
						    'taxonomy'  => 'city',
						    'field'     => 'slug',
						    'terms'     => $tax->slug
					    )
				    )
			    );

			    foreach( get_posts( $posts_args ) as $salon ){ ?>
                    <div class="phones-list__item">
                        <div class="phones-list__address"><?=$salon->post_title; ?></div>
                        <a href="tel:<?=str_replace( array( '(', ')', ' ' ), '', carbon_get_post_meta( $salon->ID, 'phone' ) ); ?>" class="phones-list__phone"><?=carbon_get_post_meta( $salon->ID, 'phone' ); ?></a>
                    </div>
			    <?php } ?>
            </div>
	    <?php } ?>

        <div class="phones-list__footer">
            <div class="phones-list__footer-title"><?=__( 'Он-лайн запись', 'pdp' ); ?></div>
            <a href="https://t.me/Pied_De_Poule_bot" target="_blank" class="btn-default phones-list__telegram"><?=__( 'через Telegram bot', 'pdp' ); ?><svg width="18" height="16" fill="none"><path d="M7 10.4l-.2 4.2c.4 0 .6-.2.8-.4l2-2 4.1 3c.8.5 1.3.3 1.5-.6L18 1.9C18.2.7 17.5.3 16.8.6l-16 6c-1 .5-1 1.1-.1 1.4l4 1.3 9.5-6c.5-.3.9-.1.5.2l-7.6 6.9z" fill="#fff"/></svg></a>
        </div>
    </div>
</div>