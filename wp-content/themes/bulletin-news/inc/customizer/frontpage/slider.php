<?php
/**
	 * Slider section
	 */
	// Slider section
	$wp_customize->add_section(
		'bulletin_news_slider',
		array(
			'title' => esc_html__( 'Slider', 'bulletin-news' ),
			'panel' => 'bulletin_news_home_panel',
		)
	);

	// Slider Section enable setting
	$wp_customize->add_setting(
		'bulletin_news_featured_slider_section_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_featured_slider_section_enable',
		array(
			'section'		=> 'bulletin_news_slider',
			'label'			=> esc_html__( 'Enable Featured Slider Section.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Featured Articles title setting
	$wp_customize->add_setting(
		'bulletin_news_slider_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_slider_title',
		array(
			'section'		=> 'bulletin_news_slider',
			'label'			=> esc_html__( 'Title:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_featured_slider_enable'
		)
	);

	for ( $i=1; $i <= 3; $i++ ) { 
		
		// Slider page setting
		$wp_customize->add_setting(
			'bulletin_news_slider_page_' . $i,
			array(
				'sanitize_callback' => 'bulletin_news_sanitize_dropdown_pages',
				'default' => 0,
			)
		);

		$wp_customize->add_control(
			'bulletin_news_slider_page_' . $i,
			array(
				'section'		=> 'bulletin_news_slider',
				'label'			=> esc_html__( 'Page ', 'bulletin-news' ) . $i,
				'type'			=> 'dropdown-pages',
				'active_callback' => 'bulletin_news_is_featured_slider_enable'
			)
		);
		
	}
?>