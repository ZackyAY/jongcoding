<?php
/**
 * @package Arbutus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="inner">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<?php /* translators: %s is the post title */
			the_content( sprintf( __( 'Continue reading %s', 'arbutus' ),
				'<span class="screen-reader-text">' . get_the_title() .
				' </span><span class="meta-nav">&rarr;</span>' ) ); ?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->