<?php

/**
 * Rates Post Type
 */
add_action( 'init', 'base_bank_rates_init' );

function base_bank_rates_init() {
	$labels = array(
		'name'               => 'Tables',
		'singular_name'      => 'Table',
		'menu_name'          => 'Tables',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Table',
		'new_item'           => 'New Table',
		'edit_item'          => 'Edit Table',
		'view_item'          => 'View Table',
		'all_items'          => 'All Tables',
		'search_items'       => 'Search Tables',
		'parent_item_colon'  => '',
		'not_found'          => 'No Tables found.',
		'not_found_in_trash' => 'No Tables found in Trash.',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-editor-table',
		'supports'           => array( 'title', 'custom-fields' )
	);

	register_post_type( 'rate-tables', $args );
}
?>