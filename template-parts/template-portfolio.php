<?php
/**
 * Template Name: Portfolio
 *
 * The template for displaying the portfolio page.
 */

get_header(); ?>

	<div id="primary" class="content-area portfolio">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile; // End of the loop. ?>

			<?php get_template_part( 'template-parts/part-portfolio' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
