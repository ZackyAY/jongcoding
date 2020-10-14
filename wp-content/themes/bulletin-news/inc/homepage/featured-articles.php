<?php
    /**
 * Template part for displaying front page trending.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
$featured_articles_enable = get_theme_mod( 'bulletin_news_featured_articles_section_enable', false );

if ( false == $featured_articles_enable ) {
    return;
}


$featured_articles_section_title = get_theme_mod( 'bulletin_news_featured_articles_title');


$default = bulletin_news_get_default_mods(); ?>

<div id="featured-articles" class="page-section">
    <div class="shadow-section-header">

        <?php if(!empty($featured_articles_section_title)):?>
            <h2 class="shadow-section-title"><?php echo esc_html($featured_articles_section_title);?></h2>
        <?php endif;?>
    </div><!-- .shadow-section-header -->
    <div class="section-content clear">
        <?php
            
                    $featured_articles_cat_id = get_theme_mod( 'bulletin_news_featured_articles_cat' );
                    $args = array(
                        'cat' => $featured_articles_cat_id,   
                        'posts_per_page' => 5,
                    );
                $query = new WP_Query( $args );

                $i = 1;
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) :
                        $query->the_post();
                        ?>
                        <article class="has-post-thumbnail">
                            <div class="featured-articles-item">
                                <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                                    <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
                                </div><!-- .featured-image -->
                                
                                <div class="shadow-entry-container">
                                    <div class="shadow-entry-meta"> 
                                        <?php bulletin_news_cats(); ?>
                                    </div>
                                    <header class="shadow-entry-header">
                                        <h2 class="shadow-entry-title"><a href="<?php the_permalink();?> "><?php the_title();?></a></h2>
                                    </header>
                                    <div class="shadow-entry-meta">                             
                                        <?php bulletin_news_posted_on(); 
                                        bulletin_news_post_author(); ?>
                                    </div><!-- .entry-meta -->
                                    <div class="shadow-entry-content">
                                        <?php $excerpt = get_the_content() ;
                                        echo wp_kses_post( substr($excerpt, 0, 160) ) .'.....'; ?>
                                    </div><!-- .shadow-entry-content -->
                                </div><!-- .shadow-entry-container -->
                            </div>
                        </article>
                <?php 
                    $i++;
                    endwhile;
                    
                endif; 
                wp_reset_postdata(); ?>
    </div>
</div>