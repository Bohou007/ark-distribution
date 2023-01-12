<?php
/**
 * Template part for displaying a post
 *
 * @package thebase
 */

namespace TheBase;

?>

<article <?php post_class( 'entry content-bg loop-entry' ); ?>>
	<?php
		/**
		 * Hook for entry thumbnail.
		 *
		 * @hooked TheBase\loop_entry_thumbnail
		 */
		do_action( 'thebase_loop_entry_thumbnail' );
	?>
	<?php		
		 $postImage = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
		?>
	<div class="entry-content-wrap <?php if (empty($postImage)): ?> no-img <?php endif; ?>">
		<?php
		/**
		 * Hook for entry content.
		 *
		 * @hooked TheBase\loop_entry_header - 10
		 * @hooked TheBase\loop_entry_summary - 20
		 * @hooked TheBase\loop_entry_footer - 30
		 */
		do_action( 'thebase_loop_entry_content' );
		?>
	</div>
</article>
