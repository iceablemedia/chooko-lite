<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Comments template
 *
 */


if ( post_password_required() ):
	?><p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'chooko-lite'); ?></p><?php
		return;
endif;

if ( have_comments() ):
	?><h3 id="comments"><?php
		printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'chooko-lite' ),
					number_format_i18n( get_comments_number() ),  get_the_title() ); ?></h3><?php

	?><ol class="commentlist"><?php
		wp_list_comments( array('avatar_size' => 64 ) );
	?></ol><?php

	if (chooko_page_has_comments_nav() ):
	?><div class="comments_nav"><?php
		if ( chooko_page_has_previous_comments_link() ):
		?><div class="previous"><?php previous_comments_link( __('Older comments', 'chooko-lite') ) ?></div><?php
		endif;
		if ( chooko_page_has_next_comments_link() ):
		?><div class="next"><?php next_comments_link( __('Newer comments', 'chooko-lite') ) ?></div><?php
		endif;
	?></div><?php
	endif;

else : // this is displayed if there are no comments so far

	if ( comments_open() ) : // If comments are open, but there are no comments.
	else : // comments are closed
		?><p class="nocomments"><?php _e('Comments are closed.', 'chooko-lite'); ?></p><?php
	endif;

endif;

if ( comments_open() ) comment_form();