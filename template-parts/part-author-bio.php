<?php
/**
 * The template for displaying Author bios
 *
 * @since Genius 1.0
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'genius_author_bio_avatar_size', 100 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h2 class="author-title">
			<span class="screen-reader-text author-published-by"><?php esc_html_e( 'Published by ', 'genius' ); ?></span>
			<span class="the-author"><?php echo esc_html( get_the_author() ); ?></span>
		</h2>

		<span class="author-bio">
			<?php  echo wp_kses( wpautop( get_the_author_meta( 'description' ) ), array(
				'a'		=> array( 'class' => true, 'href' => true ),
				'p'		=> array(),
				'span'	=> array( 'class' => true ), ) ); ?>
		</span><!-- .author-bio -->

		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php printf( esc_html__( 'View all posts by %s', 'genius' ), esc_html( get_the_author() ) ); ?>
		</a><!-- .author-link -->

	</div><!-- .author-description -->
</div><!-- .author-info -->
