<?php
/**
 * Index
 * Entry point for all function files.
 *
 * @package Base
 */

$files = [
	'enqueue.php',   
	'post-base.php',
	'branding.php',	
	'theme-support.php',
	// 'acf-custom-folders.php',
	'bloomio-alert.php',
	'faqs.php',
	// 'jobs.php',
	// 'reviews.php',
	'browser-update.php',
	'shortcodes.php',
	'speedbump.php',
	'personalization.php'
];

foreach ( $files as $file ) {
	require_once $file;
}

