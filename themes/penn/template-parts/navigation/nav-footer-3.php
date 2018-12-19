<?php
/**
 * Nav Footer
 *
 * @package Base
 */

wp_nav_menu( array(
	'theme_location'  => 'nav_footer_3',
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
	'items_wrap'      => '<ul>%3$s</ul>',
	'depth'           => 1,
) );
