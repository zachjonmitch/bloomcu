<?php
function cptui_register_my_cpts_faqs() {

	/**
	 * Post Type: FAQs.
	 */

	$labels = array(
		"name" => __( "FAQs", "" ),
		"singular_name" => __( "FAQ", "" ),
	);

	$args = array(
		"label" => __( "FAQs", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "faqs", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor" ),
		"taxonomies" => array( "faq-category" ),
	);

	register_post_type( "faqs", $args );
}

add_action( 'init', 'cptui_register_my_cpts_faqs' );

function cptui_register_my_taxes_faq_cat() {

		$labels = array(
			"name" => __( 'Categories', '' ),
			"singular_name" => __( 'Category', '' ),
		);

		$args = array(
			"label" => __( 'Categories', '' ),
			"labels" => $labels,
			"public" => true,
			"hierarchical" => true,
			"label" => "Categories",
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'faq-category', 'with_front' => true, ),
			"show_admin_column" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"show_in_quick_edit" => true,
		);
		register_taxonomy( "faq-category", array( "faqs" ), $args );
	}

	add_action( 'init', 'cptui_register_my_taxes_faq_cat' );
