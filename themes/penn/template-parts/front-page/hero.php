<?php
/**
* Front Page Hero
*
* @package Base
*/

$homepage_hero_sub_title   = get_field( 'homepage_hero_sub_title' );
$homepage_hero_cta         = get_field( 'homepage_hero_cta' );
$homepage_hero_description = get_field( 'homepage_hero_description' );

$login_view = true;

?>

<div class="hero-home">
	<div class="hero-home__images">
		<?php if ( have_rows( 'homepage_hero_slides' ) ) : ?>
				<?php while ( have_rows( 'homepage_hero_slides' ) ) : the_row(); ?>
					<div class="hero-home__slide h-cover-media js-homepage-slide">
						<div <?php base_the_image_background_acf( get_sub_field( 'slide_image' ), 'medium', [ 'hero-home__slide-image', 'h-cover-media' ] ); ?>></div>

						<div class="hero-home__slide-inner">
							<p class="hero-home__slide-title"><?php the_sub_field( 'slide_text' ); ?></p>
						</div>
					</div>
				<?php endwhile; ?>
		<?php endif; ?>

		<div class="hero-home__image-overlay"></div>

		<?php if ( $login_view ) { ?>
			<div class="hero-home__login-wrapper">
				<div class="hero-home__login">
					<?php get_template_part( 'template-parts/front-page/login' ); ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="hero-home__banner">
		<div class="hero-home__banner-inner">
			<?php if ( $homepage_hero_sub_title ) { ?>
				<p class="hero-home__title"><?php echo $homepage_hero_sub_title; ?></p>
			<?php } ?>

			<?php
			if ( ! $login_view ) {
				base_display_acf_link( $homepage_hero_cta, [ 'hero-home__cta', 'button', 'button--yellow' ] );
			}
			?>

			<div class="hero-home__controls">
				<button class="c-pause-play is-playing js-hero-slider-control" type="button">
					<span class="c-pause-play__icons" aria-hidden="true">
						<i class="fas fa-pause c-pause-play__icon c-pause-play__icon--pause"></i>
						<i class="fas fa-play c-pause-play__icons c-pause-play__icon--play"></i>
					</span>

					<span class="c-pause-play__text js-hero-slider-control__text"><?php esc_html_e( 'Pause', 'base' ); ?></span>
				</button>
			</div>
		</div>
	</div>

	<div class="hero-home__bottom">
		<div class="hero-home__bottom-inner">
			<div class="hero-home__view-more">
				<p class="hero-home__view-more-text">Discover<br> More</p>

				<div class="hero-home__view-more-arrow">
					<?php get_template_part( 'assets/dist/images/hero-arrow.svg' ); ?>
				</div>
			</div>

			<div class="hero-home__description">
				<?php if ( $homepage_hero_description ) { ?>
					<p><?php echo $homepage_hero_description; ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
