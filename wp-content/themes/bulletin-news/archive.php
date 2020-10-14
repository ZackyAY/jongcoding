<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shadow Themes
 */

get_header(); ?>
	    

    <div id="inner-content-wrapper" class="wrapper page-section">
        <div class="">
			<div id="primary" class="content-area">
				<div class="page-site-header">


			        	<?php  
				        $breadcrumb_enable = get_theme_mod( 'bulletin_news_breadcrumb_enable', true );
				        if ( $breadcrumb_enable ) : 
				            ?>
				            <div id="breadcrumb-list">

				                    <?php echo bulletin_news_breadcrumb( array( 'show_on_front'   => false, 'show_browse' => false ) ); ?>
				            </div><!-- #breadcrumb-list -->
				        <?php endif; ?>
			            <header class="shadow-page-header">
			                <?php
							the_archive_title( '<h1 class="shadow-page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
			            </header><!-- .shadow-page-header -->

			    </div><!-- #page-site-header -->
                <main id="main" class="site-main" role="main">
                	<?php 
                	$col='';
            		$archive_sidebar = get_theme_mod( 'bulletin_news_archive_sidebar', 'right' ); 
    	    		if ( 'no' === $archive_sidebar ){
    	    			$col = '3';
    	    		} else {
    	    			$col = '2';
    	    		}
                	?>
                    <div id="bulletin-news-infinite-scroll" class="blog-posts-wrapper grid column-<?php echo esc_attr( $col );?>">

						<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );

							endwhile;

							wp_reset_postdata();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div><!-- .posts-wrapper -->
					<?php bulletin_news_posts_pagination(); ?>
				</main><!-- #main -->
			</div><!-- #primary -->
			
			<?php get_sidebar(); ?>

		</div>
	</div>

<?php
get_footer();
