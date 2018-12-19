<?php
if ( ! function_exists( 'foundation_comment' ) ) {
	function foundation_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
			case 'pingback' :
			case 'trackback' :
				?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                <p>
                    Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( '(Edit)', '<span>', '</span>' ); ?></p>
				<?php
				break;
			default :
				global $post;
				?>
            <li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                <article id="comment-<?php comment_ID(); ?>" class="comment">
                    <header>
						<?php
						echo "<span class='comment-gravatar'>";
						echo get_avatar( $comment, 44 );
						echo "</span>";
						printf( '%2$s %1$s',
							get_comment_author_link(),
							( $comment->user_id === $post->post_author ) ? '<span class="visual-hide">Posted by: </span>' : ''
						);
						printf( '<a href="%1$s" class="comment-datetime"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( __( '%1$s', 'base' ), get_comment_date() )
						);
						?>
                    </header>
					<?php if ( '0' == $comment->comment_approved ) { ?>
                        <p>Your comment is awaiting moderation.</p>
					<?php } ?>
                    <section>
						<?php comment_text(); ?>
                    </section>
                    <div class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => 'Reply',
							'after'      => '<br><br>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						) ) ); ?>
                    </div>
                </article>
				<?php
				break;
		}
	}
}
?>