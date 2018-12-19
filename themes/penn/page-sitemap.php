<?php
/*
====================
  TEMPLATE NAME: Sitemap
====================
*/
get_header();
?>

<style media="screen">
    .sitemap {
        margin: 75px 0px;
    }

    .page_item {
        padding: 8px 0;
        font-size: 1rem;
        color: #2d84b3;
        text-decoration: underline;
    }

    .page_item_has_children {
        padding-top: 2rem;
        font-size: 2.5rem;
        text-decoration: none;
        list-style:none;
        color: #474747;
    }

    /* Children groups */
    .children {
        padding-top: 1rem;
    }

    .children > .page_item_has_children {
        font-size: 1.5rem;
    }

    .page-header {
        max-height: 400px;
    }
</style>

<main>

    <?php display_custom_default_hero(); ?>
    
    <div class="g-l-wrapper">
        <div id="primary" class="content-area base-content sitemap small-12 row column">
            <ul class="list">
                <?php
                    global $post;

                        wp_list_pages( array(
                        'title_li'    => '',
                        'sort_column'  => 'post_title',
                        'exclude'     => ''
                    ) );

                ?>
            </ul>
        </div>
    </div>
	
</main>

<script type="text/javascript">
    // Remove link from parents
    jQuery(function($) {
        // Void link and set cursor
        $("li.page_item_has_children").children("a").attr('href', "javascript:void(0)").css("cursor", "text");
    });
</script>

<?php get_footer(); ?>
