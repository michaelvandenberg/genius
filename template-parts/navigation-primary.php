<?php
/**
 * The navigation menu.
 *
 * Displays both the mobile and desktop navigation menu.
 *
 * @package Genius
 */

wp_nav_menu( 
	array( 
		'theme_location'	=> 'primary',
		'menu_id' 			=> 'primary-menu',
		'container_class'	=> 'primary-menu-wrapper',
		'depth'				=> 3,
		'fallback_cb' 		=> false,
	) 
);
