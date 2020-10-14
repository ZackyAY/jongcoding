<?php 
/**
	 * Reset all settings
	 */
	// Reset settings section
	$wp_customize->add_section(
		'bulletin_news_reset_sections',
		array(
			'title' => esc_html__( 'Reset all', 'bulletin-news' ),
			'description' => esc_html__( 'Reset all settings to default.', 'bulletin-news' ),
			'panel' => 'bulletin_news_general_panel',
		)
	);

	// Reset sortable order setting
	$wp_customize->add_setting(
		'bulletin_news_reset_settings',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_checkbox',
			'default' => false,
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'bulletin_news_reset_settings',
		array(
			'section'		=> 'bulletin_news_reset_sections',
			'label'			=> esc_html__( 'Reset all settings?', 'bulletin-news' ),
			'type'			=> 'checkbox',
		)
	);
 ?>