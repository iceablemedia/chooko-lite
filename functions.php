<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2016 Mathieu Sarrasin - Iceable Media
 *
 * Theme's Function
 *
 */

/*
 * Setup and registration functions
 */
function chooko_setup(){

	/* Set default $content_width */
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 680;

	/* Translation support
	 * Translations can be added to the /languages directory.
	 * A .pot template file is included to get you started
	 */
	load_theme_textdomain('chooko-lite', get_template_directory() . '/languages');

	/* Feed links support */
	add_theme_support( 'automatic-feed-links' );

	/* Register Primary menu */
	register_nav_menu( 'primary', 'Navigation menu' );
	register_nav_menu( 'footer-menu', 'Footer menu' );

	/* Title tag support */
	add_theme_support( 'title-tag' );

	/* Post Thumbnails Support */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 260, 260, true );

	/* Custom header support */
	add_theme_support( 'custom-header',
						array(	'header-text' => false,
								'width' => 962,
								'height' => 400,
								'flex-height' => true,
								)
					);

	/* Custom background support */
	add_theme_support( 'custom-background',
						array(	'default-color' => 'f5f2f0',
								'default-image' => get_template_directory_uri() . '/img/ricepaper2.png',
								)
					);

}
add_action('after_setup_theme', 'chooko_setup');

/* Adjust $content_width it depending on the page being displayed */
function chooko_content_width() {
	global $content_width;
	if ( is_page_template( 'page-full-width.php' ) )
		$content_width = 920;
}
add_action( 'template_redirect', 'chooko_content_width' );

/*
 * Page title (for WordPress < 4.1 )
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	function chooko_render_title() {
		?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
	}
	add_action( 'wp_head', 'chooko_render_title' );
endif;

/*
 * Add a home link to wp_page_menu() ( wp_nav_menu() fallback )
 */
function chooko_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'chooko_page_menu_args' );

/*
 * Add parent Class to parent menu items
 */
function chooko_add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'chooko_add_menu_parent_class' );


/*
 * Register Sidebar and Footer widgetized areas
 */
function chooko_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'chooko-lite' ),
		'id'            => 'sidebar',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);

	register_sidebar( array(
		'name'          => __( 'Footer', 'chooko-lite' ),
		'id'            => 'footer-sidebar',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'chooko_widgets_init' );


/*
 * Enqueue CSS styles
 */
function chooko_styles() {

	$template_directory_uri = get_template_directory_uri(); // Parent theme URI
	$stylesheet_directory = get_stylesheet_directory(); // Current theme directory
	$stylesheet_directory_uri = get_stylesheet_directory_uri(); // Current theme URI

	$responsive_mode = get_theme_mod('chooko_responsive_mode');

	if ($responsive_mode != 'off'):
		$stylesheet = '/css/chooko.min.css';
	else:
		$stylesheet = '/css/chooko-unresponsive.min.css';
	endif;


	/* Child theme support:
	 * Enqueue child-theme's versions of stylesheet in /css if they exist,
	 * or the parent theme's version otherwise
	 */
	if ( @file_exists( $stylesheet_directory . $stylesheet ) )
		wp_register_style( 'chooko', $stylesheet_directory_uri . $stylesheet );
	else
		wp_register_style( 'chooko', $template_directory_uri . $stylesheet );

	// Always enqueue style.css from the current theme
	wp_register_style( 'chooko-style', $stylesheet_directory_uri . '/style.css');

	wp_enqueue_style( 'chooko' );
	wp_enqueue_style( 'chooko-style' );

	// Google Webfonts
	wp_enqueue_style( 'PTSans-webfonts', "//fonts.googleapis.com/css?family=PT+Sans:400italic,700italic,400,700&subset=latin,latin-ext", array(), null );
}
add_action('wp_enqueue_scripts', 'chooko_styles');

/*
 * Register editor style
 */
function chooko_editor_styles() {
	add_editor_style('css/editor-style.css');
}
add_action( 'init', 'chooko_editor_styles' );

/*
 * Enqueue Javascripts
 */
function chooko_scripts() {
	wp_enqueue_script('icefit-scripts', get_template_directory_uri() . '/js/chooko.min.js', array('jquery','hoverIntent'));

    /* Threaded comments support */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'chooko_scripts');

/*
 * Remove hentry class from static pages
 */
function chooko_remove_hentry( $classes ) {
	if ( is_page() ):
		$classes = array_diff($classes, array('hentry'));
	endif;
	return $classes;
}
add_filter('post_class','chooko_remove_hentry');

/*
 * Remove "rel" tags in category links (HTML5 invalid)
 */
function chooko_remove_rel_cat( $text ) {
	$text = str_replace(' rel="category"', "", $text);
	$text = str_replace(' rel="category tag"', "", $text);
	return $text;
}
add_filter( 'the_category', 'chooko_remove_rel_cat' );

/*
 * Customize "read more" links on index view
 */
function chooko_excerpt_more( $more ) {
	global $post;
	return '... <div class="read-more"><a href="'. get_permalink( get_the_ID() ) . '">'. __("Read More", 'chooko-lite') .'</a></div>';
}
add_filter( 'excerpt_more', 'chooko_excerpt_more' );

function chooko_content_more( $more ) {
	global $post;
	return '<div class="read-more"><a href="'. get_permalink() . '#more-' . $post->ID . '">'. __("Read More", 'chooko-lite') .'</a></div>';
}
add_filter( 'the_content_more_link', 'chooko_content_more' );

/*
 * Rewrite and replace wp_trim_excerpt() so it adds a relevant read more link
 * when the <!--more--> or <!--nextpage--> quicktags are used
 * This new function preserves every features and filters from the original wp_trim_excerpt
 */
function chooko_trim_excerpt($text = '') {
	global $post;
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

		/* If the post_content contains a <!--more--> OR a <!--nextpage--> quicktag
		 * AND the more link has not been added already
		 * then we add it now
		 */
		if ( ( preg_match('/<!--more(.*?)?-->/', $post->post_content ) || preg_match('/<!--nextpage-->/', $post->post_content ) ) && strpos($text,$excerpt_more) === false ) {
		 $text .= $excerpt_more;
		}

	}
	return apply_filters('chooko_trim_excerpt', $text, $raw_excerpt);
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'chooko_trim_excerpt' );

/*
 * Create dropdown menu (used in responsive mode)
 * Requires a custom menu to be set (won't work with fallback menu)
 */
function chooko_dropdown_nav_menu () {
	$menu_name = 'primary';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		if ($menu = wp_get_nav_menu_object( $locations[ $menu_name ] ) ) {
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '<select id="dropdown-menu">';
		$menu_list .= '<option value="">Menu</option>';
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			if ( $menu_item->menu_item_parent && $menu_item->menu_item_parent > 0 ):
				$menu_list .= '<option value="' . $url . '"> &raquo; ' . $title . '</option>';
			else:
				$menu_list .= '<option value="' . $url . '">' . $title . '</option>';
			endif;
		}
		$menu_list .= '</select>';
   		// $menu_list now ready to output
   		echo $menu_list;
		}
    }
}

/*
 * Find whether post page needs comments pagination links (used in comments.php)
 */
function chooko_page_has_comments_nav() {
	global $wp_query;
	return ($wp_query->max_num_comment_pages > 1);
}

function chooko_page_has_next_comments_link() {
	global $wp_query;
	$max_cpage = $wp_query->max_num_comment_pages;
	$cpage = get_query_var( 'cpage' );
	return ( $max_cpage > $cpage );
}

function chooko_page_has_previous_comments_link() {
	$cpage = get_query_var( 'cpage' );
	return ($cpage > 1);
}

/*
 * Find whether attachement page needs navigation links (used in single.php)
 */
function chooko_adjacent_image_link($prev = true) {
    global $post;
    $post = get_post($post);
    $attachments = array_values(get_children("post_parent=$post->post_parent&post_type=attachment&post_mime_type=image&orderby=\"menu_order ASC, ID ASC\""));

    foreach ( $attachments as $k => $attachment )
        if ( $attachment->ID == $post->ID )
            break;

    $k = $prev ? $k - 1 : $k + 1;

    if ( isset($attachments[$k]) )
        return true;
	else
		return false;
}

/*
 * Customizer
 */

require_once 'inc/customizer/customizer.php';
