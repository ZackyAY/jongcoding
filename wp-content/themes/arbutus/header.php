<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up untill <div id="content">
 *
 * @package Arbutus
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
	}
	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
} ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'arbutus' ); ?></a>

	<?php if ( is_front_page() && get_header_image() ) : ?>
		<header id="masthead" class="site-header has-header-image" role="banner">
			<?php the_custom_header_markup(); ?>
			<div class="inner site-branding">
				<?php the_custom_logo(); ?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .inner -->
	<?php else : ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			</div>
	<?php endif; // Front page/header image check. ?>
		<nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr( _x( 'Main', 'main navigation', 'arbutus' ) ); ?>">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 3 ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
