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
		'info_background' => array(
			'control_type' => 'thebase_title_control',
			'section'      => 'general_colors',
			'label'        => esc_html__( 'Backgrounds', 'gadgeto' ),
			'settings'     => false,
		),
		'site_background' => array(
			'control_type' => 'thebase_background_control',
			'section'      => 'general_colors',
			'label'        => esc_html__( 'Site Background', 'gadgeto' ),
			'default'      => thebase()->default( 'site_background' ),
			'live_method'     => array(
				array(
					'type'     => 'css_background',
					'selector' => 'body',
					'property' => 'background',
					'pattern'  => '$',
					'key'      => 'base',
				),
			),
			'input_attrs'  => array(
				'tooltip'  => __( 'Site Background', 'gadgeto' ),
			),
		),
		'content_background' => array(
			'control_type' => 'thebase_background_control',
			'section'      => 'general_colors',
			'label'        => esc_html__( 'Content Background', 'gadgeto' ),
			'default'      => thebase()->default( 'content_background' ),
			'live_method'     => array(
				array(
					'type'     => 'css_background',
					'selector' => '.content-bg, body.content-style-unboxed .site',
					'property' => 'background',
					'pattern'  => '$',
					'key'      => 'base',
				),
			),
			'input_attrs'  => array(
				'tooltip'  => __( 'Content Background', 'gadgeto' ),
			),
		),
		'above_title_background' => array(
			'control_type' => 'thebase_background_control',
			'section'      => 'general_colors',
			'label'        => esc_html__( 'Title Above Content Background', 'gadgeto' ),
			'default'      => thebase()->default( 'above_title_background' ),
			'live_method'     => array(
				array(
					'type'     => 'css_background',
					'selector' => '.site .entry-hero-container-inner',
					'property' => 'background',
					'pattern'  => '$',
					'key'      => 'base',
				),
			),
			'input_attrs'  => array(
				'tooltip'  => __( 'Title Above Content Background', 'gadgeto' ),
			),
		),
		'above_title_overlay_color' => array(
			'control_type' => 'thebase_color_control',
			'section'      => 'general_colors',
			'label'        => esc_html__( 'Title Above Content Overlay Color', 'gadgeto' ),
			'default'      => thebase()->default( 'above_title_overlay_color' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '.entry-hero-container-inner .hero-section-overlay',
					'property' => 'background',
					'pattern'  => '$',
					'key'      => 'color',
				),
			),
			'input_attrs'  => array(
				'colors' => array(
					'color' => array(
						'tooltip' => __( 'Overlay Color', 'gadgeto' ),
						'palette' => true,
					),
				),
				'allowGradient' => true,
			),
		),
		'info_links' => array(
			'control_type' => 'thebase_title_control',
			'section'      => 'general_colors',
			'label'        => esc_html__( 'Content Links', 'gadgeto' ),
			'settings'     => false,
		),
		'link_color' => array(
			'control_type' => 'thebase_color_link_control',
			'section'      => 'general_colors',
			'transport'    => 'refresh',
			'label'        => esc_html__( 'Links Color', 'gadgeto' ),
			'default'      => thebase()->default( 'link_color' ),
			'live_method'     => array(
				array(
					'type'     => 'css_link',
					'selector' => 'a',
					'property' => 'color',
					'pattern'  => 'link-style-$',
					'key'      => 'base',
				),
			),
		),
	)
);

