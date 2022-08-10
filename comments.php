			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'project-1' ); ?></p>
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
					__( 'One Response to %s', 'project-1' ),
					'<em>' . get_the_title() . '</em>'
				);
			} else {
				printf(
					_n( '%1$s Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'project-1' ),
					number_format_i18n( get_comments_number() ),
					'<em>' . get_the_title() . '</em>'
				);
			}
			?>
			</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older', 'project-1' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer <span class="meta-nav">&raquo;</span>', 'project-1' ) ); ?></div>
			</div>
	<?php endif; ?>

			<ol class="commentlist">
				<?php
					wp_list_comments( array( 'callback' => 'project-1_comment' ) );
				?>
			</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older', 'project-1' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer <span class="meta-nav">&raquo;</span>', 'project-1' ) ); ?></div>
			</div>
	<?php endif; ?>

	<?php
	if ( ! comments_open() && get_comments_number() ) :
		?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'project-1' ); ?></p>
	<?php endif; ?>

<?php endif; ?>
<?php comment_form(); ?>
</div>