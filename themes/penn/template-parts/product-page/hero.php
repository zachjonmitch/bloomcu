<?php
/**
* Product Page Hero
*
* @package Base
*/

$product_hero_title        = get_field( 'product_hero_title' );
$product_hero_description  = get_field( 'product_hero_subtitle' );
$product_hero_product_name = get_the_title();


?>

<div class="hero-product">
	<div class="hero-product__image"></div>

	<div class="hero-product__banner">
		<div class="hero-product__banner-max g-l-wrapper">
			<div class="hero-product__banner-inner wysiwyg-content">
				<?php if ( $product_hero_title ) { ?>
					<?php echo $product_hero_title; ?>
				<?php } ?>

				<?php if ( $product_hero_description ) { ?>
					<?php echo $product_hero_description; ?>
				<?php } ?>
			</div>

			<div class="hero-product__product-name">
				<?php echo $product_hero_product_name; ?>
			</div>

			<div class="hero-product__calc"></div>
		</div>
	</div>

	<div class="hero-product__bottom">
		<div class="hero-product__bottom-inner"></div>
	</div>
</div>
