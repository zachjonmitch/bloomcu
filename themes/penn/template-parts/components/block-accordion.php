<?php
/**
 * BLOCK Accordion
 *
 * @package Base
 *
 * $accordion_title   = get_sub_field( 'accordion_title' );
 * $accordion_content = get_sub_field( 'accordion_content' );
 *
 */

$accordion_title   = 'Disclosures';
$accordion_content = 'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum';

if ( $accordion_title && $accordion_content ) :
?>
<div class="c-accordion__wrapper g-l-wrapper">
	<div class="c-accordion">
		<div class="c-accordion__inner">
			<button class="c-accordion__title js-disclosure-title" aria-expanded="false">
				<span class="h4">
					<?php echo $accordion_title; ?>
				</span>
			</button>
			<div class="c-accordion__content wysiwyg-content">
				<?php echo $accordion_content; ?>
			</div>
		</div>
	</div>
</div>
<?php
endif;
