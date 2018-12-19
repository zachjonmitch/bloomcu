<?php
/**
 * Enqueue
 *
 * @package Base
 */

/**
 * Enqueue Styles / Scripts
 */
function base_theme_styles_and_scripts() {
	// Styles
	wp_enqueue_style( 'base', THEME_CSS . '/base.css' );

	// Scripts
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1', false );

	// AJAX Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'base', THEME_JS . '/base.js', array(), null, true );
	wp_enqueue_script( 'polyfill-io', 'https://cdn.polyfill.io/v2/polyfill.min.js', [] );

	wp_deregister_script( 'font-awesome' ); // Deregister if used by another plugin.
	wp_enqueue_script( 'font-awesome', THEME_JS . '/all.min.js', [], '5.2.0', true );
}

add_action( 'wp_enqueue_scripts', 'base_theme_styles_and_scripts', 99 );

/**
 * Add attribute "defer".
 */
function base_add_attribute_defer( $tag, $handle ) {
	// Bail early if not font awesome script.
	if ( 'font-awesome' !== $handle ) {
		return $tag;
	}

	return str_replace( ' src', ' defer src', $tag );
}

add_filter( 'script_loader_tag', 'base_add_attribute_defer', 10, 2 );
