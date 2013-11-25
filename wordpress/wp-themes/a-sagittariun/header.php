<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script><![endif]-->
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<?php wp_head(); ?>
	<script>var switchTo5x=true;</script>
	<script src="http://w.sharethis.com/button/buttons.js"></script>
	<script>stLight.options({publisher: "4bf27301-5b7f-415a-af44-4c73822ede55", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

</head>

<body <?php body_class(); ?>>
	<div id="page">
		<header class="site-head" role="banner">
			<div class="site-head-inner clearfix">
				<h1>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<nav class="main-nav" role="navigation">
					<a href="#" class="responsive-menu-toggle">
						<span class="menu-bar menu-bar-top"></span>
						<span class="menu-bar menu-bar-middle"></span>
						<span class="menu-bar menu-bar-bottom"></span>
					</a>
					<div class="responsive-menu">
						<?php wp_nav_menu(); ?>
						<a class="menu-icon menu-icon-twitter"  href="https://twitter.com/a_sagittariun"><span class="icon-twitter"></span></a>
						<a class="menu-icon menu-icon-facebook" href="http://www.facebook.com/pages/A-Sagittariun/136493829781921?sk=wall"><span class="icon-facebook"></span></a>
					</div>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->

		<div id="main" class="site-main">
