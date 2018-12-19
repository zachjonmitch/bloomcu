<?php
/**
 * Display Modals
 *
 * @param Mixed Post ID defaults to current post
 *
 * @author Paul Allen
 */
function base_display_modals( $post_id = false ) {

	if ( have_rows( 'off_canvas_panels', $post_id ) ) :
		while ( have_rows( 'off_canvas_panels', $post_id ) ) :
			the_row();

			base_display_modal(
				get_sub_field( 'modal_title' ),
				get_sub_field( 'modal_content' ),
				get_sub_field( 'modal_size' )
			);

		endwhile;
	endif;

}

/**
 * Display Modal
 * @author Paul Allen
 */
function base_display_modal( $title = '', $content = '', $size = 'small' ) {

	$title_hash = strtolower( str_replace( ' ', '-', $title ) );
	?>

	<div
		id="<?php echo esc_attr( $title_hash ); ?>"
		class="c-off-canvas c-off-canvas--<?php echo esc_attr( $size ); ?>"
		data-modal="<?php echo esc_attr( $title_hash ); ?>"
		aria-hidden="true"
	>
		<div class="c-off-canvas__header">
			<button class="c-off-canvas__close" data-close-modal>
				<span class="c-off-canvas__close-icon" data-close-modal></span>
			</button>
		</div>

		<div class="c-off-canvas__content">
			<div class="c-off-canvas__inner">
				<?php echo $content; ?>
			</div>
		</div>
	</div>

	<?php
}
