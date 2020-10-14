<?php
/**
 * The template for displaying image attachments
 *
 * @package Arbutus
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php echo arbutus_post_thumbnail_img(); ?>
					<div class="inner">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="inner">
						<footer class="entry-footer entry-meta">
							<?php if ( is_multi_author() ) : ?>
								<p class="author vcard"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></p>
							<?php endif;

								$time_string = '<p class="entry-date"><time class="published" datetime="%1$s">%2$s</time>';
								if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
									$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
								}
								$time_string .= '</p>';

								printf( $time_string,
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									esc_attr( get_the_modified_date( 'c' ) ),
									esc_html( get_the_modified_date() )
								);

								$url = esc_url( wp_get_original_image_url( $post->ID ) );
								echo '<p><a class="button post-image" href="' . $url . '">' . __( 'View Full-size Image', 'arbutus' ) . '</a>';
								edit_post_link( __( 'Edit', 'arbutus' ), '<span class="edit-link">', '</span>' );
							?>
						</footer><!-- .entry-footer -->
						<div class="single-content <?php if ( arbutus_content_in_columns() ) { echo 'columns'; } ?>">
							<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div><!-- .entry-caption -->
							<?php endif; ?>
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'arbutus' ),
									'after'  => '</div>',
								) );

								// Display the image at large size with link to full
								echo '<a href="' . $url . '">' . wp_get_attachment_image( $post->ID, 'large' ) . '</a>';
							?>
							
						</div>
					</div><!-- .inner -->
				</div><!-- .entry-content -->

			</article><!-- #post-## -->

			<?php arbutus_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
