<?php
    /**
 * Template part for displaying front page trending.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
$trending_enable = get_theme_mod( 'bulletin_news_trending_section_enable', false );

if ( false == $trending_enable ) {
    return;
}

$trending_section_title = get_theme_mod( 'bulletin_news_trending_title');
?>

<div id="trending" class="page-section">
    <div class="wrapper">
        <div class="shadow-section-header">

            <?php if(!empty($trending_section_title)):?>
                <h2 class="shadow-section-title" ><?php echo esc_html($trending_section_title);?></h2>
            <?php endif;?>
        </div><!-- .shadow-section-header -->
        <div class="trending-wrapper">
            <?php
                $trending_cat_id = get_theme_mod( 'bulletin_news_trending_cat' );
                $args = array(
                    'cat' => $trending_cat_id,   
                    'posts_per_page' => 4,
                );
                $query = new WP_Query( $args );

                $i = 1;
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) :
                        $query->the_post();
                        ?>
                        <article>
                            <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                                <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
                            </div><!-- .featured-image -->
                            <div class="shadow-entry-meta"> 
                                <?php bulletin_news_cats(); ?>
                            </div>
                            <div class="shadow-entry-container">
                                
                                <header class="shadow-entry-header">
                                    <h2 class="shadow-entry-title"><a href="<?php echo the_permalink();?> " ><?php the_title();?></a></h2>
                                </header>
                                <div class="shadow-entry-meta">                       
                                    <?php bulletin_news_posted_on(); 
                                    bulletin_news_post_author(); ?>
                                </div><!-- .entry-meta -->
                                
                            </div><!-- .shadow-entry-container -->
                        </article>
                <?php 
                    $i++;
                    endwhile;
                   
                endif;
                 wp_reset_postdata();
             ?>
        </div>
    </div>
</div>

