<?php
if ( ! function_exists( 'amped_browserupdate_enqueue' ) ) {

	function amped_browserupdate_enqueue() {

		if ( is_front_page() ) { ?>

			<script>
				// Config
				var $buoop = {
					vs: { i:10, f:-4, o:-4, s:8, c:-4 },
					api: 4,
					text: '<span class="buorg_message"><strong>Your browser ({brow_name}) is out of date.</strong> Update your browser for more security on this site.</span> <span class="buorg_buttons"><a{up_but}>Update</a><a{ignore_but}>Ignore</a></span>'
				};

				// Create script tag
				window.onload = function() {
					var e = document.createElement( 'script' );
					e.type = 'text/javascript';
					e.src = '//browser-update.org/update.min.js';
					document.body.appendChild( e );
				};

			</script>

		<?php
		}

	}

	if ( ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', 'amped_browserupdate_enqueue' );
	}

}
?>