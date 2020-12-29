<section id="blog-archive-header">
	<div class="container">
		<div class="blog-header">
			<div class="blog-header__content">
				<?php
				if( function_exists('yoast_breadcrumb') ){
					yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
				} ?>

				<h1 class="blog-header__title">наш блог</h1>
				<div class="blog-header__subtitle">ценные статьи, уроки, видео</div>
				<div class="blog-header__desc">Все, что вы хотели знать о красоте, моде, нашем салоне и работе на себя в сфере красоты. Узнавайте каждый день что-то новое вместе с нашей командой!</div>
			</div>

			<?=wp_get_attachment_image( 375, 'full' ); ?>
		</div>
	</div>
</section>

<section id="blog-archive">
	<div class="container">
		<div class="blog-filter">
			<div class="blog-filter__sort">
				<?php pdp_posts_sort_toggler(); ?>
			</div>

            <div class="blog-tags">
				<?php pdp_tags_cloud(); ?>
            </div>
		</div>

		<div class="blog-items_grid">
			<?php
			while( have_posts() ){
				the_post();
				get_template_part( 'templates/blog/archive/loop-item' );
			} ?>
		</div>

        <div class="blog-pagination">
            <?php the_posts_pagination(); ?>
        </div>
	</div>
</section>