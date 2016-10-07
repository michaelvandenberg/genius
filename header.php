<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Genius
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'genius' ); ?></a>

	<div id="hidden-header" class="hidden" style="display:none;">
		<div class="container">
			<nav id="mobile-navigation" class="main-navigation" role="navigation">
				<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>

				<?php if ( has_nav_menu( 'social' ) ) { get_template_part( 'template-parts/navigation-social' ); } ?>
			</nav><!-- #primary-navigation -->
			
			<div id="primary-search" class="search-container">
				<?php get_search_form(); ?>
			</div><!-- #primary-search -->
		</div><!-- .container -->
	</div><!-- #hidden-header -->

	<header id="masthead" class="site-header" role="banner" <?php genius_header_image(); ?>>
		<div class="site-branding">
			<?php genius_the_custom_logo(); ?>
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="desktop-navigation" class="main-navigation" role="navigation">
				<?php get_template_part( 'template-parts/navigation-primary' ); ?>
			</nav><!-- #primary-navigation -->

			<div class="menu-toggle-container">
				<button class="menu-toggle" aria-controls="menu" aria-expanded="false">
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'genius' ); ?></span>
					<span class="toggle-lines" aria-hidden="true"></span>
				</button>
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
