<?php
/**
 * Template part for displaying front page slider.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
$slider_enable = get_theme_mod( 'bulletin_news_featured_slider_section_enable', true );

if ( false == $slider_enable ) {
    return;
}

$slider_section_title = get_theme_mod( 'bulletin_news_slider_title');

?>
<div  class="shadow-featured-slider page-section" >
	<div class="shadow-section-header">
        <?php if(!empty($slider_section_title)):?>
            <h2 class="shadow-section-title" ><?php echo esc_html($slider_section_title);?></h2>
        <?php endif;?>
    </div><!-- .shadow-section-header -->
	<div class="slider-posts" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": true, "arrows":true, "autoplay": false, "draggable": true, "fade": false }'>
	    <?php
    	       
	    $slider_id = array();
	    for ( $i=1; $i <= 3; $i++ ) { 
	        $slider_id[] = get_theme_mod( "bulletin_news_slider_page_" . $i );
	    }
	    $args = array(
	        'post_type' => 'page',
	        'post__in' => (array)$slider_id,   
	        'orderby'   => 'post__in',
	        'posts_per_page' => 3,
	        'ignore_sticky_posts' => true,
	    );
	    
	    $query = new WP_Query( $args );

	    $i = 1;
	    if ( $query->have_posts() ) :
	        while ( $query->have_posts() ) :
	            $query->the_post();
	            ?>
	        
	            <article style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
	            	<a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
		            <div class="wrapper">
		                <div class="featured-content-wrapper">
		                    <header class="shadow-entry-header">
		                        <h2 class="shadow-entry-title" ><a href="<?php echo the_permalink();?> "><?php the_title();?></a></h2>
		                    </header>
		                    <div class="shadow-entry-meta"> 
			                    <?php bulletin_news_posted_on();
			                    bulletin_news_post_author(); ?>
			                </div>
		                </div><!-- .featured-content-wrapper -->
		            </div><!-- .wrapper -->
		        </article>
	        <?php 
	        $i++;
	    	endwhile;
	    endif;
	    wp_reset_postdata();
	     ?>
	</div><!-- #featured-slider -->
</div>