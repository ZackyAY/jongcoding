<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Shadow Themes
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bulletin_news_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// When global archive layout is checked.
	if ( is_archive() || is_404() || is_search() ) {
		$archive_sidebar = get_theme_mod( 'bulletin_news_archive_sidebar', 'right' ); 
		$classes[] = esc_attr( $archive_sidebar ) . '-sidebar';   

  } else if ( bulletin_news_is_latest_posts() ) { // When global post sidebar is checked.

      $blog_post_sidebar = get_theme_mod( 'bulletin_news_blog_sidebar', 'no' ); 
      $classes[] = esc_attr( $blog_post_sidebar ) . '-sidebar';
    
  } else if ( is_single() ) { // When global post sidebar is checked.
    	
			$global_post_sidebar = get_theme_mod( 'bulletin_news_global_post_layout', 'right' ); 
			$classes[] = esc_attr( $global_post_sidebar ) . '-sidebar';
    	
	} elseif ( bulletin_news_is_frontpage_blog() || is_page() ) {
		if ( bulletin_news_is_frontpage_blog() ) {
			$page_id = get_option( 'page_for_posts' );
		} else {
			$page_id = get_the_ID();
		}


			$global_page_sidebar = get_theme_mod( 'bulletin_news_global_page_layout', 'right' ); 
			$classes[] = esc_attr( $global_page_sidebar ) . '-sidebar';
		
	}

	// Site layout classes
	$site_layout = get_theme_mod( 'bulletin_news_site_layout', 'wide' );
	$classes[] = esc_attr( $site_layout ) . '-layout';


	return $classes;
}
add_filter( 'body_class', 'bulletin_news_body_classes' );

function bulletin_news_post_classes( $classes ) {
	if ( bulletin_news_is_page_displays_posts() ) {
		// Search 'has-post-thumbnail' returned by default and remove it.
		$key = array_search( 'has-post-thumbnail', $classes );
		unset( $classes[ $key ] );
		
		$archive_img_enable = get_theme_mod( 'bulletin_news_enable_archive_featured_img', true );

		if( has_post_thumbnail() && $archive_img_enable ) {
			$classes[] = 'has-post-thumbnail';
		} else {
			$classes[] = 'no-post-thumbnail';
		}
	}
  
	return $classes;
}
add_filter( 'post_class', 'bulletin_news_post_classes' );

/**
 * Excerpt length
 * 
 * @since Shadow Themes 1.0.0
 * @return Excerpt length
 */
function bulletin_news_excerpt_length( $length ){
	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'bulletin_news_archive_excerpt_length', 30 );
	return $length;
}
add_filter( 'excerpt_length', 'bulletin_news_excerpt_length', 999 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function bulletin_news_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'bulletin_news_pingback_header' );

/**
 * Get an array of post id and title.
 * 
 */
function bulletin_news_get_post_choices() {
	$choices = array( '' => esc_html__( '--Select Post--', 'bulletin-news' ) );
	$args = array( 'numberposts' => -1, );
	$posts = get_posts( $args );

	foreach ( $posts as $post ) {
		$id = $post->ID;
		$title = $post->post_title;
		$choices[ $id ] = $title;
	}

	return $choices;
}

if( !function_exists( 'bulletin_news_get_page_choices' ) ) :
  /*
   * Function to get pages
   */
  function bulletin_news_get_page_choices() {

    $pages  =  get_pages();
    $page_list = array();
    $page_list[0] = esc_html__( '--Select Page--', 'bulletin-news' );

    foreach( $pages as $page ){
      $page_list[ $page->ID ] = $page->post_title;
    }

    return $page_list;

  }
endif;

/**
 * Get an array of cat id and title.
 * 
 */

if( !function_exists( 'bulletin_news_get_post_cat_choices' ) ) :
  /*
   * Function to get categories
   */
  function bulletin_news_get_post_cat_choices() {
    $categories = get_terms( 'category' );
    $choices = array('' => esc_html__( '--Select Category--', 'bulletin-news' ));

    foreach( $categories as $category ) {
      $choices[$category->term_id] = $category->name;
    }

    return $choices;
  }
endif;


/**
 * Checks to see if we're on the homepage or not.
 */
function bulletin_news_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Your latest posts".
 */
function bulletin_news_is_latest_posts() {
	return ( is_front_page() && is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Posts page".
 */
function bulletin_news_is_frontpage_blog() {
	return ( is_home() && ! is_front_page() );
}

/**
 * Checks to see if the current page displays any kind of post listing.
 */
function bulletin_news_is_page_displays_posts() {
	return ( bulletin_news_is_frontpage_blog() || is_search() || is_archive() || bulletin_news_is_latest_posts() );
}

/**
 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
 * which should be used in theme templates.
 *
 * @since  1.0.0
 * @access public
 * @param  array $args Arguments to pass to Breadcrumb_Trail.
 * @return void
 */
function bulletin_news_breadcrumb( $args = array() ) {
	$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

	if ( ! is_object( $breadcrumb ) )
		$breadcrumb = new Breadcrumb_Trail( $args );

	return $breadcrumb->trail();
}

/**
 * Pagination in archive/blog/search pages.
 */
function bulletin_news_posts_pagination() { 
	$archive_pagination = get_theme_mod( 'bulletin_news_archive_pagination_type', 'numeric' );
	if ( 'disable' === $archive_pagination ) {
		return;
	}
	if ( 'numeric' === $archive_pagination ) {
		the_posts_pagination( array(
            'prev_text'          => bulletin_news_get_icon_svg( 'menu_icon_up' ),
            'next_text'          => bulletin_news_get_icon_svg( 'menu_icon_up' ),
        ) );
	} elseif ( 'older_newer' === $archive_pagination ) {
        the_posts_navigation( array(
            'prev_text'          => bulletin_news_get_icon_svg( 'menu_icon_up' ) . '<span>'. esc_html__( 'Older', 'bulletin-news' ) .'</span>',
            'next_text'          => '<span>'. esc_html__( 'Newer', 'bulletin-news' ) .'</span>' . bulletin_news_get_icon_svg( 'menu_icon_up' ),
        )  );
	}
}

// Add auto p to the palces where get_the_excerpt is being called.
add_filter( 'get_the_excerpt', 'wpautop' );



if ( ! class_exists( 'WP_Customize_Control' ) ) {
  return null;
} 