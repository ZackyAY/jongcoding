<?php
/**
 * Template part for displaying front page slider.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
$hero_section_enable = get_theme_mod( 'bulletin_news_hero_section_section_enable', false );

if ( false == $hero_section_enable ) {
    return;
}

$default = bulletin_news_get_default_mods();
?>
<div id="hero-section" class="relative">
    <div class="wrapper">
        <div class="grid">
	    	<?php

		        $hero_section_cat_id = get_theme_mod( 'bulletin_news_hero_section_cat' );
		        $args = array(
		            'cat' => $hero_section_cat_id,   
		            'posts_per_page' => 5,
		        );
	    	    $query = new WP_Query( $args );

	    	    $i = 1;
	    	    if ( $query->have_posts() ) :
	    	        while ( $query->have_posts() ) :
	    	            $query->the_post();
	    	            ?>

	    	            <article class="grid-item">
			                <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
			                	<a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
			                </div>
			                <div class="shadow-entry-container">
			                	<?php  
			                		bulletin_news_cats();
			                	 ?>
			                    <header class="shadow-entry-header">
			                        <h2 class="shadow-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
			                    </header>
			                    <?php if ($i==1) { ?>
				                    <div class="shadow-entry-meta">				             
				                        <?php bulletin_news_posted_on();
				                        bulletin_news_post_author(); ?>
				                    </div><!-- .entry-meta -->
				                <?php } ?>
			                </div><!-- .entry-container -->
			            </article>
	    	       
	    	        <?php 
	    	        $i++;
	    	    	endwhile;
	    	    endif;
	    	     wp_reset_postdata();
	    	?>
        </div><!-- .grid-item -->
    </div><!-- .wrapper -->
</div><!-- #hero-section -->