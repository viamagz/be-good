<?php get_header(); ?>

    <!-- Main Content -->
    <main class="container mt-2 text-justify">
	<article class="content">
		<header class="entry-header">
				<h1 class="entry-title">
					<?php printf('404'); ?>
				</h1>
		</header>
		<div class="entry-content">
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php printf('Home'); ?></a></p>
		</div>
	</article>
	</main>
    <!-- /Main Content -->

<?php get_footer(); ?>