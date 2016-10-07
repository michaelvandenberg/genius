<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Genius
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 * See: https://jetpack.me/support/featured-content/
 * See: https://jetpack.me/support/custom-content-types/
 */
function genius_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'genius_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Portfolio Custom Post Type.
	add_theme_support( 'jetpack-portfolio' );

	// Get the number of featured posts per page.
	$posts_per_page = get_theme_mod( 'genius_featured_limit', 5 );

	// Add theme support for Featured Content.
	add_theme_support( 'featured-content', array(
		'filter'     => 'genius_get_featured_posts',
		'max_posts'  => $posts_per_page,
		'post_types' => array( 'post', 'page' ),
	) );
}
add_action( 'after_setup_theme', 'genius_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function genius_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

/**
 * Get the featured posts function.
 */
function genius_get_featured_posts() {
	return apply_filters( 'genius_get_featured_posts', array() );
} // end function genius_get_featured_posts

/**
 * Check the number of featured posts.
 */
function genius_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return false;

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'genius_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;

	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
} // end function genius_has_featured_posts
