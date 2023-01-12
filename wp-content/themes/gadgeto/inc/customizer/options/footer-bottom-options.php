<?php
/**
 * Header Main Row Options
 *
 * @package thebase
 */

namespace TheBase;

use TheBase\Theme_Customizer;
use function TheBase\thebase;

ob_start(); ?>
<div class="thebase-compontent-tabs nav-tab-wrapper wp-clearfix">
	<a href="#" class="nav-tab thebase-general-tab thebase-compontent-tabs-button nav-tab-active" data-tab="general">
		<span><?php esc_html_e( 'General', 'gadgeto' ); ?></span>
	</a>
	<a href="#" class="nav-tab thebase-design-tab thebase-compontent-tabs-button" data-tab="design">
		<span><?php esc_html_e( 'Design', 'gadgeto' ); ?></span>
	</a>
</div>
<?php
$compontent_tabs = ob_get_clean();
Theme_Customizer::add_settings(
	array(
		'footer_bottom_tabs' => array(
			'control_type' => 'thebase_tab_control',
			'section'      => 'footer_bottom',
			'settings'     => false,
			'priority'     => 1,
			'input_attrs'  => array(
				'general' => array(
					'label'  => __( 'General', 'gadgeto' ),
					'target' => 'footer_bottom',
				),
				'design' => array(
					'label'  => __( 'Design', 'gadgeto' ),
					'target' => 'footer_bottom_design',
				),
				'active' => 'general',
			),
		),
		'footer_bottom_tabs_design' => array(
			'control_type' => 'thebase_tab_control',
			'section'      => 'footer_bottom_design',
			'settings'     => false,
			'priority'     => 1,
			'input_attrs'  => array(
				'general' => array(
					'label'  => __( 'General', 'gadgeto' ),
					'target' => 'footer_bottom',
				),
				'design' => array(
					'label'  => __( 'Design', 'gadgeto' ),
					'target' => 'footer_bottom_design',
				),
				'active' => 'design',
			),
		),
		'footer_bottom_contain' => array(
			'control_type' => 'thebase_radio_icon_control',
			'section'      => 'footer_bottom',
			'priority'     => 4,
			'default'      => thebase()->default( 'footer_bottom_contain' ),
			'label'        => esc_html__( 'Container Width', 'gadgeto' ),
			'live_method'  => array(
				array(
					'type'     => 'class',
					'selector' => '.site-bottom-footer-wrap',
					'pattern'  => array(
						'desktop' => 'site-footer-row-layout-$',
						'tablet'  => 'site-footer-row-tablet-layout-$',
						'mobile'  => 'site-footer-row-mobile-layout-$',
					),
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
			),
		),
		'footer_bottom_columns' => array(
			'control_type' => 'thebase_radio_icon_control',
			'section'      => 'footer_bottom',
			'label'        => esc_html__( 'Columns', 'gadgeto' ),
			'priority'     => 5,
			//'transport'    => 'refresh',
			'default'      => thebase()->default( 'footer_bottom_columns' ),
			'partial'      => array(
				'selector'            => '#colophon',
				'container_inclusive' => true,
				'render_callback'     => 'TheBase\footer_markup',
			),
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
					'5' => array(
						'name' => __( '5', 'gadgeto' ),
					),
				),
				'responsive' => false,
				'footer'     => 'bottom',
			),
		),
		'footer_bottom_layout' => array(
			'control_type' => 'thebase_row_control',
			'section'      => 'footer_bottom',
			'label'        => esc_html__( 'Layout', 'gadgeto' ),
			'priority'     => 5,
			//'transport'    => 'refresh',
			'default'      => thebase()->default( 'footer_bottom_layout' ),
			'live_method'     => array(
				array(
					'type'     => 'class',
					'selector' => '.site-top-footer-inner-wrap',
					'pattern'  => array(
						'desktop' => 'site-footer-row-column-layout-$',
						'tablet'  => 'site-footer-row-tablet-column-layout-$',
						'mobile'  => 'site-footer-row-mobile-column-layout-$',
					),
					'key'      => '',
				),
			),
			'input_attrs'  => array(
				'responsive' => true,
				'footer'     => 'bottom',
			),
		),
		'footer_bottom_collapse' => array(
			'control_type' => 'thebase_radio_icon_control',
			'section'      => 'footer_bottom',
			'priority'     => 5,
			'default'      => thebase()->default( 'footer_bottom_collapse' ),
			'label'        => esc_html__( 'Row Collapse', 'gadgeto' ),
			'context'      => array(
				array(
					'setting'  => '__device',
					'operator' => 'in',
					'value'    => array( 'tablet', 'mobile' ),
				),
			),
			'live_method'     => array(
				array(
					'type'     => 'class',
					'selector' => '.site-bottom-footer-inner-wrap',
					'pattern'  => 'ft-ro-collapse-$',
					'key'      => '',
				),
			),
			'input_attrs'  => array(
				'layout' => array(
					'normal' => array(
						'name'    => __( 'Left to Right', 'gadgeto' ),
						'icon'    => '',
					),
					'rtl' => array(
						'name'    => __( 'Right to Left', 'gadgeto' ),
						'icon'    => '',
					),
				),
				'responsive' => false,
				'footer'     => 'bottom',
			),
		),
		'footer_bottom_direction' => array(
			'control_type' => 'thebase_radio_icon_control',
			'section'      => 'footer_bottom',
			'priority'     => 5,
			'default'      => thebase()->default( 'footer_bottom_direction' ),
			'label'        => esc_html__( 'Column Direction', 'gadgeto' ),
			'context'      => array(
				array(
					'setting' => '__current_tab',
					'value'   => 'general',
				),
			),
			'live_method'     => array(
				array(
					'type'     => 'class',
					'selector' => '.site-bottom-footer-inner-wrap',
					'pattern'  => array(
						'desktop' => 'ft-ro-dir-$',
						'tablet'  => 'ft-ro-t-dir-$',
						'mobile'  => 'ft-ro-m-dir-$',
					),
					'key'      => '',
				),
			),
			'input_attrs'  => array(
				'layout' => array(
					'row' => array(
						'tooltip' => __( 'Left to Right', 'gadgeto' ),
						'name'    => __( 'Row', 'gadgeto' ),
						'icon'    => '',
					),
					'column' => array(
						'tooltip' => __( 'Top to Bottom', 'gadgeto' ),
						'name'    => __( 'Column', 'gadgeto' ),
						'icon'    => '',
					),
				),
				'responsive' => true,
				'footer'     => 'bottom',
			),
		),
		'footer_bottom_column_spacing' => array(
			'control_type' => 'thebase_range_control',
			'section'      => 'footer_bottom',
			'priority'     => 5,
			'label'        => esc_html__( 'Column Spacing', 'gadgeto' ),
			'context'      => array(
				array(
					'setting' => '__current_tab',
					'value'   => 'general',
				),
			),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'property' => 'grid-column-gap',
					'selector' => '#colophon .site-bottom-footer-inner-wrap',
					'pattern'  => '$',
					'key'      => 'size',
				),
				array(
					'type'     => 'css',
					'property' => 'grid-row-gap',
					'selector' => '#colophon .site-bottom-footer-inner-wrap',
					'pattern'  => '$',
					'key'      => 'size',
				),
			),
			'default'      => thebase()->default( 'footer_bottom_column_spacing' ),
			'input_attrs'  => array(
				'min'     => array(
					'px'  => 0,
					'em'  => 0,
					'rem' => 0,
				),
				'max'     => array(
					'px'  => 200,
					'em'  => 8,
					'rem' => 8,
				),
				'step'    => array(
					'px'  => 1,
					'em'  => 0.01,
					'rem' => 0.01,
				),
				'units'   => array( 'px', 'em', 'rem' ),
			),
		),
		'footer_bottom_widget_spacing' => array(
			'control_type' => 'thebase_range_control',
			'section'      => 'footer_bottom',
			'priority'     => 5,
			'label'        => esc_html__( 'Widget Spacing', 'gadgeto' ),
			'context'      => array(
				array(
					'setting' => '__current_tab',
					'value'   => 'general',
				),
			),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'property' => 'margin-block-end',
					'selector' => '.site-bottom-footer-inner-wrap .widget',
					'pattern'  => '$',
					'key'      => 'size',
				),
			),
			'default'      => thebase()->default( 'footer_bottom_widget_spacing' ),
			'input_attrs'  => array(
				'min'     => array(
					'px'  => 0,
					'em'  => 0,
					'rem' => 0,
				),
				'max'     => array(
					'px'  => 200,
					'em'  => 8,
					'rem' => 8,
				),
				'step'    => array(
					'px'  => 1,
					'em'  => 0.01,
					'rem' => 0.01,
				),
				'units'   => array( 'px', 'em', 'rem' ),
			),
		),
		'footer_bottom_top_spacing' => array(
			'control_type' => 'thebase_range_control',
			'section'      => 'footer_bottom',
			'priority'     => 5,
			'label'        => esc_html__( 'Top Spacing', 'gadgeto' ),
			'context'      => array(
				array(
					'setting' => '__current_tab',
					'value'   => 'general',
				),
			),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '#colophon .site-bottom-footer-inner-wrap',
					'pattern'  => '$',
					'property' => 'padding-block-start',
					'key'      => 'size',
				),
			),
			'default'      => thebase()->default( 'footer_bottom_top_spacing' ),
			'input_attrs'  => array(
				'min'     => array(
					'px'  => 0,
					'em'  => 0,
					'rem' => 0,
				),
				'max'     => array(
					'px'  => 200,
					'em'  => 8,
					'rem' => 8,
				),
				'step'    => array(
					'px'  => 1,
					'em'  => 0.01,
					'rem' => 0.01,
				),
				'units'   => array( 'px', 'em', 'rem' ),
			),
		),
		'footer_bottom_bottom_spacing' => array(
			'control_type' => 'thebase_range_control',
			'section'      => 'footer_bottom',
			'priority'     => 5,
			'label'        => esc_html__( 'Bottom Spacing', 'gadgeto' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '#colophon .site-bottom-footer-inner-wrap',
					'pattern'  => '$',
					'property' => 'padding-block-end',
					'key'      => 'size',
				),
			),
			'default'      => thebase()->default( 'footer_bottom_bottom_spacing' ),
			'input_attrs'  => array(
				'min'     => array(
					'px'  => 0,
					'em'  => 0,
					'rem' => 0,
				),
				'max'     => array(
					'px'  => 200,
					'em'  => 8,
					'rem' => 8,
				),
				'step'    => array(
					'px'  => 1,
					'em'  => 0.01,
					'rem' => 0.01,
				),
				'units'   => array( 'px', 'em', 'rem' ),
			),
		),
		'footer_bottom_height' => array(
			'control_type' => 'thebase_range_control',
			'section'      => 'footer_bottom',
			'priority'     => 5,
			'label'        => esc_html__( 'Min Height', 'gadgeto' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '#colophon .site-bottom-footer-inner-wrap',
					'pattern'  => '$',
					'property' => 'min-height',
					'key'      => 'size',
				),
			),
			'default'      => thebase()->default( 'footer_bottom_height' ),
			'input_attrs'  => array(
				'min'     => array(
					'px'  => 10,
					'em'  => 1,
					'rem' => 1,
					'vh'  => 2,
				),
				'max'     => array(
					'px'  => 400,
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
		'footer_bottom_widget_title' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'footer_bottom_design',
			'label'        => esc_html__( 'Widget Titles', 'gadgeto' ),
			'default'      => thebase()->default( 'footer_bottom_widget_title' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => '.site-bottom-footer-wrap .site-footer-row-container-inner .widget-title',
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
				'id' => 'footer_bottom_widget_title',
			),
		),
		'footer_bottom_widget_content' => array(
			'control_type' => 'thebase_typography_control',
			'section'      => 'footer_bottom_design',
			'label'        => esc_html__( 'Widget Content', 'gadgeto' ),
			'default'      => thebase()->default( 'footer_bottom_widget_content' ),
			'live_method'     => array(
				array(
					'type'     => 'css_typography',
					'selector' => '.site-bottom-footer-wrap .site-footer-row-container-inner',
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
				'id' => 'footer_bottom_widget_content',
			),
		),
		'footer_bottom_link_colors' => array(
			'control_type' => 'thebase_color_control',
			'section'      => 'footer_bottom_design',
			'label'        => esc_html__( 'Link Colors', 'gadgeto' ),
			'default'      => thebase()->default( 'footer_bottom_link_colors' ),
			'live_method'     => array(
				array(
					'type'     => 'css',
					'selector' => '.site-footer .site-bottom-footer-wrap .site-footer-row-container-inner a:not(.button)',
					'property' => 'color',
					'pattern'  => '$',
					'key'      => 'color',
				),
				array(
					'type'     => 'css',
					'selector' => '.site-footer .site-bottom-footer-wrap .site-footer-row-container-inner a:not(.button):hover',
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
		'footer_bottom_link_style' => array(
			'control_type' => 'thebase_select_control',
			'section'      => 'footer_bottom_design',
			'default'      => thebase()->default( 'footer_bottom_link_style' ),
			'label'        => esc_html__( 'Link Style', 'gadgeto' ),
			'input_attrs'  => array(
				'options' => array(
					'plain' => array(
						'name' => __( 'Underline on Hover', 'gadgeto' ),
					),
					'normal' => array(
						'name' => __( 'Underline', 'gadgeto' ),
					),
					'noline' => array(
						'name' => __( 'No Underline', 'gadgeto' ),
					),
				),
			),
			'live_method'     => array(
				array(
					'type'     => 'class',
					'selector' => '.site-bottom-footer-inner-wrap',
					'pattern'  => 'ft-ro-lstyle-$',
					'key'      => '',
				),
			),
		),
		'footer_bottom_background' => array(
			'control_type' => 'thebase_background_control',
			'section'      => 'footer_bottom_design',
			'label'        => esc_html__( 'Bottom Row Background', 'gadgeto' ),
			'default'      => thebase()->default( 'footer_bottom_background' ),
			'live_method'     => array(
				array(
					'type'     => 'css_background',
					'selector' => '.site-bottom-footer-wrap .site-footer-row-container-inner',
					'property' => 'background',
					'pattern'  => '$',
					'key'      => 'base',
				),
			),
			'input_attrs'  => array(
				'tooltip'  => __( 'Bottom Row Background', 'gadgeto' ),
			),
		),
		'footer_bottom_column_border' => array(
			'control_type' => 'thebase_border_control',
			'section'      => 'footer_bottom_design',
			'label'        => esc_html__( 'Column Border', 'gadgeto' ),
			'default'      => thebase()->default( 'footer_bottom_column_border' ),
			'live_method'     => array(
				array(
					'type'     => 'css_border',
					'selector' => '.site-bottom-footer-inner-wrap .site-footer-section:not(:last-child):after',
					'pattern'  => '$',
					'property' => 'border-right',
					'pattern'  => '$',
					'key'      => 'border',
				),
			),
		),
		'footer_bottom_border' => array(
			'control_type' => 'thebase_borders_control',
			'section'      => 'footer_bottom_design',
			'label'        => esc_html__( 'Border', 'gadgeto' ),
			'default'      => thebase()->default( 'footer_bottom_border' ),
			'settings'     => array(
				'border_top'    => 'footer_bottom_top_border',
				'border_bottom' => 'footer_bottom_bottom_border',
			),
			'live_method'     => array(
				'footer_bottom_top_border' => array(
					array(
						'type'     => 'css_border',
						'selector' => array(
							'desktop' => '.site-bottom-footer-wrap .site-footer-row-container-inner',
							'tablet'  => '.site-bottom-footer-wrap .site-footer-row-container-inner',
							'mobile'  => '.site-bottom-footer-wrap .site-footer-row-container-inner',
						),
						'pattern'  => array(
							'desktop' => '$',
							'tablet'  => '$',
							'mobile'  => '$',
						),
						'property' => 'border-top',
						'pattern'  => '$',
						'key'      => 'border',
					),
				),
				'footer_bottom_bottom_border' => array( 
					array(
						'type'     => 'css_border',
						'selector' => array(
							'desktop' => '.site-bottom-footer-wrap .site-footer-row-container-inner',
							'tablet'  => '.site-bottom-footer-wrap .site-footer-row-container-inner',
							'mobile'  => '.site-bottom-footer-wrap .site-footer-row-container-inner',
						),
						'pattern'  => array(
							'desktop' => '$',
							'tablet'  => '$',
							'mobile'  => '$',
						),
						'property' => 'border-bottom',
						'pattern'  => '$',
						'key'      => 'border',
					),
				),
			),
		),
	)
);
