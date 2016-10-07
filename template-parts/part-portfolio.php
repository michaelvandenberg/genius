<?php
/* The part for displaying portfolio items
 * 
 * @package Genius
 */
 ?>

 			<?php	
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = 1;
				endif;

				if ( is_page_template( 'template-parts/template-front-page.php' ) ) :
					$posts_per_page = get_theme_mod( 'genius_portfolio_limit', 9 );
				else :
					$posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', 18 );
				endif;
				
				$args = array(
					'post_type'      => 'jetpack-portfolio',
					'posts_per_page' => $posts_per_page,
					'paged'          => $paged,
				);
				$project_query = new WP_Query ( $args );

				// Pagination fix (Part 1/2)
				if ( ! is_page_template('template-parts/template-front-page.php') ) {
					$temp_query = $wp_query;
					$wp_query   = NULL;
					$wp_query   = $project_query;
				}

				if ( post_type_exists( 'jetpack-portfolio' ) && $project_query -> have_posts() ) :
			?>

				<?php while ( $project_query -> have_posts() ) : $project_query -> the_post(); ?>

					<?php 
						// Get the terms for the filter and store it in an array.
						$argss = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'slugs');
						$terms[] = wp_get_post_terms( $post->ID, 'jetpack-portfolio-type', $argss );

						// Get the names for the filter and store it in an array.
						$argss = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
						$names[] = wp_get_post_terms( $post->ID, 'jetpack-portfolio-type', $argss );
					?>

				<?php endwhile; ?>

				<?php 
					$filter_terms = genius_flatten_array_and_remove_duplicates( $terms );
					$filter_names = genius_flatten_array_and_remove_duplicates( $names );
				?>

				<div class="portfolio-filter">
					<ul>
						<li id="filter--all" class="filter active" data-filter="*"><?php _e( 'View All', 'genius' ); ?></li>
						<?php 
							foreach ( $filter_terms as $index => $term ) {
								echo '<li class="filter" data-filter=".'. esc_attr( $term ) .'">' . esc_html( $filter_names[$index] ) .'</li>';
							}
						?>
					</ul>
				</div>

				<?php rewind_posts(); ?>

				<div class="portfolio-wrapper">
					<div class="gutter-sizer"></div>

				<?php while ( $project_query -> have_posts() ) : $project_query -> the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>

				<?php endwhile; ?>

				</div><!-- .portfolio-wrapper -->

				<?php
					wp_reset_postdata();
				?>

				<?php // Pagination fix (Part 2/2)
					if ( ! is_page_template('template-parts/template-front-page.php') && ( get_next_posts_link() || get_previous_posts_link() ) ) { ?>
						
						<div class="portfolio-pagination">

							<?php if ( get_next_posts_link() ) { ?>
								<div class="nav-previous">
									<?php next_posts_link( __( 'Older Posts', 'genius' ), $project_query->max_num_pages ); ?>
								</div>
							<?php } ?>

							<?php if ( get_previous_posts_link() ) { ?>
								<div class="nav-next">
									<?php previous_posts_link( __( 'Newer Posts', 'genius' ) ); ?>
								</div>
							<?php } ?>

							<?php // Reset main query object
							$wp_query = NULL;
							$wp_query = $temp_query; ?>

						</div><!-- .portfolio-pagination -->

					<?php 
					}
				?>

			<?php else : ?>

				<section class="no-results not-found portfolio">
					<div class="page-content">
						<div class="notice-box">
							<?php if ( current_user_can( 'publish_posts' ) ) : ?>

								<p><?php printf( __( 'This theme requires the Jetpack by WordPress.com plugin to display portfolio items. <a href="%1$s">Download it here.</a>.', 'genius' ), esc_url( 'https://jetpack.com' ) ); ?></p>

								<p><?php printf( __( 'Already downloaded, installed, and activated Jetpack? <a href="%1$s">Start publishing here</a>.', 'genius' ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>

							<?php else : ?>

								<p><?php _e( 'This is the portfolio area. If you read this, it probably means this website is still under construction – as there are no portfolio items to display, yet. Maybe you should come back later? :)', 'genius' ); ?></p>

							<?php endif; ?>
						</div><!-- .notice-box -->
					</div><!-- .page-content -->
				</section><!-- .no-results -->

			<?php endif; ?>
