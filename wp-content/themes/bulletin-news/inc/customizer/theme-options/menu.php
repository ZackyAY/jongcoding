<?php 
/**
	 * Menu section 
	 */
	// Menu section 
	$wp_customize->add_section(
		'bulletin_news_menu_settings',
		array(
			'title' => esc_html__( 'Menu Option', 'bulletin-news' ),
			'description' => esc_html__( 'Settings for menu pages including blog page too.', 'bulletin-news' ),
			'panel' => 'bulletin_news_general_panel',
		)
	);

	// Top Menu enable setting
	$wp_customize->add_setting(
		'bulletin_news_enable_top_menu',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_enable_top_menu',
		array(
			'section'		=> 'bulletin_news_menu_settings',
			'label'			=> esc_html__( 'Enable Top Menu.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Social Menu enable setting
	$wp_customize->add_setting(
		'bulletin_news_enable_top_social_menu',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => true,
		)
	);	

	$wp_customize->add_control(
		'bulletin_news_enable_top_social_menu',
		array(
			'section'		=> 'bulletin_news_menu_settings',
			'label'			=> esc_html__( 'Enable Top Social.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

 ?>