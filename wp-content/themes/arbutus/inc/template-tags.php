<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Arbutus
 */

if ( ! function_exists( 'arbutus_post_thumbnail_style' ) ) :
/**
 * Display the Featured Image/Post Thumbnail inline style for the current post.
 */
function arbutus_post_thumbnail_style() {
	$img = arbutus_get_post_image( 'post-thumbnail' );
	if ( is_array( $img ) ) {
		$img = $img[0];
	}
	echo 'style="background-image: url(' . esc_url( $img ) . ');"';
}
endif;

if ( ! function_exists( 'arbutus_post_thumbnail_img' ) ) :
/**
 * Render the Featured Image/Post Thumbnail img tag for the current post.
 */
function arbutus_post_thumbnail_img() {
	$img = arbutus_get_post_image( 'post-thumbnail' );
	if ( ! is_array( $img ) ) {
		if ( '' === $img ) {
			echo '<div id="full-page-image" class="empty"></div>';
			return;
		} elseif ( '/img/default.png' === substr( $img, -16 ) ) {
			// Define default image properties without loading the image file.
			$img = array( 0 => $img, 1 => 1900, 2 => 1075 );
		} else {
			$fullimgdata = getimagesize( $img );
			$imgdata = array(
				0 => $img, // url
				1 => $fullimgdata[0], // width
				2 => $fullimgdata[1], // height
			);
			$img = $imgdata;
		}
	}

	// Determine image orientation.
	$orientation = ( $img[1] > $img[2] ) ? 'landscape' : 'portrait';

	echo '<div id="full-page-image" class="entry-visual ' . $orientation . '" style="background-image: url(' . esc_url( $img[0] ) . ');">';
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'post-thumbnail', array( 'class' => 'screen-reader-text' ) );
	}
	echo '</div>';
}
endif;

/**
 * Get the featured image (post thumbnail) URL, if it exists, or otherwise,
 * look for another image in the post to use as the featured image.
 *
 * Based on cxnh_quickshare_get_post_image(), from the QuickShare plugin by Nick Halsey.
 *
 * @param string $size WordPress image size to get.
 * @return string $url URL of the post image.
 *
 * @since Arbutus 1.0
 */
function arbutus_get_post_image( $size = 'post-thumbnail' ) {
	global $post;
	$imgdata = array();

	// If there's a featured image, use it.
	if ( has_post_thumbnail() ) {
		$imgdata = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
	} elseif ( is_attachment() ) {
		$imgdata = wp_get_attachment_image_src( $post->ID, $size ); // Attachment post type, so post id is attachment id.
	} else {
		// Next, try grabbing first attached image.
		$args = array(
			'numberposts' => 1,
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'post_mime_type' => 'image'
		);
		$attachments = get_children( $args ); // Array is keyed by attachment id.
		if ( ! empty( $attachments ) ) {
			$rekeyed_array = array_values( $attachments );
			$imgdata = wp_get_attachment_image_src( $rekeyed_array[0]->ID , 'post-thumbnail' );
		} else {
			// Finally, look for the first img tag brute-force. Presumably if there's a caption or it's a gallery or anything it should have come up as an attachment.
			$result = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ); // Find img tags, grab srcs.
			if ( $result > 0 ) {
				return $matches[1][0]; // Grab the first img src, no way to select size if we've gotten this deep.
			}
		}
	}

	if ( ! empty( $imgdata ) ) {
		return $imgdata;
	} else {
		// Use the default/fallback post image, if it exists.
		return get_theme_mod( 'default_image', get_stylesheet_directory_uri() . '/img/default.png' );
	}
}

if ( ! function_exists( 'arbutus_gallery_excerpt' ) ) :
/**
 * Display an excerpt from a gallery format's gallery: one full row of images, with a read more link.
 * If no gallery exists in the post, display the content excerpt instead.
 */
function arbutus_gallery_excerpt() {
	global $post;
	$data = get_post_gallery( $post, false ); // This should return information including the gallery IDs.

	$ids = array();
	$srcs = array();

	if ( is_array( $data ) ) {
		if ( ! array_key_exists( 'ids', $data ) ) {
			$srcs = get_post_gallery_images(); // We have to use whatever size the user selected or the default since the ids aren't directly available.
		} else {
			$ids = explode( ',', $data['ids'] );
		}
	} else {
		/* 	get_post_gallery() is completely broken in WordPress core for block editor galleries. 
			This function reconstructs that functionality based on the html output.
		*/

		// Start by attempting to locate attachment ids from data-attributes.
		$result = preg_match_all( '/(<img[^>]+data-id="([^\\"]+)"[^>]+\\/>)/', $post->post_content, $matches ); // Find img tags, grab data-ids.

		if ( $result > 0 ) {
			$i = 0;
			while ( $i < 8 && $i < ( $result - 1 ) ) {
				$ids[] = absint( $matches[2][$i] ); // Grab the img id.
				$i = $i + 1;
			}
		}

		if ( count( $ids ) < 2 ) {

			// Next, try to locate image SRCs.
			$result = preg_match_all( '/(<img[^>]+src="([^\\"]+)"[^>]+\\/>)/', $post->post_content, $matches ); // Find img tags, grab srcs.
			if ( $result > 0 ) {
				$i = 0;
				while ( $i < 8 && $i < ( $result - 1 ) ) {
					$ids[] = esc_url( $matches[2][$i] ); // Grab the img src; we can't quickly get size or other data.
					$i = $i + 1;
				}
			}
		}
	}

	if ( empty( $ids ) && empty( $srcs ) ) {
		if ( ! has_post_thumbnail() ) {
			// Make sure that the title is displayed if there's no image or gallery but the format is gallery.
			the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		}
		the_excerpt();
		return;
	}

	echo '<ul class="gallery-excerpt">';

	// Display up to 8 images.
	$i = 0;
	while ( $i < 8 ) {
		if ( ! array_key_exists( $i, $ids ) && ! array_key_exists( $i, $srcs ) ) {
			break;
		}
		if ( ! empty( $srcs ) ) {
			$src = $srcs[$i];
			$orientation = 'landscape'; // This is the fallback for older shortcodes and the block editor, so hopefully they're landscape.
		} else {
			$img = wp_get_attachment_image_src( absint( trim( $ids[$i] ) ), 'medium_large' ); // Depending on aspect ratio, the "medium" size may not be big enough. We need at least 300px square.
			$src = $img[0];
			$orientation = ( $img[1] > $img[2] ) ? 'landscape' : 'portrait';
			if ( 'landscape' === $orientation && 1.33 * $img[1] > $img[2] ) {
				$orientation .= ' wide';
			} elseif ( 1.33 * $img[2] > $img[1] ) {
				$orientation .= ' tall';
			}
		}
		if ( $src ) {
			echo '<li class="gallery-excerpt-item"><img src="' . esc_url( $src ) . '" class="gallery-excerpt-image ' . esc_attr( $orientation ) . '" alt=""></li>'; // The excerpt is decorative, so use an empty alt tag for all images.
		}
		$i++;
	}
	// Read more button.
	if ( has_post_thumbnail() ) {
		$title = sprintf ( __( 'See more %s', 'arbutus' ),
			'<span class="screen-reader-text">' . esc_html( get_the_title() ) .
			' </span><span class="meta-nav" aria-hidden="true"> &rarr;</span>' );
	} else {
		$title = esc_html( get_the_title() ) . '<span class="meta-nav" aria-hidden="true">&rarr;</span>';
	}
	echo '<li class="gallery-excerpt-item"><a href="' . esc_url( get_the_permalink() ) . '" class="excerpt-more button" rel="bookmark">' . $title . '</a></li>';
	echo '</ul>';
}
endif;

/**
 * Determine whether the current post excerpt seems like it could potentially
 * be displayed in multiple columns, based on its length and format.
 */
function arbutus_content_in_columns() {
	// Post formats that are always one-column.
	if ( has_post_format( array ( 'gallery', 'video', 'audio', 'quote' ) ) ) {
		return false;
	}

	$word_count = arbutus_word_count();

	// Post formats where excerpts are displayed on non-single views - no upper length-limit.
	if ( ! is_singular() && 'aside' !== get_post_format() && 50 < $word_count ) {
		return true;
	}

	// Below minimum or above maximum length to display nicely in multiple columns without scrolling.
	if ( 50 > $word_count || 400 < $word_count ) {
		return false;
	}

	return true;
}

/**
 * Return an approximate post word count.
 */
function arbutus_word_count() {
	$content = get_the_content();
	return str_word_count( wp_strip_all_tags( $content ) );
}

if ( ! function_exists( 'arbutus_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function arbutus_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation" aria-label="<?php esc_attr_e( _x( 'Paging', 'paging navigation', 'arbutus' ) ); ?>">
		<div class="inner">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'arbutus' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav" aria-hidden="true">&larr;</span> Older posts', 'arbutus' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav" aria-hidden="true">&rarr;</span>', 'arbutus' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</div>
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'arbutus_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function arbutus_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation" aria-label="<?php esc_attr_e( _x( 'Post', 'post navigation', 'arbutus' ) ); ?>">
		<div class="inner">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'arbutus' ); ?></h1>
			<div class="nav-links">
				<?php
					previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav" aria-hidden="true">&larr;</span>&nbsp;%title', 'Previous post link', 'arbutus' ) );
					next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav" aria-hidden="true">&rarr;</span>', 'Next post link',     'arbutus' ) );
				?>
			</div><!-- .nav-links -->
		</div><!-- .inner-->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'arbutus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function arbutus_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'arbutus' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'arbutus' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function arbutus_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'arbutus_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'arbutus_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so arbutus_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so arbutus_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in arbutus_categorized_blog.
 */
function arbutus_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'arbutus_categories' );
}
add_action( 'edit_category', 'arbutus_category_transient_flusher' );
add_action( 'save_post',     'arbutus_category_transient_flusher' );


/**
 * Display the footer credits area.
 */
function arbutus_footer_credits() {
	$sep_span = '<span class="sep" role="separator" aria-hidden="true"> | </span>';
	?>&copy <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="footer-copy-name"><?php echo esc_html( get_theme_mod( 'copy_name', get_bloginfo( 'name' ) ) ); ?></a>
	<?php if ( '' !== get_privacy_policy_url() ) { ?>
		<span class="privacy-policy">
			<?php echo $sep_span; the_privacy_policy_link(); ?>
		</span>
	<?php } if ( get_theme_mod( 'powered_by_wp', true ) || is_customize_preview() ) { ?>
		<span class="wordpress-credit" <?php if ( ! get_theme_mod( 'powered_by_wp', true ) && is_customize_preview() ) { echo 'style="display: none;"'; } ?>>
			<?php echo $sep_span; ?><a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'arbutus' ), 'WordPress' ); ?></a>
		</span>
	<?php } if ( get_theme_mod( 'theme_meta', false ) || is_customize_preview() ) { ?>
		<span class="theme-credit" <?php if ( ! get_theme_mod( 'theme_meta', false ) && is_customize_preview() ) { echo 'style="display: none;"'; } ?>>
			<?php echo $sep_span; ?><?php printf( __( 'Theme: %1$s by %2$s.', 'arbutus' ), 'Arbutus', '<a href="https://celloexpressions.com/" rel="designer">Nick Halsey</a>' ); ?>
		</span>
	<?php }
}