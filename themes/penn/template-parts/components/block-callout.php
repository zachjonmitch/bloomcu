<?php
/**
* Callout Block
*
* @package Base
*/

base_display_callout(
	get_sub_field( 'callout_heading' ),
	get_sub_field( 'callout_subheading' ),
	get_sub_field( 'callout_link' ),
	get_sub_field( 'callout_image' ),
	[ get_sub_field( 'version' ) ]
);
