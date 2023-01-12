<?php
/**
 * TheBase\Options\Component class
 *
 * @package thebase
 */

namespace TheBase\Options;

use TheBase\Component_Interface;
use TheBase\Templating_Component_Interface;
use function TheBase\thebase;
use function apply_filters;
use function get_option;
use function is_null;
use function wp_parse_args;
use function add_filter;
use function add_action;

/**
 * Class for managing stylesheets.
 *
 * Exposes template tags:
 * * `thebase()->option()`
 * * `thebase()->default()`
 * * `thebase()->get_option_type()`
 * * `thebase()->get_option_name()`
 * * `thebase()->sub_option()`
 * * `thebase()->sidebar_options()`
 * * `thebase()->palette_option()`
 * * `thebase()->get_palette()`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Holds default theme option values
	 *
	 * @var default values of the theme.
	 */
	protected static $default_options = null;

	/**
	 * Settings database Name.
	 *
	 * @var array
	 */
	private static $opt_name = null;

	/**
	 * Settings database Name.
	 *
	 * @var array
	 */
	private static $opt_type = null;

	/**
	 * Holds theme option values
	 *
	 * @var values of the theme settings.
	 */
	protected static $options = null;

	/**
	 * Holds palette values
	 *
	 * @var values of the theme settings.
	 */
	protected static $palette = null;

	/**
	 * Holds sidebar options values
	 *
	 * @var values of the theme settings.
	 */
	protected static $sidebars = null;

	/**
	 * Holds default palette values
	 *
	 * @var values of the theme settings.
	 */
	protected static $default_palette = null;

	/**
	 * Holds default theme option values for cpt
	 *
	 * @var default values of the theme.
	 */
	protected static $cpt_options = null;
	/**
	 * Holds theme option values
	 *
	 * @var values of the theme settings.
	 */
	protected static $custom_options = array();

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'options';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_loaded', array( $this, 'add_default_options' ) );
		add_action( 'customize_register', array( $this, 'add_default_options' ), 5 );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `thebase()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return array(
			'option'                     => array( $this, 'option' ),
			'default'                    => array( $this, 'default' ),
			'get_option_type'            => array( $this, 'get_option_type' ),
			'get_option_name'            => array( $this, 'get_option_name' ),
			'sub_option'                 => array( $this, 'sub_option' ),
			'sidebar_options'            => array( $this, 'sidebar_options' ),
			'palette_option'             => array( $this, 'palette_option' ),
			'get_palette'                => array( $this, 'get_palette' ),
			'get_default_palette'        => array( $this, 'get_default_palette' ),
			'get_palette_for_customizer' => array( $this, 'get_palette_for_customizer' ),
		);
	}

	/**
	 * Get Option Type
	 *
	 * @access public
	 * @return string
	 */
	public function get_option_type() {
		// Define sections.
		if ( is_null( self::$opt_type ) ) {
			self::$opt_type = apply_filters( 'thebase_theme_option_type', 'theme_mod' );
		}
		// Return option_type.
		return self::$opt_type;
	}

	/**
	 * Get Option Name
	 *
	 * @access public
	 * @return string
	 */
	public function get_option_name() {
		// Define sections.
		if ( is_null( self::$opt_name ) ) {
			self::$opt_name = apply_filters( 'thebase_theme_option_name', 'thebase_settings' );
		}
		// Return option_name.
		return self::$opt_name;
	}
	/**
	 * Set default theme option values
	 *
	 * @return default values of the theme.
	 */
	public static function defaults() {
		// Don't store defaults until after init.
		if ( is_null( self::$default_options ) ) {
			self::$default_options = apply_filters(
				'thebase_theme_options_defaults',
				array(
					'content_width'   => array(
						'size' => 1648,
						'unit' => 'px',
					),
					'content_narrow_width'   => array(
						'size' => 1248,
						'unit' => 'px',
					),
					'content_edge_spacing'   => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => 1,
							'desktop' => 1.5,
						),
						'unit' => array(
							'mobile'  => 'rem',
							'tablet'  => 'rem',
							'desktop' => 'rem',
						),
					),
					'content_spacing'   => array(
						'size' => array(
							'mobile'  => 2,
							'tablet'  => 2.5,
							'desktop' => 3,
						),
						'unit' => array(
							'mobile'  => 'rem',
							'tablet'  => 'rem',
							'desktop' => 'rem',
						),
					),
					'boxed_spacing'   => array(
						'size' => array(
							'mobile'  => 1.5,
							'tablet'  => 2.5,
							'desktop' => 4,
						),
						'unit' => array(
							'mobile'  => 'rem',
							'tablet'  => 'rem',
							'desktop' => 'rem',
						),
					),
					'boxed_shadow' => array(
						'color'   => 'rgba(0,0,0,.05)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => 0,
						'inset'   => false,
					),
					'boxed_border_radius' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => true,
					),
					'boxed_grid_spacing'   => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => 0,
						),
						'unit' => array(
							'mobile'  => 'rem',
							'tablet'  => 'rem',
							'desktop' => 'rem',
						),
					),
					'boxed_grid_shadow' => array(
						'color'   => 'rgba(0,0,0,.3)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => 0,
						'inset'   => false,
					),
					'boxed_grid_border_radius' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => true,
					),
					'site_background'                => array(
						'desktop' => array(
							'color' => 'palette8',
						),
					),
					'content_background'                => array(
						'desktop' => array(
							'color' => 'palette9',
						),
					),
					// Sidebar.
					'sidebar_width'   => array(
						'size' => '19',
						'unit' => '%',
					),
					'sidebar_widget_spacing'   => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => 1.5,
							'desktop' => 1.875,
						),
						'unit' => array(
							'mobile'  => 'em',
							'tablet'  => 'em',
							'desktop' => 'em',
						),
					),
					'sidebar_widget_title' => array(
						'size' => array(
							'desktop' => 17,
						),
						'lineHeight' => array(
							'desktop' => 1.5,
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '600',
						'variant' => '600',
						'color'   => 'palette3',
					),
					'sidebar_widget_content'            => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '1.5',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => 'palette5',
					),
					'sidebar_link_style' => 'plain',
					'sidebar_link_colors' => array(
						'color' => 'palette5',
						'hover' => 'palette5',
					),
					'sidebar_background' => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'sidebar_divider_border' => array(),
					'sidebar_padding'        => array(
						'size'   => array( 
							'desktop' => array( '', '', '', '' ),
						),
						'unit'   => array(
							'desktop' => 'px',
						),
						'locked' => array(
							'desktop' => false,
						),
					),
					'sidebar_sticky'               => false,
					'sidebar_sticky_last_widget'   => false,
					// Links.
					'link_color'                     => array(
						'highlight'      => 'palette5',
						'highlight-alt'  => 'palette5',
						'highlight-alt2' => 'palette2',
						'style'          => 'no-underline',
					),
					// Scroll To Top.
					'scroll_up'               => true,
					'scroll_up_side'          => 'right',
					'scroll_up_icon'          => 'arrow-up',
					'scroll_up_icon_size'   => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => 1.2,
						),
						'unit' => array(
							'mobile'  => 'em',
							'tablet'  => 'em',
							'desktop' => 'em',
						),
					),
					'scroll_up_side_offset'   => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => 30,
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'scroll_up_bottom_offset'   => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => 30,
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'scroll_up_visiblity' => array(
						'desktop' => true,
						'tablet'  => true,
						'mobile'  => false,
					),
					'scroll_up_style' => 'outline',
					'scroll_up_padding' => array(
						'size'   => array( 
							'desktop' => array( 0.4, 0.4, 0.4, 0.4 ),
						),
						'unit'   => array(
							'desktop' => 'em',
						),
						'locked' => array(
							'desktop' => true,
						),
					),
					'scroll_up_color'                     => array(
						'color'  => 'palette1',
						'hover'  => 'palette5',
					),
					'scroll_up_background'                     => array(
						'color'  => '',
						'hover'  => '',
					),
					'scroll_up_border_colors'         => array(
						'color'  => 'palette1',
						'hover'  => 'palette5',
					),
					'scroll_up_border'    => array(
						'width' => '2',
						'unit' => 'px',
						'style'=> 'solid',
						'color'  => 'palette1',
						'hover'  => 'palette5',
					),
					'scroll_up_border'    => array(),
					'scroll_up_radius' => array(
						'size'   => array( 0, 0, 0, 0 ),
						'unit'   => 'px',
						'locked' => true,
					),
					'comment_form_remove_web'  => false,
					'comment_form_before_list' => false,
					// Buttons.
					'buttons_color'                     => array(
						'color'  => 'palette1',
						'hover'  => 'palette1',
					),
					'buttons_background' => array(
						'color'  => 'palette2',
						'hover'  => 'palette2',
					),
					'buttons_border_colors' => array(
							'color'  => 'palette2',
							'hover'  => 'palette2',
					),
					'buttons_border' => array(
						'desktop' => array(
							'width' => '',
							'unit'  => 'px',
							'style' => 'solid',
							'color'  => 'palette7',
							'hover'  => 'palette2',
						),
					),
					'buttons_border_radius' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '50',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'buttons_typography'    => array(
						'size' => array(
							'desktop' => '15',
						),
						'lineHeight' => array(
							'desktop' => '18',
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'desktop' => '0.3',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
					),
					'buttons_padding'        => array(
						'size'   => array(
							'mobile' => array( '10', '10', '10', '10' ),
							'tablet' => array( '10', '16', '10', '16' ),
							'desktop' => array( '13', '30', '13', '30' ),
						),
						'unit'   => array(
							'desktop' => 'px',
						),
						'locked' => array(
							'desktop' => false,
						),
					),
					'buttons_shadow' => array(
						'color'   => 'rgba(0,0,0,0)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => 0,
						'inset'   => false,
					),
					'buttons_shadow_hover' => array(
						'color'   => 'rgba(0,0,0,0)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => 0,
						'inset'   => false,
					),
					'enable_footer_on_bottom' => true,
					'enable_scroll_to_id'     => true,
					'lightbox' => false,
					'enable_popup_body_animate' => true,
					// Typography.
					'base_font' => array(
						'size' => array(
							'desktop' => 15,
						),						
						'lineHeight' => array(
							'desktop' => 22,
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'desktop' => '0.3',
						),
						'spacingType'=> 'px',
						//'family'  => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"',
						'transform' => 'uppercase',
						'family'  => 'Inter',
						'google'  => true,
						'transform' => '',
						'weight'  => '400',
						'variant' => '400',
						'color'   => 'palette5',
					),					
					'load_base_italic'    => false,
					'google_subsets'      => array(),
					'load_fonts_local'    => false,
					'preload_fonts_local' => true,
					'heading_font'        => array(
						'family' => 'inherit',
					),
					'h1_font' => array(
						'size' => array(
							'mobile' => 32,
							'tablet' => 40,
							'desktop' => 48,
						),
						'lineHeight' => array(
							'mobile' => 40,
							'tablet' => 45,
							'desktop' => 54,
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '-1',
							'tablet' => '-1',
							'desktop' => '0',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '400',
						'variant' => '400',
						'color'   => 'palette5',
					),
					'h2_font' => array(
						'size' => array(
							'mobile' => 26,
							'tablet' => 30,
							'desktop' => 37,
						),
						'lineHeight' => array(
							'mobile' => 30,
							'tablet' => 34,
							'desktop' => 42,
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '-0.5',
							'desktop' => '0.3',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '600',
						'variant' => '600',
						'color'   => 'palette3',
					),
					'h3_font' => array(
						'size' => array(
							'mobile' => 15,
							'tablet' => 18,
							'desktop' => 23,
						),
						'lineHeight' => array(
							'mobile' => 20,
							'tablet' => 24,
							'desktop' => 28,
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '0',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '600',
						'variant' => '600',
						'color'   => 'palette3'
					),
					'h4_font' => array(
						'size' => array(
							'mobile' => 18,
							'tablet' => 20,
							'desktop' => 20,
						),
						'lineHeight' => array(
							'mobile' => 20,
							'tablet' => 24,
							'desktop' => 30,
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '0',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette3',
					),
					'h5_font' => array(
						'size' => array(
							'mobile' => 16,
							'tablet' => 17,
							'desktop' => 17,
						),
						'lineHeight' => array(
							'mobile' => 20,
							'tablet' => 22,
							'desktop' => 22,
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '0',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette3'
					),
					'h6_font' => array(
						'size' => array(
							'mobile' => 14,
							'tablet' => 16,
							'desktop' => 16,
						),
						'lineHeight' => array(
							'mobile' => 20,
							'tablet' => 20,
							'desktop' => 22,
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '0',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette3',
					),
					'title_above_font' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'title_above_breadcrumb_font' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '',
						),
						'spacingType'=> 'px',
						'transform' => 'none',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => 'palette3',
					),
					'google_subsets' => array(
						'latin-ext' => false,
						'cyrillic' => false,
						'cyrillic-ext' => false,
						'greek' => false,
						'greek-ext' => false,
						'vietnamese' => false,
						'arabic' => false,
						'khmer' => false,
						'chinese' => false,
						'chinese-simplified' => false,
						'tamil' => false,
						'bengali' => false,
						'devanagari' => false,
						'hebrew' => false,
						'korean' => false,
						'thai' => false,
						'telugu' => false,
					),
					'header_mobile_switch'            => array(
						'size' => '',
						'unit' => 'px',
					),
					// Header.
					'header_desktop_items'       => array(
						'top' => array(
							'top_left'         => array('contact'),
							'top_left_center'  => array(),
							'top_center'       => array(),
							'top_right_center' => array(),
							'top_right'        => array('html'),
						),
						'main' => array(
							'main_left'         => array('logo'),
							'main_left_center'  => array('search-bar'),
							'main_center'       => array(),
							'main_right_center' => array(),
							'main_right'        => array( 'account','html2','cart' ),
						),
						'bottom' => array(
							'bottom_left'         => array('toggle widget'),
							'bottom_left_center'  => array(),
							'bottom_center'       => array('navigation'),
							'bottom_right_center' => array(),
							'bottom_right'        => array('navigation-2'),
						),
					),
					'header_wrap_background' => array(
						'desktop' => array(
							'color' => '#ffffff',
						),
					),
					// Header Main.
					'header_main_height' => array(
						'size' => array(
							'mobile'  => 50,
							'tablet'  => 90,
							'desktop' => 70,
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'header_main_layout'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'standard',
					),
					'header_main_background' => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'header_main_trans_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'header_main_top_border'    => array(
						'desktop' => array(
							'width' => '',
							'unit'  => '',
							'style' => '',
							'color'  => '',
						),
					),
					'header_main_bottom_border' => array(
						'desktop' => array(
							'width' => 1,
							'unit'  => 'px',
							'style' => 'solid',
							'color'  => '#e5e5e5',
						),
					),
					'header_main_padding' => array(
						'size'   => array( 
							'desktop' => array( '10', '24', '10', '24' ),
							'tablet' => array( '0', '20', '20', '20' ),
							'mobile' => array( '20', '20', '20', '20' ),
						),
						'unit'   => array(
							'desktop' => 'px',
							'tablet' => 'px',
							'mobile' => 'px',
						),
						'locked' => array(
							'desktop' => false,
							'tablet' => false,
							'mobile' => false,							
						),
					),
					// Header Top.
					'header_top_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => 40,
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'header_top_layout'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'standard',
					),
					'header_top_background'    => array(
						'desktop' => array(
							'color' => '#f2f2f2',
						),
					),
					'header_top_trans_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'header_top_top_border'    => array(),
					'header_top_bottom_border' => array(),
					'header_top_padding' => array(
						'size'   => array( 
							'desktop' => array( '', '', '', '' ),
						),
						'unit'   => array(
							'desktop' => 'px',
						),
						'locked' => array(
							'desktop' => false,
						),
					),
					// Header Bottom.
					'header_bottom_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => 55,
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'header_bottom_layout'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'standard',
					),
					'header_bottom_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'header_bottom_trans_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'header_bottom_top_border'    => array(),
					'header_bottom_bottom_border' => array(),
					'header_bottom_padding' => array(
						'size'   => array( 
							'desktop' => array( '', '', '', '' ),
						),
						'unit'   => array(
							'desktop' => 'px',
						),
						'locked' => array(
							'desktop' => false,
						),
						'header_bottom_bottom_border' => array(
							'desktop' => array(
								'width' => 1,
								'unit'  => 'px',
								'style' => 'solid',
								'color'  => '#e5e5e5',
							),
						),
					),
					// Mobile Header.
					'header_mobile_items' => array(
						'popup' => array(
							'popup_content' => array( 'mobile-navigation' ),
						),
						'top' => array(
							'top_left'   => array(),
							'top_center' => array(),
							'top_right'  => array(),
						),
						'main' => array(
							'main_left'   => array( 'popup-toggle','mobile-logo' ),
							'main_center' => array(),
							'main_right'  => array( 'search','mobile-account','mobile-html','mobile-cart' ),
						),
						'bottom' => array(
							'bottom_left'   => array(),
							'bottom_center' => array(),
							'bottom_right'  => array(),
						),
					),
					// Logo.
					'logo_width'                     => array(
						'size' => array(
							'mobile'  => 100,
							'tablet'  => 170,
							'desktop' => 191,
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'use_mobile_logo' => true,
					'logo_layout'     => array(
						'include' => array(
							'mobile'  => 'logo_only',
							'tablet'  => 'logo_only',
							'desktop' => 'logo_only',
						),
						'layout' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => 'standard',
						),
					),
					'brand_typography'            => array(
						'size' => array(
							'desktop' => 30,
						),
						'lineHeight' => array(
							'desktop' => 1.2,
						),
						'family'  => 'inherit',
						'transform' => 'uppercase',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette3',
					),
					'brand_typography_color'              => array(
						'hover'  => '',
						'active' => '',
					),
					'brand_tag_typography'            => array(
						'size' => array(
							'desktop' => 16,
						),
						'lineHeight' => array(
							'desktop' => 1.4,
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette5',
					),
					'header_logo_padding' => array(
						'size'   => array( 
							'desktop' => array( '', '', '', '' ),
						),
						'unit'   => array(
							'desktop' => 'px',
						),
						'locked' => array(
							'desktop' => false,
						),
					),
					// Navigation.
					'primary_navigation_typography'            => array(
						'size' => array(
							'desktop' => '15',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'transform' => 'capitalize',
					),
					'primary_navigation_spacing'            => array(
						'size' => 3,
						'unit' => 'em',
					),
					'primary_navigation_vertical_spacing'   => array(
						'size' => 1,
						'unit' => 'em',
					),
					'primary_navigation_margin' => array(
						'size' => 5,
						'unit'   => 'em',	
					),				
					'primary_navigation_stretch' => false,
					'primary_navigation_fill_stretch' => false,
					'primary_navigation_style'   => 'standard',
					'primary_navigation_color'   => array(
						'color'  => 'palette3',
						'hover'  => 'palette-highlight-alt',
						'active' => 'palette-highlight-alt',
					),
					'primary_navigation_background'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					'primary_navigation_parent_active' => false,
					// Secondary Navigation.
					'secondary_navigation_typography'            => array(
						'size' => array(
							'desktop' => '15',
						),
						'lineHeight' => array(
							'desktop' => '1.2',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
					),
					'secondary_navigation_spacing'            => array(
						'size' => 2,
						'unit' => 'em',
					),
					'secondary_navigation_vertical_spacing'   => array(
						'size' => 0.6,
						'unit' => 'em',
					),
					'secondary_navigation_stretch' => false,
					'secondary_navigation_fill_stretch' => false,
					'secondary_navigation_style'   => 'fullheight',
					'secondary_navigation_color'   => array(
						'color'  => 'palette3',
						'hover'  => 'palette-highlight-alt',
						'active' => 'palette-highlight-alt',
					),
					'secondary_navigation_background'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					'secondary_navigation_parent_active' => false,
					// Dropdown.
					'dropdown_navigation_reveal' => 'fade-down',
					'dropdown_navigation_width'  => array(
						'size' => 250,
						'unit' => 'px',
					),
					'dropdown_navigation_vertical_spacing'   => array(
						'size' => 0.8,
						'unit' => 'em',
					),
					'dropdown_navigation_color'              => array(
						'color'  => 'palette3',
						'hover'  => 'palette-highlight-alt',
						'active' => 'palette-highlight-alt',
					),
					'dropdown_navigation_background'              => array(
						'color'  => 'palette9',
						'hover'  => 'palette9',
						'active' => 'palette9',
					),
					'dropdown_navigation_divider'              => array(
						'width' => 1,
						'unit'  => 'px',
						'style' => 'solid',
						'color' => 'rgba(0,0,0,0.1)',
					),
					'dropdown_navigation_shadow'              => array(
						'color'   => 'rgba(0,0,0,0.1)',
						'hOffset' => 0,
						'vOffset' => 2,
						'blur'    => 13,
						'spread'  => 0,
						'inset'   => false,
					),
					'dropdown_navigation_typography'            => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					// Mobile Trigger.
					'mobile_trigger_label'  => '',
					'mobile_trigger_icon'   => 'menu',
					'mobile_trigger_style'  => 'default',
					'mobile_trigger_border' => array(
						'width' => 1,
						'unit'  => 'px',
						'style' => 'solid',
						'color' => 'currentColor',
					),
					'mobile_trigger_icon_size'   => array(
						'size' => 1.6,
						'unit' => 'em',
					),
					'mobile_trigger_color'              => array(
						'color' => 'palette5',
						'hover' => 'palette-highlight-alt',
					),
					'mobile_trigger_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'mobile_trigger_typography'            => array(
						'size' => array(
							'desktop' => 14,
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'mobile_trigger_padding' => array(
						'size'   => array( 0.2, 0.2, 0.2, 0.2 ),
						'unit'   => 'em',
						'locked' => false,
					),
					// Mobile Navigation.
					'mobile_navigation_reveal' => 'none',
					'mobile_navigation_collapse' => true,
					'mobile_navigation_parent_toggle' => false,
					'mobile_navigation_width'  => array(
						'size' => 200,
						'unit' => 'px',
					),
					'mobile_navigation_vertical_spacing'   => array(
						'size' => 1,
						'unit' => 'em',
					),
					'mobile_navigation_color'              => array(
						'color'  => 'palette1',
						'hover'  => 'palette-highlight-alt',
						'active' => 'palette-highlight-alt',
					),
					'mobile_navigation_background'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					'mobile_navigation_divider'              => array(
						'width' => 1,
						'unit'  => 'px',
						'style' => 'solid',
						'color' => 'rgba(0,0,0,0.1)',
					),
					'mobile_navigation_typography'            => array(
						'size' => array(
							'desktop' => 14,
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					// Header Popup.
					'header_popup_side'           => 'right',
					'header_popup_layout'         => 'sidepanel',
					'header_popup_animation'      => 'fade',
					'header_popup_vertical_align' => 'top',
					'header_popup_content_align'  => 'left',
					'header_popup_background' => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'header_popup_close_color'  => array(
						'color' => '',
						'hover' => '',
					),
					'header_popup_close_background'  => array(
						'color' => '',
						'hover' => '',
					),
					'header_popup_close_icon_size'   => array(
						'size' => '24',
						'unit' => 'px',
					),
					'header_popup_close_padding' => array(
						'size'   => array( 0.6, 0.15, 0.6, 0.15 ),
						'unit'   => 'em',
						'locked' => false,
					),
					// Header HTML.
					'header_html_content'    => __( 'Insert HTML here', 'gadgeto' ),
					'header_html_typography' => array(
						'size' => array(
							'desktop' => '15',
						),
						'lineHeight' => array(
							'desktop' => '1.6',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '400',
						'variant' => '400',
						'color'   => 'palette4',
						'transform' => 'capitalize',
					),
					'header_html_link_style' => 'plain',
					'header_html_link_color'              => array(
						'color' => 'palette4',
						'hover' => 'palette-highlight-alt',
					),
					'header_html_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					'header_html_wpautop' => false,
					// Header Button.
					'header_button_label'      => __( 'Button', 'gadgeto' ),
					'header_button_link'      => '',
					'header_button_style'      => 'filled',
					'header_button_size'       => 'medium',
					'header_button_visibility' => 'all',
					'header_button_padding'   => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					'header_button_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'header_button_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_button_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_button_border_colors'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_button_border'              => array(
						'width' => 2,
						'unit'  => 'px',
						'style' => 'none',
					),
					'header_button_shadow' => array(
						'color'   => 'rgba(0,0,0,0)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => -7,
						'inset'   => false,
					),
					'header_button_shadow_hover' => array(
						'color'   => 'rgba(0,0,0,0.1)',
						'hOffset' => 0,
						'vOffset' => 15,
						'blur'    => 25,
						'spread'  => -7,
						'inset'   => false,
					),
					'header_button_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					'header_button_radius' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => true,
					),
					// Header Social.
					'header_social_items' => array(
						'items' => array(
							array(
								'id'      => 'facebook',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'facebook',
								'label'   => 'Facebook',
							),
							array(
								'id'      => 'twitter',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'twitter',
								'label'   => 'Twitter',
							),
							array(
								'id'      => 'instagram',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'instagram',
								'label'   => 'Instagram',
							),
						),
					),
					'header_social_style'        => 'filled',
					'header_social_show_label'   => false,
					'header_social_item_spacing' => array(
						'size' => 0.3,
						'unit' => 'em',
					),
					'header_social_icon_size' => array(
						'size' => 1,
						'unit' => 'em',
					),
					'header_social_brand' => '',
					'header_social_color' => array(
						'color' => '',
						'hover' => '',
					),
					'header_social_background' => array(
						'color' => '',
						'hover' => '',
					),
					'header_social_border_colors' => array(
						'color' => '',
						'hover' => '',
					),
					'header_social_border' => array(
						'width' => 2,
						'unit'  => 'px',
						'style' => 'none',
					),
					'header_social_border_radius' => array(
						'size' => 3,
						'unit' => 'px',
					),
					'header_social_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'header_social_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					// Mobile Header Social.
					'header_mobile_social_items' => array(
						'items' => array(
							array(
								'id'      => 'facebook',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'facebook',
								'label'   => 'Facebook',
							),
							array(
								'id'      => 'twitter',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'twitter',
								'label'   => 'Twitter',
							),
							array(
								'id'      => 'instagram',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'instagram',
								'label'   => 'Instagram',
							),
						),
					),
					'header_mobile_social_style'        => 'filled',
					'header_mobile_social_show_label'   => false,
					'header_mobile_social_item_spacing' => array(
						'size' => 0.3,
						'unit' => 'em',
					),
					'header_mobile_social_icon_size' => array(
						'size' => 1,
						'unit' => 'em',
					),
					'header_mobile_social_brand' => '',
					'header_mobile_social_color' => array(
						'color' => '',
						'hover' => '',
					),
					'header_mobile_social_background' => array(
						'color' => '',
						'hover' => '',
					),
					'header_mobile_social_border_colors' => array(
						'color' => '',
						'hover' => '',
					),
					'header_mobile_social_border' => array(
						'width' => 2,
						'unit'  => 'px',
						'style' => 'none',
					),
					'header_mobile_social_border_radius' => array(
						'size' => 3,
						'unit' => 'px',
					),
					'header_mobile_social_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'header_mobile_social_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					// Header Search.
					'header_search_label'           => 'search',
					'header_search_label_visiblity' => array(
						'desktop' => true,
						'tablet'  => false,
						'mobile'  => false,
					),
					'header_search_icon'   => 'search2',
					'header_search_style'  => 'default',
					'header_search_woo'    => false,
					'header_search_border' => array(
						'width' => 1,
						'unit'  => 'px',
						'style' => 'solid',
						'color' => 'currentColor',
					),
					'header_search_icon_size' => array(
						'size' => array(
							'mobile'  => '1.6',
							'tablet'  => '1.76',
							'desktop' => '1.32',
						),
						'unit' => array(
							'mobile'  => 'em',
							'tablet'  => 'em',
							'desktop' => 'em',
						),
					),
					'header_search_color'              => array(
						'color' => 'palette4',
						'hover' => 'palette-highlight-alt',
					),
					'header_search_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_search_typography'            => array(
						'size' => array(
							'desktop' => '14',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '400',
						'variant' => '400',
						'transform' => 'uppercase',
					),
					'header_search_padding' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'em',
						'locked' => false,
					),
					'header_search_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					'header_search_modal_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_search_modal_background'              => array(
						'desktop' => '',
					),
					'header_search_modal_background'                => array(
						'desktop' => array(
							'color' => 'rgba(9, 12, 16, 0.97)',
						),
					),
					// Mobile Header Button.
					'mobile_button_label'      => __( 'Button', 'gadgeto' ),
					'mobile_button_style'      => 'filled',
					'mobile_button_size'       => 'medium',
					'mobile_button_visibility' => 'all',
					'mobile_button_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'mobile_button_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'mobile_button_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'mobile_button_border_colors'              => array(
						'color' => '',
						'hover' => '',
					),
					'mobile_button_border'              => array(
						'width' => 2,
						'unit'  => 'px',
						'style' => 'none',
					),
					'mobile_button_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					'mobile_button_shadow' => array(
						'color'   => 'rgba(0,0,0,0)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => -7,
						'inset'   => false,
					),
					'mobile_button_shadow_hover' => array(
						'color'   => 'rgba(0,0,0,0.1)',
						'hOffset' => 0,
						'vOffset' => 15,
						'blur'    => 25,
						'spread'  => -7,
						'inset'   => false,
					),
					'mobile_button_radius' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => true,
					),
					// Mobile Header HTML.
					'mobile_html_content'    => __( 'Insert HTML here', 'gadgeto' ),
					'mobile_html_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'mobile_html_link_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'mobile_html_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					'mobile_html_link_style' => 'normal',
					'mobile_html_wpautop' => true,
					// Transparent Header.
					'transparent_header_enable' => false,
					'transparent_header_device' => array(
						'desktop' => true,
						'mobile'  => true,
					),
					'transparent_header_archive'    => true,
					'transparent_header_page'       => false,
					'transparent_header_post'       => false,
					'transparent_header_product'    => true,
					'transparent_header_logo_width' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'transparent_header_logo'               => '',
					'transparent_header_custom_logo'        => false,
					'transparent_header_mobile_logo'        => '',
					'transparent_header_custom_mobile_logo' => false,
					'transparent_header_site_title_color'   => array(
						'color' => '',
					),
					'transparent_header_navigation_color'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					'transparent_header_navigation_background'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					'transparent_header_button_color'              => array(
						'color'           => '',
						'hover'           => '',
						'background'      => '',
						'backgroundHover' => '',
						'border'          => '',
						'borderHover'     => '',
					),
					'transparent_header_social_color'              => array(
						'color'           => '',
						'hover'           => '',
						'background'      => '',
						'backgroundHover' => '',
						'border'          => '',
						'borderHover'     => '',
					),
					'transparent_header_html_color'              => array(
						'color' => '',
						'link'  => '',
						'hover' => '',
					),
					'transparent_header_background'                => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'transparent_header_bottom_border'   => array(),
					// Sticky Header.
					'header_sticky'             => 'no',
					'header_reveal_scroll_up'   => false,
					'header_sticky_shrink'      => false,
					'header_sticky_main_shrink' => array(
						'size' => 60,
						'unit' => 'px',
					),
					'mobile_header_sticky'             => 'no',
					'mobile_header_sticky_shrink'      => false,
					'mobile_header_reveal_scroll_up'   => false,
					'mobile_header_sticky_main_shrink' => array(
						'size' => 60,
						'unit' => 'px',
					),
					'header_sticky_logo'               => '',
					'header_sticky_custom_logo'        => false,
					'header_sticky_mobile_logo'        => '',
					'header_sticky_custom_mobile_logo' => false,
					'header_sticky_logo_width'         => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'header_sticky_site_title_color'              => array(
						'color' => '',
					),
					'header_sticky_navigation_color'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					'header_sticky_navigation_background'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					'header_sticky_button_color'              => array(
						'color'           => '',
						'hover'           => '',
						'background'      => '',
						'backgroundHover' => '',
						'border'          => '',
						'borderHover'     => '',
					),
					'header_sticky_social_color'              => array(
						'color'           => '',
						'hover'           => '',
						'background'      => '',
						'backgroundHover' => '',
						'border'          => '',
						'borderHover'     => '',
					),
					'header_sticky_html_color'              => array(
						'color' => '',
						'link'  => '',
						'hover' => '',
					),
					'header_sticky_background'                => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'header_sticky_bottom_border'   => array(),
					// Footer.
					'footer_items'       => array(
						'top' => array(
							'top_1' => array('footer-widget5'),
							'top_2' => array(),
							'top_3' => array(),
							'top_4' => array(),
							'top_5' => array(),
						),
						'middle' => array(
							'middle_1' => array('footer-widget1'),
							'middle_2' => array('footer-widget2'),
							'middle_3' => array('footer-widget3'),
							'middle_4' => array('footer-widget4','footer-social'),
							'middle_5' => array(),
						),
						'bottom' => array(
							'bottom_1' => array( 'footer-html' ),
							'bottom_2' => array('footer-navigation'),
							'bottom_3' => array('footer-widget6'),
							'bottom_4' => array(),
							'bottom_5' => array(),
						),
					),
					'footer_wrap_background' => array(
						'desktop' => array(
							'color' => '',
						),
					),
					// Footer Top.
					'footer_top_height' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '77',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_top_column_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '10',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_top_widget_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_top_top_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '30',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_top_bottom_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '30',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_top_contain'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'standard',
					),
					'footer_top_columns' => '1',
					'footer_top_collapse' => 'normal',
					'footer_top_layout'  => array(
						'mobile'  => 'row',
						'tablet'  => '',
						'desktop' => 'equal',
					),
					'footer_top_direction'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'row',
					),
					'footer_top_background' => array(
						'desktop' => array(
							'color' => 'palette2',
						),
					),
					'footer_top_top_border'    => array(),
					'footer_top_bottom_border' => array(),
					'footer_top_column_border' => array(),
					'footer_top_widget_title'  => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'footer_top_widget_content' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'footer_top_link_colors' => array(
						'color' => 'palette5',
						'hover' => 'palette-highlight-alt',
					),
					'footer_top_link_style' => 'plain',
					// Footer Middle.
					'footer_middle_height' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_middle_column_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '10',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_middle_widget_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_middle_top_spacing' => array(
						'size' => array(
							'mobile'  => '40',
							'tablet'  => '60',
							'desktop' => '80',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_middle_bottom_spacing' => array(
						'size' => array(
							'mobile'  => '40',
							'tablet'  => '60',
							'desktop' => '80',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_middle_contain'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'standard',
					),
					'footer_middle_collapse' => 'right-half',
					'footer_middle_columns' => '4',
					'footer_middle_layout'  => array(
						'mobile'  => 'row',
						'tablet'  => '',
						'desktop' => 'left-forty',
					),
					'footer_middle_direction'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'column',
					),
					'footer_middle_background' => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'footer_middle_top_border'    => array(
						'desktop' => array(
							'width' => 1,
							'unit'  => 'px',
							'style' => 'solid',
							'color'  => '#e5e5e5',
						),
					),
					'footer_middle_bottom_border' => array(),
					'footer_middle_column_border' => array(),
					'footer_middle_widget_title'  => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => 'palette1',
					),
					'footer_middle_widget_content' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => 'palette5',
					),
					'footer_middle_link_colors' => array(
						'color' => 'palette5',
						'hover' => 'palette-highlight-alt',
					),
					'footer_middle_link_style' => 'plain',
					// Footer Bottom.
					'footer_bottom_height' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_bottom_column_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '10',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_bottom_widget_spacing' => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '20',
							'desktop' => '30',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_bottom_top_spacing' => array(
						'size' => array(
							'mobile'  => '15',
							'tablet'  => '20',
							'desktop' => '30',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_bottom_bottom_spacing' => array(
						'size' => array(
							'mobile'  => '15',
							'tablet'  => '20',
							'desktop' => '30',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'footer_bottom_contain'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'standard',
					),
					'footer_bottom_columns' => '3',
					'footer_bottom_collapse' => 'equal',
					'footer_bottom_layout'  => array(
						'mobile'  => 'row',
						'tablet'  => '',
						'desktop' => 'center-wide',
					),
					'footer_bottom_direction'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'column',
					),
					'footer_bottom_background' => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'footer_bottom_top_border'    => array(
						'desktop' => array(
							'width' => 1,
							'unit'  => 'px',
							'style' => 'solid',
							'color'  => '#e5e5e5',
						),
					),
					'footer_bottom_bottom_border' => array(),
					'footer_bottom_column_border' => array(),
					'footer_bottom_widget_title'  => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'footer_bottom_widget_content' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'footer_bottom_link_colors' => array(
						'color' => 'palette5',
						'hover' => 'palette-highlight-alt',
					),
					'footer_bottom_link_style' => 'plain',
					// Footer Navigation.
					'footer_navigation_typography'            => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'footer_navigation_spacing'            => array(
						'size' => 2,
						'unit' => 'em',
					),
					'footer_navigation_vertical_spacing'   => array(
						'size' => 0.6,
						'unit' => 'em',
					),
					'footer_navigation_align' => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'center',
					),
					'footer_navigation_stretch' => false,
					'footer_navigation_style'   => 'standard',
					'footer_navigation_color'   => array(
						'color'  => 'palette5',
						'hover'  => 'palette-highlight-alt',
						'active' => 'palette-highlight-alt',
					),
					'footer_navigation_background'              => array(
						'color'  => '',
						'hover'  => '',
						'active' => '',
					),
					// Footer Social.
					'footer_social_items' => array(
						'items' => array(
							array(
								'id'      => 'facebook',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'facebookAlt2',
								'label'   => 'Facebook',
							),
							array(
								'id'      => 'twitter',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'twitter',
								'label'   => 'Twitter',
							),
							array(
								'id'      => 'instagram',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'instagramAlt',
								'label'   => 'Instagram',
							),
							array(
								'id'      => 'youtube',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'youtube',
								'label'   => 'youtube',
							),
							array(
								'id'      => 'pinterest',
								'enabled' => true,
								'source'  => 'icon',
								'url'     => '',
								'imageid' => '',
								'width'   => 24,
								'icon'    => 'pinterestAlt',
								'label'   => 'pinterest',
							),
						),
					),
					'footer_social_style'        => 'outline',
					'footer_social_show_label'   => false,
					'footer_social_item_spacing' => array(
						'size' => 1,
						'unit' => 'em',
					),
					'footer_social_icon_size' => array(
						'size' => 1.3,
						'unit' => 'em',
					),
					'footer_social_brand' => '',
					'footer_social_color' => array(
						'color' => '',
						'hover' => '',
					),
					'footer_social_background' => array(
						'color' => '',
						'hover' => '',
					),
					'footer_social_border_colors' => array(
						'color' => '',
						'hover' => '',
					),
					'footer_social_border' => array(
						'width' => 2,
						'unit'  => 'px',
						'style' => 'none',
					),
					'footer_social_border_radius' => array(
						'size' => '',
						'unit' => 'px',
					),
					'footer_social_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'footer_social_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					'footer_social_align'         => array(
						'mobile'  => '',
						'tablet'  => 'left',
						'desktop' => 'left',
					),
					'footer_social_vertical_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// Footer Widget 1.
					'footer_widget1_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'footer_widget1_vertical_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// Footer Widget 2.
					'footer_widget2_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'footer_widget2_vertical_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// Footer Widget 3.
					'footer_widget3_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'footer_widget3_vertical_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// Footer Widget 4.
					'footer_widget4_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'footer_widget4_vertical_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// Footer Widget 5.
					'footer_widget5_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'left',
					),
					'footer_widget5_vertical_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// Footer Widget 6.
					'footer_widget6_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'footer_widget6_vertical_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// Footer HTML.
					'footer_html_content'    => '{copyright} Copyright {site-title} {year}',
					'footer_html_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'footer_html_link_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'footer_html_align'  => array(
						'mobile'  => '',
						'tablet'  => 'left',
						'desktop' => 'left',
					),
					'footer_html_link_style'    => 'normal',
					'footer_html_margin' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => false,
					),
					// Comments.
					'comment_form_before_list'    => false,
					'comment_form_remove_website' => false,
					// 404.
					'404_layout'             => 'normal',
					'404_content_style'      => 'unboxed',
					'404_vertical_padding'   => 'show',
					'404_background'         => '',
					'404_content_background' => '',
					'404_sidebar_id'         => 'sidebar-primary',
					// Page Layout.
					'page_layout'             => 'normal',
					'page_content_style'      => 'unboxed',
					'page_vertical_padding'   => 'show',
					'page_comments'           => false,
					'page_feature'            => false,
					'page_feature_position'   => 'above',
					'page_feature_ratio'      => '2-3',
					'page_background'         => '',
					'page_content_background' => '',
					'page_sidebar_id'         => 'sidebar-primary',
					'page_title'              => true,
					'page_title_layout'       => 'above',
					'page_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'page_title_inner_layout' => 'standard',
					'page_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'page_title_featured_image' => false,
					'page_title_top_border'    => array(),
					'page_title_bottom_border' => array(),
					'page_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => 'center',
					),
					'page_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'page_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'page_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'page_title_meta_color' => array(
						'color' => '',
						'hover' => '',
					),
					'page_title_meta_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'page_title_elements'      => array( 'title', 'breadcrumb', 'meta' ),
					'page_title_element_title' => array(
						'enabled' => true,
					),
					'page_title_element_breadcrumb' => array(
						'enabled' => true,
						'show_title' => true,
					),
					'page_title_element_meta' => array(
						'id'                     => 'meta',
						'enabled'                => false,
						'divider'                => 'slash',
						'author'                 => true,
						'authorImage'            => true,
						'authorEnableLabel'      => true,
						'authorLabel'            => ' ',
						'date'                   => true,
						'dateEnableLabel'        => false,
						'dateLabel'              => '',
						'dateUpdated'            => false,
						'dateUpdatedEnableLabel' => false,
						'dateUpdatedLabel'       => '',
						'comments'               => true,
					),
					// Post Layout.
					'post_layout'             => 'narrow',
					'post_content_style'      => 'boxed',
					'post_vertical_padding'   => 'bottom',
					'post_sidebar_id'         => 'sidebar-primary',
					'post_comments'           => true,
					'post_comments_date'      => true,
					'post_footer_area_boxed'  => false,
					'post_navigation'         => true,
					'post_related'            => true,
					'post_related_style'      => 'wide',
					'post_related_carousel_loop' => true,
					'post_related_columns'    => '3',
					'post_related_title_font' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'post_related_background' => '',
					'post_tags'               => true,
					'post_author_box'         => false,
					'post_author_box_style'   => 'normal',
					'post_author_box_link'    => true,
					'post_feature'            => true,
					'post_feature_position'   => 'behind',
					'post_feature_ratio'      => '1-2',
					'post_feature_width'      => 'full',
					'post_background'         => '',
					'post_content_background' => '',
					'post_title'              => true,
					'post_title_layout'       => 'normal',
					'post_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'post_title_inner_layout' => 'standard',
					'post_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'post_title_featured_image' => false,
					'post_title_overlay_color'  => array(
						'color' => '',
					),
					'post_title_top_border'    => array(),
					'post_title_bottom_border' => array(),
					'post_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'post_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'post_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'post_title_meta_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_title_meta_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'post_title_category_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_title_category_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'post_title_excerpt_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_title_excerpt_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'post_title_elements'           => array( 'breadcrumb', 'meta', 'title', 'categories', 'excerpt' ),
					'post_title_element_categories' => array(
						'enabled' => false,
						'style'   => 'normal',
						'divider' => 'vline',
					),
					'post_title_element_title' => array(
						'enabled' => true,
					),
					'post_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => false,
					),
					'post_title_element_excerpt' => array(
						'enabled' => false,
					),
					'post_title_element_meta' => array(
						'id'                     => 'meta',
						'enabled'                => true,
						'divider'                => 'vline',
						'author'                 => true,
						'authorLink'             => true,
						'authorImage'            => false,
						'authorImageSize'        => 25,
						'authorEnableLabel'      => true,
						'authorLabel'            => ' ',
						'date'                   => true,
						'dateEnableLabel'        => false,
						'dateLabel'              => '',
						'dateUpdated'            => false,
						'dateUpdatedEnableLabel' => false,
						'dateUpdatedLabel'       => '',
						'categories'             => true,
						'categoriesEnableLabel'  => false,
						'categoriesLabel'        => '',
						'comments'               => true,
					),

					// enable_preload css style sheets.
					'enable_preload' => false,
					'breadcrumb_engine' => '',
					'breadcrumb_home_icon' => false,
					// Post Archive.
					'post_archive_title'              => true,
					'post_archive_home_title'         => false,
					'post_archive_title_layout'       => 'above',
					'post_archive_title_inner_layout' => 'standard',
					'post_archive_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'post_archive_title_elements'      => array( 'breadcrumb', 'title', 'description' ),
					'post_archive_title_element_title' => array(
						'enabled' => true,
					),
					'post_archive_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					'post_archive_title_element_description' => array(
						'enabled' => true,
					),
					'post_archive_title_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'post_archive_title_align'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'post_archive_title_overlay_color'              => array(
						'color' => '',
					),
					'post_archive_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_archive_title_color' => array(
						'color' => '',
					),
					'post_archive_description_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_archive_layout'               => 'normal',
					'post_archive_content_style'        => 'unboxed',
					'post_archive_columns'              => '1',
					'post_archive_item_image_placement' => 'beside',
					'post_archive_item_vertical_alignment' => 'top',
					'post_archive_sidebar_id'           => 'sidebar-primary',
					'post_archive_elements'             => array( 'feature', 'categories', 'meta' ,'title', 'excerpt', 'readmore' ),
					'post_archive_element_categories'   => array(
						'enabled' => false,
						'style'   => 'normal',
						'divider' => 'slash',
					),
					'post_archive_element_title' => array(
						'enabled' => true,
					),
					'post_archive_element_meta' => array(
						'id'                     => 'meta',
						'enabled'                => true,
						'divider'                => 'vline',
						'author'                 => true,
						'authorLink'             => false,
						'authorImage'            => false,
						'authorImageSize'        => 25,
						'authorEnableLabel'      => false,
						'authorLabel'            => '',
						'date'                   => true,
						'dateEnableLabel'        => false,
						'dateLabel'              => '',
						'dateUpdated'            => false,
						'dateUpdatedEnableLabel' => true,
						'dateUpdatedLabel'       => '',
						'categories'             => false,
						'categoriesEnableLabel'  => true,
						'categoriesLabel'        => '',
						'comments'               => false,
					),
					'post_archive_element_feature' => array(
						'enabled'   => true,
						'ratio'     => '2-3',
						'size'      => 'medium_large',
						'imageLink' => true,
					),
					'post_archive_element_excerpt' => array(
						'enabled'     => true,
						'words'       => 42,
						'fullContent' => false,
					),
					'post_archive_element_readmore' => array(
						'enabled' => true,
						'label'   => '',
					),
					'post_archive_item_title_font'   => array(
						'size' => array(
							'desktop' => '17',
						),
						'lineHeight' => array(
							'desktop' => '26',
						),
						'lineType' =>  'px',
						
						'family'  => '',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
					),
					'post_archive_item_category_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_archive_item_category_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'post_archive_item_meta_color' => array(
						'color' => '',
						'hover' => '',
					),
					'post_archive_item_meta_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'post_archive_background'         => '',
					'post_archive_content_background' => '',
					'post_archive_column_layout'      => 'grid',
					// Search Results.
					'search_archive_title'              => true,
					'search_archive_title_layout'       => 'normal',
					'search_archive_title_inner_layout' => 'standard',
					'search_archive_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'search_archive_title_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'search_archive_title_align'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'search_archive_title_overlay_color'              => array(
						'color' => '',
					),
					'search_archive_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'search_archive_title_color' => array(
						'color' => '',
					),
					'search_archive_description_color' => array(
						'color' => '',
						'hover' => '',
					),
					'search_archive_layout'               => 'left',
					'search_archive_content_style'        => 'unboxed',
					'search_archive_columns'              => '2',
					'search_archive_item_image_placement' => 'above',
					'search_archive_sidebar_id'           => 'sidebar-primary',
					'search_archive_elements'             => array( 'feature', 'categories', 'title', 'meta', 'excerpt', 'readmore' ),
					'search_archive_element_categories'   => array(
						'enabled' => true,
						'style'   => 'normal',
						'divider' => 'vline',
					),
					'search_archive_element_title' => array(
						'enabled' => true,
					),
					'search_archive_element_meta' => array(
						'id'                     => 'meta',
						'enabled'                => true,
						'divider'                => 'customicon',
						'author'                 => true,
						'authorLink'             => true,
						'authorImage'            => false,
						'authorImageSize'        => 25,
						'authorEnableLabel'      => true,
						'authorLabel'            => '',
						'date'                   => true,
						'dateEnableLabel'        => false,
						'dateLabel'              => '',
						'dateUpdated'            => false,
						'dateUpdatedEnableLabel' => false,
						'dateUpdatedLabel'       => '',
						'categories'             => false,
						'categoriesEnableLabel'  => false,
						'categoriesLabel'        => '',
						'comments'               => false,
					),
					'search_archive_element_feature' => array(
						'enabled' => true,
						'ratio'   => '2-3',
						'size'    => 'medium_large',
					),
					'search_archive_element_excerpt' => array(
						'enabled'     => true,
						'words'       => 18,
						'fullContent' => false,
					),
					'search_archive_element_readmore' => array(
						'enabled' => true,
						'label'   => '',
					),
					'search_archive_item_title_font'   => array(
						'size' => array(
							'desktop' => '20',
						),
						'lineHeight' => array(
							'desktop' => '1.5',
						),
						'family'  => '',
						'google'  => false,
						'weight'  => '400',
						'variant' => '400',
					),
					'search_archive_item_category_color' => array(
						'color' => '',
						'hover' => '',
					),
					'search_archive_item_category_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'search_archive_item_meta_color' => array(
						'color' => '',
						'hover' => '',
					),
					'search_archive_item_meta_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '',
						),
						'spacingType'=> 'px',
						'transform' => 'inherit',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'search_archive_background'         => '',
					'search_archive_content_background' => '',
					'search_archive_column_layout'      => 'grid',
					// Product Archive Controls.
					//'product_archive_hide_additional_image' => false,
					'product_archive_countdown'=> true,
					'product_archive_toggle' => true,
					'product_archive_show_order' => true,
					'product_archive_hide_sale_badge' => false,
					'product_archive_show_sale_percentage_badge' => false,
					'product_archive_show_results_count' => true,
					'product_archive_style'  => 'action-visible',
					'product_archive_image_hover_switch' => 'fade',
					'product_archive_button_style'       => 'button',
					'product_archive_button_align'       => false,
					'product_archive_title'              => true,
					'product_archive_title_layout'       => 'above',
					'product_archive_title_inner_layout' => '',
					'product_archive_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
					),
					'product_archive_title_elements'      => array( 'title', 'breadcrumb', 'description' ),
					'product_archive_title_element_title' => array(
						'enabled' => true,
					),
					'product_archive_title_element_breadcrumb' => array(
						'enabled' => true,
						'show_title' => true,
					),
					'product_archive_title_element_description' => array(
						'enabled' => true,
					),
					'product_archive_title_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'product_archive_title_align'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'product_archive_title_overlay_color'              => array(
						'color' => '',
					),
					'product_archive_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'product_archive_title_heading_font' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'product_archive_title_color' => array(
						'color' => '',
					),
					'product_archive_description_color' => array(
						'color' => '',
						'hover' => '',
					),
					'product_archive_layout'             => 'left',					
					'product_archive_content_style'      => 'unboxed',
					'product_archive_sidebar_id'         => 'sidebar-secondary',
					'product_archive_title_font'   => array(
						'size' => array(
							'desktop' => '15',
						),
						'lineHeight' => array(
							'desktop' => '1.5',
						),
						'lineType' =>  'em',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '0.3',
						),
						'spacingType'=> 'px',
						'transform' => 'inherit',
						'family'  => 'inherit' ,
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette6',
					),
					'product_archive_price_font'   => array(
						'size' => array(
							'desktop' => '15',
						),
						'lineHeight' => array(
							'desktop' => '1.5',
						),
						'lineType' =>  'em',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '0.3',
						),
						'spacingType'=> 'px',
						'transform' => 'inherit',
						'family'  => 'inherit',
						'google'  => true,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette3',
					),
					'product_archive_image_border'    => array(
						'width' => '',
						'unit' => 'px',
						'style'=> 'solid',
						'color'  => '#e5e5e5',
					),
					
					// Archive Product Button.
					'product_archive_button_typography' => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'product_archive_button_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'product_archive_button_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'product_archive_button_border_colors'              => array(
						'color' => '',
						'hover' => '',
					),
					'product_archive_button_border'              => array(
						'width' => 2,
						'unit'  => 'px',
						'style' => 'none',
					),
					'product_archive_button_shadow' => array(
						'color'   => 'rgba(0,0,0,0.0)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => 0,
						'inset'   => false,
					),
					'product_archive_button_shadow_hover' => array(
						'color'   => 'rgba(0,0,0,0)',
						'hOffset' => 0,
						'vOffset' => 0,
						'blur'    => 0,
						'spread'  => 0,
						'inset'   => false,
					),
					'product_archive_button_radius' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'px',
						'locked' => true,
					),
					// Product Controls.
					'custom_quantity'                => true,
					'product_archive_mobile_columns' => 'default',
					'product_layout'             => 'normal',
					'product_content_style'      => 'unboxed',
					'product_vertical_padding'   => 'show',
					'product_above_layout'       => 'title',
					'product_sidebar_id'         => 'sidebar-primary',
					'product_navigation'         => false,
					'product_related'            => true,
					'product_large_cart_button'  => false,
					'product_additional_weight_dimensions' => true,
					'product_related_style'      => 'standard',
					'product_related_columns'    => '7',
					'product_content_elements'           => array( 'category', 'title', 'rating', 'price', 'excerpt', 'add_to_cart' , 'extras' , 'product_meta' , 'payments', 'share' ),
					'product_content_element_category' => array(
						'enabled' => false,
					),
					'product_content_element_title' => array(
						'enabled' => true,
					),
					'product_content_element_rating' => array(
						'enabled' => true,
					),
					'product_content_element_price' => array(
						'enabled' => true,
						'show_shipping' => true,
						'shipping_statement' => __( '& Free Shipping', 'gadgeto' ),
					),
					'product_content_element_excerpt' => array(
						'enabled' => true,
					),
					'product_content_element_add_to_cart' => array(
						'enabled'     => true,
						'button_size' => '',
					),
					'product_content_element_extras' => array(
						'enabled'   => true,
						'title'     => __( 'Free shipping on orders over $50!', 'gadgeto' ),
						'feature_1' => __( 'Satisfaction Guaranteed', 'gadgeto' ),
						'feature_2' => __( 'No Hassle Refunds', 'gadgeto' ),
						'feature_3' => __( 'Secure Payments', 'gadgeto' ),
						'feature_4' => '',
						'feature_5' => '',
						'feature_1_icon' => 'shield_check',
						'feature_2_icon' => 'shield_check',
						'feature_3_icon' => 'shield_check',
						'feature_4_icon' => 'shield_check',
						'feature_5_icon' => 'shield_check',
					),
					'product_content_element_payments' => array(
						'enabled' => true,
						'title'     => __( 'GUARANTEED SAFE CHECKOUT', 'gadgeto' ),
						'visa' => true,
						'mastercard' => true,
						'amex' => true,
						'discover' => true,
						'paypal' => true,
						'applepay' => true,
						'stripe' => true,
						'card_color' => 'inherit',
						'custom_enable_01' => false,
						'custom_img_01' => '',
						'custom_id_01' => '',
						'custom_enable_02' => false,
						'custom_img_02' => '',
						'custom_id_02' => '',
						'custom_enable_03' => false,
						'custom_img_03' => '',
						'custom_id_03' => '',
						'custom_enable_04' => false,
						'custom_img_04' => '',
						'custom_id_04' => '',
						'custom_enable_05' => false,
						'custom_img_05' => '',
						'custom_id_05' => '',
					),
					'product_tab_style'   => 'normal',
					'variation_direction' => 'horizontal',
					'product_countdown'   => true,
					'product_tab_title'   => false,
					'product_content_element_product_meta' => array(
						'enabled' => true,
					),
					'product_content_element_share' => array(
						'enabled' => true,
					),
					'product_background'         => '',
					'product_content_background' => '',
					'product_title_elements'           => array( 'breadcrumb', 'category', 'above_title' ),
					'product_title_element_category' => array(
						'enabled' => false,
					),
					'product_title_element_above_title' => array(
						'enabled' => false,
					),
					'product_title_element_breadcrumb' => array(
						'enabled' => true,
						'show_title' => true,
					),
					'product_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'product_title_inner_layout' => 'fullwidth',
					'product_title_breadcrumb_font' =>  array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'lineType' =>  '',
						'letterSpacing' => array(
							'mobile' => '',
							'tablet' => '',
							'desktop' => '',
						),
						'spacingType'=> 'px',
						'transform' => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'product_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'product_title_overlay_color'              => array(
						'color' => '',
					),
					'product_title_top_border'    => array(),
					'product_title_bottom_border' => array(),
					'product_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'product_title_font'   => array(
						'size' => array(
							'mobile'  => '24',
							'tablet'  => '30',
							'desktop' => '28',
						),
						'lineHeight' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '1.5',
						),
						'lineType' =>  '',
						'letterSpacing' => array(
							'mobile'  => '0',
							'tablet'  => '0',
							'desktop' => '0',
						),
						'spacingType'=> 'px',
						'transform' => '',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'product_single_category_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'product_above_title_font'   => array(
						'size' => array(
							'desktop' => '32',
						),
						'lineHeight' => array(
							'desktop' => '1.5',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => '',
					),
					'product_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'product_above_category_font'   => array(
						'size' => array(
							'desktop' => '32',
						),
						'lineHeight' => array(
							'desktop' => '1.5',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
						'color'   => 'palette3',
					),
					// Store Notice:
					'woo_store_notice_placement'    => 'above',
					'woo_store_notice_hide_dismiss' => true,
					'woo_store_notice_font'   => array(
						'size' => array(
							'desktop' => '14',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '600',
						'variant' => '600',
						'color'   => '#0F1E2C',
					),
					'woo_store_notice_background'  => array(
						'color' => '',
					),
					// Woo Account
					'woo_account_navigation_layout' => 'left',
					'woo_account_navigation_avatar' => true,
					// Heroic Knowledge Base.
					'ht_kb_header_search'         => true,
					'ht_kb_archive_title_layout'  => 'above',
					'ht_kb_archive_layout'        => 'normal',
					'ht_kb_archive_content_style' => 'boxed',
					'ht_kb_title_elements'        => array( 'breadcrumb', 'title' ),
					'ht_kb_title_element_title'   => array(
						'enabled' => true,
					),
					'ht_kb_title_element_breadcrumb' => array(
						'enabled' => true,
						'show_title' => true,
					),
					// Header Cart.
					'header_cart_label' => 'my cart',
					'header_cart_show_total' => true,
					'header_cart_show_price' => true,
					'header_cart_style' => 'slide',
					'header_cart_popup_side' => 'right',
					'header_cart_icon' => 'shopping-cart',
					'header_cart_icon_size'   => array(
						'size' => '1.9',
						'unit' => 'em',
					),
					'header_cart_color'              => array(
						'color' => 'palette1',
						'hover' => 'palette-highlight-alt',
					),
					'header_cart_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_cart_total_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_cart_total_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_cart_typography'            => array(
						'size' => array(
							'desktop' => '15',
						),
						'lineHeight' => array(
							'desktop' => '22',
						),
						'lineType' =>  'px',
						'letterSpacing' => array(
							'desktop' => '0',
						),
						'spacingType'=> 'px',
						'transform' => 'capitalize',
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '500',
						'variant' => '500',
					),
					'header_cart_padding' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'em',
						'locked' => false,
					),
					// Mobile Header Cart.
					'header_mobile_cart_label' => '',
					'header_mobile_cart_show_total' => true,
					'header_mobile_cart_style' => 'slide',
					'header_mobile_cart_popup_side' => 'right',
					'header_mobile_cart_icon' => 'shopping-cart',
					'header_mobile_cart_icon_size'   => array(
						'size' => '1.5',
						'unit' => 'em',
					),
					'header_mobile_cart_color'              => array(
						'color' => 'palette5',
						'hover' => 'palette-highlight-alt',
					),
					'header_mobile_cart_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_mobile_cart_total_color'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_mobile_cart_total_background'              => array(
						'color' => '',
						'hover' => '',
					),
					'header_mobile_cart_typography'            => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'header_mobile_cart_padding' => array(
						'size'   => array( '', '', '', '' ),
						'unit'   => 'em',
						'locked' => false,
					),
					// LifterLMS Course
					'course_syllabus_thumbs'       => false,
					'course_syllabus_thumbs_ratio'         => '2-3',
					'course_syllabus_columns'      => '1',
					'course_syllabus_lesson_style' => 'standard',
					'course_layout'             => 'normal',
					'course_content_style'      => 'boxed',
					'course_vertical_padding'   => 'show',
					'course_sidebar_id'         => 'llms_course_widgets_side',
					'course_feature'            => false,
					'course_feature_position'   => 'behind',
					'course_feature_ratio'      => '2-3',
					'course_comments'            => false,
					'course_background'         => '',
					'course_content_background' => '',
					'course_title'              => true,
					'course_title_layout'       => 'normal',
					'course_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'course_title_inner_layout' => 'standard',
					'course_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'course_title_featured_image' => false,
					'course_title_overlay_color'  => array(
						'color' => '',
					),
					'course_title_top_border'    => array(),
					'course_title_bottom_border' => array(),
					'course_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'course_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'course_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'course_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'course_title_elements'           => array( 'breadcrumb', 'title' ),
					'course_title_element_title' => array(
						'enabled' => true,
					),
					'course_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// LifterLMS Lesson
					'lesson_layout'             => 'right',
					'lesson_content_style'      => 'boxed',
					'lesson_vertical_padding'   => 'show',
					'lesson_sidebar_id'         => 'llms_lesson_widgets_side',
					'lesson_feature'            => false,
					'lesson_comments'            => false,
					'lesson_feature_position'   => 'behind',
					'lesson_feature_ratio'      => '2-3',
					'lesson_background'         => '',
					'lesson_content_background' => '',
					'lesson_title'              => true,
					'lesson_title_layout'       => 'normal',
					'lesson_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'lesson_title_inner_layout' => 'standard',
					'lesson_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'lesson_title_featured_image' => false,
					'lesson_title_overlay_color'  => array(
						'color' => '',
					),
					'lesson_title_top_border'    => array(),
					'lesson_title_bottom_border' => array(),
					'lesson_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'lesson_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'lesson_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'lesson_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'lesson_title_elements'           => array( 'breadcrumb', 'title' ),
					'lesson_title_element_title' => array(
						'enabled' => true,
					),
					'lesson_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// LifterLMS Quiz
					'llms_quiz_layout'             => 'right',
					'llms_quiz_content_style'      => 'boxed',
					'llms_quiz_vertical_padding'   => 'show',
					'llms_quiz_sidebar_id'         => 'llms_lesson_widgets_side',
					'llms_quiz_title'              => true,
					'llms_quiz_title_layout'       => 'normal',
					'llms_quiz_title_inner_layout' => 'standard',
					'llms_quiz_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// LifterLMS Quiz
					'llms_membership_layout'             => 'normal',
					'llms_membership_content_style'      => 'boxed',
					'llms_membership_vertical_padding'   => 'show',
					'llms_membership_sidebar_id'         => 'sidebar-primary',
					'llms_membership_title'              => true,
					'llms_membership_title_layout'       => 'normal',
					'llms_membership_title_inner_layout' => 'standard',
					'llms_membership_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					// LifterLMS Archive
					'course_archive_columns'            => '3',
					'course_archive_title'              => true,
					'course_archive_title_layout'       => 'above',
					'course_archive_title_inner_layout' => 'standard',
					'course_archive_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'course_archive_title_elements'      => array( 'breadcrumb', 'title', 'description' ),
					'course_archive_title_element_title' => array(
						'enabled' => true,
					),
					'course_archive_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					'course_archive_title_element_description' => array(
						'enabled' => true,
					),
					'course_archive_title_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'course_archive_title_align'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'course_archive_title_overlay_color'              => array(
						'color' => '',
					),
					'course_archive_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'course_archive_title_color' => array(
						'color' => '',
					),
					'course_archive_description_color' => array(
						'color' => '',
						'hover' => '',
					),
					'course_archive_layout'             => 'normal',
					'course_archive_content_style'      => 'boxed',
					'course_archive_sidebar_id'         => 'sidebar-primary',
					// LifterLMS Member Archive
					'llms_membership_archive_columns'            => '3',
					'llms_membership_archive_title'              => true,
					'llms_membership_archive_title_layout'       => 'above',
					'llms_membership_archive_title_inner_layout' => 'standard',
					'llms_membership_archive_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'llms_membership_archive_title_elements'      => array( 'breadcrumb', 'title', 'description' ),
					'llms_membership_archive_title_element_title' => array(
						'enabled' => true,
					),
					'llms_membership_archive_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					'llms_membership_archive_title_element_description' => array(
						'enabled' => true,
					),
					'llms_membership_archive_title_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'llms_membership_archive_title_align'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'llms_membership_archive_title_overlay_color'              => array(
						'color' => '',
					),
					'llms_membership_archive_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'llms_membership_archive_title_color' => array(
						'color' => '',
					),
					'llms_membership_archive_description_color' => array(
						'color' => '',
						'hover' => '',
					),
					'llms_membership_archive_layout'             => 'normal',
					'llms_membership_archive_content_style'      => 'boxed',
					'llms_membership_archive_sidebar_id'         => 'sidebar-primary',
					// Dashboard Layout
					'llms_dashboard_navigation_layout'             => 'right',
					'llms_dashboard_archive_columns'              => '3',
					// Learn Dash Course Grid.
					'learndash_course_grid' => false,
					'learndash_course_grid_style' => 'boxed',
					'sfwd-grid_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					// Learn Dash Course Archive.
					'sfwd-courses_archive_columns'            => '3',
					'sfwd-courses_archive_title'              => true,
					'sfwd-courses_archive_title_layout'       => 'above',
					'sfwd-courses_archive_title_inner_layout' => 'standard',
					'sfwd-courses_archive_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'sfwd-courses_archive_title_elements'      => array( 'breadcrumb', 'title', 'description' ),
					'sfwd-courses_archive_title_element_title' => array(
						'enabled' => true,
					),
					'sfwd-courses_archive_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					'sfwd-courses_archive_title_element_description' => array(
						'enabled' => true,
					),
					'sfwd-courses_archive_title_background'    => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'sfwd-courses_archive_title_align'        => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'sfwd-courses_archive_title_overlay_color'              => array(
						'color' => '',
					),
					'sfwd-courses_archive_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'sfwd-courses_archive_title_color' => array(
						'color' => '',
					),
					'sfwd-courses_archive_description_color' => array(
						'color' => '',
						'hover' => '',
					),
					'sfwd-courses_archive_layout'             => 'normal',
					'sfwd-courses_archive_content_style'      => 'boxed',
					'sfwd-courses_archive_sidebar_id'         => 'sidebar-primary',
					// Learn Dash Course
					'sfwd-courses_layout'             => 'normal',
					'sfwd-courses_content_style'      => 'boxed',
					'sfwd-courses_comments'           => true,
					'sfwd-courses_vertical_padding'   => 'show',
					'sfwd-courses_sidebar_id'         => 'sidebar-primary',
					'sfwd-courses_feature'            => false,
					'sfwd-courses_feature_position'   => 'behind',
					'sfwd-courses_feature_ratio'      => '2-3',
					'sfwd-courses_background'         => '',
					'sfwd-courses_content_background' => '',
					'sfwd-courses_title'              => true,
					'sfwd-courses_title_layout'       => 'normal',
					'sfwd-courses_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'sfwd-courses_title_inner_layout' => 'standard',
					'sfwd-courses_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'sfwd-courses_title_featured_image' => false,
					'sfwd-courses_title_overlay_color'  => array(
						'color' => '',
					),
					'sfwd-courses_title_top_border'    => array(),
					'sfwd-courses_title_bottom_border' => array(),
					'sfwd-courses_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'sfwd-courses_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'sfwd-courses_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'sfwd-courses_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'sfwd-courses_title_elements'           => array( 'breadcrumb', 'title' ),
					'sfwd-courses_title_element_title' => array(
						'enabled' => true,
					),
					'sfwd-courses_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// Learndash Lessons.
					'sfwd-lessons_layout'             => 'normal',
					'sfwd-lessons_comments'           => true,
					'sfwd-lessons_content_style'      => 'boxed',
					'sfwd-lessons_vertical_padding'   => 'show',
					'sfwd-lessons_sidebar_id'         => 'sidebar-primary',
					'sfwd-lessons_feature'            => false,
					'sfwd-lessons_feature_position'   => 'behind',
					'sfwd-lessons_feature_ratio'      => '2-3',
					'sfwd-lessons_background'         => '',
					'sfwd-lessons_content_background' => '',
					'sfwd-lessons_title'              => true,
					'sfwd-lessons_title_layout'       => 'normal',
					'sfwd-lessons_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'sfwd-lessons_title_inner_layout' => 'standard',
					'sfwd-lessons_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'sfwd-lessons_title_featured_image' => false,
					'sfwd-lessons_title_overlay_color'  => array(
						'color' => '',
					),
					'sfwd-lessons_title_top_border'    => array(),
					'sfwd-lessons_title_bottom_border' => array(),
					'sfwd-lessons_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'sfwd-lessons_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'sfwd-lessons_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'sfwd-lessons_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'sfwd-lessons_title_elements'           => array( 'breadcrumb', 'title' ),
					'sfwd-lessons_title_element_title' => array(
						'enabled' => true,
					),
					'sfwd-lessons_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// Learndash Quiz.
					'sfwd-quiz_layout'             => 'normal',
					'sfwd-quiz_comments'           => true,
					'sfwd-quiz_content_style'      => 'boxed',
					'sfwd-quiz_vertical_padding'   => 'show',
					'sfwd-quiz_sidebar_id'         => 'sidebar-primary',
					'sfwd-quiz_feature'            => false,
					'sfwd-quiz_feature_position'   => 'behind',
					'sfwd-quiz_feature_ratio'      => '2-3',
					'sfwd-quiz_background'         => '',
					'sfwd-quiz_content_background' => '',
					'sfwd-quiz_title'              => true,
					'sfwd-quiz_title_layout'       => 'normal',
					'sfwd-quiz_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'sfwd-quiz_title_inner_layout' => 'standard',
					'sfwd-quiz_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'sfwd-quiz_title_featured_image' => false,
					'sfwd-quiz_title_overlay_color'  => array(
						'color' => '',
					),
					'sfwd-quiz_title_top_border'    => array(),
					'sfwd-quiz_title_bottom_border' => array(),
					'sfwd-quiz_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'sfwd-quiz_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'sfwd-quiz_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'sfwd-quiz_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'sfwd-quiz_title_elements'           => array( 'breadcrumb', 'title' ),
					'sfwd-quiz_title_element_title' => array(
						'enabled' => true,
					),
					'sfwd-quiz_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// Learndash Topics.
					'sfwd-topic_layout'             => 'normal',
					'sfwd-topic_content_style'      => 'boxed',
					'sfwd-topic_vertical_padding'   => 'show',
					'sfwd-topic_comments'           => true,
					'sfwd-topic_sidebar_id'         => 'sidebar-primary',
					'sfwd-topic_feature'            => false,
					'sfwd-topic_feature_position'   => 'behind',
					'sfwd-topic_feature_ratio'      => '2-3',
					'sfwd-topic_background'         => '',
					'sfwd-topic_content_background' => '',
					'sfwd-topic_title'              => true,
					'sfwd-topic_title_layout'       => 'normal',
					'sfwd-topic_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'sfwd-topic_title_inner_layout' => 'standard',
					'sfwd-topic_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'sfwd-topic_title_featured_image' => false,
					'sfwd-topic_title_overlay_color'  => array(
						'color' => '',
					),
					'sfwd-topic_title_top_border'    => array(),
					'sfwd-topic_title_bottom_border' => array(),
					'sfwd-topic_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'sfwd-topic_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'sfwd-topic_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'sfwd-topic_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'sfwd-topic_title_elements'           => array( 'breadcrumb', 'title' ),
					'sfwd-topic_title_element_title' => array(
						'enabled' => true,
					),
					'sfwd-topic_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// Learn Dash Groups
					'groups_layout'             => 'normal',
					'groups_content_style'      => 'boxed',
					'groups_vertical_padding'   => 'show',
					'groups_sidebar_id'         => 'sidebar-primary',
					'groups_feature'            => false,
					'groups_feature_position'   => 'behind',
					'groups_feature_ratio'      => '2-3',
					'groups_background'         => '',
					'groups_content_background' => '',
					'groups_title'              => true,
					'groups_title_layout'       => 'normal',
					'groups_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'groups_title_inner_layout' => 'standard',
					'groups_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'groups_title_featured_image' => false,
					'groups_title_overlay_color'  => array(
						'color' => '',
					),
					'groups_title_top_border'    => array(),
					'groups_title_bottom_border' => array(),
					'groups_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'groups_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'groups_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'groups_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'groups_title_elements'           => array( 'breadcrumb', 'title' ),
					'groups_title_element_title' => array(
						'enabled' => true,
					),
					'groups_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// Learn Dash essays
					'sfwd-essays_layout'             => 'normal',
					'sfwd-essays_content_style'      => 'boxed',
					'sfwd-essays_vertical_padding'   => 'show',
					'sfwd-essays_sidebar_id'         => 'sidebar-primary',
					'sfwd-essays_comments'           => true,
					'sfwd-essays_feature'            => false,
					'sfwd-essays_feature_position'   => 'behind',
					'sfwd-essays_feature_ratio'      => '2-3',
					'sfwd-essays_background'         => '',
					'sfwd-essays_content_background' => '',
					'sfwd-essays_title'              => true,
					'sfwd-essays_title_layout'       => 'normal',
					'sfwd-essays_title_height'       => array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					),
					'sfwd-essays_title_inner_layout' => 'standard',
					'sfwd-essays_title_background'   => array(
						'desktop' => array(
							'color' => '',
						),
					),
					'sfwd-essays_title_featured_image' => false,
					'sfwd-essays_title_overlay_color'  => array(
						'color' => '',
					),
					'sfwd-essays_title_top_border'    => array(),
					'sfwd-essays_title_bottom_border' => array(),
					'sfwd-essays_title_align'         => array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					),
					'sfwd-essays_title_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					),
					'sfwd-essays_title_breadcrumb_color' => array(
						'color' => '',
						'hover' => '',
					),
					'sfwd-essays_title_breadcrumb_font'   => array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					),
					'sfwd-essays_title_elements'           => array( 'breadcrumb', 'title' ),
					'sfwd-essays_title_element_title' => array(
						'enabled' => true,
					),
					'sfwd-essays_title_element_breadcrumb' => array(
						'enabled' => false,
						'show_title' => true,
					),
					// MISC
					'ie11_basic_support' => false,
				)
			);
		}
		return self::$default_options;
	}
	/**
	 * Get options from database
	 */
	public function get_options() {
		if ( is_null( self::$options ) ) {
			$options       = get_option( $this->get_option_name() );
			self::$options = wp_parse_args( $options, self::defaults() );
		}
		return self::$options;
	}
	/**
	 * Get options from database
	 */
	public function get_custom_options( $key ) {
		if ( is_customize_preview() ) {
			$options       = get_option( $key );
			return wp_parse_args( $options, self::defaults() );
		}
		if ( ! isset( self::$custom_options[ $key ] ) ) {
			$options = get_option( $key );
			self::$custom_options[ $key ] = wp_parse_args( $options, self::defaults() );
		}
		return self::$custom_options[ $key ];
	}

	/**
	 * Add Custom Post type Defaults later in WordPress Load.
	 */
	public function add_default_options() {
		if ( is_null( self::$cpt_options ) ) {
			$add_options = array();
			$all_post_types    = thebase()->get_post_types_objects();
			$extras_post_types = array();
			$add_extras        = false;
			foreach ( $all_post_types as $post_type_item ) {
				$post_type_name  = $post_type_item->name;
				$post_type_label = $post_type_item->label;
				$ignore_type     = thebase()->get_post_types_to_ignore();
				if ( ! in_array( $post_type_name, $ignore_type, true ) ) {
					// Single Items.
					$add_options[ $post_type_name . '_feature' ] = false;
					$add_options[ $post_type_name . '_feature_position' ] = 'behind';
					$add_options[ $post_type_name . '_feature_ratio' ] = '2-3';
					$add_options[ $post_type_name . '_background' ] = '';
					$add_options[ $post_type_name . '_content_background' ] = '';
					$add_options[ $post_type_name . '_title' ] = true;
					$add_options[ $post_type_name . '_title_layout' ] = 'normal';
					$add_options[ $post_type_name . '_title_height' ] = array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					);
					$add_options[ $post_type_name . '_title_inner_layout' ] = 'standard';
					$add_options[ $post_type_name . '_title_background' ] = array(
						'desktop' => array(
							'color' => '',
						),
					);
					$add_options[ $post_type_name . '_title_featured_image' ] = false;
					$add_options[ $post_type_name . '_title_overlay_color' ] = array(
						'color' => '',
					);
					$add_options[ $post_type_name . '_title_top_border' ] = array();
					$add_options[ $post_type_name . '_title_bottom_border' ] = array();
					$add_options[ $post_type_name . '_title_align' ] = array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					);
					$add_options[ $post_type_name . '_title_font' ] = array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
						'color'   => '',
					);
					$add_options[ $post_type_name . '_title_breadcrumb_color' ] = array(
						'color' => '',
						'hover' => '',
					);
					$add_options[ $post_type_name . '_title_breadcrumb_font' ] = array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					);
					$add_options[ $post_type_name . '_title_meta_color' ] = array(
						'color' => '',
						'hover' => '',
					);
					$add_options[ $post_type_name . '_title_meta_font' ] = array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					);
					$add_options[ $post_type_name . '_title_elements' ] = array( 'categories', 'title', 'breadcrumb', 'meta' );
					$add_options[ $post_type_name . '_title_element_categories' ] = array(
						'enabled'    => false,
						'style'      => 'normal',
						'divider'    => 'vline',
						'taxonomies' => '',
					);
					$add_options[ $post_type_name . '_title_element_title' ] = array(
						'enabled' => true,
					);
					$add_options[ $post_type_name . '_title_element_breadcrumb' ] = array(
						'enabled'    => false,
						'show_title' => true,
					);
					$add_options[ $post_type_name . '_title_element_meta' ] = array(
						'id'                     => 'meta',
						'enabled'                => false,
						'divider'                => 'vline',
						'author'                 => true,
						'authorImage'            => false,
						'authorEnableLabel'      => true,
						'authorLabel'            => ' ',
						'date'                   => true,
						'dateEnableLabel'        => false,
						'dateLabel'              => '',
						'dateUpdated'            => false,
						'dateUpdatedEnableLabel' => false,
						'dateUpdatedLabel'       => '',
						'comments'               => false,
					);
					$add_options[ $post_type_name . '_archive_title_height' ] = array(
						'size' => array(
							'mobile'  => '',
							'tablet'  => '',
							'desktop' => '',
						),
						'unit' => array(
							'mobile'  => 'px',
							'tablet'  => 'px',
							'desktop' => 'px',
						),
					);
					$add_options[ $post_type_name . '_archive_title_elements' ] = array( 'breadcrumb', 'title', 'description' );
					$add_options[ $post_type_name . '_archive_title_element_title' ] = array(
						'enabled' => true,
					);
					$add_options[ $post_type_name . '_archive_title_element_breadcrumb' ] = array(
						'enabled' => false,
						'show_title' => true,
					);
					$add_options[ $post_type_name . '_archive_title_element_description' ] = array(
						'enabled' => true,
					);
					$add_options[ $post_type_name . '_archive_title_background' ] = array(
						'desktop' => array(
							'color' => '',
						),
					);
					$add_options[ $post_type_name . '_archive_title_align' ] = array(
						'mobile'  => '',
						'tablet'  => '',
						'desktop' => '',
					);
					$add_options[ $post_type_name . '_archive_title_overlay_color' ] = array(
						'color' => '',
					);
					$add_options[ $post_type_name . '_archive_title_breadcrumb_color' ] = array(
						'color' => '',
						'hover' => '',
					);
					$add_options[ $post_type_name . '_archive_title_color' ] = array(
						'color' => '',
					);
					$add_options[ $post_type_name . '_archive_description_color' ] = array(
						'color' => '',
						'hover' => '',
					);
					$add_options[ $post_type_name . '_archive_layout' ] = 'normal';
					$add_options[ $post_type_name . '_archive_content_style' ] = 'boxed';
					$add_options[ $post_type_name . '_archive_columns' ] = '3';
					$add_options[ $post_type_name . '_archive_item_image_placement' ] = 'above';
					$add_options[ $post_type_name . '_archive_sidebar_id' ] = 'sidebar-primary';
					$add_options[ $post_type_name . '_archive_elements' ] = array( 'feature', 'categories', 'title', 'meta', 'excerpt', 'readmore' );
					$add_options[ $post_type_name . '_archive_element_categories' ] = array(
						'enabled' => false,
						'style'   => 'normal',
						'divider' => 'vline',
						'taxonomy' => '',
					);
					$add_options[ $post_type_name . '_archive_element_title' ] = array(
						'enabled' => true,
					);
					$add_options[ $post_type_name . '_archive_element_meta' ] = array(
						'id'                     => 'meta',
						'enabled'                => false,
						'divider'                => 'vline',
						'author'                 => true,
						'authorLink'             => true,
						'authorImage'            => false,
						'authorImageSize'        => 25,
						'authorEnableLabel'      => true,
						'authorLabel'            => ' ',
						'date'                   => true,
						'dateEnableLabel'        => false,
						'dateLabel'              => '',
						'dateUpdated'            => false,
						'dateUpdatedEnableLabel' => false,
						'dateUpdatedLabel'       => '',
						'categories'             => false,
						'categoriesEnableLabel'  => false,
						'categoriesLabel'        => '',
						'comments'               => false,
					);
					$add_options[ $post_type_name . '_archive_element_feature' ] = array(
						'enabled' => true,
						'ratio'   => '2-3',
						'size'    => 'medium_large',
					);
					$add_options[ $post_type_name . '_archive_element_excerpt' ] = array(
						'enabled'     => true,
						'words'       => 55,
						'fullContent' => false,
					);
					$add_options[ $post_type_name . '_archive_element_readmore' ] = array(
						'enabled' => true,
						'label' => '',
					);
					$add_options[ $post_type_name . '_archive_item_title_font' ] = array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => '',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					);
					$add_options[ $post_type_name . '_archive_item_meta_color' ] = array(
						'color' => '',
						'hover' => '',
					);
					$add_options[ $post_type_name . '_archive_item_meta_font' ] = array(
						'size' => array(
							'desktop' => '',
						),
						'lineHeight' => array(
							'desktop' => '',
						),
						'family'  => 'inherit',
						'google'  => false,
						'weight'  => '',
						'variant' => '',
					);
					$add_options[ $post_type_name . '_archive_background' ] = '';
					$add_options[ $post_type_name . '_archive_content_background' ] = '';
				}
			}
			self::$cpt_options = $add_options;
			self::$options = wp_parse_args( self::get_options(), self::$cpt_options );
			self::$default_options = wp_parse_args( self::defaults(), self::$cpt_options );
		}
	}

	/**
	 * Get Default for option.
	 *
	 * @param string $key option key.
	 */
	public function default( $key, $backup = null ) {

		$defaults = self::defaults();
		$value    = ( isset( $defaults[ $key ] ) && '' !== $defaults[ $key ] ) ? $defaults[ $key ] : null;
		if ( is_null( $value ) ) {
			$value = $backup;
		}

		return $value;
	}

	/**
	 * Get Option
	 *
	 * @param string $key option key.
	 * @param mix    $default option default.
	 */
	public function option( $key, $default = '' ) {
		$defaults = self::defaults();
		if ( ! empty( $opt_name_key = apply_filters( 'thebase_settings_key_custom_mapping', '', $key ) ) ) {
			$options = self::get_custom_options( $opt_name_key );
			$value   = ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) ? $options[ $key ] : null;
		} else {
			if ( 'option' === $this->get_option_type() ) {
				$options = self::get_options();
				$value   = ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) ? $options[ $key ] : null;
			} else {
				$value = get_theme_mod( $key, null );
			}
		}
		// Fallback to defaults array.
		if ( is_null( $value ) || ( isset( $value ) && '' === $value ) ) {
			$value = ( isset( $defaults[ $key ] ) && '' !== $defaults[ $key ] ) ? $defaults[ $key ] : null;
		}
		// Fallback to default.
		if ( is_null( $value ) || ( isset( $value ) && '' === $value ) ) {
			$value = $default;
		}

		return $value;
	}

	/**
	 * Get setting of option array.
	 *
	 * @param string $key option key.
	 * @param string $first_key option array first key.
	 * @param string $second_key option array second key.
	 * @param string $third_key option array third key.
	 */
	public function sub_option( $key, $first_key = '', $second_key = '', $third_key = '' ) {
		$value = $this->option( $key );
		if ( ! empty( $first_key ) ) {
			if ( isset( $value[ $first_key ] ) && ! empty( $value[ $first_key ] ) ) {
				$value = $value[ $first_key ];
			} else {
				$value = null;
			}
			if ( ! empty( $second_key ) ) {
				if ( isset( $value[ $second_key ] ) && ! empty( $value[ $second_key ] ) ) {
					$value = $value[ $second_key ];
				} else {
					$value = null;
				}
				if ( ! empty( $third_key ) ) {
					if ( isset( $value[ $third_key ] ) && ! empty( $value[ $third_key ] ) ) {
						$value = $value[ $third_key ];
					} else {
						$value = null;
					}
				}
			}
		}

		return $value;
	}
	/**
	 * Get Palette
	 */
	public function get_palette_for_customizer() {
		$palette = get_option( 'thebase_global_palette' );
		if ( $palette && ! empty( $palette ) ) {
			$palette = json_decode( $palette, true );
			if ( isset( $palette['palette'] ) && is_array( $palette['palette'] ) ) {
				if ( isset( $palette['active'] ) && ! empty( $palette['active'] ) ) {
					$palette = json_encode( $palette );
				} else {
					$palette = self::palette_defaults();
				}
			} else {
				$palette = self::palette_defaults();
			}
		} else {
			$palette = self::palette_defaults();
		}
		return $palette;
	}
	/**
	 * Get Palette
	 */
	public function get_palette() {
		$palette = get_option( 'thebase_global_palette' );
		if ( ! $palette || empty( $palette ) ) {
			$palette = self::palette_defaults();
		}
		return $palette;
	}
	/**
	 * Get Palette
	 */
	public function get_default_palette() {
		return self::palette_defaults();
	}
	/**
	 * Set default theme option values
	 *
	 * @return default values of the theme.
	 */
	public static function palette_defaults() {
		// Don't store defaults until after init.
		if ( is_null( self::$default_palette ) ) {
			self::$default_palette = apply_filters( 'thebase_global_palette_defaults', '{"palette":[{"color":"#021523","slug":"palette1","name":"Palette Color 1"},{"color":"#fed700","slug":"palette2","name":"Palette Color 2"},{"color":"#021523","slug":"palette3","name":"Palette Color 3"},{"color":"#666666","slug":"palette4","name":"Palette Color 4"},{"color":"#021523","slug":"palette5","name":"Palette Color 5"},{"color":"#f7f7f7","slug":"palette6","name":"Palette Color 6"},{"color":"#F5F5F5","slug":"palette7","name":"Palette Color 7"},{"color":"#FFFFFF","slug":"palette8","name":"Palette Color 8"},{"color":"#ffffff","slug":"palette9","name":"Palette Color 9"}],"second-palette":[{"color":"#2B6CB0","slug":"palette1","name":"Palette Color 1"},{"color":"#215387","slug":"palette2","name":"Palette Color 2"},{"color":"#1A202C","slug":"palette3","name":"Palette Color 3"},{"color":"#2D3748","slug":"palette4","name":"Palette Color 4"},{"color":"#4A5568","slug":"palette5","name":"Palette Color 5"},{"color":"#718096","slug":"palette6","name":"Palette Color 6"},{"color":"#EDF2F7","slug":"palette7","name":"Palette Color 7"},{"color":"#FFFFFF","slug":"palette8","name":"Palette Color 8"},{"color":"#ffffff","slug":"palette9","name":"Palette Color 9"}],"third-palette":[{"color":"#2B6CB0","slug":"palette1","name":"Palette Color 1"},{"color":"#215387","slug":"palette2","name":"Palette Color 2"},{"color":"#1A202C","slug":"palette3","name":"Palette Color 3"},{"color":"#2D3748","slug":"palette4","name":"Palette Color 4"},{"color":"#4A5568","slug":"palette5","name":"Palette Color 5"},{"color":"#0d52ad","slug":"palette6","name":"Palette Color 6"},{"color":"#EDF2F7","slug":"palette7","name":"Palette Color 7"},{"color":"#F7FAFC","slug":"palette8","name":"Palette Color 8"},{"color":"#ffffff","slug":"palette9","name":"Palette Color 9"}],"active":"palette"}' );
		}
		return self::$default_palette;
	}
	/**
	 * Get Palette Option.
	 *
	 * @param string $subkey option subkey.
	 * @param string $active_palette the active palette.
	 */
	public function palette_option( $subkey, $active_palette = null ) {
		if ( is_null( self::$palette ) ) {
			$palette = get_option( 'thebase_global_palette' );
			if ( $palette && ! empty( $palette ) ) {
				self::$palette = json_decode( $palette, true );
			} else {
				self::$palette = json_decode( self::palette_defaults(), true );
			}
		}
		$active = ! empty( $active_palette ) ? $active_palette : apply_filters( 'thebase_active_palette', ( self::$palette && is_array( self::$palette ) && isset( self::$palette['active'] ) && ! empty( self::$palette['active'] ) ? self::$palette['active'] : 'palette' ) );
		$value = '';
		if ( self::$palette && is_array( self::$palette ) && isset( self::$palette[ $active ] ) && is_array( self::$palette[ $active ] ) ) {
			$palette_number = (int) substr( $subkey, -1 ) - 1;
			$palette_item   = ( isset( self::$palette[ $active ][ $palette_number ] ) && is_array( self::$palette[ $active ][ $palette_number ] ) ? self::$palette[ $active ][ $palette_number ] : array() );
			if ( isset( $palette_item['slug'] ) && $palette_item['slug'] === $subkey ) {
				$value = ( isset( $palette_item['color'] ) && ! empty( $palette_item['color'] ) ? $palette_item['color'] : '' );
			}
		}

		return apply_filters( 'thebase_palette_option', $value, $subkey );
	}

	/**
	 * Get Customizer Sidebar Options
	 *
	 * @access public
	 * @return array
	 */
	public function sidebar_options() {
		// Don't store defaults until after init.
		if ( is_null( self::$sidebars ) ) {
			$sidebars = array();
			$nonsidebars = array(
				'header1',
				'header2',
				'footer1',
				'footer2',
				'footer3',
				'footer4',
				'footer5',
				'footer6',
			);
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				if ( ! in_array( $sidebar['id'], $nonsidebars, true ) ) {
					$sidebars[ $sidebar['id'] ] = array( 'name' => $sidebar['name'] );
				}
			}
			self::$sidebars = $sidebars;
		}
		return self::$sidebars;
	}
}
