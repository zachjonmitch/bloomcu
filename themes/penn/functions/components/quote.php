<?php
/**
* Display The Quote Block
*
* @package Base
*/

function base_display_quote(
	$title = '',
	$description = '',
	$link = '',
	$modifiers = []
) {
	// Bail if all are empty
	if ( ! $title && ! $description && ! $link ) {
		return;
	}

	$modifier_classes = implode( $modifiers, ' ' );

	?>
		<div class="c-quote <?php echo esc_attr( $modifier_classes ); ?>">
			<?php if ( $title ) { ?>
				<h2 class="c-quote__title">
					<span class="js-box-deco"><?php echo $title; ?></span>
				</h2>
			<?php } ?>

			<?php if ( $description ) { ?>
				<div class="c-quote__description-wrapper">
					<p class="c-quote__description"><?php echo $description; ?></p>
				</div>
			<?php } ?>

			<div class="c-quote__link-wrapper">
				<?php base_display_acf_link( $link, [ 'c-quote__link', 'button' ] ); ?>
			</div>
		</div>
	<?php
}
