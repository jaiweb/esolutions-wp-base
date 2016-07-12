<?php
/**
* The template for displaying the header
*
* Displays all of the head element and everything up until the "site-content" div.
*
* @package WordPress
* @subpackage Twenty_Fifteen
* @since Twenty Fifteen 1.0
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->  
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script>(function(){document.documentElement.className='js'})();</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php	do_action('_after_body');	?>
<div id="page" class="hfeed site container">
	<header id="masthead" class="site-header row" role="banner">		
		<div class="site-branding">
			<?php	do_action('_before_navigation');	?>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluidd">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
					</div>
					<?php
						wp_nav_menu( array(
							'theme_location'	=>	'main',
							'container_id'		=>	'navbar',
							'container_class' 	=>	'navbar-collapse collapse',
							'menu_class'      	=>	'nav navbar-nav',
							'fallback_cb'       =>	'wp_bootstrap_navwalker::fallback',
							'walker'			=>	new wp_bootstrap_navwalker()
						) );
					?>
				</div>
			</nav>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'esc' ); ?></a>
			<?php	do_action('_after_navigation');	?>
		</div><!-- .site-branding -->
	</header><!-- .site-header -->
	<?php	do_action('_after_header');	?>
	<div id="content" class="site-content row">