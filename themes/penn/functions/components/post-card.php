<?php
/**
 * Post Card
 * Used to display posts in the loop
 * Can be used outside of the loop if a post id is provided
 * @param Integer $post_id
 * @param Array $modifier_classes
 * @author Paul Allen
 */

function base_display_post_card( $post_id = 0, $modifier_classes = [] ) {
	if ( gettype( $post_id ) !== 'integer' || gettype( $modifier_classes ) !== 'array' ) {
		return;
	}

	// Get id from the loop if not provided
	// Bail if not in the loop
	if ( ! $post_id ) {
		$post_id = get_the_id();
	}

	$post_image_id    = get_post_thumbnail_id( $post_id );
	$category         = get_the_category( $post_id );
	$modifier_classes = implode( ' ', $modifier_classes );
	?>

	<a
		href="<?php echo esc_url( get_the_permalink( $post_id ) ); ?>"
		class="c-post-card <?php echo esc_attr( $modifier_classes ); ?>"
		data-observe-resizes
	>
		<div class="c-post-card__content">
			<p class="c-post-card__category"><?php echo $category ? esc_html( $category[0]->name ) : ''; ?></p>
			<h3 class="c-post-card__title"><?php echo get_the_title( $post_id ); ?></h3>
		</div>

		<?php if ( $post_image_id ) { ?>
			<div
				class="c-post-card__image h-cover-media h-cover-background lazyload"
				data-bgset="<?php echo esc_attr( wp_get_attachment_image_srcset( $post_image_id, 'medium' ) ); ?>"
				data-sizes="auto"
			>
			</div>

			<div class="c-post-card__overlay h-cover-media"></div>
		<?php } ?>
	</a>

	<?php
}
