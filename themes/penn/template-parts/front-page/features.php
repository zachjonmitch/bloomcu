<?php
/**
* Front Page Features
*
* @package Base
*/
$homepage_router_title = get_field( 'homepage_router_title' );

?>
<div class="l-features-home">
	<div class="l-features-home__facade"></div>

	<div class="l-features-home__content">
		<div class="l-features-home__left">
			<?php if ( $homepage_router_title ) { ?>
				<h2 class="h2 h-color-primary"><?php echo $homepage_router_title; ?></h2>
			<?php } ?>
		</div>

		<div class="l-features-home__right">
			<?php if ( have_rows( 'homepage_router' ) ) : ?>
				<ul class="c-features">
					<?php
					while ( have_rows( 'homepage_router' ) ) :
						the_row();

						$router_link = get_sub_field( 'router_link' );
						$router_icon = get_sub_field( 'router_icon' );
						?>

							<li class="c-features__item">
								<a
									href="<?php echo esc_url( $router_link['url'] ); ?>"
									<?php echo $router_link['target'] ? 'target="_blank" rel="noopener"' : ''; ?>
									class="c-features__link"
								>
									<div class="c-features__icon-wrapper">
										<?php if ( $router_icon ) { ?>
											<img
												src="<?php echo $router_icon['url']; ?>"
												alt="<?php echo $router_link['title']; ?>"
												class="c-features__icon"
											>
										<?php } ?>
									</div>

									<div class="c-features__link-title"><?php echo $router_link['title']; ?></div>
								</a>
							</li>

						<?php
					endwhile;
					?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>
