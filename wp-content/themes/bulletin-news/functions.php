<?php
/**
 * Shadow Themes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shadow Themes
 */

if ( ! function_exists( 'bulletin_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bulletin_news_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shadow Themes, use a find and replace
		 * to change 'bulletin-news' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bulletin-news' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top' => esc_html__( 'Top', 'bulletin-news' ),
			'primary' => esc_html__( 'Primary', 'bulletin-news' ),
			'social' => esc_html__( 'Social', 'bulletin-news' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bulletin_news_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'custom-header', array(
		        'default-image'      => '',
		        'default-text-color' => '000',
		        'width'              => 1920,
		        'height'             => 1080,
		        'flex-width'         => true,
		        'flex-height'        => true,
		    ) );
		 // Register default headers.
		register_default_headers( array(
			'default-banner' => array(
				'url'           => '%s/assets/img/header-image.jpg',
				'thumbnail_url' => '%s/assets/img/header-image.jpg',
				'description'   => esc_html_x( 'Default Banner', 'Header image description', 'bulletin-news' ),
			),

		) );

		// Add theme support for selective refresh for widgets.
		// add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	    
    	/*
    	 * This theme styles the visual editor to resemble the theme style,
    	 * specifically font, colors, and column width.
     	 */
    	add_editor_style( array( 'assets/css/editor-style.css', bulletin_news_fonts_url() ) );

    	// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'bulletin-news' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'bulletin-news' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'bulletin-news' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'bulletin-news' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'bulletin-news' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'bulletin-news' ),
		       	'shortName' => esc_html__( 'S', 'bulletin-news' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'bulletin-news' ),
		       	'shortName' => esc_html__( 'M', 'bulletin-news' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'bulletin-news' ),
		       	'shortName' => esc_html__( 'L', 'bulletin-news' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'bulletin-news' ),
		       	'shortName' => esc_html__( 'XL', 'bulletin-news' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'bulletin_news_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bulletin_news_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bulletin_news_content_width', 900 );
}
add_action( 'after_setup_theme', 'bulletin_news_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bulletin_news_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Widget Aera', 'bulletin-news' ),
		'id'            => 'homepage-widget',
		'description'   => esc_html__( 'Add widgets here.', 'bulletin-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s ">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="shadow-section-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'bulletin-news' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bulletin-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s ">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="shadow-section-header"><h2 class="shadow-section-title">',
		'after_title'   => '</h2></div>',
	) );

	for ( $i=1; $i <= 4; $i++ ) { 
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area ', 'bulletin-news' )  . $i,
			'id'            => 'footer-' . $i,
			'description'   => esc_html__( 'Add widgets here.', 'bulletin-news' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s ">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Sidebar', 'bulletin-news' ),
		'id'            => 'homepage-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'bulletin-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s ">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="shadow-section-header"><h2 class="shadow-section-title">',
		'after_title'   => '</h2></div>',
	) );
}
add_action( 'widgets_init', 'bulletin_news_widgets_init' );

/**
 * Register custom fonts.
 */
function bulletin_news_fonts_url() {
	$fonts_url = '';

	$font_families = array();
	
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Bad Script, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$roboto = _x( 'on', 'Roboto font: on or off', 'bulletin-news' );

	if ( 'off' !== $roboto ) {
		$font_families[] = 'Roboto:700';
	}

	$lora = _x( 'on', 'Lora font: on or off', 'bulletin-news' );

	if ( 'off' !== $lora ) {
		$font_families[] = 'Lora:400,700';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function bulletin_news_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'bulletin-news-fonts', bulletin_news_fonts_url(), array(), null );

	wp_enqueue_style( 'slick', get_theme_file_uri() . '/assets/css/slick.css', '', '1.8.0' );

	wp_enqueue_style( 'slick-theme', get_theme_file_uri() . '/assets/css/slick-theme.css', '', '1.8.0' );

	// blocks
	wp_enqueue_style( 'bulletin-news-blocks', get_template_directory_uri() . '/assets/css/blocks.css' );

	wp_enqueue_style( 'bulletin-news-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bulletin-news-responsive-style', get_template_directory_uri() . '/responsive.css' );

	wp_enqueue_script( 'slick-jquery', get_theme_file_uri( '/assets/js/slick.js' ), array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'imagesloaded' );

	wp_enqueue_script( 'jquery-packer', get_theme_file_uri( '/assets/js/packery.pkgd.min.js' ), array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'jquery-matchHeight', get_theme_file_uri( '/assets/js/jquery-matchHeight.js' ), array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'jquery-theia-sticky-sidebar', get_theme_file_uri() . '/assets/js/theia-sticky-sidebar.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'bulletin-news-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '20151215', true );

	wp_enqueue_script( 'bulletin-news-skip-link-focus-fix', get_theme_file_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );


	wp_enqueue_script( 'bulletin-news-custom', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bulletin_news_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Bulletin News 1.0.0
 */
function bulletin_news_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'bulletin-news-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'bulletin-news-fonts', bulletin_news_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'bulletin_news_block_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer/defaults.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer/sanitize.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer/active-callback.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Breadcrumb trail.
 */
if ( ! class_exists( 'Breadcrumb_Trail' ) ) {
	require get_parent_theme_file_path( '/inc/breadcrumb-trail.php' );
}

/**
 * Widget call
 */
require get_parent_theme_file_path( '/inc/widgets/widgets.php' );

/**
 * Enqueue admin css.
 * @return [type] [description]
 */
function bulletin_news_load_custom_wp_admin_style( $hook ) {
	if ( 'appearance_page_bulletin-news-welcome' != $hook ) {
        return;
    }
    wp_register_style( 'bulletin-news-admin', get_theme_file_uri( 'assets/css/bulletin-news-admin.css' ), false, '1.0.0' );
    wp_enqueue_style( 'bulletin-news-admin' );
}
add_action( 'admin_enqueue_scripts', 'bulletin_news_load_custom_wp_admin_style' );

/**
 * Styles the header image and text displayed on the blog.
 *
 * @see bulletin_news_custom_header_setup().
 */
function bulletin_news_header_text_style() {
	// If we get this far, we have custom styles. Let's do this.
	$header_text_display = get_theme_mod( 'header_title_color');
	?>
	<style type="text/css">

	.site-title a{
		color: <?php echo esc_attr( $header_text_display ); ?>;
	}
	.site-description {
		color: <?php echo esc_attr( get_theme_mod( 'bulletin_news_header_tagline', '#2e2e2e' ) ); ?>;
	}
	</style>
	<?php
}
add_action( 'wp_head', 'bulletin_news_header_text_style' );

/**
 *
 * Reset all setting to default.
 *
 */
function bulletin_news_reset_settings() {
    $reset_settings = get_theme_mod( 'bulletin_news_reset_settings', false );
    if ( $reset_settings ) {
        remove_theme_mods();
    }
}
add_action( 'customize_save_after', 'bulletin_news_reset_settings' );

function bulletin_news_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-description">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'bulletin_news_nav_description', 10, 4 );


if ( ! function_exists( 'bulletin_news_exclude_sticky_posts' ) ) {
    function bulletin_news_exclude_sticky_posts( $query ) {
        if ( ! is_admin() && $query->is_main_query() && $query->is_home() ) {
            $sticky_posts = get_option( 'sticky_posts' );  
            if ( ! empty( $sticky_posts ) ) {
            	$query->set('post__not_in', $sticky_posts );
            }
            $query->set('ignore_sticky_posts', true );
        }
    }
}
add_action( 'pre_get_posts', 'bulletin_news_exclude_sticky_posts' );