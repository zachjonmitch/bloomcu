<?php
if ( post_password_required() ) {
	return;
}

$comments_args = array(
	'id_form'           => 'commentform',
	'class_form'      => 'comment-form',
	'id_submit'         => 'submit',
	'class_submit'      => 'submit',
	'name_submit'       => 'submit',
	'title_reply'       => __( 'Leave a Comment' ),
	'title_reply_to'    => __( 'Reply to Comment' ),
	'cancel_reply_link' => __( '<br>Cancel' ),
	'label_submit'      => __( 'Post Comment' ),
	'format'            => 'xhtml',

	'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment*', 'noun' ) .
	                    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
	                    '</textarea></p>',

	'must_log_in' => '<p class="must-log-in">' .
	                 sprintf(
		                 __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		                 wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
	                 ) . '</p>',

	'logged_in_as' => '',

	'comment_notes_before' => '',

	'comment_notes_after' => ''
);

?>

<div id="comments" class="comments-area base-content">

	<?php if ( have_comments() ) : ?>

        <h4 class="comment-title">
			<?php
			printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'base' ),
				number_format_i18n( get_comments_number() ), 'COMMENTS' );
			?>
        </h4>

        <ul class="comment-list">
            <?php 
            wp_list_comments( array(
				'callback' => 'foundation_comment',
				'style'    => 'ul'
			) );
			?>
        </ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
            <nav role="navigation">
                <h4>Comment navigation</h4>
                <div><?php previous_comments_link( 'Older Comments' ); ?></div>
                <div><?php next_comments_link( 'Newer Comments' ); ?></div>
            </nav>
		<?php }

		if ( ! comments_open() && get_comments_number() ) { ?>
            <p>Comments are closed.</p>
		<?php } ?>

	<?php endif; ?>

	<?php if ( comments_open() ) { ?>

        <div class="panel comment-form">
			<?php comment_form($comments_args); ?>
        </div>

	<?php } ?>

</div><!-- #comments -->
