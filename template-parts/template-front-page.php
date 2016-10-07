<?php
/**
 * Template Name: Front Page
 *
 * The template for displaying the front page.
 */

get_header(); ?>

	<div id="primary" class="content-area front-page">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();
				// Fetch post content.
				$content = get_post_field( 'post_content', get_the_ID() );

				// Apply filters.
				$content = apply_filters('the_content', $content);

				// Get content parts.
				$content_parts = get_extended( $content );

			endwhile; // End of the loop. ?>

			<div class="fp-excerpt">
				<?php // Output part before <!--more--> tag.
				echo $content_parts['main']; ?>
			</div>

			<?php get_template_part( 'template-parts/part-portfolio' ); ?>

			<?php genius_portfolio_url(); ?>

			<?php
				if ( ! empty( $content_parts['extended'] ) ) : ?>
					<div class="fp-content">
						<?php
							// Output part after <!--more--> tag.
							echo $content_parts['extended'];
						?>
					</div>
				<?php 
				endif;
			?>

			<?php get_template_part( 'template-parts/part-featured-posts' ); ?>

			<?php genius_blog_url(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
