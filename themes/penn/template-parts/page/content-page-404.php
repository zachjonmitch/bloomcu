<?php
/**
 * Content Page 404
 *
 * @package Base
 */

?>

<div class="g-l-wrapper">
	<div id="page-<?php the_ID(); ?>" <?php post_class( 'wysiwyg-content' ); ?>>
		<p><?php esc_html_e( 'The page your looking for does not exist!', 'base' ); ?></p>
		<?php get_template_part( 'template-parts/components/form-search' ); ?>
	</div>
</div>
