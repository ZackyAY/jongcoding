<?php
/**
 * The front page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shadow Themes
 */

get_header(); 


// Call home.php if Homepage setting is set to latest posts.
if ( ( is_front_page() || is_home() )) { ?>
	<div class="wrapper">
		<div id="homepage-primary" >
			<?php 

				get_template_part( 'inc/homepage/featured-articles' ); 
				get_template_part( 'inc/homepage/slider' ); 
				

				if ( is_active_sidebar( 'homepage-widget' ) ) :
						dynamic_sidebar( 'homepage-widget' );
				endif;
				get_template_part( 'inc/homepage/two-column' ); 
			?>
		</div><!-- #primary -->
		<div id="homepage-secondary">
			<?php 
				if ( is_active_sidebar( 'homepage-sidebar' ) ) :
						dynamic_sidebar( 'homepage-sidebar' );
				endif;
			?>
		</div>
	</div>
	<?php get_template_part( 'inc/homepage/must-read' ); ?>


<?php
get_footer();
}
 
