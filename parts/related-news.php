<?php if (!empty($related_posts)) { ?>
    <div class="related-news">
        <h2 class="related-news-title"><?php _e('Related News', 'be-good'); ?></h2>
	</div>
        <ul class="related-news-list">
            <?php
            foreach ($related_posts as $post) {
                setup_postdata($post);
            ?>
            <li>
                <a class="title" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
<?php
}