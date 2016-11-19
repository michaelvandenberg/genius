<?php
/**
 * Genius functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Genius
 */

if ( ! function_exists( 'genius_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function genius_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Genius, use a find and replace
	 * to change 'genius' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'genius', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 9999, false );
	add_image_size( 'genius-portfolio-img', 400, 400, true );
	add_image_size( 'genius-featured-img', 1140, 750, true );
	add_image_size( 'genius-navigation', 720, 160, true );
	add_image_size( 'genius-full-width-thumbnail', 1140, 9999, false );

	/*
	 * Add theme support for custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo/
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 150,
		'flex-width' => true,
	) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Primary', 'genius' ),
		'social'	=> esc_html__( 'Social Links', 'genius' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'genius_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css', genius_fonts_url() ) );
}
endif;
add_action( 'after_setup_theme', 'genius_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function genius_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'genius_content_width', 720 );
}
add_action( 'after_setup_theme', 'genius_content_width', 0 );

/**
 * Adjust content_width value for full width page template.
 */
function genius_full_width_page_content_width() {
	if ( is_page_template( 'template-parts/template-full-width.php' ) || is_page_template( 'template-parts/template-front-page.php' ) || is_page_template( 'template-parts/template-portfolio.php' ) ) {	
		$GLOBALS['content_width'] = apply_filters( 'genius_full_width_page_content_width', 1140 );
	}
}
add_action( 'template_redirect', 'genius_full_width_page_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function genius_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'genius' ),
		'id'            => 'sidebar-1',
		'description'   => 'The widget area in the sidebar.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'genius' ),
		'id'            => 'sidebar-2',
		'description'   => 'The widget area in the footer.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
}
add_action( 'widgets_init', 'genius_widgets_init' );

if ( ! function_exists( 'genius_fonts_url' ) ) :
/**
 * Register Google fonts for Genius.
 *
 * @since Genius 0.9.1
 *
 * @return string Google fonts URL for the theme.
 */
function genius_fonts_url() {
	$fonts_url = '';
	$fonts     = '';
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'genius' ) ) {
		$fonts = 'Open Sans:300,400,600,700,800,300italic,400italic,700italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( $fonts ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function genius_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'genius-fonts', genius_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Load the theme main stylesheet.
	wp_enqueue_style( 'genius-style', get_stylesheet_uri() );

	// Load the theme custom script file.
	wp_enqueue_script( 'genius-script', get_template_directory_uri() . '/js/genius.js', array( 'jquery' ), '20160128', true );

	// Load the skip-link-focus script file.
	wp_enqueue_script( 'genius-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// Load the javascript file for comments if applicable.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Only load the Isotope script file on portfolio pages.
	if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) || is_page_template( 'template-parts/template-portfolio.php' ) || is_page_template( 'template-parts/template-front-page.php' ) ) {
		wp_enqueue_script( 'isotope-script', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), '3.0.0' );
	}

	// Only load the Flickity script file on the front page template and if there is more than one featured post.
	if ( is_page_template( 'template-parts/template-front-page.php' ) && genius_has_featured_posts( 2 ) )  {
		wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array( 'jquery' ), '1.2.1', false );
	}
}
add_action( 'wp_enqueue_scripts', 'genius_scripts' );

function genius_add_search_toggle ( $items, $args ) {
	if ( $args->theme_location == 'primary') {
		$items .= '<li id="search-toggle" class="menu-item"><a href="#"><span class="screen-reader-text">' . __( 'Search Toggle', 'genius' ) . '</span></a></li>';
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'genius_add_search_toggle', 10, 2 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';
