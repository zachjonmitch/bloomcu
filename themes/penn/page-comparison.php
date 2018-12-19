<?php
/*
====================
	TEMPLATE NAME: Comparison Page
====================
*/ ?>

<?php get_header(); ?>

<main>

    <?php display_custom_default_hero(); ?>

    <div id="primary" class="row content-area">
      <br>
      <div class="row small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-by-row="true">
      <?php
      $products = get_field('products');
      $count    = 0;
      ?>
      <?php if ( $products) : 

        while ($count < count($products) ):

        $the_ID = $products[$count]->ID;
        $the_title = $products[$count]->post_title;
        $the_slug = $products[$count]->post_name;

        $description               = get_field( 'product_description_definition', $the_ID );
        $button_link               = get_field( 'button_link', $the_ID );
        $link_to_page              = get_the_permalink($the_ID);

		?>
        <article id="post-<?php echo $the_ID; ?>" <?php post_class( 'small-12 large-4 column' ); ?> data-equalizer-watch>
          <div class="product-card">
                <header class="product-card-header">
                    <h2 class="product-card-title">
                        <a href="<?php echo $link_to_page ?>"><?php echo $the_title; ?></a>
                    </h2>
                    <div class="product-card-description">
                        <?php echo wp_kses_post( $description ); ?>
                        <!-- <p>A great retirement plan for your employees—tons of benefits without tons of paperwork.</p> -->
                    </div>
                </header>
                <footer class="article-content product-card-footer">
                    <a href="<?php echo esc_url( $link_to_page ); ?>" class="button hollow product-card-button">View Details</a>
                </footer>
            </div>
        </article>

        <?php
        $count++;
        endwhile;

    endif;

      ?>
        </div>
    </div>

</main>


<?php get_footer(); ?>
