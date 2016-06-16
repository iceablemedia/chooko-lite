<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * 404 Page Template
 *
 */

get_header();

?><div class="container" id="main-content"><?php

		?><h1 class="page-title"><?php _e('404', 'chooko-lite'); ?></h1><?php

		?><div id="page-container" class="left with-sidebar"><?php

			?><h2><?php _e('Page Not Found', 'chooko-lite'); ?></h2><?php
			?><p><?php _e('What you are looking for isn\'t here...', 'chooko-lite'); ?></p><?php
			?><p><?php _e('Maybe a search will help ?', 'chooko-lite'); ?></p><?php
			get_search_form();

		?></div><?php // End page container

		?><div id="sidebar-container" class="right"><?php
			?><ul id="sidebar"><?php
			dynamic_sidebar( 'sidebar' );
			?></ul><?php
		?></div><?php // End sidebar
	?></div><?php // End main content

get_footer();
