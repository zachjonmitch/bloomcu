<?php
/**
 * Footer Main
 *
 * @package Base
 */

?>

<footer class="g-footer">
	<div class="g-footer__top-background">
		<div class="g-footer__top-content">
			<div class="g-footer__navs">
				<nav class="g-footer__nav g-footer__nav--desktop">
					<button id="footer-nav-1">
						<span class="g-footer__nav__heading h6">Contact</span>
					</button>
					<?php get_template_part( 'template-parts/navigation/nav', 'footer-1' ); ?>
				</nav>
				<nav class="g-footer__nav g-footer__nav--desktop">
					<button id="footer-nav-2">
						<span class="g-footer__nav__heading h6">About</span>
					</button>
					<?php get_template_part( 'template-parts/navigation/nav', 'footer-2' ); ?>
				</nav>
				<nav class="g-footer__nav g-footer__nav--desktop">
					<button id="footer-nav-3">
						<span class="g-footer__nav__heading h6">Routing Number</span>
					</button>
					<ul class="g-footer__nav__content">
						<li class="routing-number">123456789</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<div class="g-footer__bottom-background g-l-wrapper">
		<div class="g-footer__name">
			<h3 class="h5">Penn East Federal Credit Union</h3>
		</div>

		<div class="g-footer__terms">
			<ul class="g-footer__terms-links">
				<li class="g-footer__terms-link"><a href="">Disclosures</a></li>
				<li class="g-footer__terms-link"><a href="">Terms of Service</a></li>
				<li class="g-footer__terms-link"><a href="">Privacy Policy</a></li>
			</ul>
		</div>

		<div class="g-footer__bottom-content">
			<div class="g-footer__info">
				<ul class="g-footer__site-links">
					<li class="g-footer__site-link"><a href="">Federally Insured by NCUA</a></li>
					<li class="g-footer__site-link"><a href="">Equal Housing Lender</a></li>
					<li class="g-footer__site-link"><a href="">NMLS #123456</a></li>
					<li class="g-footer__site-link"><a href="">&copy; 2018 Credit Union</a></li>
					<li class="g-footer__site-link"><a href="">All Rights Reserved</a></li>
				</ul>
			</div>

			<?php base_display_social_icons(); ?>
		</div>

		<a class="g-footer__site-link-designed" href="">Designed by BloomCU</a>
		<div class="g-footer__mobile-social">
			<?php base_display_social_icons(); ?>
		</div>
	</div>
</footer>
