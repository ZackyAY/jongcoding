<?php
    /**
 * Template part for displaying front page must_read.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
$must_read_enable = get_theme_mod( 'bulletin_news_must_read_section_enable', true );

if ( false == $must_read_enable ) {
    return;
}

$must_read_section_title = get_theme_mod( 'bulletin_news_must_read_title');



$default = bulletin_news_get_default_mods(); ?>

<div id="must-read" class="page-section">
    <div class="wrapper">
        <div class="shadow-section-header">
            <?php if(!empty($must_read_section_title)):?>
                <h2 class="shadow-section-title" ><?php echo esc_html($must_read_section_title);?></h2>
            <?php endif;?>
        </div><!-- .shadow-section-header -->
        <div class="must-read-wrapper">
            <?php

                $must_read_id = array();
                for ( $i=1; $i <= 4; $i++ ) { 
                    $must_read_id[] = get_theme_mod( "bulletin_news_must_read_page_" . $i );
                }
                $args = array(
                    'post_type' => 'page',
                    'post__in' => (array)$must_read_id,   
                    'orderby'   => 'post__in',
                    'posts_per_page' => 4,
                    'ignore_sticky_posts' => true,
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
                            <div class="shadow-entry-container">
                                <header class="shadow-entry-header">
                                    <h2 class="shadow-entry-title"><a href="<?php echo the_permalink();?> " ><?php the_title();?></a></h2>
                                </header>                                    
                            </div><!-- .shadow-entry-container -->
                        </article>
                <?php 
                    $i++;
                    endwhile;
                    
                endif; 
                wp_reset_postdata(); ?>
        </div>
    </div>
</div>

