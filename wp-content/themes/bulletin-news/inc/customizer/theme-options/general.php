<?php 
	/**
	 * General settings
	 */
	// General settings
	$wp_customize->add_section(
		'bulletin_news_general_section',
		array(
			'title' => esc_html__( 'General', 'bulletin-news' ),
			'panel' => 'bulletin_news_general_panel',
		)
	);
 

	// Breadcrumb enable setting
	$wp_customize->add_setting(
		'bulletin_news_breadcrumb_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_breadcrumb_enable',
		array(
			'section'		=> 'bulletin_news_general_section',
			'label'			=> esc_html__( 'Enable breadcrumb.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);


?>