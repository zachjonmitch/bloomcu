<?php
/**
* Mobile Nav
*
* @package Base
*/
?>

<nav class="navigation-mobile js-nav">
	<ul class="navigation-mobile__list">
		<li class="navigation-mobile__item">
			<button class="navigation-mobile__action js-modal-trigger" data-main-nav-trigger="search">
				<span class="navigation-mobile__slide">
					<i class="fal fa-search"></i>
					<span class="navigation-mobile__action-title"><?php esc_html_e( 'Search', 'base' ); ?></span>
				</span>

				<span class="navigation-mobile__slide navigation-mobile__slide--close" aria-hidden="true">
					<i class="fal fa-times"></i>
					<span class="navigation-mobile__action-title"><?php esc_html_e( 'Close', 'base' ); ?></span>
				</span>
			</button>
		</li>

		<li class="navigation-mobile__item">
			<a href="" class="navigation-mobile__action">
				<span class="navigation-mobile__slide">
					<i class="fal fa-phone"></i>
					<span class="navigation-mobile__action-title"><?php esc_html_e( 'Contact', 'base' ); ?></span>
				</span>
			</a>
		</li>

		<li class="navigation-mobile__item">
			<button class="navigation-mobile__action js-modal-trigger" data-main-nav-trigger="login">
				<span class="navigation-mobile__slide">
					<i class="fal fa-lock-open-alt"></i>
					<span class="navigation-mobile__action-title"><?php esc_html_e( 'Log In', 'base' ); ?></span>
				</span>

				<span class="navigation-mobile__slide navigation-mobile__slide--close" aria-hidden="true">
					<i class="fal fa-times"></i>
					<span class="navigation-mobile__action-title"><?php esc_html_e( 'Close', 'base' ); ?></span>
				</span>
			</button>
		</li>

		<li class="navigation-mobile__item">
			<button class="navigation-mobile__action js-menu-trigger">
				<span class="navigation-mobile__slide">
					<i class="fal fa-bars"></i>
					<span class="navigation-mobile__action-title"><?php esc_html_e( 'Menu', 'base' ); ?></span>
				</span>

				<span class="navigation-mobile__slide navigation-mobile__slide--close" aria-hidden="true">
					<i class="fal fa-times"></i>
					<span class="navigation-mobile__action-title"><?php esc_html_e( 'Close', 'base' ); ?></span>
				</span>
			</button>
		</li>
	</ul>
</nav>
