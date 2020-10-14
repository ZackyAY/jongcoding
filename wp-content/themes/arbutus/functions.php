<?php
/**
 * Arbutus functions and definitions
 *
 * @package Arbutus
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = get_theme_mod( 'content_width', 660 ); /* pixels */
}

if ( ! function_exists( 'arbutus_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function arbutus_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Arbutus, use a find and replace
	 * to change 'arbutus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'arbutus' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1600, 900, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'arbutus' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style', 'navigation-widgets'
	) );

	/*
	 * Add support for instant widget live previews in the customizer.
	 */
	add_theme_support( 'customize-selective-refresh-widgets', true );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'gallery', 'image', 'quote', 'video', 'audio'
	) );

	/**
	 * Setup the WordPress core custom header feature.
	 */
	add_theme_support( 'custom-header', apply_filters( 'arbutus_custom_header_args', array(
		'default-image'  => '',
		'width'          => 1600,
		'height'         => 900,
		'header-text'    => false,
		'random-defailt' => true,
		'video'          => true,
	) ) );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'beach-madrone' => array(
			'url' => '%s/img/headers/beach-madrone.jpg',
			'thumbnail_url' => '%s/img/headers/beach-madrone-small.jpg',
			/* translators: header image description */
			'description' => __( 'Beach Madrone', 'arbutus' )
		),
		'marina-strawberry' => array(
			'url' => '%s/img/headers/marina-strawberry.jpg',
			'thumbnail_url' => '%s/img/headers/marina-strawberry-small.jpg',
			/* translators: header image description */
			'description' => __( 'Marina Strawberry', 'arbutus' )
		),
		'madrone-berries' => array(
			'url' => '%s/img/headers/madrone-berries.jpg',
			'thumbnail_url' => '%s/img/headers/madrone-berries-small.jpg',
			/* translators: header image description */
			'description' => __( 'Madrone Berries', 'arbutus' )
		),
	) );

	/*
	 * Add support for custom logos.
	 */
	add_theme_support( 'custom-logo', array(
		'height' => 115,
		'width' => 230,
		'flex-width' => true,
		'header-text' => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true,
	) );

	/**
	 * Allow widgets to be previewed faster in the customizer with selective refresh.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Disable user-defined font size selection to encourage consistency.
	add_theme_support( 'disable-custom-font-sizes' );

	// Disable color pickers in the editor in favor of theme colors.
	add_theme_support( 'disable-custom-colors' );

	// Disable gradients.
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'editor-gradient-presets', array() );

	// Add support for wide alignments in the block editor;
	add_theme_support( 'align-wide' );

	// Load classic editor styles into the block editor.
	add_theme_support( 'editor-styles' );

	/*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'editor-style.css', arbutus_font_url() ) );
	
	// Load default block styles.
	add_theme_support( 'wp-block-styles' );
	
	 // Add support for the theme color scheme.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Black', 'arbutus' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => __( 'Charcoal', 'arbutus' ),
				'slug'  => 'charcoal',
				'color' => '#222222',
			),
			array(
				'name'  => __( 'Light Gray', 'arbutus' ),
				'slug'  => 'light-gray',
				'color' => '#cccccc',
			),
			array(
				'name'  => __( 'White', 'arbutus' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Accent Light', 'arbutus' ),
				'slug'  => 'accent-light',
				'color' => get_theme_mod( 'accent_color', '#93a3d8' ),
			),
			array(
				'name'  => __( 'Accent Dark', 'arbutus' ),
				'slug'  => 'accent-dark',
				'color' => '#2c12ed',
			),
		)
	);

	// Disable gradients.
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'editor-gradient-presets', array() );

	/*
	 * Add theme support for starter content.

	 */
	add_theme_support( 'starter-content', array(
		
		'posts' => array(
			'about',
			'contact',
		),

		'options' => array(
			'show_on_front' => 'posts',
		),

		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary Menu', 'arbutus' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_contact',
				),
			),
		),

		'widgets' => array(
			'footer' => array(
				'search',
				'text_about',
				'categories',
			),
		),
	) );

}
endif; // arbutus_setup
add_action( 'after_setup_theme', 'arbutus_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function arbutus_content_width() {

	$content_width = $GLOBALS['content_width'];

	if ( ! is_singular() ) {
		$content_width = 660;
	}

	/**
	 * Filter Arbutus content width of the theme.
	 *
	 * @since Arbutus 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'arbutus_content_width', $content_width );
}
add_action( 'template_redirect', 'arbutus_content_width', 0 );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function arbutus_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'arbutus' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'arbutus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function arbutus_scripts() {
	wp_enqueue_style( 'arbutus-style', get_stylesheet_uri(), array(), '20161223' );

	wp_enqueue_style( 'arbutus-fonts', arbutus_font_url(), array(), null );

	wp_enqueue_script( 'arbutus-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery', 'jquery-masonry' ), '20160717', true );

	wp_enqueue_script( 'arbutus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20200616', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'arbutus_scripts' );

/**
 * Register Google fonts for Arbutus.
 *
 * @since Arbutus 1.0
 *
 * @return string
 */
function arbutus_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Raleway or Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Raleway & Open Sans fonts: on or off', 'arbutus' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Open+Sans:400italic,700,400|Raleway:300,400' ), "//fonts.googleapis.com/css" );
	}

	return esc_url( $font_url );
}

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Arbutus 1.1
 */
function arbutus_block_editor_styles() {
    // Add custom fonts. These do not work with `add_editor_style` in the block editor.
    wp_enqueue_style( 'arbutus-fonts', arbutus_font_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'arbutus_block_editor_styles' );

/**
 * Customize the excerpt display.
 */
function arbutus_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	global $post;
	
	$title = sprintf ( __( 'Read more %s', 'arbutus' ),
		'<span class="screen-reader-text">' . esc_html( get_the_title() ) .
		' </span><span class="meta-nav" aria-hidden="true"> &rarr;</span>' );

	return '&hellip;<div><a class="excerpt-more button" href="' . esc_url( get_permalink( $post->ID ) ) . '">' . $title . '</a></div>';
}
add_filter( 'excerpt_more', 'arbutus_excerpt_more' );

function arbutus_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 160;
}
add_filter( 'excerpt_length', 'arbutus_excerpt_length' );

/**
 * Use a custom excerpt-trimming function, based on wp_trim_excerpt, to allow some html.
 */
function arbutus_wp_trim_excerpt( $text ) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content( '' );

		$text = strip_shortcodes( $text );

		/** This filter is documented in wp-includes/post-template.php */
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );

		/**
		 * Filter the number of words in an excerpt.
		 *
		 * @since 2.7.0
		 *
		 * @param int $number The number of words. Default 55.
		 */
		$excerpt_length = apply_filters( 'excerpt_length', 55 );

		/**
		 * Filter the string in the "more" link displayed after a trimmed excerpt.
		 *
		 * @since 2.9.0
		 *
		 * @param string $more_string The string shown within the more link.
		 */
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );

		$original_text = $text;
		$text = strip_tags( $text, '<a><b><strong><i><em><p><h1><h2><h3><h4><h5><h6>' );
		/* translators: If your word count is based on single characters (East Asian characters),
		   enter 'characters'. Otherwise, enter 'words'. Do not translate into your own language. */
		if ( 'characters' == _x( 'words', 'word count: words or characters?' ) && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) { // phpcs:ignore WordPress.WP.I18n.MissingArgDomain
			// In previous line: intentionally using core translation since this is copied from a core function. 

			$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
			preg_match_all( '/./u', $text, $words_array );
			$words_array = array_slice( $words_array[0], 0, $excerpt_length + 1 );
			$sep = '';
		} else {
			$words_array = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
			$sep = ' ';
		}
		if ( count( $words_array ) > $excerpt_length ) {
			array_pop( $words_array );
			$text = implode( $sep, $words_array );
			$text = $text . $excerpt_more;
		} else {
			$text = implode( $sep, $words_array );
		}
		/**
		 * Filter the text content after words have been trimmed.
		 *
		 * @since 3.3.0
		 *
		 * @param string $text           The trimmed text.
		 * @param int    $excerpt_length The number of words to trim the text to. Default 5.
		 * @param string $more           An optional string to append to the end of the trimmed text, e.g. &hellip;.
		 * @param string $original_text  The text before it was trimmed.
		 */
		$text = apply_filters( 'wp_trim_words', $text, $excerpt_length, $excerpt_more, $original_text );
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'arbutus_wp_trim_excerpt' );

/**
 * Filter search results to include attachments, as this theme is image-oriented.
 */
function arbutus_attachment_search( $query ) {
	if ( ! is_search() ) {
		return $query;
	}

	$post_types = $query->get( 'post_type' );
	if ( ! $post_types || 'post' === $post_types ) {
		$post_types = array( 'post', 'attachment' );
	} elseif ( is_array( $post_types ) ) {
		$post_types[] = 'attachment';
	}

	$query->set( 'post_type', $post_types );
	return $query;
}
add_filter( 'pre_get_posts', 'arbutus_attachment_search' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Theme options, via the Customizer.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/color-patterns.php';
