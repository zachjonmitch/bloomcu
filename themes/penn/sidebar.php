<?php
/**
 * Sidebar
 *
 * @package Base
 */

?>

<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
	<aside class="sidebar-main">
		<?php dynamic_sidebar( 'sidebar-main' ); ?>
	</aside>
<?php endif; ?>
