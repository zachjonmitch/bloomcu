<?php
/**
* Front Page Callout
*
* @package Base
*/

$homepage_cta_title     = get_field( 'homepage_cta_title' );
$homepage_cta_sub_title = get_field( 'homepage_cta_sub_title' );
$homepage_cta_link      = get_field( 'homepage_cta_link' );
?>
<div class="c-callout-home">
	<div class="c-callout-home__inner">
		<?php if ( $homepage_cta_title ) { ?>
			<h2 class="c-callout-home__title"><?php echo $homepage_cta_title; ?></h2>
		<?php } ?>

		<?php if ( $homepage_cta_sub_title ) { ?>
			<p class="c-callout-home__sub-title"><?php echo $homepage_cta_sub_title; ?></p>
		<?php } ?>

		<div class="c-callout-home__link-wrapper h-text-right">
			<?php base_display_acf_link( $homepage_cta_link, [ 'button', 'button--light', 'c-callout-home__link' ] ); ?>
		</div>
	</div>
</div>
