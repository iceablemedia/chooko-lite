/**
 * Chooko Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 * Copyright 2013-2020 Iceable Themes - https://www.iceablethemes.com
 * Javascripts
 *
 * Dependencies:
 * - Superfish
 */

/* --- (document).ready function wrap --- */

jQuery(document).ready(function($){

	/*--- Responsive Dropdown Menu ---*/

	$('#dropdown-menu').change( function () {
		var url = $('#dropdown-menu').val();
		$(location).attr('href',url);
	});

	/*--- Hookup Superfish ---*/

	$('ul.sf-menu').superfish({
		delay:	700,	// the delay in milliseconds that the mouse can remain outside a submenu without it closing
		animation:	{opacity:'show',height:'show'},	// an object equivalent to first parameter of jQuery’s .animate() method
		speed:	'normal',	// speed of the animation. Equivalent to second parameter of jQuery’s .animate() method
		autoArrows:	false,	// if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
		dropShadows:	false,	// completely disable drop shadows by setting this to false
	});

	/* Remove empty comment reply link wrappers */
	$('div.reply').filter( function() {
		return $.trim($(this).text()) === '';
	}).remove();

	/*--- End of $(document).ready(function() ---*/

});
