<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shadow Themes
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
	<?php 
	$archive_img_enable = get_theme_mod( 'bulletin_news_enable_archive_featured_img', true );

	$img_url = '';
	if ( has_post_thumbnail() && $archive_img_enable ) : 
		$img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	endif;
	?>
	<?php if ( ! empty( $img_url ) ) : ?>
		<div class="featured-image">
		    	<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $img_url ); ?>"></a>
		</div><!-- .featured-image -->
	<?php endif; ?>

	<div class="shadow-entry-container">
		<?php
			$enable_archive_author = get_theme_mod( 'bulletin_news_enable_archive_author', true );
			$archive_date_enable = get_theme_mod( 'bulletin_news_enable_archive_date', true );
			$archive_category_enable = get_theme_mod( 'bulletin_news_enable_archive_category', true );
			$archive_tags_enable = get_theme_mod( 'bulletin_news_enable_archive_tags', true );
		
		if ( $archive_category_enable ) {
		 	bulletin_news_cats(); 
		 }?>

		    	
	    <header class="shadow-entry-header">
	        <?php
			if ( is_singular() ) :
				the_title( '<h1 class="shadow-entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="shadow-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
	    </header>

	    
		
	    <div class="shadow-entry-content">
	        <?php
				$archive_content_type = get_theme_mod( 'bulletin_news_enable_archive_content_type', 'excerpt' );
				if ( 'excerpt' === $archive_content_type ) {
					the_excerpt();
					?>
			        <div class="read-more-link">
					    <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'bulletin_news_archive_excerpt', esc_html__( 'View the post', 'bulletin-news' ) ) ); ?></a>
					</div><!-- .read-more -->
				<?php
				} else {
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bulletin-news' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bulletin-news' ),
						'after'  => '</div>',
					) );
				}
			?>
			<div class="shadow-entry-meta shadow-posted">
				<?php if ( $enable_archive_author || $archive_date_enable ) :
			        if ( $enable_archive_author ) {
						bulletin_news_post_author(); 
					}

					if ( $archive_date_enable ) {
						bulletin_news_posted_on(); 
					}
				endif; ?>
			</div>
	    	
	    	<?php if ( $archive_tags_enable ) {
	    	 	bulletin_news_tags();
	    	 } ?>

	    </div><!-- .shadow-entry-content -->
    </div><!-- .shadow-entry-container -->
</article><!-- #post-<?php the_ID(); ?> -->
