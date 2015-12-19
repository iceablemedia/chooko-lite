<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Theme's Function
 *
 */
 
/*--------------- Framework Elements -------------*/

// Admin Settings Panel
include_once('functions/icefit-options/settings.php');
// Page Settings Metabox
include_once('functions/icefit-page-settings/icefit-page-settings.php');
// Slides custom post type
include_once('functions/icefit-slides/icefit-slides.php');


/*------------- Redirect to Options Panel upon activation ------------*/

function icefit_theme_activation() {
	wp_redirect(admin_url("themes.php?page=icefit-settings"));
}

add_action('after_switch_theme', 'icefit_theme_activation');

/*--------------------- Specific Theme Settings --------------------*/

if ( ! isset( $content_width ) ) $content_width = 680;
set_post_thumbnail_size( 260, 260, true );

/*--- Define and load text domain (used for localization) ---*/

load_theme_textdomain('icefit', get_template_directory() . '/languages');

add_action('after_setup_theme', 'icefit_setup');
function icefit_setup(){
    load_theme_textdomain('icefit', get_template_directory() . '/languages');
}

/*-------------------- Enqueue styles --------------------*/

function icefit_styles() {
	wp_register_style( 'icefit', get_template_directory_uri() . '/css/icefit.css');
	wp_enqueue_style( 'icefit' );
	wp_register_style( 'theme-style', get_template_directory_uri() . '/css/theme-style.css');
	wp_enqueue_style( 'theme-style' );
	wp_register_style( 'media-queries', get_template_directory_uri() . '/css/media-queries.css');
	wp_enqueue_style( 'media-queries' );
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	wp_enqueue_style( 'prettyPhoto' );
	wp_register_style( 'dynamic-styles', site_url() . '/index.php?dynamiccss=1');
	wp_enqueue_style( 'dynamic-styles' );
}
add_action('wp_print_styles', 'icefit_styles');

// Register editor CSS
add_editor_style();

/*-------------------- Enqueue javascripts --------------------*/

function icefit_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('icefit-scripts', get_template_directory_uri() . '/js/icefit.js', array('jquery'));
	wp_enqueue_script('hoverIntent',    get_template_directory_uri() . '/js/hoverIntent.js', array('jquery'));	// Submenus
	wp_enqueue_script('superfish',      get_template_directory_uri() . '/js/superfish.js', array('jquery'));	// Submenus
    wp_enqueue_script('flexslider',     get_template_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery')); // Flexslider
    wp_enqueue_script('prettyPhoto',    get_template_directory_uri() .'/js/jquery.prettyPhoto.js', array('jquery')); // prettyPhoto
}
add_action('wp_enqueue_scripts', 'icefit_scripts');

/*-------------------- Required WP Theme Support  --------------------*/
add_theme_support( 'automatic-feed-links' );

/*-------------------- Add Post Thumbnails Support -------------------*/
if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );

/*-------------------- WP unwanted behaviors fix --------------------*/

/* Remove rel tags in category links (HTML5 invalid) */
add_filter( 'the_category', 'remove_rel_cat' ); 
function remove_rel_cat( $text ) {
	$text = str_replace(' rel="category"', "", $text);
	$text = str_replace(' rel="category tag"', "", $text);
	return $text;
}

/* Fix for a known issue with enclosing shortcodes and wpauto */
/* Credits : Johann Heyne */
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {
	$array = array (
		'<p>['    => '[', 
		']</p>'   => ']', 
		']<br />' => ']',
	);
	$content = strtr($content, $array);
	return $content;
}

/* Improved version of clean_pre */
/* Based on a work by Emrah Gunduz */
add_filter( 'the_content', 'protect_pre' );

function protect_pre($pee) {
	$pee = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'eg_clean_pre', $pee );
	return $pee;
}

function eg_clean_pre($matches) {
	if ( is_array($matches) )
		$text = $matches[1] . $matches[2] . "</pre>";
	else
		$text = $matches;
	$text = str_replace('<br />', '', $text);
	return $text;
}

/*------------------- Finds whether post page needs comments pagination links ------------------*/

function page_has_comments_nav() {
	global $wp_query;
	return ($wp_query->max_num_comment_pages > 1);
}

function page_has_next_comments_link() {
	global $wp_query;
	$max_cpage = $wp_query->max_num_comment_pages;
	$cpage = get_query_var( 'cpage' );	
	return ( $max_cpage > $cpage );
}

function page_has_previous_comments_link() {
	$cpage = get_query_var( 'cpage' );	
	return ($cpage > 1);
}


/*------------ Improved excerpt ------------*/

function icefit_improved_trim_excerpt($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $text); // Remove shortcodes
    	$text = apply_filters('the_content', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = preg_replace('@<style[^>]*?>.*?</style>@si', '', $text);
		$text = preg_replace('@<p class="wp-caption-text"[^>]*?>.*?</p>@si', '', $text);
    	$text = str_replace('\]\]\>', ']]&gt;', $text);
    	$excerpt_length = 50;
    	$words = explode(' ', $text, $excerpt_length + 1);
    	if (count($words)> $excerpt_length) {
			array_pop($words);
			$text = implode(' ', $words)."...";
		}
    	$text = strip_tags($text, '<br><p><i><em><b><a><strong>');

    	if ( extension_loaded('tidy') ) {
	    	$tidy = new tidy();
	    	$tidy->parseString($text,array('show-body-only'=>true,'wrap'=>'0'),'utf8');
	    	$tidy->cleanRepair();
	    	$text = $tidy;
    	}
    	
		$text .= '<div class="read-more"><a href="'.get_permalink($post->ID).'">'.__('Read More', 'icefit').'</a></div>';
	}
	return $text;
}

if ( icefit_get_option('blog_index_content') == "Icefit Improved Excerpt" ) {
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'icefit_improved_trim_excerpt');
}

/*--------------------- Rewrite Gallery Shortcode ---------------------*/

function icefit_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(90/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}".
/*			#{$selector} img {
				border: 2px solid #cfcfcf;
			}*/"
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		// Force linking to image file 
		$link = wp_get_attachment_link($id, $size, false, false);

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'icefit_gallery_shortcode');


/*-------------------- Add prettyPhoto tag to the gallery --------------------*/

add_filter( 'wp_get_attachment_link', 'sant_prettyadd');
function sant_prettyadd ($content) {
	$content = preg_replace("/<a/","<a rel=\"prettyPhoto[gal]\"",$content,1);
	return $content;
}

/* -------------- Register Menus --------------------- */
register_nav_menu( 'primary', 'Navigation menu' );
register_nav_menu( 'footer-menu', 'Footer menu' );

/* --------------- Add parent Class to parent menu items ----------------- */

add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
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


/* -------------- Create dropdown menu (used in responsive mode) ----------- */

function dropdown_nav_menu () {
	$menu_name = 'primary';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		if ($menu = wp_get_nav_menu_object( $locations[ $menu_name ] ) ) {
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '<select id="dropdown-menu">';
		$menu_list .= '<option value="">Menu</option>';
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			if($url != "#" ) $menu_list .= '<option value="' . $url . '">' . $title . '</option>';
		}
		$menu_list .= '</select>';
   		// $menu_list now ready to output
   		echo $menu_list;    
		}
    } 
}

/*-------------------------------------------
------- Sidebar and Widgetized areas --------
-------------------------------------------*/

register_sidebar( array(
	'name'          => __( 'Default Sidebar', 'icefit' ),
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
	'name'          => __( 'Footer', 'icefit' ),
	'id'            => 'footer-sidebar',
	'description'   => '',
    'class'         => '',
	'before_widget' => '<li id="%1$s" class="one-fourth widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	)
);

/*--------------- Dynamic Footer Code -------------*/

function icefit_dynamic_footer() {
	echo icefit_get_option('tracking_code');
}
add_action('wp_footer', 'icefit_dynamic_footer');
	
/*--------------- Dynamic CSS -------------*/

// Add 'dynamiccss' to the list of valid query vars
function icefit_dynamiccss_query_vars($vars) {
	$new_vars = array('dynamiccss');
	$vars = $new_vars + $vars;
    return $vars;
}
add_filter('query_vars', 'icefit_dynamiccss_query_vars');

// Check request args and proceed to output dynamic CSS
function icefit_dynamiccss_parse_request($wp) {
    // only process requests with "dynamiccss=1"
    if (array_key_exists('dynamiccss', $wp->query_vars) 
            && $wp->query_vars['dynamiccss'] == '1') {
        icefit_dynamiccss_output($wp);
    }
}
add_action('parse_request', 'icefit_dynamiccss_parse_request');

// Generate dynamic CSS
function icefit_dynamiccss_output() {
	$background_color = icefit_get_option('background_color');
	$background_image = icefit_get_option('background_image');
	$custom_css = "body {
			background-image: url('".$background_image."');
			background-color: ".$background_color.";
		}";

	header('Content-type: text/css');
	echo $custom_css;
	die();
}

?>