<?php 

	// Pagination type setting
	$wp_customize->add_setting(
		'bulletin_news_archive_pagination_type',
		array(
			'sanitize_callback' => 'bulletin_news_sanitize_select',
			'default' => 'numeric',
		)
	);

	$archive_pagination_description = '';
	$archive_pagination_choices = array( 
				'disable' => esc_html__( '--Disable--', 'bulletin-news' ),
				'numeric' => esc_html__( 'Numeric', 'bulletin-news' ),
				'older_newer' => esc_html__( 'Older / Newer', 'bulletin-news' ),
			);
	
	$wp_customize->add_control(
		'bulletin_news_archive_pagination_type',
		array(
			'section'		=> 'bulletin_news_archive_settings',
			'label'			=> esc_html__( 'Pagination type:', 'bulletin-news' ),
			'description'			=>  $archive_pagination_description,
			'type'			=> 'select',
			'choices'		=> $archive_pagination_choices,
		)
	);
 ?>