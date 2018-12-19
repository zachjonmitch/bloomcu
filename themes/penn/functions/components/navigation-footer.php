<?php
/**
 * Display Footer Menus
 *
 * @author Rich Edmunds
 *
 * @param string $location The registered nav menu location name.
 */
function base_display_footer_menu( $location ) {
	$menu_location = get_nav_menu_locations();

	// Bail if nav location is not provided or the nav doesn't exist.
	if ( ! $location || ! array_key_exists( $location, $menu_location ) ) {
		return;
	}

	$menu_id   = $menu_location[ $location ];
	$menu_name = wp_get_nav_menu_object( $menu_id )->name;
	?>
	<nav class="g-footer-nav g-footer-nav--desktop">
		<button id="footer-<?php echo esc_attr( $menu_location[ $location ] ); ?>" class="g-footer-nav__trigger"><h6
				class="g-footer-nav__heading"><?php echo esc_html( $menu_name ); ?></h6></button>

		<?php
		wp_nav_menu( array(
			'theme_location'  => esc_html( $location ),
			'menu'            => '',
			'container'       => false,
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => '',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => false,
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul class="g-footer-nav__content">%3$s</ul>',
			'depth'           => 1,
		) );
		?>
	</nav>
	<?php
}
