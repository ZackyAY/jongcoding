<?php
/**
	 * Breaking News section
	 */
	// Breaking News section
	$wp_customize->add_section(
		'bulletin_news_breaking',
		array(
			'title' => esc_html__( 'Breaking News Post', 'bulletin-news' ),
			'panel' => 'bulletin_news_home_panel',
		)
	);

	// Breaking News Section enable setting
	$wp_customize->add_setting(
		'bulletin_news_breaking_section_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_breaking_section_enable',
		array(
			'section'		=> 'bulletin_news_breaking',
			'label'			=> esc_html__( 'Enable Breaking News Section.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Breaking News title setting
	$wp_customize->add_setting(
		'bulletin_news_breaking_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_breaking_title',
		array(
			'section'		=> 'bulletin_news_breaking',
			'label'			=> esc_html__( 'Title:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_breaking_enable'
		)
	);

	for ( $i=1; $i <=4; $i++ ) { 
		
		// Breaking News page setting
		$wp_customize->add_setting(
			'bulletin_news_breaking_page_' . $i,
			array(
				'sanitize_callback' => 'bulletin_news_sanitize_dropdown_pages',
				'default' => 0,
			)
		);

		$wp_customize->add_control(
			'bulletin_news_breaking_page_' . $i,
			array(
				'section'		=> 'bulletin_news_breaking',
				'label'			=> esc_html__( 'Page ', 'bulletin-news' ) . $i,
				'type'			=> 'dropdown-pages',
				'active_callback' => 'bulletin_news_is_breaking_enable'
			)
		);
	}
?>