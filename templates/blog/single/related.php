<?php
$related_query = pdp_get_related_posts( get_the_ID(), 3 );

if( $related_query->have_posts() ){ ?>
	<div class="post-related">
		<h3 class="post-related__title"><?=__( 'Ещё статьи по теме', 'pdp' ); ?></h3>
		<div class="post-related__posts">
			<?php
			while( $related_query->have_posts() ){
				$related_query->the_post();

				get_template_part( 'templates/blog/archive/loop-item' );
			} ?>
		</div>
	</div>
<?php }