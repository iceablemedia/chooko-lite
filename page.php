<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Page Template
 *
 */
?>

<?php get_header();

	if(have_posts()) :
	while(have_posts()) : the_post();
	
	// Is slider activated ?
	$slider = get_post_meta(get_the_ID(), 'icefit_pagesettings_slider', true);
	if ($slider == 'on'): // Begin slider code
		// Prepare arguments for WP_query: query slides
		$args = array( 'post_type' => 'icf_slides' );
		// Check slides category selection
		$slides_cat = get_post_meta(get_the_ID(), 'icefit_pagesettings_slides_cat', true);
		// If a category is selected, filter the slides 
		if ($slides_cat != 'all') $args['icf-slides-category'] = $slides_cat;		
		// Begin slider loop
		$loop = new WP_Query( $args );
		if($loop->have_posts()):
?>

	<div id="slider-wrap" class="flexslider-container container">
		<div class="flexslider">
			<ul class="slides">
		
			<?php while( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php if ( has_post_thumbnail() ): ?>
		
				<li>
				<?php
					$slide = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					$caption = get_post_meta($post->ID, 'icf_slides_caption', true);
					$link = get_post_meta($post->ID, 'icf_slides_link', true);
					if ($link) {
						?><a href="<?php echo $link; ?>">
						<img class="scale-with-grid" src="<?php echo $slide; ?>" alt="" /></a><?php				
					} else {
						?><img class="scale-with-grid" src="<?php echo $slide; ?>" alt="" /><?php
					}
				?>
				<?php if($caption): ?>
				<div class="flex-caption"><?php echo $caption; ?></div>
				<?php endif; ?>
				</li>

			<?php endif; ?>
			<?php endwhile; ?>

			</ul>
		</div>
	</div>
	<!-- End Slider -->
	
<?php
	endif; // End slider loop
	wp_reset_postdata(); 
	endif; // End slider code
?>

	<div class="container<?php if ($slider != "on") echo " no-slider"; ?>" id="main-content">

				<?php
					$showtitle = get_post_meta(get_the_ID(), 'icefit_pagesettings_showtitle', true);
					if ($showtitle != 'no'):
				?>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php endif; ?>


	<?php
	$sidebar_side = get_post_meta(get_the_ID(), 'icefit_pagesettings_sidebar_side', true);
	$page_container_class = "";
	if ($sidebar_side == 'left' || $sidebar_side == 'right') {	
		$content_side = ($sidebar_side == 'left') ? "right" : "left";
		$page_container_class = $content_side . " with-sidebar";
	}
	?>


		<div id="page-container" <?php post_class($page_container_class); ?>>

				<?php the_content(); ?>
				<br class="clear" />
				<?php edit_post_link(__('Edit', 'icefit'), '<span class="editlink">', '</span><br class="clear" />'); ?>
				<br class="clear" />
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
				<h2><?php _e('Not Found', 'icefit'); ?></h2>
				<p><?php _e('What you are looking for isn\'t here...', 'icefit'); ?></p>

			<?php endif; ?>
		</div>
		<!-- End page container -->

	<?php if ($sidebar_side == 'left' || $sidebar_side == 'right') { ?>
		<div id="sidebar-container" class="<?php echo $sidebar_side; ?>">
			<ul id="sidebar">
			   <?php dynamic_sidebar( get_post_meta(get_the_ID(), 'icefit_pagesettings_sidebar', true) ); ?>
			</ul>
		</div>		
		<!-- End sidebar -->
	<?php } ?>
	</div>
	<!-- End main content -->
<?php get_footer(); ?>