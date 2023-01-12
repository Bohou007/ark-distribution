<?php
/**
 * TheBase\Woocommerce\Component class
 *
 * @package thebase
 */

// namespace TheBase\Woocommerce;

// use TheBase\Component_Interface;
// use ElementorPro;
// use function TheBase\thebase;
// use function add_action;
// use function add_theme_support;
// use function have_posts;
// use function the_post;
// use function is_search;
// use function get_template_part;
// use function get_post_type;
// use function woocommerce_catalog_ordering;
// use function woocommerce_result_count;
// use WPSEO_Primary_Term;

// Update CSS within in Admin
add_action('wp_enqueue_scripts', 'custom_style');
function custom_style() {
	wp_enqueue_style('custom-styles', get_template_directory_uri().'/assets/custom.css');
	wp_enqueue_style('flex-slider', get_template_directory_uri().'/assets/css/flexslider.css');
	wp_enqueue_style('slick', get_template_directory_uri().'/assets/css/slick.css');	
	wp_enqueue_script( 'tmpmela-script', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array( 'jquery' ), true );	

}
/*Add TGMPA library file */
require get_template_directory() . '/custom/theme-plugins-install.php';

add_theme_support( "wp-block-styles" );
add_theme_support( "custom-logo");
add_theme_support( "custom-header");
add_theme_support( "custom-background");
add_theme_support( 'register_block_style' );
add_theme_support( 'register_block_pattern' );

/* blog excerpt */
if ( ! function_exists( 'gadgeto_blog_post_excerpt' ) ) :
function gadgeto_blog_post_excerpt( $limit ) {
	$excerpt = get_the_content();
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $limit);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	return $excerpt;
}
endif;

if ( ! function_exists( 'gadgeto_sticky_post' ) ) :
	function gadgeto_sticky_post() {
		if ( is_sticky() )
 // translators: %s: Sticky
		echo '<span class="sticky-inner"><span class="sticky-post">'. esc_html__( 'sticky', 'gadgeto' ) . '</span></span>';		
	}
endif;
add_action('thebase_after_loop_entry_meta', 'gadgeto_sticky_post',10);

/* Author link */
if ( ! function_exists( 'gadgeto_author_link' ) ) :
function gadgeto_author_link() {
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<div class="meta-inner by-admin"><span class="author vcard"><i class="fa fa-pencil-square-o"></i><a class="url fn n" href="%1$s" title="%2$s" rel="author">'.esc_html__("by ",'gadgeto').'%3$s</a></span></div>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'gadgeto' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;
/********************************************************
**************** One Click Import Data ******************
********************************************************/
if ( ! function_exists( 'sampledata_import_files' ) ) :
	function sampledata_import_files() {
		return array(
			array(
				'import_file_name'            => 'gadgeto',
				'local_import_file'           => trailingslashit( get_stylesheet_directory() ) . 'custom/one-click/default/gadgeto_wordpress.xml',
				'local_import_customizer_file'=> trailingslashit( get_stylesheet_directory() ) . 'custom/one-click/default/gadgeto_customizer_export.dat',
				'local_import_widget_file'    => trailingslashit( get_stylesheet_directory() ) . 'custom/one-click/default/gadgeto_widgets_settings.wie',
				'import_notice'               => esc_html__( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'gadgeto' ),
			),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'sampledata_import_files' );
	endif;
	if ( ! function_exists( 'sampledata_after_import' ) ) :
	function sampledata_after_import($selected_import) {
		//Set Menu
		$main_menu = get_term_by('name', 'My Menu', 'nav_menu');
		set_theme_mod( 'nav_menu_locations' , array( 
				'primary'   => $main_menu->term_id,
			)
		);
		//Set Front page and blog page
		$page = get_page_by_title( 'Home');
		if ( isset( $page->ID ) ) {
			update_option( 'page_on_front', $page->ID );
			update_option( 'show_on_front', 'page' );
		}
		$post = get_page_by_title( 'Blog');
		if ( isset( $page->ID ) ) {
			update_option( 'page_for_posts', $post->ID );
			update_option( 'show_on_posts', 'post' );
		}
		//Import Revolution Slider
	if ( class_exists( 'RevSlider' ) ) {
		$slider_array = array(
			get_template_directory()."/custom/one-click/default/gadgeto_slider.zip",
		);
		$slider = new RevSlider();
	
		foreach($slider_array as $filepath){
			$slider->importSliderFromPost(true,true,$filepath);  
		}
           echo esc_html__( 'Slider import successfully', 'gadgeto' );
	}				
	}
	add_action( 'pt-ocdi/after_import', 'sampledata_after_import' );
	endif;

	function gadgeto_change_time_of_single_ajax_call() {
		return 180;
	}
	add_action( 'pt-ocdi/time_for_one_ajax_call', 'gadgeto_change_time_of_single_ajax_call' );
	/* remove notice info*/
	add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );