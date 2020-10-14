<?php
/**
 * Generate custom colors CSS.
 */

function arbutus_get_custom_color_css() {
	$h = absint( get_theme_mod( 'color_hue', 220 ) );

	// Defaults for all colors, so don't need to do anything.
	if ( 220 === $h && ! is_customize_preview() ) {
		return '';
	}

	$css = '
::selection {
	background: hsl(' . $h . ', 80%, 35%);
	color: hsl(' . $h . ', 0%, 100%);
}

.has-black-color {
	color: hsl(' . $h . ', 0%, 0%);
}

.has-charcoal-color,
body,
button,
input,
select,
textarea,
button:focus,
.button:focus,
.site-content .entry-content .button:focus,
.wp-block-button__link:focus,
.site-content .entry-content .wp-block-file__button:focus,
.site-content .entry-content .wp-block-button__link:focus,
input[type="button"]:focus,
input[type="reset"]:focus,
input[type="submit"]:focus,
button:hover,
.button:hover,
.site-content .entry-content .button:hover,
.wp-block-button__link:hover,
.site-content .entry-content .wp-block-file__button:hover,
.site-content .entry-content .wp-block-button__link:hover,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover,
input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="password"]:focus,
input[type="search"]:focus,
textarea:focus,
.post-categories a,
.gallery-excerpt .excerpt-more.button,
.format-audio .entry-title a,
.format-video .entry-title a,
.comments-area {
	color: hsl(' . $h . ', 10%, 13%);
}

.has-light-gray-color,
.site-title a:hover,
.site-title a:focus,
.site-title a:active,
.entry-header .entry-title a:focus,
.entry-header .entry-title a:hover,
.entry-header .entry-title a:active,
.format-quote .entry-content a,
.format-gallery .entry-content a,
.post-navigation a:focus,
.post-navigation a:hover,
.post-navigation a:active,
.paging-navigation a:hover,
.paging-navigation a:focus,
.paging-navigation a:active,
.widget-area a,
.site-footer,
.site-footer a {
	color: hsl(' . $h . ', 10%, 88%);
}

.has-white-color,
button,
.button,
.site-content .entry-content .button,
.wp-block-button__link,
.site-content .entry-content .wp-block-file__button,
.site-content .entry-content .wp-block-button__link,
input[type="button"],
input[type="reset"],
input[type="submit"],
.site-header,
.site-title a,
.has-header-image .site-title,
.has-header-image .site-description,
.main-nav li a,
.main-nav .menu-item-has-children > a:after,
.entry-header .entry-title,
.entry-header .entry-title a,
.excerpt-more.button,
.excerpt-more:hover,
.excerpt-more:focus,
.excerpt-more:active,
.wp-custom-header-video-button,
.post-categories a:focus,
.post-categories a:hover,
.post-categories a:active,
.entry-meta .author:first-letter,
.post-tags a,
.post-tags a:hover,
.post-tags a:focus,
.post-tags a:active,
.site-content .post-image.button,
.format-aside .inner p:first-child:first-letter,
.format-quote .entry-content,
.format-gallery .entry-content,
.gallery-excerpt .excerpt-more.button:hover,
.gallery-excerpt .excerpt-more.button:focus,
.gallery-excerpt .excerpt-more.button:active,
.gallery-excerpt .gallery-excerpt-item:last-child .excerpt-more.button,
.gallery-caption,
.wp-block-gallery .blocks-gallery-image figcaption,
.wp-block-gallery .blocks-gallery-item figcaption,
.page-header,
.post-navigation,
.paging-navigation,
.post-navigation a,
.paging-navigation a,
.widget-area,
.site-footer a:hover,
.site-footer a:focus {
	color: hsl(' . $h . ', 0%, 100%);
}

.has-accent-light-color,
.main-nav li:hover > a,
.main-nav li > a:focus,
.main-nav li a[aria-current],
.widget-area a:hover,
.widget-area a:focus {
	color: hsl(' . $h . ', 50%, 65%);
}

.has-accent-dark-color,
a:hover,
a:focus,
a:active,
.widget-area a:hover,
.widget-area a:focus,
.widget-area a:active,
.site-footer a:hover,
.site-footer a:focus,
.site-footer a:active,
.hentry .mejs-controls .mejs-time-rail .mejs-time-current {
	color: hsl(' . $h . ', 80%, 35%);
}

.has-black-background-color,
.main-nav li:hover > a,
.main-nav li > a:focus,
.main-nav li a[aria-current],
.site-footer {
	background-color: hsl(' . $h . ', 0%, 0%);
}

.has-charcoal-background-color,
.site-header,
.main-nav,
.main-nav .sub-menu,
.archive .entry-header,
.home .entry-header,
.search .page .entry-header,
.excerpt-more.button,
.page .entry-header #full-page-image,
.single .entry-header #full-page-image,
.wp-custom-header-video-button,
.entry-meta .author:first-letter,
.site-content .post-image.button,
.format-aside .inner p:first-child:first-letter,
.format-quote .entry-content,
.format-gallery .entry-content,
.gallery-excerpt .gallery-excerpt-item:last-child .excerpt-more.button:hover,
.gallery-excerpt .gallery-excerpt-item:last-child .excerpt-more.button:focus,
.gallery-caption,
.wp-block-gallery .blocks-gallery-image figcaption,
.wp-block-gallery .blocks-gallery-item figcaption,
.widget-area {
	background-color: hsl(' . $h . ', 10%, 13%);
}

.has-light-gray-background-color,
pre,
hr,
th,
.format-aside .entry-content,
.gallery-excerpt .excerpt-more.button,
.format-audio .entry-content,
.format-video .entry-content {
	background-color: hsl(' . $h . ', 10%, 88%);
}

.has-white-background-color,
button:focus,
.button:focus,
.site-content .entry-content .button:focus,
.wp-block-button__link:focus,
.site-content .entry-content .wp-block-file__button:focus,
.site-content .entry-content .wp-block-button__link:focus,
input[type="button"]:focus,
input[type="reset"]:focus,
input[type="submit"]:focus,
.wp-custom-header-video-button:hover,
.wp-custom-header-video-button:focus,
button:hover,
.button:hover,
.site-content .entry-content .button:hover,
.wp-block-button__link:hover,
.site-content .entry-content .wp-block-file__button:hover,
.site-content .entry-content .wp-block-button__link:hover,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover,
body,
.comments-area {
	background-color: hsl(' . $h . ', 0%, 100%);
}

.has-accent-light-background-color {
	background-color: hsl(' . $h . ', 50%, 65%);
}

.has-accent-dark-background-color,
button,
.button,
.site-content .entry-content .button,
.wp-block-button__link,
.site-content .entry-content .wp-block-file__button,
.site-content .entry-content .wp-block-button__link,
input[type="button"],
input[type="reset"],
input[type="submit"],
.excerpt-more:hover,
.excerpt-more:focus,
.excerpt-more:active,
.gallery-excerpt .excerpt-more.button:hover,
.gallery-excerpt .excerpt-more.button:focus,
.gallery-excerpt .excerpt-more.button:active {
	background-color: hsl(' . $h . ', 80%, 35%);
}

.post-tags a,
.page-header,
.post-navigation,
.paging-navigation {
	background: hsl(' . $h . ', 10%, 25%);
}

.post-categories a:focus,
.post-categories a:hover,
.post-categories a:active {
	background: hsl(' . $h . ', 25%, 35%);
}

.comment-list article {
	border-bottom-color: hsl(' . $h . ', 10%, 88%);
}

.blog .format-image,
.search .format-image,
.archive .format-image {
	border-bottom-color: hsl(' . $h . ', 0%, 0%);
}

.gallery-excerpt .gallery-excerpt-item:last-child .excerpt-more.button {
	border-right-color: hsl(' . $h . ', 10%, 13%);
}

.post-tags a:before {
	border-right-color: hsl(' . $h . ', 10%, 25%);
}

.post-tags a:after {
	border-left-color: hsl(' . $h . ', 10%, 25%);
}

.post-categories a,
input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="password"]:focus,
input[type="search"]:focus,
textarea:focus {
	border-color: hsl(' . $h . ', 25%, 35%);
}

input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
textarea {
	color: hsl(' . $h . ', 10%, 25%);
	border-color: hsl(' . $h . ', 10%, 88%);
}';

	return $css;
}