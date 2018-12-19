<?php 
/** 
 * Archive 
 * 
 * @package Base 
 */ 
 
get_header(); 
?> 
 
 <?php display_custom_default_hero('Frequently Asked Questions'); ?>
 
  <?php 
    
    $cats =  get_terms( 'faq-category' ); 
    // $query_main_blog = new WP_Query( $args_main_blog );
		
  ?> 
<div class="article-content g-l-wrapper">
 
    <div class="js-faqs-accordion">	 
    <?php 
    $counter = 1;
    foreach ($cats as $cat) {
      $cat_id= $cat->term_id;
      ?>
      <h2 class="h2" id="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></h2>
      <div class="faqs-content"> 
          <?php
              //query faqs by category
              $posts = new WP_Query( 
                array(
                'post_type' => 'faqs',          // name of post type.
                'tax_query' => array(
                    array(
                      'taxonomy' => 'faq-category',
                      'field' => 'id',          // term_id, slug or name
                      'terms' => $cat_id,                  // term id, term slug or term name
                    )
                )
            ) );
            
            if ( $posts->have_posts() ) : 
              while ( $posts->have_posts() ) : 
                $posts->the_post();
          ?>

          <ul class="c-product-faq__questions"> 
            <li>
                <button href="#<?php echo $counter; ?>" class="accordion_button js-product-faq__link" aria-haspopup="true" aria-expanded="false">
                  <?php the_title(); ?>
                  <span class="far fa-angle-down js-trigger-toggle"></span>
                </button>
                <div id="<?php echo $counter; ?>" class="js-product-faq__content c-tab-accordion__content wysiwyg-content">
                  <?php the_content(); ?>
                </div>
            </li>  
            <?php $counter++; ?>
          </ul>		
          <?php 
          // endforeach; 
            endwhile;
            wp_reset_postdata(); 
          endif;
        ?>
      </div> 
      <?php } ?>
    </div>

  <div class="category-list"> 
    <p class="category-list-title">Categories</p> 
    <nav class="category-list-modal"> 
      <ul> 
        <?php
        $count = 0;
        while( $count < sizeof($cats) ) :
          if(!empty($cats[$count]->name )){
            echo '<li><a href="#'.$cats[$count]->slug.'">'.$cats[$count]->name.'</a></li>';
          }
        $count++;
      endwhile;
        ?> 
      </ul> 
    </nav> 
  </div>
 
</div>


<?php get_footer(); ?> 
<script type="text/javascript">
  // Select all links with hashes
$('.category-list a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        // event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top 
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          }
        });
      }
    }
  });
  </script>