<?php
/**
 *
 * Chooko Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Footer Template
 *
 */ 
?>

	<?php  if (is_active_sidebar( 'footer-sidebar' ) ): ?>
		<div id="footer"><div class="container">
			<ul>
			<?php dynamic_sidebar( 'footer-sidebar' ); ?>
			</ul>
		</div></div>
	<?php endif; ?>

	<div id="sub-footer"><div class="container">
		<div class="sub-footer-left"><p><?php 
			/* You are free to modify or replace this by anything you like,
			 * Though it would be really nice if you decide to keep the tiny link to the theme author :)
			 */ ?>
			 Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
			 <?php printf( __( 'Proudly powered by', 'chooko' ) ); ?><a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'chooko' ); ?>"> WordPress</a>. Chooko design by <a href="<?php echo esc_url( 'http://www.iceablethemes.com' ); ?>" title="<?php esc_attr_e( 'Iceablethemes', 'chooko' ); ?>">Iceable Themes</a>.
		</p></div>

		<div class="sub-footer-right">
			<?php	$footer_menu = array( 'theme_location' => 'footer-menu', 'depth' => 1);
					wp_nav_menu( $footer_menu ); ?>
		</div>
	</div></div>
	<!-- End Footer -->
</div>
<!-- End main wrap -->

<?php wp_footer(); ?> 
<!-- End Document
================================================== -->
</body>
</html>