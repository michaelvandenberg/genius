<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Genius
 */

if ( ! function_exists( 'genius_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function genius_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'genius' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'genius' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'genius_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function genius_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && is_singular() ) {

		$categories_list = get_the_category_list();
		if ( $categories_list && genius_categorized_blog() ) {
			echo '<span class="cat-links">';
			echo $categories_list;
			echo '</span>';
		}

		$tags_list = get_the_tag_list();
		if ( $tags_list ) {
			echo '<span class="tags-links">';
			echo $tags_list;
			echo '</span>';
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'No Comments', 'genius' ), esc_html__( '1 Comment', 'genius' ), esc_html__( '% Comments', 'genius' ) );
		echo '</span>';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function genius_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'genius_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'genius_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so genius_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so genius_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in genius_categorized_blog.
 */
function genius_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'genius_categories' );
}
add_action( 'edit_category', 'genius_category_transient_flusher' );
add_action( 'save_post',     'genius_category_transient_flusher' );

if ( ! function_exists( 'genius_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Genius 1.0
 */
function genius_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() && is_page_template() ) : ?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'genius-full-width-thumbnail' ); ?>
	</div><!-- .post-thumbnail -->

	<?php elseif ( is_singular() ) : ?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<div class="post-thumbnail">
		<a class="post-thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
			?>
		</a>
	</div><!-- .post-thumbnail -->

	<?php endif; // End is_singular()
}
endif; // genius_post_thumbnail

if ( ! function_exists( 'genius_portfolio_image' ) ) :
/**
 * Display a featured post thumbnail for the slider.
 *
 * @since Genius 1.0.0
 */
function genius_portfolio_image() {
	if ( ! has_post_thumbnail() ) {
		return;
	}

	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'genius-portfolio-img' );

	echo 'style="background-image: url(' . esc_url( $thumb_url[0] ) . ');"';

}
endif; // genius_portfolio_image

if ( ! function_exists( 'genius_featured_image' ) ) :
/**
 * Display a featured post thumbnail for the latest posts on the frontpage with portfolio page template.
 *
 * @since Genius 1.0.0
 */
function genius_featured_image() {
	if ( ! has_post_thumbnail() ) {
		return;
	}

	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'genius-featured-img' );

	echo 'style="background-image: url(' . esc_url( $thumb_url[0] ) . ');"';

}
endif; // genius_featured_image

if ( ! function_exists( 'genius_blog_url' ) ) :
/**
 * Echo the blog url.
 *
 * @since Genius 1.0.0
 */
function genius_blog_url() {
	// Get the read more text.
	$read_more = get_theme_mod( 'genius_featured_read_more', __('Read more', 'genius' ) );

	echo '<a class="blog-url" href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . esc_html( $read_more ) . '</a>';
}
endif; // genius_blog_url

if ( ! function_exists( 'genius_portfolio_url' ) ) :
/**
 * Echo a read more url for the portfolio page if the total posts is higher dan the displayed posts.
 *
 * @since Genius 1.0.0
 */
function genius_portfolio_url() {
	// Return if the jetpack-portfolio custom post type doesn't exist.
	if ( ! post_type_exists( 'jetpack-portfolio' ) ) {
		return;
	}

	// Return if the post limit is more than total posts.
	$post_limit = get_theme_mod( 'genius_portfolio_limit', 9 );
	$total_posts = wp_count_posts( 'jetpack-portfolio' )->publish;

	if ( $post_limit > $total_posts ) {
		return;
	}

	// Get the portfolio page url.
	$args = [
		'post_type'		=> 'page',
		'fields'		=> 'ids',
		'nopaging'		=> true,
		'meta_key'		=> '_wp_page_template',
		'meta_value'	=> 'template-parts/template-portfolio.php'
	];
	$pages = get_posts( $args );

	foreach ( $pages as $page ) {
		$portfolio_id = $page;
	}

	$portfolio_url = get_page_link( $portfolio_id );

	// Get the read more text.
	$read_more = get_theme_mod( 'genius_portfolio_read_more', __('Discover more', 'genius' ) );

	echo '<a class="portfolio-url" href="' . esc_url( $portfolio_url ) . '">' . esc_html( $read_more ) . '</a>';
}
endif; // genius_portfolio_url

if ( ! function_exists( 'genius_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since genius 0.9.2
 */
function genius_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;