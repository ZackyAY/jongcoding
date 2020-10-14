<?php
/**
 * Template for displaying search forms
 *
 * @package Shadow Themes
 * @subpackage Shadow Themes
 * @since Shadow Themes 1.0.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'bulletin-news' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'bulletin-news' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label', 'bulletin-news' ) ?>" />
    </label>
    <button type="submit" class="search-submit"
        value="<?php echo esc_attr_x( 'Search', 'submit button', 'bulletin-news' ) ?>"><?php echo bulletin_news_get_icon_svg( 'search' );?></button>
</form>