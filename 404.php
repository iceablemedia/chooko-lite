<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013-2014 Mathieu Sarrasin - Iceable Media
 *
 * 404 Page Template
 *
 */
?>

<?php get_header(); ?>

	<div class="container" id="main-content">

		<h1 class="page-title"><?php _e('404', 'chooko'); ?></h1>

		<div id="page-container" class="left with-sidebar">

			<h2><?php _e('Page Not Found', 'chooko'); ?></h2>
			<p><?php _e('What you are looking for isn\'t here...', 'chooko'); ?></p>
			<p><?php _e('Maybe a search will help ?', 'chooko'); ?></p>
			<?php get_search_form(); ?>

		</div>
		<!-- End page container -->

		<div id="sidebar-container" class="right">
			<ul id="sidebar">
			   <?php dynamic_sidebar( 'sidebar' ); ?>
			</ul>
		</div>		
		<!-- End sidebar -->
	</div>
	<!-- End main content -->
<?php get_footer(); ?>