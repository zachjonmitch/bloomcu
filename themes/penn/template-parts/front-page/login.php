<?php
/**
* Hero Login Form
*
* @package Base
*/
?>
<div class="c-login">
	<p class="c-login__title"><?php esc_html_e( 'Online Banking', 'base' ); ?></p>

	<form action="" class="c-login__form">
		<div>
			<label for="hero-username" class="c-login__label"><?php esc_html_e( 'Username', 'base' ); ?></label>
			<input type="text" id="hero-username" class="c-login__input" placeholder="username">

			<label for="hero-password" class="c-login__label"><?php esc_html_e( 'Password', 'base' ); ?></label>
			<input type="text" id="hero-password" class="c-login__input" placeholder="password">
		</div>

		<a href="#" class="c-login__link"><?php esc_html_e( 'Forgot Password?', 'base' ); ?></a>

		<button type="submit" class="c-login__submit button button--secondary button--full-width"><?php esc_html_e( 'Login', 'base' ); ?></button>
	</form>
</div>
