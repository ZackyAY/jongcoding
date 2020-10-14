<?php 
	/**
	 *
	 * Active callbacks.
	 * 
	 */

	/**========== Featured Articles Section ============**/

	/**
	 * Check if Hero Section is enabled
	 */
	function bulletin_news_is_hero_section_enable( $control ) {
		return $control->manager->get_setting( 'bulletin_news_hero_section_section_enable' )->value();
	}


	/**====================================================================**/

	/**========================== Slider Section =============================**/

	/**
	 * Check if Featured Slider is enabled
	 */
	function bulletin_news_is_featured_slider_enable( $control ) {
		return $control->manager->get_setting( 'bulletin_news_featured_slider_section_enable' )->value();
	}

	/**============================================================================**/

	/**================== Breaking News Section ===================**/

	/**
	 * Check if Breaking News POst is enabled
	 */
	function bulletin_news_is_breaking_enable( $control ) {
		return $control->manager->get_setting( 'bulletin_news_breaking_section_enable' )->value();
	}

	/**========================================================================**/

	/**============================ Trending Section ===========================**/

	/**
	 * Check if Trending POst is enabled
	 */
	function bulletin_news_is_trending_enable( $control ) {
		return $control->manager->get_setting( 'bulletin_news_trending_section_enable' )->value();
	}


	/**==========================================================================**/

	/**====================== Featured Articles Section =====================**/

	/**
	 * Check if Featured Articles POst is enabled
	 */
	function bulletin_news_is_featured_articles_enable( $control ) {
		return $control->manager->get_setting( 'bulletin_news_featured_articles_section_enable' )->value();
	}

	/**=========================================================================**/

	/**============================= Two Column Section =======================**/

	/**
	 * Check if Two Column POst is enabled
	 */
	function bulletin_news_is_two_column_enable( $control ) {
		return $control->manager->get_setting( 'bulletin_news_two_column_section_enable' )->value();
	}

	/**==================================================================================**/

	/**=============================== Must Read News Section ============================**/

	/**
	 * Check if Must Read News POst is enabled
	 */
	function bulletin_news_is_must_read_enable( $control ) {
		return $control->manager->get_setting( 'bulletin_news_must_read_section_enable' )->value();
	}

/**============================================================================**/

?>