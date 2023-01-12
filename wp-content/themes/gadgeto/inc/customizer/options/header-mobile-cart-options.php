<?php
/**
 * Header Builder Options
 *
 * @package thebase
 */

namespace TheBase;

use TheBase\Theme_Customizer;
use function TheBase\thebase;

$settings = array(
	'header_mobile_cart_tabs' => array(
		'control_type' => 'thebase_tab_control',
		'section'      => 'mobile_cart',
		'settings'     => false,
		'priority'     => 1,
		'input_attrs'  => array(
			'general' => array(
				'label'  => __( 'General', 'gadgeto' ),
				'target' => 'mobile_cart',
			),
			'design' => array(
				'label'  => __( 'Design', 'gadgeto' ),
				'target' => 'mobile_cart_design',
			),
			'active' => 'general',
		),
	),
	'header_mobile_cart_tabs_design' => array(
		'control_type' => 'thebase_tab_control',
		'section'      => 'mobile_cart_design',
		'settings'     => false,
		'priority'     => 1,
		'input_attrs'  => array(
			'general' => array(
				'label'  => __( 'General', 'gadgeto' ),
				'target' => 'mobile_cart',
			),
			'design' => array(
				'label'  => __( 'Design', 'gadgeto' ),
				'target' => 'mobile_cart_design',
			),
			'active' => 'design',
		),
	),
	'header_mobile_cart_label' => array(
		'control_type' => 'thebase_text_control',
		'section'      => 'mobile_cart',
		'sanitize'     => 'sanitize_text_field',
		'priority'     => 6,
		'default'      => thebase()->default( 'header_mobile_cart_label' ),
		'label'        => esc_html__( 'Cart Label', 'gadgeto' ),
		'live_method'     => array(
			array(
				'type'     => 'html',
				'selector' => '.header-mobile-cart-wrap .header-cart-label',
				'pattern'  => '$',
				'key'      => '',
			),
		),
	),
	'header_mobile_cart_icon' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'mobile_cart',
		'priority'     => 10,
		'default'      => thebase()->default( 'header_mobile_cart_icon' ),
		'label'        => esc_html__( 'Cart Icon', 'gadgeto' ),
		'partial'      => array(
			'selector'            => '.header-mobile-cart-wrap',
			'container_inclusive' => true,
			'render_callback'     => 'TheBase\mobile_cart',
		),
		'input_attrs'  => array(
			'layout' => array(
				'shopping-bag' => array(
					'icon' => 'shoppingBag',
				),
				'shopping-cart' => array(
					'icon' => 'shoppingCart',
				),
			),
			'responsive' => false,
		),
	),
	'header_mobile_cart_style' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'mobile_cart',
		'priority'     => 10,
		'default'      => thebase()->default( 'header_mobile_cart_style' ),
		'label'        => esc_html__( 'Cart Click Action', 'gadgeto' ),
		'transport'    => 'refresh',
		'input_attrs'  => array(
			'layout' => array(
				'link' => array(
					'name' => __( 'Link', 'gadgeto' ),
				),
				'slide' => array(
					'name' => __( 'Popout Cart', 'gadgeto' ),
				),
			),
			'responsive' => false,
		),
	),
	'header_mobile_cart_show_total' => array(
		'control_type' => 'thebase_switch_control',
		'sanitize'     => 'thebase_sanitize_toggle',
		'section'      => 'mobile_cart',
		'priority'     => 6,
		'partial'      => array(
			'selector'            => '.header-mobile-cart-wrap',
			'container_inclusive' => true,
			'render_callback'     => 'TheBase\mobile_cart',
		),
		'default'      => thebase()->default( 'header_mobile_cart_show_total' ),
		'label'        => esc_html__( 'Show Item Total Indicator', 'gadgeto' ),
	),
	'header_mobile_cart_icon_size' => array(
		'control_type' => 'thebase_range_control',
		'section'      => 'mobile_cart_design',
		'label'        => esc_html__( 'Icon Size', 'gadgeto' ),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-button .thebase-svg-iconset',
				'property' => 'font-size',
				'pattern'  => '$',
				'key'      => 'size',
			),
		),
		'default'      => thebase()->default( 'header_mobile_cart_icon_size' ),
		'input_attrs'  => array(
			'min'        => array(
				'px'  => 0,
				'em'  => 0,
				'rem' => 0,
			),
			'max'        => array(
				'px'  => 100,
				'em'  => 12,
				'rem' => 12,
			),
			'step'       => array(
				'px'  => 1,
				'em'  => 0.01,
				'rem' => 0.01,
			),
			'units'      => array( 'px', 'em', 'rem' ),
			'responsive' => false,
		),
	),
	'header_mobile_cart_color' => array(
		'control_type' => 'thebase_color_control',
		'section'      => 'mobile_cart_design',
		'label'        => esc_html__( 'Cart Colors', 'gadgeto' ),
		'default'      => thebase()->default( 'header_mobile_cart_color' ),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-inner-wrap .header-cart-button',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'color',
			),
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-inner-wrap .header-cart-button:hover',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'hover',
			),
		),
		'input_attrs'  => array(
			'colors' => array(
				'color' => array(
					'tooltip' => __( 'Initial Color', 'gadgeto' ),
					'palette' => true,
				),
				'hover' => array(
					'tooltip' => __( 'Hover Color', 'gadgeto' ),
					'palette' => true,
				),
			),
		),
	),
	'header_mobile_cart_background' => array(
		'control_type' => 'thebase_color_control',
		'section'      => 'mobile_cart_design',
		'label'        => esc_html__( 'Cart Background', 'gadgeto' ),
		'default'      => thebase()->default( 'header_mobile_cart_background' ),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-inner-wrap .header-cart-button',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'color',
			),
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-inner-wrap .header-cart-button:hover',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'hover',
			),
		),
		'input_attrs'  => array(
			'colors' => array(
				'color' => array(
					'tooltip' => __( 'Initial Background', 'gadgeto' ),
					'palette' => true,
				),
				'hover' => array(
					'tooltip' => __( 'Hover Background', 'gadgeto' ),
					'palette' => true,
				),
			),
		),
	),
	'header_mobile_cart_total_color' => array(
		'control_type' => 'thebase_color_control',
		'section'      => 'mobile_cart_design',
		'label'        => esc_html__( 'Cart Total Colors', 'gadgeto' ),
		'default'      => thebase()->default( 'header_mobile_cart_total_color' ),
		'context'      => array(
			array(
				'setting'  => 'header_mobile_cart_show_total',
				'operator' => '=',
				'value'    => true,
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-button .header-cart-total',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'color',
			),
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-button:hover .header-cart-total',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'hover',
			),
		),
		'input_attrs'  => array(
			'colors' => array(
				'color' => array(
					'tooltip' => __( 'Initial Color', 'gadgeto' ),
					'palette' => true,
				),
				'hover' => array(
					'tooltip' => __( 'Hover Color', 'gadgeto' ),
					'palette' => true,
				),
			),
		),
	),
	'header_mobile_cart_total_background' => array(
		'control_type' => 'thebase_color_control',
		'section'      => 'mobile_cart_design',
		'label'        => esc_html__( 'Cart Total Background', 'gadgeto' ),
		'default'      => thebase()->default( 'header_mobile_cart_total_background' ),
		'context'      => array(
			array(
				'setting'  => 'header_mobile_cart_show_total',
				'operator' => '=',
				'value'    => true,
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-button .header-cart-total',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'color',
			),
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-button:hover .header-cart-total',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'hover',
			),
		),
		'input_attrs'  => array(
			'colors' => array(
				'color' => array(
					'tooltip' => __( 'Initial Background', 'gadgeto' ),
					'palette' => true,
				),
				'hover' => array(
					'tooltip' => __( 'Hover Background', 'gadgeto' ),
					'palette' => true,
				),
			),
		),
	),
	'header_mobile_cart_typography' => array(
		'control_type' => 'thebase_typography_control',
		'section'      => 'mobile_cart_design',
		'label'        => esc_html__( 'Cart Label Font', 'gadgeto' ),
		'context'      => array(
			array(
				'setting'  => 'header_mobile_cart_label',
				'operator' => '!empty',
				'value'    => '',
			),
		),
		'default'      => thebase()->default( 'header_mobile_cart_typography' ),
		'live_method'     => array(
			array(
				'type'     => 'css_typography',
				'selector' => '.header-mobile-cart-wrap .header-cart-button .header-cart-label',
				'pattern'  => array(
					'desktop' => '$',
					'tablet'  => '$',
					'mobile'  => '$',
				),
				'property' => 'font',
				'key'      => 'typography',
			),
		),
		'input_attrs'  => array(
			'id'      => 'header_mobile_cart_typography',
			'options' => 'no-color',
		),
	),
	'header_mobile_cart_padding' => array(
		'control_type' => 'thebase_measure_control',
		'section'      => 'mobile_cart_design',
		'priority'     => 10,
		'default'      => thebase()->default( 'header_mobile_cart_padding' ),
		'label'        => esc_html__( 'Cart Padding', 'gadgeto' ),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '.header-mobile-cart-wrap .header-cart-inner-wrap .header-cart-button',
				'property' => 'padding',
				'pattern'  => '$',
				'key'      => 'measure',
			),
		),
		'input_attrs'  => array(
			'responsive' => false,
		),
	),
	'header_mobile_cart_popup_side' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'mobile_cart',
		'priority'     => 20,
		'default'      => thebase()->default( 'header_mobile_cart_popup_side' ),
		'label'        => esc_html__( 'Slide-Out Side', 'gadgeto' ),
		'context'      => array(
			array(
				'setting'    => 'header_mobile_cart_style',
				'operator'   => '=',
				'value'      => 'slide',
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'class',
				'selector' => '#cart-drawer',
				'pattern'  => 'popup-mobile-drawer-side-$',
				'key'      => '',
			),
		),
		'input_attrs'  => array(
			'layout' => array(
				'left' => array(
					'tooltip' => __( 'Reveal from Left', 'gadgeto' ),
					'name'    => __( 'Left', 'gadgeto' ),
					'icon'    => '',
				),
				'right' => array(
					'tooltip' => __( 'Reveal from Right', 'gadgeto' ),
					'name'    => __( 'Right', 'gadgeto' ),
					'icon'    => '',
				),
			),
			'responsive' => false,
		),
	),
);

Theme_Customizer::add_settings( $settings );

