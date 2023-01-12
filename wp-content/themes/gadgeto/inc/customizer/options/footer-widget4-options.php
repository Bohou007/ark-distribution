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
</div>
<?php
$compontent_tabs = ob_get_clean();
$settings        = array(
	'footer_widget4_breaker' => array(
		'control_type' => 'thebase_blank_control',
		'section'      => 'sidebar-widgets-footer4',
		'settings'     => false,
		'priority'     => 5,
		'description'  => $compontent_tabs,
	),
	'footer_widget4_align' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'sidebar-widgets-footer4',
		'label'        => esc_html__( 'Content Align', 'gadgeto' ),
		'priority'     => 5,
		'default'      => thebase()->default( 'footer_widget4_align' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'general',
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'class',
				'selector' => '.footer-widget4',
				'pattern'  => array(
					'desktop' => 'content-align-$',
					'tablet'  => 'content-tablet-align-$',
					'mobile'  => 'content-mobile-align-$',
				),
				'key'      => '',
			),
		),
		'input_attrs'  => array(
			'layout' => array(
				'left'   => array(
					'tooltip'  => __( 'Left Align', 'gadgeto' ),
					'dashicon' => 'editor-alignleft',
				),
				'center' => array(
					'tooltip'  => __( 'Center Align', 'gadgeto' ),
					'dashicon' => 'editor-aligncenter',
				),
				'right'  => array(
					'tooltip'  => __( 'Right Align', 'gadgeto' ),
					'dashicon' => 'editor-alignright',
				),
			),
			'responsive' => true,
		),
	),
	'footer_widget4_vertical_align' => array(
		'control_type' => 'thebase_radio_icon_control',
		'section'      => 'sidebar-widgets-footer4',
		'label'        => esc_html__( 'Content Vertical Align', 'gadgeto' ),
		'priority'     => 5,
		'default'      => thebase()->default( 'footer_widget4_vertical_align' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'general',
			),
		),
		'live_method'  => array(
			array(
				'type'     => 'class',
				'selector' => '.footer-widget4',
				'pattern'  => array(
					'desktop' => 'content-valign-$',
					'tablet'  => 'content-tablet-valign-$',
					'mobile'  => 'content-mobile-valign-$',
				),
				'key'      => '',
			),
		),
		'input_attrs'  => array(
			'layout' => array(
				'top' => array(
					'tooltip' => __( 'Top Align', 'gadgeto' ),
					'icon'    => 'aligntop',
				),
				'middle' => array(
					'tooltip' => __( 'Middle Align', 'gadgeto' ),
					'icon'    => 'alignmiddle',
				),
				'bottom' => array(
					'tooltip' => __( 'Bottom Align', 'gadgeto' ),
					'icon'    => 'alignbottom',
				),
			),
			'responsive' => true,
		),
	),
);

Theme_Customizer::add_settings( $settings );

