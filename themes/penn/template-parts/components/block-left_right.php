<?php
/**
* Left Right Content Block
*
* @package Base
*/

base_display_left_right_content(
	get_sub_field( 'image' ),
	get_sub_field( 'image_position' ),
	get_sub_field( 'content_left' ),
	get_sub_field( 'link_left' ),
	get_sub_field( 'content_right' ),
	get_sub_field( 'link_right' )
);
