<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Main Index
 *
 */
?>

<?php get_header(); ?>

<?php 	// Check if slider is activated for blog index
	if ( icefit_get_option('blog_slider') == "On" ):
		// Prepare arguments for WP_query: query slides
		$args = array( 'post_type' => 'icf_slides' );
		// Check slides category selection
		$slides_cat = icefit_get_option('blog_slides_cat');
		// If a category is selected, filter the slides 
		if ($slides_cat != 'All Slides') $args['icf-slides-category'] = $slides_cat;		
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

	<div class="container<?php if ( icefit_get_option('blog_slider') != "On" ) echo " no-slider"; ?>" id="main-content">

		<?php $blog_sidebar_side = strtolower( icefit_get_option('blog_sidebar_side') );
		if ($blog_sidebar_side == 'right' || $blog_sidebar_side == '') {
			$blog_sidebar_side = 'right';
			$page_container_side = 'left';
		} else {
			$page_container_side = 'right';
		}
		?>

		<?php /* SEARCH CONDITIONAL TITLE */ ?>
		<?php if ( is_search() ) :	?>
		<h1 class="page-title"><?php _e('Search Results for ', 'icefit'); ?>"<?php the_search_query() ?>"</h1>
		<?php endif; ?>
		
		<?php /* TAG CONDITIONAL TITLE */ ?>
		<?php if ( is_tag() ) :	?>			
		<h1 class="page-title"><?php _e('Tag: ', 'icefit'); single_tag_title(); ?></h1>
		<?php endif; ?>
					
		<?php /* CATEGORY CONDITIONAL TITLE */ ?>
		<?php if ( is_category() ) : ?>			
		<h1 class="page-title"><?php _e('Category: ', 'icefit'); single_cat_title(); ?></h1>
		<?php endif; ?>	

		<?php /* DEFAULT CONDITIONAL TITLE */ ?>
		<?php if (!is_front_page() && !is_search() && !is_tag() && !is_category()) { ?>
		<h1 class="page-title"><?php echo get_the_title(get_option('page_for_posts')); ?></h1>
		<?php }	/* is_front_page endif */ ?>

		<div id="page-container" class="<?php echo $page_container_side; ?> with-sidebar">

		<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>

				<div class="postmetadata">
					<?php if ( 'post' == get_post_type() ):  // Do not display this for pages ?>
					<span class="meta-date"><span class="icon"></span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
						<?php the_date(); ?>
					</a></span>
					<span class="meta-author"><span class="icon"></span><?php _e('by ', 'icefit'); the_author(); ?></span>
					<span class="meta-category"><span class="icon"></span><?php _e('in', 'icefit'); ?> <?php the_category(', '); ?></span>
					<?php // if (comments_open() || get_comments_number()!=0 ): ?>
					<span class="meta-comments"><span class="icon"></span>
						<?php comments_popup_link( __( 'No Comment', 'icefit' ), __( '1 Comment', 'icefit' ), __( '% Comments', 'icefit' ), '', __('Comments Off', 'icefit'), 'icefit' ); ?>
					</span>
					<?php endif; ?>

					<?php edit_post_link(__('Edit', 'icefit'), '<span class="editlink"><span class="icon"></span>', '</span>'); ?>
				</div>

				<div class="post-contents">
					<?php // As recommended from the WP codex, to avoid potential failure of has_post_thumbnail()
					if ( '' != get_the_post_thumbnail() ) : ?>
					<div class="thumbnail">
						<?php
						echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">'; ?>
						<?php the_post_thumbnail('post-thumbnail', array('class' => 'scale-with-grid')); ?></a>
					</div>
					<?php endif; ?>
					<div class="post-content">
					<?php $blog_index_content = icefit_get_option('blog_index_content');
					if ($blog_index_content == "Default Excerpt" || $blog_index_content == "Icefit Improved Excerpt") {
						the_excerpt();
						} else {
						the_content();
						} ?>
					</div>
					<?php the_tags('<span class="tags"><span>', '</span><span>', '</span></span>'); ?>

				</div>

			</div><!-- end div post -->

			<hr />

		<?php endwhile; ?>
		<?php else : ?>

			<h2><?php _e('Not Found', 'icefit'); ?></h2>
			<p><?php _e('What you are looking for isn\'t here...', 'icefit'); ?></p>

		<?php endif; ?>

			<div class="page_nav">
				<?php if ( null != get_next_posts_link() ): ?>
				<div class="previous"><?php next_posts_link( __('Previous Posts', 'icefit') ); ?></div>
				<?php endif; ?>
				<?php if ( null != get_previous_posts_link() ): ?>
				<div class="next"><?php previous_posts_link( __('Next Posts', 'icefit') ); ?></div>
				<?php endif; ?>
			</div>

		</div>
		<!-- End page container -->

		<div id="sidebar-container" class="<?php echo $blog_sidebar_side; ?>">
			<?php get_sidebar(); ?>
		</div>		
		<!-- End sidebar -->

	</div>
	<!-- End main content -->

<?php get_footer(); ?>