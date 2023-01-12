<?php
/**
 * Header Main Row Options
 *
 * @package thebase
 */

namespace TheBase;

use TheBase\Theme_Customizer;
use function TheBase\thebase;

$all_post_types    = thebase()->get_post_types_objects();
$extras_post_types = array();
$add_extras        = false;
foreach ( $all_post_types as $post_type_item ) {
	$post_type_name  = $post_type_item->name;
	$post_type_label = $post_type_item->label;
	$ignore_type     = thebase()->get_post_types_to_ignore();
	if ( ! in_array( $post_type_name, $ignore_type, true ) ) {
		$taxonomies = get_object_taxonomies( $post_type_name, 'objects' );
		$taxs = array();
		foreach ( $taxonomies as $term_slug => $term ) {
			if ( ! $term->public || ! $term->show_ui ) {
				continue;
			}
			$taxs[ $term_slug ] = $term->label;
		}
		$settings = array(
			$post_type_name . '_layout_tabs' => array(
				'control_type' => 'thebase_tab_control',
				'section'      => $post_type_name . '_layout',
				'settings'     => false,
				'priority'     => 1,
				'input_attrs'  => array(
					'general' => array(
						'label'  => __( 'General', 'gadgeto' ),
						'target' => $post_type_name . '_layout',
					),
					'design' => array(
						'label'  => __( 'Design', 'gadgeto' ),
						'target' =>  $post_type_name . '_layout_design',
					),
					'active' => 'general',
				),
			),
			$post_type_name . '_layout_tabs_design' => array(
				'control_type' => 'thebase_tab_control',
				'section'      =>  $post_type_name . '_layout_design',
				'settings'     => false,
				'priority'     => 1,
				'input_attrs'  => array(
					'general' => array(
						'label'  => __( 'General', 'gadgeto' ),
						'target' => $post_type_name . '_layout',
					),
					'design' => array(
						'label'  => __( 'Design', 'gadgeto' ),
						'target' => $post_type_name . '_layout_design',
					),
					'active' => 'design',
				),
			),
			'info_' . $post_type_name . '_title' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_layout',
				'priority'     => 2,
				'label'        => $post_type_label . ' ' . esc_html__( 'Title', 'gadgeto' ),
				'settings'     => false,
			),
			'info_' . $post_type_name . '_title_design' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_layout_design',
				'priority'     => 2,
				'label'        => $post_type_label . ' ' . esc_html__( 'Title', 'gadgeto' ),
				'settings'     => false,
			),
			$post_type_name . '_title' => array(
				'control_type' => 'thebase_switch_control',
				'sanitize'     => 'thebase_sanitize_toggle',
				'section'      => $post_type_name . '_layout',
				'priority'     => 3,
				'default'      => thebase()->default( $post_type_name . '_title', true ),
				'label'        => esc_html__( 'Show Title?', 'gadgeto' ),
				'transport'    => 'refresh',
			),
			$post_type_name . '_title_layout' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'label'        => $post_type_label . ' ' . esc_html__( 'Title Layout', 'gadgeto' ),
				'transport'    => 'refresh',
				'priority'     => 4,
				'default'      => thebase()->default( $post_type_name . '_title_layout', 'normal' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'normal' => array(
							'tooltip' => __( 'In Content', 'gadgeto' ),
							'icon'    => 'incontent',
						),
						'above' => array(
							'tooltip' => __( 'Above Content', 'gadgeto' ),
							'icon'    => 'abovecontent',
						),
					),
					'responsive' => false,
					'class'      => 'thebase-two-col',
				),
			),
			$post_type_name . '_title_inner_layout' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'priority'     => 4,
				'default'      => thebase()->default( $post_type_name . '_title_inner_layout', 'standard' ),
				'label'        => esc_html__( 'Container Width', 'gadgeto' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => '.' . $post_type_name . '-hero-section',
						'pattern'  => 'entry-hero-layout-$',
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'standard' => array(
							'tooltip' => __( 'Background Fullwidth, Content Contained', 'gadgeto' ),
							'name'    => __( 'Standard', 'gadgeto' ),
							'icon'    => '',
						),
						'fullwidth' => array(
							'tooltip' => __( 'Background & Content Fullwidth', 'gadgeto' ),
							'name'    => __( 'Fullwidth', 'gadgeto' ),
							'icon'    => '',
						),
						'contained' => array(
							'tooltip' => __( 'Background & Content Contained', 'gadgeto' ),
							'name'    => __( 'Contained', 'gadgeto' ),
							'icon'    => '',
						),
					),
					'responsive' => false,
				),
			),
			$post_type_name . '_title_align' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'label'        => $post_type_label . ' ' . esc_html__( 'Title Align', 'gadgeto' ),
				'priority'     => 4,
				'default'      => thebase()->default( $post_type_name . '_title_align' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => '.' . $post_type_name . '-title',
						'pattern'  => array(
							'desktop' => 'title-align-$',
							'tablet'  => 'title-tablet-align-$',
							'mobile'  => 'title-mobile-align-$',
						),
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'left' => array(
							'tooltip'  => __( 'Left Align Title', 'gadgeto' ),
							'dashicon' => 'editor-alignleft',
						),
						'center' => array(
							'tooltip'  => __( 'Center Align Title', 'gadgeto' ),
							'dashicon' => 'editor-aligncenter',
						),
						'right' => array(
							'tooltip'  => __( 'Right Align Title', 'gadgeto' ),
							'dashicon' => 'editor-alignright',
						),
					),
					'responsive' => true,
				),
			),
			$post_type_name . '_title_height' => array(
				'control_type' => 'thebase_range_control',
				'section'      => $post_type_name . '_layout',
				'priority'     => 5,
				'label'        => esc_html__( 'Container Min Height', 'gadgeto' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '#inner-wrap .' . $post_type_name . '-hero-section .entry-header',
						'property' => 'min-height',
						'pattern'  => '$',
						'key'      => 'size',
					),
				),
				'default'      => thebase()->default( $post_type_name . '_title_height', array(
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
				) ),
				'input_attrs'  => array(
					'min'     => array(
						'px'  => 10,
						'em'  => 1,
						'rem' => 1,
						'vh'  => 2,
					),
					'max'     => array(
						'px'  => 800,
						'em'  => 12,
						'rem' => 12,
						'vh'  => 40,
					),
					'step'    => array(
						'px'  => 1,
						'em'  => 0.01,
						'rem' => 0.01,
						'vh'  => 1,
					),
					'units'   => array( 'px', 'em', 'rem', 'vh' ),
				),
			),
			$post_type_name . '_title_elements' => array(
				'control_type' => 'thebase_sorter_control',
				'section'      => $post_type_name . '_layout',
				'priority'     => 6,
				'default'      => array( 'title', 'breadcrumb', 'meta' ),
				'label'        => esc_html__( 'Title Elements', 'gadgeto' ),
				'transport'    => 'refresh',
				'settings'     => array(
					'elements'   => $post_type_name . '_title_elements',
					'title'      => $post_type_name . '_title_element_title',
					'breadcrumb' => $post_type_name . '_title_element_breadcrumb',
					'categories' => $post_type_name . '_title_element_categories',
					'meta'       => $post_type_name . '_title_element_meta',
				),
				'input_attrs'  => array(
					'defaults' => array(
						'categories' => array(
							'enabled' => true,
							'style'   => 'normal',
							'divider' => 'vline',
							'taxonomy' => '',
						),
						'title'      => array(
							'enabled' => true,
						),
						'meta'       => array(
							'id'                     => 'meta',
							'enabled'                => false,
							'divider'                => 'dot',
							'author'                 => true,
							'authorImage'            => true,
							'authorEnableLabel'      => true,
							'authorLabel'            => '',
							'date'                   => true,
							'dateEnableLabel'        => false,
							'dateLabel'              => '',
							'dateUpdated'            => false,
							'dateUpdatedEnableLabel' => false,
							'dateUpdatedLabel'       => '',
							'comments'               => false,
						),
						'breadcrumb' => array(
							'enabled' => false,
							'show_title' => true,
						),
					),
					'group'      => $post_type_name . '_title_element',
					'taxonomies' => $taxs,
				),
			),
			$post_type_name . '_title_font' => array(
				'control_type' => 'thebase_typography_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => $post_type_label . ' ' . esc_html__( 'Title Font', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_font', array(
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
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css_typography',
						'selector' => '.' . $post_type_name . '-title h1',
						'property' => 'font',
						'key'      => 'typography',
					),
				),
				'input_attrs'  => array(
					'id'             => $post_type_name . '_title_font',
					'headingInherit' => true,
				),
			),
			$post_type_name . '_title_category_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Category Colors', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_category_color', array(
					'color' => '',
					'hover' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .entry-taxonomies, .' . $post_type_name . '-title .entry-taxonomies a',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'color',
					),
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .entry-taxonomies a:hover',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'hover',
					),
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .entry-taxonomies .category-style-pill a',
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'color',
					),
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .entry-taxonomies .category-style-pill a:hover',
						'property' => 'background',
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
							'tooltip' => __( 'Link Hover Color', 'gadgeto' ),
							'palette' => true,
						),
					),
				),
			),
			$post_type_name . '_title_category_font' => array(
				'control_type' => 'thebase_typography_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Category Font', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_category_font', array(
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
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css_typography',
						'selector' => '.' . $post_type_name . '-title .entry-taxonomies, .' . $post_type_name . '-title .entry-taxonomies a',
						'property' => 'font',
						'key'      => 'typography',
					),
				),
				'input_attrs'  => array(
					'id'      => $post_type_name . '_title_category_font',
					'options' => 'no-color',
				),
			),
			$post_type_name . '_title_breadcrumb_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Breadcrumb Colors', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_breadcrumb_color', array(
					'color' => '',
					'hover' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .thebase-breadcrumbs',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'color',
					),
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .thebase-breadcrumbs a:hover',
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
							'tooltip' => __( 'Link Hover Color', 'gadgeto' ),
							'palette' => true,
						),
					),
				),
			),
			$post_type_name . '_title_breadcrumb_font' => array(
				'control_type' => 'thebase_typography_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Breadcrumb Font', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_breadcrumb_font', array(
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
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css_typography',
						'selector' => '.' . $post_type_name . '-title .thebase-breadcrumbs',
						'property' => 'font',
						'key'      => 'typography',
					),
				),
				'input_attrs'  => array(
					'id'      => $post_type_name . '_title_breadcrumb_font',
					'options' => 'no-color',
				),
			),
			$post_type_name . '_title_meta_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Meta Colors', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_meta_color' ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .entry-meta',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'color',
					),
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-title .entry-meta a:hover',
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
							'tooltip' => __( 'Link Hover Color', 'gadgeto' ),
							'palette' => true,
						),
					),
				),
			),
			$post_type_name . '_title_meta_font' => array(
				'control_type' => 'thebase_typography_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Meta Font', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_meta_font', array(
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
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css_typography',
						'selector' => '.' . $post_type_name . '-title .entry-meta',
						'property' => 'font',
						'key'      => 'typography',
					),
				),
				'input_attrs'  => array(
					'id'      => $post_type_name . '_title_meta_font',
					'options' => 'no-color',
				),
			),
			$post_type_name . '_title_background' => array(
				'control_type' => 'thebase_background_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => $post_type_label . ' ' . esc_html__( 'Title Background', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_background', array(
					'desktop' => array(
						'color' => '',
					),
				) ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'css_background',
						'selector' => '#inner-wrap .page-hero-section .entry-hero-container-inner',
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'base',
					),
				),
				'input_attrs'  => array(
					'tooltip'  => $post_type_name . ' ' . __( 'Title Background', 'gadgeto' ),
				),
			),
			$post_type_name . '_title_featured_image' => array(
				'control_type' => 'thebase_switch_control',
				'section'      => $post_type_name . '_layout_design',
				'default'      => thebase()->default( $post_type_name . '_title_featured_image' ),
				'label'        => esc_html__( 'Use Featured Image for Background?', 'gadgeto' ),
				'transport'    => 'refresh',
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
			),
			$post_type_name . '_title_overlay_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Background Overlay Color', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_overlay_color', array(
					'color' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-hero-section .hero-section-overlay',
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'color',
					),
				),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_title_layout',
						'operator'   => '=',
						'value'      => 'above',
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
			$post_type_name . '_title_top_border' => array(
				'control_type' => 'thebase_border_control',
				'section'      => $post_type_name . '_layout',
				'label'        => esc_html__( 'Top Border', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_top_border' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'css_border',
						'selector' => '.' . $post_type_name . '-hero-section .entry-hero-container-inner',
						'pattern'  => '$',
						'property' => 'border-top',
						'pattern'  => '$',
						'key'      => 'border',
					),
				),
			),
			$post_type_name . '_title_bottom_border' => array(
				'control_type' => 'thebase_border_control',
				'section'      => $post_type_name . '_layout',
				'label'        => esc_html__( 'Bottom Border', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_title_bottom_border' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'css_border',
						'selector' => '.' . $post_type_name . '-hero-section .entry-hero-container-inner',
						'pattern'  => '$',
						'property' => 'border-bottom',
						'pattern'  => '$',
						'key'      => 'border',
					),
				),
			),
			'info_' . $post_type_name . '_layout' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_layout',
				'priority'     => 10,
				'label'        => $post_type_label . ' ' . esc_html__( 'Layout', 'gadgeto' ),
				'settings'     => false,
			),
			'info_' . $post_type_name . '_layout_design' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_layout_design',
				'priority'     => 10,
				'label'        => $post_type_label . ' ' . esc_html__( 'Layout', 'gadgeto' ),
				'settings'     => false,
			),
			$post_type_name . '_layout' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'label'        => $post_type_label . ' ' . esc_html__( 'Layout', 'gadgeto' ),
				'transport'    => 'refresh',
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_layout', 'normal' ),
				'input_attrs'  => array(
					'layout' => array(
						'normal' => array(
							'tooltip' => __( 'Normal', 'gadgeto' ),
							'icon' => 'normal',
						),
						'narrow' => array(
							'tooltip' => __( 'Narrow', 'gadgeto' ),
							'icon' => 'narrow',
						),
						'fullwidth' => array(
							'tooltip' => __( 'Fullwidth', 'gadgeto' ),
							'icon' => 'fullwidth',
						),
						'left' => array(
							'tooltip' => __( 'Left Sidebar', 'gadgeto' ),
							'icon' => 'leftsidebar',
						),
						'right' => array(
							'tooltip' => __( 'Right Sidebar', 'gadgeto' ),
							'icon' => 'rightsidebar',
						),
					),
					'responsive' => false,
					'class'      => 'thebase-three-col',
				),
			),
			$post_type_name . '_sidebar_id' => array(
				'control_type' => 'thebase_select_control',
				'section'      => $post_type_name . '_layout',
				'label'        => esc_html__( 'Default Sidebar', 'gadgeto' ),
				'transport'    => 'refresh',
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_sidebar_id' ),
				'input_attrs'  => array(
					'options' => thebase()->sidebar_options(),
				),
			),
			$post_type_name . '_content_style' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'label'        => esc_html__( 'Content Style', 'gadgeto' ),
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_content_style', 'boxed' ),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => 'body.' . str_replace( '_', '-', $post_type_name ),
						'pattern'  => 'content-style-$',
						'key'      => '',
					),
					array(
						'type'     => 'class',
						'selector' => 'body.single-' . ( 'give_forms' === $post_type_name ? $post_type_name : str_replace( '_', '-', $post_type_name ) ),
						'pattern'  => 'content-style-$',
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'boxed' => array(
							'tooltip' => __( 'Boxed', 'gadgeto' ),
							'icon' => 'boxed',
						),
						'unboxed' => array(
							'tooltip' => __( 'Unboxed', 'gadgeto' ),
							'icon' => 'narrow',
						),
					),
					'responsive' => false,
					'class'      => 'thebase-two-col',
				),
			),
			$post_type_name . '_vertical_padding' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'label'        => esc_html__( 'Content Vertical Padding', 'gadgeto' ),
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_vertical_padding', 'show' ),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => 'body.' . str_replace( '_', '-', $post_type_name ),
						'pattern'  => 'content-vertical-padding-$',
						'key'      => '',
					),
					array(
						'type'     => 'class',
						'selector' => 'body.single-' . ( 'give_forms' === $post_type_name ? $post_type_name : str_replace( '_', '-', $post_type_name ) ),
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
			$post_type_name . '_background' => array(
				'control_type' => 'thebase_background_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Site Background', 'gadgeto' ),
				'default'      => thebase()->default( 'site_background' ),
				'live_method'     => array(
					array(
						'type'     => 'css_background',
						'selector' => 'body.single-' . str_replace( '_', '-', $post_type_name ),
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'base',
					),
					array(
						'type'     => 'css_background',
						'selector' => 'body.' . ( 'give_forms' === $post_type_name ? $post_type_name : str_replace( '_', '-', $post_type_name ) ),
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'base',
					),
				),
				'input_attrs'  => array(
					'tooltip' => $post_type_label . ' ' . __( 'Background', 'gadgeto' ),
				),
			),
			$post_type_name . '_content_background' => array(
				'control_type' => 'thebase_background_control',
				'section'      => $post_type_name . '_layout_design',
				'label'        => esc_html__( 'Content Background', 'gadgeto' ),
				'default'      => thebase()->default( 'content_background' ),
				'live_method'  => array(
					array(
						'type'     => 'css_background',
						'selector' => 'body.single-' . ( 'give_forms' === $post_type_name ? $post_type_name : str_replace( '_', '-', $post_type_name ) ) . ' .content-bg, body.single' . ( 'give_forms' === $post_type_name ? $post_type_name : str_replace( '_', '-', $post_type_name ) ) . '.content-style-unboxed .site',
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'base',
					),
				),
				'input_attrs'  => array(
					'tooltip' => $post_type_label . ' ' . __( 'Content Background', 'gadgeto' ),
				),
			),
		);
		$add_extras = false;
		$extras     = array();
		if ( post_type_supports( $post_type_name, 'thumbnail' ) ) {
			$add_extras = true;
			$extras[ $post_type_name . '_feature' ] = array(
				'control_type' => 'thebase_switch_control',
				'sanitize'     => 'thebase_sanitize_toggle',
				'section'      => $post_type_name . '_layout',
				'priority'     => 20,
				'default'      => thebase()->default( $post_type_name . '_feature' ),
				'label'        => esc_html__( 'Show Featured Image?', 'gadgeto' ),
				'transport'    => 'refresh',
			);
			$extras[ $post_type_name . '_feature_position' ] = array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'label'        => esc_html__( 'Featured Image Position', 'gadgeto' ),
				'priority'     => 20,
				'transport'    => 'refresh',
				'default'      => thebase()->default( $post_type_name . '_feature_position', 'above' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_feature',
						'operator'   => '=',
						'value'      => true,
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'above' => array(
							'name' => __( 'Above', 'gadgeto' ),
						),
						'behind' => array(
							'name' => __( 'Behind', 'gadgeto' ),
						),
						'below' => array(
							'name' => __( 'Below', 'gadgeto' ),
						),
					),
					'responsive' => false,
				),
			);
			$extras[ $post_type_name . '_feature_ratio'] = array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_layout',
				'label'        => esc_html__( 'Featured Image Ratio', 'gadgeto' ),
				'priority'     => 20,
				'default'      => thebase()->default( $post_type_name . '_feature_ratio', '2-3' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_feature',
						'operator'   => '=',
						'value'      => true,
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => 'body.' . str_replace( '_', '-', $post_type_name ) . ' .article-post-thumbnail',
						'pattern'  => 'thebase-thumbnail-ratio-$',
						'key'      => '',
					),
					array(
						'type'     => 'class',
						'selector' => 'body.single-' . str_replace( '_', '-', $post_type_name ) . ' .article-post-thumbnail',
						'pattern'  => 'thebase-thumbnail-ratio-$',
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'inherit' => array(
							'name' => __( 'Inherit', 'gadgeto' ),
						),
						'1-1' => array(
							'name' => __( '1:1', 'gadgeto' ),
						),
						'3-4' => array(
							'name' => __( '4:3', 'gadgeto' ),
						),
						'2-3' => array(
							'name' => __( '3:2', 'gadgeto' ),
						),
						'9-16' => array(
							'name' => __( '16:9', 'gadgeto' ),
						),
						'1-2' => array(
							'name' => __( '1:2', 'gadgeto' ),
						),
					),
					'responsive' => false,
					'class' => 'thebase-three-col-short',
				),
			);
		}
		if ( post_type_supports( $post_type_name, 'comments' ) ) {
			$add_extras = true;
			$extras[ $post_type_name . '_comments' ] = array(
				'control_type' => 'thebase_switch_control',
				'sanitize'     => 'thebase_sanitize_toggle',
				'section'      => $post_type_name . '_layout',
				'priority'     => 20,
				'default'      => thebase()->default( $post_type_name . '_comments' ),
				'label'        => esc_html__( 'Show Comments?', 'gadgeto' ),
				'transport'    => 'refresh',
			);
		}
		if ( $add_extras ) {
			$settings = array_merge(
				$settings,
				$extras
			);
		}
		// Archives
		$thebase_custom_post_type_archive_settings = array(
			$post_type_name . '_archive_tabs' => array(
				'control_type' => 'thebase_tab_control',
				'section'      => $post_type_name . '_archive',
				'settings'     => false,
				'priority'     => 1,
				'input_attrs'  => array(
					'general' => array(
						'label'  => __( 'General', 'gadgeto' ),
						'target' => $post_type_name . '_archive',
					),
					'design' => array(
						'label'  => __( 'Design', 'gadgeto' ),
						'target' => $post_type_name . '_archive_design',
					),
					'active' => 'general',
				),
			),
			$post_type_name . '_archive_tabs_design' => array(
				'control_type' => 'thebase_tab_control',
				'section'      => $post_type_name . '_archive_design',
				'settings'     => false,
				'priority'     => 1,
				'input_attrs'  => array(
					'general' => array(
						'label'  => __( 'General', 'gadgeto' ),
						'target' => $post_type_name . '_archive',
					),
					'design' => array(
						'label'  => __( 'Design', 'gadgeto' ),
						'target' => $post_type_name . '_archive_design',
					),
					'active' => 'design',
				),
			),
			'info_' . $post_type_name . '_archive_title' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 2,
				'label'        => esc_html__( 'Archive Title', 'gadgeto' ),
				'settings'     => false,
			),
			'info_' . $post_type_name . '_archive_title_design' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_archive_design',
				'priority'     => 2,
				'label'        => esc_html__( 'Archive Title', 'gadgeto' ),
				'settings'     => false,
			),
			$post_type_name . '_archive_title' => array(
				'control_type' => 'thebase_switch_control',
				'sanitize'     => 'thebase_sanitize_toggle',
				'section'      => $post_type_name . '_archive',
				'priority'     => 3,
				'default'      => thebase()->default( $post_type_name . '_archive_title', true ),
				'label'        => esc_html__( 'Show Archive Title?', 'gadgeto' ),
				'transport'    => 'refresh',
			),
			$post_type_name . '_archive_title_layout' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_archive',
				'label'        => esc_html__( 'Archive Title Layout', 'gadgeto' ),
				'transport'    => 'refresh',
				'priority'     => 4,
				'default'      => thebase()->default( $post_type_name . '_archive_title_layout', 'above' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_archive_title',
						'operator'   => '=',
						'value'      => true,
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'normal' => array(
							'name' => __( 'In Content', 'gadgeto' ),
							'icon'    => 'incontent',
						),
						'above' => array(
							'name' => __( 'Above Content', 'gadgeto' ),
							'icon'    => 'abovecontent',
						),
					),
					'responsive' => false,
					'class'      => 'thebase-two-col',
				),
			),
			$post_type_name . '_archive_title_inner_layout' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 4,
				'default'      => thebase()->default( $post_type_name . '_archive_title_inner_layout', 'standard' ),
				'label'        => esc_html__( 'Container Width', 'gadgeto' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_archive_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_archive_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => '.' . $post_type_name . '-archive-hero-section',
						'pattern'  => 'entry-hero-layout-$',
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'standard' => array(
							'tooltip' => __( 'Background Fullwidth, Content Contained', 'gadgeto' ),
							'name'    => __( 'Standard', 'gadgeto' ),
							'icon'    => '',
						),
						'fullwidth' => array(
							'tooltip' => __( 'Background & Content Fullwidth', 'gadgeto' ),
							'name'    => __( 'Fullwidth', 'gadgeto' ),
							'icon'    => '',
						),
						'contained' => array(
							'tooltip' => __( 'Background & Content Contained', 'gadgeto' ),
							'name'    => __( 'Contained', 'gadgeto' ),
							'icon'    => '',
						),
					),
					'responsive' => false,
				),
			),
			$post_type_name . '_archive_title_align' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_archive',
				'label'        => esc_html__( 'Archive Title Align', 'gadgeto' ),
				'priority'     => 4,
				'default'      => thebase()->default( $post_type_name . '_archive_title_align', array(
					'mobile'  => '',
					'tablet'  => '',
					'desktop' => '',
				) ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_archive_title',
						'operator'   => '=',
						'value'      => true,
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => '.' . $post_type_name . '-archive-title',
						'pattern'  => array(
							'desktop' => 'title-align-$',
							'tablet'  => 'title-tablet-align-$',
							'mobile'  => 'title-mobile-align-$',
						),
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'left' => array(
							'tooltip'  => __( 'Left Align Title', 'gadgeto' ),
							'dashicon' => 'editor-alignleft',
						),
						'center' => array(
							'tooltip'  => __( 'Center Align Title', 'gadgeto' ),
							'dashicon' => 'editor-aligncenter',
						),
						'right' => array(
							'tooltip'  => __( 'Right Align Title', 'gadgeto' ),
							'dashicon' => 'editor-alignright',
						),
					),
					'responsive' => true,
				),
			),
			$post_type_name . '_archive_title_height' => array(
				'control_type' => 'thebase_range_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 5,
				'label'        => esc_html__( 'Container Min Height', 'gadgeto' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_archive_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_archive_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '#inner-wrap .' . $post_type_name . '-archive-hero-section .entry-header',
						'property' => 'min-height',
						'pattern'  => '$',
						'key'      => 'size',
					),
				),
				'default'      => thebase()->default( $post_type_name . '_archive_title_height', array(
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
				) ),
				'input_attrs'  => array(
					'min'     => array(
						'px'  => 10,
						'em'  => 1,
						'rem' => 1,
						'vh'  => 2,
					),
					'max'     => array(
						'px'  => 800,
						'em'  => 12,
						'rem' => 12,
						'vh'  => 100,
					),
					'step'    => array(
						'px'  => 1,
						'em'  => 0.01,
						'rem' => 0.01,
						'vh'  => 1,
					),
					'units'   => array( 'px', 'em', 'rem', 'vh' ),
				),
			),
			$post_type_name . '_archive_title_elements' => array(
				'control_type' => 'thebase_sorter_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 6,
				'default'      => thebase()->default( $post_type_name . '_archive_title_elements', array( 'breadcrumb', 'title', 'description' ) ),
				'label'        => esc_html__( 'Title Elements', 'gadgeto' ),
				'transport'    => 'refresh',
				'settings'     => array(
					'elements'    => $post_type_name . '_archive_title_elements',
					'title'       => $post_type_name . '_archive_title_element_title',
					'breadcrumb'  => $post_type_name . '_archive_title_element_breadcrumb',
					'description' => $post_type_name . '_archive_title_element_description',
				),
				'input_attrs'  => array(
					'groupe'   => $post_type_name . '_archive_title_elements',
					'defaults' => array(
						'title'      => thebase()->default( $post_type_name . '_archive_element_title', array(
							'enabled' => true,
						) ),
						'description'      => thebase()->default( $post_type_name . '_archive_title_element_description', array(
							'enabled' => true,
						) ),
						'breadcrumb'       => thebase()->default( $post_type_name . '_archive_title_element_breadcrumb', array(
							'enabled' => false,
							'show_title' => true,
						) ),
					),
				),
			),
			$post_type_name . '_archive_title_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Title Color', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_title_color', array(
					'color' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-archive-title h1',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'color',
					),
				),
				'input_attrs'  => array(
					'colors' => array(
						'color' => array(
							'tooltip' => __( 'Color', 'gadgeto' ),
							'palette' => true,
						),
					),
				),
			),
			$post_type_name . '_archive_title_description_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Description Colors', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_title_description_color', array(
					'color' => '',
					'hover' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-archive-title .archive-description',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'color',
					),
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-archive-title .archive-description a:hover',
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
							'tooltip' => __( 'Link Hover Color', 'gadgeto' ),
							'palette' => true,
						),
					),
				),
			),
			$post_type_name . '_archive_title_breadcrumb_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Breadcrumb Colors', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_title_breadcrumb_color', array(
					'color' => '',
					'hover' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-archive-title .thebase-breadcrumbs',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'color',
					),
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-archive-title .thebase-breadcrumbs a:hover',
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
							'tooltip' => __( 'Link Hover Color', 'gadgeto' ),
							'palette' => true,
						),
					),
				),
			),
			$post_type_name . '_archive_title_background' => array(
				'control_type' => 'thebase_background_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Archive Title Background', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_title_background', array(
					'desktop' => array(
						'color' => '',
					),
				) ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_archive_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_archive_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'css_background',
						'selector' => '#inner-wrap .' . $post_type_name . '-archive-hero-section .entry-hero-container-inner',
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'base',
					),
				),
				'input_attrs'  => array(
					'tooltip'  => __( 'Title Background', 'gadgeto' ),
				),
			),
			$post_type_name . '_archive_title_overlay_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Background Overlay Color', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_title_overlay_color', array(
					'color' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.' . $post_type_name . '-archive-hero-section .hero-section-overlay',
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'color',
					),
				),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_archive_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_archive_title_layout',
						'operator'   => '=',
						'value'      => 'above',
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
			$post_type_name . '_archive_title_border' => array(
				'control_type' => 'thebase_borders_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Border', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_title_border' ),
				'context'      => array(
					array(
						'setting'    => $post_type_name . '_archive_title',
						'operator'   => '=',
						'value'      => true,
					),
					array(
						'setting'    => $post_type_name . '_archive_title_layout',
						'operator'   => '=',
						'value'      => 'above',
					),
				),
				'settings'     => array(
					'border_top'    => $post_type_name . '_archive_title_top_border',
					'border_bottom' => $post_type_name . '_archive_title_bottom_border',
				),
				'live_method'     => array(
					$post_type_name . '_archive_title_top_border' => array(
						array(
							'type'     => 'css_border',
							'selector' => '.' . $post_type_name . '-archive-hero-section .entry-hero-container-inner',
							'pattern'  => '$',
							'property' => 'border-top',
							'key'      => 'border',
						),
					),
					$post_type_name . '_archive_title_bottom_border' => array( 
						array(
							'type'     => 'css_border',
							'selector' => '.' . $post_type_name . '-archive-hero-section .entry-hero-container-inner',
							'property' => 'border-bottom',
							'pattern'  => '$',
							'key'      => 'border',
						),
					),
				),
			),
			'info_' . $post_type_name . '_archive_layout' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 10,
				'label'        => esc_html__( 'Archive Layout', 'gadgeto' ),
				'settings'     => false,
			),
			// 'info_' . $post_type_name . '_archive_layout_design' => array(
			// 	'control_type' => 'thebase_title_control',
			// 	'section'      => $post_type_name . '_archive_design',
			// 	'priority'     => 10,
			// 	'label'        => esc_html__( 'Archive Layout', 'gadgeto' ),
			// 	'settings'     => false,
			// ),
			$post_type_name . '_archive_layout' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_archive',
				'label'        => esc_html__( 'Archive Layout', 'gadgeto' ),
				'transport'    => 'refresh',
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_archive_layout' ),
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
			$post_type_name . '_archive_sidebar_id' => array(
				'control_type' => 'thebase_select_control',
				'section'      => $post_type_name . '_archive',
				'label'        => esc_html__( 'Archive Default Sidebar', 'gadgeto' ),
				'transport'    => 'refresh',
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_archive_sidebar_id', 'sidebar-primary' ),
				'input_attrs'  => array(
					'options' => thebase()->sidebar_options(),
				),
			),
			$post_type_name . '_archive_content_style' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_archive',
				'label'        => esc_html__( 'Content Style', 'gadgeto' ),
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_archive_content_style', 'boxed' ),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => 'body.post-type-archive-' . $post_type_name,
						'pattern'  => 'content-style-$',
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'boxed' => array(
							'tooltip' => __( 'Boxed', 'gadgeto' ),
							'icon' => 'gridBoxed',
							'name' => __( 'Boxed', 'gadgeto' ),
						),
						'unboxed' => array(
							'tooltip' => __( 'Unboxed', 'gadgeto' ),
							'icon' => 'gridUnboxed',
							'name' => __( 'Unboxed', 'gadgeto' ),
						),
					),
					'responsive' => false,
					'class'      => 'thebase-two-col',
				),
			),
			$post_type_name . '_archive_columns' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 10,
				'label'        => esc_html__( 'Archive Columns', 'gadgeto' ),
				'transport'    => 'refresh',
				'default'      => thebase()->default( $post_type_name . '_archive_columns', 3 ),
				'input_attrs'  => array(
					'layout' => array(
						'1' => array(
							'name' => __( '1', 'gadgeto' ),
						),
						'2' => array(
							'name' => __( '2', 'gadgeto' ),
						),
						'3' => array(
							'name' => __( '3', 'gadgeto' ),
						),
						'4' => array(
							'name' => __( '4', 'gadgeto' ),
						),
					),
					'responsive' => false,
				),
			),
			'info_' . $post_type_name . '_archive_item_layout' => array(
				'control_type' => 'thebase_title_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 12,
				'label'        => esc_html__( 'Post Item Layout', 'gadgeto' ),
				'settings'     => false,
			),
			$post_type_name . '_archive_elements' => array(
				'control_type' => 'thebase_sorter_control',
				'section'      => $post_type_name . '_archive',
				'priority'     => 12,
				'default'      => thebase()->default( $post_type_name . '_archive_elements', array( 'feature', 'title', 'meta', 'excerpt', 'readmore' ) ),
				'label'        => esc_html__( 'Item Elements', 'gadgeto' ),
				'transport'    => 'refresh',
				'settings'     => array(
					'elements'   => $post_type_name . '_archive_elements',
					'feature'    => $post_type_name . '_archive_element_feature',
					'categories' => $post_type_name . '_archive_element_categories',
					'title'      => $post_type_name . '_archive_element_title',
					'meta'       => $post_type_name . '_archive_element_meta',
					'excerpt'    => $post_type_name . '_archive_element_excerpt',
					'readmore'   => $post_type_name . '_archive_element_readmore',
				),
				'input_attrs'  => array(
					'groupe'   => $post_type_name . '_archive_elements',
					'sortable' => false,
					'defaults' => array(
						'feature'    => thebase()->default( $post_type_name . '_archive_element_feature', array(
							'enabled' => true,
							'ratio'   => '2-3',
							'size'    => 'medium_large',
						) ),
						'title'      => thebase()->default( $post_type_name . '_archive_element_title', array(
							'enabled' => true,
						) ),
						'categories'      => thebase()->default( $post_type_name . '_archive_element_categories', array(
							'enabled' => false,
							'style'   => 'normal',
							'divider' => 'vline',
							'taxonomy' => '',
						) ),
						'meta'       => thebase()->default( $post_type_name . '_archive_element_meta', array(
							'id'                     => 'meta',
							'enabled'                => false,
							'divider'                => 'dot',
							'author'                 => true,
							'authorLink'             => true,
							'authorImage'            => true,
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
						) ),
						'excerpt'    => thebase()->default( $post_type_name . '_archive_element_excerpt', array(
							'enabled'     => true,
							'words'       => 55,
							'fullContent' => false,
						) ),
						'readmore'   => thebase()->default( $post_type_name . '_archive_element_readmore', array(
							'enabled' => true,
						) ),
					),
					'dividers' => array(
						'dot' => array(
							'icon' => 'dot',
						),
						'slash' => array(
							'icon' => 'slash',
						),
						'dash' => array(
							'icon' => 'dash',
						),
						'vline' => array(
							'icon' => 'vline',
						),
						'customicon' => array(
							'icon' => 'hours',
						),
					),
					'taxonomies' => $taxs,
				),
			),
			$post_type_name . '_archive_item_image_placement' => array(
				'control_type' => 'thebase_radio_icon_control',
				'section'      => $post_type_name . '_archive',
				'label'        => esc_html__( 'Item Image Placement', 'gadgeto' ),
				'priority'     => 10,
				'default'      => thebase()->default( $post_type_name . '_archive_item_image_placement' ),
				'context'      => array(
					array(
						'setting' => $post_type_name . '_archive_columns',
						'operator'   => '=',
						'value'   => '1',
					),
				),
				'live_method'     => array(
					array(
						'type'     => 'class',
						'selector' => '.' . $post_type_name . '-archive.grid-cols',
						'pattern'  => 'item-image-style-$',
						'key'      => '',
					),
				),
				'input_attrs'  => array(
					'layout' => array(
						'beside' => array(
							'name' => __( 'Beside', 'gadgeto' ),
						),
						'above' => array(
							'name' => __( 'Above', 'gadgeto' ),
						),
					),
					'responsive' => false,
				),
			),
			$post_type_name . '_archive_item_title_font' => array(
				'control_type' => 'thebase_typography_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Post Item Title Font', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_item_title_font', array(
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
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css_typography',
						'selector' => '.loop-entry.type-' . $post_type_name . ' .entry-title',
						'property' => 'font',
						'key'      => 'typography',
					),
				),
				'input_attrs'  => array(
					'id'             => $post_type_name . '_archive_item_title_font',
					'headingInherit' => true,
				),
			),
			$post_type_name . '_archive_item_meta_color' => array(
				'control_type' => 'thebase_color_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Item Meta Colors', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_item_meta_color', array(
					'color' => '',
					'hover' => '',
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css',
						'selector' => '.loop-entry.type-' . $post_type_name . ' .entry-meta',
						'property' => 'color',
						'pattern'  => '$',
						'key'      => 'color',
					),
					array(
						'type'     => 'css',
						'selector' => '.loop-entry.type-' . $post_type_name . ' .entry-meta a:hover',
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
							'tooltip' => __( 'Link Hover Color', 'gadgeto' ),
							'palette' => true,
						),
					),
				),
			),
			$post_type_name . '_archive_item_meta_font' => array(
				'control_type' => 'thebase_typography_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Item Meta Font', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_item_meta_font', array(
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
				) ),
				'live_method'     => array(
					array(
						'type'     => 'css_typography',
						'selector' => '.loop-entry.type-' . $post_type_name . ' .entry-meta',
						'property' => 'font',
						'key'      => 'typography',
					),
				),
				'input_attrs'  => array(
					'id'      => $post_type_name . '_archive_item_meta_font',
					'options' => 'no-color',
				),
			),
			$post_type_name . '_archive_background' => array(
				'control_type' => 'thebase_background_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Site Background', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_background' ),
				'live_method'     => array(
					array(
						'type'     => 'css_background',
						'selector' => 'body.post-type-archive-' . $post_type_name,
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'base',
					),
				),
				'input_attrs'  => array(
					'tooltip' => __( 'Archive Background', 'gadgeto' ),
				),
			),
			$post_type_name . '_archive_content_background' => array(
				'control_type' => 'thebase_background_control',
				'section'      => $post_type_name . '_archive_design',
				'label'        => esc_html__( 'Content Background', 'gadgeto' ),
				'default'      => thebase()->default( $post_type_name . '_archive_content_background' ),
				'live_method'  => array(
					array(
						'type'     => 'css_background',
						'selector' => 'body.post-type-archive-' . $post_type_name . ' .content-bg, body.post-type-archive-' . $post_type_name . '.content-style-unboxed .site',
						'property' => 'background',
						'pattern'  => '$',
						'key'      => 'base',
					),
				),
				'input_attrs'  => array(
					'tooltip' => __( 'Archive Content Background', 'gadgeto' ),
				),
			),
		);
		Theme_Customizer::add_settings( $thebase_custom_post_type_archive_settings );
		Theme_Customizer::add_settings( $settings );
	}
}

