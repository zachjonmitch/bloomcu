<?php
/**
 * Router
 * @param String $field_name
 * @param String $router_title
 * @param Array $modifier_classes
 * @param Integer $post_id
 */

function base_display_router( $field_name = '', $router_title = '', $modifier_classes = [], $post_id = false ) {
	$modifier_classes = implode( ' ', $modifier_classes );
	$router_title     = $router_title ? $router_title : get_field( $field_name . 'router_title', $post_id );

	if ( ! have_rows( $field_name . 'router_items', $post_id ) && ! $router_title ) {
		return;
	}

	?>
	<div class="c-router <?php echo esc_attr( $modifier_classes ); ?>">

		<?php if ( $router_title ) { ?>
			<h2 class="c-router__title h-text-center h2"><?php echo $router_title; ?></h2>
		<?php } ?>

		<?php if ( have_rows( $field_name . 'router_items', $post_id ) ) : ?>

			<ul class="c-router__list ">
				<?php while ( have_rows( $field_name . 'router_items', $post_id ) ) : the_row(); ?>
					<?php
						$item_link = get_sub_field( 'router_item_link' );
					?>

					<li class="c-router__item">
						<a href="<?php echo esc_url( $item_link['url'] ); ?>" class="c-router__card" <?php echo $item_link['target'] ? 'target="_blank" rel="noopener"' : ''; ?>>
							<h3 class="h4 c-router__card-title"><?php echo $item_link['title'] ? $item_link['title'] : 'Learn More'; ?></h3>
						</a>
					</li>
				<?php endwhile; ?>

			</ul>
		<?php endif; ?>

	</div>
	<?php
}
