<?php
/*
* BloomCU Loan Status
* -----------------------------
* Version: 1.0.0
* Author: Ryan Harmon
*/

/*
 * Post Type: Loan Status
 */
add_action( 'init', 'bloom_loan_status_init' );

function bloom_loan_status_init() {
	$labels = array(
        'name'                => 'Loan Status',
		'singular_name'       => 'Loan Status',
		'menu_name'           => 'Loan Status',
        'add_new'             => 'Add New',
		'add_new_item'        => 'Add New Loan',
		'new_item'            => 'New Loan',
		'edit_item'           => 'Edit Loan Status',
		'view_item'           => 'View Loan Status',
		'all_items'           => 'All Loans',
		'search_items'        => 'Search Loans',
		'parent_item_colon'   => '',
		'not_found'           => 'No Loans found.',
		'not_found_in_trash'  => 'No Loans found in Trash.',
	);

	$args = array(
		'label'               => 'Loan Status',
		'labels'              => $labels,
		'description'         => 'Loan statuses',
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'rest_base'           => '',
		'has_archive'         => true,
		'show_in_menu'        => true,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => true,
		'rewrite'             => array(
            'slug' => 'loan-status',
            'with_front' => true,
        ),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor' ),
		'taxonomies'          => array( 'department' ),
	);

	register_post_type( 'loan-status', $args );
}

/**
 * Taxonomy: Loan Status Departments
 */
add_action( 'init', 'bloom_loan_status_tax_init' );

function bloom_loan_status_tax_init() {
	$labels = array(
		'name'                => 'Departments',
		'singular_name'       => 'Department',
	);

	$args = array(
		'label'               => 'Departments',
		'labels'              => $labels,
		'public'              => true,
		'hierarchical'        => true,
		'label'               => 'Departments',
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'query_var'           => true,
		'rewrite'             => array(
            'slug' => 'department',
            'with_front' => true,
        ),
		'show_admin_column'   => false,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_quick_edit'  => true,
	);
	register_taxonomy( 'department', array( 'loan-status' ), $args );
}

/**
 * Settings: Loan Status Settings
 * Adds "Loan Status Settings" to Loan Status menu
 * Learn more: http://bit.ly/2vJNh9h
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array (
        'page_title' 	=> 'Loan Status Settings',
        'menu_title' 	=> 'Loan Status Settings',
        'menu_slug' 	=> 'loan-status-settings',
        'capability' 	=> 'edit_posts',
        'position'	=> false,
        'parent_slug'	=> 'edit.php?post_type=loan-status',
    	'icon_url' => false,
        'redirect'	=> false,
    	'post_id' => 'options',
    	'autoload' => false,
    ));
}
