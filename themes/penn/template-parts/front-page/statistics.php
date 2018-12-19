<?php
/**
 * Statistics
 *
 * @package Base
 */
if ( have_rows( 'homepage_statistics' ) ) :
?>
	<div class="c-statistics">
<?php
while ( have_rows( 'homepage_statistics' ) ) :
	the_row();
	$value   = get_sub_field( 'value' );
	$subtext = get_sub_field( 'sub_text' );
?>
	<div class="c-statistics__stat">
		<h2 class="h2"><?php echo $value; ?></h2>
		<h5 class="h5"><?php echo $subtext; ?></h5>
	</div>
<?php
endwhile;
?>
	</div>
<?php
endif;
?>
