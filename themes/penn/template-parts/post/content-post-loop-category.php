<?php
/**
 * Content Post Loop Category
 *
 * @package Base
 */

?>
<div class="g-l-wrapper category">
	<ul class="breadcrumbs">
		<li class="blog-home"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Blog Home</a></li>
		<li>/</li>
		<li><?php $cat = get_the_category(); echo single_cat_title();?></li>
	</ul>
	<span class="cat-name"><?php $cat = get_the_category(); echo single_cat_title();?></span>
</div>

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
			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
					<?php base_display_post_card(); ?>
				</article>
			<?php endwhile; ?>
		
		</div>
		
		<?php base_pagination(); ?>	
	</div>
</div>
