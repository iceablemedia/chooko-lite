<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Footer Template
 *
 */


 	if (is_active_sidebar( 'footer-sidebar' ) ):
 	?><div id="footer"><div class="container"><ul><?php
		dynamic_sidebar( 'footer-sidebar' );
			?></ul></div></div><?php
	endif;

	?><div id="sub-footer"><div class="container"><?php
		?><div class="sub-footer-left"><p><?php

/* You are free to modify or replace this by anything you like as per the terms of the GPL license */

			printf( __('Copyright &copy; %s %s.', 'chooko-lite'), date('Y'), get_bloginfo('name') );
			echo ' ';
			printf( __('Proudly powered by <a href="%s" title="%s">%s</a>.', 'chooko-lite'),
				esc_url( __('https://wordpress.org/', 'chooko-lite') ),
				esc_attr__( 'Semantic Personal Publishing Platform', 'chooko-lite' ),
				__('WordPress', 'chooko-lite')
			);
			echo ' ';
			printf( __('Chooko design by <a href="%s" title="%s">Iceable Themes</a>.', 'chooko-lite'),
				esc_url( 'https://www.iceablethemes.com' ),
				esc_attr( 'Iceablethemes', 'chooko-lite' )
			);

/* Stop editing here */
			?></p></div><?php

		?><div class="sub-footer-right"><?php
			$footer_menu = array( 'theme_location' => 'footer-menu', 'depth' => 1);
			wp_nav_menu( $footer_menu );
		?></div><?php
	?></div></div><?php // End Footer

?></div><?php // End main wrap

wp_footer();

?></body></html>
