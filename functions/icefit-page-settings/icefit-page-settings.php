<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Page Settings Metabox
 *
 */

/* ------ Add Page Settings Metabox to Page editor ----- */

function icefit_pagesettings_metabox_settings() {

	/* Prepare sidebar selector options */
	$icefit_unlimited_sidebars = icefit_get_option('unlimited_sidebar');
	$icefit_sidebars_list = explode("\n", $icefit_unlimited_sidebars);
	$sidebar_options[] = array('name' => 'Default Sidebar', 'value' => 'sidebar');
	foreach ($icefit_sidebars_list as $additional_sidebar) {
		if ($additional_sidebar != "") {
			$sidebar_options[] = array(
				'name' => $additional_sidebar,
				'value' => sanitize_title($additional_sidebar)
				);
		}
	}

	/* Prepare slider category selector options */
    $cats = get_terms('icf-slides-category');
  	$slides_cat[] = array('name' => 'All Slides', 'value' => 'all');
  	foreach($cats as $cat):
  		$slides_cat[] = array(
					'name' => $cat->name,
					'value' => $cat->slug,
					);
	endforeach;

	$prefix = 'icefit_pagesettings_';
	
	$meta_box_settings = array(
		'id' => 'sidebars-meta-box',
		'title' => 'Icefit Page Settings',
		'page' => 'page',
		'context' => 'side',
		'priority' => 'default',
		'fields' => array(
			array(
				'name' => 'Sidebar Side',
				'desc' => '',
				'id' => $prefix . 'sidebar_side',
				'type' => 'select',
				'options' => array(
								array('name' => 'None', 'value' => 'none'),
								array('name' => 'Right', 'value' => 'right'),
								array('name' => 'Left', 'value' => 'left'),
							),
				),
			array(
				'name' => 'Select Sidebar',
				'desc' => '',
				'id' => $prefix . 'sidebar',
				'type' => 'select',
				'options' => $sidebar_options,
				),
			array(
				'name' => 'Slider',
				'desc' => '',
				'id' => $prefix . 'slider',
				'type' => 'select',
				'options' => array(
								array('name' => 'Off', 'value' => 'off'),
								array('name' => 'On', 'value' => 'on'),
							),
				),
			array(
				'name' => 'Slides Category',
				'desc' => '',
				'id' => $prefix . 'slides_cat',
				'type' => 'select',
				'options' => $slides_cat,
				),
			array(
				'name' => 'Show Page Title',
				'desc' => '',
				'id' => $prefix . 'showtitle',
				'type' => 'select',
				'options' => array(
								array('name' => 'Yes', 'value' => 'yes'),
								array('name' => 'No', 'value' => 'no'),
							),
				),
		),
	);
	return $meta_box_settings;
}

// Add meta box
add_action('admin_menu', 'icefit_pagesettings_add_box');
function icefit_pagesettings_add_box() {
	$meta_box_settings = icefit_pagesettings_metabox_settings();
	add_meta_box(
		$meta_box_settings['id'],
		$meta_box_settings['title'],
		'icefit_pagesettings_show_box',
		$meta_box_settings['page'],
		$meta_box_settings['context'],
		$meta_box_settings['priority']
	);
}

// Callback function to show fields in meta box
function icefit_pagesettings_show_box() {
	$meta_box_settings = icefit_pagesettings_metabox_settings();
	global $post;
	// Use nonce for verification
	echo '<input type="hidden" name="sidebars_meta_box_nonce" value="', wp_create_nonce('sidebars_meta_box_nonce'), '" />';
	echo '<table class="form-table">';
	foreach ($meta_box_settings['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="', $option['value'],'"', $meta == $option['value'] ? ' selected="selected"' : '', '>', $option['name'], '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'</td></tr>';
	}
	
	echo '</table>';
}

// Save data from meta box
add_action('save_post', 'icefit_pagesettings_save_data');
function icefit_pagesettings_save_data($post_id) {
	
	$meta_box_settings = icefit_pagesettings_metabox_settings();
	
	// verify nonce
	if(!isset($_POST['sidebars_meta_box_nonce'])) return;
	if (!wp_verify_nonce($_POST['sidebars_meta_box_nonce'], 'sidebars_meta_box_nonce')) {
		return $post_id;
	}
	
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	foreach ($meta_box_settings['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
?>