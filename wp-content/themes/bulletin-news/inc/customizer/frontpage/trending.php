<?php
/**
	 * Trending section
	 */
	// Trending section
	$wp_customize->add_section(
		'bulletin_news_trending',
		array(
			'title' => esc_html__( 'Trending Post', 'bulletin-news' ),
			'panel' => 'bulletin_news_home_panel',
		)
	);

	// Trending Section enable setting
	$wp_customize->add_setting(
		'bulletin_news_trending_section_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_trending_section_enable',
		array(
			'section'		=> 'bulletin_news_trending',
			'label'			=> esc_html__( 'Enable Trending Section.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Trending title setting
	$wp_customize->add_setting(
		'bulletin_news_trending_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_trending_title',
		array(
			'section'		=> 'bulletin_news_trending',
			'label'			=> esc_html__( 'Title:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_trending_enable'
		)
	);

	// Trending category setting
	$wp_customize->add_setting(
		'bulletin_news_trending_cat',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_trending_cat',
		array(
			'section'		=> 'bulletin_news_trending',
			'label'			=> esc_html__( 'Category:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_trending_enable',
			'type'			=> 'select',
			'choices'		=> bulletin_news_get_post_cat_choices(),
		)
	);
?>