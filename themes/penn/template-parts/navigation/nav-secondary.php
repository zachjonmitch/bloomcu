<?php
/**
* Nav Secondary
*
* @package Base
*/
?>

<ul class="navigation-secondary">
	<li class="navigation-secondary__item">
		<a href="#" class="navigation-secondary__action">
			<i class="fal fa-phone"></i>
			<span class="navigation-secondary__action-title"><?php esc_html_e( 'Contact', 'base' ); ?></span>
		</a>
	</li>

	<li class="navigation-secondary__item">
		<button class="navigation-secondary__action js-modal-trigger">
			<i class="fal fa-search"></i>
			<span class="navigation-secondary__action-title"><?php esc_html_e( 'Search', 'base' ); ?></span>
		</button>

		<div class="navigation-secondary__dropdown navigation-secondary__dropdown--search js-modal" data-main-nav-modal="search">
			<?php get_template_part( 'template-parts/components/form-search' ); ?>
		</div>
	</li>

	<li class="navigation-secondary__item">
		<button class="navigation-secondary__action js-modal-trigger">
			<i class="fal fa-lock-open-alt"></i>
			<span class="navigation-secondary__action-title"><?php esc_html_e( 'Log In', 'base' ); ?></span>
		</button>

		<div class="navigation-secondary__dropdown js-modal" data-main-nav-modal="login">
			<?php get_template_part( 'template-parts/components/form-nav-login' ); ?>
		</div>
	</li>
</ul>

