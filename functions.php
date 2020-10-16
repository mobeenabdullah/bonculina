<?php
/**
 * Theme functions and definitions
 *
 * @package BonCulina
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'BONCULINA_ELEMENTOR_VERSION', '1.0.0' );

// Including extra theme files
include_once 'inc/filterable-products.php';

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}
define( 'BONCULINA_THEME_URI', get_template_directory_uri() );
if ( ! function_exists( 'bonculina_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function bonculina_setup() {
		$hook_result = apply_filters_deprecated( 'elementor_bonculina_theme_load_textdomain', [ true ], '2.0', 'bonculina_load_textdomain' );
		if ( apply_filters( 'bonculina_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'bonculina', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'elementor_bonculina_theme_register_menus', [ true ], '2.0', 'bonculina_register_menus' );
		if ( apply_filters( 'bonculina_register_menus', $hook_result ) ) {
			register_nav_menus( array( 'menu-1' => __( 'Primary', 'bonculina' ) ) );
            register_nav_menus( array( 'menu-2' => __( 'Secondary', 'bonculina' ) ) );
		}

		$hook_result = apply_filters_deprecated( 'elementor_bonculina_theme_add_theme_support', [ true ], '2.0', 'bonculina_add_theme_support' );
		if ( apply_filters( 'bonculina_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				)
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'editor-style.css' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_bonculina_theme_add_woocommerce_support', [ true ], '2.0', 'bonculina_add_woocommerce_support' );
			if ( apply_filters( 'bonculina_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'bonculina_setup' );

if ( ! function_exists( 'add_header_after_body_open' ) ) {
    function add_header_after_body_open() { ?>
        <nav class="off-canvas-menu" id="menu-off-canvas-menu" role="navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'menu-2' ) ); ?>
		</nav>
		<a href="#" class="toggle-nav btn btn-lg btn-success" id="big-sexy"><i class="fa fa-bars"></i></a>
    <?php }
}
add_action('wp_body_open', 'add_header_after_body_open');

if ( ! function_exists( 'bonculina_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function bonculina_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_bonculina_theme_enqueue_style', [ true ], '2.0', 'bonculina_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'bonculina_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'bonculina',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				BONCULINA_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'bonculina_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'bonculina-theme-style',
				get_template_directory_uri() . '/theme-style' . '.css',
				[],
				BONCULINA_ELEMENTOR_VERSION
			);
		}

        //wp_enqueue_script('quicksand-js', get_template_directory_uri() . '/assets/js/jquery.quicksand.js', array('jquery'), BONCULINA_ELEMENTOR_VERSION, true);
        wp_enqueue_script('isotope-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', array('jquery'), BONCULINA_ELEMENTOR_VERSION, true);
		
		/* Growl */
        wp_enqueue_script( 'growl', BONCULINA_THEME_URI . '/assets/libs/growl/jquery.growl.js', array( 'jquery' ), null, true );
        wp_enqueue_style( 'growl', BONCULINA_THEME_URI . '/assets/libs/growl/jquery.growl.css' );
		
		wp_enqueue_script('bonculina-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), BONCULINA_ELEMENTOR_VERSION, true);
		
		

        /* Main JS */
        if ( class_exists( 'WooCommerce' ) ) {
            $notice_cart_url = wc_get_cart_url();
        } else {
            $notice_cart_url = '/cart';
        }
		wp_enqueue_script('bonculina-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), BONCULINA_ELEMENTOR_VERSION, true);
        wp_localize_script( 'bonculina-custom-js', 'jsVars', array(
            'ajaxUrl'                 => esc_js( admin_url( 'admin-ajax.php' ) ),
            //'popupEnable'             => esc_js( Insight::setting( 'popup_enable' ) ),
            //'popupReOpen'             => esc_js( Insight::setting( 'popup_reopen' ) ),
            //'noticeCookieEnable'      => esc_js( Insight::setting( 'notice_cookie_enable' ) ),
            'noticeCartUrl'           => esc_js( $notice_cart_url ),
            'noticeCartText'          => esc_js( esc_html__( 'View cart', 'bonculina' ) ),
            'noticeAddedCartText'     => esc_js( esc_html__( 'Added to cart!', 'bonculina' ) ),
           // 'noticeAddedWishlistText' => esc_js( esc_html__( 'Added to wishlist!', 'bonculina' ) ),
           // 'noticeCookie'            => esc_js( wp_kses( Insight::setting( 'notice_cookie_message' ), 'insight-a' ) ),
            'noticeCookieOk'          => esc_js( esc_html__( 'Thank you! Hope you have the best experience on our website.', 'bonculina' ) ),
        ) );
	}
}
add_action( 'wp_enqueue_scripts', 'bonculina_scripts_styles' );

if ( ! function_exists( 'bonculina_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function bonculina_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_bonculina_theme_register_elementor_locations', [ true ], '2.0', 'bonculina_register_elementor_locations' );
		if ( apply_filters( 'bonculina_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'bonculina_register_elementor_locations' );

if ( ! function_exists( 'bonculina_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function bonculina_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'bonculina_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'bonculina_content_width', 0 );

if ( ! function_exists( 'bonculina_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function bonculina_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'bonculina_page_title', 'bonculina_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'bonculina_body_open' ) ) {
	function bonculina_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}
//show details under add to cart
add_action( 'woocommerce_after_add_to_cart_button', 'html_after_add_to_cart' );
function html_after_add_to_cart(){
    echo '<br/>';
    echo '<br/>';
    echo do_shortcode(' [sc name="usps"]');
}