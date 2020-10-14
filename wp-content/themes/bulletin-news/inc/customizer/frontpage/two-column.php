<?php
/**
	 * Two Column section
	 */
	// Two Column section
	$wp_customize->add_section(
		'bulletin_news_two_column',
		array(
			'title' => esc_html__( 'Two Column Post', 'bulletin-news' ),
			'panel' => 'bulletin_news_home_panel',
		)
	);

	// Two Column Section enable setting
	$wp_customize->add_setting(
		'bulletin_news_two_column_section_enable',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_two_column_section_enable',
		array(
			'section'		=> 'bulletin_news_two_column',
			'label'			=> esc_html__( 'Enable Two Column Section.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);

	// Two Column title setting
	$wp_customize->add_setting(
		'bulletin_news_two_column_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_two_column_title',
		array(
			'section'		=> 'bulletin_news_two_column',
			'label'			=> esc_html__( 'Title:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_two_column_enable'
		)
	);

	// Two Column category setting
	$wp_customize->add_setting(
		'bulletin_news_two_column_cat',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_two_column_cat',
		array(
			'section'		=> 'bulletin_news_two_column',
			'label'			=> esc_html__( 'Category:', 'bulletin-news' ),
			'active_callback' => 'bulletin_news_is_two_column_enable',
			'type'			=> 'select',
			'choices'		=> bulletin_news_get_post_cat_choices(),
		)
	);
?>