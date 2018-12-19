<?php
/**
 * Enqueue
 *
 * @package Base
 */

/**
 * Enqueue Styles / Scripts
 */
function bloomio_theme_styles_and_scripts() {
	// Styles
	// wp_enqueue_style( 'bloomio', THEME_CSS . '/bloomio.css' );

	// Scripts
	// wp_deregister_script( 'jquery' );
	// wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1', false );

    
	
	wp_enqueue_script( 'jscookies', THEME_SRC_JS . '/bloomio/vendor/js.cookies.js', array(), null, true );
	
	wp_enqueue_script( 'accruejs', THEME_SRC_JS . '/bloomio/vendor/accrue.js', array(), null, true );
	
	wp_enqueue_script( 'clientjs', THEME_SRC_JS . '/bloomio/vendor/client.min.js', array(), null, true );

	wp_enqueue_script( 'algolia', THEME_SRC_JS . '/bloomio/vendor/instantsearch.js', array(), null, true );	

	wp_enqueue_script( 'bloomio', THEME_JS . '/bloomio.js', [], null, true );
}

add_action( 'wp_enqueue_scripts', 'bloomio_theme_styles_and_scripts' );
