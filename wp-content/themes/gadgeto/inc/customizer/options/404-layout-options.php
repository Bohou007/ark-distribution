<?php
/**
 * 404 Layout options.
 *
 * @package thebase
 */

namespace TheBase;

use TheBase\Theme_Customizer;
use function TheBase\thebase;

$layout_404_settings = array(
	'404_tabs' => array(
		'control_type' => 'thebase_tab_control',
		'section'      => 'general_404',
		'settings'     => false,
		'priority'     => 1,
		'input_attrs'  => array(
			'general' => array(
				'label'  => __( 'General', 'gadgeto' ),
				'target' => 'general_404',
			),
			'design' => array(
				'label'  => __( 'Design', 'gadgeto' ),
				'target' => 'general_404_design',
			),
			'active' => 'general',
		),
	),
	'404_tabs_design' => array(
		'control_type' => 'thebase_tab_control',
		'section'      => 'general_404_design',
		'settings'     => false,
		'priority'     => 1,
		'input_attrs'  => array(
			'general' => array(
				'label'  => __( 'General', 'gadgeto' ),
				'target' => 'general_404',
			),
			'design' => array(
				'label'  => __( 'Design', 'gadgeto' ),
				'target' => 'general_404_design',
			),
			'active' => 'design',
		),
	),
	'info_404_layout' => array(
		'control_type' => 'thebase_title_control',
		'section'      => 'general_404',
		'priority'     => 10,
		'label'        => esc_html__( '404 Layout', 'gadgeto' ),
		'settings'     => false,
	),
	'info_404_layout_design' => array(
		'control_type' => 'thebase_title_control',
		'section'      => 'general_404_design',
		'priority'     => 10,
		'label'        => esc_html__( '404 Layout', 'gadgeto' ),
		'settings'     => false,
	),
	'404_layout' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'general_404',
		'label'        => esc_html__( '404 Layout', 'gadgeto' ),
		'transport'    => 'refresh',
		'priority'     => 10,
		'default'      => thebase()->default( '404_layout' ),
		'input_attrs'  => array(
			'layout' => array(
				'normal' => array(
					'name' => __( 'Normal', 'gadgeto' ),
					'icon' => 'normal',
				),
				'narrow' => array(
					'name' => __( 'Narrow', 'gadgeto' ),
					'icon' => 'narrow',
				),
				'fullwidth' => array(
					'name' => __( 'Fullwidth', 'gadgeto' ),
					'icon' => 'fullwidth',
				),
				'left' => array(
					'name' => __( 'Left Sidebar', 'gadgeto' ),
					'icon' => 'leftsidebar',
				),
				'right' => array(
					'name' => __( 'Right Sidebar', 'gadgeto' ),
					'icon' => 'rightsidebar',
				),
			),
			'class'      => 'thebase-three-col',
			'responsive' => false,
		),
	),
	'404_sidebar_id' => array(
		'control_type' => 'thebase_select_control',
		'section'      => 'general_404',
		'label'        => esc_html__( '404 Default Sidebar', 'gadgeto' ),
		'transport'    => 'refresh',
		'priority'     => 10,
		'default'      => thebase()->default( '404_sidebar_id' ),
		'input_attrs'  => array(
			'options' => thebase()->sidebar_options(),
		),
	),
	'404_content_style' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'general_404',
		'label'        => esc_html__( 'Content Style', 'gadgeto' ),
		'priority'     => 10,
		'default'      => thebase()->default( '404_content_style' ),
		'live_method'     => array(
			array(
				'type'     => 'class',
				'selector' => 'body.error404',
				'pattern'  => 'content-style-$',
				'key'      => '',
			),
		),
		'input_attrs'  => array(
			'layout' => array(
				'boxed' => array(
					'name' => __( 'Boxed', 'gadgeto' ),
					'icon' => 'boxed',
				),
				'unboxed' => array(
					'name' => __( 'Unboxed', 'gadgeto' ),
					'icon' => 'narrow',
				),
			),
			'responsive' => false,
			'class'      => 'thebase-two-col',
		),
	),
	'404_vertical_padding' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'general_404',
		'label'        => esc_html__( 'Content Vertical Padding', 'gadgeto' ),
		'priority'     => 10,
		'default'      => thebase()->default( '404_vertical_padding' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'general',
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'class',
				'selector' => 'body.error404',
				'pattern'  => 'content-vertical-padding-$',
				'key'      => '',
			),
		),
		'input_attrs'  => array(
			'layout' => array(
				'show' => array(
					'name' => __( 'Enable', 'gadgeto' ),
				),
				'hide' => array(
					'name' => __( 'Disable', 'gadgeto' ),
				),
				'top' => array(
					'name' => __( 'Top Only', 'gadgeto' ),
				),
				'bottom' => array(
					'name' => __( 'Bottom Only', 'gadgeto' ),
				),
			),
			'responsive' => false,
			'class'      => 'thebase-two-grid',
		),
	),
	'404_background' => array(
		'control_type' => 'thebase_background_control',
		'section'      => 'general_404_design',
		'label'        => esc_html__( 'Site Background', 'gadgeto' ),
		'default'      => thebase()->default( '404_background' ),
		'live_method'     => array(
			array(
				'type'     => 'css_background',
				'selector' => 'body.error404',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'base',
			),
		),
		'input_attrs'  => array(
			'tooltip' => __( '404 Background', 'gadgeto' ),
		),
	),
	'404_content_background' => array(
		'control_type' => 'thebase_background_control',
		'section'      => 'general_404_design',
		'label'        => esc_html__( 'Content Background', 'gadgeto' ),
		'default'      => thebase()->default( '404_content_background' ),
		'live_method'  => array(
			array(
				'type'     => 'css_background',
				'selector' => 'body.error404 .content-bg, body.error404.content-style-unboxed .site',
				'property' => 'background',
				'pattern'  => '$',
				'key'      => 'base',
			),
		),
		'input_attrs'  => array(
			'tooltip' => __( '404 Content Background', 'gadgeto' ),
		),
	),
);
Theme_Customizer::add_settings( $layout_404_settings );
