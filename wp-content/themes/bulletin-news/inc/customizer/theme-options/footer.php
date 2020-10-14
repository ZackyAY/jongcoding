<?php /**
	 *
	 *
	 * Footer copyright
	 *
	 *
	 */
	// Footer copyright
	$wp_customize->add_section(
		'bulletin_news_footer_section',
		array(
			'title' => esc_html__( 'Footer', 'bulletin-news' ),
			'priority' => 106,
			'panel' => 'bulletin_news_general_panel',
		)
	);

	// Footer social menu enable setting
	$wp_customize->add_setting(
		'bulletin_news_enable_footer_social_menu',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'bulletin_news_enable_footer_social_menu',
		array(
			'section'		=> 'bulletin_news_footer_section',
			'label'			=> esc_html__( 'Enable social menu.', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);
 ?>