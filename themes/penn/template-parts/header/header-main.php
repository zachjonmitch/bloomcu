<?php
/**
 * Header Main
 *
 * @package Base
 */

?>

<header class="g-header">
	<div class="g-header__container">
		<div class="logo-primary">
			<a href="<?php echo esc_url( home_url() ); ?>">
				<?php get_template_part( 'assets/dist/images/logo.svg' ); ?>
			</a>
		</div>

		<div class="g-header__navigation js-nav">
			<nav class="navigation" aria-label="<?php esc_attr_e( 'Navigation', 'base' ); ?>">
				<button class="navigation__back js-menu-back"><span class="fal fa-angle-left"></span> Back</button>

				<?php get_template_part( 'template-parts/navigation/nav', 'mega' ); ?>
			</nav>

			<?php get_template_part( 'template-parts/navigation/nav', 'secondary' ); ?>
		</div>
	</div>
</header>

<?php
get_template_part( 'template-parts/navigation/nav-mobile' );
