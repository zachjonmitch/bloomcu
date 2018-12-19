<?php
/**
 * Global ACF Options Options Menu
 * Adds "Whitelist Domain Options" to Global Options menu
 * Learn more: http://bit.ly/2vJNh9h
 *             https://www.advancedcustomfields.com/resources/register-multiple-options-pages/
 */
if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_sub_page ( array (
        'page_title' 	=> 'Speedbump Settings',
        'menu_title' 	=> 'Whitelist Domains',
        'menu_slug' 	=> 'speedbump-settings',
        'parent_slug'	=> 'website-options',
    ));
}

/**
 * Make whitelinst available on window object
 */
function get_whitelist() {

    // Get whitelist from ACF global options
    $domains = get_field('whitelist','options');

    // Store whitelist as array of objects on window object
    // This makes the whitelist available to speebump.js
    echo '<script> var whitelist_domains = '. json_encode($domains) .';</script>';

}
add_action('wp_footer', 'get_whitelist');

function showSpeedbump() { 
    $message = get_field('speedbump_message','options');

    $template = '<div id="modal-speedbump" class="modal-cta modal c-modal js-modal">
            <div class="modal-header">
                <h2>Leaving Our Website</h2>
            </div>
            <div id="speedbump-content" class="modal-content">
                ';
                if( !empty($message) ) {
                    $template.= $message;
                }
                $template.='<br><br>
                <div class="modal-buttons row">
                    <div class="medium-6 columns">
                        <button id="return" class="button js-close-modal button--white" type="button" aria-label="Stay on This Page" aria-labelledby="speedbump-content return">Stay on This Page</button>
                    </div>
                    <div class="medium-6 columns">
                        <button id="continue" class="button _cont js-close-modal" type="button" aria-label="Continue" aria-labelledby="speedbump-content continue">Continue</button>
                    </div>
                </div>
            </div> 
            <button id="close-speedbump-modal" class="button close-button c-modal__close js-close-modal button button--small button--white" data-close aria-label="Close modal" aria-labelledby="speedbump-content close-speedbump-modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        
    echo $template;

}

add_action('wp_footer', 'showSpeedbump');

