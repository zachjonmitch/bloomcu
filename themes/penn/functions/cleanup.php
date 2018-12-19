<?php
/**
 * Clean Up
 *
 * @package Base
 */

/**
 * Start WordPress Clean Up
 */
function base_start_cleanup() {
	add_action( 'init', 'base_cleanup_head' );
	add_filter( 'the_generator', 'base_remove_rss_version' );
	add_filter( 'wp_head', 'base_remove_wp_widget_recent_comments_style', 1 );
	add_action( 'wp_head', 'base_remove_recent_comments_style', 1 );
	add_filter( 'base_gallery_style', 'base_gallery_style' );
	add_filter( 'embed_oembed_html', 'base_embed', 99, 4 );
	add_filter( 'the_content', 'base_wp_image_output', 12, 1 );
}

add_action( 'after_setup_theme', 'base_start_cleanup' );


/**
 * Header Clean Up
 */
function base_cleanup_head() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	add_filter( 'style_loader_src', 'base_remove_wp_ver_css_js', 9999 );
	add_filter( 'script_loader_src', 'base_remove_wp_ver_css_js', 9999 );
}


/**
 * Remove Version From RSS
 */
function base_remove_rss_version() {
	return '';
}


/**
 * Remove Version From Scripts
 */
function base_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}


/**
 * Remove CSS From Comments
 */
function base_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}


/**
 * Remove CSS From Comments Widget
 */
function base_remove_recent_comments_style() {
	global $wp_widget_factory;

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action(
			'wp_head',
			array(
				$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
				'recent_comments_style',
			)
		);
	}
}


/**
 * Remove Inline CSS From Gallery
 *
 * @param string $css CSS.
 */
function base_gallery_style( $css ) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/**
 * Wrap Video Embeds
 *
 * @param string $html Markup.
 */
function base_embed( $html ) {
	return '<div class="responsive-embed widescreen">' . $html . '</div>';
}


/**
 * Customize Image Output
 *
 * @param string $html Markup.
 */
function base_wp_image_output( $html ) {
	$regex = '#((<\s*figure[^>]*?>)(.*?))?((<\s*a\s[^>]*?>)(.*?))?((<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>))((.*?)(</a>))?((.*?)(</figure>))?#i';
	$html  = preg_replace_callback( $regex, 'base_image_wrap_regex_callback', $html );

	return $html;
}


/**
 * Customize Image Wrap
 *
 * @param string $matches Regex.
 */
function base_image_wrap_regex_callback( $matches ) {
	$full_match = $matches[0];
	$the_figure = $matches[2];
	$the_img = $matches[7];
	$the_img_src = $matches[9];

	$updated_image = str_replace( $the_img_src, $the_img_src, $the_img );

	if ( empty( $the_figure ) ) {
		$full_match = sprintf( '<figure class="wp-image-wrap">%s</figure>', $full_match );
	}

	return str_replace( $the_img, $updated_image, $full_match );
}
