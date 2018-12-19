<?php
/**
 * Nav Mega
 *
 * @package Base
 */

wp_nav_menu( array(
	'theme_location'  => 'nav_mega',
	'container'       => false,
	'container_class' => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'depth'           => 3,
	'items_wrap'      => '<ul id="nav-main" class="nav-main">%3$s</ul>',
	'fallback_cb'     => false,
	'walker'          => new Mega_Walker_Nav_Menu(),
) );
