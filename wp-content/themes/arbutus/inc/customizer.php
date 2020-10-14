<?php
/**
 * Arbutus Theme Customizer
 *
 * @package Arbutus
 */

/**
 * Do lots of fun stuff with the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function arbutus_customize_register( $wp_customize ) {
	// Register default controls for postMessage transport, for instant previews.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Hide controls when they aren't used on the current page.
	$wp_customize->get_control( 'header_image' )->active_callback    = 'is_front_page';
	$wp_customize->get_control( 'blogdescription' )->active_callback = 'is_front_page';

	// Add the Arbutus section and options.
	$wp_customize->add_section( 'arbutus', array(
		'title'       => __( 'Arbutus', 'arbutus' ),
		'description' => __( 'Settings specific to the Arbutus theme.', 'arbutus' ),
		'priority'    => 40,
	) );

	$wp_customize->add_setting( 'default_image', array(
		'default'           => get_stylesheet_directory_uri() . '/img/default.png',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'default_image', array(
		'label'   => __( 'Default Featured Image', 'arbutus' ),
		'section' => 'arbutus',
	) ) );

	$wp_customize->add_setting( 'copy_name' , array(
		'default'	        => esc_html( get_bloginfo( 'name' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_setting( 'powered_by_wp' , array(
		'default'	        => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'arbutus_sanitize_boolean',
	) );

	$wp_customize->add_setting( 'theme_meta' , array(
		'default'	        => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'arbutus_sanitize_boolean',
	) );

	$wp_customize->add_control( 'copy_name', array(
		'label'   => __( 'Copyright Name', 'arbutus' ),
		'section' => 'arbutus',
		'type'    => 'text',
	) );

	$wp_customize->add_control( 'powered_by_wp', array(
		'label'   => __( 'Proudly Powered By WordPress', 'arbutus' ),
		'section' => 'arbutus',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_control( 'theme_meta', array(
		'label'   => __( 'Show theme credit in footer', 'arbutus' ),
		'section' => 'arbutus',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'color_hue', array(
		'default'           => 220,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_hue', array(
		'label'   => __( 'Color Scheme', 'arbutus' ),
		'description' => __( 'All theme colors will be tinted according to this selection.', 'arbutus' ),
		'mode' => 'hue',
		'section' => 'colors',
	) ) );

	// Partial refresh for better user experience (faster loading of changes).
	// This is a supplement to the initial postMessage setting update that handles PHP 
	// logic more complex than basic color swaps in the CSS (such as contrast ratios).
	$wp_customize->selective_refresh->add_partial( 'arbutus_colors', array(
		'selector'        => '#arbutus-colors',
		'settings'        => array( 'color_hue' ),
		'render_callback' => 'arbutus_get_custom_color_css',
	) );

	// Add selective refresh support for the title and tagline, and the footer options.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
	    'selector' => '.site-title',
	    'render_callback' => 'arbutus_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	    'selector' => '.site-description',
	    'render_callback' => 'arbutus_customize_partial_blogdescription',
	) );
	$wp_customize->selective_refresh->add_partial( 'footer_credits', array(
	    'selector' => '.site-info',
		'settings' => array( 'copy_name', 'powered_by_wp', 'theme_meta' ),
	    'render_callback' => 'arbutus_footer_credits',
	) );

}
add_action( 'customize_register', 'arbutus_customize_register' );

function arbutus_sanitize_boolean( $value ) {
	if ( $value ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function arbutus_customize_preview_js() {
	wp_enqueue_script( 'arbutus_customize_preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20200216', true );
}
add_action( 'customize_preview_init', 'arbutus_customize_preview_js' );

/**
 * Display custom color CSS.
 */
function arbutus_custom_color_css() {
	if ( is_customize_preview() ) {
		$data = ' data-color_hue="' . absint( get_theme_mod( 'color_hue', 220 ) ) . '"';
	} else {
		$data = '';
	}
	echo '<style type="text/css" id="arbutus-colors"' . $data . '>' .
		arbutus_get_custom_color_css() .
	'</style>';
}
add_action( 'wp_head', 'arbutus_custom_color_css' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Arbutus 1.0
 * @see arbutus_customize_register()
 *
 * @return void
 */
function arbutus_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Arbutus 1.0
 * @see arbutus_customize_register()
 *
 * @return void
 */
function arbutus_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
