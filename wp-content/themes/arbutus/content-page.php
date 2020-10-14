<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Arbutus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! is_front_page() ) : ?>
		<header class="entry-header">
			<?php echo arbutus_post_thumbnail_img(); ?>
			<div class="inner">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content <?php if ( arbutus_content_in_columns() ) { echo 'columns'; } ?>">
		<div class="inner">
			<?php if ( is_front_page() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} ?>

			<?php /* translators: %s is the post title */
			the_content( sprintf( __( 'Continue reading %s', 'arbutus' ),
				'<span class="screen-reader-text">' . get_the_title() .
				' </span><span class="meta-nav">&rarr;</span>' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'arbutus' ),
					'after'  => '</div>',
				) );
			?>
			<?php edit_post_link( __( 'Edit', 'arbutus' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .inner -->
	</div><!-- .entry-content -->
</article><!-- #post-## -->
