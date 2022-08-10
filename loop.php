    <!-- Main Content -->
    <main class="container mt-2 pb-2 text-justify">
	<div class="left">
<?php if(is_author()) { ?>
	<h1 class="entry-title author">
				<?php
					the_author();
				?>
				</h1>

<?php
if ( get_the_author_meta( 'description' ) ) :
	?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php
							$author_bio_avatar_size = apply_filters( 'twentyten_author_bio_avatar_size', 60 );
							echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
							?>
						</div>
						<div id="author-description">
							<h2 class="entry-title">
							<?php
							printf( __( 'About %s', 'twentyten' ), get_the_author() );
							?>
							</h2>
							<?php the_author_meta( 'description' ); ?>
						</div>
					</div>
<?php endif; ?>
	<!-- Social Share -->
    <div class="mt-1 pb-2">
        <amp-social-share type="facebook" aria-label="Share on Facebook" data-param-app_id="1617851248586727" width="35" height="35"></amp-social-share>
        <amp-social-share type="linkedin" aria-label="Share on LinkedIn" width="35" height="35"></amp-social-share>
        <amp-social-share type="pinterest" aria-label="Share on Pinterest" data-param-media="https://aus.co.id/assets/images/logo.png" width="35" height="35"></amp-social-share>
        <amp-social-share type="twitter" aria-label="Share on Twitter" width="35" height="35"></amp-social-share>
    </div>
	<!-- /Social Share -->
<header>
<h1 class="entry-title">
<?php
					the_author();
				?> Archives
</h1>
</header>
	<?php }
		?>

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) :
			the_post(); 
	?>	
	<article class="list mt-1">
<div class="left">
<a href="<?php the_permalink(); ?>" alt="thumbnail">
<?php
if ( has_post_thumbnail() ) { 
    the_post_thumbnail( 'my-thumbnail' ); 
} else { ?>
<img src="https://aus.co.id/wp-content/uploads/2022/07/default.png" width="400" height="340" alt="<?php echo my_alt(); ?>">
<?php }
?>
</a>
</div>
<div class="right">
		<header class="entry-header">
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h1>

				<?php
				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
					<?php posted_on(); ?>
					</div>
					<?php
				endif;
				?>

		</header>
		<div class="entry-content">
				<?php
						the_excerpt();
				?>
		</div>
		<div class="entry-footer">
				<?php posted_in(); ?>
		</div>
</div>
	</article>
	<?php
		endwhile;
	} else { 
    	echo 'No post.';
    }
	?>
	
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div class="navigation mt-2 clearfix">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div>
<?php endif; ?>
<?php comments_template( '', true ); ?>
</div>