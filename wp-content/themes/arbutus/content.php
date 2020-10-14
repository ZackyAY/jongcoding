<?php
/**
 * @package Arbutus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" <?php arbutus_post_thumbnail_style(); ?>>
		<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'post-thumbnail', array( 'class' => 'screen-reader-text' ) );
		} ?>
		<div class="inner">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		</div>
	</header><!-- .entry-header -->
	<div class="entry-content <?php if ( arbutus_content_in_columns() ) { echo 'columns'; } ?>">
		<div class="inner">
			<?php the_excerpt(); ?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->