<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013-2015 Mathieu Sarrasin - Iceable Media
 *
 * Admin settings template
 *
 */

// Load the icefit options framework
include_once('icefit-options.php');

// Set setting panel name and slug
$chooko_settings_name = __('Chooko Lite Settings', 'chooko');
$chooko_settings_slug = "chooko_settings";

// Set settings template
function chooko_settings_template() {

	$settings_options = array();

// START PAGE 0
	$settings_options[] = array(
		'name'          => __('Go Pro', 'chooko'),
		'type'          => 'start_menu',
		'id'            => 'gopro_page',
		'icon'          => 'down',
	);

		$settings_options[] = array(
			'name'          => __('Upgrade to Chooko Pro!', 'chooko'),
			'desc'          => '',
			'id'            => 'gopro',
			'type'          => 'gopro',
			'default'       => '',
		);

	$settings_options[] = array('type' => 'end_menu');
// END PAGE 0

// START PAGE 1
	$settings_options[] = array(
		'name'          => __('Main settings', 'chooko'),
		'type'          => 'start_menu',
		'id'            => 'main',
		'icon'          => 'control',
	);

		$settings_options[] = array(
			'name'          => __('Logo', 'chooko'),
			'desc'          => __('Upload your own logo', 'chooko'),
			'id'            => 'logo',
			'type'          => 'image',
			'default'       => '',
		);

		$settings_options[] = array(
			'name'          => __('Site Title', 'chooko'),
			'desc'          => __('Choose "display title" if you want to use a text-based title instead of an uploaded logo.', 'chooko'),
			'id'            => 'header_title',
			'type'          => 'radio',
			'default'       => 'Use Logo',
			'values'		=> array (
								array( 'value' => 'Use Logo', 'display' => __('Use Logo', 'chooko') ),
								array( 'value' => 'Display Title', 'display' => __('Display Title', 'chooko') ),
								),
		);

		$settings_options[] = array(
			'name'          => __('Favicon', 'chooko'),
			'desc'          => __('Set your favicon. 16x16 or 32x32 pixels, either 8-bit or 24-bit colors. PNG (W3C standard), GIF, or ICO.', 'chooko'),
			'id'            => 'favicon',
			'type'          => 'image',
			'default'       => '',
		);


		$settings_options[] = array(
			'name'          => __('Display Tagline', 'chooko'),
			'desc'          => __('Display your site description (tagline) on the right side of the header.', 'chooko'),
			'id'            => 'header_tagline',
			'type'          => 'radio',
			'default'       => 'Off',
			'values'		=> array (
								array( 'value' => 'Off', 'display' => __('Off', 'chooko') ),
								array( 'value' => 'On', 'display' => __('On', 'chooko') ),
								),
		);

		$settings_options[] = array(
			'name'          => __('Blog Index Shows', 'chooko'),
			'desc'          => __('Choose what content to display on Main Blog page and archives', 'chooko'),
			'id'            => 'blog_index_shows',
			'type'          => 'radio',
			'default'       => 'Excerpt',
			'values'		=> array (
								array( 'value' => 'Excerpt', 'display' => __('Excerpt', 'chooko') ),
								array( 'value' => 'Full content', 'display' => __('Full content', 'chooko') ),
								),

		);

		$settings_options[] = array(
			'name'          => __('Responsive mode', 'chooko'),
			'desc'          => __('Turn this setting off if you want your site to be unresponsive.', 'chooko'),
			'id'            => 'responsive_mode',
			'type'          => 'radio',
			'default'       => 'on',
			'values'		=> array (
								array( 'value' => 'on', 'display' => __('On', 'chooko') ),
								array( 'value' => 'off', 'display' => __('Off', 'chooko') ),
								),
		);



	$settings_options[] = array('type' => 'end_menu');
// END PAGE 1

// START PAGE 2
	$settings_options[] = array(
		'name'          => __('Custom Header', 'chooko'),
		'type'          => 'start_menu',
		'id'            => 'custom_header',
		'icon'          => 'picture',
	);

		$settings_options[] = array(
			'name'          => __('Display custom header on Homepage', 'chooko'),
			'desc'          => __('Enable or disable display of custom header image on the front page.', 'chooko'),
			'id'            => 'home_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array (
								array( 'value' => 'On', 'display' => __('On', 'chooko') ),
								array( 'value' => 'Off', 'display' => __('Off', 'chooko') ),
								),
		);

		$settings_options[] = array(
			'name'          => __('Display custom header on Blog Index', 'chooko'),
			'desc'          => __('Enable or disable display of custom header image on blog index pages.', 'chooko'),
			'id'            => 'blog_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array (
								array( 'value' => 'On', 'display' => __('On', 'chooko') ),
								array( 'value' => 'Off', 'display' => __('Off', 'chooko') ),
								),
		);

		$settings_options[] = array(
			'name'          => __('Display custom header on Blog Posts', 'chooko'),
			'desc'          => __('Enable or disable display of custom header image on single blog posts', 'chooko'),
			'id'            => 'single_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array (
								array( 'value' => 'On', 'display' => __('On', 'chooko') ),
								array( 'value' => 'Off', 'display' => __('Off', 'chooko') ),
								),
		);

		$settings_options[] = array(
			'name'          => __('Display custom header on Pages', 'chooko'),
			'desc'          => __('Enable or disable display of custom header image on individual pages.', 'chooko'),
			'id'            => 'pages_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array (
								array( 'value' => 'On', 'display' => __('On', 'chooko') ),
								array( 'value' => 'Off', 'display' => __('Off', 'chooko') ),
								),
		);


	$settings_options[] = array('type' => 'end_menu');
// END PAGE 2

// START PAGE 3
	$settings_options[] = array(
		'name'          => __('Support and Feedback', 'chooko'),
		'type'          => 'start_menu',
		'id'            => 'support_feedback',
		'icon'          => 'network',
	);

		$settings_options[] = array(
			'name'          => __('Support and Feedback', 'chooko'),
			'desc'          => '',
			'id'            => 'support_feedback',
			'type'          => 'support_feedback',
			'default'       => '',
		);

	$settings_options[] = array('type' => 'end_menu');
// END PAGE 3

	return $settings_options;
}
?>