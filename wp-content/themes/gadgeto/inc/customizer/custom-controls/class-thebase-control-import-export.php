<?php
/**
 * The Radio Icon customize control extends the WP_Customize_Control class.
 *
 * @package customizer-controls
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}


/**
 * Class TheBase_Control_Import_Export
 *
 * @access public
 */
class TheBase_Control_Import_Export extends WP_Customize_Control {
	/**
	 * Control type
	 *
	 * @var string
	 */
	public $type = 'thebase_import_export_control';
	/**
	 * Empty Render Function to prevent errors.
	 */
	public function render_content() {
		?>
			<span class="customize-control-title">
				<?php esc_html_e( 'Export', 'gadgeto' ); ?>
			</span>
			<span class="description customize-control-description">
				<?php esc_html_e( 'Click the button below to export the customization settings for this theme.', 'gadgeto' ); ?>
			</span>
			<input type="button" class="button thebase-theme-export thebase-theme-button" name="thebase-theme-export-button" value="<?php esc_attr_e( 'Export', 'gadgeto' ); ?>" />

			<hr class="tb-theme-hr" />

			<span class="customize-control-title">
				<?php esc_html_e( 'Import', 'gadgeto' ); ?>
			</span>
			<span class="description customize-control-description">
				<?php esc_html_e( 'Upload a file to import customization settings for this theme.', 'gadgeto' ); ?>
			</span>
			<div class="thebase-theme-import-controls">
				<input type="file" name="thebase-theme-import-file" class="thebase-theme-import-file" />
				<?php wp_nonce_field( 'thebase-theme-importing', 'thebase-theme-import' ); ?>
			</div>
			<div class="thebase-theme-uploading"><?php esc_html_e( 'Uploading...', 'gadgeto' ); ?></div>
			<input type="button" class="button thebase-theme-import thebase-theme-button" name="thebase-theme-import-button" value="<?php esc_attr_e( 'Import', 'gadgeto' ); ?>" />

			<hr class="tb-theme-hr" />
			<span class="customize-control-title">
				<?php esc_html_e( 'Reset', 'gadgeto' ); ?>
			</span>
			<span class="description customize-control-description">
				<?php esc_html_e( 'Click the button to reset all theme settings.', 'gadgeto' ); ?>
			</span>
			<input type="button" class="components-button is-destructive thebase-theme-reset thebase-theme-button" name="thebase-theme-reset-button" value="<?php esc_attr_e( 'Reset', 'gadgeto' ); ?>" />
			<?php
	}
}