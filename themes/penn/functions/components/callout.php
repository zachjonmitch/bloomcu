<?php
/**
 * Display Callout
 *
 * @param String $callout_heading
 * @param String $callout_subheading
 * @param Object $callout_link ACF link Object
 * @param Object $callout_image ACF Image Object
 * @param Array $modifier_classes
 */

function base_display_callout(
	$callout_heading = '',
	$callout_subheading = '',
	$callout_link = '',
	$callout_image = '',
	$modifier_classes = []
	) {

	if ( ! $callout_heading && ! $callout_subheading ) {
		return;
	}

	$classes_default = [ 'c-callout' ];
	$classes_merged  = wp_parse_args( $modifier_classes, $classes_default );
	$classes_merged  = implode( ' ', $classes_merged );

	?>
	<div class="<?php echo esc_attr( $classes_merged ); ?>">
		<?php if ( $callout_image ) { ?>
			<div <?php base_the_image_background_acf( $callout_image, 'medium', [ 'h-cover-media', 'c-callout__background' ] ); ?> ></div>
			<div class="c-callout__overlay h-cover-media"></div>
		<?php } ?>

		<div class="c-callout__content">
			<?php if ( $callout_heading ) { ?>
				<h2 class="c-callout__header"><?php echo $callout_heading; ?></h2>
			<?php } ?>

			<?php if ( $callout_subheading ) { ?>
				<p class="c-callout__sub-header"><?php echo $callout_subheading; ?></p>
			<?php } ?>

			<?php base_display_acf_link( $callout_link, [ 'c-callout__link', 'button', 'button--light' ] ); ?>
		</div>
	</div>

	<?php
}

/**
 * Display Callout Clone
 *
 * @param String $field_name Prefix name including the underscore.
 * @param Array $modifier_classes
 * @param Integer $post_id Supply post ID if used outside the loop.
 */

function base_display_callout_clone( $field_name = '', $modifier_classes = [], $post_id = false ) {
	base_display_callout(
		get_field( $field_name . 'callout_heading', $post_id ),
		get_field( $field_name . 'callout_subheading', $post_id ),
		get_field( $field_name . 'callout_link', $post_id ),
		get_field( $field_name . 'callout_image', $post_id ),
		$modifier_classes
	);
}
