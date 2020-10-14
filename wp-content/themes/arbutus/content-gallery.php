<?php
/**
 * @package Arbutus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<header class="entry-header" <?php arbutus_post_thumbnail_style(); ?>>
			<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'screen-reader-text' ) ); ?>
			<div class="inner">
				<?php // note: post title is only displayed if there's a featured image ?>
				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			</div>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<div class="inner">
			<?php arbutus_gallery_excerpt(); // note: always links to single post view ?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->