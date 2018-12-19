<?php
/**
 * Single
 *
 * @package Base
 */

get_header();
?>

<?php display_custom_default_hero(); ?>

<div class="g-page-content g-padding-top">
	<?php get_template_part( 'template-parts/post/content-post-single-faq' ); ?>
</div>

<?php get_footer(); ?>
