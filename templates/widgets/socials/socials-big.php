<?php
$socials_list = array(
	array(
		'title' => 'mail',
		'url'   => carbon_get_theme_option( 'email' ),
		'icon'  => '
            <svg width="16" height="16" viewBox="0 0 24 24"><path d="M23 5.8C22.9 4.3 21.6 3 20 3H4C2.4 3 1.1 4.3 1 5.8V18c0 1.7 1.3 3 3 3h16c1.7 0 3-1.3 3-3V6v-.2zM4 5h16c.4 0 .7.2.9.6L12 11.8 3.1 5.6c.2-.4.5-.6.9-.6zm17 13c0 .5-.5 1-1 1H4c-.5 0-1-.5-1-1V7.9l8.4 5.9c.2.1.4.2.6.2s.4-.1.6-.2L21 7.9V18z"/></svg>
        '
	),
	array(
		'title' => 'facebook',
		'url'   => carbon_get_theme_option( 'facebook' ),
		'icon'  => '
            <svg width="24" height="24" fill="none"><path d="M21 0H3a3 3 0 00-3 3v18a3 3 0 003 3h9v-8.3H9V12h3V9c0-2.5 2-4.5 4.5-4.5h3v3.8H18c-.8 0-1.5-.1-1.5.7v3h3.8l-1.6 3.8h-2.2V24H21a3 3 0 003-3V3a3 3 0 00-3-3z" fill="#392BDF"/></svg>
        '
	),
	array(
		'title' => 'instagram',
		'url'   => carbon_get_theme_option( 'instagram' ),
		'icon'  => '
            <svg width="25" height="24" fill="none"><path d="M17 0H8A7.5 7.5 0 00.5 7.5v9C.5 20.6 3.8 24 8 24h9c4.1 0 7.5-3.4 7.5-7.5v-9C24.5 3.4 21 0 17 0zm5.2 16.5c0 2.9-2.3 5.3-5.2 5.3H8a5.3 5.3 0 01-5.3-5.3v-9c0-2.9 2.4-5.3 5.3-5.3h9c2.9 0 5.2 2.4 5.2 5.3v9z" fill="#392BDF"/><path d="M12.5 6a6 6 0 100 12 6 6 0 000-12zm0 9.8a3.8 3.8 0 110-7.6 3.8 3.8 0 010 7.6z" fill="#392BDF"/></svg>
        '
	),
	array(
		'title' => 'telegram',
		'url'   => carbon_get_theme_option( 'telegram' ),
		'icon'  => '
            <svg width="29" height="24" fill="none"><path d="M11.4 15.4l-.4 6.5c.6 0 1-.3 1.3-.6l3-3 6.5 4.7c1.2.7 2 .3 2.3-1L28.4 2c.4-1.7-.7-2.4-1.8-2L1.8 9.6c-1.7.7-1.7 1.6-.3 2l6.3 2 14.8-9.2c.7-.4 1.3-.2.8.3l-12 10.7z" fill="#392BDF"/></svg>
        '
	),
	array(
		'title' => 'youtube',
		'url'   => carbon_get_theme_option( 'youtube' ),
		'icon'  => '
            <svg width="30" height="21" fill="none"><path d="M28.2 2C27.4.5 26.5.3 24.8.2A212 212 0 004.7.2C2.9.2 2 .5 1.2 2 .4 3.4 0 5.8 0 10s.4 6.8 1.2 8.2C2.1 19.7 3 20 4.7 20a239.7 239.7 0 0020 0c1.8-.1 2.7-.4 3.5-1.8.8-1.4 1.3-3.9 1.3-8.2 0-4.3-.5-6.7-1.3-8.1zM11 15.6v-11l9.3 5.5-9.3 5.5z" fill="#392BDF"/></svg>
        '
	)
); ?>

<div class="socials">
	<ul class="socials__list">
		<?php
		foreach( $socials_list as $socials_item ){
			if( !empty( $socials_item['url'] ) ){ ?>
				<li class="socials__item">
					<a href="<?php if( $socials_item['title'] == 'mail' ){ echo 'mailto:'; } ?><?=$socials_item['url']; ?>" class="socials__itemLink" target="_blank"><?=$socials_item['icon']; ?></a>
				</li>
				<?php
			}
		} ?>
	</ul>
</div>