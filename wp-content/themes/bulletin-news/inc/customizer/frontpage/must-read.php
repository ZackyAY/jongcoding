<?php
/**
	 * Must Read section
	 */
	// Must Read section
	$wp_customize->add_section(
		'bulletin_news_must_read',
		array(
			'title' => esc_html__( 'Must Read Post', 'bulletin-news' ),
			'panel' => 'bulletin_news_home_panel',
		)
	);

	// Must Read Section enable setting
	$wp_customize->add_setting(
		'bulletin_news_must_read_section_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_must_read_section_enable',
		array(
			'section'		=> 'bulletin_news_must_read',
			'label'			=> esc_html__( 'Enable Must Read Section.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Must Read title setting
	$wp_customize->add_setting(
		'bulletin_news_must_read_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_must_read_title',
		array(
			'section'		=> 'bulletin_news_must_read',
			'label'			=> esc_html__( 'Title:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_must_read_enable'
		)
	);


	for ( $i=1; $i <= 4; $i++ ) { 
		
		// Must Read page setting
		$wp_customize->add_setting(
			'bulletin_news_must_read_page_' . $i,
			array(
				'sanitize_callback' => 'bulletin_news_sanitize_dropdown_pages',
				'default' => 0,
			)
		);

		$wp_customize->add_control(
			'bulletin_news_must_read_page_' . $i,
			array(
				'section'		=> 'bulletin_news_must_read',
				'label'			=> esc_html__( 'Page ', 'bulletin-news' ) . $i,
				'type'			=> 'dropdown-pages',
				'active_callback' => 'bulletin_news_is_must_read_enable'
			)
		);
		
	}
?>