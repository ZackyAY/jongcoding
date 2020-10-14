<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Shadow Themes
 */

get_header(); ?>
<?php $header_image = get_header_image(); ?>
    <div id="shadow-banner-image" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
        <div class="overlay"></div>
        <div class="page-site-header">
            <div class="wrapper">
                <header class="shadow-page-header">
                    <h1 class="shadow-page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bulletin-news' ); ?></h1>
                </header><!-- .shadow-page-header -->

                <?php  
                $breadcrumb_enable = get_theme_mod( 'bulletin_news_breadcrumb_enable', true );
                if ( $breadcrumb_enable ) : 
                    ?>
                    <div id="breadcrumb-list" >
                            <?php echo bulletin_news_breadcrumb( array( 'show_on_front'   => false, 'show_browse' => false ) ); ?>
                    </div><!-- #breadcrumb-list -->
                <?php endif; ?>
            </div><!-- .wrapper -->
        </div><!-- #page-site-header -->
    </div><!-- #shadow-banner-image -->

	<div id="inner-content-wrapper" class="wrapper page-section">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="single-post-wrapper">

					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'bulletin-news' ); ?></p>

					<?php get_search_form(); ?>
				</div>
			</main><!-- #main -->
		</div><!-- #primary -->
        
        <?php get_sidebar(); ?>

    </div><!-- #inner-content-wrapper-->

<?php
get_footer();
