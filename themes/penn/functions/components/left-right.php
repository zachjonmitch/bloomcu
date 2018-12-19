<?php
/**
 * Left Right Content
 *
 * @author Paul Allen
 * @param String $heading
 * @param String|Integer $image ID of the image.
 * @param String $image_position Left or Right.
 * @param String $content_left
 * @param Array $link_left
 * @param String $content_right
 * @param Array $link_right
 * @param Array $modifier_classes
 */

function base_display_left_right_content(
	$image = '',
	$image_position = 'left',
	$content_left = '',
	$link_left = '',
	$content_right = '',
	$link_right = '',
	$modifier_classes = []
	) {
	$modifier_classes  = implode( ' ', $modifier_classes );
	$modifier_classes .= ' c-left-right--layout-' . $image_position; // Append the image modifier class
	?>

	<div class="c-left-right <?php echo esc_attr( $modifier_classes ); ?> ">
		<?php if ( $image ) { ?>
			<div class="c-left-right__image-wrap">
				<div
					class="lazyload c-left-right__image <?php echo esc_attr( "c-left-right__image--$image_position" ); ?>"
					data-bgset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image ) ); ?>"
					data-sizes="auto"
				></div>
			</div>
		<?php } ?>


		<div class="c-left-right__inner">
			<?php if ( $content_left || $link_left ) : ?>
				<div class="c-left-right__content c-left-right__content--left">
					<div class="c-left-right__content-inner c-left-right__content-inner--left wysiwyg-content">
						<?php echo $content_left ?>
						<?php base_display_acf_link( $link_left, [ 'c-left-right__link' ] ); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $content_right || $link_right ) : ?>
				<div class="c-left-right__content c-left-right__content--right">
					<div class="c-left-right__content-inner c-left-right__content-inner--right wysiwyg-content">
						<?php echo $content_right; ?>
						<?php base_display_acf_link( $link_right, [ 'c-left-right__link' ] ); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
}

/**
 * Display ACF Cloned Left Right Content
 */
function base_display_left_right_content_clone(
	$field_name = '',
	$modifier_classes = []
) {

	base_display_left_right_content(
		get_field( $field_name . 'image' ),
		get_field( $field_name . 'image_position' ),
		get_field( $field_name . 'content_left' ),
		get_field( $field_name . 'link_left' ),
		get_field( $field_name . 'content_right' ),
		get_field( $field_name . 'link_right' )
	);

}
