<?php
/**
 * Template Name: Parent Page
 *
 * @package Base
 */

get_header();
?>
<?php display_custom_default_hero(); ?>

<main>

	<div class="g-l-wrapper">
    <?php
        $my_wp_query = new WP_Query();
        $all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => '-1'));

        // Get the page as an Object
        // $parent =  get_page_by_title('Portfolio');
        $parent = get_post(get_the_ID());

        // Filter through all pages and find Portfolio's children
        $child_pages = get_page_children( $parent->ID, $all_wp_pages );

        // echo what we get back from WP to the browser
        // echo '<pre>' . print_r( $child_pages[0]->ID, true ) . '</pre>';
        ?>

        <div class="article-content _children">

            <?php foreach($child_pages as $my_post):?>
                <div class="child_item">
                    <article id="post-<?php $my_post->ID; ?>" <?php post_class( '' ); ?>>
                            <h2 class="h3 child-title" >
                                <a href="<?php echo get_permalink($my_post->ID); ?>">
                                <?php echo $my_post->post_title; ?></a>
                            </h2>
                            <a href="<?php echo get_permalink($my_post->ID); ?>" class="button"><?php echo esc_html_e('Learn More', 'base'); ?></a>
                    <article>
                </div>    

            <?php endforeach; ?>

        </div>
      <?php wp_reset_query(); ?>

    </div>

</main>

<?php get_footer(); ?>
