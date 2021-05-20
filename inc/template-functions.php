<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Pied-de-Poul
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
add_filter( 'body_class', 'pdp_body_classes' );
function pdp_body_classes( $classes ){
	// Adds a class of hfeed to non-singular pages.
	if ( !is_singular() ){
		$classes[] = 'hfeed';
	}

	return $classes;
}


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
add_action( 'wp_head', 'pdp_pingback_header' );
function pdp_pingback_header(){
	if( is_singular() && pings_open() ){
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}


/**
 * Add analytics
 */
add_action( 'wp_head', 'pdp_add_analytics' );
function pdp_add_analytics(){
	echo carbon_get_theme_option( 'analytics_code' );
}

add_action( 'wp_footer', 'pdp_add_analytics_footer' );
function pdp_add_analytics_footer(){
    echo carbon_get_theme_option( 'analytics_code_footer' );
}


/**
 * Add gtag.js actions
 */
add_action( 'wp_footer', 'pdp_add_gtag_actions', 100 );
function pdp_add_gtag_actions(){
    if( $actions = carbon_get_theme_option( 'gtag_actions' ) ){
        echo "
            <script>
                jQuery(function($){
                    $(document).ready(function(){
        ";

        foreach( $actions as $action ){
            echo "$('{$action['selector']}').on('{$action['event']}', () => gtag('event', '{$action['gtag_event']}', { 'event_category': '{$action['gtag_category']}', 'event_action': '{$action['gtag_action']}' }));\n";
        }

        echo "
                    });
                });
            </script>
        ";
    }
}


/**
 * Add appointment button to main menu.
 */
add_filter( 'wp_nav_menu_items', 'pdp_menu_add_appointments', 10, 2 );
function pdp_menu_add_appointments( $items, $args ){
	if( 'header-menu' == $args->theme_location ){
		ob_start(); ?>
        <li class="menu-item menu-item_book">
            <button class="booking-btn">
                <?=__( 'Запись', 'pdp' ); ?>
                <div class="booking-btn__counter">
                    {{ cartItems }}
                </div>
            </button>
            <div class="cart-wrap cart-wrap--header">
                <cart />
            </div>
        </li>
		<?php
		$items .= ob_get_clean();
	}

	return $items;
}


/**
 * Add right appointment button.
 */
add_action( 'wp_footer', 'pdp_add_right_appointment_button' );
function pdp_add_right_appointment_button(){
	if( !is_page_template( 'pricelist.php' ) ){ ?>
        <div class="sticky-btns">
            <button class="btn-sticky-right sticky-btns__btn" data-micromodal-trigger="modal-appointment"><?=__( 'Online запись', 'pdp' ); ?></button>
        </div>
		<?php
	}
}


/**
 *  Add promotion details modal
 */
function pdp_add_promotions_modal( $promotions = array() ){
	$html = '<div class="promotion-details-wrap">';

	foreach( $promotions as $key => $promotion ){
		$content = wpautop( $promotion->post_content );
		$thumbnail = get_the_post_thumbnail( $promotion->ID, 'medium' );

		$html .= "
            <div class='promotion-details' data-promotion='{$promotion->post_title}'>
                <div class='promotion-details__header'>{$promotion->post_title}</div>
                <div class='promotion-details__body'>
                    {$content}
                </div>
            </div>
        ";
	}

	$html .= '</div>';

	add_action( 'wp_footer', function() use ( &$html ) { ?>
        <div class="modal" id="modal-promotions" aria-hidden="true">
            <div class="modal__dimmer" data-micromodal-close>
                <div class="modal__inner">
                    <button class="modal__close btn-icon" aria-label="Close modal" data-micromodal-close><svg width="14" height="14" fill="none"><path d="M14 1.4L12.6 0 7 5.6 1.4 0 0 1.4 5.6 7 0 12.6 1.4 14 7 8.4l5.6 5.6 1.4-1.4L8.4 7 14 1.4z" fill="#000"/></svg></button>
                    <div class="modal__content">
						<?=$html; ?>
						<?php get_template_part( 'templates/forms/appointment-promotion' ); ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	} );
}


/**
 * Remove title from pagination
 */
add_filter( 'navigation_markup_template', 'pdp_pagination_template', 10, 2 );
function pdp_pagination_template( $template, $class ){
	return '
        <nav class="navigation %1$s" role="navigation">
            <div class="nav-links">%3$s</div>
        </nav>    
	';
}


/**
 * Registration of image sizes for theme.
 */
function pdp_register_image_sizes(){
	if( function_exists( 'add_image_size' ) ){
		add_image_size( 'testimonial', 160, 160, true );
		add_image_size( 'salons-slider-thumb', 540, 424, true );
		add_image_size( 'services-slider-thumb', 340, 340, true );
		add_image_size( 'salon-carousel-large', 1260, 800, true );
		add_image_size( 'salon-carousel-nav', 248, 154, true );
		add_image_size( 'salon-master', 291, 400, true );

		/**
		 *  Blog
		 */
		add_image_size( 'blog-header', 345, 345, true );
		add_image_size( 'blog-thumbnail', 300, 300, true );
	}
}
pdp_register_image_sizes();


/**
 *  Allow to search only posts
 */
add_filter( 'pre_get_posts', 'pdp_search_posts_filter' );
function pdp_search_posts_filter( $query ){
	if( $query->is_search ){
		$query->set( 'post_type', 'post' );
	}

	return $query;
}


/**
 *  Generate and output posts sort order
 */
function pdp_posts_sort_toggler(){
	$order = 'asc';

	if( isset( $_GET['order'] ) && $_GET['order'] == 'asc' ){
		$order = 'desc';
	}

	echo '<a href="?orderby=date&order=' . $order . '" class="blog-filter__sort-btn btn-icon"><svg width="18" height="12" fill="none"><path d="M0 12h6v-2H0v2zM0 0v2h18V0H0zm0 7h12V5H0v2z" fill="#000"/></svg></a>';
}


/**
 *  Generate and output tags cloud
 */
function pdp_tags_cloud(){
	$tags = get_tags();
	$current_tag = get_queried_object();
	$html = '';

	foreach( $tags as $tag ){
		$tag_link = get_tag_link( $tag->term_id );
		$tag_classes = 'blog-tags__item';

		if( $current_tag->slug == $tag->slug ){
			$tag_classes .= ' active';
		}

		$html .= "<a href='{$tag_link}' title='{$tag->name} тег' class='{$tag_classes}'>";
		$html .= "#{$tag->name}</a>";
	}

	echo $html;
}


/**
 *  Getting post likes
 */
function pdp_get_post_likes(){
	if( get_post_meta( get_the_ID(), '_likes', true ) ){
		return get_post_meta( get_the_ID(), '_likes', true );
	}

	return 0;
}


/**
 *  Get salon related masters
 */
function pdp_get_salon_masters( $salon_term_id ){
	return get_posts(
		array(
			'posts_per_page'    => -1,
			'post_type'         => 'master',
			'tax_query'         => array(
				array(
					'taxonomy'  => 'salon',
					'field'     => 'id',
					'terms'     => $salon_term_id
				)
			)
		)
	);
}


/**
 *  Getting related service pages
 */
function pdp_get_related_pages( $post = false ){
	if( !$post ){
		return false;
	}
	else{
		if( $post->post_parent != 0 ){
			return get_children( array(
				'post_type'     => 'page',
				'numberposts'   => 4,
				'orderby'       => 'rand',
				'order'         => 'ASC',
				'post_parent'   => $post->post_parent,
				'exclude'       => $post->ID
			) );
		}
		else{
			$pages = array(
				117,
				108,
				98,
				88,
				130,
				132
			);

			if( ($key = array_search( $post->ID, $pages ) ) !== false ){
				unset( $pages[$key] );
				$pages = array_values( $pages );
			}

			$random_keys = array_rand( $pages, 4 );

			$pages = array(
				$pages[$random_keys[0]],
				$pages[$random_keys[1]],
				$pages[$random_keys[2]],
				$pages[$random_keys[3]]
			);

			return get_posts( array(
				'post_type'     => 'page',
				'numberposts'   => 4,
				'orderby'       => 'rand',
				'order'         => 'ASC',
				'include'       => implode( ',', $pages ),
			) );
		}
	}
}


/**
 *  Form Fields
 */

function pdp_get_form_field( $name = false, $required = false ){
    if( $name ){
        ob_start();
        get_template_part( 'templates/forms/fields/' . $name, null, ['required' => $required] );
        return ob_get_clean();
    }

    return null;
}

function pdp_form_field( $name = false, $required = false ){
    if( $name ){
        echo pdp_get_form_field( $name, $required );
    }
}