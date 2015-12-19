<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * 404 Page Template
 *
 */
?>

<?php get_header(); ?>

	<!-- BEGIN MAIN CONTENT -->
	<div class="container" id="main-content">


	<!-- BEGIN CONTENT COLUMN -->
	<div class="sixteen columns">
		<div <?php post_class(); ?>>
			<h1 class="page-title"><?php _e('404', 'icefit'); ?></h1>

			<h2><?php _e('Not Found', 'icefit'); ?></h2>
			<p><?php _e('What you are looking for isn\'t here...', 'icefit'); ?></p>

		</div>
	</div>
	<!-- END CONTENT COLUMN -->
	</div>
	<!-- END MAIN CONTENT -->

<?php get_footer(); ?>