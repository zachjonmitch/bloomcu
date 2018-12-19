<?php
/**
 * Content Page Front
 *
 * @package Base
 */

get_template_part( 'template-parts/front-page/hero' );
get_template_part( 'template-parts/front-page/features' );
base_display_quote(
	get_field( 'quote_title' ),
	get_field( 'quote_description' ),
	get_field( 'quote_link' ),
	[ 'c-quote--indent-description' ]
);
get_template_part( 'template-parts/front-page/photo-collage' );
get_template_part( 'template-parts/front-page/statistics' );
base_display_testimonial(
	get_field( 'callout_heading' ),
	get_field( 'callout_subheading' ),
	'',
	'',
	[ 'c-callout--testimonial-home' ]
);
get_template_part( 'template-parts/front-page/callout' );
