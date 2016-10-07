<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Genius
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! is_front_page() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title page-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php genius_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'genius' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
