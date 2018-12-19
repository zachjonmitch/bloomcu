<?php

/**
 * Quizzes Post Type
 *
 * @author Rich Edmunds
 */
function base_quizzes_init() {
	$labels_quiz = [
		'name'               => __( 'Quizzes', 'base' ),
		'singular_name'      => __( 'Quiz', 'base' ),
		'menu_name'          => __( 'Quizzes', 'base' ),
		'add_new'            => __( 'Add New', 'base' ),
		'add_new_item'       => __( 'Add New Quiz', 'base' ),
		'new_item'           => __( 'New Quiz', 'base' ),
		'edit_item'          => __( 'Edit Quiz', 'base' ),
		'view_item'          => __( 'View Quiz', 'base' ),
		'all_items'          => __( 'All Quizzes', 'base' ),
		'search_items'       => __( 'Search Quizzes', 'base' ),
		'parent_item_colon'  => '',
		'not_found'          => __( 'No Quizzes found.', 'base' ),
		'not_found_in_trash' => __( 'No Quizzes found in Trash.', 'base' ),
	];

	$args_quiz = [
		'labels'             => $labels_quiz,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-welcome-learn-more',
		'supports'           => [ 'title', 'editor' ],
	];

	register_post_type( 'quizzes', $args_quiz );
}

add_action( 'init', 'base_quizzes_init' );


/**
 * Quiz
 *
 * @author Rich Edmunds
 * @param integer $page_id Page ID.
 * @param string $css_modifier BEM class modifier.
 */
function base_quiz_module( $page_id = '', $css_modifier = '' ) {
	global $post;

	// Bail if modifier isn't a string.
	if ( ! is_string( $css_modifier ) ) {
		return;
	}

	$quiz = get_field( 'product_fit_quiz' );

	if ( $page_id ) {
		$quiz = get_field( 'product_fit_quiz', $page_id );
	}

	// Baily early.
	if ( ! $quiz ) {
		return;
	}

	// Setup post data.
	$post = $quiz;
	setup_postdata( $post );
	?>
	<div class="c-quiz c-quiz--<?php echo esc_attr( $css_modifier ); ?>">
		<h3 class="h3"><?php the_title(); ?></h3>

		<?php the_content(); ?>
	</div>
	<?php
	wp_reset_postdata();
}


function base_get_quiz_module( $page_id = '' ) {
	ob_start();

	base_quiz_module( $page_id );

	return ob_get_clean();
}

?>