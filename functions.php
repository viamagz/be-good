<?php 

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'title-tag' );

add_theme_support( 'post-thumbnails' );

add_image_size( 'my-thumbnail', 400, 340, true );
	
add_theme_support( 'custom-logo' );

register_nav_menus(
	array(
		'primary'   => esc_html__( 'Primary', 'be-good' )
	)
);

function set_css() {
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), '1', false);
}
add_action( 'wp_enqueue_scripts', 'set_css' );
		
if ( ! function_exists( 'posted_on' ) ) :

	function posted_on() {
		printf(
			__( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'be-good' ),
			'meta-prep meta-prep-author',
			sprintf(
				'<a href="%1$s" title="%2$s"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf(
				'<span><a href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				esc_attr( sprintf( __( 'View all news articles by %s', 'be-good' ), get_the_author() ) ),
				get_the_author()
			)
		);
	}
endif;

if ( ! function_exists( 'posted_in' ) ) :

	function posted_in() {
		$tags_list = get_the_tag_list( '', ', ' );

		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			$posted_in = __( 'Posted in %1$s. Tagged %2$s. Get the <a href="%3$s">permalink</a>.', 'be-good' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This news article was posted in %1$s. Get the <a href="%3$s">permalink</a>.', 'be-good' );
		} else {
			$posted_in = __( 'Get the <a href="%3$s">permalink</a>.', 'be-good' );
		}
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tags_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	}
endif;

function set_widget() {
	register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'be-good' ),
        'id'            => 'sidebar',
        'description'   => __( 'Widgets in this area will be shown on the sidebar of all posts and pages.', 'be-good' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => __( 'Secondary Sidebar', 'be-good' ),
        'id'            => 'secondary-sidebar',
        'description'   => __( 'Widgets in this area will be shown on the secondary sidebar at posts.', 'be-good' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => __( 'Footer Sidebar', 'be-good' ),
        'id'            => 'footer-sidebar',
        'description'   => __( 'Widgets in this area will be shown on the footer of all posts and pages.', 'be-good' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'set_widget' );

add_filter( 'widget_tag_cloud_args', 'all_tag_cloud_widget_parameters' );
function all_tag_cloud_widget_parameters() {
    $args = array(
        'smallest' => 14, 
        'largest' => 14, 
        'unit' => 'px', 
        'number' => 12,
        'format' => 'flat', 
        'separator' => "\n", 
        'orderby' => 'name', 
        'order' => 'ASC', 
        'post_type' => 'post', 
        'echo' => false
    );
    return $args;
}

function related_posts($args = array()) {
    global $post;

    // default args
    $args = wp_parse_args($args, array(
        'post_id' => !empty($post) ? $post->ID : '',
        'taxonomy' => 'category',
        'limit' => 7,
        'post_type' => !empty($post) ? $post->post_type : 'post',
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    // check taxonomy
    if (!taxonomy_exists($args['taxonomy'])) {
        return;
    }

    // post taxonomies
    $taxonomies = wp_get_post_terms($args['post_id'], $args['taxonomy'], array('fields' => 'ids'));

    if (empty($taxonomies)) {
        return;
    }

    // query
    $related_posts = get_posts(array(
        'post__not_in' => (array) $args['post_id'],
        'post_type' => $args['post_type'],
        'tax_query' => array(
            array(
                'taxonomy' => $args['taxonomy'],
                'field' => 'term_id',
                'terms' => $taxonomies
            ),
        ),
        'posts_per_page' => $args['limit'],
        'orderby' => $args['orderby'],
        'order' => $args['order']
    ));

    require( 'parts/related-news.php' );

    wp_reset_postdata();
}

function mytheme_custom_excerpt_length( $length ) {
    return 21;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );

if ( ! function_exists( 'continue_reading_link' ) ) :

	function continue_reading_link() {
		return ' <a href="' . get_permalink() . '">' . __( 'Read more', 'be-good' ) . '</a>';
	}
endif;

function auto_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		return ' &hellip;' . continue_reading_link();
	}
	return $more;
}
add_filter( 'excerpt_more', 'auto_excerpt_more' );

function custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() && ! is_admin() ) {
		$output .= continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'custom_excerpt_more' );

function the_copyright() { ?>
	<div class="text-center mt-2 pb-2"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a> <?php echo "© " . date('Y'); ?>
<?php } ?>