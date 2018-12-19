<?php
/**
* Product Page Info
*
* @package Base
*/

$product_info_content = get_field( 'product_info_content' );

if ( $product_info_content || have_rows( 'product_info_links' ) ) :
	?>

	<div class="c-left-right">
		<div class="c-left-right__inner">
			<?php if ( $product_info_content ) : ?>
				<div class="c-left-right__content c-left-right__content--left">
					<div class="c-left-right__content-inner c-left-right__content-inner--left wysiwyg-content">
						<?php echo $product_info_content; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( have_rows( 'product_info_links' ) ) :  ?>
				<div class="c-left-right__content c-left-right__content--right">
					<div class="c-left-right__content-inner c-left-right__content-inner--right wysiwyg-content">
						<?php
						while ( have_rows( 'product_info_links' ) ) :
							the_row();
							base_display_acf_link( get_sub_field( 'product_link' ), [ 'button', 'button--secondary', 'button--full-width' ] );
						endwhile;
						?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
endif;
