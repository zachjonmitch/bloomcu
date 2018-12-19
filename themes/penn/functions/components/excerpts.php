<?php
/**
* Excerpts
*
* @param String $field_name Clone field prefix, including the proceeding '_'.
* @param Integer $post_id
*/

function base_display_excerpts( $field_name = '', $post_id = false, $title = '' ) {
	// Bail if empty
	if ( ! have_rows( $field_name . 'excerpts', $post_id ) ) {
		return;
	}

	if ( $title ) {
	?>
		<h2 class="c-excerpt__main-title h4 g-l-wrapper h-text-center h-section-spacer"><?php echo $title; ?></h2>
	<?php } ?>

	<div class="l-excerpts-container">
		<ul class="l-excerpts-container__list">
			<?php while ( have_rows( $field_name . 'excerpts', $post_id ) ) : the_row(); ?>
				<?php
					$item_title       = get_sub_field( 'title' );
					$item_description = get_sub_field( 'description' );
					$item_link        = get_sub_field( 'link' );
				?>

				<li class="l-excerpts-container__item">
					<a
						href="<?php echo esc_url( $item_link['url'] ) ?>"
						<?php echo $item_link['target'] ? 'target="_blank" rel="noopener"' : ''; ?>
						class="c-excerpt"
					>
						<?php if ( $item_title ) { ?>
							<h4 class="c-excerpt__title"><?php echo $item_title; ?></h4>
						<?php } ?>

						<?php if ( $item_description ) { ?>
							<p class="c-excerpt__description"><?php echo $item_description; ?></p>
						<?php } ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>

	<?php
}
