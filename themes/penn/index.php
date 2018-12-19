<?php
/**
 * Index
 *
 * @package Base
 */

get_header();
?>

<?php 
	$blog_title = get_field('blog_title',get_option( 'page_for_posts' ));
	$blog_subtitle = get_field('blog_subtitle',get_option( 'page_for_posts' ));
?>
<?php display_custom_default_hero($blog_title, $blog_subtitle); ?>

<div class="g-page-content">
	<?php get_template_part( 'template-parts/post/content-post-loop' ); ?>
</div>

<?php get_footer(); ?>
