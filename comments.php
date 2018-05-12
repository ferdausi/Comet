<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="post-comment-box">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h3>
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( '1 Comment', 'sygnus' ), get_the_title() );
			} else {
				printf(
				/* translators: 1: number of comments, 2: post title */
						_nx(
								'%1$s Comment',
								'%1$s Comments',
								$comments_number,
								'sygnus'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
				);
			}
			?>
		</h3>

		<div class="post-comment-wraper">
			<ul class="media-list">
				<?php   wp_list_comments('short_ping=true&type=comment&avatar_size=40&callback=comet_comments'); ?>
			</ul>
		</div>



		<!--        --><?php //the_comments_pagination( array(
//            'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'twentyseventeen' ) . '</span>',
//            'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
//        ) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'comet' ); ?></p>
		<?php
	endif;

	comet_comment_form();
	?>

</div><!-- #comments -->