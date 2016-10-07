<?php
/**
 * Genius Theme Customizer.
 *
 * @package Genius
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function genius_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Theme options panel */
	$wp_customize->add_panel( 'genius_theme_options', array(
		'priority'			=> 200,
		'title'				=> esc_html__( 'Theme Options', 'genius' ),
		'description'		=> esc_html__( 'This theme supports a number of options which you can set using this panel.', 'genius' ),
	) );

	/* Theme options front page section */
	$wp_customize->add_section( 'genius_front_page_options', array(
		'title'				=> esc_html__( 'Front Page Options', 'genius' ),
		'priority'			=> 10,
		'panel'				=> 'genius_theme_options',
		'description'		=> esc_html__( 'To customize the appearance of pages using the front page template adjust any of the settings below.', 'genius' ),
	) );

	/* Theme options footer section */
	$wp_customize->add_section( 'genius_footer_options', array(
		'title'				=> esc_html__( 'Footer Options', 'genius' ),
		'priority'			=> 20,
		'panel'				=> 'genius_theme_options',
		'description'		=> esc_html__( 'Replace the default copyright text.', 'genius' ),
	) );

	/* The number of portfolio items to be shown. */
	$wp_customize->add_setting( 'genius_portfolio_limit', array(
		'default'			=> 9,
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'genius_sanatize_integer',
	) );
	$wp_customize->add_control( 'genius_portfolio_limit', array(
		'label'				=> esc_html__( 'Number of portfolio items: ', 'genius' ),
		'section'			=> 'genius_front_page_options',
		'priority'			=> 1,
	) );

	/* Adjust the portfolio link text. */
	$wp_customize->add_setting( 'genius_portfolio_read_more', array(
		'default'			=> 'Discover more',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'genius_sanatize_text',
	) );
	$wp_customize->add_control( 'genius_portfolio_read_more', array(
		'label'				=> esc_html__( 'The text of the portfolio read more link: ', 'genius' ),
		'section'			=> 'genius_front_page_options',
		'priority'			=> 2,
	) );

	/* The number of featured items to be shown. */
	$wp_customize->add_setting( 'genius_featured_limit', array(
		'default'			=> 5,
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'genius_sanatize_integer',
	) );
	$wp_customize->add_control( 'genius_featured_limit', array(
		'label'				=> esc_html__( 'Number of featured items: ', 'genius' ),
		'section'			=> 'genius_front_page_options',
		'priority'			=> 3,
	) );

	/* Adjust the portfolio link text. */
	$wp_customize->add_setting( 'genius_featured_read_more', array(
		'default'			=> esc_html__( 'Read more', 'genius' ),
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'genius_sanatize_text',
	) );
	$wp_customize->add_control( 'genius_featured_read_more', array(
		'label'				=> esc_html__( 'The text of the featured read more link: ', 'genius' ),
		'section'			=> 'genius_front_page_options',
		'priority'			=> 4,
	) );

	/* Custom copyright text. */
	$wp_customize->add_setting( 'genius_custom_copyright', array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'genius_custom_copyright', array(
		'label'				=> esc_html__( 'Your custom copyright text: ', 'genius' ),
		'section'			=> 'genius_footer_options',
		'priority'			=> 1,
	) );
}
add_action( 'customize_register', 'genius_customize_register' );

/**
 * Sanitize integer.
 *
 * @param string $int.
 * @return string.
 */
function genius_sanatize_integer( $int ) {
	if ( empty( $int ) || ! ctype_digit( $int ) ) {
		$int = 9;
	}
	else {
		$int = absint( $int );
	}

	return $int;
}

/**
 * Sanitize text.
 *
 * @param string $input.
 * @return string.
 */
function genius_sanatize_text( $text ) {
	if ( empty( $text ) ) {
		$text = 'Discover more';
	}
	wp_kses( $text );

	return $text;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function genius_customize_preview_js() {
	wp_enqueue_script( 'genius_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'genius_customize_preview_js' );
