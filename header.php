<!-- HTML Document -->
<!DOCTYPE html>

<!-- HTML -->
<html <?php language_attributes(); ?> itemscope="true" itemtype="<?php if(is_single()) { echo 'https://schema.org/NewsArticle'; } else if(is_page()) { echo 'https://schema.org/WebPage'; } else { echo ' https://schema.org/WebSite'; } ?>">

<!-- Document Head -->
<head>

    <!-- Essential Metatags -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!-- /Essential Metatags -->

<?php wp_head() ?>
	<!-- CSS -->
<?php if(is_user_logged_in() && !is_customize_preview()){?><style>nav#menu{padding-top:32px}amp-sidebar#side-menu{top:0}amp-sidebar#side-menu{padding-top: 45px;}</style><?php } ?>
	<!-- /CSS -->
	
</head>
<!-- /Document Head -->

<!-- Document Body -->
<body <?php body_class(); ?>>
    <?php do_action( 'wp_body_open' ); ?>
    <!-- Menu -->
    <nav id="menu">
<?php // We require logo
$logo =  wp_get_attachment_url( get_theme_mod( 'custom_logo' ) );
?>
        <div class="container"><div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" width="144" height="60" alt="<?php bloginfo('name'); ?>"></a></div>
		<div class="btn-toggler"><div class="menu-toggler" on="tap:side-menu.toggle">☰</div></div></div>
    </nav>
	
	<amp-sidebar id="side-menu" layout="nodisplay" side="left">
	<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" width="144" height="60" alt="<?php bloginfo('name'); ?>"></a></div>
	<div on="tap:side-menu.toggle" class="toggler-menu">☰</div>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => 'div',
			'menu_id'        => 'primary-menu',
			'link_before'    => '<span>',
			'link_after'     => '</span>',
		)
	);
	?>

		<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" name="s" id="s" placeholder="<?php echo esc_html__( 'Search', 'be-good' ); ?>" />
		</form>
</amp-sidebar>
    <!-- /Menu -->