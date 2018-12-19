<?php
/**
 * Media
 *
 * @package Base
 */

/**
 * Add Image Sizes
 *
 * @example A 1920 x 400 image is in the design. To make the aspect ratio different upload a 1920 x 405.
 * To properly include aspect ratios for the image to appear in the 'srcset' attribute, 3 image sizes should be generated.
 * @see https://andrew.hedges.name/experiments/aspect_ratio/
 * - Large: Size in design.
 * - Medium: 1280 width typically.
 * - Small: 960 width typically.
 *
 * A soft crop should not be used as it will load the full size uncompressed image.
 * @example add_image_size( 'soft', 1920, 400 );
 *
 * @see https://developer.wordpress.org/reference/functions/add_image_size/#user-contributed-notes
 * @author Rich Edmunds
 */
function base_theme_setup_image_size() {
	// Full Page Image
	add_image_size( 'full-page-image-small', 960, 432, true );
	add_image_size( 'full-page-image-medium', 1280, 576, true );
	add_image_size( 'full-page-image-large', 1920, 864, true );

	// Sub Page Hero
	add_image_size( 'sub-page-small', 960, 200, true );
	add_image_size( 'sub-page-medium', 1280, 267, true );
	add_image_size( 'sub-page-large', 1920, 400, true );
}

add_action( 'after_setup_theme', 'base_theme_setup_image_size' );


/**
 * Base Image ACF
 *
 * Return image with proper size and lazyload attributes.
 *
 * @author Rich Edmunds
 *
 * @param array $image ACF image field.
 * @param string $image_size Image size, default medium_large.
 * @param array $classes List of class names, default empty array.
 */
function base_display_image_acf( $image, $image_size = 'medium_large', $classes = [], $lazyload = true ) {
	// Bail early if empty or not an array.
	if ( empty( $image ) || ! is_array( $image ) ) {
		return;
	}

	$image_alt       = $image['alt'] ? $image['alt'] : $image['title']; // Use alt text if set, otherwise use the title
	$image_src       = wp_get_attachment_image_src( $image['id'], 'full' );
	$image_sizes     = wp_get_attachment_image_srcset( $image['id'], $image_size );
	$image_output    = ($image_sizes) ? $image_sizes : $image_src[0];
	$classes_default = ( $lazyload ) ? [ 'lazyload' ] : [];
	$classes_merged  = wp_parse_args( $classes, $classes_default );
	$classes         = implode( ' ', $classes_merged );
	?>
	<img
		src="<?php echo esc_url( THEME_IMAGES ); ?>/blank.png"
		class="<?php echo esc_attr( $classes ); ?>"
		alt="<?php echo esc_attr( $image_alt ); ?>"
		<?php if ( $lazyload ) { ?>
			data-srcset="<?php echo esc_attr( $image_output ); ?>"
			data-sizes="auto"
		<?php } else { ?>
			srcset="<?php echo esc_attr( $image_output ); ?>"
			sizes="auto"
		<?php } ?>
	>
	<?php
}


/**
 * Base Image Background
 * Return attributes lazyload background image.
 *
 * @author Rich Edmunds
 *
 * @param array $image ACF image field.
 * @param string $image_size Image size, default medium_large.
 * @param array $classes List of class names, default empty array.
 */
function base_the_image_background_acf( $image, $image_size = 'medium_large', $classes = [] ) {
	// Bail early if empty or not an array.
	if ( empty( $image ) || ! is_array( $image ) ) {
		return;
	}

	$image_sizes     = wp_get_attachment_image_srcset( $image['id'], $image_size );
	$classes_default = [ 'h-cover-background lazyload' ];
	$classes_merged  = wp_parse_args( $classes, $classes_default );
	$classes         = implode( ' ', $classes_merged );

	// Build / Output attributes
	echo 'class="' . esc_attr( $classes ) . '" data-bgset="' . esc_attr( $image_sizes ) . '" data-sizes="auto"';
}


/**
 * Lazyload Post Content
 * Modifies the content to enable lazy loading for all <img> tags
 */
function base_enable_lazy_loading_the_content( $content ) {
	return base_lazyload_modify_img_tags( $content );
}

add_filter( 'the_content', 'base_enable_lazy_loading_the_content' );


/**
 * Lazyload Post Thumbnails
 * Modifies the post thumbnail html to enable lazy loading for the image
 */
function base_post_thumbnail_html( $html, $post_id, $post_image_id ) {
	return base_lazyload_modify_img_tags( $html );
}

add_filter( 'post_thumbnail_html', 'base_post_thumbnail_html', 10, 3 );


/**
 * Takes a string and modifies any <img> tags within it by:
 * - Adding the class 'lazyload'
 * - Modifying the 'src' attribute
 * - Changes 'srcset' and 'sizes' attributes to data-srcset and data-sizes
 */
function base_lazyload_modify_img_tags( $content ) {
	$content = mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" );

	// Get out if we don't have any content
	if ( empty( $content ) || is_admin() ) {
		return $content;
	}

	$document = new DOMDocument();
	libxml_use_internal_errors( true );
	$document->loadHTML( utf8_decode( $content ) );

	// Grab all image tags
	$imgs = $document->getElementsByTagName( 'img' );

	// Loop through all image tags
	foreach ( $imgs as $img ) {
		$existing_class = $img->getAttribute( 'class' );  // Store existing class (if the image has one applied)
		$src            = $img->getAttribute( 'src' );               // Store src attribute value
		$srcset         = $img->getAttribute( 'srcset' );
		$sizes          = $img->getAttribute( 'sizes' );

		// Add 'lazy' class and the existing class(es) to the image
		$img->setAttribute( 'class', "lazyload $existing_class" );

		// Add new data sizing
		$img->setAttribute( 'data-src', $src );
		$img->setAttribute( 'data-srcset', $srcset );
		$img->setAttribute( 'data-sizes', $sizes );

		// Change Src
		$img->setAttribute( 'src', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' );

		// Remove normal responsive tags
		$img->removeAttribute( 'srcset' );
		$img->removeAttribute( 'sizes' );
	}

	$html = preg_replace( '/^<!DOCTYPE.+?>/', '', str_replace( array(
		'<html>',
		'</html>',
		'<body>',
		'</body>'
	), array( '', '', '', '' ), $document->saveHTML() ) );

	return $html;
}


/**
 * Lazyload iFrames
 * Return a string of the supplied iframe markup that includes lazyload attributes
 *
 * @author Paul Allen
 *
 * @param string $iframe string generated through ACF oembed field
 * @return string
 */
function base_display_lazyload_iframe( $iframe ) {
	// Bail if $iframe is not provided or if $iframe is not a string
	if ( ! $iframe || gettype( $iframe ) !== 'string' ) {
		return false;
	}

	$allow_tags['iframe'] = array(
		'align' => true,
		'width' => false,
		'height' => false,
		'frameborder' => true,
		'name' => true,
		'src' => true,
		'id' => true,
		'class' => true,
		'style' => true,
		'scrolling' => true,
		'marginwidth' => true,
		'marginheight' => true,
	);

	// Santatize $iframe
	$iframe = wp_kses( $iframe, $allow_tags );

	// Inject lazyload attributes
	$iframe = str_replace( 'src', 'class="c-block-video__iframe lazyload" data-src', $iframe );

	echo $iframe; // XSS OK
}

// Increase Max Size Accepted By wp_get_attachment_image_srcset
add_filter( 'max_srcset_image_width', 'max_srcset_image_width', 10 , 2 );

function max_srcset_image_width() {
	return 1930;
}

/**
 * Allow for SVGs in the Media Uploader
 * @link https://codepen.io/chriscoyier/post/wordpress-4-7-1-svg-upload
 */

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function( $data, $file, $filename, $mimes ) {

	$filetype = wp_check_filetype( $filename, $mimes );

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename'],
	];

}, 10, 4 );

function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
