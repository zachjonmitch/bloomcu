<?php
/**
 * Register
 *
 * @package Base
 */

register_nav_menus(
	array(
		'nav_mega'     => esc_html__( 'Mega Navigation', 'base' ),
		'nav_footer_1' => esc_html__( 'Footer Navigation 1', 'base' ),
		'nav_footer_2' => esc_html__( 'Footer Navigation 2', 'base' ),
		'nav_footer_3' => esc_html__( 'Footer Navigation 3', 'base' ),
	)
);


/**
 * Register Sidebar Widgets
 */
function base_sidebar_widgets() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'base' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Drag widgets to this sidebar container.', 'base' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'base_sidebar_widgets' );
