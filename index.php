<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013-2014 Mathieu Sarrasin - Iceable Media
 *
 * Main Index
 *
 */
?>

<?php get_header();
global $header_image; ?>

	<div id="main-content" class="container<?php if ( !$header_image ) echo " no-header-image"; ?>">

		<?php /* SEARCH CONDITIONAL TITLE */ ?>
		<?php if ( is_search() ) :	?>
		<h1 class="page-title"><?php _e('Search Results for ', 'chooko'); ?>"<?php the_search_query() ?>"</h1>
		<?php endif; ?>
		
		<?php /* TAG CONDITIONAL TITLE */ ?>
		<?php if ( is_tag() ) :	?>			
		<h1 class="page-title"><?php _e('Tag: ', 'chooko'); single_tag_title(); ?></h1>
		<?php endif; ?>
					
		<?php /* CATEGORY CONDITIONAL TITLE */ ?>
		<?php if ( is_category() ) : ?>			
		<h1 class="page-title"><?php _e('Category: ', 'chooko'); single_cat_title(); ?></h1>
		<?php endif; ?>

		<?php /* ARCHIVES CONDITIONAL TITLE */ ?>
		<?php if ( is_day() ) : ?>			
		<h1 class="page-title"><?php _e('Daily archives: ', 'chooko'); echo get_the_time('F jS, Y'); ?></h1>
		<?php endif; ?>	
		<?php if ( is_month() ) : ?>			
		<h1 class="page-title"><?php _e('Monthly archives: ', 'chooko'); echo get_the_time('F, Y'); ?></h1>
		<?php endif; ?>	
		<?php if ( is_year() ) : ?>			
		<h1 class="page-title"><?php _e('Yearly archives: ', 'chooko'); echo get_the_time('Y'); ?></h1>
		<?php endif; ?>	

		<?php /* DEFAULT CONDITIONAL TITLE */ ?>
		<?php if (!is_front_page() && !is_search() && !is_tag() && !is_category()) { ?>
		<h1 class="page-title"><?php echo get_the_title(get_option('page_for_posts')); ?></h1>
		<?php }	/* is_front_page endif */ ?>

		<div id="page-container" class="left with-sidebar">

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
					<span class="meta-author"><span class="icon"></span><?php _e('by ', 'chooko'); the_author(); ?></span>
					<span class="meta-category"><span class="icon"></span><?php _e('in', 'chooko'); ?> <?php the_category(', '); ?></span>
					<?php // if (comments_open() || get_comments_number()!=0 ): ?>
					<span class="meta-comments"><span class="icon"></span>
						<?php comments_popup_link( __( 'No Comment', 'chooko' ), __( '1 Comment', 'chooko' ), __( '% Comments', 'chooko' ), '', __('Comments Off', 'chooko'), 'chooko' ); ?>
					</span>
					<?php endif; ?>

					<?php edit_post_link(__('Edit', 'chooko'), '<span class="editlink"><span class="icon"></span>', '</span>'); ?>
				</div>

				<div class="post-contents">
					<?php if ( '' != get_the_post_thumbnail() ) : // As recommended from the WP codex, to avoid potential failure of has_post_thumbnail() ?>
					<div class="thumbnail">
						<?php
						echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">'; ?>
						<?php the_post_thumbnail('post-thumbnail', array('class' => 'scale-with-grid')); ?></a>
					</div>
					<?php endif; ?>
					<div class="post-content">
					<?php if ( get_post_format() || post_password_required() ) the_content();
						else the_excerpt();
					?>
					</div>
					<?php the_tags('<span class="tags"><span>', '</span><span>', '</span></span>'); ?>

				</div>

			</div><!-- end div post -->

			<hr />

		<?php endwhile; ?>
		<?php else : ?>

			<h2><?php _e('Not Found', 'chooko'); ?></h2>
			<p><?php _e('What you are looking for isn\'t here...', 'chooko'); ?></p>

		<?php endif; ?>

			<div class="page_nav">
				<?php if ( null != get_next_posts_link() ): ?>
				<div class="previous"><?php next_posts_link( __('Previous Posts', 'chooko') ); ?></div>
				<?php endif; ?>
				<?php if ( null != get_previous_posts_link() ): ?>
				<div class="next"><?php previous_posts_link( __('Next Posts', 'chooko') ); ?></div>
				<?php endif; ?>
			</div>

		</div>
		<!-- End page container -->

		<div id="sidebar-container" class="right">
			<?php get_sidebar(); ?>
		</div>		
		<!-- End sidebar -->

	</div>
	<!-- End main content -->

<?php get_footer(); ?>