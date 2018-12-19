<?php /**
 * Form Login
 *
 * @param array $classes Array of class names.
 */

function base_display_form_login( $classes = [] ) {
	$classes_default = [ 'c-login' ];
	$classes_merged  = wp_parse_args( $classes, $classes_default );
	$classes         = implode( ' ', $classes_merged );
	?>
	<div class="c-login-outer h-clearfix">
		<div class="<?php echo esc_attr( $classes ); ?>">
			<span class="h4">Online Banking</span>
			<form class="c-login__form" id="loginForm" autocomplete="off" method="post">
				<input type="text" placeholder="<?php esc_attr_e( 'Username', 'base' ); ?>" autocomplete="off" class="c-login__input" value="" id="userid" name="userid"/>
				<input type="submit" id="submitBtn" value="Login" class="button button--hollow button--full-width c-login__button"/>
			</form>
			<div class="c-login__links">
				<a href="#"><?php esc_html_e( 'Not registered?', 'base' ); ?></a>
			</div>
		</div>
		<?php
		/*
		$alert = add_alert_online_banking();
		if( !is_null($alert) ):
			?>
			<div class="member-alert">
				<div class="member-alert__wrapper">
					<div class="wysiwyg-content">
						<span class="member-alert__heading h4"><?php esc_html_e( $alert['title'], 'base' ); ?></span>
						<div class="member-alert__message">
							<?php echo $alert['desc']; ?>
							<?php if( $alert['cta'] ): ?>
								<a class="member-alert__link" href="<?php echo $alert['url']; ?>"><?php echo $alert['cta']; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; */?>
	</div>

	<?php
} ?>
