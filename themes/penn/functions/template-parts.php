<?php
/**
 * Template Parts
 *
 * Place template functions for theme.
 *
 * @package Base
 */

/**
 * Hero Content
 *
 * @author Rich Edmunds
 * @param string $title Main heading title.
 */
function base_display_hero_content( $title = '' ) {
	// Bail early if not a string.
	if ( ! is_string( $title ) ) {
		return;
	}

	$page_hero_image = get_field( 'page_hero_image' );
	$page_title      = get_field( 'page_title' );
	$page_sub_title  = get_field( 'page_sub_title' );
	$page_link       = get_field( 'page_link' );

	// Set a hero fallback image.
	$page_hero_image = $page_hero_image ? $page_hero_image : get_field( 'global_hero_image', 'options' );

	// Is title set in the function, use it, else use the ACF field, fallback to the post title.
	$title = $title ? $title : ( $page_title ? $page_title : get_the_title() );

	// Get the page link name.
	$link_id    = url_to_postid( $page_link );
	$link_title = get_the_title( $link_id );
	?>
	<div class="g-page-header">
		<?php base_display_image_acf( $page_hero_image, 'sub-page-small', [ 'h-cover-media', 'g-page-header__background' ], false ); ?>

		<div class="g-l-wrapper g-page-header__content">
			<h1><?php echo esc_html( $title ); ?></h1>

			<?php if ( $page_sub_title ) : ?>
				<h2><?php echo esc_html( $page_sub_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $page_link ) : ?>
				<a href="<?php echo esc_url( $page_link ); ?>" class="button"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * Base Display acf link
 * Shows an acf link if able
 * @param Array $link the link options returned by ACF.
 * @param String $content_after content to proceed link title, don't pass user input content.
 * @param Array $classes Additional classes.
 */
function base_display_acf_link( $link, $classes = [], $content_after = '' ) {
	if ( empty( $link ) || ! is_array( $link ) ) {
		return;
	}

	$classes_default = [];
	$classes_merged  = wp_parse_args( $classes, $classes_default );
	$classes         = implode( ' ', $classes_merged );

	if ( $link ) :
		?>
			<a
				href="<?php echo esc_url( $link['url'] ); ?>"
				<?php echo $link['target'] ? 'target="_blank" rel="noopener"' : ''; ?>
				class="<?php echo esc_attr( $classes ); ?>"
			>
				<?php echo esc_html( $link['title'] ); ?>
				<span><?php echo $content_after; //XSS OK ?></span>
			</a>
		<?php
	endif;
}
