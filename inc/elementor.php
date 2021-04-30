<?php

add_action( 'init', 'pdp_load_elementor_widgets' );
function pdp_load_elementor_widgets(){
	if( !class_exists( 'PDP_Hero' ) ) :
		require TEMPLATEPATH . '/elementor/class-pdp-hero.php';
	endif;

	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PDP_Hero() );
}