<?php
/**
 * @package Arbutus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<header class="entry-header" <?php arbutus_post_thumbnail_style(); ?>></header><!-- .entry-header -->
	</a>
	<div class="entry-content <?php if ( arbutus_content_in_columns() ) { echo 'columns'; } ?>">
		<div class="inner">
			<?php /* translators: %s is the post title */
			the_content( sprintf( __( 'Continue reading %s', 'arbutus' ),
				'<span class="screen-reader-text">' . get_the_title() .
				' </span><span class="meta-nav">&rarr;</span>' ) ); ?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->