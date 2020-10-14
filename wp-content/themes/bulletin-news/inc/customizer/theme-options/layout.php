<?php 
	/**
	 * Global Layout
	 */
	// Global Layout
	$wp_customize->add_section(
		'bulletin_news_global_layout',
		array(
			'title' => esc_html__( 'Global Layout', 'bulletin-news' ),
			'panel' => 'bulletin_news_general_panel',
		)
	);

	// Global site layout setting
	$wp_customize->add_setting(
		'bulletin_news_site_layout',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
			'default' => 'wide',
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_site_layout',
		array(
			'section'		=> 'bulletin_news_global_layout',
			'label'			=> esc_html__( 'Site layout', 'bulletin-news' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				'boxed' => esc_html__( 'Boxed', 'bulletin-news' ), 
				'wide' => esc_html__( 'Wide', 'bulletin-news' ), 
			),
		)
	);

	// Global archive layout setting
	$wp_customize->add_setting(
		'bulletin_news_archive_sidebar',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
			'default' => 'right',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_archive_sidebar',
		array(
			'section'		=> 'bulletin_news_global_layout',
			'label'			=> esc_html__( 'Archive Sidebar', 'bulletin-news' ),
			'description'			=> esc_html__( 'This option works on all archive pages like: 404, search, date, category and so on.', 'bulletin-news' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				'right' => esc_html__( 'Right', 'bulletin-news' ), 
				'no' => esc_html__( 'No Sidebar', 'bulletin-news' ), 
			),
		)
	);

	// Blog layout setting
	$wp_customize->add_setting(
		'bulletin_news_blog_sidebar',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
			'default' => 'no',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_blog_sidebar',
		array(
			'section'		=> 'bulletin_news_global_layout',
			'label'			=> esc_html__( 'Blog Sidebar', 'bulletin-news' ),
			'description'			=> esc_html__( 'This option works on blog and "Your latest posts"', 'bulletin-news' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				'right' => esc_html__( 'Right', 'bulletin-news' ), 
				'no' => esc_html__( 'No Sidebar', 'bulletin-news' ), 
			),
		)
	);

	// Global page layout setting
	$wp_customize->add_setting(
		'bulletin_news_global_page_layout',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
			'default' => 'right',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_global_page_layout',
		array(
			'section'		=> 'bulletin_news_global_layout',
			'label'			=> esc_html__( 'Global page sidebar', 'bulletin-news' ),
			'description'			=> esc_html__( 'This option works only on single pages including "Posts page". This setting can be overridden for single page from the metabox too.', 'bulletin-news' ),
			'type'			=> 'radio',
			'choices'		=> array(  
				'right' => esc_html__( 'Right', 'bulletin-news' ), 
				'no' => esc_html__( 'No Sidebar', 'bulletin-news' ), 
			),
		)
	);

	// Global post layout setting
	$wp_customize->add_setting(
		'bulletin_news_global_post_layout',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
			'default' => 'right',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_global_post_layout',
		array(
			'section'		=> 'bulletin_news_global_layout',
			'label'			=> esc_html__( 'Global post sidebar', 'bulletin-news' ),
			'description'			=> esc_html__( 'This option works only on single posts. This setting can be overridden for single post from the metabox too.', 'bulletin-news' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				'right' => esc_html__( 'Right', 'bulletin-news' ), 
				'no' => esc_html__( 'No Sidebar', 'bulletin-news' ), 
			),
		)
	);
 ?>