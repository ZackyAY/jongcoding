<?php
    /**
 * Template part for displaying front page trending.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
    $two_column_enable = get_theme_mod( 'bulletin_news_two_column_section_enable', false );

    if ( false == $two_column_enable ) {
        return;
    }
    $two_column_section_title = get_theme_mod( 'bulletin_news_two_column_title');
?>

<div class="shadow-popular-news">
    <div class="shadow-section-header">
        <?php if(!empty($two_column_section_title)):?>
            <h2 class="shadow-section-title" ><?php echo esc_html($two_column_section_title);?></h2>
        <?php endif;?>
    </div><!-- .shadow-section-header -->
    <div class="section-content clear">
        <?php

            $two_column_cat_id = get_theme_mod( 'bulletin_news_two_column_cat' );
            $args = array(
                'cat' => $two_column_cat_id,   
                'posts_per_page' => 4,
            );
            $query = new WP_Query( $args );

            $i = 1;
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    ?>
                    <div class="popular-post-wrapper">   
                        <article class="hentry full-width">
                            <div class="post-wrapper">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="featured-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                        </a>
                                    </div><!-- .recent-image -->
                                <?php endif; ?>

                                <div class="shadow-entry-container">
                                    <div class="shadow-entry-meta"> 
                                        <?php the_category(); ?>
                                    </div>
                                    <header class="shadow-entry-header">
                                        <h2 class="shadow-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </header>
                                    <div class="shadow-entry-meta">   
                                        <?php bulletin_news_posted_on();
                                        bulletin_news_post_author(); ?>
                                    </div><!-- .entry-meta -->
                                    <div class="shadow-entry-content">
                                        <?php the_excerpt(); ?>
                                    </div><!-- .entry-content -->
                                    
                                </div><!-- .entry-container -->
                            </div><!-- .post-wrapper -->
                        </article>
                    </div><!-- .popular-post-wrapper -->
            <?php 
                $i++;
                endwhile;
               
            endif;
             wp_reset_postdata();
         ?>
    </div>
</div>