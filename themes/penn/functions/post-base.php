<?php
/**
 * Post
 *
 * @package Base
 */

/**
 * Set Excerpt Length
 *
 * Return the amount of words to display.
 *
 * @author Rich Edmunds
 */
function base_excerpt() {
	return 15;
}

add_filter( 'excerpt_length', 'base_excerpt', 999 );


/**
 * Base Pagination
 *
 * @author Rich Edmunds
 * @see    http://codex.wordpress.org/Function_Reference/paginate_links.
 */
function base_pagination( $query = '' ) {
	global $wp_query;

	// If query is left blank, set to global default wp_query.
	if ( '' === $query ) {
		$query = $wp_query;
	}

	$big = 999999999;

	$args = array(
		'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'             => '/page/%#%',
		'total'              => $query->max_num_pages,
		'current'            => max( 1, get_query_var( 'paged' ) ),
		'show_all'           => false,
		'end_size'           => 1,
		'mid_size'           => 2,
		'prev_next'          => true,
		'prev_text'          => __( '&laquo; Previous', 'base' ),
		'next_text'          => __( 'Next &raquo;', 'base' ),
		'type'               => 'list',
		'add_args'           => false,
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => '',
	);

	echo paginate_links( $args ); // WPCS: XSS OK.
}


/**
 * Base breadcrumbs
 * Simple breadcrumbs function for displaying parent pages.
 * Could be expanded to include categories, dates, ect. if needed.
 *
 * @author Paul Allen
 */
function base_display_page_breadcrumbs() {
	// Bail if on home page
	if ( is_front_page() ) {
		return;
	}

	global $post;

	// Bail if $post does not have the needed properties
	if ( ! property_exists( $post, 'post_title' ) || ! property_exists( $post, 'post_parent' ) ) {
		return;
	}

	$current_page_title = $post->post_title;
	$post_parent = $post->post_parent;
	$breadcrumbs = array();

	while ( $post_parent ) {
		$page       = get_post( $post_parent );
		$page_id    = $page->ID;
		$page_link  = get_permalink( $page_id );
		$page_title = $page->post_title;
		$breadcrumb = [
			'title' => $page_title,
			'url'   => $page_link,
		];
		array_unshift( $breadcrumbs, $breadcrumb ); // Add it to the beginning of the array

		$post_parent = $page->post_parent; // Move up the chain by finding parent post if any
	}
	?>

	<ul class="c-breadcrumbs">
		<li class="c-breadcrumbs__item">
			<a href="<?php echo esc_url( home_url() ); ?>" class="c-breadcrumbs__anchor"><?php esc_html_e( 'Home', 'base' ); ?></a>
		</li>

		<?php foreach ( $breadcrumbs as $link ) : ?>
			<li class="c-breadcrumbs__item">
				<a href="<?php echo esc_url( $link['url'] ); ?>" class="c-breadcrumbs__anchor"><?php echo esc_html( $link['title'] ); ?></a>
			</li>
		<?php endforeach; ?>

		<li class="c-breadcrumbs__item"><?php echo esc_html( $current_page_title ); ?></li>
	</ul>

	<?php
	wp_reset_postdata();
}


/**
 * Modify excerpt read more
 *
 * @author Paul Allen
 */
function base_modify_read_more_link() {
	return '...';
}

add_filter( 'excerpt_more', 'base_modify_read_more_link' );
