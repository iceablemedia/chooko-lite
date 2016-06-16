<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Single Post Template
 *
 */

get_header();
global $header_image;

?><div id="main-content" class="container<?php if ( !$header_image ) echo " no-header-image"; ?>"><?php

	?><div id="page-container" class="left with-sidebar"><?php

		if(have_posts()):
		while(have_posts()) : the_post();

		?><div id="post-<?php the_ID(); ?>" <?php post_class("single-post"); ?>><?php

			?><h1 class="entry-title"><?php the_title(); ?></h1><?php

			?><div class="postmetadata"><?php
				?><span class="meta-date published"><span class="icon"></span><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php
					the_time(get_option('date_format'));
				?></a></span><?php

				// Echo updated date for hatom-feed - not to be displayed on front end
				?><span class="updated"><?php the_modified_date(get_option('date_format')); ?></span><?php

				?><span class="meta-author vcard author"><span class="icon"></span><?php _e('by ', 'chooko-lite'); ?><span class="fn"><?php the_author(); ?></span></span><?php

				if ( has_category() ):
				?><span class="meta-category"><span class="icon"></span><?php _e('in', 'chooko-lite'); ?> <?php the_category(', '); ?></span><?php
				endif;

				if (comments_open() || get_comments_number()!=0 ):
				?><span class="meta-comments"><span class="icon"></span><?php
					comments_popup_link( __( 'No', 'chooko-lite' ), __( '1', 'chooko-lite' ), __( '%', 'chooko-lite' ), 'comments-count', '' );
					comments_popup_link( __( 'Comment', 'chooko-lite' ), __( 'Comment', 'chooko-lite' ), __( 'Comments', 'chooko-lite' ), '', __('Comments Off', 'chooko-lite') );
					?></span><?php
				endif;

				edit_post_link(__('Edit', 'chooko-lite'), '<span class="editlink"><span class="icon"></span>', '</span>');

				?></div><?php

				?><div class="post-contents"><?php

					if ( '' != get_the_post_thumbnail() ) : // As recommended from the WP codex, to avoid potential failure of has_post_thumbnail()
					?><div class="thumbnail"><?php
					?><a href="<?php get_permalink() ?>"><?php
					the_post_thumbnail('large', array('class' => 'scale-with-grid'));
					?></a></div><?php
					endif;

					the_content()

					?><div class="clear"></div><?php
					$args = array(
						'before'           => '<br class="clear" /><div class="paged_nav"><span class="paged_nav_label">' . __('Pages', 'chooko-lite') . '</span>',
						'after'            => '</div>',
						'link_before'      => '<span>',
						'link_after'       => '</span>',
						'next_or_number'   => 'number',
						'nextpagelink'     => __('Next page', 'chooko-lite'),
						'previouspagelink' => __('Previous page', 'chooko-lite'),
						'pagelink'         => '%',
						'echo'             => 1
					);
					wp_link_pages( $args );

					the_tags('<span class="tags"><span>', '</span><span>', '</span></span>');

					?></div><?php
				?><br class="clear" /><?php

			?></div><?php // end div post

			?><div class="page_nav"><?php
				if ( is_attachment() ):
				// Use image navigation links on attachment pages, post navigation otherwise
					if ( chooko_adjacent_image_link(false) ): // Is there a previous image ?
					?><div class="previous"><?php previous_image_link(0, __("Previous Image", 'chooko-lite') ); ?></div><?php

					endif;
					if ( chooko_adjacent_image_link(true) ): // Is there a next image ?
					?><div class="next"><?php next_image_link(0, __("Next Image",'chooko-lite') ); ?></div><?php
					endif;

				else:

					if ("" != get_adjacent_post( false, "", true ) ): // Is there a previous post?
					?><div class="previous"><?php previous_post_link('%link', __("Previous Post", 'chooko-lite') ); ?></div><?php
					endif;
					if ("" != get_adjacent_post( false, "", false ) ): // Is there a next post?
					?><div class="next"><?php next_post_link('%link', __("Next Post", 'chooko-lite') ); ?></div><?php
					endif;

				endif;

				?><br class="clear" /><?php
			?></div><?php

			// Display comments section only if comments are open or if there are comments already.
			if ( comments_open() || get_comments_number()!=0 ):
				?><hr /><?php // comments section
				?><div class="comments"><?php
					comments_template( '', true );
				?></div><?php // end comments section

			?><div class="page_nav"><?php
				if ("" != get_adjacent_post( false, "", true ) ): // Is there a previous post?
				?><div class="previous"><?php previous_post_link('%link', __("Previous Post", 'chooko-lite') ); ?></div><?php
				endif;
				if ("" != get_adjacent_post( false, "", false ) ): // Is there a next post?
				?><div class="next"><?php next_post_link('%link', __("Next Post", 'chooko-lite') ); ?></div><?php
				endif;
				?><br class="clear" /><?php
			?></div><?php

			endif;

			endwhile;

			else:

			?><h2><?php _e('Not Found', 'chooko-lite'); ?></h2><?php
			?><p><?php _e('What you are looking for isn\'t here...', 'chooko-lite'); ?></p><?php

			endif;

		?></div><?php // End page container

		?><div id="sidebar-container" class="right"><?php
			get_sidebar();
		?></div><?php // End sidebar column

	?></div><?php // End main content

get_footer();
