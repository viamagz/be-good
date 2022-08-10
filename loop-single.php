    <!-- Main Content -->
    <main class="container mt-2 text-justify">
	<?php
	if ( have_posts() ) {
			the_post(); 
	?>	
	<article class="content mt-05 left">
		<header class="entry-header">
				<h1 class="entry-title">
					<?php the_title(); ?>
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
	<?php
if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
}
?>
	<!-- Social Share -->
    <div class="mt-1 pb-2">
        <amp-social-share type="facebook" aria-label="Share on Facebook" data-param-app_id="1617851248586727" width="35" height="35"></amp-social-share>
        <amp-social-share type="linkedin" aria-label="Share on LinkedIn" width="35" height="35"></amp-social-share>
        <amp-social-share type="pinterest" aria-label="Share on Pinterest" data-param-media="https://aus.co.id/assets/images/logo.png" width="35" height="35"></amp-social-share>
        <amp-social-share type="twitter" aria-label="Share on Twitter" width="35" height="35"></amp-social-share>
    </div>
	<!-- /Social Share -->
<?php } ?>
		</header>
		<?php
			if ( has_post_thumbnail()) {
				?>
				<figure class="wp-caption aligncenter">
					<?php the_post_thumbnail( 'full' ); ?>
					<?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
						<figcaption class="wp-caption-text"><?php echo esc_html( $caption ); ?></figcaption>
					<?php endif; ?>
				</figure>
				<?php
			}
	?>
		<div class="entry-content">
				<?php
						the_content();
				?>
		</div>
		<div class="entry-footer">
				<?php posted_in(); ?>
		</div>
		<?php related_posts(); ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous news article link', 'be-good' ) . '</span> Prev' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', 'Next <span class="meta-nav">' . _x( '&rarr;', 'Next news article link', 'be-good' ) . '</span>' ); ?></div>
		</div>
		<?php comments_template( '', true ); ?>
	</article>