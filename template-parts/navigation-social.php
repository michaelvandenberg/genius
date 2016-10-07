<?php
/**
 * The social links template.
 *
 * Displays the social menu items.
 *
 * @package Genius
 */

wp_nav_menu( 
	array( 
		'theme_location'	=> 'social',
		'menu_id' 			=> 'social-menu',
		'container_class' 	=> 'social-menu-wrapper',
		'link_before'	 	=> '<span class="screen-reader-text">',
		'link_after'		=> '</span>',
		'depth'				=> 1,
		'fallback_cb' 		=> false,
	) 
);
