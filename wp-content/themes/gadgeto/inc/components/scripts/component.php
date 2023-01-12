<?php
/**
 * TheBase\Scripts\Component class
 *
 * @package thebase
 */

namespace TheBase\Scripts;

use TheBase\Component_Interface;
use function TheBase\thebase;
use WP_Post;
use function add_action;
use function add_filter;
use function wp_enqueue_script;
use function get_theme_file_uri;
use function get_theme_file_path;
use function wp_script_add_data;
use function wp_localize_script;

/**
 * Class for adding scripts to the front end.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'scripts';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_enqueue_scripts', array( $this, 'action_enqueue_scripts' ) );
		add_action( 'wp_print_footer_scripts', array( $this, 'action_print_skip_link_focus_fix' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'ie_11_support_scripts' ), 60 );
	}
	/**
	 * Add some very basic support for IE11
	 */
	public function ie_11_support_scripts() {
		if ( apply_filters( 'thebase_add_ie11_support', false ) || thebase()->option( 'ie11_basic_support' ) ) {
			wp_enqueue_style( 'thebase-ie11', get_theme_file_uri( '/assets/css/ie.min.css' ), array(), gadgeto_VERSION );
			wp_enqueue_script(
				'thebase-css-vars-poly',
				get_theme_file_uri( '/assets/js/css-vars-ponyfill.min.js' ),
				array(),
				gadgeto_VERSION,
				true
			);
			wp_script_add_data( 'thebase-css-vars-poly', 'async', true );
			wp_script_add_data( 'thebase-css-vars-poly', 'precache', true );
			wp_enqueue_script(
				'thebase-ie11',
				get_theme_file_uri( '/assets/js/ie.min.js' ),
				array(),
				gadgeto_VERSION,
				true
			);
			wp_script_add_data( 'thebase-ie11', 'async', true );
			wp_script_add_data( 'thebase-ie11', 'precache', true );
		}
	}
	/**
	 * Enqueues a script that improves navigation menu accessibility as well as sticky header etc.
	 */
	public function action_enqueue_scripts() {

		// If the AMP plugin is active, return early.
		if ( thebase()->is_amp() ) {
			return;
		}

		$breakpoint = 1024;
		if ( thebase()->sub_option( 'header_mobile_switch', 'size' ) ) {
			$breakpoint = thebase()->sub_option( 'header_mobile_switch', 'size' );
		}
		// Enqueue the slide script.
		wp_register_script(
			'thebase-slide',
			get_theme_file_uri( '/assets/js/tiny-slider.min.js' ),
			array(),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-slide', 'async', true );
		wp_script_add_data( 'thebase-slide', 'precache', true );
		// Enqueue the slide script.
		wp_register_script(
			'thebase-slide-init',
			get_theme_file_uri( '/assets/js/slide-init.min.js' ),
			array( 'thebase-slide', 'thebase-navigation' ),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-slide-init', 'async', true );
		wp_script_add_data( 'thebase-slide-init', 'precache', true );
		wp_localize_script(
			'thebase-slide-init',
			'thebaseSlideConfig',
			array(
				'of'    => __( 'of', 'gadgeto' ),
				'to'    => __( 'to', 'gadgeto' ),
				'slide' => __( 'Slide', 'gadgeto' ),
				'next'  => __( 'Next', 'gadgeto' ),
				'prev'  => __( 'Previous', 'gadgeto' ),
			)
		);
		if ( thebase()->option( 'lightbox' ) ) {
			// Enqueue the lightbox script.
			wp_enqueue_script(
				'thebase-simplelightbox',
				get_theme_file_uri( '/assets/js/simplelightbox.min.js' ),
				array(),
				gadgeto_VERSION,
				true
			);
			wp_script_add_data( 'thebase-simplelightbox', 'async', true );
			wp_script_add_data( 'thebase-simplelightbox', 'precache', true );
			// Enqueue the slide script.
			wp_enqueue_script(
				'thebase-lightbox-init',
				get_theme_file_uri( '/assets/js/lightbox-init.min.js' ),
				array( 'thebase-simplelightbox' ),
				gadgeto_VERSION,
				true
			);
			wp_script_add_data( 'thebase-lightbox-init', 'async', true );
			wp_script_add_data( 'thebase-lightbox-init', 'precache', true );
		}
		// Enqueue the countdown script.
		wp_enqueue_script(
			'thebase-countdown',
			get_theme_file_uri( '/assets/js/countdown.min.js' ),
			array(),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-countdown', 'async', true );
		wp_script_add_data( 'thebase-countdown', 'precache', true );
		// Enqueue the owlcarousel script.
		wp_enqueue_script(
			'thebase-owl-carousel',
			get_theme_file_uri( '/assets/js/owlcarousel.min.js' ),
			array(),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-owl-carousel', 'async', true );
		wp_script_add_data( 'thebase-owl-carousel', 'precache', true );
		// Enqueue the owlcarousel script.
		wp_enqueue_script(
			'thebase-slick',
			get_theme_file_uri( '/assets/js/slick.min.js' ),
			array(),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-slick', 'async', true );
		wp_script_add_data( 'thebase-slick', 'precache', true );
		// Enqueue the Custom script.
		wp_enqueue_script(
			'thebase-custom',
			get_theme_file_uri( '/assets/js/custom.min.js' ),
			array(),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-custom', 'async', true );
		wp_script_add_data( 'thebase-custom', 'precache', true );
		// Enqueue the owlcarousel script.
		wp_enqueue_script(
			'thebase-instagram',
			get_theme_file_uri( '/assets/js/instagram-min.js' ),
			array(),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-instagram', 'async', true );
		wp_script_add_data( 'thebase-instagram', 'precache', true );
		// Main js file.
		$file = 'navigation.min.js';
		// Lets make it possile to load a lighter file if things are not being used.
		if ( 'no' === thebase()->option( 'header_sticky' ) && 'no' === thebase()->option( 'mobile_header_sticky' ) && ! thebase()->option( 'enable_scroll_to_id' ) && ! thebase()->option( 'scroll_up' ) ) {
			$file = 'navigation-lite.min.js';
		}
		wp_enqueue_script(
			'thebase-navigation',
			get_theme_file_uri( '/assets/js/' . $file ),
			array(),
			gadgeto_VERSION,
			true
		);
		wp_script_add_data( 'thebase-navigation', 'async', true );
		wp_script_add_data( 'thebase-navigation', 'precache', true );
		wp_localize_script(
			'thebase-navigation',
			'thebaseConfig',
			array(
				'screenReader' => array(
					'expand'   => __( 'Expand child menu', 'gadgeto' ),
					'collapse' => __( 'Collapse child menu', 'gadgeto' ),
				),
				'breakPoints' => array(
					'desktop' => esc_attr( $breakpoint ),
					'tablet' => 768,
				),
			)
		);
	}

	/**
	 * Prints an inline script to fix skip link focus in IE11.
	 *
	 * The script is not enqueued because it is tiny and because it is only for IE11,
	 * thus it does not warrant having an entire dedicated blocking script being loaded.
	 *
	 * Since it will never need to be changed, it is simply printed in its minified version.
	 *
	 * @link https://git.io/vWdr2
	 */
	public function action_print_skip_link_focus_fix() {

		// If the AMP plugin is active, return early.
		if ( thebase()->is_amp() ) {
			return;
		}

		// Print the minified script.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
		</script>
		<?php
	}
}