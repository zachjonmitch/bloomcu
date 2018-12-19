<?php
	/**
	 * Post Type: jobs.
	 */
function cptui_register_my_cpts_job() {


	$labels = array(
		"name" => __( 'Job Openings', '' ),
		"singular_name" => __( 'Job', '' ),
		"menu_name" => __( 'Job Posts', '' ),
		"all_items" => __( 'All Jobs', '' ),
	);

	$args = array(
		"label" => __( 'Jobs', '' ),
		"labels" => $labels,
		"description" => "Listing of available jobs",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => "jobs",
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "jobs", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
		"taxonomies" => array( "department" ),
	);

	register_post_type( "jobs", $args );
}

add_action( 'init', 'cptui_register_my_cpts_job' );

	/**
	 * Taxonomy: Departments.
	 */
function cptui_register_my_taxes_department() {

	$labels = array(
		"name" => __( 'Departments', '' ),
		"singular_name" => __( 'Department', '' ),
	);

	$args = array(
		"label" => __( 'Departments', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Departments",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'department', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "department", array( "jobs" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_department' );
