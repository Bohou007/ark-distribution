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
	'mobile_secondary_navigation_tabs' => array(
		'control_type' => 'thebase_tab_control',
		'section'      => 'mobile_secondary_navigation',
		'settings'     => false,
		'priority'     => 1,
		'input_attrs'  => array(
			'general' => array(
				'label'  => __( 'General', 'gadgeto' ),
				'target' => 'mobile_secondary_navigation',
			),
			'design' => array(
				'label'  => __( 'Design', 'gadgeto' ),
				'target' => 'mobile_secondary_navigation_design',
			),
			'active' => 'general',
		),
	),
	'mobile_secondary_navigation_tabs_design' => array(
		'control_type' => 'thebase_tab_control',
		'section'      => 'mobile_secondary_navigation_design',
		'settings'     => false,
		'priority'     => 1,
		'input_attrs'  => array(
			'general' => array(
				'label'  => __( 'General', 'gadgeto' ),
				'target' => 'mobile_secondary_navigation',
			),
			'design' => array(
				'label'  => __( 'Design', 'gadgeto' ),
				'target' => 'mobile_secondary_navigation_design',
			),
			'active' => 'design',
		),
	),
	'mobile_secondary_navigation_link' => array(
		'control_type' => 'thebase_focus_button_control',
		'section'      => 'mobile_secondary_navigation',
		'settings'     => false,
		'priority'     => 5,
		'label'        => esc_html__( 'Select Menu', 'gadgeto' ),
		'input_attrs'  => array(
			'section' => 'menu_locations',
		),
	),
	'mobile_secondary_navigation_color' => array(
		'control_type' => 'thebase_color_control',
		'section'      => 'mobile_secondary_navigation_design',
		'label'        => esc_html__( 'Colors', 'gadgeto' ),
		'default'      => thebase()->default( 'mobile_secondary_navigation_color' ),
		'live_method'  => array(
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li:not(.menu-item-has-children) > a, .mobile-secondary-navigation ul li.menu-item-has-children > .drawer-nav-drop-wrap',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'color',
			),
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li:not(.menu-item-has-children) > a:hover, .mobile-secondary-navigation ul li.menu-item-has-children > .drawer-nav-drop-wrap:hover',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'hover',
			),
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li.current-menu-item:not(.menu-item-has-children) > a, .mobile-secondary-navigation ul li.current-menu-item.menu-item-has-children > .drawer-nav-drop-wrap',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'active',
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
				'active' => array(
					'tooltip' => __( 'Active Color', 'gadgeto' ),
					'palette' => true,
				),
			),
		),
	),
	'mobile_secondary_navigation_background' => array(
		'control_type' => 'thebase_color_control',
		'section'      => 'mobile_secondary_navigation_design',
		'priority'     => 20,
		'label'        => esc_html__( 'Background', 'gadgeto' ),
		'default'      => thebase()->default( 'mobile_secondary_navigation_background' ),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li:not(.menu-item-has-children) > a, .mobile-secondary-navigation ul li.menu-item-has-children > .drawer-nav-drop-wrap',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'color',
			),
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li:not(.menu-item-has-children) > a:hover, .mobile-secondary-navigation ul li.menu-item-has-children > .drawer-nav-drop-wrap:hover',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'hover',
			),
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li.current-menu-item:not(.menu-item-has-children) > a, .mobile-secondary-navigation ul li.current-menu-item.menu-item-has-children > .drawer-nav-drop-wrap',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'active',
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
				'active' => array(
					'tooltip' => __( 'Active Background', 'gadgeto' ),
					'palette' => true,
				),
			),
		),
	),
	'mobile_secondary_navigation_divider' => array(
		'control_type' => 'thebase_border_control',
		'section'      => 'mobile_secondary_navigation_design',
		'priority'     => 20,
		'label'        => esc_html__( 'Item Divider', 'gadgeto' ),
		'default'      => thebase()->default( 'mobile_secondary_navigation_divider' ),
		'live_method'     => array(
			array(
				'type'     => 'css_border',
				'selector' => '#mobile-secondary-site-navigation ul li.menu-item-has-children .drawer-nav-drop-wrap, .mobile-secondary-navigation ul li:not(.menu-item-has-children) a ',
				'pattern'  => '$',
				'property' => 'border-bottom',
				'pattern'  => '$',
				'key'      => 'border',
			),
			array(
				'type'     => 'css_border',
				'selector' => '#mobile-secondary-site-navigation ul li.menu-item-has-children .drawer-nav-drop-wrap button',
				'pattern'  => '$',
				'property' => 'border-left',
				'pattern'  => '$',
				'key'      => 'border',
			),
		),
		'input_attrs'  => array(
			'responsive' => false,
		),
	),
	'mobile_secondary_navigation_typography' => array(
		'control_type' => 'thebase_typography_control',
		'section'      => 'mobile_secondary_navigation_design',
		'priority'     => 20,
		'label'        => esc_html__( 'Font', 'gadgeto' ),
		'default'      => thebase()->default( 'mobile_secondary_navigation_typography' ),
		'live_method'     => array(
			array(
				'type'     => 'css_typography',
				'selector' => '#mobile-secondary-site-navigation ul li',
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
			'id'      => 'mobile_secondary_navigation_typography',
			'options' => 'no-color',
		),
	),
	'mobile_secondary_navigation_vertical_spacing' => array(
		'control_type' => 'thebase_range_control',
		'section'      => 'mobile_secondary_navigation',
		'priority'     => 20,
		'label'        => esc_html__( 'Items Vertical Spacing', 'gadgeto' ),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li a',
				'property' => 'padding-block-start',
				'pattern'  => '$',
				'key'      => 'size',
			),
			array(
				'type'     => 'css',
				'selector' => '#mobile-secondary-site-navigation ul li a',
				'property' => 'padding-block-end',
				'pattern'  => '$',
				'key'      => 'size',
			),
		),
		'default'      => thebase()->default( 'mobile_secondary_navigation_vertical_spacing' ),
		'input_attrs'  => array(
			'min'        => array(
				'px'  => 0,
				'em'  => 0,
				'rem' => 0,
				'vh'  => 0,
			),
			'max'        => array(
				'px'  => 100,
				'em'  => 12,
				'rem' => 12,
				'vh'  => 12,
			),
			'step'       => array(
				'px'  => 1,
				'em'  => 0.01,
				'rem' => 0.01,
				'vh'  => 0.01,
			),
			'units'      => array( 'px', 'em', 'rem', 'vh' ),
			'responsive' => false,
		),
	),
	'mobile_secondary_navigation_collapse' => array(
		'control_type' => 'thebase_switch_control',
		'sanitize'     => 'thebase_sanitize_toggle',
		'section'      => 'mobile_secondary_navigation',
		'priority'     => 20,
		'default'      => thebase()->default( 'mobile_secondary_navigation_collapse' ),
		'label'        => esc_html__( 'Collapse sub menu items?', 'gadgeto' ),
		'partial'      => array(
			'selector'            => '#mobile-secondary-site-navigation',
			'container_inclusive' => true,
			'render_callback'     => 'TheBase\mobile_secondary_navigation',
		),
	),
	'mobile_secondary_navigation_parent_toggle' => array(
		'control_type' => 'thebase_switch_control',
		'sanitize'     => 'thebase_sanitize_toggle',
		'section'      => 'mobile_secondary_navigation',
		'priority'     => 20,
		'default'      => thebase()->default( 'mobile_secondary_navigation_parent_toggle' ),
		'label'        => esc_html__( 'Entire parent menu item expands sub menu', 'gadgeto' ),
		'context'      => array(
			array(
				'setting' => 'mobile_secondary_navigation_collapse',
				'value'   => true,
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'class',
				'selector' => '#mobile-secondary-site-navigation',
				'pattern'  => 'drawer-navigation-parent-toggle-$',
				'key'      => '',
			),
		),
	),
);
Theme_Customizer::add_settings( $settings );
