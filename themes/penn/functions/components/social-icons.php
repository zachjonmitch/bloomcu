<?php
/**
 * Display Social Media
 */
function base_display_social_icons( $modifier_classes = [] ) {
	$classes_default  = [ 'c-social-media' ];
	$classes_merged   = wp_parse_args( $modifier_classes, $classes_default );
	$modifier_classes = implode( ' ', $classes_merged );
	?>

	<ul class="<?php echo esc_attr( $modifier_classes ); ?>">
		<li class="c-social-media__item"><a href="#" class="c-social-media__link" rel="noopener" target="_blank"><span class="fab fa-facebook"></span><span class="h-visual-hide">Follow on Facebook</span></a></li>
		<li class="c-social-media__item"><a href="#" class="c-social-media__link" rel="noopener" target="_blank"><span class="fab fa-google"></span><span class="h-visual-hide">Follow on Google</span></a></li>
		<li class="c-social-media__item"><a href="#" class="c-social-media__link" rel="noopener" target="_blank"><span class="fab fa-twitter"></span><span class="h-visual-hide">Follow on Twitter</span></a></li>
	</ul>
	<?php
}
