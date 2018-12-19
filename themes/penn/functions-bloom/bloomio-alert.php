<?php
/**
* Alert Bar Module
* @author BloomCU
*
**/
// Register bloomio_alert Post Type
add_action('init', 'bloomio_alert_init', 0);
add_action('init', 'bloomio_alert_category_init', 0);
add_action('init', 'bloomio_set_alert_cookie');

function bloomio_alert_init()
{
    $labels = array(
        'name'                  => 'Alerts',
        'singular_name'         => 'Alert',
        'menu_name'             => 'Alerts',
        'name_admin_bar'        => 'Alert',
        'archives'              => 'Alert Archives',
        'attributes'            => 'Item Attributes',
        'parent_item_colon'     => 'Parent Item:',
        'all_items'             => 'All Alerts',
        'add_new_item'          => 'Add New Alert',
        'add_new'               => 'Add New',
        'new_item'              => 'New Alert',
        'edit_item'             => 'Edit Alert',
        'update_item'           => 'Update Alert',
        'view_item'             => 'View Alert',
        'view_items'            => 'View Alerts',
        'search_items'          => 'Search Alert',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into item',
        'uploaded_to_this_item' => 'Uploaded to this item',
        'items_list'            => 'Items list',
        'items_list_navigation' => 'Items list navigation',
        'filter_items_list'     => 'Filter items list',
    );
    $args = array(
        'label'                 => 'Alert',
        'description'           => 'Post Type Description',
        'labels'                => $labels,
        'supports'              => array( ),
        'taxonomies'            => array( 'alert_cat' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => 'alerts',
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'capability_type'       => 'page',
    );
    register_post_type('bloomio_alert', $args);
}

// Register alert_cat Taxonomy
function bloomio_alert_category_init()
{
    $labels = array(
        'name'                       => 'Categories',
        'singular_name'              => 'Category',
        'menu_name'                  => 'Alert Categories',
        'all_items'                  => 'All Items',
        'parent_item'                => 'Parent Item',
        'parent_item_colon'          => 'Parent Item:',
        'new_item_name'              => 'New Item Name',
        'add_new_item'               => 'Add New Item',
        'edit_item'                  => 'Edit Item',
        'update_item'                => 'Update Item',
        'view_item'                  => 'View Item',
        'separate_items_with_commas' => 'Separate items with commas',
        'add_or_remove_items'        => 'Add or remove items',
        'choose_from_most_used'      => 'Choose from the most used',
        'popular_items'              => 'Popular Items',
        'search_items'               => 'Search Items',
        'not_found'                  => 'Not Found',
        'no_terms'                   => 'No items',
        'items_list'                 => 'Items list',
        'items_list_navigation'      => 'Items list navigation',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => false,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
    );
    register_taxonomy('alert_cat', array( 'bloomio_alert' ), $args);
}

function bloomio_set_alert_cookie()
{
    $args = array(
        'post_type' => 'bloomio_alert',
        'posts_per_page' => 1,
        'alert_cat' => 'homepage' //homepage
    );

    $latest_alert = get_posts($args);
    if ($latest_alert) {
        $alert_id = $latest_alert[0]->ID;
        if (!isset($_COOKIE['last_homepage_alert_id'])) {
            setcookie('last_homepage_alert_id', $alert_id, time() + (10 * 365 * 24 * 60 * 60), "/");
        } elseif (isset($_COOKIE['last_homepage_alert_id']) && $alert_id > $_COOKIE['last_homepage_alert_id']) {
            setcookie('last_homepage_alert_id', $alert_id, time() + (10 * 365 * 24 * 60 * 60), "/");
        } else {
        }
    }

    $args = array(
        'post_type' => 'bloomio_alert',
        'posts_per_page' => 1,
        'alert_cat' => 'subpages' //subpages
    );

    $latest_alert = get_posts($args);
    if ($latest_alert) {
        $alert_id = $latest_alert[0]->ID;
        if (!isset($_COOKIE['last_subpages_alert_id'])) {
            setcookie('last_subpages_alert_id', $alert_id, time() + (10 * 365 * 24 * 60 * 60), "/");
        } elseif (isset($_COOKIE['last_subpages_alert_id']) && $alert_id > $_COOKIE['last_subpages_alert_id']) {
            setcookie('last_subpages_alert_id', $alert_id, time() + (10 * 365 * 24 * 60 * 60), "/");
        } else {
        }
    }
}

add_action('wp_footer', 'add_alert_bar');

function add_alert_bar()
{
    $alert_cat_arg = 'subpages';

    if (is_front_page()) {
        $alert_cat_arg = 'homepage';
    }

    $latest_alert =  new WP_Query( array(
        'post_type' => 'bloomio_alert',          // name of post type.
        'posts_per_page'    => 1,
        'orderby' => 'date',
        'order' => 'desc',
        'tax_query' => array(
            array(
            'taxonomy' => 'alert_cat',
            'field' => 'slug',          // term_id, slug or name
            'terms' => $alert_cat_arg,      // term id, term slug or term name
            )
        ),
    ) );


    if($latest_alert->have_posts()) {
        while($latest_alert->have_posts()) {
            $latest_alert->the_post(); 
            $getStatus = getCookie($alert_cat_arg);

            /*remove slashes from string*/
            $getStatus = str_replace("\\",'',$getStatus);
        
            /* convert string to array */
            $getStatus = json_decode($getStatus, true);

            $alert_id = get_the_ID();
    
            if ($getStatus['alert_id'] == $alert_id
            && $getStatus['status'] == 'block' ){
                //Do nothing if its blocked
            }else{
    
            $alert_title = get_the_title();
            $description = get_field('description', $alert_id);
            $custom_url = get_field('custom_url', $alert_id);
            $alert_cta = get_field('alert_cta', $alert_id);
    
            ?>
            <div id="alert-bar" class="bloomio-alert-wrap">
                <div class="bloomio-alert-inner">
                    <div class="g-l-wrapper wysiwyg-content">
                        <div class="row">
                            <div class="large-7 small-12 columns">
                                <h2 class="bloomio-alert-title">
                                    <?php echo $alert_title; ?>
                                </h2>
                                <div class="bloomio-alert-desc">
                                    <?php echo $description; ?>
                                </div>
                            </div>
                            <?php if ( $custom_url && $alert_cta ) { ?>
                            <div class="large-5 small-12 columns button-actions">
                                
                                    <a class="button button--secondary-sm" target="_blank" href="<?php echo $custom_url; ?>"><?php echo $alert_cta; ?></a>
                            <?php } else { ?>
                                <div class="large-2 small-12 columns button-actions">
                            <?php } ?>
                                <button id="close-alert" data-scope="<?php echo $alert_cat_arg; ?>" data-alert="<?php echo $alert_id; ?>" class="btn-alert-close button" aria-label="Close alert bar" aria-labelledby="alert-bar close-alert">&times;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <?php
    
                if (is_front_page()) {
                    echo '<script> var latest_homepage_alert = ' . $alert_id . '</script>'; 
                } else {            
                echo '<script> var latest_subpages_alert = '. $alert_id . '</script>';
                }
            }//End - check if blocked
        // } //End - get latest alert

        }
        wp_reset_query();
    }
   
}

function add_alert_online_banking() {

    $alert_cat_arg = 'online-banking';

    // $args = array(
    //     'post_type' => 'bloomio_alert',
    //     'posts_per_page' => 1,
    //     'alert_cat' => $alert_cat_arg
    // );
    $args = array(
        'post_type' => 'bloomio_alert',          // name of post type.
        'posts_per_page'    => 1,
        'orderby' => 'date',
        'order' => 'desc',
        'tax_query' => array(
            array(
            'taxonomy' => 'alert_cat',
            'field' => 'slug',          // term_id, slug or name
            'terms' => $alert_cat_arg,      // term id, term slug or term name
            )
        ),
    );

    $latest_alert = get_posts($args);

    if ($latest_alert) {
        $alert_id = $latest_alert[0]->ID;

        $alert_title = $latest_alert[0]->post_title;
        $data['title'] = $alert_title;
        $data['desc'] = get_field('description', $alert_id);
        $data['url'] = get_field('custom_url', $alert_id);
        $data['cta'] = get_field('alert_cta', $alert_id);

        return $data;
    }

}

// Get cookie
if ( ! function_exists( 'getCookie' ) ) {
    function getCookie($cookie_name) {
        if ( !isset($_COOKIE[$cookie_name]) ) {
            return;
        } else {
               return stripslashes($_COOKIE[$cookie_name]);
        }
    }
}
