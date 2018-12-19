<?php

  $popup_title               = get_field( 'page_popup_title' );
  $popup_subtitle            = get_field( 'page_popup_subtitle' ); 
  $popup_message             = get_field( 'page_popup_message' ) ? get_field( 'page_popup_message' ) : '';

	


?> 

<div class="modal-overlay js-modal-overlay js-close-modal"></div>

<div id="modal-cta" class="modal-cta modal c-modal js-modal">
  	<div class="modal-header"> 
		  <?php if($popup_title): ?>
				<h2><?php esc_html_e( $popup_title, 'base' ); ?></h2>
			<?php endif; ?>
		  <?php if($popup_subtitle): ?>
				<h3><?php esc_html_e( $popup_subtitle, 'base' ); ?></h3>
			<?php endif; ?>
  	</div>
  	<div class="modal-content">
    		<?php // Get gravity form or message
        		 echo do_shortcode( $popup_message );
    		?>
      </div> 
    <button id="modal-cta-close" aria-label="Close modal" aria-labelledby="modal-cta modal-cta-close" class="button close-button c-modal__close js-close-modal button button--small button--white" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
    </button>
</div>
