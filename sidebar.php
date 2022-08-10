<div class="right">
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
								<?php dynamic_sidebar( 'sidebar' ); ?>
						<?php endif; ?>
<?php if ( is_active_sidebar( 'secondary-sidebar' ) ) : ?>
								<?php dynamic_sidebar( 'secondary-sidebar' ); ?>
						<?php endif; ?>
</div>