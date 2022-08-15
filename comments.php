			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'be-good' ); ?></p>
			</div>
	<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title">
			<?php
			if ( 1 === get_comments_number() ) {
				printf(
					__( 'One Response to %s', 'be-good' ),
					'<em>' . get_the_title() . '</em>'
				);
			} else {
				printf(
					_n( '%1$s Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'be-good' ),
					number_format_i18n( get_comments_number() ),
					'<em>' . get_the_title() . '</em>'
				);
			}
			?>
			</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older', 'be-good' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer <span class="meta-nav">&raquo;</span>', 'be-good' ) ); ?></div>
			</div>
	<?php endif; ?>

			<ol class="commentlist">
				<?php
					wp_list_comments( array( 'callback' => 'be-good_comment' ) );
				?>
			</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older', 'be-good' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer <span class="meta-nav">&raquo;</span>', 'be-good' ) ); ?></div>
			</div>
	<?php endif; ?>

	<?php
	if ( ! comments_open() && get_comments_number() ) :
		?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'be-good' ); ?></p>
	<?php endif; ?>

<?php endif; ?>
<?php comment_form(); ?>
</div>
