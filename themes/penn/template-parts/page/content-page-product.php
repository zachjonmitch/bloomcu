<?php
/**
 * Content Page Product
 *
 * @package Base
*/
get_template_part( 'template-parts/product-page/hero' );

base_display_quote(
	get_field( 'quote_title' ),
	get_field( 'quote_description' ),
	get_field( 'quote_link' )
);

get_template_part( 'template-parts/product-page/info' );

base_display_testimonial(
	get_field( 'product_testimonial_callout_heading' ),
	get_field( 'product_testimonial_callout_subheading' ),
	'',
	get_field( 'product_testimonial_callout_image' ),
	[ 'c-callout--testimonial' ]
);

base_display_callout(
	get_field( 'product_cta_callout_heading' ),
	get_field( 'product_cta_callout_subheading' ),
	get_field( 'product_cta_callout_link' ),
	get_field( 'product_cta_callout_image' ),
	[ 'c-callout--skew-bottom', 'c-callout--margin-bottom' ]
);

base_display_excerpts(
	'',
	false,
	get_field( 'excerpts_title' )
);

get_template_part( 'template-parts/components/block-accordion' );
