<?php
/**
* Sub Page Hero
*
* @package Base
*/

/**
 * Hero Content
 *
 * @author Rich Edmunds / Paul Allen
 * @param String $page_title
 * @param String $page_sub_title
 * @param Array $page_link
 * @param Array $page_hero_image
 * @param Array $classes Array of modifier classes.
 *
 * If a page title is provided, a breadcrumb with the page title will be displayed.
 */
function base_display_hero(
	$page_title = '',
	$page_sub_title = '',
	$page_link = '',
	$page_hero_image = '',
	$classes = []
	) {

	$classes = implode( ' ', $classes );

	// Set a hero fallback image.
	$page_hero_image = $page_hero_image ? $page_hero_image : get_field( 'global_hero_image', 'options' );

	// Is title set in the function, use it, else use the ACF field, fallback to the post title.
	$title = $page_title ? $page_title : get_the_title();

	?>
	<div class="g-page-header <?php echo esc_attr( $classes ); ?>">
		<?php base_display_image_acf( $page_hero_image, 'sub-page-small', [ 'h-cover-media', 'g-page-header__background' ], false ); ?>

		<div class="g-l-wrapper g-page-header__content">
			<?php if ( $page_title ) { ?>
				<p class="g-page-header__breadcrumb"><?php echo esc_html( get_the_title() ); ?></p>
			<?php } ?>

			<h1 class="g-page-header__title h1"><?php echo esc_html( $title ); ?></h1>

			<?php if ( $page_sub_title ) : ?>
				<h2 class="g-page-header__sub-title"><?php echo esc_html( $page_sub_title ); ?></h2>
			<?php endif; ?>

			<?php base_display_acf_link( $page_link, [ 'g-page-header__link' ] ); ?>
		</div>
	</div>
	<?php
}

/**
 * Display the page header with standard fields
 */
function display_custom_default_hero(
	$page_hero_title = '',
	$page_hero_description = '',
	$page_link = '',
	$page_hero_image = '',
	$classes = []
	)
 { 
	$page_hero_title = $page_hero_title ? $page_hero_title : get_the_title();
	$page_hero_description = $page_hero_description ? $page_hero_description : '';
	?>

	<div class="hero-product default-hero">
	<div class="hero-product__image"></div>
	<div class="hero-product__banner">
		<div class="hero-product__banner-max g-l-wrapper">
			<div class="hero-product__banner-inner wysiwyg-content">
				<?php if ( $page_hero_title ) { ?>
					<?php echo $page_hero_title; ?>
				<?php } ?>

				<?php if ( $page_hero_description ) { ?>
					<?php echo $page_hero_description; ?>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="hero-product__bottom">
		<div class="hero-product__bottom-inner"></div>
	</div>
</div>

<?php
}

/**
 * Display hero with image and slider
*/
function display_hero_with_image(){

$homepage_hero_sub_title   = get_field( 'homepage_hero_sub_title' );
$homepage_hero_cta         = get_field( 'homepage_hero_cta' );
$homepage_hero_description = get_field( 'homepage_hero_description' );


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
<?php 
}