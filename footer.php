<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Genius
 */

$custom_copyright = get_theme_mod( 'genius_custom_copyright' );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_sidebar( 'footer' ); ?>

		<div class="site-info">
				<?php if ( $custom_copyright ) { ?>
					<div class="copyright custom"><?php echo esc_html( $custom_copyright ); ?></div>
				<?php } else { ?>
					<div class="copyright"><span class="symbol">&copy; </span><?php echo date("Y"); ?> <a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a><span class="sep"> – </span><span class="description"><?php bloginfo( 'description' ); ?>.</span></div>
				<?php } ?>
				<span class="generator"><?php echo __( 'Powered by ', 'genius' ); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'genius' ) ); ?>" rel="generator">WordPress</a></span>
				<span class="sep"> | </span>
				<span class="designer"><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'genius' ), '<a href="https://michaelvandenberg.com/themes/#genius" rel="theme">Genius</a>', 'Michael Van Den Berg' ); ?></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php if ( has_nav_menu( 'social' ) ) { ?>
		<div id="social-right" class="social-navigation" role="navigation">
				<?php get_template_part( 'template-parts/navigation-social' ); ?>
		</div><!-- .social-right -->
	<?php } ?>

	<a href="#content" class="back-to-top">Top</a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
