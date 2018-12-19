<?php
/**
 * Functions
 *
 * @package Base
 */

define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/assets/dist/images' );
define( 'THEME_CSS', THEME_URI . '/assets/dist/css' );
define( 'THEME_JS', THEME_URI . '/assets/dist/js' );
define( 'THEME_SRC_JS', THEME_URI . '/assets/source/js' );

require get_parent_theme_file_path( 'functions/index.php' );
require get_parent_theme_file_path('functions-bloom/index.php');
