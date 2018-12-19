<?php

/**
 * Enable ACF custom folders
 *
 * @author Rashaan Thompson
 * 
 * @see https://gist.github.com/theMikeD/b66840caefdcf8f34100
 *  
**/
add_filter('acf/settings/save_json', 'cnmd_set_acf_json_save_folder');
add_filter('acf/settings/load_json', 'cnmd_add_acf_json_load_folder');

/**
 * Set a new location to save ACF field group JSON
 *
 * @param string $path
 * @return string
 */
function cnmd_set_acf_json_save_folder( $path ) {

	// update path
	// $path = get_parent_theme_file_path( '/acf-json' );	
	$path = get_parent_theme_file_path( '/acf-json-bloom' );

	// return
	return $path;
}



/**
 * Adds a folder to the ACF JSON load list
 *
 * @param array $paths
 * @return array
 */
function cnmd_add_acf_json_load_folder( $paths ) {
	// Remove original path (optional)
	unset($paths[0]);

	// append path
	
	$paths[] = $path = get_parent_theme_file_path( '/acf-json-bloom' );
	$paths[] = $path = get_parent_theme_file_path( '/acf-json' );
	// return
	return $paths;
}
?>