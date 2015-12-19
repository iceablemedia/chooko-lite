<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Header Template
 *
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found', 'icefit') ?><?php elseif ( is_home() ) : ?> | <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<meta name="description" content="<?php bloginfo('description') ?>">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<?php $favicon = icefit_get_option('favicon');
if ($favicon): ?>
	<!-- Favicon
	================================================== -->
	<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
<?php endif; ?>

	<!-- Misc
	================================================== -->
<link rel="pingback" href="<?php echo get_option('siteurl') .'/xmlrpc.php';?>" />
<?php
	/* 
	 * enqueue threaded comments support.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Load head elements
	wp_head();
?>

</head>
<body <?php body_class(); ?>>

	<!-- Page Layout
	================================================== -->
	<div id="header">
	<div class="container">
		<div id="logo">
		<a href="<?php echo home_url(); ?>">
		<img src="<?php echo esc_url ( icefit_get_option('logo') ); ?>" alt="<?php bloginfo('name') ?>">
		</a>
		</div>
	</div>
	</div><!-- End header -->

	<div id="main-wrap">

	<div id="navbar" class="container">
	<div class="menu-container">
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>', ) ); ?>
	<?php icefit_dropdown_nav_menu(); ?>
	</div>
	</div><!-- End navbar -->