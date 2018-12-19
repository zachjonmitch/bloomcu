<?php
/**
 * Content Post Loop
 *
 * @package Base
 */

?>

<div class="g-l-wrapper">
	<div class="article-content offset">	
		<div class="blog-categories">
			<p>Categories</p>
			<ul class="blog-category-list">
				<?php
				wp_list_categories(array(
					'style'=>'list',
					'title_li'=>'',
					'orderby'=>'name',
					'order'=>'asc',
					'depth'=>1,
				));
				?>
			</ul>
		</div>
		<div class="blog-article-wrapper">

			<?php
			if( have_posts() ):
				while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
						<?php //base_display_post_card(); ?>here
					</article>
				<?php 
				endwhile;
				endif; ?>
			</div>
		<?php base_pagination(); ?>	

	</div>
</div>
