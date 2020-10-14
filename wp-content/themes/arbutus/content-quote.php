<?php
/**
 * @package Arbutus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<header class="entry-header" <?php arbutus_post_thumbnail_style(); ?>>
			<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'screen-reader-text' ) ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<a href="<?php the_permalink(); ?>">
			<div class="inner">
			<?php /* translators: %s is the post title */
			the_content( sprintf( __( 'Continue reading %s', 'arbutus' ),
				'<span class="screen-reader-text">' . get_the_title() .
				' </span><span class="meta-nav">&rarr;</span>' ) ); ?>
			</div>
		</a>
	</div><!-- .entry-content -->
</article><!-- #post-## -->