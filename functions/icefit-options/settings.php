<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Admin settings template
 *
 */

// Load the icefit options framework
include_once('icefit-options.php');

// Set setting panel name and slug
$icefit_settings_name = "Chooko Lite Settings";
$icefit_settings_slug = "chooko_settings";

// Set settings template
function icefit_settings_template() {

	/* Prepare slider category selector options */
    $cats = get_terms('icf-slides-category');
  	$slides_cat[] = 'All Slides';
  	if ($cats):
	  	foreach($cats as $cat):
	  		$slides_cat[] =  $cat->slug;
		endforeach;
	endif;

	$settings_options = array();

// START PAGE 0
	$settings_options[] = array(
		'name'          => 'Go Pro',
		'type'          => 'start_menu',
		'id'            => 'gopro_page',
		'icon'          => 'down',
	);

		$settings_options[] = array(
			'name'          => 'Upgrade to Chooko Pro!',
			'desc'          => '',
			'id'            => 'gopro',
			'type'          => 'gopro',
			'default'       => '',
		);

	$settings_options[] = array('type' => 'end_menu');
// END PAGE 0

// START PAGE 1
	$settings_options[] = array(
		'name'          => 'Main settings',
		'type'          => 'start_menu',
		'id'            => 'main',
		'icon'          => 'control',
	);

		$settings_options[] = array(
			'name'          => 'Logo',
			'desc'          => 'Upload your own logo',
			'id'            => 'logo',
			'type'          => 'image',
			'default'       => get_template_directory_uri() .'/img/logo.png',
		);

		$settings_options[] = array(
			'name'          => 'Favicon',
			'desc'          => 'Set your favicon. 16x16 or 32x32 pixels, either 8-bit or 24-bit colors. PNG (W3C standard), GIF, or ICO.',
			'id'            => 'favicon',
			'type'          => 'image',
			'default'       => '',
		);
		
		$settings_options[] = array(
			'name'          => 'Blog Sidebar Side',
			'desc'          => 'Select the side of the sidebar for the index and single posts of your blog.',
			'id'            => 'blog_sidebar_side',
			'type'          => 'select',
			'default'       => 'Right',
			'values'		=> array ('Right', 'Left'),
		);

		$settings_options[] = array(
			'name'          => 'Blog Index Content',
			'desc'          => 'Select what content should be displayed on blog index pages.',
			'id'            => 'blog_index_content',
			'type'          => 'select',
			'default'       => 'Full Content',
			'values'		=> array ('Full Content', 'Default Excerpt', 'Icefit Improved Excerpt'),
		);

		$settings_options[] = array(
			'name'          => 'Activate slider on blog page',
			'desc'          => 'Enable slideshow on blog index page.',
			'id'            => 'blog_slider',
			'type'          => 'select',
			'default'       => 'Off',
			'values'		=> array ('Off', 'On'),
		);

		$settings_options[] = array(
			'name'          => 'Slides category for blog page',
			'desc'          => 'Select which slides to use for the blog index slideshow.',
			'id'            => 'blog_slides_cat',
			'type'          => 'select',
			'default'       => 'All Slides',
			'values'		=> $slides_cat,
		);

		$settings_options[] = array(
			'name'          => 'Tracking Code',
			'desc'          => 'Paste your own custom code to be added in the footer (i.e. Google Analytics tracking code).',
			'id'            => 'tracking_code',
			'default'       => '',
			'type'          => 'textarea',
		);

		$settings_options[] = array(
			'name'          => 'Custom CSS',
			'desc'          => 'Paste your custom CSS here',
			'id'            => 'custom_css',
			'default'       => '',
			'type'          => 'textarea',
		);

		$settings_options[] = array(
			'name'          => 'Footer note (Copyright)',
			'desc'          => 'Customize the copyright note at the bottom of your site - or leave it as is and give credits to the author :)<br />You can use the following dynamic tokens: %date%, %sitename%',
			'id'            => 'footer_note',
			'default'       => 'Copyright &copy; %date% %sitename% | Powered by WordPress | Design by &lt;a href=&quot;http://www.iceablethemes.com&quot;&gt;Iceable Themes&lt;/a&gt;',
			'type'          => 'text',
		);

		$settings_options[] = array(
			'name'          => 'Copyright start year',
			'desc'          => 'Enter the year this website was created to compute the copyright %date% token.',
			'id'            => 'copyright_start_year',
			'default'       => '2013',
			'type'          => 'text',
		);

	$settings_options[] = array('type' => 'end_menu');
// END PAGE 1
// START PAGE 2
	$settings_options[] = array(
		'name'          => 'Create Sidebars',
		'type'          => 'start_menu',
		'id'            => 'page2',
		'icon'          => 'list',
	);

		$settings_options[] = array(
			'name'          => 'Additional Sidebars',
			'desc'          => 'Enter titles for your additional sidebars (one per line)',
			'id'            => 'unlimited_sidebar',
			'type'          => 'textarea',
			'default'       => '',
		);

	$settings_options[] = array('type' => 'end_menu', 'id' => 'endpage2');
// END PAGE 2
// START PAGE 3
	$settings_options[] = array(
		'name'          => 'Styling',
		'type'          => 'start_menu',
		'id'            => 'styles',
		'icon'          => 'picture',
	);

		$settings_options[] = array(
			'name'          => 'Navbar Font',
			'desc'          => 'Choose a font for the navbar',
			'id'            => 'navbar_font',
			'type'          => 'font',
			'default'       => 'PT Sans',
		);

		$settings_options[] = array(
			'name'          => 'Headings Font',
			'desc'          => 'Choose a font for headings',
			'id'            => 'headings_font',
			'type'          => 'font',
			'default'       => 'PT Sans',
		);

		$settings_options[] = array(
			'name'          => 'Primary Color',
			'desc'          => 'Set the main color (used for headings and some layout elements)',
			'id'            => 'primary_color',
			'type'          => 'color',
			'default'       => '#6b5344',
		);

		$settings_options[] = array(
			'name'          => 'Secondary Color',
			'desc'          => 'Set the secondary color (used for navbar and some complementary elements)',
			'id'            => 'secondary_color',
			'type'          => 'color',
			'default'       => '#eb9f9f',
		);

		$settings_options[] = array(
			'name'          => 'Background Color',
			'desc'          => 'Set a background color (used as fallback only if an image is set below)',
			'id'            => 'background_color',
			'type'          => 'color',
			'default'       => '#f5f2f0',
		);

		$settings_options[] = array(
			'name'          => 'Background Image',
			'desc'          => 'Upload your own background (for boxed layout)',
			'id'            => 'background_image',
			'type'          => 'image',
			'default'       => get_template_directory_uri() .'/img/ricepaper2.png'
		);
		
	$settings_options[] = array('type' => 'end_menu', 'id' => 'endpage3');
// END PAGE 3
// START PAGE 4
	$settings_options[] = array(
		'name'          => 'Social Media',
		'type'          => 'start_menu',
		'id'            => 'socialmedia',
		'icon'          => 'target',
	);

		$settings_options[] = array(
			'name'          => 'Facebook URL',
			'desc'          => '',
			'id'            => 'facebook_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Twitter URL',
			'desc'          => '',
			'id'            => 'twitter_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Google Plus URL',
			'desc'          => '',
			'id'            => 'googleplus_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Linkedin URL',
			'desc'          => '',
			'id'            => 'linkedin_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Instagram URL',
			'desc'          => '',
			'id'            => 'instagram_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Pinterest URL',
			'desc'          => '',
			'id'            => 'pinterest_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Tumblr URL',
			'desc'          => '',
			'id'            => 'tumblr_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'StumbleUpon URL',
			'desc'          => '',
			'id'            => 'stumbleupon_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Dribbble URL',
			'desc'          => '',
			'id'            => 'dribbble_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Behance URL',
			'desc'          => '',
			'id'            => 'behance_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Deviantart URL',
			'desc'          => '',
			'id'            => 'deviantart_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Flickr URL',
			'desc'          => '',
			'id'            => 'flickr_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Youtube URL',
			'desc'          => '',
			'id'            => 'youtube_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Vimeo URL',
			'desc'          => '',
			'id'            => 'vimeo_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'Yelp URL',
			'desc'          => '',
			'id'            => 'yelp_url',
			'type'          => 'text',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => 'RSS Feed URL',
			'desc'          => '',
			'id'            => 'rss_url',
			'type'          => 'text',
			'default'       => get_bloginfo('rss2_url'),
		);

	$settings_options[] = array('type' => 'end_menu', 'id' => 'endpage4');
// END PAGE 4

	return $settings_options;
}
?>