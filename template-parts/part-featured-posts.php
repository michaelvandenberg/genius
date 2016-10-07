<?php
/* The part for displaying the featured or latest posts.
 * 
 * @package Genius
 */

$featured = genius_get_featured_posts();
$autoplay = get_theme_mod( 'genius_slider_autoplay', '8000' );

if ( genius_has_featured_posts( 1 ) ) : ?>

	<div id="featured" class="featured-area slider js-flickity" data-flickity-options='{ "wrapAround": true, "autoPlay": <?php echo esc_attr( $autoplay ); ?> }'>
		<?php
		foreach ( $featured as $post ) :
			setup_postdata( $post );

			if ( has_post_thumbnail() ) : ?>

				<div class="slider-cell" <?php genius_featured_image(); ?>>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="featured-inner overlay">
						<?php the_title( '<div class="featured-header"><h2 class="featured-title">', '</h2></div>' ); ?>
					</a>
				</div>

		<?php
			endif;
		endforeach;
		wp_reset_postdata();
		?>
	</div>

<?php else : ?>

	<section class="no-results not-found featured-posts">
		<div class="page-content">
			<div class="notice-box">
				<?php if ( current_user_can( 'publish_posts' ) ) : ?>

					<p><?php printf( wp_kses( __( 'It seems that there are no featured items to display. <a href="%1$s">Edit a post. And give it a "featured" tag.</a>.', 'genius' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php' ) ) ); ?></p>

				<?php else : ?>

					<p><?php _e( 'This is the featured posts area. If you read this, it probably means this website is still under construction – as there are no featured posts to display, yet. Maybe you should come back later? :)', 'genius' ); ?></p>

				<?php endif; ?>
			</div><!-- .notice-box -->
		</div><!-- .page-content -->
	</section><!-- .no-results -->

<?php endif; ?>