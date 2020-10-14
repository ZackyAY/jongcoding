<?php 
	/**
	 * Blog/Archive section 
	 */
	// Blog/Archive section 
	$wp_customize->add_section(
		'bulletin_news_archive_settings',
		array(
			'title' => esc_html__( 'Archive/Blog', 'bulletin-news' ),
			'description' => esc_html__( 'Settings for archive pages including blog page too.', 'bulletin-news' ),
			'panel' => 'bulletin_news_general_panel',
		)
	);

	// Archive excerpt setting
	$wp_customize->add_setting(
		'bulletin_news_archive_excerpt',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => esc_html__( 'View the post', 'bulletin-news' ),
		)
	);

	$wp_customize->add_control(
		'bulletin_news_archive_excerpt',
		array(
			'section'		=> 'bulletin_news_archive_settings',
			'label'			=> esc_html__( 'Excerpt more text:', 'bulletin-news' ),
		)
	);

	// Archive excerpt length setting
	$wp_customize->add_setting(
		'bulletin_news_archive_excerpt_length',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_number_range',
			'default' => 20,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_archive_excerpt_length',
		array(
			'section'		=> 'bulletin_news_archive_settings',
			'label'			=> esc_html__( 'Excerpt more length:', 'bulletin-news' ),
			'type'			=> 'number',
			'input_attrs'   => array( 'min' => 5 ),
		)
	);

 ?>