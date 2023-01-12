<?php
/**
 * Header Builder Options
 *
 * @package thebase
 */

namespace TheBase;

use TheBase\Theme_Customizer;
use function TheBase\thebase;

Theme_Customizer::add_settings(
	array(
		// 'load_font_pairing' => array(
		// 	'control_type' => 'thebase_font_pairing',
		// 	'section'      => 'general_typography',
		// 	'label'        => esc_html__( 'Font Pairings', 'gadgeto' ),
		// 	'settings'     => false,
		// ),
		'base_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'Base Font', 'gadgeto' ),
			'default'      => thebase()->default( 'base_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'body',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'         => 'base_font',
				'canInherit' => false,
			),
		),
		'load_base_italic' => array(
			'control_type' => 'thebase_switch_control',
			'sanitize'     => 'thebase_sanitize_toggle',
			'section'      => 'general_typography',
			'default'      => thebase()->default( 'load_base_italic' ),
			'label'        => esc_html__( 'Load Italics Font Styles', 'gadgeto' ),
			'context'      => array(
				array(
					'setting' => 'base_font',
					'operator'   => 'load_italic',
					'value'   => 'true',
				),
			),
		),
		'info_heading' => array(
			'control_type' => 'thebase_title_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'Headings', 'gadgeto' ),
			'settings'     => false,
		),
		'heading_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'Heading Font Family', 'gadgeto' ),
			'default'      => thebase()->default( 'heading_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'h1,h2,h3,h4,h5,h6',
					'property' => 'font',
					'key'      => 'family',
				),
			),
			'input_attrs'  => array(
				'id'      => 'heading_font',
				'options' => 'family',
			),
		),
		'h1_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'H1 Font', 'gadgeto' ),
			'default'      => thebase()->default( 'h1_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'h1',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'             => 'h1_font',
				'headingInherit' => true,
			),
		),
		'h2_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'H2 Font', 'gadgeto' ),
			'default'      => thebase()->default( 'h2_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'h2',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'             => 'h2_font',
				'headingInherit' => true,
			),
		),
		'h3_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'H3 Font', 'gadgeto' ),
			'default'      => thebase()->default( 'h3_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'h3',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'             => 'h3_font',
				'headingInherit' => true,
			),
		),
		'h4_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'H4 Font', 'gadgeto' ),
			'default'      => thebase()->default( 'h4_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'h4',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'             => 'h4_font',
				'headingInherit' => true,
			),
		),
		'h5_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'H5 Font', 'gadgeto' ),
			'default'      => thebase()->default( 'h5_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'h5',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'             => 'h5_font',
				'headingInherit' => true,
			),
		),
		'h6_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'H6 Font', 'gadgeto' ),
			'default'      => thebase()->default( 'h6_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => 'h6',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'             => 'h6_font',
				'headingInherit' => true,
			),
		),
		'info_above_title_heading' => array(
			'control_type' => 'thebase_title_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'Title Above Content', 'gadgeto' ),
			'settings'     => false,
		),
		'title_above_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'H1 Title', 'gadgeto' ),
			'default'      => thebase()->default( 'title_above_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => '.entry-hero h1',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'             => 'title_above_font',
				'headingInherit' => true,
			),
		),
		'title_above_breadcrumb_font' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'general_typography',
			'label'        => esc_html__( 'Breadcrumbs', 'gadgeto' ),
			'default'      => thebase()->default( 'title_above_breadcrumb_font' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => '.entry-hero .thebase-breadcrumbs',
					'property' => 'font',
					'key'      => 'typography',
				),
			),
			'input_attrs'  => array(
				'id'      => 'title_above_breadcrumb_font',
			),
		),
		'google_subsets' => array(
			'control_type' => 'thebase_check_icon_control',
			'section'      => 'general_typography',
			'sanitize'     => 'thebase_sanitize_google_subsets',
			'priority'     => 20,
			'default'      => array(),
			'label'        => esc_html__( 'Google Font Subsets', 'gadgeto' ),
			'input_attrs'  => array(
				'options' => array(
					'latin-ext' => array(
						'name' => __( 'Latin Extended', 'gadgeto' ),
					),
					'cyrillic' => array(
						'name' => __( 'Cyrillic', 'gadgeto' ),
					),
					'cyrillic-ext' => array(
						'name' => __( 'Cyrillic Extended', 'gadgeto' ),
					),
					'greek' => array(
						'name' => __( 'Greek', 'gadgeto' ),
					),
					'greek-ext' => array(
						'name' => __( 'Greek Extended', 'gadgeto' ),
					),
					'vietnamese' => array(
						'name' => __( 'Vietnamese', 'gadgeto' ),
					),
					'arabic' => array(
						'name' => __( 'Arabic', 'gadgeto' ),
					),
					'khmer' => array(
						'name' => __( 'Khmer', 'gadgeto' ),
					),
					'chinese' => array(
						'name' => __( 'Chinese', 'gadgeto' ),
					),
					'chinese-simplified' => array(
						'name' => __( 'Chinese Simplified', 'gadgeto' ),
					),
					'tamil' => array(
						'name' => __( 'Tamil', 'gadgeto' ),
					),
					'bengali' => array(
						'name' => __( 'Bengali', 'gadgeto' ),
					),
					'devanagari' => array(
						'name' => __( 'Devanagari', 'gadgeto' ),
					),
					'hebrew' => array(
						'name' => __( 'Hebrew', 'gadgeto' ),
					),
					'korean' => array(
						'name' => __( 'Korean', 'gadgeto' ),
					),
					'thai' => array(
						'name' => __( 'Thai', 'gadgeto' ),
					),
					'telugu' => array(
						'name' => __( 'Telugu', 'gadgeto' ),
					),
				),
			),
		),
	)
);
