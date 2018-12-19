<?php
/**
 * Branding
 *
 * @package Base
 */

/**
 * Logo URL
 *
 * Use your own URL for login logo link.
 * Set the link title tag.
 *
 * @return string Site URL.
 */
function base_login_logo_url_bloom() {
	return esc_url( site_url() );
}

add_filter( 'login_headerurl', 'base_login_logo_url_bloom' );
add_filter( 'login_headertitle', 'base_login_logo_url_bloom' );


/**
 * Admin Footer
 *
 * Change the footer to link to company website.
 */
function base_admin_footer_bloom() {
	?>
	<span id="footer-thankyou">
		<?php esc_html_e( 'Theme Development by', 'base' ); ?>
		<a href="https://bloomcu.com"><?php esc_html_e( 'BloomCU', 'base' ); ?></a>.
	</span>
	<?php
}

add_filter( 'admin_footer_text', 'base_admin_footer_bloom' );


/**
 * Add Custom Dashboard Widget
 *
 * Add theme info box into WordPress Dashboard.
 */
function base_admin_add_dashboard_widgets_bloom() {
	wp_add_dashboard_widget( 'base_theme_details', esc_html__( 'Theme Details', 'base' ), 'base_admin_theme_info_widget_bloom' );
}

add_action( 'wp_dashboard_setup', 'base_admin_add_dashboard_widgets_bloom' );


/**
 * Theme Info Widget
 */
function base_admin_theme_info_widget_bloom() {
	?>
	<ul>
		<li><strong><?php esc_html_e( 'Developed By:', 'base' ); ?></strong> <?php esc_html_e( 'BloomCU', 'base' ); ?></li>
		<li><strong><?php esc_html_e( 'Website:', 'base' ); ?></strong> <a href='https://bloomcu.com'><?php esc_html_e( 'https://bloomcu.com', 'base' ); ?></a></li>
		<li><strong><?php esc_html_e( 'Email:', 'base' ); ?></strong> <a href='mailto:derik@bloomcu.com'><?php esc_html_e( 'derik@bloomcu.com', 'base' ); ?></a></li>
		<li><strong><?php esc_html_e( 'Phone:', 'base' ); ?></strong> <a href="tel:000-000-0000"><?php esc_html_e( '000-000-0000', 'base' ); ?></a></li>
	</ul>
	<?php
}


/**
 * Remove Dashboard Widgets
 */
function base_admin_remove_dashboard_widgets_bloom() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick Draft
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress Events and News
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity
}

add_action( 'wp_dashboard_setup', 'base_admin_remove_dashboard_widgets_bloom' );


/**
 * Remove Welcome Panel
 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );


/**
 * Remove Menu Links
 *
 * Remove links from the admin bar under the logo icon.
 */
function base_admin_bar_remove_menu_links_bloom() {
	global $wp_admin_bar;

	$wp_admin_bar->remove_menu( 'about' );
	$wp_admin_bar->remove_menu( 'wporg' );
	$wp_admin_bar->remove_menu( 'documentation' );
	$wp_admin_bar->remove_menu( 'support-forums' );
	$wp_admin_bar->remove_menu( 'feedback' );
}

add_action( 'wp_before_admin_bar_render', 'base_admin_bar_remove_menu_links_bloom' );


/**
 * Add Custom Logo
 *
 * Replaces the default WordPress logo with company logo.
 */
function base_admin_bar_add_custom_logo_bloom() {
	?>
	<style>
	#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon::before {
		background-image: url('<?php echo esc_url( THEME_IMAGES ); ?>/logo-admin-branding.svg');
		background-size: 100%;		
		background-position: center;
		background-repeat: no-repeat;
		color: transparent;
	}
	</style>
	<?php
}

add_action( 'wp_before_admin_bar_render', 'base_admin_bar_add_custom_logo_bloom' );


/**
 * Add Base Color Scheme
 */
function base_admin_register_color_scheme_bloom() {
	wp_admin_css_color(
		'base',
		esc_html__( 'Base Theme', 'base' ),
		THEME_CSS . '/admin.css',
		array(
			'#217D94',
			'#363b3f',
			'#9098A0',
			'#8BC251',
		)
	);
}

add_action( 'admin_init', 'base_admin_register_color_scheme_bloom' );


/**
 * Set Default Color Scheme
 *
 * Set to Base Theme.
 *
 * @return string ID of color scheme.
 */
function base_admin_set_default_color_scheme_bloom( $result ) {
	return 'base';
}

add_filter( 'get_user_option_admin_color', 'base_admin_set_default_color_scheme_bloom' );
