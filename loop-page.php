    <!-- Main Content -->
    <main class="container mt-2 text-justify">
	<?php
	if ( have_posts() ) {
			the_post(); 
	?>	
	<article class="content left">
		<header class="entry-header">
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
		</header>
		<div class="entry-content">
				<?php
						the_content();
				?>
		</div>
	</article>
    <?php } ?>