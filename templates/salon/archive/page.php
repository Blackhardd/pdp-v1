<section id="salons-header">
	<div class="container">
		<?php
		if( function_exists('yoast_breadcrumb') ){
			yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
		} ?>

		<div class="title">
			<h1 class="title__heading txt_fs-36px_m txt_lh-36px_m">наши салоны</h1>
		</div>
	</div>
</section>

<section id="salons-list">
	<div class="container">
		<div class="salons-slider">
			<?php
			while( have_posts() ){
				the_post();
				$city_terms = get_the_terms( get_the_ID(), 'city' );
				$city = array_pop( $city_terms )->name;
				$tel = carbon_get_post_meta( get_the_ID(), 'phone' ); ?>
				<div>
					<div class="salons-slider__item">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'salons-slider-thumb' ); ?></a>
						<div class="salons-slider__info">
							<div class="salons-slider__city"><?=$city; ?></div>
							<div class="salons-slider__address"><?php the_title(); ?></div>
							<div class="salons-slider__item-footer">
								<a href="tel:<?=str_replace( array( '(', ')', ' ' ), '', $tel ); ?>" class="salons-slider__tel"><?=$tel; ?></a>
								<a href="<?php the_permalink(); ?>" class="salons-slider__link">
									<svg width="25" height="16" fill="none">
										<path d="M24.7 8.7a1 1 0 000-1.4L18.35.92a1 1 0 10-1.41 1.41L22.59 8l-5.66 5.66a1 1 0 001.41 1.41l6.37-6.36zM0 9h24V7H0v2z" fill="#000"/>
									</svg>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php
			} ?>
		</div>
	</div>
</section>