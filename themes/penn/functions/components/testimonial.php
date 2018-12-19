<?php
/**
 * Display Testimonials
 * Extends styles from callout
 *
 * @param String $callout_heading
 * @param String $callout_subheading
 * @param Object $callout_link ACF link Object
 * @param Object $callout_image ACF Image Object
 * @param Array $modifier_classes
 */

function base_display_testimonial(
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

		<blockquote class="c-callout__content">
			<?php if ( $callout_heading ) { ?>
				<p class="c-callout__header"><?php echo $callout_heading; ?></p>
			<?php } ?>

			<?php if ( $callout_subheading ) { ?>
				<cite class="c-callout__sub-header"><?php echo $callout_subheading; ?></cite>
			<?php } ?>

			<?php base_display_acf_link( $callout_link, [ 'c-callout__link', 'button', 'button--light' ] ); ?>
		</blockquote>
	</div>

	<?php
}
