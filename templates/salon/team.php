<?php $team = pdp_get_salon_masters( carbon_get_post_meta( get_the_ID(), 'masters_term' )[0]['id'] ); ?>

<div class="title mb_10px">
	<h2 class="title__heading txt_fs-36px txt_lh-36px"><?=__( 'Наша команда', 'pdp' ); ?></h2>
</div>

<div class="textBlock mw_550px mb_60px txt_fs-18px txt_lh-24px">
	<p><?=__( 'Высокое качество услуг вы получаете благодаря сплоченной команде наших профессионалов.', 'pdp' ); ?></p>
</div>

<div class="team-slider">
	<?php foreach( $team as $master ){
		$name = $master->post_title;
		$title = carbon_get_post_meta( $master->ID, 'specialty' );
		$experience =  carbon_get_post_meta( $master->ID, 'experience' ); ?>
		<div class="team-slider__item">
			<div class="masterCard">
				<?=get_the_post_thumbnail( $master->ID, 'salon-master' ); ?>
				<div class="masterCard__info">
					<div class="masterCard__name"><?=$name; ?></div>
					<div class="masterCard__title"><?=$title; ?></div>
					<div class="masterCard__expirience"><?=$experience; ?></div>

					<button class="masterCard__btn btn-default" data-master="<?=$master->ID; ?>"><?=__( 'Записаться', 'pdp' ); ?></button>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<div class="team-details mt_120px">
	<?php foreach( $team as $master ){
		$name = $master->post_title;
		$title = carbon_get_post_meta( $master->ID, 'specialty' );
		$experience =  carbon_get_post_meta( $master->ID, 'experience' );
		$info = $master->post_content; ?>
		<div class="master-details" data-master="<?=$master->ID; ?>">
			<div class="master-details__left">
				<?=get_the_post_thumbnail( $master->ID, 'salon-master', array( 'class' => 'master-details__photo' ) ); ?>
				<?php get_template_part( 'templates/forms/appointment-master', null, ['master' => $name] ); ?>
			</div>
			<div class="master-details__right">
				<div class="master-details__name"><?=$name; ?></div>
				<div class="master-details__title"><?=$title; ?></div>
				<div class="master-details__experience"><?=__( 'Опыт', 'pdp' ); ?> <?=$experience; ?></div>
				<div class="master-details__info"><?=$info; ?></div>
			</div>
		</div>
	<?php } ?>
</div>