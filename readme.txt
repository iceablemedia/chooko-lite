=== CHOOKO LITE ===

Contributors: Iceable
Tags: brown, pink, tan, light, one-column, two-columns, three-columns, four-columns, left-sidebar, right-sidebar, fixed-width, custom-menu, featured-images, full-width-template, sticky-post, theme-options, threaded-comments, translation-ready
Requires at least: 3.5
Tested up to: 4.2.2
Stable tag: 1.1.10

== ABOUT CHOOKO LITE ==

Chooko Lite is a sweet, colorful and responsive theme for WordPress. Perfect for personal, fashion, beauty or cooking oriented blogs and creative websites.
It features two widgetizable areas (sidebar and optional footer).

Chooko Lite is the lite version of Chooko Pro, which comes with many additional features and access to premium class pro support forum and can be found at http://www.iceablethemes.com

== GETTING STARTED ==

Once you activate the theme from your WordPress admin panel, you can visit the "Theme Options" page to quickly and easily upload your own logo and optionally set a custom favicon.
If you will be using a custom header image, you can also optionally choose to enable or disable it on your homepage, blog index pages, single post pages and individual pages.
It is highly recommended to set a menu (in appearance > menu) instead of relying on the default fallback menu. Doing so will automatically activate the dropdown version of your menu in responsive mode.

Additional documentation and free support forums can be found at http://www.iceablethemes.com under "support".

== SPECIAL FEATURES INSTRUCTIONS ==

* Footer widgets: The widgetizable footer is disabled by default. To activate it, simply go to Appearance > Widgets and drop some widgets in the "Footer" area, just like you would do for the sidebar. It is recommended to use 4 widgets in the footer, or no widgets at all to disable it.

Additional documentation and free support forums can be found at http://www.iceablethemes.com under "support".

== LICENSE ==

This theme is released under the terms of the GNU GPLv2 License.
Please refer to license.txt for more information.

== CREDITS ==

This theme bundles some third party javascript and jQuery plugins, released under GPL or GPL compatible licenses:
* superfish: Copyright 2013 Joel Birch. Dual licensed under the MIT and GPL licenses. http://users.tpg.com.au/j_birch/plugins/superfish/
* HTML5 Shiv v3.6 | @afarkas @jdalton @jon_neal @rem | MIT/GPL2 Licensed. Source: https://github.com/aFarkas/html5shiv

All other files are copyright 2013-2015 Iceable Media and released under the terms of the GNU GPLv2 License.

== CHANGELOG ==

= 1.1.10 =
May 26th, 2015

* Tested with WP 4.2.2
* Enhanced menu items: the whole item area is now clickable, not just the text
* Added option to display tagline
* Added option to chose between "excerpt" or "full content" for the blog index page  
* Added option to switch off responsiveness
* Made all strings translatable, including the backend
* Updated POT file
* Added french (fr_FR) translation
* Added admin notice when menu is not set (on theme option page only)
* Various PHP/HTML optimizations
* Removed obsolete code from comments.php
* Added extra user permission check in icefit-options
* Enhanced validation and sanitation in icefit-options
* Renamed and moved /page-full-width.php to /page-templates/full-width.php
* Prefixed hook (chooko-style) to enqueue style.css
* Now using core version of hoverintent
* Merged all front-end css in silverclean.dev.css and minified in silverclean.min.css
* Merged all front-end javascripts in silverclean.dev.js and minified in silverclean.min.js
* Removed content filters
* Appropriately use the_title_attribute() to escape title attributes in index.php
* Update copyright dates
* Updated description
* Updated credits

= 1.1.9 =
September 24th, 2014
* Tested with WP 4.0
* Fixed hAtom structured data (Errors like Missing required field "entry-title" / "updated" / hCard "author" in Google Webmaster tools)
* Removed hentry class from pages (hentry is irrelevant for static content)
* Fixed glitch in blog index: if several posts were made on the same date, the date only displayed for the first one.
* Updated: display date according to the user-defined "date format" in Settings.

= 1.1.8 =
September 1st, 2014
* Added ellipsis (...) to the end of truncated excerpts when displaying the "read more" button (based on user feedback).
* Fixed W3C validator error caused by the "X-UA-Compatible" meta tag. The theme now fully validates as HTML5.
* Replaced (has_post_thumbnail()) with ('' != get_the_post_thumbnail()) in single.php (as per codex recommendation - fixes an occasional issue)
* Fixed an odd glitch with footer widgets columns
* Fixed CSS glitch in Firefox with large logo and featured images

= 1.1.7 =
June 16th, 2014
* Removed unused function chooko_get_settings()
* Removed unnecessary function that updated chooko_settings in the database upon activation. Now saving/updating only upon user action (when user clicks "save changes" in Theme options)
* Using sane defaults (No setting is saved in the database without explicit user action)

= 1.1.6 =
May 19th, 2014
* Moved $content_width definition into a callback function (hooked to after_setup_theme)
* Updated copyright (2013-2014)
* Tested with WP 3.9.1

= 1.1.5 =
March 31th, 2014
* Loading webfonts with latin + latin extended subset to improve support for some foreign languages
* Webfonts loading (SSL/Non-SSL): removed is_ssl() check and let browsers determine which protocol to use
* Added paginated pages support

= 1.1.4 =
February 4th, 2014
* Added "Support and Feedback" in theme options
* Tested with WordPress 3.8.1

= 1.1.3 =
January 2nd, 2013
* Updated tags for WordPress 3.8: fixed-layout and responsive-layout
* Updated screenshot to 880x660px for WordPress 3.8

= 1.1.2 =
November 18th, 2013
* Child theme and customization support: enqueuing style.css
* Child theme support: stylesheets in child's /css folder override parent's version if they exist
* Updated screenshot.png

= 1.1.1 =
November 15th, 2013
* Fixed: Appropriately hook css enqueuing to wp_enqueue_scripts
* Added: Option to use a text-based site title instead of logo (used as fallback when no logo is set)

= 1.1 =
November 11th, 2013
* Revision, enhancement and clean up of the whole code
* Removed the slider which was using CPT (considered plugin territory by the WPTRT)
* Replaced the slider with WP custom header implementation
* Replaced background setting in custom option framework with WP built-in custom background
* Ability to show/hide custom header on front page, blog index, single posts and individual pages
* Changed default logo to something generic (WPTRT compliance)
* Tested with WP 3.7.1

= 1.0.2 =
May 3rd, 2013
* Fixed: Changed license to GPLv2 for improved compatibility
* Fixed: Escaping user-entered data before printing
* Fixed: Appropriately prefixed all custom functions
* Fixed: Proper enqueuing of google webfonts
* Fixed: "Previous" and "Next" posts links were mixed up on single post view
* Removed: Unnecessary enqueuing of jQuery
* Removed: Unnecessary use of function_exist() conditional
* Removed: Unused images files from the option framework
* Updated: Author URI

= 1.0.1 =
April 19th, 2013
* Fixed: Icefit Improved Excerpt enhanced to preserve some styling tags without breaking the markup
* Added: Option to choose what content to display on blog index pages (Full content, WP default excerpt or Icefit improved excerpt)
* Added: /languages folder with default po and mo files and POT file for localization
* Changed: Updated Theme URI to Chooko Lite demo site

= 1.0 =
April 9th, 2013
* Initial release