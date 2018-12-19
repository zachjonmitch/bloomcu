<?php
/**
 * Social Share
 *
 * @package Base
 */

$social_links = the_social_share_links( array( 'facebook', 'twitter', 'google', 'pinterest', 'linkedin', 'email' ), false );

?>
<?php if ( ! empty( $social_links ) ) { ?>
	<aside class="social-share">
		<?php echo $social_links; //XSS ?>
	</aside>
<?php } ?>
