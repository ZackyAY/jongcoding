<?php
/**
	 * Featured Articles section
	 */
	// Featured Articles section
	$wp_customize->add_section(
		'bulletin_news_featured_articles',
		array(
			'title' => esc_html__( 'Featured Articles Post', 'bulletin-news' ),
			'panel' => 'bulletin_news_home_panel',
		)
	);

	// Featured Articles Section enable setting
	$wp_customize->add_setting(
		'bulletin_news_featured_articles_section_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_featured_articles_section_enable',
		array(
			'section'		=> 'bulletin_news_featured_articles',
			'label'			=> esc_html__( 'Enable Featured Articles Section.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Featured Articles title setting
	$wp_customize->add_setting(
		'bulletin_news_featured_articles_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_featured_articles_title',
		array(
			'section'		=> 'bulletin_news_featured_articles',
			'label'			=> esc_html__( 'Title:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_featured_articles_enable'
		)
	);

	// Featured Articles category setting
	$wp_customize->add_setting(
		'bulletin_news_featured_articles_cat',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_featured_articles_cat',
		array(
			'section'		=> 'bulletin_news_featured_articles',
			'label'			=> esc_html__( 'Category:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_featured_articles_enable',
			'type'			=> 'select',
			'choices'		=> bulletin_news_get_post_cat_choices(),
		)
	);
?>