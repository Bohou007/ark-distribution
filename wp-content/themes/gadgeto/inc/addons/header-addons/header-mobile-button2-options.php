<?php
/**
 * Header Mobile Button2 Options
 *
 * @package thebase
 */

namespace TheBase;

use TheBase\Theme_Customizer;
use function TheBase\thebase;

Theme_Customizer::add_settings(
	array(
		'mobile_button2_tabs' => array(
			'control_type' => 'thebase_tab_control',
			'section'      => 'mobile_button2',
			'settings'     => false,
			'priority'     => 1,
			'input_attrs'  => array(
				'general' => array(
					'label'  => __( 'General', 'gadgeto' ),
					'target' => 'mobile_button2',
				),
				'design' => array(
					'label'  => __( 'Design', 'gadgeto' ),
					'target' => 'mobile_button2_design',
				),
				'active' => 'general',
			),
		),
		'mobile_button2_tabs_design' => array(
			'control_type' => 'thebase_tab_control',
			'section'      => 'mobile_button2_design',
			'settings'     => false,
			'priority'     => 1,
			'input_attrs'  => array(
				'general' => array(
					'label'  => __( 'General', 'gadgeto' ),
					'target' => 'mobile_button2',
				),
				'design' => array(
					'label'  => __( 'Design', 'gadgeto' ),
					'target' => 'mobile_button2_design',
				),
				'active' => 'design',
			),
		),
		'mobile_button2_style' => array(
			'control_type' => 'thebase_radio_icon_control',
			'section'      => 'mobile_button2',
			'priority'     => 4,
			'default'      => thebase()->default( 'mobile_button2_style' ),
			'label'        => esc_html__( 'Button Style', 'gadgeto' ),
			'live_method'     => array(
				array(
					'type'     => 'class',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
					'pattern'  => 'button-style-$',
					'key'      => '',
				),
			),
			'input_attrs'  => array(
				'layout' => array(
					'filled' => array(
						'name'    => __( 'Filled', 'gadgeto' ),
					),
					'outline' => array(
						'name'    => __( 'Outline', 'gadgeto' ),
						'icon'    => '',
					),
				),
				'responsive' => false,
			),
		),
		'mobile_button2_size' => array(
			'control_type' => 'thebase_radio_icon_control',
			'section'      => 'mobile_button2',
			'priority'     => 4,
			'default'      => thebase()->default( 'mobile_button2_size' ),
			'label'        => esc_html__( 'Button Size', 'gadgeto' ),
			'live_method'     => array(
				array(
					'type'     => 'class',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
					'pattern'  => 'button-size-$',
					'key'      => '',
				),
			),
			'input_attrs'  => array(
				'layout' => array(
					'small' => array(
						'name'    => __( 'Small', 'gadgeto' ),
					),
					'medium' => array(
						'name'    => __( 'Medium', 'gadgeto' ),
						'icon'    => '',
					),
					'large' => array(
						'name'    => __( 'Large', 'gadgeto' ),
						'icon'    => '',
					),
				),
				'responsive' => false,
			),
		),
		'mobile_button2_label' => array(
			'control_type' => 'thebase_text_control',
			'section'      => 'mobile_button2',
			'sanitize'     => 'sanitize_text_field',
			'priority'     => 4,
			'label'        => esc_html__( 'Label', 'gadgeto' ),
			'default'      => thebase()->default( 'mobile_button2_label' ),
			'live_method'     => array(
				array(
					'type'     => 'html',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
					'pattern'  => '$',
					'key'      => '',
				),
			),
		),
		'mobile_button2_link' => array(
			'control_type' => 'thebase_text_control',
			'section'      => 'mobile_button2',
			'sanitize'     => 'esc_url_raw',
			'label'        => esc_html__( 'URL', 'gadgeto' ),
			'priority'     => 4,
			'default'      => thebase()->default( 'mobile_button2_link' ),
			'partial'      => array(
				'selector'            => '.mobile-header-button2-wrap',
				'container_inclusive' => true,
				'render_callback'     => 'TheBase\mobile_button2',
			),
		),
		'mobile_button2_target' => array(
			'control_type' => 'thebase_switch_control',
			'section'      => 'mobile_button2',
			'priority'     => 6,
			'default'      => thebase()->default( 'mobile_button2_target' ),
			'label'        => esc_html__( 'Open in New Tab?', 'gadgeto' ),
		),
		'mobile_button2_nofollow' => array(
			'control_type' => 'thebase_switch_control',
			'section'      => 'mobile_button2',
			'priority'     => 6,
			'default'      => thebase()->default( 'mobile_button2_nofollow' ),
			'label'        => esc_html__( 'Set link to nofollow?', 'gadgeto' ),
		),
		'mobile_button2_sponsored' => array(
			'control_type' => 'thebase_switch_control',
			'section'      => 'mobile_button2',
			'priority'     => 6,
			'default'      => thebase()->default( 'mobile_button2_sponsored' ),
			'label'        => esc_html__( 'Set link attribute Sponsored?', 'gadgeto' ),
		),
		'mobile_button2_visibility' => array(
			'control_type' => 'thebase_radio_icon_control',
			'section'      => 'mobile_button2',
			'priority'     => 4,
			'default'      => thebase()->default( 'mobile_button2_visibility' ),
			'label'        => esc_html__( 'Button Visibility', 'gadgeto' ),
			'partial'      => array(
				'selector'            => '.mobile-header-button2-wrap',
				'container_inclusive' => true,
				'render_callback'     => 'TheBase\mobile_button2',
			),
			'input_attrs'  => array(
				'layout' => array(
					'all' => array(
						'name'    => __( 'Everyone', 'gadgeto' ),
					),
					'loggedout' => array(
						'name'    => __( 'Logged Out Only', 'gadgeto' ),
					),
					'loggedin' => array(
						'name'    => __( 'Logged In Only', 'gadgeto' ),
					),
				),
				'responsive' => false,
			),
		),
		'mobile_button2_color' => array(
			'control_type' => 'thebase_color_control',
			'section'      => 'mobile_button2_design',
			'label'        => esc_html__( 'Colors', 'gadgeto' ),
			'default'      => thebase()->default( 'mobile_button2_color' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
					'property' => 'color',
					'pattern'  => '$',
					'key'      => 'color',
				),
				array(
					'type'     => 'css',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2:hover',
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
		'mobile_button2_background' => array(
			'control_type' => 'thebase_color_control',
			'section'      => 'mobile_button2_design',
			'label'        => esc_html__( 'Background Colors', 'gadgeto' ),
			'default'      => thebase()->default( 'mobile_button2_background' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
					'property' => 'background',
					'pattern'  => '$',
					'key'      => 'color',
				),
				array(
					'type'     => 'css',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2:hover',
					'property' => 'background',
					'pattern'  => '$',
					'key'      => 'hover',
				),
			),
			'context'      => array(
				array(
					'setting'    => 'mobile_button2_style',
					'operator'   => '=',
					'value'      => 'filled',
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
		'mobile_button2_border_colors' => array(
			'control_type' => 'thebase_color_control',
			'section'      => 'mobile_button2_design',
			'label'        => esc_html__( 'Border Colors', 'gadgeto' ),
			'default'      => thebase()->default( 'mobile_button2_border' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
					'property' => 'border-color',
					'pattern'  => '$',
					'key'      => 'color',
				),
				array(
					'type'     => 'css',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2:hover',
					'property' => 'border-color',
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
		'mobile_button2_border' => array(
			'control_type' => 'thebase_border_control',
			'section'      => 'mobile_button2_design',
			'label'        => esc_html__( 'Border', 'gadgeto' ),
			'default'      => thebase()->default( 'mobile_button2_border' ),
			'live_method'     => array(
				array(
					'type'     => 'css_border',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
					'property' => 'border',
					'pattern'  => '$',
					'key'      => 'border',
				),
			),
			'input_attrs'  => array(
				'responsive' => false,
				'color'      => false,
			),
		),
		'mobile_button2_typography' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'mobile_button2_design',
			'label'        => esc_html__( 'Font', 'gadgeto' ),
			'default'      => thebase()->default( 'mobile_button2_typography' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2',
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
				'id' => 'mobile_button2_typography',
				'options' => 'no-color',
			),
		),
		'mobile_button2_margin' => array(
			'control_type' => 'thebase_measure_control',
			'section'      => 'mobile_button2_design',
			'priority'     => 10,
			'default'      => thebase()->default( 'mobile_button2_margin' ),
			'label'        => esc_html__( 'Margin', 'gadgeto' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '.mobile-header-button2-wrap .mobile-header-button2-wrap',
					'property' => 'margin',
					'pattern'  => '$',
					'key'      => 'measure',
				),
			),
			'input_attrs'  => array(
				'responsive' => false,
			),
		),
	)
);
