<?php
/**
 * Content Post Single FAQ
 *
 * @package Base
 */

?>

	<?php while ( have_posts() ) : the_post(); 
		// $post_cat = get_the_terms(get_the_ID(),'category' )[0]->slug;
		
		// $args = array( 'category' => get_cat_ID(get_the_category()[0]->name), 'post_type' =>  'post' );
		// $blog_posts = get_posts( $args );
		// if( $blog_posts ):

		$cat = get_the_terms(get_the_ID(),'faq-category' )[0];
		
	?>
	<br>
	<br>

	<!-- <ul class="_breadcrumbs">
		<li class="_blog-home"><a href="/faqs">FAQs</a></li>
		<li>/ </li>
		<li> 
			<?php	//echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
			?>
		</li>
	</ul> -->
	
		<div class="g-l-wrapper g-padding wysiwyg-content">
			<article class="article-content" id="post-<?php the_ID(); ?>">
				<div class="single-faq-answer">
					<?php the_content(); ?>
				</div>
			</article>
		</div> 
		
	<?php endwhile; ?>

