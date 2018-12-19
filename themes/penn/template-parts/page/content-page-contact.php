<?php
/**
 * Content Page Contact
 *
 * @package Base
 */

?>

<div class="g-l-wrapper">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="page-<?php the_ID(); ?>" <?php post_class( 'wysiwyg-content' ); ?>>
			<?php the_content(); ?>
		</article>
	<?php endwhile; ?>
</div>
