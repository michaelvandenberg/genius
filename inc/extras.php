<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Genius
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function genius_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class if the page is the front page and is using the portfolio or front page template.
	if ( is_front_page() && ( ( is_page_template( 'template-parts/template-portfolio.php' ) || is_page_template( 'template-parts/template-front-page.php' ) ) ) ) {
		$classes[] = 'frontpage-and-portfolio';
	}

	// Adds a class if the page is using the portfolio or front page template.
	if ( is_page_template( 'template-parts/template-portfolio.php' ) || is_page_template( 'template-parts/template-front-page.php' ) ) {
		$classes[] = 'load-isotope';
	}

	// Adds a class if page template doesn't display the sidebar.
	if ( ! is_active_sidebar( 'sidebar-1') || is_page_template( 'template-parts/template-portfolio.php' ) || is_page_template( 'template-parts/template-front-page.php' ) || is_page_template( 'template-parts/template-full-width.php' ) ) {
		$classes[] = 'no-sidebar';
	}
	else {
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'genius_body_classes' );

/**
 * Turn a multi-dimensional array into a simple flat array and remove duplicates.
 *
 * @link http://stackoverflow.com/a/14972714/4429450
 */
function genius_flatten_array_and_remove_duplicates( $array ) {
	$result = array();
	foreach ($array as $key => $value) {
		if (is_array($value)){ $result = array_merge($result, genius_flatten_array_and_remove_duplicates($value));}
		else {$result[$key] = $value;}
	}

	// Remove duplicate entries.
	$return = array_unique($result);

	return $return;
}

/**
 * Add featured image as background image to post navigation elements.
 *
 * @see wp_add_inline_style()
 */
function genius_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'genius-navigation' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevThumb[0] ) . '); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'genius-navigation' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextThumb[0] ) . '); }
		';
	}

	wp_add_inline_style( 'genius-style', $css );
}
add_action( 'wp_enqueue_scripts', 'genius_post_nav_background' );