<section id="franchise">
    <div class="container">
        <div class="row">
            <div class="title mb_16px mb_20px_m">
                <h3 class="title__heading">
                    <?=carbon_get_post_meta( get_the_ID(), 'franchise_heading' ); ?>
                </h3>
            </div>

            <div class="textBlock mb_20px mb_30px_m">
                <p><?=carbon_get_post_meta( get_the_ID(), 'franchise_subheading' ); ?></p>
            </div>

            <div class="row row_1-1-1 gap_col_30px" id="franchise-requirements">
                <?php foreach( carbon_get_post_meta( get_the_ID(), 'franchise_info' ) as $item ) : ?>
                    <div class="infoBox mb_20px_m">
                        <div class="infoBox__title"><?=$item['title']; ?></div>
                        <div class="infoBox__subtitle"><?=$item['subtitle']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="founders d_block_m mb_30px_m">
                <?=wp_get_attachment_image( 406, 'full' ); ?>
                <div class="founders__badge">
                    <div class="founders__title"><?=carbon_get_post_meta( get_the_ID(), 'franchise_founders_title' ); ?></div>
                    <div class="founders__desc"><?=carbon_get_post_meta( get_the_ID(), 'franchise_founders_content' ); ?></div>
                </div>
            </div>

            <div class="row row_1-1-1 gap_col_30px gap_row_40px iconGrid_franchise" id="franchise-icons">
                <?php foreach( carbon_get_post_meta( get_the_ID(), 'franchise_services' ) as $service ) : ?>
                    <div class="iconBox">
	                    <?=$service['icon']; ?>
                        <div class="iconBox__title"><?=$service['title']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cta cta_franchise">
                <div class="cta__content"><?=carbon_get_post_meta( get_the_ID(), 'franchise_cta_text' ); ?></div>
                <div class="cta__footer">
                    <a href="<?=carbon_get_post_meta( get_the_ID(), 'franchise_cta_btn_link' ); ?>" class="cta__btn btn-default" target="_blank"><?=carbon_get_post_meta( get_the_ID(), 'franchise_cta_btn_title' ); ?></a>
                    <div class="cta__phone">
	                    <?=carbon_get_post_meta( get_the_ID(), 'franchise_cta_phone' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>