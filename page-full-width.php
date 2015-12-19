<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Template Name: Full-width Page Template, No Sidebar
 *
 */
?>

<?php get_header();
global $header_image;

	if(have_posts()) :
	while(have_posts()) : the_post();

?>

	<div id="main-content" class="container<?php if ( !$header_image ) echo " no-header-image"; ?>">

		<h1 class="page-title"><?php the_title(); ?></h1>

		<div id="page-container" <?php post_class(); ?>>

				<?php the_content(); ?>
				<br class="clear" />
				<?php edit_post_link(__('Edit', 'chooko'), '<div class="postmetadata"><span class="editlink"><span class="icon"></span>', '</span></div><br class="clear" />'); ?>
			<?php	// Display comments section only if comments are open or if there are comments already.
				if ( comments_open() || get_comments_number()!=0 ) : ?>
				<!-- comments section -->
				<div class="comments">
				<?php comments_template( '', true ); ?>
				<?php next_comments_link(); previous_comments_link(); ?>
				</div>
				<!-- end comments section -->
			<?php endif; ?>

			<?php endwhile; ?>
				<?php else : ?>
				<h2><?php _e('Not Found', 'chooko'); ?></h2>
				<p><?php _e('What you are looking for isn\'t here...', 'chooko'); ?></p>

			<?php endif; ?>
		</div>
		<!-- End page container -->

	</div>
	<!-- End main content -->
<?php get_footer(); ?>