<?php

// Return page title
function bloomShortcode_page_title( ){
    return get_the_title();
 }
 add_shortcode( 'page-title', 'bloomShortcode_page_title' );

// Return Site name
function bloomShortcode_site_name( ){
    return get_bloginfo('name');
 }
 add_shortcode( 'site-name', 'bloomShortcode_site_name' );