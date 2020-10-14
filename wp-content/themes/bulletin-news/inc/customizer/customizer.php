<?php
/**
 * Shadow Themes Customizer
 *
 * @package Shadow Themes
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bulletin_news_customize_register( $wp_customize ) {
	/**
	 * Separator custom control
	 *
	 * @version 1.0.0
	 * @since  1.0.0
	 */
	class bulletin_news_Separator_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'bulletin-news-separator';
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<p><hr style="border-color: #222; opacity: 0.2;"></p>
			<?php
		}
	}

	/**
	 * The radio image customize control extends the WP_Customize_Control class.  This class allows
	 * developers to create a list of image radio inputs.
	 *
	 * Note, the `$choices` array is slightly different than normal and should be in the form of
	 * `array(
		 *	$value => array( 'color' => $color_value ),
		 *	$value => array( 'color' => $color_value ),
	 * )`
	 *
	 */

	/**
	 * Radio color customize control.
	 *
	 * @since  3.0.0
	 * @access public
	 */
	class Bulletin_News_Customize_Control_Radio_Color extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 *
		 * @since  3.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'bulletin-news-radio-color';

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  3.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();

			// We need to make sure we have the correct color URL.
			foreach ( $this->choices as $value => $args )
				$this->choices[ $value ]['color'] = esc_attr( $args['color'] );

			$this->json['choices'] = $this->choices;
			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
		}

		/**
		 * Don't render the content via PHP.  This control is handled with a JS template.
		 *
		 * @since  4.0.0
		 * @access public
		 * @return bool
		 */
		protected function render_content() {}

		/**
		 * Underscore JS template to handle the control's output.
		 *
		 * @since  3.0.0
		 * @access public
		 * @return void
		 */
		public function content_template() { ?>

			<# if ( ! data.choices ) {
				return;
			} #>

			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<# _.each( data.choices, function( args, choice ) { #>
				<label>
					<input type="radio" value="{{ choice }}" name="_customize-{{ data.type }}-{{ data.id }}" {{{ data.link }}} <# if ( choice === data.value ) { #> checked="checked" <# } #> />

					<span class="screen-reader-text">{{ args.label }}</span>
					
					<# if ( 'custom' != choice ) { #>
						<span class="color-value" style="background-color: {{ args.color }}"></span>
					<# } else { #>
						<span class="color-value custom-color-value"></span>
					<# } #>
				</label>
			<# } ) #>
		<?php }
	}

	$wp_customize->register_control_type( 'Bulletin_News_Customize_Control_Radio_Color'       );



	$default = bulletin_news_get_default_mods();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	// Header title color setting and control.
	$wp_customize->add_setting( 'header_title_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'refresh'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_title_color', array(
		'priority'			=> 5,
		'label'             => esc_html__( 'Header Text Color', 'bulletin-news' ),
		'section'           => 'colors',
	) ) );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'bulletin_news_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'bulletin_news_customize_partial_blogdescription',
		) );
	}

	/**
	 *
	 * 
	 * Header panel
	 *
	 * 
	 */
	// Header panel
	$wp_customize->add_panel(
		'bulletin_news_header_panel',
		array(
			'title' => esc_html__( 'Header', 'bulletin-news' ),
			'priority' => 100
		)
	);
	$wp_customize->get_section( 'header_image' )->panel         = 'bulletin_news_header_panel';

	// ADS image 
	$wp_customize->add_section(
		'bulletin_news_header_ads',
		array(
			'title' => esc_html__( 'Header Advertisment image', 'bulletin-news' ),
			'panel' => 'bulletin_news_header_panel',
		)
	);

	// Header Ads control
	$wp_customize->add_setting(	
		'bulletin_news_header_ads_image_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_header_ads_image_enable',
		array(
			'section'		=> 'bulletin_news_header_ads',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Ads enable in Header', 'bulletin-news' ),
		)
	);

	// Header Ads image setting
	$wp_customize->add_setting(	
		'bulletin_news_header_ads_image',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control( 
		$wp_customize,
			'bulletin_news_header_ads_image',
			array(
				'section'		=> 'bulletin_news_header_ads',
				'label'			=> esc_html__( 'Header Advertisment image:', 'bulletin-news' ),
			)
		)
	);
	// Header text display setting
	$wp_customize->add_setting(	
		'bulletin_news_header_ads_image_url',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_header_ads_image_url',
		array(
			'section'		=> 'bulletin_news_header_ads',
			'type'			=> 'url',
			'label'			=> esc_html__( 'Ads Url', 'bulletin-news' ),
		)
	);
	

	// ADS image 
	$wp_customize->add_section(
		'bulletin_news_header_background',
		array(
			'title' => esc_html__( 'Header background image', 'bulletin-news' ),
			'panel' => 'bulletin_news_header_panel',
		)
	);

	// Header Ads image setting
	$wp_customize->add_setting(	
		'bulletin_news_header_background_image',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control( 
		$wp_customize,
			'bulletin_news_header_background_image',
			array(
				'section'		=> 'bulletin_news_header_background',
				'label'			=> esc_html__( 'Header background Image', 'bulletin-news' ),
			)
		)
	);

	// Header text display setting
	$wp_customize->add_setting(	
		'bulletin_news_header_text_display',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => true,
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_header_text_display',
		array(
			'section'		=> 'title_tagline',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Site Title and Tagline', 'bulletin-news' ),
		)
	);


	/**
	 *
	 * 
	 * Color panel
	 *
	 * 
	 */

	// Header panel
	$wp_customize->add_panel(
		'bulletin_news_color_panel',
		array(
			'title' => esc_html__( 'Color Options', 'bulletin-news' ),
			'priority' => 100,
		)
	);

	// Header tagline color setting
	$wp_customize->add_setting(	
		'bulletin_news_header_tagline',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_hex_color',
			'default' => '#929292',
			'transport'	=> 'postMessage',
		)
	);


	$wp_customize->add_control(
		new WP_Customize_Color_Control( 
		$wp_customize,
			'bulletin_news_header_tagline',
			array(
				'section'		=> 'colors',
				'label'			=> esc_html__( 'Site tagline Color:', 'bulletin-news' ),
			)
		)
	);	

	/**
	 *
	 * 
	 * Home sections panel
	 *
	 * 
	 */

	// Home sections panel
	$wp_customize->add_panel(
		'bulletin_news_home_panel',
		array(
			'title' => esc_html__( 'Homepage Sections', 'bulletin-news' ),
			'priority' => 105
		)
	);
	

	// Your latest posts title setting
	$wp_customize->add_setting(	
		'bulletin_news_your_latest_posts_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => esc_html__( 'Blogs', 'bulletin-news' ),
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_your_latest_posts_title',
		array(
			'section'		=> 'static_front_page',
			'label'			=> esc_html__( 'Title:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_latest_posts'
		)
	);

	$wp_customize->selective_refresh->add_partial( 
		'bulletin_news_your_latest_posts_title', 
		array(
	        'selector'            => '.home.blog #shadow-page-header .shadow-page-title',
			'render_callback'     => 'bulletin_news_your_latest_posts_partial_title',
    	) 
    );

	require get_parent_theme_file_path('/inc/customizer/frontpage/breaking-news.php');

	require get_parent_theme_file_path('/inc/customizer/frontpage/hero-section.php');

    require get_parent_theme_file_path('/inc/customizer/frontpage/slider.php');

    require get_parent_theme_file_path('/inc/customizer/frontpage/trending.php');

    require get_parent_theme_file_path('/inc/customizer/frontpage/featured-articles.php');

    require get_parent_theme_file_path('/inc/customizer/frontpage/two-column.php');

    require get_parent_theme_file_path('/inc/customizer/frontpage/must-read.php');

    require get_parent_theme_file_path('/inc/customizer/theme-options/menu.php');

    require get_parent_theme_file_path('/inc/customizer/theme-options/general.php');

    require get_parent_theme_file_path('/inc/customizer/theme-options/layout.php');

    require get_parent_theme_file_path('/inc/customizer/theme-options/blog.php');

    require get_parent_theme_file_path('/inc/customizer/theme-options/pagination.php');

    require get_parent_theme_file_path('/inc/customizer/theme-options/footer.php');

    require get_parent_theme_file_path('/inc/customizer/theme-options/reset.php');

	/**
	 *
	 * General settings panel
	 * 
	 */
	// General settings panel
	$wp_customize->add_panel(
		'bulletin_news_general_panel',
		array(
			'title' => esc_html__( 'Theme Option Settings', 'bulletin-news' ),
			'priority' => 107
		)
	);


	$wp_customize->get_section( 'custom_css' )->panel         = 'bulletin_news_home_panel';

	$wp_customize->add_panel(
		'bulletin_news_background_image_panel',
		array(
			'title' => esc_html__( 'Background Image', 'bulletin-news' ),
			'priority' => 101
		)
	);

}
add_action( 'customize_register', 'bulletin_news_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bulletin_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bulletin_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bulletin_news_customize_preview_js() {
	wp_enqueue_script( 'bulletin-news-customizer', get_theme_file_uri( '/assets/js/customizer.js' ), array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bulletin_news_customize_preview_js' );

/**
 * Binds JS handlers for Customizer controls.
 */
function bulletin_news_customize_control_js() {


	wp_enqueue_style( 'bulletin-news-customize-style', get_theme_file_uri( '/assets/css/customize-controls.css' ), array(), '20151215' );

	wp_enqueue_script( 'bulletin-news-customize-control', get_theme_file_uri( '/assets/js/customize-control.js' ), array( 'jquery', 'customize-controls' ), '20151215', true );
	$bullentin_news_localized_data = array( 
		'refresh_msg' => esc_html__( 'Refresh the page after Save and Publish.', 'bulletin-news' ),
		'reset_msg' => esc_html__( 'Warning!!! This will reset all the settings. Refresh the page after Save and Publish to reset all.', 'bulletin-news' ),
	);

	wp_localize_script( 'bulletin-news-customize-control', 'localized_data', $bullentin_news_localized_data );
}
add_action( 'customize_controls_enqueue_scripts', 'bulletin_news_customize_control_js' );

/**
 * Selective refresh.
 */

/**
 * Selective refresh for footer copyright.
 */
function bulletin_news_copyright_partial() {
	return wp_kses_post( get_theme_mod( 'bulletin_news_copyright_txt' ) );
}

/**
 * Selective refresh for your latest posts title.
 */
function bulletin_news_your_latest_posts_partial_title() {
	return esc_html( get_theme_mod( 'bulletin_news_your_latest_posts_title' ) );
}
