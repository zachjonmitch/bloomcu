<?php
/**
 * Index
 * Entry point for all function files.
 *
 * @package Base
 */

$files = [
	'cleanup.php',
	'enqueue.php',
	'theme-support.php',
	'post-base.php',
	'register.php',
	'media-base.php',
	'branding.php',
	'post-types.php',
	'custom.php',
	'template-parts.php',
	'components/navigation-main.php',
	'components/navigation-footer.php',
	'components/social-icons.php',
	'components/form-login.php',
	'components/callout.php',
	'components/testimonial.php',
	'components/modals.php',
	'components/left-right.php',
	'components/router.php',
	'components/excerpts.php',
	'components/post-card.php',
	'components/hero.php',
	'components/custom-layout.php',
	'components/quote.php',
];

foreach ( $files as $file ) {
	require_once $file;
}
