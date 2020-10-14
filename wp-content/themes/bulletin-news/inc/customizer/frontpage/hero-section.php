<?php
/**
	 * Hero Section section
	 */
	// Hero Section section
	$wp_customize->add_section(
		'bulletin_news_hero_section',
		array(
			'title' => esc_html__( 'Hero Section Post', 'bulletin-news' ),
			'panel' => 'bulletin_news_home_panel',
		)
	);

	// Hero Section Section enable setting
	$wp_customize->add_setting(
		'bulletin_news_hero_section_section_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_hero_section_section_enable',
		array(
			'section'		=> 'bulletin_news_hero_section',
			'label'			=> esc_html__( 'Enable Hero Section Section.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Hero Section category setting
	$wp_customize->add_setting(
		'bulletin_news_hero_section_cat',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_hero_section_cat',
		array(
			'section'		=> 'bulletin_news_hero_section',
			'label'			=> esc_html__( 'Category:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_hero_section_enable',
			'type'			=> 'select',
			'choices'		=> bulletin_news_get_post_cat_choices(),
		)
	);
?>