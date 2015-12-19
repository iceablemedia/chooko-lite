<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013-2015 Mathieu Sarrasin - Iceable Media
 *
 * Main Index
 *
 */

get_header();
global $header_image;

?><div id="main-content" class="container<?php if ( !$header_image ) echo " no-header-image"; ?>"><?php

	/* SEARCH CONDITIONAL TITLE */
	if ( is_search() ):
	?><h1 class="page-title"><?php _e('Search Results for ', 'chooko'); ?>"<?php the_search_query() ?>"</h1><?php
	endif;
		
	/* TAG CONDITIONAL TITLE */
	if ( is_tag() ):
	?><h1 class="page-title"><?php _e('Tag: ', 'chooko'); single_tag_title(); ?></h1><?php
	endif;
					
	/* CATEGORY CONDITIONAL TITLE */
	if ( is_category() ):
	?><h1 class="page-title"><?php _e('Category: ', 'chooko'); single_cat_title(); ?></h1><?php
	endif;

	/* ARCHIVES CONDITIONAL TITLE */
	if ( is_day() ):
	?><h1 class="page-title"><?php _e('Daily archives: ', 'chooko'); echo get_the_time('F jS, Y'); ?></h1><?php
	endif;
	if ( is_month() ):
	?><h1 class="page-title"><?php _e('Monthly archives: ', 'chooko'); echo get_the_time('F, Y'); ?></h1><?php
	endif;
	if ( is_year() ):
	?><h1 class="page-title"><?php _e('Yearly archives: ', 'chooko'); echo get_the_time('Y'); ?></h1><?php
	endif;

	/* DEFAULT CONDITIONAL TITLE */
	if (!is_front_page() && !is_search() && !is_tag() && !is_category() && !is_year() && !is_month() && !is_day() ):
	?><h1 class="page-title"><?php echo get_the_title(get_option('page_for_posts')); ?></h1><?php
	endif;

	?><div id="page-container" class="left with-sidebar"><?php

	if(have_posts()):
	while(have_posts()) : the_post();

		?><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

				?><h3 class="entry-title"><?php
					?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a><?php
				?></h3><?php

				?><div class="postmetadata"><?php
				if ( 'post' == get_post_type() ):  // Do not display this for pages
					?><span class="meta-date published"><span class="icon"></span><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php
						the_time(get_option('date_format'));
					?></a></span><?php
					// Echo updated date for hatom-feed - not to be displayed on front end
					?><span class="updated"><?php the_modified_date(get_option('date_format')); ?></span><?php

					?><span class="meta-author vcard author"><span class="icon"></span><?php
						_e('by ', 'chooko');
						?><span class="fn"><?php the_author(); ?></span><?php
					?></span><?php

					?><span class="meta-category"><span class="icon"></span><?php _e('in', 'chooko'); ?> <?php the_category(', '); ?></span><?php
					if (comments_open() || get_comments_number()!=0 ):
					?><span class="meta-comments"><span class="icon"></span><?php
						comments_popup_link( __( 'No Comment', 'chooko' ), __( '1 Comment', 'chooko' ), __( '% Comments', 'chooko' ), '', __('Comments Off', 'chooko'), 'chooko' );
					?></span><?php
					endif;
				endif;

					edit_post_link(__('Edit', 'chooko'), '<span class="editlink"><span class="icon"></span>', '</span>');
				?></div><?php

				?><div class="post-contents"><?php
					if ( '' != get_the_post_thumbnail() ) : // As recommended from the WP codex, to avoid potential failure of has_post_thumbnail()
					?><div class="thumbnail"><?php
					?><a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
						the_post_thumbnail('post-thumbnail', array('class' => 'scale-with-grid')); ?></a><?php
					?></div><?php
					endif;
					?><div class="post-content"><?php
				if ( get_post_format() || post_password_required() || "Full content" == chooko_get_option('blog_index_shows') )
						the_content();
					else the_excerpt();
					?></div><?php

				if (has_tag())
					the_tags('<span class="tags"><span>', '</span><span>', '</span></span>');

				?></div><?php
			?></div><?php // end div post

			?><hr /><?php

	endwhile;
	else:

			if ( is_search() ): // Empty search results

				?><h2><?php _e('Not Found', 'chooko'); ?></h2><?php
				?><p><?php echo sprintf( __('Your search for "%s" did not return any result.', 'chooko'), get_search_query() ); ?><br /><?php
				_e('Would you like to try another search ?', 'chooko'); ?></p><?php
				get_search_form();

			else: // Empty loop (this should never happen!)

				?><h2><?php _e('Not Found', 'chooko'); ?></h2><?php
				?><p><?php _e('What you are looking for isn\'t here...', 'chooko'); ?></p><?php

			endif;

	endif;

		?><div class="page_nav"><?php
			if ( null != get_next_posts_link() ):
			?><div class="previous"><?php next_posts_link( __('Previous Posts', 'chooko') ); ?></div><?php
			endif;

			if ( null != get_previous_posts_link() ):
			?><div class="next"><?php previous_posts_link( __('Next Posts', 'chooko') ); ?></div><?php
			endif;
		?></div><?php

	?></div><?php // End page container

	?><div id="sidebar-container" class="right"><?php
		get_sidebar();
	?></div><?php

?></div><?php // End main content

get_footer(); ?>