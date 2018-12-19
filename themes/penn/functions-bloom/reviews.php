<?php
/*
====================
FUNCTIONS - USER REVIEWS
====================
*/

/*
* ENQUEUE DASHICONS
* ------------------
* Enqueue dashicons on frontend for user reviews
*/
function amped_load_dashicons() {
    wp_enqueue_style( 'dashicons' );
}
if ( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'amped_load_dashicons' );
}

/*
* GENERATE REVIEWS STARS
* ------------------
* This function allows accuracy to the closest 1/2 star.
* Pass in your rating number, and it will return you HTML output for the stars.
* This function is used in "panels/user-reviews.php"
* Thanks Chris Klosowsky @ chrisk.io
*/
function amped_generate_stars( $number ) {
  	// Get the whole number
  	$whole = floor( $number );

  	// Find out if our number contains a decimal
  	$fraction = $number - $whole;

  	$i = 0;
  	// This is the total number of stars to generate.
  	$total = 5;
  	$output = '';

  	// Generate the filled stars
  	while( $i < $whole ) {
		$output .= '<span class="star filled dashicons dashicons-star-filled"></span>';
		$i++;
  	}

  	// Generate the half star, if needed
  	if ( $fraction > 0 ) {
		$output .= '<span class="star half dashicons dashicons-star-half"></span>';
		$i++;
  	}

  	// Until total is met, generate empty stars
  	if ( $i < $total ) {
		while ( $i < $total ) {
    		$output .= '<span class="star empty dashicons dashicons-star-empty"></span>';
    		$i++;
		}
  	}

  	return $output;
}

/*
* REGISTER CUSTOM ADMIN COLUMNS
* ------------------
* We're seting up default WP columns (e.g., title, date)
* and custom columns for User Review CPT fields (e.g., rating)
* 'manage_{$post_type}_posts_columns' overrides the WP column creation process.
*/
function amped_review_columns($columns) {
  	$columns = array(
        'cb'                => '<input type="checkbox" />',
        'title'             => 'Review',
        'review_title'      => 'Title',
        // 'review_belongs_to' => 'Review Belongs to:',  //Harmon: TODO Exceptions need to be handled gracefully
        'review_rating' 	=> 'Rating',
        'date'              => 'Date',
  	);

  	return $columns;
}

if ( is_admin() ) {
    add_filter('manage_user-reviews_posts_columns', 'amped_review_columns');
}

/*
* RENDER COLUMNS
* ------------------
* This function renders the custom columns in our newly created column array.
* The 'manage_${post_type}_posts_columns' action is called
* to add custom columns to the User Reviews CPT list
*/
function amped_create_review_columns($column) {
  	global $post;

    if ( $column == 'review_title' ) {
  		  echo get_field( 'review_title', $post->ID );
  	}

    //Harmon: TODO Exceptions need to be handled gracefully

 //  	if ( $column == 'review_belongs_to' ) {
    //     // Returns array of ids
    //     $belongs_to_ids = get_field( 'review_belongs_to', $post->ID );
    //
    //     // Print page title of each id
    //     foreach ( $belongs_to_ids as $id ) {
    //         try {
    //             echo get_the_title( $id ). '<br>';
    //         } catch (Exception $e) {
    //             echo 'Review must be approved first';
    //         }
    //     }
    //
 //  	}

    if ( $column == 'review_rating' ) {
  		  echo get_field( 'review_rating', $post->ID );
  	}
}

if ( is_admin() ) {
    add_action('manage_user-reviews_posts_custom_column', 'amped_create_review_columns', 10, 2);
}