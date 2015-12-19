<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Admin settings Framework
 *
 */

// Custom function to get one single option (returns option's value)
function chooko_get_option($option) {
	global $chooko_settings_slug;
	$chooko_settings = get_option($chooko_settings_slug);
	$value = "";
	if (is_array($chooko_settings)) {
		if (array_key_exists($option, $chooko_settings)) $value = $chooko_settings[$option];
	}
	return $value;
}

// Custom function to get all settings (returns an array of all settings)
function chooko_get_settings() {
	global $chooko_settings_slug;
	$chooko_settings = get_option($chooko_settings_slug);
	return $chooko_settings;
}

// Adds "Theme option" link under "Appearance" in WP admin panel
function chooko_settings_add_admin() {
	global $menu;
    $chooko_option_page = add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'icefit-settings', 'chooko_settings_page');
	add_action( 'admin_print_scripts-'.$chooko_option_page, 'chooko_settings_admin_scripts' );
}
add_action('admin_menu', 'chooko_settings_add_admin');

// Registers and enqueue js and css for settings panel
function chooko_settings_admin_scripts() {
	wp_register_style( 'chooko_admin_css', get_template_directory_uri() .'/functions/icefit-options/style.css');
	wp_enqueue_style( 'chooko_admin_css' );
	wp_enqueue_script( 'chooko_admin_js', get_template_directory_uri() . '/functions/icefit-options/functions.js', array( 'wp-color-picker' ), false, true );
}

// Generates the settings panel's menu
function chooko_settings_machine_menu($options) {
	$output = "";
	foreach ($options as $arg) {

		if ( $arg['type'] == "start_menu" )
		{
			$output .= '<li class="icefit-admin-panel-menu-li '.$arg['id'].'"><a class="icefit-admin-panel-menu-link '.$arg['icon'].'" href="#'.$arg['name'].'" id="icefit-admin-panel-menu-'.$arg['id'].'"><span></span>'.$arg['name'].'</a></li>'."\n";
		} 
	}
	return $output;
}

// Generate the settings panel's content
function chooko_settings_machine($options) {
	global $chooko_settings_slug;
	$chooko_settings = get_option($chooko_settings_slug);
	$output = "";
	foreach ($options as $arg) {

		if ( is_array($arg) && is_array($chooko_settings) ) {
			if ( array_key_exists('id', $arg) ) {
				if ( array_key_exists($arg['id'], $chooko_settings) ) $val = stripslashes($chooko_settings[$arg['id']]);
				else $val = "";
			} else { $val = ""; }
		} else { $val = ""; }
		
		if ( $arg['type'] == "start_menu" )
		{
			$output .= '<div class="icefit-admin-panel-content-box" id="icefit-admin-panel-content-'.$arg['id'].'">';
		}				
		elseif ( $arg['type'] == "radio" )
		{
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $chooko_settings[$arg['id']] = $val = $arg['default'];
			$values = $arg['values'];
			$output .= '<div class="radio-group">';
			foreach ($values as $value) {
			$output .= '<input type="radio" name="'.$arg['id'].'" value="'.$value.'" '.checked($value, $val, false).'>'.$value.'<br/>';
			}
			$output .= '</div>';
			$output .= '<label class="desc">'. $arg['desc'] .'</label><br class="clear" />'."\n";
		}		
		elseif ( $arg['type'] == "image" )
		{
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $chooko_settings[$arg['id']] = $val = $arg['default'];
			$output .= '<input class="chooko_input_img" name="'. $arg['id'] .'" id="'. $arg['id'] .'" type="text" value="'. $val .'" />'."\n";
			$output .= '<div class="desc">'. $arg['desc'] .'</div><br class="clear">'."\n";
			$output .= '<input class="chooko_upload_button" name="'. $arg['id'] .'_upload" id="'. $arg['id'] .'_upload" type="button" value="Upload Image">'."\n";
			$output .= '<input class="chooko_remove_button" name="'. $arg['id'] .'_remove" id="'. $arg['id'] .'_remove" type="button" value="Remove"><br />'."\n";
			$output .= '<img class="chooko_image_preview" id="'. $arg['id'] .'_preview" src="'.$val.'"><br class="clear">'."\n";
		}
		elseif ( $arg['type'] == "gopro" )
		{
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			$output .= '<p>Unleash the full potential of Chooko by upgrading to Chooko Pro!</p>';
			$output .= '<p>The Pro version comes with a great set of awesome features:</p>';		
			$output .= '<ul>
							<li>Fully <strong>Responsive Design</strong></li>
							<li>Quick Setup <strong>Page Templates</strong></li>
							<li><strong>Unlimited Slideshows</strong></li>
							<li><strong>Unlimited backgrounds</strong></li>
							<li>(Pro Only) <strong>Unlimited colors</strong></li>
							<li>(Pro Only) <strong>600+ webfonts</strong> for menu and headings</li>
							<li>(Pro Only) Revolutionary <strong>WYSIWYG Layout Builder</strong></li>
							<li>(Pro Only) <strong>Visual Shortcodes</strong>, fully integrated in WordPress\' Visual editor (no coding skills needed!)</li>
							<li>(Pro Only) Powerful <strong>shortcodes</strong> and <strong>custom widgets</strong></li>
							<li>(Pro Only) <strong> Portfolio</strong> section</li>
							<li>(Pro Only) <strong> Partners and/or Clients\' logos</strong> carousel</li>
							<li>(Pro Only) <strong>Clients\' testimonials</strong> carousel</li>
							<li>(Pro Only) <strong>Unlimited sidebars</strong></li>
							<li>(Pro Only) One click setup <strong>AJAX contact form</strong></li>
							<li>(Pro Only) <strong>Google Maps</strong> API v3 integration</li>
							<li>(Pro Only) <strong>Pro dedicated support forum</strong> access</li>
							<li><a href="http://www.gnu.org/licenses/" target="_blank">GPL License</a> : Buy once, use as many times as you wish!</li>
							<li><strong>Cross-browsers support</strong>, optimized for IE8+, Firefox, Chrome, Safari and Opera (note: IE7 and older are no longer supported.)</li>
							<li>Lifetime <strong>free updates</strong> and continued support for the <strong>latest WordPress versions</strong></li>
							</ul>';
			$output .= '<a href="http://www.iceablethemes.com/shop/chooko-pro/" class="button-primary" target="_blank">Learn More and Upgrade Now!</a>';
		}
		elseif ( $arg['type'] == "end_menu" )
		{
			$output .= '</div>';
		} 
	}
	update_option($chooko_settings_slug,$chooko_settings);	
	return $output;
}

// AJAX callback function for the "reset" button (resets settings to default)
function chooko_settings_reset_ajax_callback() {
	global $chooko_settings_slug;
	// Get settings from the database
	$chooko_settings = get_option($chooko_settings_slug);
	// Get the settings template
	$options = chooko_settings_template();
	// Revert all settings to default value
	foreach($options as $arg){
		if ($arg['type'] != 'start_menu' && $arg['type'] != 'end_menu') {
			$chooko_settings[$arg['id']] = $arg['default'];
		}	
	}
	// Updates settings in the database	
	update_option($chooko_settings_slug,$chooko_settings);	
}
add_action('wp_ajax_chooko_settings_reset_ajax_post_action', 'chooko_settings_reset_ajax_callback');

// AJAX callback function for the "Save changes" button (updates user's settings in the database)
function chooko_settings_ajax_callback() {
	global $chooko_settings_slug;
	// Check nonce
	check_ajax_referer('chooko_settings_ajax_post_action','chooko_settings_nonce');
	// Get POST data
	$data = $_POST['data'];
	parse_str($data,$output);
	// Get current settings from the database
	$chooko_settings = get_option($chooko_settings_slug);
	// Get the settings template
	$options = chooko_settings_template();
	// Updates all settings according to POST data
	foreach($options as $option_array){

		if ($option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu') {
			$id = $option_array['id'];
			if ($option_array['type'] == "text") {
				$new_value = esc_textarea($output[$option_array['id']]);
			} else {
				$new_value = $output[$option_array['id']];		
			}
			$chooko_settings[$id] = stripslashes($new_value);
		}
		
	}

	// Updates settings in the database
	update_option($chooko_settings_slug,$chooko_settings);	
}
add_action('wp_ajax_chooko_settings_ajax_post_action', 'chooko_settings_ajax_callback');

// NOJS fallback for the "Save changes" button
function chooko_settings_save_nojs() {
	global $chooko_settings_slug;
	// Get POST data
	//	parse_str($_POST,$output);
	// Get current settings from the database
	$chooko_settings = get_option($chooko_settings_slug);
	// Get the settings template
	$options = chooko_settings_template();
	// Updates all settings according to POST data
	foreach($options as $option_array){
	
		if ( isset($option_array['id']) && $option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu' ) {
			$id = $option_array['id'];
			if ($option_array['type'] == "text") {
				$new_value = esc_textarea($_POST[$option_array['id']]);
			} else {
				$new_value = $_POST[$option_array['id']];
			}
			$chooko_settings[$id] = stripslashes($new_value);
		}
	}

	// Updates settings in the database
	update_option($chooko_settings_slug,$chooko_settings);	
}

// Update settings template in the database upon theme activation
function chooko_settings_theme_activation() {
	global $chooko_settings_slug;
	// Get current settings from the database
	$chooko_settings = get_option($chooko_settings_slug);
	// Get the settings template
	$options = chooko_settings_template();
	// Updates all settings
	foreach($options as $option_array){
		if ($option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu') {
			$id = $option_array['id'];
			if ( !isset( $chooko_settings[$id] ) )
				$chooko_settings[$id] = stripslashes($option_array['default']);
		}

	}
	// Updates settings in the database
	update_option($chooko_settings_slug,$chooko_settings);	
}
add_action('after_switch_theme', 'chooko_settings_theme_activation');

// Outputs the settings panel
function chooko_settings_page(){
	
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	global $chooko_settings_slug;
	global $chooko_settings_name;
	
	if (isset( $_POST['reset-no-js'] ) && $_POST['reset-no-js']) {
		chooko_settings_reset_ajax_callback();
		echo '<div class="updated fade"><p>Settings were reset to default.</p></div>';
	}
	
	if (isset( $_POST['save-no-js'] ) && $_POST['save-no-js']) {
		chooko_settings_save_nojs();
		echo '<div class="updated fade"><p>Settings updated.</p></div>';
	}

	?>

	<noscript><div id="no-js-warning" class="updated fade"><p><b>Warning:</b> Javascript is either disabled in your browser or broken in your WP installation.<br />
	This is ok, but it is highly recommended to activate javascript for a better experience.<br />
	If javascript is not blocked in your browser then this may be caused by a third party plugin.<br />
	Make sure everything is up to date or try to deactivate some plugins.</p></div></noscript>
	
	<div id="icefit-admin-panel" class="no-js">
		<form enctype="multipart/form-data" id="icefitform" method="POST">
			<div id="icefit-admin-panel-header">
				<div id="icon-options-general" class="icon32"><br></div>
				<h3><?php echo $chooko_settings_name; ?></h3>
			</div>
			<div id="icefit-admin-panel-main">
				<div id="icefit-admin-panel-menu">
					<ul>
						<?php echo chooko_settings_machine_menu( chooko_settings_template() ); ?>
					</ul>
				</div>
				<div id="icefit-admin-panel-content">
					<?php echo chooko_settings_machine( chooko_settings_template() ); ?>
				</div>
				<div class="clear"></div>
			</div>
			<div id="icefit-admin-panel-footer">
				<div id="icefit-admin-panel-footer-submit">
					<input type="button" class="button" id="icefit-reset-button" name="reset" value="Reset Options" />
					<input type="submit" value="Save all Changes" class="button-primary" id="submit-button" />
					<!-- No-JS Fallback buttons -->
					<noscript>
					<input type="submit" class="button" id="icefit-reset-button-no-js" name="reset-no-js" value="Reset Options" />
					<input type="submit" class="button-primary" id="submit-button-no-js" name="save-no-js" value="Save all Changes" />
					</noscript>
					<!-- End No-JS Fallback buttons -->
					<div id="ajax-result-wrap"><div id="ajax-result"></div></div>
					<?php wp_nonce_field('chooko_settings_ajax_post_action','chooko_settings_nonce'); ?>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
	<?php $options = chooko_settings_template(); ?>
		
		jQuery(document).ready(function(){

		<?php
			$has_image = false;
			foreach ($options as $arg) {
				if ( $arg['type'] == "image" ) {
					$has_image = true;
		?>
					jQuery(<?php echo "'#".$arg['id']."_upload'"; ?>).click(function() {
					formfield = <?php echo "'#".$arg['id']."'"; ?>;
					tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
					return false;
					});
					
					jQuery(<?php echo "'#".$arg['id']."_remove'"; ?>).click(function() {
					formfield = <?php echo "'#".$arg['id']."'"; ?>;
					preview = <?php echo "'#".$arg['id']."_preview'"; ?>;
					jQuery(formfield).val('');
					jQuery(preview).attr("src",<?php echo "'".get_template_directory_uri(). "/functions/icefit-options/img/null.png'"; ?>);
					return false;
					});
					
		<?php	}
			}
			if ($has_image) {
		?>
			window.send_to_editor = function(html) {
				imgurl = jQuery('img',html).attr('src');
				jQuery(formfield).val(imgurl);
				jQuery(formfield+'_preview').attr("src",imgurl);
				tb_remove();
			}
		<?php } ?>
		});
	</script>
	<?php	
}
?>