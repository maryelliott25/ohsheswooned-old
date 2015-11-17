<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package oss
 */
?><!DOCTYPE html>
<html class="closed" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,700,400italic|Crimson+Text:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

<script src="http://wordpress.personal.dev:35729/livereload.js?snipver=1"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="body-inner-wrap">
		<div class="hidden-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</div>
		<div id="page" class="hfeed site">

			<header id="masthead" class="site-header" role="banner">

				<?php if ( get_header_image() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" class="site-logo" width="100%" alt="">
				</a>
				<?php endif; // End header image check. ?>

				<div class="site-branding">
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->

			<div id="content" class="site-content">
