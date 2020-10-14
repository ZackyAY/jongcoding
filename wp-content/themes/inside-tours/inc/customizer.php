<?php
/**
 * inside-tours: Customizer
 *
 * @subpackage inside-tours
 * @since 1.0
 */

function inside_tours_customize_register( $wp_customize ) {

	$wp_customize->add_setting('inside_tours_show_site_title',array(
       'default' => true,
       'sanitize_callback'	=> 'inside_tours_sanitize_checkbox'
    ));
    $wp_customize->add_control('inside_tours_show_site_title',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Site Title','inside-tours'),
       'section' => 'title_tagline'
    ));

    $wp_customize->add_setting('inside_tours_show_tagline',array(
       'default' => true,
       'sanitize_callback'	=> 'inside_tours_sanitize_checkbox'
    ));
    $wp_customize->add_control('inside_tours_show_tagline',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Site Tagline','inside-tours'),
       'section' => 'title_tagline'
    ));

	$wp_customize->add_panel( 'inside_tours_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'inside-tours' ),
	    'description' => __( 'Description of what this panel does.', 'inside-tours' ),
	) );

	$wp_customize->add_section( 'inside_tours_theme_options_section', array(
    	'title'      => __( 'General Settings', 'inside-tours' ),
		'priority'   => 30,
		'panel' => 'inside_tours_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('inside_tours_theme_options',array(
        'default' => __('Right Sidebar','inside-tours'),
        'sanitize_callback' => 'inside_tours_sanitize_choices'	        
	));

	$wp_customize->add_control('inside_tours_theme_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','inside-tours'),
        'section' => 'inside_tours_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','inside-tours'),
            'Right Sidebar' => __('Right Sidebar','inside-tours'),
            'One Column' => __('One Column','inside-tours'),
            'Three Columns' => __('Three Columns','inside-tours'),
            'Four Columns' => __('Four Columns','inside-tours'),
            'Grid Layout' => __('Grid Layout','inside-tours')
        ),
	));

	//home page slider
	$wp_customize->add_section( 'inside_tours_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'inside-tours' ),
		'priority'   => null,
		'panel' => 'inside_tours_panel_id'
	) );

	$wp_customize->add_setting('inside_tours_slider_hide_show',array(
       	'default' => false,
       	'sanitize_callback'	=> 'inside_tours_sanitize_checkbox'
	));
	$wp_customize->add_control('inside_tours_slider_hide_show',array(
	   	'type' => 'checkbox',
	   	'label' => __('Show / Hide slider','inside-tours'),
	   	'description' => __('Image Size ( 1500px x 450px )','inside-tours'),
	   	'section' => 'inside_tours_slider_section',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'inside_tours_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'inside_tours_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'inside_tours_slider' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'inside-tours' ),
			'section'  => 'inside_tours_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	// Top Destination
	$wp_customize->add_section( 'inside_tours_destination_section' , array(
    	'title'      => __( 'Top Destination', 'inside-tours' ),
		'priority'   => null,
		'panel' => 'inside_tours_panel_id'
	) );
		
	$args =  array('numberposts' => 0);
	$post_list = get_posts($args);
	$i = 0;
	$psts[]='Select';  
	foreach($post_list as $post){
		$psts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('inside_tours_post',array(
		'sanitize_callback' => 'inside_tours_sanitize_choices',
	));
	$wp_customize->add_control('inside_tours_post',array(
		'type'    => 'select',
		'choices' => $psts,
		'label' => __('Select post','inside-tours'),
		'section' => 'inside_tours_destination_section',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('inside_tours_destination_cat',array(
		'default'	=> 'select',
		'sanitize_callback' => 'inside_tours_sanitize_choices',
	));
	$wp_customize->add_control('inside_tours_destination_cat',array(
		'type'    => 'select',
		'choices' => $cat_pst,
		'label' => __('Select Category to display Post','inside-tours'),
		'section' => 'inside_tours_destination_section',
	));

	//Footer
    $wp_customize->add_section( 'inside_tours_footer', array(
    	'title'      => __( 'Footer Text', 'inside-tours' ),
		'priority'   => null,
		'panel' => 'inside_tours_panel_id'
	) );

    $wp_customize->add_setting('inside_tours_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('inside_tours_footer_copy',array(
		'label'	=> __('Footer Text','inside-tours'),
		'section'	=> 'inside_tours_footer',
		'setting'	=> 'inside_tours_footer_copy',
		'type'		=> 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'inside_tours_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'inside_tours_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'inside_tours_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'inside_tours_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'inside-tours' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'inside-tours' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'inside_tours_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'inside_tours_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'inside_tours_customize_register' );

function inside_tours_customize_partial_blogname() {
	bloginfo( 'name' );
}

function inside_tours_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function inside_tours_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function inside_tours_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Inside_Tours_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Inside_Tours_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Inside_Tours_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Inside Tours Pro ', 'inside-tours' ),
					'pro_text' => esc_html__( 'Go Pro','inside-tours' ),
					'pro_url'  => esc_url( 'https://www.luzuk.com/product/tour-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'inside-tours-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'inside-tours-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Inside_Tours_Customize::get_instance();