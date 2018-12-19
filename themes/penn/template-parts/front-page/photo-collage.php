<?php
/**
* Photo Collage
*
* @package Base
*/

$homepage_photo_collage_top    = get_field( 'homepage_photo_collage_top' );
$homepage_photo_collage_bottom = get_field( 'homepage_photo_collage_bottom' );
?>

<div class="l-photo-collage">
	<?php if ( $homepage_photo_collage_top ) { ?>
		<div class="l-photo-collage__photo l-photo-collage__photo--top">
			<div <?php base_the_image_background_acf( $homepage_photo_collage_top, 'medium', [ 'h-cover-media' ] ); ?>></div>
		</div>
	<?php } ?>

	<?php if ( $homepage_photo_collage_top ) { ?>
		<div class="l-photo-collage__photo l-photo-collage__photo--bottom">
			<div <?php base_the_image_background_acf( $homepage_photo_collage_bottom, 'medium', [ 'h-cover-media' ] ); ?>></div>
		</div>
	<?php } ?>
</div>
