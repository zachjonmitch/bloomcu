<?php
/**
 * Theme Support
 *
 * @package Base
 */

/**
 * Add Theme Support
 */
function base_custom_support() {
	// Localize theme
	load_theme_textdomain( 'base' );

	// Featured Images
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'caption',
	) );

	add_theme_support( 'title-tag' );

	// Automatic Feed Links & Post Formats
	// add_theme_support( 'automatic-feed-links' );
	// Post Formats http://codex.wordpress.org/Post_Formats
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status' ) );
}

add_action( 'after_setup_theme', 'base_custom_support' );


/**
 * Add Page Body CSS Class
 * Add class name of page to the body element.
 *
 * @author Rich Edmunds
 * @param  array $classes The current body classes.
 * @return array $classes Add classes.
 */
function custom_body_classes( $classes ) {
	if ( is_singular( 'page' ) ) {
		global $post;
		$classes[] = 'page-' . $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', 'custom_body_classes' );

// ACF Options Page
// if ( function_exists( 'acf_add_options_page' ) ) {
// 	acf_add_options_page();
// }


/**
 * Loop through and output ACF flexible content blocks for the current page.
 *
 * @author Rich Edmunds
 */
function base_display_content_blocks() {
	if ( have_rows( 'content_blocks' ) ) :
		while ( have_rows( 'content_blocks' ) ) :
			the_row();
			// Template part name MUST match layout ID (Name).
			// @example block-media_section
			get_template_part( 'template-parts/components/block', get_row_layout() );
		endwhile;

		wp_reset_postdata();
	endif;
}


/**
 * Hide ACF Menu on Production
 *
 * @author Rich Edmunds
 */
function base_hide_acf_admin() {
	// Get the current site url
	$site_url = get_bloginfo( 'url' );

	$show_menu = [
		'https://base.test',
	];

	// If the url matches our dev url show the menu.
	if ( in_array( $site_url, $show_menu, true ) ) {
		// Show the acf menu item
		return true;
	} else {
		// Hide the acf menu item
		return false;
	}
}

// add_filter( 'acf/settings/show_admin', 'base_hide_acf_admin' );
