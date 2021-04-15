<article class="blog-item">
	<?php the_post_thumbnail( 'blog-thumbnail' ); ?>
	<div class="blog-item__info">
		<div class="blog-item__meta">
			<div class="blog-item__likes">
				<svg width="14" height="14" fill="none"><path d="M12.9 1.7a3.8 3.8 0 00-5.7 0L7 2l-.2-.3a3.8 3.8 0 00-5.7 0 4.3 4.3 0 000 5.9l5.5 5.7a.5.5 0 00.8 0l5.5-5.7a4.3 4.3 0 000-5.9zM12 7L7 12.3 1.9 6.9a3.3 3.3 0 010-4.5 2.8 2.8 0 014.1 0l.6.6c.2.2.6.2.8 0l.6-.6a2.8 2.8 0 014.1 0 3.3 3.3 0 010 4.5z" fill="#392BDF"/></svg>
				<span><?=pdp_get_post_likes(); ?></span>
			</div>
			<div class="blog-item__meta-separator"></div>
			<div class="blog-item__date"><?=get_the_date(); ?></div>
		</div>
		<h3 class="blog-item__title"><a href="<?=get_permalink( get_the_ID() ); ?>"><?php the_title(); ?></a></h3>
		<a href="<?=get_permalink( get_the_ID() ); ?>" class="btn-default blog-item__read-more"><?=__( 'Читать статью', 'pdp' ); ?></a>
	</div>
</article>