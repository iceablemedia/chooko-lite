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
function icefit_get_option($option) {
	global $icefit_settings_slug;
	$icefit_settings = get_option($icefit_settings_slug);
	$value = "";
	if (is_array($icefit_settings)) {
		if (array_key_exists($option, $icefit_settings)) $value = $icefit_settings[$option];
	}
	return $value;
}

// Custom function to get all settings (returns an array of all settings)
function icefit_get_settings() {
	global $icefit_settings_slug;
	$icefit_settings = get_option($icefit_settings_slug);
	return $icefit_settings;
}

// Adds "Theme option" link under "Appearance" in WP admin panel
function icefit_settings_add_admin() {
	global $menu;
    $icefit_option_page = add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'icefit-settings', 'icefit_settings_page');
	add_action( 'admin_print_scripts-'.$icefit_option_page, 'icefit_settings_admin_scripts' );
}
add_action('admin_menu', 'icefit_settings_add_admin');

// Registers and enqueue js and css for settings panel
function icefit_settings_admin_scripts() {
	wp_register_style( 'icefit_admin_css', get_template_directory_uri() .'/functions/icefit-options/style.css');
	wp_enqueue_style( 'icefit_admin_css' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'icefit_admin_js', get_template_directory_uri() . '/functions/icefit-options/functions.js', array( 'wp-color-picker' ), false, true );
}

// Generates the settings panel's menu
function icefit_settings_machine_menu($options) {
	$output = "";
	foreach ($options as $arg) {
	
		$ids = array ('custom_css', 'page2', 'unlimited_sidebar', 'endpage2', 'navbar_font', 'headings_font', 'primary_color', 'secondary_color', 'socialmedia', 'facebook_url', 'twitter_url', 'googleplus_url', 'linkedin_url', 'instagram_url', 'pinterest_url', 'tumblr_url', 'stumbleupon_url', 'dribbble_url', 'behance_url', 'deviantart_url', 'flickr_url', 'youtube_url', 'vimeo_url', 'yelp_url', 'rss_url', 'endpage4');		
		if (isset($arg['id'])) {
			if (in_array($arg['id'], $ids)) continue;
		}
		if ( $arg['type'] == "start_menu" )
		{
			$output .= '<li class="icefit-admin-panel-menu-li '.$arg['id'].'"><a class="icefit-admin-panel-menu-link '.$arg['icon'].'" href="#'.$arg['name'].'" id="icefit-admin-panel-menu-'.$arg['id'].'"><span></span>'.$arg['name'].'</a></li>'."\n";
		} 
	}
	return $output;
}

// Generate the settings panel's content
function icefit_settings_machine($options) {
	global $icefit_settings_slug;
	$icefit_settings = get_option($icefit_settings_slug);
	$output = "";
	foreach ($options as $arg) {

		$ids = array ('custom_css', 'page2', 'unlimited_sidebar', 'endpage2', 'navbar_font', 'headings_font', 'primary_color', 'secondary_color', 'socialmedia', 'facebook_url', 'twitter_url', 'googleplus_url', 'linkedin_url', 'instagram_url', 'pinterest_url', 'tumblr_url', 'stumbleupon_url', 'dribbble_url', 'behance_url', 'deviantart_url', 'flickr_url', 'youtube_url', 'vimeo_url', 'yelp_url', 'rss_url', 'endpage4');
		if (isset($arg['id'])) {
			if (in_array($arg['id'], $ids)) continue;
		}
		if ( is_array($arg) && is_array($icefit_settings) ) {
			if ( array_key_exists('id', $arg) ) {
				if ( array_key_exists($arg['id'], $icefit_settings) ) $val = stripslashes($icefit_settings[$arg['id']]);
				else $val = "";
			} else { $val = ""; }
		} else { $val = ""; }
		
		if ( $arg['type'] == "start_menu" )
		{
			$output .= '<div class="icefit-admin-panel-content-box" id="icefit-admin-panel-content-'.$arg['id'].'">';
		}
		elseif ( $arg['type'] == "text" )
		{
			$val = esc_attr($val);
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $icefit_settings[$arg['id']] = $val = $arg['default'];
			$output .= '<input class="icefit_input_text" name="'. $arg['id'] .'" id="'. $arg['id'] .'" type="'. $arg['type'] .'" value="'. $val .'" />'."\n";
			$output .= '<div class="desc">'. $arg['desc'] .'</div><br class="clear">'."\n";
		}
		elseif ( $arg['type'] == "textarea" )
		{
			$val = esc_textarea($val);
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $icefit_settings[$arg['id']] = $val = $arg['default'];
			$output .= '<textarea class="icefit_input_textarea" name="'. $arg['id'] .'" id="'. $arg['id'] .'" rows="5" cols="60">' . $val . '</textarea>'."\n";
			$output .= '<br class="clear"><label>'. $arg['desc'] .'</label>'."\n";
		}				
		elseif ( $arg['type'] == "radio" )
		{
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $icefit_settings[$arg['id']] = $val = $arg['default'];
			$values = $arg['values'];
			$output .= '<div class="radio-group">';
			foreach ($values as $value) {
			$output .= '<input type="radio" name="'.$arg['id'].'" value="'.$value.'" '.checked($value, $val, false).'>'.$value.'<br/>';
			}
			$output .= '</div>';
			$output .= '<label class="desc">'. $arg['desc'] .'</label><br class="clear" />'."\n";
		}		
		elseif ( $arg['type'] == "select" )
		{
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $icefit_settings[$arg['id']] = $val = $arg['default'];
			$values = $arg['values'];
			$output .= '<select name="'.$arg['id'].'">';
			foreach ($values as $value) {
				$output .= '<option value="'.$value.'" '.selected($value, $val, false).'>'.$value.'</option>';
			}
			$output .= '</select>';
			$output .= '<div class="desc">'. $arg['desc'] .'</div><br class="clear" />'."\n";
		}
		elseif ( $arg['type'] == "image" )
		{
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $icefit_settings[$arg['id']] = $val = $arg['default'];
			$output .= '<input class="icefit_input_img" name="'. $arg['id'] .'" id="'. $arg['id'] .'" type="text" value="'. $val .'" />'."\n";
			$output .= '<div class="desc">'. $arg['desc'] .'</div><br class="clear">'."\n";
			$output .= '<input class="icefit_upload_button" name="'. $arg['id'] .'_upload" id="'. $arg['id'] .'_upload" type="button" value="Upload Image">'."\n";
			$output .= '<input class="icefit_remove_button" name="'. $arg['id'] .'_remove" id="'. $arg['id'] .'_remove" type="button" value="Remove"><br />'."\n";
			$output .= '<img class="icefit_image_preview" id="'. $arg['id'] .'_preview" src="'.$val.'"><br class="clear">'."\n";
		}
		elseif ( $arg['type'] == "color" )
		{
			$val = esc_attr($val);
			$output .= '<h3>'. $arg['name'] .'</h3>'."\n";
			if ( $val == "" && $arg['default'] != "") $icefit_settings[$arg['id']] = $val = $arg['default'];
			$output .= '<input class="icefit_input_color" name="'. $arg['id'] .'" id="'. $arg['id'] .'" type="text" value="'. $val .'" data-default-color="'. $arg['default'] .'" />'."\n";
			$output .= '<div class="desc">'. $arg['desc'] .'</div><br class="clear">'."\n";
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
							<li><strong>Wide</strong> or <strong>Boxed</strong> layout</li>
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
							<li><a href="http://www.gnu.org/licenses/gpl-3.0.en.html" target="_blank">GPLv3 License</a> : Buy once, use as many time as you wish!</li>
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
	update_option($icefit_settings_slug,$icefit_settings);	
	return $output;
}

// AJAX callback function for the "reset" button (resets settings to default)
function icefit_settings_reset_ajax_callback() {
	global $icefit_settings_slug;
	// Get settings from the database
	$icefit_settings = get_option($icefit_settings_slug);
	// Get the settings template
	$options = icefit_settings_template();
	// Revert all settings to default value
	foreach($options as $arg){
		if ($arg['type'] != 'start_menu' && $arg['type'] != 'end_menu') {
			$icefit_settings[$arg['id']] = $arg['default'];
		}	
	}
	// Updates settings in the database	
	update_option($icefit_settings_slug,$icefit_settings);	
}
add_action('wp_ajax_icefit_settings_reset_ajax_post_action', 'icefit_settings_reset_ajax_callback');

// AJAX callback function for the "Save changes" button (updates user's settings in the database)
function icefit_settings_ajax_callback() {
	global $icefit_settings_slug;
	// Check nonce
	check_ajax_referer('icefit_settings_ajax_post_action','icefit_settings_nonce');
	// Get POST data
	$data = $_POST['data'];
	parse_str($data,$output);
	// Get current settings from the database
	$icefit_settings = get_option($icefit_settings_slug);
	// Get the settings template
	$options = icefit_settings_template();
	// Updates all settings according to POST data
	foreach($options as $option_array){
		
		$ids = array ('gopro', 'custom_css', 'page2', 'unlimited_sidebar', 'endpage2', 'navbar_font', 'headings_font', 'primary_color', 'secondary_color', 'socialmedia', 'facebook_url', 'twitter_url', 'googleplus_url', 'linkedin_url', 'instagram_url', 'pinterest_url', 'tumblr_url', 'stumbleupon_url', 'dribbble_url', 'behance_url', 'deviantart_url', 'flickr_url', 'youtube_url', 'vimeo_url', 'yelp_url', 'rss_url', 'endpage4');
		
		if (in_array($option_array['id'], $ids)) {
			if ($option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu') {
				$id = $option_array['id'];
				$new_value = $option_array['default'];
				$icefit_settings[$id] = stripslashes($new_value);
			}
		} else {
			if ($option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu') {
				$id = $option_array['id'];
				if ($option_array['type'] == "text") {
					$new_value = esc_textarea($output[$option_array['id']]);
				} else {
					$new_value = $output[$option_array['id']];		
				}
				$icefit_settings[$id] = stripslashes($new_value);
			}
		}

	}

	// Updates settings in the database
	update_option($icefit_settings_slug,$icefit_settings);	
}
add_action('wp_ajax_icefit_settings_ajax_post_action', 'icefit_settings_ajax_callback');

// NOJS fallback for the "Save changes" button
function icefit_settings_save_nojs() {
	global $icefit_settings_slug;
	// Get POST data
	//	parse_str($_POST,$output);
	// Get current settings from the database
	$icefit_settings = get_option($icefit_settings_slug);
	// Get the settings template
	$options = icefit_settings_template();
	// Updates all settings according to POST data
	foreach($options as $option_array){
	
		$ids = array ('gopro', 'custom_css', 'page2', 'unlimited_sidebar', 'endpage2', 'navbar_font', 'headings_font', 'primary_color', 'secondary_color', 'socialmedia', 'facebook_url', 'twitter_url', 'googleplus_url', 'linkedin_url', 'instagram_url', 'pinterest_url', 'tumblr_url', 'stumbleupon_url', 'dribbble_url', 'behance_url', 'deviantart_url', 'flickr_url', 'youtube_url', 'vimeo_url', 'yelp_url', 'rss_url', 'endpage4');
		if (isset($option_array['id']) && in_array($option_array['id'], $ids)) {
			if ($option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu') {
				$id = $option_array['id'];
				$new_value = $option_array['default'];
				$icefit_settings[$id] = stripslashes($new_value);
			}
		} else {
			if ( isset($option_array['id']) && $option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu' ) {
				$id = $option_array['id'];
				if ($option_array['type'] == "text") {
					$new_value = esc_textarea($_POST[$option_array['id']]);
				} else {
					$new_value = $_POST[$option_array['id']];
				}
				$icefit_settings[$id] = stripslashes($new_value);
			}
		}

	}

	// Updates settings in the database
	update_option($icefit_settings_slug,$icefit_settings);	
}

// Update settings template in the database upon theme activation
function icefit_settings_theme_activation() {
	global $icefit_settings_slug;
	// Get current settings from the database
	$icefit_settings = get_option($icefit_settings_slug);
	// Get the settings template
	$options = icefit_settings_template();
	// Updates all settings
	foreach($options as $option_array){
		if ($option_array['type'] != 'start_menu' && $option_array['type'] != 'end_menu') {
			$id = $option_array['id'];
			if ( !isset( $icefit_settings[$id] ) )
				$icefit_settings[$id] = stripslashes($option_array['default']);
		}

	}
	// Updates settings in the database
	update_option($icefit_settings_slug,$icefit_settings);	
}
add_action('after_switch_theme', 'icefit_settings_theme_activation');

// Outputs the settings panel
function icefit_settings_page(){
	
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	global $icefit_settings_slug;
	global $icefit_settings_name;
	
	if (isset( $_POST['reset-no-js'] ) && $_POST['reset-no-js']) {
		icefit_settings_reset_ajax_callback();
		echo '<div class="updated fade"><p>Settings were reset to default.</p></div>';
	}
	
	if (isset( $_POST['save-no-js'] ) && $_POST['save-no-js']) {
		icefit_settings_save_nojs();
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
				<h3><?php echo $icefit_settings_name; ?></h3>
			</div>
			<div id="icefit-admin-panel-main">
				<div id="icefit-admin-panel-menu">
					<ul>
						<?php echo icefit_settings_machine_menu( icefit_settings_template() ); ?>
					</ul>
				</div>
				<div id="icefit-admin-panel-content">
					<?php echo icefit_settings_machine( icefit_settings_template() ); ?>
				</div>
				<div class="clear"></div>
			</div>
			<div id="icefit-admin-panel-footer">
				<div id="icefit-admin-panel-footer-submit">
					<input type="button" class="button" id="icefit-reset-button" name="reset" value="Reset Options" />
					<input type="submit" value="Save all Changes" class="button-primary" id="submit-button" />
					<!-- No-JS Fallback buttons -->
					<input type="submit" class="button" id="icefit-reset-button-no-js" name="reset-no-js" value="Reset Options" />
					<input type="submit" class="button-primary" id="submit-button-no-js" name="save-no-js" value="Save all Changes" />
					<!-- End No-JS Fallback buttons -->
					<div id="ajax-result-wrap"><div id="ajax-result"></div></div>
					<?php wp_nonce_field('icefit_settings_ajax_post_action','icefit_settings_nonce'); ?>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
	<?php $options = icefit_settings_template(); ?>
		
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