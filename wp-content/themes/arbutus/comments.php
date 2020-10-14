<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Arbutus
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

		<h2 class="comments-title">
			<?php
			$comments_number = absint( get_comments_number() );
			if ( ! have_comments() ) {
				_e( 'Leave a Comment', 'arbutus' );
			} elseif ( 1 === $comments_number ) {
				/* translators: %s: Post title. */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'arbutus' ), esc_html( get_the_title() ) );
			} else {
				printf(
					/* translators: 1: Number of comments, 2: Post title. */
					_nx(
						'%1$s reply on &ldquo;%2$s&rdquo;',
						'%1$s replies on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'arbutus'
					),
					number_format_i18n( $comments_number ),
					esc_html( get_the_title() )
				);
			}

			?>
		</h2><!-- .comments-title -->


	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation" aria-label="<?php esc_attr( _x( 'Comment', 'comment navigation', 'arbutus' ) ); ?>">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'arbutus' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '<span aria-hidden="true">&larr;</span> Older Comments', 'arbutus' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span aria-hidden="true">&rarr;</span>', 'arbutus' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'arbutus' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array(
		'comment_notes_after' => '',
		'title_reply' => '',
		'title_reply_before' => '',
		'title_reply_after' => ''
	) ); ?>

</div><!-- #comments -->
