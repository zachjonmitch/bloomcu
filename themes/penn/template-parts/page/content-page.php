<?php
/**
 * Content Page
 *
 * @package Base
 */

?>

<div class="g-l-wrapper">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( get_the_content() ) :
			?>

			<article id="page-<?php the_ID(); ?>" <?php post_class( 'wysiwyg-content' ); ?>>
				<?php the_content(); ?>
			</article>

			<?php
		endif;
	endwhile;
	?>
</div>

<?php
base_display_content_blocks();
