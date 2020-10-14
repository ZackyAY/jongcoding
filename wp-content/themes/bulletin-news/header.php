<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shadow Themes
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <?php do_action( 'wp_body_open' ); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bulletin-news' ); ?></a>

    <?php 
        $top_menu_enable = get_theme_mod('bulletin_news_enable_top_menu', true );
        $top_social_menu_enable = get_theme_mod('bulletin_news_enable_top_social_menu', true ); 
        if ( (true==$top_menu_enable) && (has_nav_menu( 'top' ) || has_nav_menu( 'social' ) ) ) : ?>
        <div id="topbar-menu">
            <button>
            <?php 
                echo bulletin_news_get_icon_svg( 'menu_icon_up' );
                echo bulletin_news_get_icon_svg( 'menu_icon_down' );
            ?>
            </button>
            <div class="wrapper">
                <?php 
                    

                    wp_nav_menu( array(
                        'theme_location' => 'top',
                        'container'     => 'div',
                        'container_class' => 'secondary-menu',
                        'fallback_cb'   => false,
                    ) ); ?> 
                    <?php $current_date = date('l jS F Y'); ?>
                    <li class="current-date" > 
                        <?php echo $current_date ?> 
                    </li>
                   <?php if ( true == $top_social_menu_enable) {
                        wp_nav_menu( array(
                            'theme_location' => 'social',
                            'container'     => 'div',
                            'container_class' => 'social-menu',
                            'menu_class'     => 'social-icons',
                            'fallback_cb'   => false,
                            'link_before'    => '<span class="screen-reader-text">',
                            'link_after'     => '</span>' . bulletin_news_get_icon_svg( 'link' ),
                            'depth'          => 1,
                        ) );
                    }
                ?>
            </div><!-- .wrapper -->
        </div><!-- #topbar-menu -->
    <?php endif;

    ?>
    <?php 
        $header_background_image = get_theme_mod('bulletin_news_header_background_image');  
        $header_ads_image = get_theme_mod('bulletin_news_header_ads_image');
        $header_ads_image_url = get_theme_mod('bulletin_news_header_ads_image_url');
        $header_ads_image_enable = get_theme_mod('bulletin_news_header_ads_image_enable');
     ?>
    <header id="shadow-masthead" class="site-header" role="banner" style="background-image: url('<?php echo esc_url( $header_background_image ); ?>')">
        <div class="wrapper">
          <div class="shadow-site-branding" style="<?php if (empty($header_ads_image) || (false == $header_ads_image_enable) ){ ?> width:100%; text-align: center; <?php    } ?>; ">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="site-logo">
    					<?php the_custom_logo(); ?>
                    </div><!-- .site-logo -->
                <?php endif; ?>
 
                <div id="site-identity">
                    <?php
					if ( is_front_page() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
					<?php
					endif; ?>
                </div><!-- .shadow-site-branding-text -->
                
            </div><!-- .wrapper -->
           
            <?php if (!empty($header_ads_image) && true== $header_ads_image_enable): ?>
                <div class="shadow-header-ads">
                    <a href="<?php echo esc_url($header_ads_image_url); ?>" target="_blank"><img src="<?php echo esc_url($header_ads_image ); ?>"></a>
                </div>
            <?php endif ?>
        </div><!-- .shadow-site-branding -->

        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav id="site-navigation" class="shadow-main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'bulletin-news' );?>">
                <div class="wrapper">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-label"><?php esc_html_e( 'Menu', 'bulletin-news' );?></span>
                        <svg viewBox="0 0 40 40" class="icon-menu">
                            <g>
                                <rect y="7" width="40" height="2"/>
                                <rect y="19" width="40" height="2"/>
                                <rect y="31" width="40" height="2"/>
                            </g>
                        </svg>
                        <svg viewBox="0 0 612 612" class="icon-close">
                            <polygon points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 
                            306,341.411 576.521,611.397 612,575.997 341.459,306.011"/>
                        </svg>
                    </button>
                    <?php

    				wp_nav_menu( array(
    					'theme_location' => 'primary',
    					'menu_id'        => 'primary-menu',
    					'menu_class'	 => 'menu nav-menu',
                    ) ); ?>
                </div><!-- .wrapper -->
            </nav><!-- #site-navigation -->
        <?php elseif( current_user_can( 'edit_theme_options' ) ): ?>
            <nav class="shadow-main-navigation" id="site-navigation">
                <div class="wrapper">
                    <ul id="primary-menu" class="menu nav-menu">
                        <li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php echo esc_html__( 'Add a menu', 'bulletin-news' );?></a></li>
                    </ul>
                </div><!-- .wrapper -->
            </nav>
        <?php endif; ?> 
    </header><!-- #shadow-masthead -->

	<div id="content" class="site-content">
    <?php 
        if ( ( is_front_page() || is_home() )) {

            get_template_part( 'inc/homepage/breaking-news' ); 

            get_template_part( 'inc/homepage/hero-section' ); 

            get_template_part( 'inc/homepage/trending' ); 
        } 
    ?>