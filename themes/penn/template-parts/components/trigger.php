<?php
/**
 * Trigger
 *
 * @package Base
 */

?>

<button class="c-trigger">
	<span class="c-trigger__icon-container">
		<span class="c-trigger__icon"></span>
	</span>

	<span class="c-trigger__text" data-open="<?php esc_attr_e( 'Menu', 'base' ); ?>" data-close="<?php esc_attr_e( 'Close', 'base' ); ?>">
		<?php esc_html_e( 'Menu', 'base' ); ?>
	</span>
</button>
