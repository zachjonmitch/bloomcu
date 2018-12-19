<?php 
/** 
 * Archive 
 * 
 * @package Base 
 */ 
 
get_header(); 

$cat = get_the_terms(get_the_ID(),'faq-category' )[0];

?> 
<?php display_custom_default_hero(); ?>
 
<div class="article-content g-l-wrapper">	  
<article <?php post_class( 'js-product-faq c-product-faq faqs-content' ); ?> >
    <div class="c-product-section-header">
        <h2 class="h1"><?php echo $cat->name; ?></h2>
    </div>
        <div class="row"> 
        
        <?php while ( have_posts() ) : the_post(); ?> 

        <div class="c-product-faq__content"> 
            <ul class="c-product-faq__questions wysiwyg-content"> 
                <li style="padding-bottom: 30px;">
                    <button href="#faq-<?php echo $counter; ?>" class="js-product-faq__link accordion_button" aria-haspopup="true" aria-expanded="false">
                    <?php the_title(); ?>
                    <span class="far fa-angle-down js-trigger-toggle"></span>
                    </button>
                    <div id="faq-<?php echo $counter; ?>" class="js-product-faq__content c-product-faq__content answer wysiwyg-content">
                    <?php the_content(); ?>
                    </div>
                </li>  
                <?php $counter++; ?>
            </ul>		
            </div> 
    
        <?php endwhile; ?> 

        </div> 
    </article>
</div> 
	<?php base_pagination(); ?>
 
<?php get_footer(); ?> 