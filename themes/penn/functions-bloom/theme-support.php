<?php

// ACF Global Option Pages
if ( function_exists( 'acf_add_options_page' ) ) {

	// Global Options
	acf_add_options_page( array(
		'page_title' => 'Global Website Options',
		'menu_title' => 'Global Options',
		'menu_slug'  => 'website-options',
		'position'   => '30.5',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	) );
}


// Get cookie
if ( ! function_exists( 'getCookie' ) ) {
    function getCookie($cookie_name) {
        if ( !isset($_COOKIE[$cookie_name]) ) {
            return '';
        } else {
               return stripslashes($_COOKIE[$cookie_name]);
        }
    }
}

?>