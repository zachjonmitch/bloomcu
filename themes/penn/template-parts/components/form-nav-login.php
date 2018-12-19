<?php
/**
* Navigation Login Form
*
* @package Base
*/
?>

<div class="navigation-login">
	<div class="navigation-login__form-wrapper">
		<h3 class="navigation-login__form-title"><?php esc_html_e( 'Online Banking', 'base' ); ?></h3>

		<form class="navigation-login__form" action="">
			<div>
				<div class="navigation-login__field">
					<label for="nav-username"><?php esc_html_e( 'Username', 'base' ); ?></label>
					<input type="text" id="nav-username">
				</div>

				<div class="navigation-login__field">
					<label for="nav-password"><?php esc_html_e( 'Password', 'base' ); ?></label>
					<input type="password" id="nav-password">
				</div>
			</div>

			<a href="#" class="navigation-login__forgot-password"><?php esc_html_e( 'Forgot Password?', 'base' ); ?></a>

			<button
				type="submit"
				class="navigation-login__submit button button--secondary button--secondary-sm button--full-width button--yellow"
			>
				<?php esc_html_e( 'Login', 'base' ); ?>
			</button>
		</form>

		<div class="h-text-center">
			<a href="#" class="navigation-login__register"><?php esc_html_e( 'Become a Member', 'base' ); ?></a>
		</div>
	</div>

	<!-- if login notice -->
	<div class="navigation-login__notice">
		<h3 class="navigation-login__notice-title h5 h-color-primary">Closed Presidents Day</h3>

		<p>
			All branches and operations will be closed on Monday, February 19 in observance of Presidents’ Day. Online Banking and the Mobile App are always available for you. We wish you a safe and happy holiday!
		</p>
	</div>
	<!-- endif login notice -->
</div>
