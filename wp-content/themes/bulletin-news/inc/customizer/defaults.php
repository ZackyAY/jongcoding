<?php
/**
 * Shadow Themes Customizer
 *
 * @package Shadow Themes
 */

/**
 * Get all the default values of the theme mods.
 */
function bulletin_news_get_default_mods() {
	$bulletin_news_default_mods = array(

		// Recent posts
		'bulletin_news_recent_posts_more' => esc_html__( 'See More', 'bulletin-news' ),

		// Footer copyright
		'bulletin_news_copyright_txt' => sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'bulletin-news' ), 'Bulletin News', '<a href="' . esc_url( 'http://shadowthemes.com/' ) . '">Shadow Themes</a>' ),

		
	);

	return apply_filters( 'bulletin_news_default_mods', $bulletin_news_default_mods );
}