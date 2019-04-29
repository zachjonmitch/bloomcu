<?php
/**
 * Single
 *
 * @package Base
 */

get_header();
?>

<div class="g-page-content">
	<?php get_template_part( 'template-parts/post/content-post-single' ); ?>
</div>

<?php /*
<?php base_display_hero_content(); ?>

<div class="g-page-content">
	<?php get_template_part( 'template-parts/post/content-post-single' ); ?>

	<?php get_template_part( 'template-parts/post/pagination' ); ?>

	<?php /*
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
</div>
*/?>


<?php get_footer(); ?>
