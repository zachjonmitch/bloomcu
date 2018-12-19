<?php
/**
 * 404
 *
 * @package Base
 */

get_header();
?>

<?php base_display_hero_content( 'Page Not Found!' ); ?>

<div class="g-page-content">
	<?php get_template_part( 'template-parts/page/content-page-404' ); ?>
</div>

<?php get_footer(); ?>
