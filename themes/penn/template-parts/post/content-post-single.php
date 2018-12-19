<?php
/**
 * Content Post Single
 *
 * @package Base
 */

?>

<div class="g-l-wrapper g-l-wrapper--large">
	<ul class="breadcrumbs">
		<li class="blog-home"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Blog Home</a></li>
		<li>/</li>
		<li>
			<?php $category = get_the_category();
			if ( $category[0] ) {
				echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
			} ?>
		</li>
	</ul>
	<div class="article-content single-post">
		<div class="intro">
			<?php while ( have_posts() ) : the_post(); ?>
				<h2 class="h2"><?php the_title(); ?></h2>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail('full-page-image-small', [ 'alt' => esc_html ( get_the_title() ) ]); ?>
			<?php } ?>
		</div>
			<article id="post-<?php the_ID(); ?>" <?php post_class( [ 'post-item single' ] ); ?>>
				
				<ul class="post-info">
					<li class="post-meta-author" rel="author">
						Posted by <?php the_author(); ?>
					</li>
					<li class="post-meta-date">
						on <time datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
							<?php the_time( 'F j, Y' ); ?>
						</time>
					</li>
				</ul>

				<div class="wysiwyg-content post-single__content">
					<?php the_content(); ?>
				</div>

				<?php //get_template_part( 'template-parts/components/social-share' ); ?>
			</article>
		<?php endwhile; ?>
	</div>
</div>