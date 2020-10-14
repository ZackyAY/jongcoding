<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shadow Themes
 */

$default = bulletin_news_get_default_mods();
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<!-- supports column-1, column-2, column-3 and column-4 -->
		<!-- supports unequal-width and equal-width -->
		<?php  
		$count = 0;
		for ( $i=1; $i <=4 ; $i++ ) { 
			if ( is_active_sidebar( 'footer-' . $i ) ) {
				$count++;
			}
		}
		
		if ( 0 !== $count ) : ?>
			<div class="footer-widgets-area page-section column-<?php echo esc_attr( $count );?>">
			    <div class="wrapper">
					<?php 
					for ( $j=1; $j <=4; $j++ ) { 
						if ( is_active_sidebar( 'footer-' . $j ) ) {
			    			echo '<div class="column-wrapper">';
							dynamic_sidebar( 'footer-' . $j ); 
			    			echo '</div>';
						}
					}
					?>
				</div><!-- .wrapper -->
			</div><!-- .footer-widget-area -->

		<?php endif;
		 
		$footer_menu = get_theme_mod( 'bulletin_news_enable_footer_social_menu', true );
		$footer_text_enable = get_theme_mod( 'bulletin_news_enable_footer_text', true );
		$footer_text = get_theme_mod( 'bulletin_news_copyright_txt' );

		if ( $footer_menu || $footer_text_enable ) :
			$class = ( $footer_menu && $footer_text_enable ) ? 'column-2' : 'column-1' ;
			?>
			<div class="site-info <?php echo esc_attr( $class ); ?>">
				<!-- supports column-1 and column-2 -->
				<?php 
					$powered_by_text = sprintf( __( 'Copyright All rights reserved.Theme Bulletin News by %s', 'bulletin-news' ), '<a target="_blank" rel="designer" href="'.esc_url( 'http://shadowthemes.com/' ).'">'. esc_html__( 'Shadow Themes', 'bulletin-news' ). '</a>' );
				?>
				<div class="wrapper">
					<span class="footer-copyright">
						<?php echo  $powered_by_text; ?>
					</span><!-- .footer-copyright -->
				    
				    <span class="social-menu"> 
					    <?php if ( $footer_menu && has_nav_menu( 'social' ) ) :
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'	 => 'social-icons',
								'container_class' => 'social-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . bulletin_news_get_icon_svg( 'chain' ),
							) );
					    endif; ?>
				    </span>
				</div><!-- .wrapper -->    
				
			</div><!-- .site-info -->
		<?php endif; ?>
	</footer><!-- #colophon -->
	<div class="popup-overlay"></div>
	<?php  
	$backtop = get_theme_mod( 'bulletin_news_back_to_top_enable', true );
	if ( $backtop ) { ?>
		<div class="backtotop"><?php echo bulletin_news_get_icon_svg( 'keyboard_arrow_down' ); ?></div>
	<?php }	?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
