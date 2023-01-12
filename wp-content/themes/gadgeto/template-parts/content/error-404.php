<?php
/**
 * Template part for displaying the page content when a 404 error has occurred
 *
 * @package thebase
 */

namespace TheBase;

?>
<section class="error">
	<div class="page-content entry content-bg">
		<div class="entry-content-wrap">
			<?php
			do_action( 'base_404_before_inner_content' );
			get_template_part( 'template-parts/content/page_header' );
			?>
			<h2>
				<?php esc_html_e( '404', 'gadgeto' ); ?>
			</h2>
			<h3>
				<?php esc_html_e( 'Oh no! Page Not Found', 'gadgeto' ); ?>
			</h3>
			<p>
				<?php esc_html_e( 'It looks like nothing was found at this location. click on site logo to return', 'gadgeto' ); ?><br>
				<?php esc_html_e( 'home page or Maybe try a search?', 'gadgeto' ); ?>
			</p>
			<?php
			get_search_form();
			do_action( 'base_404_after_inner_content' );
			?>
		</div>
	</div><!-- .page-content -->
</section><!-- .error -->
