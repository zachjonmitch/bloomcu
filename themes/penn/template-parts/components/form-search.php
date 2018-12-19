<?php
/**
 * Form Search
 *
 * @package Base
 */

?>

<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="c-search">
	<h3 class="c-search__title h5 h-hide-full"><?php esc_html_e( 'Search', 'base' ); ?></h3>

	<label>
		<span class="h-visual-hide"><?php esc_html_e( 'Search for:', 'base' ); ?></span>
		<input type="search" name="s" class="c-search__input" placeholder="<?php esc_attr_e( 'Search', 'base' ); ?>" value="<?php echo get_search_query(); ?>">
	</label>

	<input type="submit" class="c-search__submit h-visual-hide" value="<?php esc_attr_e( 'Go', 'base' ); ?>">
</form>
