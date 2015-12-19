/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Javascripts
 *
 */

/* --- Flexslider --- */

jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({
	controlsContainer: ".flexslider-container",
	animation: "slide",
	slideshowSpeed: 4000,
	controlNav: false, 
	directionNav: true,
	prevText: "",
	nextText: "",
	});
});

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

	/*--- Hookup PrettyPhoto ---*/

	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false,
		show_title: false,
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
	});

	/*--- End of $(document).ready(function() ---*/

});