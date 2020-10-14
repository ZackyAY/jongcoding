<?php
    /**
 * Template part for displaying front page breaking.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
$breaking_enable = get_theme_mod( 'bulletin_news_breaking_section_enable', false );

if ( false == $breaking_enable ) {
    return;
}

$breaking_section_title = get_theme_mod( 'bulletin_news_breaking_title');


$default = bulletin_news_get_default_mods(); ?>

<div id="breaking" class="page-section">
    <div class="wrapper">
        <div class="shadow-section-header breaking-header">

            <?php if(!empty($breaking_section_title)):?>
                <h2 class="shadow-section-title" ><?php echo esc_html($breaking_section_title);?></h2>
            <?php endif;?>
        </div><!-- .shadow-section-header -->
        <div class="breaking-wrapper" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 500, "dots": false, "arrows":true, "autoplay": true, "fade": false }'>
            <?php
                
                $breaking_id = array();
                for ( $i=1; $i <= 4; $i++ ) { 
                    $breaking_id[] = get_theme_mod( "bulletin_news_breaking_page_" . $i );
                }
                $args = array(
                    'post_type' => 'page',
                    'post__in' => (array)$breaking_id,   
                    'orderby'   => 'post__in',
                    'posts_per_page' => 4,
                    'ignore_sticky_posts' => true,
                );
                $query = new WP_Query( $args );
                $i = -1;
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) :
                        $query->the_post();

                        $class='';
                        if ($i==0) {
                            $class='display-block';
                        } else{
                            $class='display-none';}
                        ?>
                    <article class="slick-item <?php echo esc_attr($class); ?>">
                        <header class="shadow-entry-header">
                            <h2 class="shadow-entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        </header>
                    </article><!-- .slick-item -->
                <?php 
                    $i++;
                    endwhile;
                    
                endif;
                wp_reset_postdata();
                ?>
        </div>
    </div>
</div>

