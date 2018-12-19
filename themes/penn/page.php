<?php
/**
 * Page
 *
 * @package Base
 */

get_header();
?>

<?php display_custom_default_hero(); ?>

<div class="g-page-content">
	<?php get_template_part( 'template-parts/page/content-page' ); ?>
</div>

<?php get_footer(); ?>
