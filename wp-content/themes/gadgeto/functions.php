<?php
/**
 * TheBase functions and definitions
 *
 * This file must be parseable by PHP 5.2.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thebase
 */

define( 'gadgeto_VERSION', '1.0.0' );
define( 'gadgeto_MINIMUM_WP_VERSION', '5.2' );
define( 'gadgeto_MINIMUM_PHP_VERSION', '7.0' );

// Bail if requirements are not met.
if ( version_compare( $GLOBALS['wp_version'], gadgeto_MINIMUM_WP_VERSION, '<' ) || version_compare( phpversion(), gadgeto_MINIMUM_PHP_VERSION, '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
// Include WordPress shims.
require get_template_directory() . '/inc/wordpress-shims.php';

// Load the `thebase()` entry point function.
require get_template_directory() . '/inc/class-theme.php';

// Load the `thebase()` entry point function.
require get_template_directory() . '/inc/functions.php';

// Custom Function
require get_template_directory() . '/custom/functions.php';

// Initialize the theme.
call_user_func( 'TheBase\thebase' );

function gadgeto_add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
	}
add_filter('upload_mimes', 'gadgeto_add_file_types_to_uploads');